document.addEventListener('DOMContentLoaded', function() {
    // Mostrar la hora actual en detalles del error
    updateErrorTime();

    // Intentar reconectar automáticamente cada 5 segundos
    setTimeout(() => {
        showLoadingIndicator();
        attemptReconnect();
    }, 3000);

    // Agregar efecto de escriba al código de error
    animateErrorCode();

    // Manejar teclas de atajo
    setupKeyboardShortcuts();
});

/**
 * Actualizar la hora del error
 */
function updateErrorTime() {
    const errorTime = document.getElementById('error-time');
    const now = new Date();
    const timeString = now.toLocaleString('es-ES', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    });
    errorTime.textContent = timeString;
}

/**
 * Mostrar el indicador de carga
 */
function showLoadingIndicator() {
    const loadingIndicator = document.querySelector('.loading-indicator');
    loadingIndicator.classList.add('active');
}

/**
 * Ocultar el indicador de carga
 */
function hideLoadingIndicator() {
    const loadingIndicator = document.querySelector('.loading-indicator');
    loadingIndicator.classList.remove('active');
}

/**
 * Intentar reconectar al servidor
 */
function attemptReconnect() {
    // Hacer un ping al servidor
    fetch(window.location.href, { method: 'HEAD' })
        .then(response => {
            if (response.ok) {
                showSuccessMessage();
                setTimeout(() => {
                    location.reload();
                }, 2000);
            } else {
                hideLoadingIndicator();
            }
        })
        .catch(error => {
            console.log('Servidor aún no disponible, reintentando...');
            hideLoadingIndicator();
            // Reintentar en 5 segundos
            setTimeout(() => {
                showLoadingIndicator();
                attemptReconnect();
            }, 5000);
        });
}

/**
 * Mostrar mensaje de éxito
 */
function showSuccessMessage() {
    const errorContent = document.querySelector('.error-content');
    const successMessage = document.createElement('div');
    successMessage.className = 'success-message';
    successMessage.innerHTML = `
        <div class="success-icon">✓</div>
        <p>¡Servidor recuperado! Redirigiendo...</p>
    `;
    errorContent.appendChild(successMessage);

    // Agregar estilos para el mensaje de éxito
    const style = document.createElement('style');
    style.textContent = `
        .success-message {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(76, 205, 196, 0.95);
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            z-index: 1000;
            animation: scaleIn 0.5s ease-out;
        }
        .success-icon {
            font-size: 60px;
            margin-bottom: 20px;
            animation: bounce 0.6s ease-out;
        }
        @keyframes scaleIn {
            from {
                transform: translate(-50%, -50%) scale(0.8);
                opacity: 0;
            }
            to {
                transform: translate(-50%, -50%) scale(1);
                opacity: 1;
            }
        }
    `;
    document.head.appendChild(style);
}

/**
 * Animar el código de error
 */
function animateErrorCode() {
    const errorCode = document.querySelector('.error-code');
    const digits = errorCode.textContent.split('');
    errorCode.textContent = '';

    digits.forEach((digit, index) => {
        const span = document.createElement('span');
        span.textContent = digit;
        span.style.animation = `fadeIn 0.5s ease-out ${index * 0.1}s both`;
        errorCode.appendChild(span);
    });

    // Agregar animación de escritura
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    `;
    document.head.appendChild(style);
}

/**
 * Navegar al inicio
 */
function goHome() {
    window.location.href = '../index.php';
}

/**
 * Configurar atajos de teclado
 */
function setupKeyboardShortcuts() {
    document.addEventListener('keydown', function(event) {
        // Ctrl + R o Cmd + R para reintentar
        if ((event.ctrlKey || event.metaKey) && event.key === 'r') {
            event.preventDefault();
            location.reload();
        }

        // H para ir al inicio
        if (event.key.toLowerCase() === 'h') {
            goHome();
        }

        // Espacio para reintentar
        if (event.code === 'Space') {
            event.preventDefault();
            showLoadingIndicator();
            attemptReconnect();
        }
    });
}

/**
 * Detectar si el navegador está offline
 */
window.addEventListener('offline', function() {
    const errorContent = document.querySelector('.error-content');
    const offlineMessage = document.createElement('div');
    offlineMessage.className = 'offline-notice';
    offlineMessage.innerHTML = '<p>⚠️ No hay conexión a internet</p>';
    offlineMessage.style.cssText = `
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        background: #ff6b6b;
        color: white;
        padding: 15px 30px;
        border-radius: 50px;
        z-index: 999;
        animation: slideDown 0.5s ease-out;
    `;
    document.body.appendChild(offlineMessage);

    const style = document.createElement('style');
    style.textContent = `
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
});

window.addEventListener('online', function() {
    const offlineNotice = document.querySelector('.offline-notice');
    if (offlineNotice) {
        offlineNotice.remove();
    }
    showLoadingIndicator();
    attemptReconnect();
});