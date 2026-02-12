<?php
/**
 * Endpoint: Obtener datos del perfil del usuario
 */

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-cache, must-revalidate');

session_start();

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    http_response_code(401);
    echo json_encode([
        'success' => false,
        'error' => 'No autenticado'
    ]);
    exit();
}

require_once __DIR__ . '/../../../config/conexion.php';

try {
    $usuario_id = $_SESSION['usuario_id'];

    // Obtener datos del usuario con información de empresa
    $stmt = $conexion->prepare("
        SELECT 
            u.id,
            u.nombre,
            u.email,
            u.activo,
            u.es_superadmin,
            u.fecha_registro,
            u.ultimo_login,
            e.nombre_comercial as empresa_nombre
        FROM usuarios u
        LEFT JOIN empresas e ON u.empresa_id = e.id
        WHERE u.id = ?
    ");
    
    $stmt->bind_param('i', $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        throw new \Exception('Usuario no encontrado');
    }
    
    $usuario = $result->fetch_assoc();
    
    // Obtener roles del usuario
    $stmt = $conexion->prepare("
        SELECT r.nombre
        FROM roles r
        INNER JOIN asignacionRol ar ON r.id = ar.rol_id
        WHERE ar.usuario_id = ?
    ");
    
    $stmt->bind_param('i', $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $roles = [];
    while ($row = $result->fetch_assoc()) {
        $roles[] = $row['nombre'];
    }
    
    $usuario['roles'] = $roles;

    echo json_encode([
        'success' => true,
        'usuario' => $usuario
    ], JSON_UNESCAPED_UNICODE);

} catch (\Exception $e) {
    error_log("Error en obtener_perfil.php: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
