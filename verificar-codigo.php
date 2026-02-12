<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Código - PuntoVenta</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="recursos/css/sweetalert2.css">
    <link rel="stylesheet" href="./recursos/css/verificacionEmail.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="icon">🔐</div>
            <h1>Verificación de Código</h1>
            <p>Ingresa el código de 6 dígitos que enviamos a tu correo electrónico</p>
        </div>

        <div class="email-display" id="emailDisplay">
            📧 Código enviado a tu email
        </div>

        <form id="formVerificacion" onsubmit="event.preventDefault(); verificarCodigo();">
            <div class="code-inputs">
                <input type="text" maxlength="1" class="code-input" id="code1" autocomplete="off" autofocus>
                <input type="text" maxlength="1" class="code-input" id="code2" autocomplete="off">
                <input type="text" maxlength="1" class="code-input" id="code3" autocomplete="off">
                <input type="text" maxlength="1" class="code-input" id="code4" autocomplete="off">
                <input type="text" maxlength="1" class="code-input" id="code5" autocomplete="off">
                <input type="text" maxlength="1" class="code-input" id="code6" autocomplete="off">
            </div>

            <div class="timer" id="timer">
                ⏱️ El código expira en: <span id="countdown">10:00</span>
            </div>

            <div class="info-box">
                💡 <strong>Consejo:</strong> Revisa tu carpeta de spam si no ves el email
            </div>

            <button type="submit" class="btn btn-primary" id="btnVerificar">
                Verificar Código
            </button>

            <div class="loader" id="loader"></div>
        </form>

        <div class="resend-section">
            <p>¿No recibiste el código?</p>
            <button type="button" class="link-button" id="btnReenviar" onclick="reenviarCodigo()">
                Reenviar código
            </button>
            <span id="resendTimer" style="display: none; color: #64748b; font-size: 13px; margin-left: 10px;">
                (Disponible en <span id="resendCountdown">60</span>s)
            </span>
        </div>

        <!-- Opción para volver al login -->
        <div style="text-align: center; margin-top: 20px;">
            <a href="index.php" style="color: #64748b; font-size: 13px; text-decoration: none;">
                ← Volver al inicio de sesión
            </a>
        </div>
    </div>

    <script src="recursos/js/sweetalert2.all.js"></script>
   <script src="./recursos/js/verificaionEmail.js"></script>
</body>
</html>
