<?php
/**
 * REENVÍO DE CÓDIGO OTP - SISTEMA PUNTOVENTA
 * ===========================================
 * Genera y envía un nuevo código de verificación
 */

include "../../config/conexion.php";
session_start();

// Verificar que el usuario esté en proceso de verificación
if (!isset($_SESSION['temp_usuario_id']) || !isset($_SESSION['temp_email'])) {
    echo json_encode([
        "status" => false, 
        "message" => "Sesión expirada. Por favor, inicia sesión nuevamente.",
        "redirect_login" => true
    ]);
    exit();
}

$usuario_id = $_SESSION['temp_usuario_id'];
$email = $_SESSION['temp_email'];
$nombre = $_SESSION['temp_nombre'];

// Generar nuevo código de 6 dígitos
$codigo_otp = sprintf("%06d", mt_rand(0, 999999));

// Hashear el código
$codigo_hash = password_hash($codigo_otp, PASSWORD_DEFAULT);

// Calcular tiempo de expiración (10 minutos)
$expira_at = date('Y-m-d H:i:s', strtotime('+10 minutes'));

// Invalidar códigos anteriores no usados
$sqlInvalidar = $conexion->prepare("UPDATE verificaciones_login SET usado = 1 WHERE usuario_id = ? AND usado = 0");
$sqlInvalidar->bind_param("i", $usuario_id);
$sqlInvalidar->execute();
$sqlInvalidar->close();

// Insertar nuevo código
$sqlInsert = $conexion->prepare("INSERT INTO verificaciones_login (usuario_id, codigo_otp, expira_at) VALUES (?, ?, ?)");
$sqlInsert->bind_param("iss", $usuario_id, $codigo_hash, $expira_at);

if (!$sqlInsert->execute()) {
    echo json_encode(["status" => false, "message" => "Error al generar nuevo código."]);
    exit();
}
$sqlInsert->close();

// Enviar email con el nuevo código usando PHPMailer
require_once 'enviar_email.php';
$email_enviado = enviarCodigoVerificacionPHPMailer($email, $nombre, $codigo_otp);

if (!$email_enviado) {
    echo json_encode(["status" => false, "message" => "Error al enviar el código. Intente nuevamente."]);
    exit();
}

echo json_encode([
    "status" => true,
    "message" => "Nuevo código enviado a tu email. Revisa tu bandeja de entrada."
]);

$conexion->close();
