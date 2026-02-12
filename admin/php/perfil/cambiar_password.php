<?php
/**
 * Endpoint: Cambiar contraseña del usuario
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
    $input = json_decode(file_get_contents('php://input'), true);
    
    // Validaciones
    if (!isset($input['password_actual']) || empty($input['password_actual'])) {
        throw new \Exception('La contraseña actual es requerida');
    }
    
    if (!isset($input['password_nueva']) || empty($input['password_nueva'])) {
        throw new \Exception('La nueva contraseña es requerida');
    }
    
    if (strlen($input['password_nueva']) < 8) {
        throw new \Exception('La nueva contraseña debe tener al menos 8 caracteres');
    }
    
    $usuario_id = $_SESSION['usuario_id'];
    
    // Obtener contraseña actual del usuario
    $stmt = $conexion->prepare("SELECT password_hash FROM usuarios WHERE id = ?");
    $stmt->bind_param('i', $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        throw new \Exception('Usuario no encontrado');
    }
    
    $usuario = $result->fetch_assoc();
    
    // Verificar contraseña actual
    if (!password_verify($input['password_actual'], $usuario['password_hash'])) {
        throw new \Exception('La contraseña actual es incorrecta');
    }
    
    // Generar nuevo hash
    $nuevo_hash = password_hash($input['password_nueva'], PASSWORD_DEFAULT);
    
    // Actualizar contraseña
    $stmt = $conexion->prepare("UPDATE usuarios SET password_hash = ? WHERE id = ?");
    $stmt->bind_param('si', $nuevo_hash, $usuario_id);
    
    if (!$stmt->execute()) {
        throw new \Exception('Error al cambiar la contraseña');
    }

    echo json_encode([
        'success' => true,
        'mensaje' => 'Contraseña actualizada correctamente'
    ], JSON_UNESCAPED_UNICODE);

} catch (\Exception $e) {
    error_log("Error en cambiar_password.php: " . $e->getMessage());
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
