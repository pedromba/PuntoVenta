<?php
// Habilitar logs de errores para debugging
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

include "../../config/conexion.php";
session_start();

header('Content-Type: application/json');

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    echo json_encode(["status" => false, "message" => "Todos los campos son obligatorios."]);
    exit();
}

// Buscar el usuario por email
$sql = $conexion->prepare("SELECT id, empresa_id, nombre, email, password_hash, activo, es_superadmin FROM usuarios WHERE email = ?");
$sql->bind_param("s", $email);
$sql->execute();
$resultado = $sql->get_result()->fetch_assoc();

if (!$resultado) {
    echo json_encode(["status" => false, "message" => "Usuario no encontrado."]);
    exit();
}

// Verificar si el usuario está activo
if ($resultado['activo'] !== 'si') {
    echo json_encode(["status" => false, "message" => "Usuario inactivo. Contacte al administrador."]);
    exit();
}

// Verificar la contraseña
if (!password_verify($password, $resultado['password_hash'])) {
    echo json_encode(["status" => false, "message" => "Contraseña incorrecta."]);
    exit();
}

// Obtener los roles del usuario
$sqlRoles = $conexion->prepare("
    SELECT r.id, r.nombre 
    FROM roles r
    INNER JOIN asignacionRol ar ON r.id = ar.rol_id
    WHERE ar.usuario_id = ? AND r.activo = 'si'
");
$sqlRoles->bind_param("i", $resultado['id']);
$sqlRoles->execute();
$resultadoRoles = $sqlRoles->get_result();

$roles = [];
while ($rol = $resultadoRoles->fetch_assoc()) {
    $roles[] = $rol['nombre'];
}

// Verificar que el usuario tenga al menos un rol asignado
if (empty($roles)) {
    echo json_encode(["status" => false, "message" => "Usuario sin roles asignados. Contacte al administrador."]);
    exit();
}

// ====================================================================
// NUEVO FLUJO: GENERAR CÓDIGO OTP Y ENVIAR POR EMAIL
// ====================================================================

// Generar código de 6 dígitos
$codigo_otp = sprintf("%06d", mt_rand(0, 999999));

// Hashear el código antes de guardarlo
$codigo_hash = password_hash($codigo_otp, PASSWORD_DEFAULT);

// Calcular tiempo de expiración (10 minutos desde ahora)
$expira_at = date('Y-m-d H:i:s', strtotime('+10 minutes'));

// Invalidar códigos anteriores no usados de este usuario
$sqlInvalidar = $conexion->prepare("UPDATE verificaciones_login SET usado = 1 WHERE usuario_id = ? AND usado = 0");
$sqlInvalidar->bind_param("i", $resultado['id']);
$sqlInvalidar->execute();
$sqlInvalidar->close();

// Insertar nuevo código de verificación
$sqlInsert = $conexion->prepare("INSERT INTO verificaciones_login (usuario_id, codigo_otp, expira_at) VALUES (?, ?, ?)");
$sqlInsert->bind_param("iss", $resultado['id'], $codigo_hash, $expira_at);

if (!$sqlInsert->execute()) {
    echo json_encode(["status" => false, "message" => "Error al generar código de verificación."]);
    exit();
}
$sqlInsert->close();

// Enviar email con el código OTP usando PHPMailer
require_once 'enviar_email.php';

try {
    $email_enviado = enviarCodigoVerificacionPHPMailer($resultado['email'], $resultado['nombre'], $codigo_otp);
    
    if (!$email_enviado) {
        error_log("Error al enviar email a: " . $resultado['email']);
        echo json_encode(["status" => false, "message" => "Error al enviar el código de verificación. Intente nuevamente."]);
        exit();
    }
    
    error_log("Email enviado exitosamente a: " . $resultado['email'] . " con código: " . $codigo_otp);
    
} catch (Exception $e) {
    error_log("Excepción al enviar email: " . $e->getMessage());
    echo json_encode(["status" => false, "message" => "Error al enviar email: " . $e->getMessage()]);
    exit();
}

// Guardar datos temporales en sesión (aún NO autenticado)
$_SESSION['temp_usuario_id'] = $resultado['id'];
$_SESSION['temp_empresa_id'] = $resultado['empresa_id'];
$_SESSION['temp_nombre'] = $resultado['nombre'];
$_SESSION['temp_email'] = $resultado['email'];
$_SESSION['temp_es_superadmin'] = $resultado['es_superadmin'];
$_SESSION['temp_roles'] = $roles;
$_SESSION['autenticado'] = false; // Aún NO está autenticado

// Determinar redirección final (se usará después de verificar)
if ($resultado['es_superadmin'] == 1 || in_array('Administrador', $roles)) {
    $redireccion = "admin/dashboard.php";
} else {
    $redireccion = "empresa/dashboard.php";
}
$_SESSION['temp_redirect'] = $redireccion;

error_log("Usuario " . $resultado['email'] . " será redirigido a: " . $redireccion);

// Responder al frontend indicando que debe verificar código
echo json_encode([
    "status" => true,
    "requiere_verificacion" => true,
    "message" => "Código de verificación enviado a tu email. Revisa tu bandeja de entrada.",
    "redirect" => "verificar-codigo.php"
]);

$sql->close();
$sqlRoles->close();
$conexion->close();
