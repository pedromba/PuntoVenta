<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs del Sistema - PuntoVenta Admin</title>
    
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
                <h5 class="topbar-title d-none d-md-block">Logs del Sistema</h5>
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
                    <h1 class="page-title">Logs del Sistema</h1>
                    <p class="page-subtitle">Visualiza los logs y errores del sistema</p>
                </div>
                <button class="btn btn-outline-danger btn-lg"><i class="fas fa-trash"></i> Limpiar Logs</button>
            </div>
        </div>

        <div class="content-wrapper">
            <!-- Filtros -->
            <section class="filters-section mb-4">
                <div class="filters-container">
                    <div class="filter-group">
                        <select class="form-select">
                            <option selected>Todos los niveles</option>
                            <option value="error">Error</option>
                            <option value="warning">Warning</option>
                            <option value="info">Info</option>
                            <option value="debug">Debug</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <input type="date" class="form-control">
                    </div>
                    <div class="filter-group">
                        <input type="text" class="form-control" placeholder="Buscar en logs...">
                    </div>
                </div>
            </section>

            <!-- Logs -->
            <section class="card-modern">
                <div class="card-header-modern">
                    <h5 class="card-title">Entradas de Log Recientes</h5>
                </div>
                <div class="card-body p-0">
                    <div style="font-family: monospace; background: #f8f9fa; max-height: 500px; overflow-y: auto; padding: 15px;">
                        <div class="mb-2">
                            <span class="badge bg-danger">ERROR</span>
                            <small>[2026-02-05 14:32:15]</small>
                            <div style="margin-left: 20px; margin-top: 5px;">
                                Error de conexión a base de datos en módulo de empresas<br>
                                <small style="color: #666;">DatabaseConnectionException: Unable to connect to MySQL server</small>
                            </div>
                        </div>
                        <hr class="my-2">
                        
                        <div class="mb-2">
                            <span class="badge bg-warning">WARNING</span>
                            <small>[2026-02-05 13:15:42]</small>
                            <div style="margin-left: 20px; margin-top: 5px;">
                                Memoria utilizada al 72% del total disponible<br>
                                <small style="color: #666;">Memory threshold warning triggered</small>
                            </div>
                        </div>
                        <hr class="my-2">
                        
                        <div class="mb-2">
                            <span class="badge bg-info">INFO</span>
                            <small>[2026-02-05 10:45:20]</small>
                            <div style="margin-left: 20px; margin-top: 5px;">
                                Usuario Carlos Admin inició sesión<br>
                                <small style="color: #666;">Login successful from IP: 192.168.1.100</small>
                            </div>
                        </div>
                        <hr class="my-2">
                        
                        <div class="mb-2">
                            <span class="badge bg-success">DEBUG</span>
                            <small>[2026-02-05 09:30:15]</small>
                            <div style="margin-left: 20px; margin-top: 5px;">
                                Consulta a base de datos completada<br>
                                <small style="color: #666;">Query execution time: 45ms</small>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Estadísticas de Logs -->
            <section class="card-modern mt-4">
                <div class="card-header-modern">
                    <h5 class="card-title">Estadísticas de Logs (Últimos 7 días)</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center">
                                <h3 class="text-danger">5</h3>
                                <p class="text-muted">Errores</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <h3 class="text-warning">12</h3>
                                <p class="text-muted">Warnings</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <h3 class="text-info">48</h3>
                                <p class="text-muted">Info</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <h3 class="text-success">124</h3>
                                <p class="text-muted">Debug</p>
                            </div>
                        </div>
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
