// ==========================================
// LOGIN & REGISTRO FUNCTIONALITY
// ==========================================

document.addEventListener('DOMContentLoaded', () => {
    initIntersectionObserver();
    setupPasswordToggle();
    setupFormValidation();
    setupSubmitHandlers();
    setupLogoUpload();
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
// LOGO UPLOAD HANDLER
// ==========================================

function setupLogoUpload() {
    const logoInput = document.getElementById('logo-input');
    const logoPreview = document.getElementById('logoPreview');
    const logoFileName = document.getElementById('logoFileName');

    if (!logoInput) return;

    // Manejar clic en el input de archivo
    logoInput.addEventListener('change', (e) => {
        handleLogoFile(e.target.files[0], logoPreview, logoFileName);
    });

    // Manejar drag and drop
    const logoLabel = document.querySelector('.logo-upload-label');
    if (logoLabel) {
        logoLabel.addEventListener('dragover', (e) => {
            e.preventDefault();
            logoPreview.style.borderColor = 'var(--primary)';
            logoPreview.style.background = 'linear-gradient(135deg, rgba(37, 99, 235, 0.2) 0%, rgba(14, 165, 233, 0.15) 100%)';
        });

        logoLabel.addEventListener('dragleave', () => {
            logoPreview.style.borderColor = 'var(--border-color)';
            logoPreview.style.background = 'linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(14, 165, 233, 0.08) 100%)';
        });

        logoLabel.addEventListener('drop', (e) => {
            e.preventDefault();
            logoPreview.style.borderColor = 'var(--border-color)';
            logoPreview.style.background = 'linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(14, 165, 233, 0.08) 100%)';
            
            if (e.dataTransfer.files.length > 0) {
                const file = e.dataTransfer.files[0];
                logoInput.files = e.dataTransfer.files;
                handleLogoFile(file, logoPreview, logoFileName);
            }
        });
    }
}

function handleLogoFile(file, logoPreview, logoFileName) {
    if (!file) return;

    // Validar que sea una imagen
    if (!file.type.startsWith('image/')) {
        alert('Por favor selecciona un archivo de imagen');
        return;
    }

    // Validar tamaño (máximo 5MB)
    const maxSize = 5 * 1024 * 1024;
    if (file.size > maxSize) {
        alert('El archivo debe pesar menos de 5MB');
        return;
    }

    // Mostrar preview
    const reader = new FileReader();
    reader.onload = (e) => {
        logoPreview.innerHTML = `<img src="${e.target.result}" alt="Logo">`;
    };
    reader.readAsDataURL(file);

    // Mostrar nombre del archivo
    if (logoFileName) {
        logoFileName.textContent = file.name;
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
        const termsWrapper = document.querySelector('.register-terms');

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
            if (termsWrapper) {
                termsWrapper.classList.add('is-invalid');
            }
            terms.classList.add('is-invalid');
            isValid = false;
        } else {
            if (termsWrapper) {
                termsWrapper.classList.remove('is-invalid');
            }
            terms.classList.remove('is-invalid');
        }

        if (!isValid) {
            e.preventDefault();
            e.stopPropagation();
        }

        form.classList.add('was-validated');
    });

    // Limpiar validación al escribir/cambiar
    form.querySelectorAll('.form-control, .form-select').forEach(input => {
        input.addEventListener('input', () => {
            input.classList.remove('is-invalid');
        });
    });

    // Limpiar validación del checkbox de términos
    const terms = document.getElementById('terms');
    if (terms) {
        terms.addEventListener('change', () => {
            const termsWrapper = document.querySelector('.register-terms');
            if (terms.checked) {
                if (termsWrapper) {
                    termsWrapper.classList.remove('is-invalid');
                }
                terms.classList.remove('is-invalid');
            }
        });
    }
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