<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración del Sistema - PuntoVenta Admin</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../recursos/css/all.css">
    
    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="./recursos/css/dashboard.css">
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../recursos/css/sweetalert2.css">
</head>
<body>
    <!-- Sidebar -->
    <?php include "./componentes/aside.php" ?>

    <div class="sidebar-overlay"></div>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div class="topbar-left">
                <button class="btn btn-icon btn-toggle-sidebar d-lg-none">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="topbar-title d-none d-md-block">Configuración del Sistema</h5>
            </div>

            <div class="topbar-right">
                <button class="btn btn-icon">
                    <i class="fas fa-gear"></i>
                </button>

                <div class="user-menu-wrapper">
                    <button class="btn btn-user">
                        <img src="https://ui-avatars.com/api/?name=Admin+System&background=2563eb&color=fff&rounded=true" alt="Admin">
                        <span class="d-none d-md-inline">Admin</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <div class="header-content">
                <div>
                    <h1 class="page-title">Configuración</h1>
                    <p class="page-subtitle">Ajusta la configuración global del sistema PuntoVenta</p>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="content-wrapper">
            <div class="row">
                <!-- Settings Navigation -->
                <div class="col-lg-3 mb-4">
                    <div class="card-modern sticky-top" style="top: 20px;">
                        <div class="card-body p-0">
                            <nav class="nav flex-column">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#general" type="button">
                                    <i class="fas fa-sliders-h me-2"></i>General
                                </button>
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#email" type="button">
                                    <i class="fas fa-envelope me-2"></i>Email
                                </button>
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#seguridad" type="button">
                                    <i class="fas fa-lock me-2"></i>Seguridad
                                </button>
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#respaldos" type="button">
                                    <i class="fas fa-database me-2"></i>Respaldos
                                </button>
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#notificaciones" type="button">
                                    <i class="fas fa-bell me-2"></i>Notificaciones
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Settings Content -->
                <div class="col-lg-9">
                    <div class="tab-content">
                        <!-- General Settings -->
                        <div class="tab-pane fade show active" id="general">
                            <div class="card-modern mb-4">
                                <div class="card-header-modern">
                                    <h5 class="card-title">Configuración General</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Nombre del Sistema</label>
                                        <input type="text" class="form-control" value="PuntoVenta">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Versión</label>
                                        <input type="text" class="form-control" value="2.0" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Descripción del Sistema</label>
                                        <textarea class="form-control" rows="3">Plataforma de gestión integral para múltiples empresas...</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Zona Horaria</label>
                                        <select class="form-select">
                                            <option selected>America/Argentina/Buenos_Aires (ART)</option>
                                            <option>America/Mexico_City</option>
                                            <option>America/Los_Angeles</option>
                                            <option>Europe/Madrid</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Idioma por Defecto</label>
                                        <select class="form-select">
                                            <option selected>Español</option>
                                            <option>English</option>
                                            <option>Português</option>
                                        </select>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="mantenimiento" checked>
                                        <label class="form-check-label" for="mantenimiento">
                                            Sistema en modo mantenimiento
                                        </label>
                                    </div>
                                    <button class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Guardar Cambios
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Email Settings -->
                        <div class="tab-pane fade" id="email">
                            <div class="card-modern mb-4">
                                <div class="card-header-modern">
                                    <h5 class="card-title">Configuración de Email</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Servidor SMTP</label>
                                        <input type="text" class="form-control" placeholder="smtp.gmail.com">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Puerto</label>
                                            <input type="number" class="form-control" value="587">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold">Encriptación</label>
                                            <select class="form-select">
                                                <option selected>TLS</option>
                                                <option>SSL</option>
                                                <option>Ninguna</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Usuario/Email</label>
                                        <input type="email" class="form-control" placeholder="admin@puntoventa.com">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Contraseña</label>
                                        <input type="password" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Email Remitente</label>
                                        <input type="email" class="form-control" placeholder="noreply@puntoventa.com">
                                    </div>
                                    <button class="btn btn-primary" onclick="testEmail()">
                                        <i class="fas fa-paper-plane me-2"></i>Enviar Email de Prueba
                                    </button>
                                    <button class="btn btn-success ms-2">
                                        <i class="fas fa-save me-2"></i>Guardar Cambios
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Security Settings -->
                        <div class="tab-pane fade" id="seguridad">
                            <div class="card-modern mb-4">
                                <div class="card-header-modern">
                                    <h5 class="card-title">Configuración de Seguridad</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Duración de Sesión (minutos)</label>
                                        <input type="number" class="form-control" value="30">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Intentos de Login Permitidos</label>
                                        <input type="number" class="form-control" value="5">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Tiempo de Bloqueo (minutos)</label>
                                        <input type="number" class="form-control" value="15">
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="https" checked>
                                        <label class="form-check-label" for="https">
                                            Requerir HTTPS
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="2fa" checked>
                                        <label class="form-check-label" for="2fa">
                                            Autenticación de dos factores obligatoria
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="logs" checked>
                                        <label class="form-check-label" for="logs">
                                            Registrar todos los accesos en auditoría
                                        </label>
                                    </div>
                                    <button class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Guardar Cambios
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Backup Settings -->
                        <div class="tab-pane fade" id="respaldos">
                            <div class="card-modern mb-4">
                                <div class="card-header-modern">
                                    <h5 class="card-title">Configuración de Respaldos</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Frecuencia de Respaldos</label>
                                        <select class="form-select">
                                            <option>Cada hora</option>
                                            <option selected>Diariamente</option>
                                            <option>Semanalmente</option>
                                            <option>Mensualmente</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Hora del Respaldo Diario</label>
                                        <input type="time" class="form-control" value="02:00">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Retención de Respaldos (días)</label>
                                        <input type="number" class="form-control" value="30">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Ubicación de Almacenamiento</label>
                                        <select class="form-select">
                                            <option selected>Servidor Local</option>
                                            <option>Google Drive</option>
                                            <option>Amazon S3</option>
                                            <option>Azure Storage</option>
                                        </select>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="encriptacion" checked>
                                        <label class="form-check-label" for="encriptacion">
                                            Encriptar respaldos
                                        </label>
                                    </div>
                                    <button class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Guardar Cambios
                                    </button>
                                    <button class="btn btn-warning ms-2" onclick="crearRespaldoAhora()">
                                        <i class="fas fa-download me-2"></i>Respaldar Ahora
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Notifications Settings -->
                        <div class="tab-pane fade" id="notificaciones">
                            <div class="card-modern mb-4">
                                <div class="card-header-modern">
                                    <h5 class="card-title">Preferencias de Notificaciones</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="mb-3">Eventos de Sistema</h6>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="notif-errores" checked>
                                        <label class="form-check-label" for="notif-errores">
                                            Notificar sobre errores del sistema
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="notif-respaldos" checked>
                                        <label class="form-check-label" for="notif-respaldos">
                                            Notificar cuando se completan respaldos
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="notif-actualizaciones" checked>
                                        <label class="form-check-label" for="notif-actualizaciones">
                                            Notificar sobre nuevas actualizaciones disponibles
                                        </label>
                                    </div>

                                    <h6 class="mb-3">Empresas</h6>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="notif-nuevas-empresas" checked>
                                        <label class="form-check-label" for="notif-nuevas-empresas">
                                            Notificar nuevas solicitudes de empresas
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="notif-cambios-estado" checked>
                                        <label class="form-check-label" for="notif-cambios-estado">
                                            Notificar cambios de estado de empresas
                                        </label>
                                    </div>

                                    <button class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Guardar Cambios
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="app-footer mt-4">
                <p>&copy; 2026 PuntoVenta - Sistema de Administración.</p>
            </footer>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="../recursos/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="../recursos/js/sweetalert2.all.js"></script>
    
    <script>
        function testEmail() {
            Swal.fire({
                title: 'Enviando email de prueba...',
                icon: 'info',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            setTimeout(() => {
                Swal.fire({
                    title: '¡Email enviado!',
                    text: 'El email de prueba se envió exitosamente a tu bandeja de entrada.',
                    icon: 'success'
                });
            }, 2000);
        }

        function crearRespaldoAhora() {
            Swal.fire({
                title: 'Creando respaldo...',
                html: 'Esto puede tomar algunos minutos<br><div class="progress mt-3"><div class="progress-bar" style="width: 45%"></div></div>',
                icon: 'info',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            setTimeout(() => {
                Swal.fire({
                    title: '¡Respaldo completado!',
                    text: 'El respaldo de la base de datos se creó exitosamente.',
                    icon: 'success'
                });
            }, 3000);
        }
    </script>
</body>
</html>
