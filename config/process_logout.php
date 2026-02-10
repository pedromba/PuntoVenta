<?php

/**
 * PROCESAMIENTO DE LOGOUT
 * Destruye la sesión y redirige al login
 */

session_start();

// Destruir todos los datos de la sesión
$_SESSION = [];

// Destruir la cookie de sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Destruir la sesión
session_destroy();

// Responder con éxito
header('Content-Type: application/json');
echo json_encode(['success' => true, 'message' => 'Sesión cerrada exitosamente']);
exit;
?>
