<?php

/**
 * PROCESAMIENTO DE LOGIN
 * Valida credenciales y crea sesión con slug de empresa
 */

session_start();

// Incluir configuración y slug manager
require_once './conexion.php';
require_once './slug.php';

// CORS y headers de seguridad
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');

// Validar que sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
    exit;
}

// Obtener datos del formulario
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$rol = isset($_POST['rol']) ? trim($_POST['rol']) : ''; // 'empresa' o 'admin'

// Validar datos básicos
if (empty($email) || empty($password) || empty($rol)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

try {
    $db = Database::getInstance();
    $conexion = $db->getConnection();
    
    // ============================================
    // LOGIN COMO EMPRESA (usuario de empresa)
    // ============================================
    if ($rol === 'empresa') {
        $stmt = $conexion->prepare("
            SELECT u.id, u.nombre, u.email, u.password_hash, u.empresa_id, e.nombre_comercial, e.estado
            FROM usuarios u
            JOIN empresas e ON u.empresa_id = e.id
            WHERE u.email = ? AND u.activo = 1 AND e.estado = 'activo'
            LIMIT 1
        ");
        
        if (!$stmt) {
            throw new Exception("Error en preparación: " . $conexion->error);
        }
        
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if ($resultado && $usuario = $resultado->fetch_assoc()) {
            // Verificar contraseña
            if (password_verify($password, $usuario['password_hash'])) {
                // ✅ LOGIN EXITOSO
                session_regenerate_id(true);
                
                // Obtener slug de la empresa
                $slug = SlugManager::generateSlug($usuario['nombre_comercial']);
                
                // Guardar en sesión
                $_SESSION['user_id'] = $usuario['id'];
                $_SESSION['user_name'] = $usuario['nombre'];
                $_SESSION['user_email'] = $usuario['email'];
                $_SESSION['empresa_id'] = $usuario['empresa_id'];
                $_SESSION['empresa_nombre'] = $usuario['nombre_comercial'];
                $_SESSION['empresa_slug'] = $slug;
                $_SESSION['rol'] = 'empresa';
                $_SESSION['login_time'] = time();
                
                // Respuesta exitosa con URL de redirección
                echo json_encode([
                    'success' => true,
                    'message' => 'Bienvenido ' . htmlspecialchars($usuario['nombre']),
                    'redirect' => '/PuntoVenta/empresa/' . $slug . '/dashboard',
                    'empresa' => htmlspecialchars($usuario['nombre_comercial'])
                ]);
                exit;
            } else {
                // Contraseña incorrecta
                http_response_code(401);
                echo json_encode(['success' => false, 'message' => 'Email o contraseña incorrectos']);
                exit;
            }
        } else {
            // Usuario no encontrado
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Email o contraseña incorrectos']);
            exit;
        }
    }
    
    // ============================================
    // LOGIN COMO ADMINISTRADOR
    // ============================================
    else if ($rol === 'admin') {
        $stmt = $conexion->prepare("
            SELECT id, nombre, email, password_hash, rol
            FROM usuarios
            WHERE email = ? AND activo = 1 AND rol = 'superadmin'
            LIMIT 1
        ");
        
        if (!$stmt) {
            throw new Exception("Error en preparación: " . $conexion->error);
        }
        
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if ($resultado && $usuario = $resultado->fetch_assoc()) {
            // Verificar contraseña
            if (password_verify($password, $usuario['password_hash'])) {
                // ✅ LOGIN EXITOSO
                session_regenerate_id(true);
                
                $_SESSION['user_id'] = $usuario['id'];
                $_SESSION['user_name'] = $usuario['nombre'];
                $_SESSION['user_email'] = $usuario['email'];
                $_SESSION['rol'] = 'admin';
                $_SESSION['login_time'] = time();
                
                echo json_encode([
                    'success' => true,
                    'message' => 'Bienvenido Administrador',
                    'redirect' => '/PuntoVenta/admin/dashboard.php'
                ]);
                exit;
            } else {
                http_response_code(401);
                echo json_encode(['success' => false, 'message' => 'Email o contraseña incorrectos']);
                exit;
            }
        } else {
            http_response_code(401);
            echo json_encode(['success' => false, 'message' => 'Email o contraseña incorrectos']);
            exit;
        }
    }
    
    else {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Rol inválido']);
        exit;
    }
    
} catch (Exception $e) {
    error_log("Error en login: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error en el servidor',
        'debug' => APP_ENV === 'development' ? $e->getMessage() : ''
    ]);
    exit;
}
?>
