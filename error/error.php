
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error del Servidor - PuntoVenta</title>
    <link rel="stylesheet" href="../recursos/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/error.css">
</head>
<body class="error-page">
    <div class="error-container">
        <!-- Animación de fondo -->
        <div class="background-animation">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>

        <!-- Contenedor principal -->
        <div class="error-content">
            <!-- Código de error -->
            <div class="error-code-wrapper">
                <h1 class="error-code" data-error="500">500</h1>
                <div class="error-icon">
                    <i class="icon-server"></i>
                </div>
            </div>

            <!-- Mensaje de error -->
            <div class="error-message">
                <h2>¡Oops! Error del Servidor</h2>
                <p class="error-description">
                    Lo sentimos, algo ha salido mal en nuestro servidor. 
                    Estamos trabajando para resolverlo lo antes posible.
                </p>
            </div>

            <!-- Detalles técnicos (opcional) -->
            <div class="error-details">
                <div class="detail-item">
                    <span class="detail-label">Estado:</span>
                    <span class="detail-value">Error Interno del Servidor (500)</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Hora:</span>
                    <span class="detail-value" id="error-time"></span>
                </div>
            </div>

            <!-- Indicador de carga -->
            <div class="loading-indicator">
                <div class="spinner"></div>
                <p>Intentando reconectar...</p>
            </div>

            <!-- Botones de acción -->
            <div class="error-actions">
                <button class="btn btn-primary btn-lg" id="btn-refresh" onclick="location.reload()">
                    <span class="btn-icon">🔄</span>
                    Reintentar
                </button>
                <button class="btn btn-secondary btn-lg" id="btn-home" onclick="goHome()">
                    <span class="btn-icon">🏠</span>
                    Ir al Inicio
                </button>
            </div>

            <!-- Información de soporte -->
            <div class="support-info">
                <p>Si el problema persiste, contacte con</p>
                <a href="mailto:soporte@puntoventa.com" class="support-link">nuestro equipo de soporte</a>
            </div>
        </div>

        <!-- Footer -->
        <footer class="error-footer">
            <p>&copy; 2026 PuntoVenta. Todos los derechos reservados.</p>
        </footer>
    </div>

    <script src="./js/error.js"></script>
</body>
</html>