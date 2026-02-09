<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integraciones - PuntoVenta Admin</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/css/all.css">
    <link rel="stylesheet" href="./recursos/css/dashboard.css">
    
</head>
<body>
    <?php include "./componentes/aside.php" ?>
    <div class="sidebar-overlay"></div>

    <main class="main-content">
        <div class="topbar">
            <div class="topbar-left">
                <button class="btn btn-icon btn-toggle-sidebar d-lg-none"><i class="fas fa-bars"></i></button>
                <h5 class="topbar-title d-none d-md-block">Integraciones</h5>
            </div>
            <div class="topbar-right">
                <div class="user-menu-wrapper">
                    <button class="btn btn-user">
                        <img src="https://ui-avatars.com/api/?name=Admin+System&background=2563eb&color=fff&rounded=true" alt="Admin">
                        <span class="d-none d-md-inline">Admin</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="page-header">
            <div class="header-content">
                <div>
                    <h1 class="page-title">Integraciones</h1>
                    <p class="page-subtitle">Gestiona las integraciones del sistema con servicios externos</p>
                </div>
                <button class="btn btn-primary btn-lg"><i class="fas fa-plus"></i> Nueva Integración</button>
            </div>
        </div>

        <div class="content-wrapper">
            <!-- Integraciones Disponibles -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="card-modern">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5>Email - SMTP</h5>
                                <span class="badge bg-success">Activo</span>
                            </div>
                            <p class="text-muted mb-3">Envío de emails a través de servidor SMTP</p>
                            <small class="d-block mb-2"><strong>Servidor:</strong> smtp.gmail.com</small>
                            <small class="d-block mb-3"><strong>Última prueba:</strong> 2026-02-05</small>
                            <button class="btn btn-sm btn-primary"><i class="fas fa-cog"></i> Configurar</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-modern">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5>Google Drive</h5>
                                <span class="badge bg-warning">Pendiente</span>
                            </div>
                            <p class="text-muted mb-3">Almacenamiento de respaldos en Google Drive</p>
                            <small class="d-block mb-3"><strong>Estado:</strong> No configurado</small>
                            <button class="btn btn-sm btn-primary"><i class="fas fa-plug"></i> Conectar</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-modern">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5>AWS S3</h5>
                                <span class="badge bg-secondary">Inactivo</span>
                            </div>
                            <p class="text-muted mb-3">Almacenamiento en Amazon S3</p>
                            <small class="d-block mb-3"><strong>Estado:</strong> Deshabilitado</strong>
                            <button class="btn btn-sm btn-primary"><i class="fas fa-cog"></i> Configurar</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-modern">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5>Twilio SMS</h5>
                                <span class="badge bg-warning">Pendiente</span>
                            </div>
                            <p class="text-muted mb-3">Envío de SMS para notificaciones</p>
                            <small class="d-block mb-3"><strong>Estado:</strong> No configurado</small>
                            <button class="btn btn-sm btn-primary"><i class="fas fa-plug"></i> Conectar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Webhooks -->
            <section class="card-modern">
                <div class="card-header-modern">
                    <h5 class="card-title">Webhooks Configurados</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Webhooks para eventos del sistema</p>
                    <div class="table-wrapper">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>Evento</th>
                                    <th>URL</th>
                                    <th>Estado</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>empresa.validada</td>
                                    <td>https://ejemplo.com/webhook/empresa-validada</td>
                                    <td><span class="badge bg-success">Activo</span></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-info"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <footer class="app-footer">
                <p>&copy; 2026 PuntoVenta - Sistema de Administración.</p>
            </footer>
        </div>
    </main>

    <script src="../recursos/js/bootstrap.bundle.min.js"></script>
</body>
</html>
