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
    <aside class="sidebar">
        <!-- Branding -->
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="fas fa-rocket"></i>
            </div>
            <div class="brand-text">
                <h4 class="m-0">PuntoVenta</h4>
                <small>v2.0 Pro</small>
            </div>
            <button class="btn-sidebar-close d-lg-none">
                <i class="fas fa-xmark"></i>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="sidebar-menu">
            <!-- Dashboard -->
            <div class="menu-group">
                <div class="menu-title">Inicio</div>
                <ul class="menu-list">
                    <li>
                        <a href="#" class="menu-item active" data-section="dashboard">
                            <span class="menu-icon"><i class="fas fa-house"></i></span>
                            <span class="menu-text">Dashboard</span>
                            <span class="badge badge-pulse">HOY</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Empresas -->
            <div class="menu-group">
                <div class="menu-title">Empresas</div>
                <ul class="menu-list">
                    <li>
                        <a href="#" class="menu-item" data-section="empresas">
                            <span class="menu-icon"><i class="fas fa-building"></i></span>
                            <span class="menu-text">Gestión</span>
                            <span class="badge badge-count">47</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-item" data-section="categorias">
                            <span class="menu-icon"><i class="fas fa-layer-group"></i></span>
                            <span class="menu-text">Categorías</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-item" data-section="productos">
                            <span class="menu-icon"><i class="fas fa-box"></i></span>
                            <span class="menu-text">Productos</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Suscripciones -->
            <div class="menu-group">
                <div class="menu-title">Suscripciones</div>
                <ul class="menu-list">
                    <li>
                        <a href="#" class="menu-item" data-section="planes">
                            <span class="menu-icon"><i class="fas fa-star"></i></span>
                            <span class="menu-text">Planes</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-item" data-section="suscripciones">
                            <span class="menu-icon"><i class="fas fa-credit-card"></i></span>
                            <span class="menu-text">Activos</span>
                            <span class="badge badge-warning badge-sm">5</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-item" data-section="pagos">
                            <span class="menu-icon"><i class="fas fa-wallet"></i></span>
                            <span class="menu-text">Pagos</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Sistema -->
            <div class="menu-group">
                <div class="menu-title">Sistema</div>
                <ul class="menu-list">
                    <li>
                        <a href="#" class="menu-item" data-section="usuarios">
                            <span class="menu-icon"><i class="fas fa-user-shield"></i></span>
                            <span class="menu-text">Usuarios</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-item" data-section="auditoria">
                            <span class="menu-icon"><i class="fas fa-history"></i></span>
                            <span class="menu-text">Auditoría</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-item" data-section="config">
                            <span class="menu-icon"><i class="fas fa-gears"></i></span>
                            <span class="menu-text">Configuración</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Sidebar Footer -->
        <div class="sidebar-footer">
            <div class="user-card">
                <div class="user-avatar">
                    <img src="https://ui-avatars.com/api/?name=Admin+User&background=2563eb&color=fff&rounded=true" alt="Admin">
                </div>
                <div class="user-info">
                    <div class="user-name">Administrador</div>
                    <div class="user-status">En línea</div>
                </div>
                <button class="btn btn-sm btn-ghost">
                    <i class="fas fa-ellipsis-vertical"></i>
                </button>
            </div>
        </div>
    </aside>

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
                                <h3 class="kpi-value">47</h3>
                                <p class="kpi-footer">+5 esta semana</p>
                            </div>
                        </div>
                    </div>

                    <!-- KPI Card 2 -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="kpi-card" data-animate="slide-in">
                            <div class="kpi-header">
                                <div class="kpi-icon-wrapper" style="--color: #10b981;">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div class="kpi-change positive">
                                    <i class="fas fa-arrow-up"></i>
                                    <span>18%</span>
                                </div>
                            </div>
                            <div class="kpi-body">
                                <h6 class="kpi-label">Ingresos Mensuales</h6>
                                <h3 class="kpi-value">$14.2K</h3>
                                <p class="kpi-footer">vs mes anterior</p>
                            </div>
                        </div>
                    </div>

                    <!-- KPI Card 3 -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="kpi-card" data-animate="slide-in">
                            <div class="kpi-header">
                                <div class="kpi-icon-wrapper" style="--color: #f59e0b;">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="kpi-change">
                                    <i class="fas fa-arrow-up"></i>
                                    <span>8%</span>
                                </div>
                            </div>
                            <div class="kpi-body">
                                <h6 class="kpi-label">Usuarios Sistema</h6>
                                <h3 class="kpi-value">189</h3>
                                <p class="kpi-footer">+12 registros hoy</p>
                            </div>
                        </div>
                    </div>

                    <!-- KPI Card 4 -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="kpi-card" data-animate="slide-in">
                            <div class="kpi-header">
                                <div class="kpi-icon-wrapper" style="--color: #8b5cf6;">
                                    <i class="fas fa-server"></i>
                                </div>
                                <div class="kpi-status online">
                                    <span class="status-dot"></span>
                                    <span>Óptimo</span>
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
                                    <h5 class="card-title">Ingresos por Suscripción</h5>
                                    <p class="card-subtitle">Últimos 12 meses</p>
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
                                <canvas id="revenueChart" style="height: 300px;"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Plan Distribution -->
                    <div class="col-12 col-lg-4" data-animate="slide-in">
                        <div class="card-modern">
                            <div class="card-header-modern">
                                <div>
                                    <h5 class="card-title">Distribución de Planes</h5>
                                    <p class="card-subtitle">Total de empresas</p>
                                </div>
                            </div>
                            <div class="card-body d-flex justify-content-center align-items-center" style="min-height: 300px;">
                                <canvas id="plansChart" style="max-width: 200px; height: 200px;"></canvas>
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
                                <h5 class="card-title">Métricas Rápidas</h5>
                            </div>
                            <div class="card-body">
                                <div class="metric-item">
                                    <div class="metric-label">Tasa de Conversión</div>
                                    <div class="metric-value">
                                        <span class="value">34.5%</span>
                                        <span class="badge badge-success">↑ 2.3%</span>
                                    </div>
                                    <div class="progress-bar-wrapper">
                                        <div class="progress-bar-custom" style="width: 34.5%"></div>
                                    </div>
                                </div>
                                <div class="metric-item">
                                    <div class="metric-label">Retención Usuarios</div>
                                    <div class="metric-value">
                                        <span class="value">78.2%</span>
                                        <span class="badge badge-warning">↓ 1.1%</span>
                                    </div>
                                    <div class="progress-bar-wrapper">
                                        <div class="progress-bar-custom" style="width: 78.2%; background: linear-gradient(90deg, #f59e0b, #fbbf24);"></div>
                                    </div>
                                </div>
                                <div class="metric-item">
                                    <div class="metric-label">Uso de API</div>
                                    <div class="metric-value">
                                        <span class="value">68.7%</span>
                                        <span class="badge badge-danger">↑ 5.2%</span>
                                    </div>
                                    <div class="progress-bar-wrapper">
                                        <div class="progress-bar-custom" style="width: 68.7%; background: linear-gradient(90deg, #ef4444, #f87171);"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Feed -->
                    <div class="col-12 col-md-6" data-animate="slide-in">
                        <div class="card-modern">
                            <div class="card-header-modern">
                                <h5 class="card-title">Actividad Reciente</h5>
                            </div>
                            <div class="card-body">
                                <div class="activity-feed">
                                    <div class="activity-item">
                                        <div class="activity-marker success"></div>
                                        <div class="activity-content">
                                            <p class="activity-title">Nueva empresa registrada</p>
                                            <p class="activity-description">TechHub - Plan Pro</p>
                                            <span class="activity-time">Hace 5 min</span>
                                        </div>
                                    </div>
                                    <div class="activity-item">
                                        <div class="activity-marker info"></div>
                                        <div class="activity-content">
                                            <p class="activity-title">Pago completado</p>
                                            <p class="activity-description">StarMart - $999.99</p>
                                            <span class="activity-time">Hace 1 hora</span>
                                        </div>
                                    </div>
                                    <div class="activity-item">
                                        <div class="activity-marker warning"></div>
                                        <div class="activity-content">
                                            <p class="activity-title">Plan actualizado</p>
                                            <p class="activity-description">BusinessFlow: Básico → Pro</p>
                                            <span class="activity-time">Hace 3 horas</span>
                                        </div>
                                    </div>
                                    <div class="activity-item">
                                        <div class="activity-marker danger"></div>
                                        <div class="activity-content">
                                            <p class="activity-title">Empresa suspendida</p>
                                            <p class="activity-description">OldStore - Falta de pago</p>
                                            <span class="activity-time">Hace 5 horas</span>
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
                                    <th>Plan</th>
                                    <th>Usuarios</th>
                                    <th>Ingresos</th>
                                    <th>Estado</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-row-hover">
                                    <td>
                                        <div class="company-cell">
                                            <div class="company-avatar" style="background: linear-gradient(135deg, #2563eb, #60a5fa);">T</div>
                                            <div>
                                                <p class="company-name">TechStore</p>
                                                <p class="company-category">Electrónica</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge-pill">Electrónica</span></td>
                                    <td><span class="badge badge-primary">Pro</span></td>
                                    <td>
                                        <div class="users-progress">
                                            <div class="progress-small">
                                                <div class="progress-fill" style="width: 48%"></div>
                                            </div>
                                            <small>24/50</small>
                                        </div>
                                    </td>
                                    <td><strong class="text-success">$599/m</strong></td>
                                    <td><span class="status-badge active">● Activa</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn btn-sm btn-action" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-action" title="Editar">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                            <button class="btn btn-sm btn-action" title="Más">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="table-row-hover">
                                    <td>
                                        <div class="company-cell">
                                            <div class="company-avatar" style="background: linear-gradient(135deg, #10b981, #6ee7b7);">S</div>
                                            <div>
                                                <p class="company-name">StarMart</p>
                                                <p class="company-category">Retail</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge-pill">Retail</span></td>
                                    <td><span class="badge badge-success">Premium</span></td>
                                    <td>
                                        <div class="users-progress">
                                            <div class="progress-small">
                                                <div class="progress-fill" style="width: 89%"></div>
                                            </div>
                                            <small>89/100</small>
                                        </div>
                                    </td>
                                    <td><strong class="text-success">$999/m</strong></td>
                                    <td><span class="status-badge active">● Activa</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn btn-sm btn-action" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-action" title="Editar">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                            <button class="btn btn-sm btn-action" title="Más">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="table-row-hover">
                                    <td>
                                        <div class="company-cell">
                                            <div class="company-avatar" style="background: linear-gradient(135deg, #8b5cf6, #d8b4fe);">B</div>
                                            <div>
                                                <p class="company-name">BusinessFlow</p>
                                                <p class="company-category">Servicios</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge-pill">Servicios</span></td>
                                    <td><span class="badge badge-warning">Básico</span></td>
                                    <td>
                                        <div class="users-progress">
                                            <div class="progress-small">
                                                <div class="progress-fill" style="width: 48%"></div>
                                            </div>
                                            <small>12/25</small>
                                        </div>
                                    </td>
                                    <td><strong class="text-success">$299/m</strong></td>
                                    <td><span class="status-badge active">● Activa</span></td>
                                    <td>
                                        <div class="action-buttons">
                                            <button class="btn btn-sm btn-action" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-action" title="Editar">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                            <button class="btn btn-sm btn-action" title="Más">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                        </div>
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