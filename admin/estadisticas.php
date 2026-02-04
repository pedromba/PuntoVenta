<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas y Reportes - PuntoVenta Admin</title>
    
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
    <link rel="stylesheet" href="./recursos/css/estadisticas.css">
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../recursos/css/sweetalert2.css">
</head>
<body>
    <!-- Sidebar Moderno -->
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
                <h5 class="topbar-title d-none d-md-block">Reportes y Estadísticas</h5>
            </div>

            <div class="topbar-search d-none d-lg-flex">
                <div class="search-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Buscar reportes, análisis..." class="search-input" data-search="estadisticas">
                    <div class="search-results" style="display: none;"></div>
                </div>
            </div>

            <div class="topbar-right">
                <!-- Notifications -->
                <div class="notification-wrapper">
                    <button class="btn btn-icon btn-notification position-relative">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                    <div class="notification-menu">
                        <div class="notification-header">
                            <h6 class="m-0">Notificaciones</h6>
                            <button class="btn btn-sm btn-ghost">Limpiar</button>
                        </div>
                        <div class="notification-list">
                            <div class="notification-item unread">
                                <div class="notification-icon success">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="mb-1"><strong>Reporte Generado</strong></p>
                                    <span>Reporte mensual de ventas disponible</span>
                                    <small>Hace 2h</small>
                                </div>
                            </div>
                        </div>
                        <div class="notification-footer">
                            <a href="#">Ver todas →</a>
                        </div>
                    </div>
                </div>

                <!-- Settings -->
                <button class="btn btn-icon">
                    <i class="fas fa-gear"></i>
                </button>

                <!-- User Menu -->
                <div class="user-menu-wrapper">
                    <button class="btn btn-user">
                        <img src="https://ui-avatars.com/api/?name=Admin+User&background=2563eb&color=fff&rounded=true" alt="Admin">
                        <span class="d-none d-md-inline">Admin</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="user-menu">
                        <a href="#" class="menu-link">
                            <i class="fas fa-user"></i> Mi Perfil
                        </a>
                        <a href="#" class="menu-link">
                            <i class="fas fa-key"></i> Cambiar Contraseña
                        </a>
                        <hr class="my-2">
                        <a href="#" class="menu-link text-danger">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Container -->
        <div class="page-container">
            <!-- Page Header -->
            <section class="page-header">
                <div class="header-content">
                    <div class="header-text">
                        <h1 class="page-title">Reportes y Estadísticas</h1>
                        <p class="page-description">Análisis detallado del desempeño de tu negocio</p>
                    </div>
                    <div class="header-actions">
                        <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalExportarReporte">
                            <i class="fas fa-download me-2"></i>Descargar Reporte
                        </button>
                    </div>
                </div>
            </section>

            <!-- Date Range Filter -->
            <section class="filters-section mb-4">
                <div class="card-modern">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Fecha Inicio</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Fecha Fin</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Tipo Reporte</label>
                                <select class="form-select">
                                    <option value="">Selecciona tipo...</option>
                                    <option value="ventas">Ventas</option>
                                    <option value="productos">Productos</option>
                                    <option value="clientes">Clientes</option>
                                    <option value="inventario">Inventario</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">&nbsp;</label>
                                <button class="btn btn-primary w-100">
                                    <i class="fas fa-sync me-2"></i>Generar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Key Metrics -->
            <section class="stats-row mb-4">
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="card-modern">
                            <div class="card-body text-center">
                                <div class="stat-icon success">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <h6 class="mt-3">Ingresos Totales</h6>
                                <h4 class="stat-value" id="ingresos-reporte">--</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-modern">
                            <div class="card-body text-center">
                                <div class="stat-icon info">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <h6 class="mt-3">Número Ventas</h6>
                                <h4 class="stat-value" id="numero-ventas">--</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-modern">
                            <div class="card-body text-center">
                                <div class="stat-icon warning">
                                    <i class="fas fa-calculator"></i>
                                </div>
                                <h6 class="mt-3">Ticket Promedio</h6>
                                <h4 class="stat-value" id="ticket-promedio">--</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-modern">
                            <div class="card-body text-center">
                                <div class="stat-icon danger">
                                    <i class="fas fa-chart-pie"></i>
                                </div>
                                <h6 class="mt-3">Margen Promedio</h6>
                                <h4 class="stat-value" id="margen-promedio">--</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Charts Row -->
            <section class="content-section mb-4">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div class="card-modern">
                            <div class="card-header-modern">
                                <h5 class="card-title">Ventas por Día</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="ventasPoFechaChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card-modern">
                            <div class="card-header-modern">
                                <h5 class="card-title">Distribución por Categoría</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="categoriasDistribucionChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Top Products -->
            <section class="content-section">
                <div class="card-modern">
                    <div class="card-header-modern">
                        <h5 class="card-title">Productos Más Vendidos</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-modern">
                                <thead>
                                    <tr>
                                        <th>Nombre Producto</th>
                                        <th>Cantidad Vendida</th>
                                        <th>Ingresos</th>
                                        <th>% del Total</th>
                                        <th>Tendencia</th>
                                    </tr>
                                </thead>
                                <tbody id="top-productos-tbody">
                                    <tr class="table-row-hover">
                                        <td colspan="5" class="text-center text-muted py-4">
                                            <i class="fas fa-spinner fa-spin me-2"></i>Cargando datos...
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <footer class="app-footer">
                <p>&copy; 2026 PuntoVenta. Todos los derechos reservados.</p>
            </footer>
        </div>
    </main>

    <!-- Modal Exportar Reporte -->
    <div class="modal fade" id="modalExportarReporte" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-custom bg-success">
                    <h5 class="modal-title text-white">Descargar Reporte</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formExportarReporte" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label class="form-label">Tipo Reporte <span class="text-danger">*</span></label>
                            <select class="form-select" name="tipo_reporte" required>
                                <option value="">Seleccionar reporte...</option>
                                <option value="ventas">Reporte de Ventas</option>
                                <option value="gastos">Reporte de Gastos</option>
                                <option value="ingresos">Reporte de Ingresos</option>
                                <option value="inventario">Reporte de Inventario</option>
                                <option value="clientes">Reporte de Clientes</option>
                            </select>
                            <div class="invalid-feedback">Selecciona un reporte.</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Fecha Desde <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="fecha_desde" required>
                                <div class="invalid-feedback">La fecha es requerida.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Fecha Hasta <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="fecha_hasta" required>
                                <div class="invalid-feedback">La fecha es requerida.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Formato Descarga <span class="text-danger">*</span></label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="formato" id="formatoPDF" value="pdf" checked>
                                    <label class="form-check-label" for="formatoPDF">
                                        <i class="fas fa-file-pdf me-2 text-danger"></i>PDF
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="formato" id="formatoExcel" value="excel">
                                    <label class="form-check-label" for="formatoExcel">
                                        <i class="fas fa-file-excel me-2 text-success"></i>Excel
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="formato" id="formatoCSV" value="csv">
                                    <label class="form-check-label" for="formatoCSV">
                                        <i class="fas fa-file-csv me-2 text-primary"></i>CSV
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" onclick="document.getElementById('formExportarReporte').dispatchEvent(new Event('submit'))">
                        <i class="fas fa-download me-2"></i>Descargar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="../recursos/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chart.js -->
    <script src="../recursos/js/chart.umd.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="../recursos/js/sweetalert2.all.js"></script>
    
    <!-- Dashboard JS -->
    <script src="./recursos/js/dashboard.js"></script>
    <!-- Estadísticas JS -->
    <script src="./recursos/js/estadisticas.js"></script>
</body>
</html>
