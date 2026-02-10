<?php

/**
 * INICIALIZADOR DE EMPRESA
 * Verifica sesión y slug de empresa en cada página
 * 
 * Uso: <?php include './init.php'; ?>
 * al inicio de cada archivo en /empresa/
 */

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluir slug manager
require_once '../config/slug.php';

// ============================================
// VERIFICAR AUTENTICACIÓN
// ============================================
if (!isset($_SESSION['empresa_id']) || $_SESSION['rol'] !== 'empresa') {
    // Redirigir al login si no está autenticado
    header('Location: /PuntoVenta/index.php?error=session_expired');
    exit;
}

// ============================================
// VERIFICAR SLUG EN LA URL
// ============================================
$slug_url = isset($_GET['slug']) ? trim($_GET['slug']) : null;
$slug_sesion = $_SESSION['empresa_slug'] ?? null;

if (!$slug_url || $slug_url !== $slug_sesion) {
    // El slug en la URL no coincide con el de la sesión
    // Redirigir a la URL correcta
    $pagina_actual = basename($_SERVER['PHP_SELF'], '.php');
    header('Location: /PuntoVenta/empresa/' . $slug_sesion . '/' . $pagina_actual);
    exit;
}

// ============================================
// DATOS DE LA EMPRESA AUTENTICADA
// ============================================
$empresa_id = $_SESSION['empresa_id'];
$empresa_nombre = $_SESSION['empresa_nombre'];
$empresa_slug = $_SESSION['empresa_slug'];
$usuario_nombre = $_SESSION['user_name'];
$usuario_email = $_SESSION['user_email'];

// ============================================
// FUNCIÓN HELPER: GENERAR URLs INTERNAS
// ============================================
function urlEmpresa($pagina) {
    global $empresa_slug;
    return '/PuntoVenta/empresa/' . htmlspecialchars($empresa_slug) . '/' . ltrim($pagina, '/');
}

// ============================================
// FUNCIÓN HELPER: LOGOUT
// ============================================
function logoutEmpresa() {
    $_SESSION = [];
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
    session_destroy();
    header('Location: /PuntoVenta/index.php?logout=success');
    exit;
}
?>
