<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes del Sistema - PuntoVenta Admin</title>
    
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
                <h5 class="topbar-title d-none d-md-block">Reportes del Sistema</h5>
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
                    <h1 class="page-title">Reportes</h1>
                    <p class="page-subtitle">Genera y descarga reportes del sistema y empresas</p>
                </div>
                <button class="btn btn-primary btn-lg"><i class="fas fa-download"></i> Exportar Reporte</button>
            </div>
        </div>

        <div class="content-wrapper">
            <!-- Reportes Disponibles -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="card-modern">
                        <div class="card-header-modern">
                            <h5 class="card-title">Resumen de Empresas</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-3">Informe completo de todas las empresas registradas en el sistema</p>
                            <div class="mb-3">
                                <label class="form-label">Período</label>
                                <select class="form-select">
                                    <option>Últimos 30 días</option>
                                    <option>Últimos 90 días</option>
                                    <option>Este año</option>
                                </select>
                            </div>
                            <button class="btn btn-primary w-100"><i class="fas fa-file-pdf"></i> Generar PDF</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-modern">
                        <div class="card-header-modern">
                            <h5 class="card-title">Actividad del Sistema</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-3">Reporte de toda la actividad registrada en el sistema</p>
                            <div class="mb-3">
                                <label class="form-label">Tipo de Actividad</label>
                                <select class="form-select">
                                    <option>Todas</option>
                                    <option>Validaciones</option>
                                    <option>Accesos</option>
                                    <option>Cambios</option>
                                </select>
                            </div>
                            <button class="btn btn-primary w-100"><i class="fas fa-file-csv"></i> Generar CSV</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-modern">
                        <div class="card-header-modern">
                            <h5 class="card-title">Usuarios Activos</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-3">Reporte de usuarios administrativos y su actividad</p>
                            <div class="mb-3">
                                <label class="form-label">Estado</label>
                                <select class="form-select">
                                    <option>Todos</option>
                                    <option>Activos</option>
                                    <option>Inactivos</option>
                                </select>
                            </div>
                            <button class="btn btn-primary w-100"><i class="fas fa-file-excel"></i> Generar Excel</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card-modern">
                        <div class="card-header-modern">
                            <h5 class="card-title">Errores e Incidentes</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-3">Reporte de errores, advertencias e incidentes del sistema</p>
                            <div class="mb-3">
                                <label class="form-label">Nivel</label>
                                <select class="form-select">
                                    <option>Todos</option>
                                    <option>Críticos</option>
                                    <option>Warnings</option>
                                </select>
                            </div>
                            <button class="btn btn-primary w-100"><i class="fas fa-file-pdf"></i> Generar PDF</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reportes Recientes -->
            <section class="table-section">
                <div class="card-modern">
                    <div class="card-header-modern">
                        <h5 class="card-title">Reportes Generados Recientemente</h5>
                    </div>
                    <div class="table-wrapper">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>Nombre del Reporte</th>
                                    <th>Tipo</th>
                                    <th>Fecha Generado</th>
                                    <th>Usuario</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Resumen Empresas Febrero 2026</td>
                                    <td><span class="badge bg-info">PDF</span></td>
                                    <td>2026-02-05</td>
                                    <td>Carlos Admin</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-primary"><i class="fas fa-download"></i></button>
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
