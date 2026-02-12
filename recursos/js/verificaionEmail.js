
// Configurar inputs de código
const inputs = document.querySelectorAll('.code-input');

inputs.forEach((input, index) => {
    input.addEventListener('input', (e) => {
        const value = e.target.value;

        // Solo permitir números
        if (!/^\d$/.test(value)) {
            e.target.value = '';
            return;
        }

        // Añadir clase de relleno
        e.target.classList.add('filled');

        // Mover al siguiente input
        if (value && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }

        // Si llenó el último, verificar automáticamente
        if (index === inputs.length - 1 && value) {
            setTimeout(() => verificarCodigo(), 300);
        }
    });

    input.addEventListener('keydown', (e) => {
        // Manejar backspace
        if (e.key === 'Backspace' && !e.target.value && index > 0) {
            inputs[index - 1].focus();
            inputs[index - 1].value = '';
            inputs[index - 1].classList.remove('filled');
        }

        // Manejar flechas
        if (e.key === 'ArrowLeft' && index > 0) {
            inputs[index - 1].focus();
        }
        if (e.key === 'ArrowRight' && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }
    });

    // Manejar paste
    input.addEventListener('paste', (e) => {
        e.preventDefault();
        const pastedData = e.clipboardData.getData('text').slice(0, 6);
        const digits = pastedData.match(/\d/g);

        if (digits) {
            digits.forEach((digit, i) => {
                if (i < inputs.length) {
                    inputs[i].value = digit;
                    inputs[i].classList.add('filled');
                }
            });

            if (digits.length === 6) {
                setTimeout(() => verificarCodigo(), 300);
            }
        }
    });
});

// Temporizador de expiración (10 minutos)
let timeLeft = 600; // 10 minutos en segundos
const countdownElement = document.getElementById('countdown');
const timerElement = document.getElementById('timer');

const timerInterval = setInterval(() => {
    timeLeft--;

    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    countdownElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;

    if (timeLeft <= 60) {
        timerElement.classList.add('warning');
    }

    if (timeLeft <= 0) {
        clearInterval(timerInterval);
        Swal.fire({
            icon: 'error',
            title: 'Código expirado',
            text: 'El código ha expirado. Por favor, solicita uno nuevo.',
            confirmButtonText: 'Reenviar código'
        }).then(() => {
            reenviarCodigo();
        });
    }
}, 1000);

// Función para verificar el código
async function verificarCodigo() {
    const codigo = Array.from(inputs).map(i => i.value).join('');

    if (codigo.length !== 6) {
        Swal.fire({
            icon: 'warning',
            title: 'Código incompleto',
            text: 'Por favor, ingresa los 6 dígitos del código',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        return;
    }

    // Mostrar loader
    document.getElementById('btnVerificar').style.display = 'none';
    document.getElementById('loader').style.display = 'block';

    try {
        const formData = new FormData();
        formData.append('codigo', codigo);

        const response = await fetch('recursos/php/verificar_codigo.php', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        if (data.status) {
            clearInterval(timerInterval);

            // Mostrar mensaje de éxito breve y redirigir automáticamente
            Swal.fire({
                icon: 'success',
                title: '¡Verificación exitosa!',
                text: 'Redirigiendo a tu dashboard...',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true
            });

            // Redirigir automáticamente después de 1.5 segundos
            setTimeout(() => {
                window.location.href = data.redirect;
            }, 1500);
        } else {
            // Código incorrecto
            inputs.forEach(input => {
                input.value = '';
                input.classList.remove('filled');
            });
            inputs[0].focus();

            Swal.fire({
                icon: 'error',
                title: 'Código incorrecto',
                text: data.message,
                confirmButtonText: 'Intentar de nuevo'
            });

            document.getElementById('btnVerificar').style.display = 'block';
            document.getElementById('loader').style.display = 'none';

            if (data.redirect_login) {
                setTimeout(() => {
                    window.location.href = 'index.php';
                }, 2000);
            }
        }
    } catch (error) {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error de conexión',
            text: 'No se pudo verificar el código. Intenta nuevamente.',
            confirmButtonText: 'OK'
        });

        document.getElementById('btnVerificar').style.display = 'block';
        document.getElementById('loader').style.display = 'none';
    }
}

// Función para reenviar código
let resendCooldown = 0;
let resendInterval;

async function reenviarCodigo() {
    if (resendCooldown > 0) {
        return;
    }

    const btnReenviar = document.getElementById('btnReenviar');
    btnReenviar.disabled = true;

    try {
        const response = await fetch('recursos/php/reenviar_codigo.php', {
            method: 'POST'
        });

        const data = await response.json();

        if (data.status) {
            // Resetear temporizador
            timeLeft = 600;
            timerElement.classList.remove('warning');

            // Limpiar inputs
            inputs.forEach(input => {
                input.value = '';
                input.classList.remove('filled');
            });
            inputs[0].focus();

            Swal.fire({
                icon: 'success',
                title: '¡Código reenviado!',
                text: data.message,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000
            });

            // Cooldown de 60 segundos
            resendCooldown = 60;
            document.getElementById('resendTimer').style.display = 'inline';

            resendInterval = setInterval(() => {
                resendCooldown--;
                document.getElementById('resendCountdown').textContent = resendCooldown;

                if (resendCooldown <= 0) {
                    clearInterval(resendInterval);
                    document.getElementById('resendTimer').style.display = 'none';
                    btnReenviar.disabled = false;
                }
            }, 1000);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message,
                confirmButtonText: 'OK'
            });

            btnReenviar.disabled = false;

            if (data.redirect_login) {
                setTimeout(() => {
                    window.location.href = 'index.php';
                }, 2000);
            }
        }
    } catch (error) {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error de conexión',
            text: 'No se pudo reenviar el código. Intenta nuevamente.',
            confirmButtonText: 'OK'
        });

        btnReenviar.disabled = false;
    }
}

// Verificar si hay sesión válida al cargar
window.addEventListener('DOMContentLoaded', () => {
    fetch('recursos/php/verificar_codigo.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'check_session=1'
    })
        .then(r => r.json())
        .then(data => {
            if (data.redirect_login) {
                window.location.href = 'index.php';
            }
        })
        .catch(err => console.error('Error verificando sesión:', err));
});
