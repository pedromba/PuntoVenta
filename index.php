<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>Punto de Venta - Login & Registro</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="./recursos/css/estilosLogin.css">
</head>
<body>
    <div class="container-fluid login-container">
        <div class="row h-100">
            <!-- Columna Izquierda - Información y Branding -->
            <div class="col-lg-6 col-md-12 info-section d-flex flex-column justify-content-center">
                <div class="info-content observe-fade">
                    <!-- Logo -->
                    <div class="logo-section mb-5">
                        <div class="logo-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h1 class="brand-title">Punto de Venta</h1>
                        <p class="brand-subtitle">Sistema Integral de Gestión Comercial</p>
                    </div>

                    <!-- Descripción -->
                    <div class="description-section mb-5">
                        <h3 class="section-title">Bienvenido a tu solución comercial</h3>
                        <p class="section-text">
                            Gestiona tu negocio de forma eficiente con nuestro sistema de punto de venta integral. 
                            Controla inventario, ventas y reportes en tiempo real.
                        </p>
                    </div>

                    <!-- Características -->
                    <div class="features-grid mb-4">
                        <div class="feature-card observe-fade">
                            <div class="feature-icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <div class="feature-text">
                                <h5>Reportes Avanzados</h5>
                                <p>Analiza tus ventas con gráficos y estadísticas en tiempo real</p>
                            </div>
                        </div>

                        <div class="feature-card observe-fade">
                            <div class="feature-icon">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <div class="feature-text">
                                <h5>Control de Inventario</h5>
                                <p>Gestiona tu stock y recibe alertas de productos bajos</p>
                            </div>
                        </div>

                        <div class="feature-card observe-fade">
                            <div class="feature-icon">
                                <i class="fas fa-users-cog"></i>
                            </div>
                            <div class="feature-text">
                                <h5>Gestión de Usuarios</h5>
                                <p>Control total de permisos y roles de acceso</p>
                            </div>
                        </div>

                        <div class="feature-card observe-fade">
                            <div class="feature-icon">
                                <i class="fas fa-lock-open"></i>
                            </div>
                            <div class="feature-text">
                                <h5>Seguridad Certificada</h5>
                                <p>Encriptación avanzada y autenticación segura</p>
                            </div>
                        </div>
                    </div>

                    <!-- Estadísticas -->
                    <div class="stats-section">
                        <div class="stat-item">
                            <span class="stat-number">5000+</span>
                            <span class="stat-label">Usuarios Activos</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">99.9%</span>
                            <span class="stat-label">Disponibilidad</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">24/7</span>
                            <span class="stat-label">Soporte Técnico</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Columna Derecha - Formularios -->
            <div class="col-lg-6 col-md-12 login-section d-flex align-items-center justify-content-center">
                <div class="login-wrapper observe-fade">
                    <!-- Card del Formulario -->
                    <div class="login-card">
                        <!-- Tabs Navigation -->
                        <ul class="nav nav-pills form-tabs mb-4" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button 
                                    class="nav-link active" 
                                    id="tab-login" 
                                    data-bs-toggle="tab" 
                                    data-bs-target="#content-login" 
                                    type="button" 
                                    role="tab"
                                >
                                    <i class="fas fa-sign-in-alt me-2"></i>Acceso
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button 
                                    class="nav-link" 
                                    id="tab-register" 
                                    data-bs-toggle="tab" 
                                    data-bs-target="#content-register" 
                                    type="button" 
                                    role="tab"
                                >
                                    <i class="fas fa-building me-2"></i>Nueva Empresa
                                </button>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content">
                            <!-- LOGIN TAB -->
                            <div class="tab-pane fade show active" id="content-login" role="tabpanel">
                                <!-- Header -->
                                <div class="login-header text-center mb-4">
                                    <div class="login-icon mb-3">
                                        <i class="fas fa-sign-in-alt"></i>
                                    </div>
                                    <h2>Iniciar Sesión</h2>
                                    <p>Accede a tu cuenta para continuar</p>
                                </div>

                                <!-- Alerta de Error -->
                                <div id="alertContainer" class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        <div>
                                            <strong>Error de autenticación</strong>
                                            <p id="alertMessage" class="mb-0"></p>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>

                                <!-- Formulario de Login -->
                                <form id="loginForm" action="config/process_login.php" method="POST" class="needs-validation" novalidate>
                                    <!-- Email Input -->
                                    <div class="form-group mb-4">
                                        <label for="email" class="form-label">
                                            <i class="fas fa-envelope me-2"></i>Correo Electrónico
                                        </label>
                                        <input 
                                            type="email" 
                                            class="form-control form-control-lg" 
                                            id="email" 
                                            name="email" 
                                            placeholder="ejemplo@correo.com"
                                            required
                                            autocomplete="email"
                                        >
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-times-circle me-1"></i>Por favor ingresa un email válido
                                        </div>
                                    </div>

                                    <!-- Password Input -->
                                    <div class="form-group mb-2">
                                        <label for="password" class="form-label">
                                            <i class="fas fa-lock me-2"></i>Contraseña
                                        </label>
                                        <div class="password-input-group">
                                            <input 
                                                type="password" 
                                                class="form-control form-control-lg" 
                                                id="password" 
                                                name="password" 
                                                placeholder="Tu contraseña"
                                                required
                                                autocomplete="current-password"
                                            >
                                            <button 
                                                type="button" 
                                                class="btn-toggle-password"
                                                id="togglePassword"
                                                title="Mostrar/Ocultar contraseña"
                                            >
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-times-circle me-1"></i>Por favor ingresa tu contraseña
                                        </div>
                                    </div>

                                    <!-- Forgot Password -->
                                    <div class="mb-4">
                                        <a href="#" class="link-forgot-password">
                                            <i class="fas fa-question-circle me-1"></i>¿Olvidaste tu contraseña?
                                        </a>
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="form-check mb-4 remember-check">
                                        <input 
                                            class="form-check-input" 
                                            type="checkbox" 
                                            id="rememberMe" 
                                            name="rememberMe"
                                        >
                                        <label class="form-check-label" for="rememberMe">
                                            Recuerda mis credenciales
                                        </label>
                                    </div>

                                    <!-- Submit Button -->
                                    <button 
                                        type="submit" 
                                        class="btn btn-primary btn-lg w-100 btn-submit mb-3"
                                        id="submitBtn"
                                    >
                                        <span class="btn-text">
                                            <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                                        </span>
                                        <span class="btn-loading d-none">
                                            <span class="spinner-border spinner-border-sm me-2"></span>
                                            Autenticando...
                                        </span>
                                    </button>
                                </form>
                            </div>

                            <!-- REGISTER TAB -->
                            <div class="tab-pane fade" id="content-register" role="tabpanel">
                                <!-- Header -->
                                <div class="login-header text-center mb-4">
                                    <div class="login-icon mb-3" style="background: linear-gradient(135deg, #66bb6a 0%, #42a74d 100%);">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <h2>Crear Nueva Empresa</h2>
                                    <p>Registra tu empresa en nuestro sistema</p>
                                </div>

                                <!-- Alerta de Error Registro -->
                                <div id="alertContainerRegister" class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        <div>
                                            <strong>Error en el registro</strong>
                                            <p id="alertMessageRegister" class="mb-0"></p>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>

                                <!-- Formulario de Registro -->
                                <form id="registerForm" action="config/process_register.php" method="POST" class="needs-validation" novalidate>
                                    <!-- Nombre Comercial -->
                                    <div class="form-group mb-3">
                                        <label for="company-name" class="form-label">
                                            <i class="fas fa-store me-2"></i>Nombre Comercial
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            id="company-name" 
                                            name="company_name" 
                                            placeholder="Ej: Mi Tienda S.A."
                                            required
                                        >
                                    </div>

                                    <!-- NIF/CIF -->
                                    <div class="form-group mb-3">
                                        <label for="nif-cif" class="form-label">
                                            <i class="fas fa-id-card me-2"></i>NIF/CIF
                                        </label>
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            id="nif-cif" 
                                            name="nif_cif" 
                                            placeholder="Ej: 12345678A"
                                            required
                                        >
                                    </div>

                                    <!-- Email Contacto -->
                                    <div class="form-group mb-3">
                                        <label for="contact-email" class="form-label">
                                            <i class="fas fa-envelope me-2"></i>Email de Contacto
                                        </label>
                                        <input 
                                            type="email" 
                                            class="form-control" 
                                            id="contact-email" 
                                            name="contact_email" 
                                            placeholder="contacto@empresa.com"
                                            required
                                        >
                                    </div>

                                    <!-- Teléfono -->
                                    <div class="form-group mb-3">
                                        <label for="phone" class="form-label">
                                            <i class="fas fa-phone me-2"></i>Teléfono
                                        </label>
                                        <input 
                                            type="tel" 
                                            class="form-control register-input" 
                                            id="phone" 
                                            name="phone" 
                                            placeholder="+240 222 123456"
                                            pattern="\+240\s(222|555)\s\d{6}"
                                            title="Formato: +240 222/555 seguido de 6 dígitos (Ej: +240 222 123456)"
                                        >
                                        <small class="text-muted d-block mt-1">
                                            <i class="fas fa-info-circle me-1"></i>Formato: +240 222 o 555, luego 6 dígitos
                                        </small>
                                    </div>

                                    <!-- Categoría Negocio -->
                                    <div class="form-group mb-3">
                                        <label for="category" class="form-label">
                                            <i class="fas fa-tag me-2"></i>Tipo de Negocio
                                        </label>
                                        <select class="form-select" id="category" name="category" required>
                                            <option value="">Selecciona una categoría</option>
                                            <option value="Alimentos">🍎 Alimentos</option>
                                            <option value="Moda">👕 Moda y Ropa</option>
                                            <option value="Electronica">💻 Electrónica</option>
                                            <option value="Ferreteria">🔨 Ferretería</option>
                                            <option value="Libros">📚 Libros</option>
                                            <option value="Farmacia">💊 Farmacia</option>
                                            <option value="Clinica">🏥 Clínica</option>
                                            <option value="Vehiculos">🚗 Vehículos</option>
                                        </select>
                                    </div>

                                    <!-- Alert Info -->
                                    <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
                                        <div class="d-flex align-items-start">
                                            <i class="fas fa-info-circle me-2 mt-1"></i>
                                            <div>
                                                <strong>Seguridad de tu cuenta</strong>
                                                <p class="mb-0 mt-1 small">
                                                    Una contraseña segura y aleatoria será generada y enviada a tu correo electrónico. 
                                                    Podrás cambiarla después de iniciar sesión.
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Terms -->
                                    <div class="form-check mb-4">
                                        <input 
                                            class="form-check-input" 
                                            type="checkbox" 
                                            id="terms" 
                                            name="terms" 
                                            required
                                        >
                                        <label class="form-check-label" for="terms">
                                            Acepto los <a href="#" class="link-help">términos y condiciones</a>
                                        </label>
                                    </div>

                                    <!-- Submit Button -->
                                    <button 
                                        type="submit" 
                                        class="btn btn-success btn-lg w-100 btn-submit"
                                        id="submitBtnRegister"
                                    >
                                        <span class="btn-text">
                                            <i class="fas fa-plus-circle me-2"></i>Crear Empresa
                                        </span>
                                        <span class="btn-loading d-none">
                                            <span class="spinner-border spinner-border-sm me-2"></span>
                                            Registrando...
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Link -->
                    <p class="login-footer text-center mt-4">
                        <a href="#" class="link-help">Centro de ayuda</a> · 
                        <a href="#" class="link-help">Términos de servicio</a> · 
                        <a href="#" class="link-help">Privacidad</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- JS Personalizado -->
    <script src="./recursos/js/login.js"></script>
</body>
</html>