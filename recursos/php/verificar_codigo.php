<?php
/**
 * VERIFICACIÓN DE CÓDIGO OTP - SISTEMA PUNTOVENTA
 * ================================================
 * Valida el código de verificación enviado por email
 */

error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

include "../../config/conexion.php";
session_start();

header('Content-Type: application/json');

// Verificar que el usuario esté en proceso de verificación
if (!isset($_SESSION['temp_usuario_id'])) {
    echo json_encode([
        "status" => false, 
        "message" => "Sesión expirada. Por favor, inicia sesión nuevamente.",
        "redirect_login" => true
    ]);
    exit();
}

// Obtener el código ingresado por el usuario
$codigo_ingresado = $_POST['codigo'] ?? '';

if (empty($codigo_ingresado)) {
    echo json_encode(["status" => false, "message" => "Por favor ingresa el código de verificación."]);
    exit();
}

// Limpiar el código (eliminar espacios y caracteres no numéricos)
$codigo_ingresado = preg_replace('/[^0-9]/', '', $codigo_ingresado);

if (strlen($codigo_ingresado) !== 6) {
    echo json_encode(["status" => false, "message" => "El código debe tener 6 dígitos."]);
    exit();
}

$usuario_id = $_SESSION['temp_usuario_id'];

// Buscar el código de verificación más reciente que no haya sido usado
$sql = $conexion->prepare("
    SELECT id, codigo_otp, expira_at 
    FROM verificaciones_login 
    WHERE usuario_id = ? AND usado = 0 
    ORDER BY fecha_creacion DESC 
    LIMIT 1
");
$sql->bind_param("i", $usuario_id);
$sql->execute();
$resultado = $sql->get_result()->fetch_assoc();

if (!$resultado) {
    echo json_encode(["status" => false, "message" => "Código no válido o ya utilizado."]);
    exit();
}

// Verificar si el código ha expirado
if (strtotime($resultado['expira_at']) < time()) {
    echo json_encode([
        "status" => false, 
        "message" => "El código ha expirado. Solicita uno nuevo.",
        "codigo_expirado" => true
    ]);
    exit();
}

// Verificar el código usando password_verify (ya que guardamos el hash)
if (!password_verify($codigo_ingresado, $resultado['codigo_otp'])) {
    error_log("Código incorrecto para usuario ID: " . $usuario_id);
    echo json_encode(["status" => false, "message" => "Código incorrecto. Verifica e intenta nuevamente."]);
    exit();
}

error_log("✅ Código validado correctamente para usuario ID: " . $usuario_id);

// ====================================================================
// CÓDIGO VÁLIDO - COMPLETAR LA AUTENTICACIÓN
// ====================================================================

// Marcar el código como usado
$sqlUpdate = $conexion->prepare("UPDATE verificaciones_login SET usado = 1 WHERE id = ?");
$sqlUpdate->bind_param("i", $resultado['id']);
$sqlUpdate->execute();
$sqlUpdate->close();

// Mover los datos temporales a la sesión definitiva
$_SESSION['usuario_id'] = $_SESSION['temp_usuario_id'];
$_SESSION['empresa_id'] = $_SESSION['temp_empresa_id'];
$_SESSION['nombre'] = $_SESSION['temp_nombre'];
$_SESSION['email'] = $_SESSION['temp_email'];
$_SESSION['es_superadmin'] = $_SESSION['temp_es_superadmin'];
$_SESSION['roles'] = $_SESSION['temp_roles'];
$_SESSION['autenticado'] = true; // ✅ AHORA SÍ ESTÁ AUTENTICADO

// Obtener la ruta de redirección
$redirect = $_SESSION['temp_redirect'] ?? '../../empresa/dashboard.php';

// Limpiar datos temporales
unset($_SESSION['temp_usuario_id']);
unset($_SESSION['temp_empresa_id']);
unset($_SESSION['temp_nombre']);
unset($_SESSION['temp_email']);
unset($_SESSION['temp_es_superadmin']);
unset($_SESSION['temp_roles']);
unset($_SESSION['temp_redirect']);

// Actualizar último login
$sqlLogin = $conexion->prepare("UPDATE usuarios SET ultimo_login = NOW() WHERE id = ?");
$sqlLogin->bind_param("i", $_SESSION['usuario_id']);
$sqlLogin->execute();
$sqlLogin->close();

// Respuesta exitosa - COMO PIDIÓ EL USUARIO, SOLO MENSAJE DE ÉXITO
echo json_encode([
    "status" => true,
    "message" => "Verificación exitosa. Acceso concedido.",
    "redirect" => $redirect,
    // Información adicional para el frontend
    "usuario" => [
        "nombre" => $_SESSION['nombre'],
        "email" => $_SESSION['email']
    ]
]);

$sql->close();
$conexion->close();
