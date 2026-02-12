<?php
/**
 * Endpoint: Obtener datos del dashboard administrativo
 * Retorna JSON con estadísticas y métricas del sistema
 */

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-cache, must-revalidate');

// Iniciar sesión y verificar autenticación
session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    http_response_code(401);
    echo json_encode([
        'success' => false,
        'error' => 'No autenticado'
    ]);
    exit();
}

// Verificar que sea administrador
if (!$_SESSION['es_superadmin'] && !in_array('Administrador', $_SESSION['roles'] ?? [])) {
    http_response_code(403);
    echo json_encode([
        'success' => false,
        'error' => 'Acceso denegado'
    ]);
    exit();
}

// Conexión a base de datos
require "../conexion/conexion.php";

try {
    // Verificar conexión mysqli
    if (!isset($conexion) || $conexion->connect_error) {
        throw new \Exception('Error de conexión a la base de datos');
    }

    // Obtener datos del usuario logueado
    $usuario = [
        'id' => $_SESSION['usuario_id'] ?? 0,
        'nombre' => $_SESSION['nombre'] ?? 'Usuario',
        'email' => $_SESSION['email'] ?? '',
        'es_superadmin' => $_SESSION['es_superadmin'] ?? false,
        'roles' => $_SESSION['roles'] ?? []
    ];

    // ========================================
    // 1. TARJETAS KPI (Cards)
    // ========================================
    
    // Total de empresas registradas
    $result = $conexion->query("SELECT COUNT(*) as total FROM empresas WHERE eliminado_at IS NULL");
    $empresas_total = $result->fetch_assoc()['total'];

    // Empresas pendientes de validación (estado 'inactivo' asumiendo que significa pendiente)
    $result = $conexion->query("SELECT COUNT(*) as total FROM empresas WHERE estado = 'inactivo' AND eliminado_at IS NULL");
    $empresas_pendientes = $result->fetch_assoc()['total'];

    // Administradores activos (usuarios con rol Administrador)
    $result = $conexion->query("
        SELECT COUNT(DISTINCT u.id) as total 
        FROM usuarios u
        INNER JOIN asignacionRol ar ON u.id = ar.usuario_id
        INNER JOIN roles r ON ar.rol_id = r.id
        WHERE r.nombre = 'Administrador' 
        AND u.activo = 'si'
    ");
    $admin_activos = $result->fetch_assoc()['total'];

    // Estado del sistema (simulado - en producción vendría de métricas reales)
    $sistema_estado = 'Óptimo';
    $sistema_porcentaje = 100;

    // ========================================
    // 2. EMPRESAS POR ESTADO (Para gráfico)
    // ========================================
    $result = $conexion->query("SELECT 
            estado,
            COUNT(*) as cantidad
        FROM empresas
        WHERE eliminado_at IS NULL
        GROUP BY estado
    ");
    
    $empresas_por_estado = [];
    while ($row = $result->fetch_assoc()) {
        $empresas_por_estado[] = $row;
    }

    // Procesar datos para el gráfico
    $estados = [];
    $cantidades = [];
    $total_empresas = 0;
    
    foreach ($empresas_por_estado as $row) {
        $estados[] = ucfirst($row['estado']);
        $cantidades[] = (int)$row['cantidad'];
        $total_empresas += (int)$row['cantidad'];
    }

    // Calcular porcentajes
    $estados_resumen = [];
    foreach ($empresas_por_estado as $row) {
        $cantidad = (int)$row['cantidad'];
        $porcentaje = $total_empresas > 0 ? round(($cantidad / $total_empresas) * 100, 2) : 0;
        $estados_resumen[] = [
            'estado' => ucfirst($row['estado']),
            'cantidad' => $cantidad,
            'porcentaje' => $porcentaje
        ];
    }

    // ========================================
    // 3. ACTIVIDAD RECIENTE
    // ========================================
    $result = $conexion->query("SELECT 
            e.nombre_comercial,
            e.fecha_registro,
            e.estado
        FROM empresas e
        WHERE e.eliminado_at IS NULL
        ORDER BY e.fecha_registro DESC
        LIMIT 5
    ");
    
    $actividad_reciente = [];
    while ($row = $result->fetch_assoc()) {
        $fecha = new DateTime($row['fecha_registro']);
        $row['fecha_formateada'] = $fecha->format('d/m/Y H:i');
        $row['fecha_relativa'] = obtenerFechaRelativa($row['fecha_registro']);
        $actividad_reciente[] = $row;
    }

    // ========================================
    // 4. MÉTRICAS DEL SISTEMA
    // ========================================
    
    // Tamaño de la base de datos
    $result = $conexion->query("SELECT 
            ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS size_mb
        FROM information_schema.TABLES
        WHERE table_schema = DATABASE()
    ");
    $db_size = $result->fetch_assoc()['size_mb'] ?? 0;

    // Número total de usuarios en el sistema
    $result = $conexion->query("SELECT COUNT(*) as total FROM usuarios WHERE activo = 'si'");
    $usuarios_total = $result->fetch_assoc()['total'];

    // Ventas del día (todas las empresas)
    $result = $conexion->query("SELECT 
            COUNT(*) as total_ventas,
            COALESCE(SUM(total_general), 0) as total_monto
        FROM ventas
        WHERE DATE(fecha_venta) = CURDATE()
        AND estado = 'completada'
    ");
    $ventas_hoy = $result->fetch_assoc();

    // ========================================
    // 5. NOTIFICACIONES
    // ========================================
    $notificaciones = [];
    
    // Notificación de empresas pendientes
    if ($empresas_pendientes > 0) {
        $notificaciones[] = [
            'tipo' => 'danger',
            'icono' => 'circle-exclamation',
            'titulo' => 'Validación Pendiente',
            'mensaje' => "{$empresas_pendientes} empresa(s) esperando validación",
            'tiempo' => 'Ahora',
            'leida' => false
        ];
    }

    // Notificación de espacio en disco (simulada)
    if ($db_size > 100) {
        $notificaciones[] = [
            'tipo' => 'warning',
            'icono' => 'exclamation-triangle',
            'titulo' => 'Base de Datos',
            'mensaje' => "Tamaño actual: {$db_size} MB",
            'tiempo' => 'Hace 15 min',
            'leida' => false
        ];
    }

    // Notificación de actividad reciente
    $notificaciones[] = [
        'tipo' => 'info',
        'icono' => 'info-circle',
        'titulo' => 'Sistema Operativo',
        'mensaje' => 'Todos los servicios funcionando correctamente',
        'tiempo' => 'Hace 1h',
        'leida' => true
    ];

    // ========================================
    // 6. TOP CATEGORÍAS DE EMPRESAS
    // ========================================
    $result = $conexion->query("SELECT 
            ce.nombre,
            COUNT(e.id) as cantidad
        FROM categorias_empresa ce
        LEFT JOIN empresas e ON ce.id = e.categoria_empresa_id AND e.eliminado_at IS NULL
        GROUP BY ce.id, ce.nombre
        ORDER BY cantidad DESC
        LIMIT 5
    ");
    
    $top_categorias = [];
    while ($row = $result->fetch_assoc()) {
        $top_categorias[] = $row;
    }

    // ========================================
    // RESPUESTA JSON
    // ========================================
    $respuesta = [
        'success' => true,
        'timestamp' => date('Y-m-d H:i:s'),
        'usuario' => $usuario,
        'kpis' => [
            'empresas_total' => (int)$empresas_total,
            'empresas_pendientes' => (int)$empresas_pendientes,
            'admin_activos' => (int)$admin_activos,
            'sistema_estado' => $sistema_estado,
            'sistema_porcentaje' => $sistema_porcentaje
        ],
        'graficos' => [
            'empresas_por_estado' => [
                'labels' => $estados,
                'data' => $cantidades,
                'resumen' => $estados_resumen
            ]
        ],
        'actividad_reciente' => $actividad_reciente,
        'metricas_sistema' => [
            'db_size_mb' => (float)$db_size,
            'db_capacidad_porcentaje' => min(($db_size / 500) * 100, 100), // Asumiendo 500MB como capacidad
            'usuarios_total' => (int)$usuarios_total,
            'ventas_hoy' => [
                'cantidad' => (int)$ventas_hoy['total_ventas'],
                'monto' => (float)$ventas_hoy['total_monto']
            ]
        ],
        'notificaciones' => $notificaciones,
        'top_categorias' => $top_categorias
    ];

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

} catch (Exception $e) {
    error_log("Error en obtener_datos_dashboard.php: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Error al obtener datos del dashboard',
        'mensaje_tecnico' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}

/**
 * Función auxiliar para obtener fecha relativa (Hace X tiempo)
 */
function obtenerFechaRelativa($fecha_str) {
    $fecha = new DateTime($fecha_str);
    $ahora = new DateTime();
    $diff = $ahora->diff($fecha);

    if ($diff->y > 0) {
        return "Hace {$diff->y} año(s)";
    } elseif ($diff->m > 0) {
        return "Hace {$diff->m} mes(es)";
    } elseif ($diff->d > 0) {
        return "Hace {$diff->d} día(s)";
    } elseif ($diff->h > 0) {
        return "Hace {$diff->h} hora(s)";
    } elseif ($diff->i > 0) {
        return "Hace {$diff->i} minuto(s)";
    } else {
        return "Justo ahora";
    }
}
