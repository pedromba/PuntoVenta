<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respaldos - PuntoVenta Admin</title>
    
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
                <h5 class="topbar-title d-none d-md-block">Gestión de Respaldos</h5>
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
                    <h1 class="page-title">Respaldos</h1>
                    <p class="page-subtitle">Gestiona los respaldos de la base de datos</p>
                </div>
                <button class="btn btn-success btn-lg"><i class="fas fa-plus"></i> Crear Respaldo Ahora</button>
            </div>
        </div>

        <div class="content-wrapper">
            <!-- Estadísticas de Respaldos -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card-modern">
                        <div class="card-body text-center">
                            <h2>5</h2>
                            <p class="text-muted mb-0">Respaldos Activos</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-modern">
                        <div class="card-body text-center">
                            <h2>12.4 GB</h2>
                            <p class="text-muted mb-0">Espacio Usado</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-modern">
                        <div class="card-body text-center">
                            <h2>2026-02-05</h2>
                            <p class="text-muted mb-0">Último Respaldo</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-modern">
                        <div class="card-body text-center">
                            <h2>Diario</h2>
                            <p class="text-muted mb-0">Frecuencia</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Programación -->
            <section class="card-modern mb-4">
                <div class="card-header-modern">
                    <h5 class="card-title">Programación de Respaldos</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Frecuencia</label>
                            <select class="form-select">
                                <option selected>Diariamente</option>
                                <option>Cada 12 horas</option>
                                <option>Semanalmente</option>
                                <option>Mensualmente</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Hora del Respaldo</label>
                            <input type="time" class="form-control" value="02:00">
                        </div>
                    </div>
                    <button class="btn btn-primary"><i class="fas fa-save"></i> Guardar Configuración</button>
                </div>
            </section>

            <!-- Historial de Respaldos -->
            <section class="table-section">
                <div class="card-modern">
                    <div class="card-header-modern">
                        <h5 class="card-title">Historial de Respaldos</h5>
                    </div>
                    <div class="table-wrapper">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Fecha</th>
                                    <th>Tamaño</th>
                                    <th>Tipo</th>
                                    <th>Estado</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>backup_2026_02_05_0200.sql</td>
                                    <td>2026-02-05 02:15</td>
                                    <td>2.4 GB</td>
                                    <td>Automático</td>
                                    <td><span class="badge bg-success">Completado</span></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-primary"><i class="fas fa-download"></i></button>
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>backup_2026_02_04_0200.sql</td>
                                    <td>2026-02-04 02:15</td>
                                    <td>2.3 GB</td>
                                    <td>Automático</td>
                                    <td><span class="badge bg-success">Completado</span></td>
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
