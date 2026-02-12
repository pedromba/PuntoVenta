<?php

/**
 * Enviar código de verificación por email
 * 
 * @param string $email_destino Email del usuario
 * @param string $nombre_usuario Nombre del usuario
 * @param string $codigo Código OTP de 6 dígitos
 * @return bool True si se envió correctamente
 */
function enviarCodigoVerificacion($email_destino, $nombre_usuario, $codigo) {
    $asunto = "Código de Verificación - PuntoVenta";
    
    $mensaje = "
    <!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <style>
            body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
            .container { max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
            .header { background: linear-gradient(135deg, #2563eb 0%, #0ea5e9 100%); color: white; padding: 30px; text-align: center; }
            .header h1 { margin: 0; font-size: 28px; }
            .content { padding: 40px 30px; }
            .code-box { background: #f8fafc; border: 2px dashed #cbd5e1; border-radius: 8px; padding: 25px; text-align: center; margin: 30px 0; }
            .code { font-size: 36px; font-weight: bold; letter-spacing: 8px; color: #2563eb; font-family: 'Courier New', monospace; }
            .info-box { background: #eff6ff; border-left: 4px solid #3b82f6; padding: 15px; margin: 20px 0; border-radius: 4px; }
            .footer { background: #f8fafc; padding: 20px; text-align: center; font-size: 12px; color: #64748b; }
            .btn { display: inline-block; background: #2563eb; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; margin: 20px 0; }
            .warning { color: #dc2626; font-weight: bold; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h1>🔐 PuntoVenta</h1>
                <p>Sistema de Verificación</p>
            </div>
            <div class='content'>
                <h2>Hola, {$nombre_usuario}</h2>
                <p>Has solicitado acceder a tu cuenta. Por seguridad, necesitamos verificar tu identidad.</p>
                
                <div class='code-box'>
                    <p style='margin: 0 0 10px 0; color: #64748b; font-size: 14px;'>Tu código de verificación es:</p>
                    <div class='code'>{$codigo}</div>
                </div>
                
                <div class='info-box'>
                    <p style='margin: 0;'><strong>⏰ Este código expira en 10 minutos</strong></p>
                </div>
                
                <p>Ingresa este código en la página de verificación para continuar.</p>
                
                <p class='warning'>⚠️ Si no solicitaste este código, ignora este mensaje y tu cuenta permanecerá segura.</p>
                
                <hr style='border: none; border-top: 1px solid #e2e8f0; margin: 30px 0;'>
                
                <p style='font-size: 13px; color: #64748b;'>
                    <strong>Consejos de seguridad:</strong><br>
                    • Nunca compartas este código con nadie<br>
                    • El equipo de PuntoVenta nunca te pedirá este código<br>
                    • Si recibes este email sin haberlo solicitado, contacta al administrador
                </p>
            </div>
            <div class='footer'>
                <p>&copy; 2026 PuntoVenta. Sistema Integral de Gestión Comercial</p>
                <p>Este es un correo automático, por favor no respondas a este mensaje.</p>
            </div>
        </div>
    </body>
    </html>
    ";
    
    // Cabeceras para HTML
    $cabeceras = "MIME-Version: 1.0\r\n";
    $cabeceras .= "Content-type: text/html; charset=UTF-8\r\n";
    $cabeceras .= "From: PuntoVenta <noreply@puntoventa.com>\r\n";
    $cabeceras .= "Reply-To: soporte@puntoventa.com\r\n";
    
    // Intentar enviar el email
    return mail($email_destino, $asunto, $mensaje, $cabeceras);
}

/**
 * Enviar código de verificación usando PHPMailer con Composer
 * Esta es la función principal que se debe usar
 */
function enviarCodigoVerificacionPHPMailer($email_destino, $nombre_usuario, $codigo) {
    // Cargar autoload de Composer
    require_once __DIR__ . '/../libs/vendor/autoload.php';
    
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    
    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // CONFIGURA TU SERVIDOR SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'pmba098@gmail.com'; // CONFIGURA TU EMAIL
        $mail->Password = 'xlbataafqvkmrjiq'; // CONFIGURA TU CONTRASEÑA
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; // Puerto SMTP (587 para TLS, 465 para SSL)
        $mail->CharSet = 'UTF-8';
        
        // Remitente y destinatario
        $mail->setFrom('noreply@puntoventa.com', 'PuntoVenta');
        $mail->addAddress($email_destino, $nombre_usuario);
        
        // Contenido del email
        $mail->isHTML(true);
        $mail->Subject = 'Código de Verificación - PuntoVenta';
        $mail->Body = "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <style>
                body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
                .container { max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
                .header { background: linear-gradient(135deg, #2563eb 0%, #0ea5e9 100%); color: white; padding: 30px; text-align: center; }
                .header h1 { margin: 0; font-size: 28px; }
                .content { padding: 40px 30px; }
                .code-box { background: #f8fafc; border: 2px dashed #cbd5e1; border-radius: 8px; padding: 25px; text-align: center; margin: 30px 0; }
                .code { font-size: 36px; font-weight: bold; letter-spacing: 8px; color: #2563eb; font-family: 'Courier New', monospace; }
                .info-box { background: #eff6ff; border-left: 4px solid #3b82f6; padding: 15px; margin: 20px 0; border-radius: 4px; }
                .footer { background: #f8fafc; padding: 20px; text-align: center; font-size: 12px; color: #64748b; }
                .warning { color: #dc2626; font-weight: bold; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h1>🔐 PuntoVenta</h1>
                    <p>Sistema de Verificación</p>
                </div>
                <div class='content'>
                    <h2>Hola, {$nombre_usuario}</h2>
                    <p>Has solicitado acceder a tu cuenta. Por seguridad, necesitamos verificar tu identidad.</p>
                    
                    <div class='code-box'>
                        <p style='margin: 0 0 10px 0; color: #64748b; font-size: 14px;'>Tu código de verificación es:</p>
                        <div class='code'>{$codigo}</div>
                    </div>
                    
                    <div class='info-box'>
                        <p style='margin: 0;'><strong>⏰ Este código expira en 10 minutos</strong></p>
                    </div>
                    
                    <p>Ingresa este código en la página de verificación para continuar.</p>
                    
                    <p class='warning'>⚠️ Si no solicitaste este código, ignora este mensaje y tu cuenta permanecerá segura.</p>
                    
                    <hr style='border: none; border-top: 1px solid #e2e8f0; margin: 30px 0;'>
                    
                    <p style='font-size: 13px; color: #64748b;'>
                        <strong>Consejos de seguridad:</strong><br>
                        • Nunca compartas este código con nadie<br>
                        • El equipo de PuntoVenta nunca te pedirá este código<br>
                        • Si recibes este email sin haberlo solicitado, contacta al administrador
                    </p>
                </div>
                <div class='footer'>
                    <p>&copy; 2026 PuntoVenta. Sistema Integral de Gestión Comercial</p>
                    <p>Este es un correo automático, por favor no respondas a este mensaje.</p>
                </div>
            </div>
        </body>
        </html>
        ";
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Error al enviar email con PHPMailer: {$mail->ErrorInfo}");
        return false;
    }
}
