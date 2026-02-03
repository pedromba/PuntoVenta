// ==========================================
// LOGIN & REGISTRO FUNCTIONALITY
// ==========================================

document.addEventListener('DOMContentLoaded', () => {
    initIntersectionObserver();
    setupPasswordToggle();
    setupFormValidation();
    setupSubmitHandlers();
});

// ==========================================
// INTERSECTION OBSERVER
// ==========================================

function initIntersectionObserver() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.observe-fade').forEach(el => {
        observer.observe(el);
    });
}

// ==========================================
// PASSWORD TOGGLE - LOGIN FORM
// ==========================================

function setupPasswordToggle() {
    const toggleBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    if (toggleBtn && passwordInput) {
        toggleBtn.addEventListener('click', (e) => {
            e.preventDefault();
            
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            
            toggleBtn.innerHTML = `<i class="fas fa-eye${isPassword ? '-slash' : ''}"></i>`;
        });
    }
}

// ==========================================
// FORM VALIDATION
// ==========================================

function setupFormValidation() {
    // Validación del formulario de Login
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        setupLoginValidation(loginForm);
    }

    // Validación del formulario de Registro
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        setupRegisterValidation(registerForm);
    }
}

function setupLoginValidation(form) {
    form.addEventListener('submit', (e) => {
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }

        form.classList.add('was-validated');

        // Validar email
        const email = document.getElementById('email');
        if (!isValidEmail(email.value)) {
            email.classList.add('is-invalid');
        } else {
            email.classList.remove('is-invalid');
        }

        // Validar contraseña
        const password = document.getElementById('password');
        if (password.value.trim().length < 6) {
            password.classList.add('is-invalid');
        } else {
            password.classList.remove('is-invalid');
        }
    });

    // Limpiar validación al escribir
    form.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('input', () => {
            input.classList.remove('is-invalid');
        });
    });
}

function setupRegisterValidation(form) {
    form.addEventListener('submit', (e) => {
        const companyName = document.getElementById('company-name');
        const nifCif = document.getElementById('nif-cif');
        const contactEmail = document.getElementById('contact-email');
        const phone = document.getElementById('phone');
        const category = document.getElementById('category');
        const terms = document.getElementById('terms');

        let isValid = true;

        // Validar nombre comercial
        if (!companyName.value.trim()) {
            companyName.classList.add('is-invalid');
            isValid = false;
        }

        // Validar NIF/CIF
        if (!nifCif.value.trim()) {
            nifCif.classList.add('is-invalid');
            isValid = false;
        }

        // Validar email de contacto
        if (!isValidEmail(contactEmail.value)) {
            contactEmail.classList.add('is-invalid');
            isValid = false;
        }

        // Validar teléfono si está presente
        if (phone.value.trim() && !isValidPhoneGE(phone.value)) {
            phone.classList.add('is-invalid');
            isValid = false;
        }

        // Validar categoría
        if (!category.value) {
            category.classList.add('is-invalid');
            isValid = false;
        }

        // Validar términos
        if (!terms.checked) {
            terms.classList.add('is-invalid');
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
            e.stopPropagation();
        }

        form.classList.add('was-validated');
    });

    // Limpiar validación al escribir
    form.querySelectorAll('.form-control, .form-select').forEach(input => {
        input.addEventListener('input', () => {
            input.classList.remove('is-invalid');
        });
    });
}

function isValidEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

// Validar formato de teléfono de Guinea Ecuatorial
// Formato: +240 222/555 123456
function isValidPhoneGE(phone) {
    const regex = /^\+240\s(222|555)\s\d{6}$/;
    return regex.test(phone);
}

// ==========================================
// SUBMIT HANDLERS
// ==========================================

function setupSubmitHandlers() {
    // Handler para Login
    const loginForm = document.getElementById('loginForm');
    const submitBtn = document.getElementById('submitBtn');

    if (loginForm && submitBtn) {
        loginForm.addEventListener('submit', handleLoginSubmit);
    }

    // Handler para Registro
    const registerForm = document.getElementById('registerForm');
    const submitBtnRegister = document.getElementById('submitBtnRegister');

    if (registerForm && submitBtnRegister) {
        registerForm.addEventListener('submit', handleRegisterSubmit);
    }
}

function handleLoginSubmit(e) {
    if (!document.getElementById('loginForm').checkValidity()) {
        e.preventDefault();
        return;
    }

    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;

    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');

    if (btnText && btnLoading) {
        btnText.classList.add('d-none');
        btnLoading.classList.remove('d-none');
    }

    // Failsafe: re-habilitar después de 3 segundos
    setTimeout(() => {
        submitBtn.disabled = false;
        if (btnText && btnLoading) {
            btnText.classList.remove('d-none');
            btnLoading.classList.add('d-none');
        }
    }, 3000);
}

function handleRegisterSubmit(e) {
    const registerForm = document.getElementById('registerForm');
    if (!registerForm.checkValidity()) {
        e.preventDefault();
        return;
    }

    const submitBtn = document.getElementById('submitBtnRegister');
    submitBtn.disabled = true;

    const btnText = submitBtn.querySelector('.btn-text');
    const btnLoading = submitBtn.querySelector('.btn-loading');

    if (btnText && btnLoading) {
        btnText.classList.add('d-none');
        btnLoading.classList.remove('d-none');
    }

    // Failsafe: re-habilitar después de 3 segundos
    setTimeout(() => {
        submitBtn.disabled = false;
        if (btnText && btnLoading) {
            btnText.classList.remove('d-none');
            btnLoading.classList.add('d-none');
        }
    }, 3000);
}

// ==========================================
// TECLA ENTER EN PASSWORD
// ==========================================

document.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        if (document.activeElement.id === 'password') {
            document.getElementById('loginForm')?.dispatchEvent(new Event('submit'));
        } else if (document.activeElement.classList.contains('register-input')) {
            // Para cualquier input en el formulario de registro
            const registerForm = document.getElementById('registerForm');
            if (registerForm && registerForm.offsetParent !== null) {
                document.getElementById('submitBtnRegister')?.focus();
            }
        }
    }
});