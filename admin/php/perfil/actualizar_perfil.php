<?php
/**
 * Endpoint: Actualizar perfil del usuario
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
    
    if (!isset($input['nombre']) || empty(trim($input['nombre']))) {
        throw new \Exception('El nombre es requerido');
    }
    
    $usuario_id = $_SESSION['usuario_id'];
    $nombre = trim($input['nombre']);
    
    // Actualizar nombre del usuario
    $stmt = $conexion->prepare("
        UPDATE usuarios 
        SET nombre = ?
        WHERE id = ?
    ");
    
    $stmt->bind_param('si', $nombre, $usuario_id);
    
    if (!$stmt->execute()) {
        throw new \Exception('Error al actualizar el perfil');
    }
    
    // Actualizar variable de sesión
    $_SESSION['nombre'] = $nombre;

    echo json_encode([
        'success' => true,
        'mensaje' => 'Perfil actualizado correctamente'
    ], JSON_UNESCAPED_UNICODE);

} catch (\Exception $e) {
    error_log("Error en actualizar_perfil.php: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
