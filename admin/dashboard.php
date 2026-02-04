<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PuntoVenta Admin - Dashboard</title>
    
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
</head>
<body>
    <!-- Sidebar Moderno -->
   <?php include "./componentes/aside.php" ?>

    <!-- Overlay Sidebar Mobile -->
    <div class="sidebar-overlay"></div>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div class="topbar-left">
                <button class="btn btn-icon btn-toggle-sidebar d-lg-none">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="topbar-title d-none d-md-block">Bienvenido de vuelta, Admin</h5>
            </div>

            <div class="topbar-search d-none d-lg-flex">
                <div class="search-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Buscar empresas, usuarios..." class="search-input">
                    <div class="search-results" style="display: none;">
                        <div class="result-item">
                            <i class="fas fa-building"></i>
                            <span>TechStore - Empresa</span>
                        </div>
                    </div>
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
                                <div class="notification-icon danger">
                                    <i class="fas fa-circle-exclamation"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="mb-1"><strong>TechStore</strong></p>
                                    <span>Cuota de API excedida</span>
                                    <small>Hace 5 min</small>
                                </div>
                            </div>
                            <div class="notification-item unread">
                                <div class="notification-icon success">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="mb-1"><strong>Pago Confirmado</strong></p>
                                    <span>StarMart - $999.99</span>
                                    <small>Hace 1h</small>
                                </div>
                            </div>
                            <div class="notification-item">
                                <div class="notification-icon info">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="mb-1"><strong>Mantenimiento</strong></p>
                                    <span>Programado para mañana</span>
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

        <!-- Page Header -->
        <div class="page-header">
            <div class="header-content">
                <div>
                    <h1 class="page-title">Dashboard</h1>
                    <p class="page-subtitle">Resumen general del sistema</p>
                </div>
                <button class="btn btn-primary btn-lg btn-action-create">
                    <i class="fas fa-plus"></i>
                    <span>Crear Empresa</span>
                </button>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="content-wrapper">
            <!-- KPI Cards Section -->
            <section class="kpi-section">
                <div class="row g-3 mb-4">
                    <!-- KPI Card 1 -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="kpi-card" data-animate="slide-in">
                            <div class="kpi-header">
                                <div class="kpi-icon-wrapper" style="--color: #2563eb;">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="kpi-change">
                                    <i class="fas fa-arrow-up"></i>
                                    <span>12%</span>
                                </div>
                            </div>
                            <div class="kpi-body">
                                <h6 class="kpi-label">Empresas Activas</h6>
                                <h3 class="kpi-value">--</h3>
                                <p class="kpi-footer">Cargando datos...</p>
                            </div>
                        </div>
                    </div>

                    <!-- KPI Card 2 -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="kpi-card" data-animate="slide-in">
                            <div class="kpi-header">
                                <div class="kpi-icon-wrapper" style="--color: #10b981;">
                                    <i class="fas fa-receipt"></i>
                                </div>
                                <div class="kpi-change positive">
                                    <i class="fas fa-arrow-up"></i>
                                    <span>--</span>
                                </div>
                            </div>
                            <div class="kpi-body">
                                <h6 class="kpi-label">Ventas Completadas</h6>
                                <h3 class="kpi-value">--</h3>
                                <p class="kpi-footer">Este mes</p>
                            </div>
                        </div>
                    </div>

                    <!-- KPI Card 3 -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="kpi-card" data-animate="slide-in">
                            <div class="kpi-header">
                                <div class="kpi-icon-wrapper" style="--color: #f59e0b;">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div class="kpi-change">
                                    <i class="fas fa-arrow-up"></i>
                                    <span>--</span>
                                </div>
                            </div>
                            <div class="kpi-body">
                                <h6 class="kpi-label">Productos Registrados</h6>
                                <h3 class="kpi-value">--</h3>
                                <p class="kpi-footer">Total en el sistema</p>
                            </div>
                        </div>
                    </div>

                    <!-- KPI Card 4 -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="kpi-card" data-animate="slide-in">
                            <div class="kpi-header">
                                <div class="kpi-icon-wrapper" style="--color: #8b5cf6;">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="kpi-status online">
                                    <span class="status-dot"></span>
                                    <span>--</span>
                                </div>
                            </div>
                            <div class="kpi-body">
                                <h6 class="kpi-label">Disponibilidad</h6>
                                <h3 class="kpi-value">99.8%</h3>
                                <p class="kpi-footer">Uptime este mes</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Charts and Data Section -->
            <section class="charts-section">
                <div class="row g-3 mb-4">
                    <!-- Revenue Chart -->
                    <div class="col-12 col-lg-8" data-animate="slide-in">
                        <div class="card-modern">
                            <div class="card-header-modern">
                                <div>
                                    <h5 class="card-title">Ventas Recientes</h5>
                                    <p class="card-subtitle">Últimas transacciones</p>
                                </div>
                                <div class="card-actions">
                                    <button class="btn btn-icon btn-sm">
                                        <i class="fas fa-download"></i>
                                    </button>
                                    <button class="btn btn-icon btn-sm">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="ventasChart" style="height: 300px;"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Productos por Categoría -->
                    <div class="col-12 col-lg-4" data-animate="slide-in">
                        <div class="card-modern">
                            <div class="card-header-modern">
                                <div>
                                    <h5 class="card-title">Categorías de Productos</h5>
                                    <p class="card-subtitle">Distribución</p>
                                </div>
                            </div>
                            <div class="card-body d-flex justify-content-center align-items-center" style="min-height: 300px;">
                                <canvas id="categoriasChart" style="max-width: 200px; height: 200px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Row -->
                <div class="row g-3 mb-4">
                    <!-- Quick Stats -->
                    <div class="col-12 col-md-6" data-animate="slide-in">
                        <div class="card-modern">
                            <div class="card-header-modern">
                                <h5 class="card-title">Información del Sistema</h5>
                            </div>
                            <div class="card-body">
                                <div class="metric-item">
                                    <div class="metric-label">Total de Ventas</div>
                                    <div class="metric-value">
                                        <span class="value" id="total-ventas">--</span>
                                        <span class="badge badge-success">Activas</span>
                                    </div>
                                    <div class="progress-bar-wrapper">
                                        <div class="progress-bar-custom" id="ventas-progress" style="width: 0%"></div>
                                    </div>
                                </div>
                                <div class="metric-item">
                                    <div class="metric-label">Stock Disponible</div>
                                    <div class="metric-value">
                                        <span class="value" id="stock-total">--</span>
                                        <span class="badge badge-info">Productos</span>
                                    </div>
                                    <div class="progress-bar-wrapper">
                                        <div class="progress-bar-custom" id="stock-progress" style="width: 0%; background: linear-gradient(90deg, #0ea5e9, #06b6d4);"></div>
                                    </div>
                                </div>
                                <div class="metric-item">
                                    <div class="metric-label">Ingresos del Período</div>
                                    <div class="metric-value">
                                        <span class="value" id="ingresos-total">--</span>
                                        <span class="badge badge-success">Completado</span>
                                    </div>
                                    <div class="progress-bar-wrapper">
                                        <div class="progress-bar-custom" id="ingresos-progress" style="width: 0%; background: linear-gradient(90deg, #10b981, #34d399);"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Feed -->
                    <div class="col-12 col-md-6" data-animate="slide-in">
                        <div class="card-modern">
                            <div class="card-header-modern">
                                <h5 class="card-title">Últimas Transacciones</h5>
                            </div>
                            <div class="card-body">
                                <div class="activity-feed" id="recent-transactions">
                                    <div class="activity-item">
                                        <div class="activity-marker success"></div>
                                        <div class="activity-content">
                                            <p class="activity-title">Venta completada</p>
                                            <p class="activity-description">--</p>
                                            <span class="activity-time">Cargando...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Companies Table Section -->
            <section class="table-section" data-animate="slide-in">
                <div class="card-modern">
                    <div class="card-header-modern">
                        <div>
                            <h5 class="card-title">Empresas Principales</h5>
                            <p class="card-subtitle">Por ingresos mensuales</p>
                        </div>
                        <a href="#" class="link-modern">Ver todas →</a>
                    </div>
                    <div class="table-wrapper">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>Empresa</th>
                                    <th>Categoría</th>
                                    <th>NIF/CIF</th>
                                    <th>Contacto</th>
                                    <th>Estado</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="empresas-tbody">
                                <tr class="table-row-hover">
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="fas fa-spinner fa-spin me-2"></i>Cargando empresas...
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <footer class="app-footer">
                <p>&copy; 2026 PuntoVenta. Todos los derechos reservados.</p>
            </footer>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="../recursos/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chart.js -->
    <script src="../recursos/js/chart.umd.js"></script>
    
    <!-- Dashboard JS -->
    <script src="./recursos/js/dashboard.js"></script>
</body>
</html>