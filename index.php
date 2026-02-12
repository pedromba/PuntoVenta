<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <title>PuntoVenta - Login & Registro</title>

    <!-- Bootstrap 5 CSS -->
    <link href="./recursos/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="./recursos/css/all.css">

    <!-- Google Fonts - Sora -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="./recursos/css/estilosLogin.css">
</head>

<body>
    <div class="container-fluid login-container">
        <div class="row">
            <!-- Columna Izquierda - Información y Branding -->
            <div class="col-lg-6 col-md-12 info-section">
                <div class="info-content observe-fade">
                    <!-- Logo -->
                    <div class="logo-section">
                        <div class="logo-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h1 class="brand-title">PuntoVenta</h1>
                        <p class="brand-subtitle">Sistema Integral de Gestión Comercial</p>
                    </div>

                    <!-- Descripción -->
                    <div class="description-section">
                        <h3 class="section-title">Bienvenido a tu solución comercial</h3>
                        <p class="section-text">
                            Gestiona tu negocio de forma eficiente con nuestro sistema de punto de venta integral.
                            Controla inventario, ventas y reportes en tiempo real.
                        </p>
                    </div>

                    <!-- Características -->
                    <div class="features-grid">
                        <div class="feature-card observe-fade">
                            <div class="feature-icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <h5>Reportes Avanzados</h5>
                            <p>Analiza tus ventas con gráficos y estadísticas en tiempo real</p>
                        </div>

                        <div class="feature-card observe-fade">
                            <div class="feature-icon">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <h5>Control de Inventario</h5>
                            <p>Gestiona tu stock y recibe alertas de productos bajos</p>
                        </div>

                        <div class="feature-card observe-fade">
                            <div class="feature-icon">
                                <i class="fas fa-users-cog"></i>
                            </div>
                            <h5>Gestión de Usuarios</h5>
                            <p>Control total de permisos y roles de acceso</p>
                        </div>

                        <div class="feature-card observe-fade">
                            <div class="feature-icon">
                                <i class="fas fa-lock-open"></i>
                            </div>
                            <h5>Seguridad Certificada</h5>
                            <p>Encriptación avanzada y autenticación segura</p>
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
            <div class="col-lg-6 col-md-12 login-section">
                <div class="login-wrapper observe-fade">
                    <!-- Card del Formulario -->
                    <div class="login-card">
                        <!-- Contenido del Login -->
                        <div>
                            <!-- LOGIN FORM -->
                            <div>
                                <!-- Header -->
                                <div class="login-header">
                                    <div class="login-icon">
                                        <i class="fas fa-sign-in-alt"></i>
                                    </div>
                                    <h2>Iniciar Sesión</h2>
                                    <p>Accede a tu cuenta para continuar</p>
                                </div>

                                <!-- Alerta de Error -->
                                <div id="alertContainer" class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        <span id="errorMessage"></span>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>

                                <!-- Formulario de Login -->
                                <form id="loginForm" action="config/process_login.php" method="POST" class="needs-validation" novalidate>
                                    <!-- Email Input -->
                                    <div class="form-group">
                                        <label class="form-label" for="email">
                                            <i class="fas fa-envelope me-2"></i>Correo Electrónico
                                        </label>
                                        <input
                                            type="email"
                                            class="form-control"
                                            id="email"
                                            name="email"
                                            placeholder="tu@empresa.com"
                                            required>
                                        <div class="invalid-feedback">Por favor ingresa un correo válido</div>
                                    </div>

                                    <!-- Password Input -->
                                    <div class="form-group">
                                        <label class="form-label" for="password">
                                            <i class="fas fa-lock me-2"></i>Contraseña
                                        </label>
                                        <div class="password-input-group">
                                            <input
                                                type="password"
                                                class="form-control"
                                                id="password"
                                                name="password"
                                                placeholder="••••••••"
                                                required
                                                minlength="6">
                                            <button type="button" class="btn-toggle-password" id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <div class="invalid-feedback">La contraseña debe tener al menos 6 caracteres</div>
                                    </div>

                                    <!-- Forgot Password -->
                                    <div class="text-end mb-3">
                                        <a href="#" class="link-forgot-password">
                                            <i class="fas fa-key me-1"></i>¿Olvidaste tu contraseña?
                                        </a>
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="form-check remember-check">
                                        <input
                                            type="checkbox"
                                            class="form-check-input"
                                            id="rememberMe"
                                            name="rememberMe">
                                        <label class="form-check-label" for="rememberMe">
                                            Recuérdame en este dispositivo
                                        </label>
                                    </div>

                                    <!-- Submit Button -->
                                    <button
                                        type="submit"
                                        class="btn btn-submit btn-lg w-100"
                                        id="submitBtn">
                                        <span class="btn-text">
                                            <i class="fas fa-sign-in-alt me-2"></i>Acceder
                                        </span>
                                        <span class="btn-loading d-none">
                                            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                            Iniciando sesión...
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Link -->
                    <p class="login-footer mt-4">
                        <a href="#" class="link-help">
                            <i class="fas fa-headset me-1"></i>Centro de ayuda
                        </a>
                        <span class="text-muted">·</span>
                        <a href="#" class="link-help">
                            <i class="fas fa-file-contract me-1"></i>Términos
                        </a>
                        <span class="text-muted">·</span>
                        <a href="#" class="link-help">
                            <i class="fas fa-shield-alt me-1"></i>Privacidad
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="./recursos/js/sweetalert2.all.js"></script>

    <!-- JS Personalizado -->
    <script src="./recursos/js/login.js"></script>
</body>

</html>