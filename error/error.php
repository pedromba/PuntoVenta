
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error - PuntoVenta</title>
    <link rel="stylesheet" href="../recursos/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/error.css">
</head>
<body class="error-page">
    <div class="error-container">
        <!-- Fondo animado -->
        <div class="background-animation">
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
            <div class="blob blob-3"></div>
        </div>

        <!-- Contenedor de contenido -->
        <div class="error-wrapper">
            <!-- Header con logo -->
            <div class="error-header">
                <div class="logo-section">
                    <div class="logo-icon">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="5" y="5" width="12" height="12" fill="currentColor" rx="2"/>
                            <rect x="23" y="5" width="12" height="12" fill="currentColor" rx="2"/>
                            <rect x="5" y="23" width="12" height="12" fill="currentColor" rx="2"/>
                            <rect x="23" y="23" width="12" height="12" fill="currentColor" rx="2"/>
                        </svg>
                    </div>
                    <span class="logo-text">PuntoVenta</span>
                </div>
            </div>

            <!-- Contenido principal -->
            <div class="error-content">
                <!-- Icono de error animado -->
                <div class="error-icon-container">
                    <div class="error-icon">
                        <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="50" cy="50" r="45" stroke="currentColor" stroke-width="2" opacity="0.2"/>
                            <circle cx="50" cy="35" r="6" fill="currentColor"/>
                            <line x1="50" y1="45" x2="50" y2="65" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>

                <!-- Código de error dinámico -->
                <div class="error-code-section">
                    <h1 class="error-code" id="error-code">500</h1>
                    <div class="error-status" id="error-status">Error Interno del Servidor</div>
                </div>

                <!-- Mensaje principal -->
                <div class="error-message">
                    <h2 class="error-title">¡Oops! Algo salió mal</h2>
                    <p class="error-description">
                        Parece que encontramos un problema. Nuestro equipo ya está trabajando para solucionarlo.
                    </p>
                </div>

                <!-- Indicador de reconexión -->
                <div class="reconnect-section">
                    <div class="spinner-container" id="spinner-container" style="display: none;">
                        <div class="spinner"></div>
                        <p id="reconnect-text">Intentando reconectar...</p>
                    </div>
                </div>

                <!-- Detalles técnicos (colapsible) -->
                <details class="error-details">
                    <summary>Detalles técnicos</summary>
                    <div class="details-content">
                        <div class="detail-row">
                            <span class="detail-label">Hora:</span>
                            <span class="detail-value" id="error-time">-</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">ID de sesión:</span>
                            <span class="detail-value" id="session-id">-</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Navegador:</span>
                            <span class="detail-value" id="browser-info">-</span>
                        </div>
                    </div>
                </details>

                <!-- Botones de acción -->
                <div class="error-actions">
                    <button class="btn btn-primary" id="btn-refresh" onclick="location.reload()">
                        <span class="btn-icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 10a7 7 0 0110.08-6.98M17 10a7 7 0 01-10.08 6.98" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M17 5v5h-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        Reintentar
                    </button>
                    <button class="btn btn-secondary" id="btn-home" onclick="goHome()">
                        <span class="btn-icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 10l7-7 7 7v8a1 1 0 01-1 1h-3v-5h-6v5H4a1 1 0 01-1-1v-8z" fill="currentColor"/>
                            </svg>
                        </span>
                        Ir al Inicio
                    </button>
                </div>

                <!-- Soporte -->
                <div class="support-section">
                    <p class="support-text">¿Necesitas ayuda?</p>
                    <a href="mailto:soporte@puntoventa.com" class="support-link">Contacta con soporte</a>
                </div>
            </div>

            <!-- Footer -->
            <footer class="error-footer">
                <p>&copy; 2026 PuntoVenta. Todos los derechos reservados.</p>
            </footer>
        </div>
    </div>

    <script src="./js/error.js"></script>
</body>
</html>