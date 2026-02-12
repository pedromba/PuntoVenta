/**
 * PuntoVenta - Error Page Manager
 * Gestiona la página de errores del sistema
 */

document.addEventListener('DOMContentLoaded', function() {
    initializeErrorPage();
});

/**
 * Inicializar la página de error
 */
function initializeErrorPage() {
    // Establecer hora del error
    updateErrorTime();

    // Generar ID de sesión
    generateSessionId();

    // Obtener información del navegador
    setBrowserInfo();

    // Detectar código de error de URL
    detectErrorCode();

    // Configurar atajos de teclado
    setupKeyboardShortcuts();

    // Intentar reconectar después de 3 segundos
    setTimeout(() => {
        attemptAutoReconnect();
    }, 3000);

    // Detectar conexión de internet
    monitorConnectivity();
}

/**
 * Actualizar la hora del error
 */
function updateErrorTime() {
    const errorTimeElement = document.getElementById('error-time');
    if (errorTimeElement) {
        const now = new Date();
        const timeString = now.toLocaleString('es-ES', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
        errorTimeElement.textContent = timeString;
    }
}

/**
 * Generar ID de sesión único
 */
function generateSessionId() {
    const sessionIdElement = document.getElementById('session-id');
    if (sessionIdElement) {
        const sessionId = 'SES-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9).toUpperCase();
        sessionIdElement.textContent = sessionId;
        // Guardar en sessionStorage
        sessionStorage.setItem('error_session_id', sessionId);
    }
}

/**
 * Establecer información del navegador
 */
function setBrowserInfo() {
    const browserElement = document.getElementById('browser-info');
    if (browserElement) {
        const userAgent = navigator.userAgent;
        let browserName = 'Desconocido';
        let browserVersion = '';

        if (userAgent.indexOf('Firefox') > -1) {
            browserName = 'Firefox';
            browserVersion = userAgent.match(/Firefox\/(\d+)/)?.[1] || '';
        } else if (userAgent.indexOf('Chrome') > -1) {
            browserName = 'Chrome';
            browserVersion = userAgent.match(/Chrome\/(\d+)/)?.[1] || '';
        } else if (userAgent.indexOf('Safari') > -1) {
            browserName = 'Safari';
            browserVersion = userAgent.match(/Version\/(\d+)/)?.[1] || '';
        } else if (userAgent.indexOf('Edge') > -1) {
            browserName = 'Edge';
            browserVersion = userAgent.match(/Edg\/(\d+)/)?.[1] || '';
        }

        const osName = getOperatingSystem();
        browserElement.textContent = `${browserName} ${browserVersion} - ${osName}`;
    }
}

/**
 * Obtener nombre del sistema operativo
 */
function getOperatingSystem() {
    const userAgent = navigator.userAgent;

    if (userAgent.indexOf('Win') > -1) return 'Windows';
    if (userAgent.indexOf('Mac') > -1) return 'macOS';
    if (userAgent.indexOf('Linux') > -1) return 'Linux';
    if (userAgent.indexOf('Android') > -1) return 'Android';
    if (userAgent.indexOf('iPhone') > -1 || userAgent.indexOf('iPad') > -1) return 'iOS';

    return 'Desconocido';
}

/**
 * Detectar código de error de URL
 */
function detectErrorCode() {
    const urlParams = new URLSearchParams(window.location.search);
    const errorCode = urlParams.get('code') || '500';
    const errorStatus = urlParams.get('status') || null;
    const customMessage = urlParams.get('msg') || null;
    const debugInfo = urlParams.get('debug') || null;

    const errorCodeElement = document.getElementById('error-code');
    const errorStatusElement = document.getElementById('error-status');
    const errorDescriptionElement = document.querySelector('.error-description');

    if (errorCodeElement) {
        errorCodeElement.textContent = errorCode;
    }

    if (errorStatusElement) {
        errorStatusElement.textContent = errorStatus || getErrorMessage(errorCode);
    }

    // Mostrar mensaje personalizado si existe
    if (customMessage && errorDescriptionElement) {
        errorDescriptionElement.textContent = decodeURIComponent(customMessage);
    }

    // Mostrar información de debug si existe
    if (debugInfo) {
        const detailsContent = document.querySelector('.details-content');
        if (detailsContent) {
            const debugRow = document.createElement('div');
            debugRow.className = 'detail-row';
            debugRow.innerHTML = `
                <span class="detail-label">Debug:</span>
                <span class="detail-value" style="color: #dc2626; font-family: monospace; font-size: 0.875rem;">${decodeURIComponent(debugInfo)}</span>
            `;
            detailsContent.appendChild(debugRow);
        }
    }

    // Actualizar favicon y título
    updatePageTitle(errorCode);
}

/**
 * Obtener mensaje de error según el código
 */
function getErrorMessage(code, defaultMessage = 'Error Interno del Servidor') {
    const errorMessages = {
        '400': 'Solicitud Inválida',
        '401': 'No Autorizado',
        '403': 'Acceso Prohibido',
        '404': 'Página No Encontrada',
        '408': 'Tiempo de Espera Agotado',
        '429': 'Demasiadas Solicitudes',
        '500': 'Error Interno del Servidor',
        '502': 'Puerta de Enlace Incorrecta',
        '503': 'Servicio No Disponible',
        '504': 'Tiempo de Espera de la Puerta de Enlace'
    };

    return errorMessages[code] || defaultMessage;
}

/**
 * Actualizar título de la página
 */
function updatePageTitle(errorCode) {
    document.title = `Error ${errorCode} - PuntoVenta`;
}

/**
 * Intentar reconectar automáticamente
 */
function attemptAutoReconnect() {
    const spinnerContainer = document.getElementById('spinner-container');

    if (spinnerContainer) {
        spinnerContainer.style.display = 'block';
    }

    attemptReconnect();
}

/**
 * Intentar reconectar al servidor
 */
function attemptReconnect() {
    const reconnectText = document.getElementById('reconnect-text');

    fetch(window.location.href, {
        method: 'HEAD',
        cache: 'no-cache'
    })
        .then(response => {
            if (response.ok || response.status < 500) {
                showSuccessMessage();
                setTimeout(() => {
                    location.reload();
                }, 2000);
            } else {
                hideSpinner();
                scheduleNextAttempt();
            }
        })
        .catch(error => {
            console.log('Servidor no disponible, próximo intento en 5 segundos...');
            hideSpinner();
            scheduleNextAttempt();
        });
}

/**
 * Ocultar spinner de carga
 */
function hideSpinner() {
    const spinnerContainer = document.getElementById('spinner-container');
    if (spinnerContainer) {
        spinnerContainer.style.display = 'none';
    }
}

/**
 * Programar siguiente intento de reconexión
 */
function scheduleNextAttempt() {
    setTimeout(() => {
        const spinnerContainer = document.getElementById('spinner-container');
        if (spinnerContainer) {
            spinnerContainer.style.display = 'block';
        }
        attemptReconnect();
    }, 5000);
}

/**
 * Mostrar mensaje de éxito
 */
function showSuccessMessage() {
    const successElement = document.createElement('div');
    successElement.className = 'success-overlay';
    successElement.innerHTML = `
        <div class="success-message">
            <div class="success-icon">
                <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 16.2L4.8 12m0 0l-1.4 1.4M4.8 12L9 16.2m0 0l10-10M9 16.2l10-10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <p>¡Servidor recuperado!</p>
            <p class="subtitle">Redirigiendo...</p>
        </div>
    `;

    document.body.appendChild(successElement);

    const style = document.createElement('style');
    style.textContent = `
        .success-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(15, 23, 42, 0.95);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            animation: fadeIn 0.3s ease-out;
        }

        .success-message {
            text-align: center;
            color: white;
        }

        .success-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #10b981, #059669);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            animation: scaleIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .success-icon svg {
            width: 50%;
            height: 50%;
        }

        .success-message p {
            font-size: 20px;
            font-weight: 600;
            margin: 10px 0;
        }

        .success-message .subtitle {
            font-size: 14px;
            color: #94a3b8;
            margin-top: 15px;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    `;
    document.head.appendChild(style);
}

/**
 * Navegar al inicio
 */
function goHome() {
    const redirectUrl = sessionStorage.getItem('error_redirect') || '../index.php';
    window.location.href = redirectUrl;
}

/**
 * Configurar atajos de teclado
 */
function setupKeyboardShortcuts() {
    document.addEventListener('keydown', function(event) {
        // Ctrl/Cmd + R para reintentar
        if ((event.ctrlKey || event.metaKey) && event.key === 'r') {
            event.preventDefault();
            location.reload();
        }

        // H para ir al inicio
        if (event.key.toLowerCase() === 'h' && !event.ctrlKey && !event.metaKey) {
            goHome();
        }

        // Espacio para reintentar (solo si no está en un input)
        if (event.code === 'Space' && event.target === document.body) {
            event.preventDefault();
            const spinnerContainer = document.getElementById('spinner-container');
            if (spinnerContainer) {
                spinnerContainer.style.display = 'block';
            }
            attemptReconnect();
        }

        // Escape para ir al inicio
        if (event.key === 'Escape') {
            goHome();
        }
    });
}

/**
 * Monitorear conectividad de red
 */
function monitorConnectivity() {
    const noticeId = 'connectivity-notice';

    window.addEventListener('offline', function() {
        removeConnectivityNotice(noticeId);

        const notice = document.createElement('div');
        notice.id = noticeId;
        notice.className = 'connectivity-notice offline';
        notice.innerHTML = `
            <span class="notice-icon">⚠️</span>
            <span>Sin conexión a internet</span>
        `;

        document.body.appendChild(notice);
    });

    window.addEventListener('online', function() {
        removeConnectivityNotice(noticeId);

        const notice = document.createElement('div');
        notice.id = noticeId;
        notice.className = 'connectivity-notice online';
        notice.innerHTML = `
            <span class="notice-icon">✓</span>
            <span>Conexión restaurada</span>
        `;

        document.body.appendChild(notice);

        setTimeout(() => {
            removeConnectivityNotice(noticeId);
        }, 3000);

        // Intentar reconectar
        const spinnerContainer = document.getElementById('spinner-container');
        if (spinnerContainer) {
            spinnerContainer.style.display = 'block';
        }
        attemptReconnect();
    });

    const style = document.createElement('style');
    style.textContent = `
        .connectivity-notice {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            z-index: 1999;
            display: flex;
            align-items: center;
            gap: 8px;
            animation: slideDown 0.3s ease-out;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .connectivity-notice.offline {
            background: #dc2626;
            color: white;
        }

        .connectivity-notice.online {
            background: #10b981;
            color: white;
        }

        .notice-icon {
            font-size: 16px;
        }

        @keyframes slideDown {
            from {
                transform: translateX(-50%) translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateX(-50%) translateY(0);
                opacity: 1;
            }
        }
    `;
    document.head.appendChild(style);
}

/**
 * Remover noticia de conectividad
 */
function removeConnectivityNotice(id) {
    const notice = document.getElementById(id);
    if (notice) {
        notice.style.animation = 'slideUp 0.3s ease-out forwards';
        setTimeout(() => notice.remove(), 300);
    }
}

// Añadir animación slideUp si no existe
if (!document.querySelector('style[data-connectivity]')) {
    const style = document.createElement('style');
    style.setAttribute('data-connectivity', 'true');
    style.textContent = `
        @keyframes slideUp {
            to {
                transform: translateX(-50%) translateY(-20px);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
}