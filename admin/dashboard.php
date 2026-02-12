<?php
session_start();

// Verificar autenticación
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header('Location: ../index.php');
    exit();
}

// Verificar que sea administrador
if (!$_SESSION['es_superadmin'] && !in_array('Administrador', $_SESSION['roles'] ?? [])) {
    header('Location: ../empresa/dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PuntoVenta Admin - Panel de Control</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../recursos/css/all.css">
<!-- SweetAlert2 CSS --> <link rel="stylesheet" href="./recursos/enlaces/sweetalert2.css"> 
 <!-- CSS Personalizado --> 
  <link rel="stylesheet" href="./recursos/css/dashboard.css"> </head> <body>
    <!-- Sidebar Moderno -->
   <?php include "./componentes/aside.php" ?>

    <!-- Overlay Sidebar Mobile -->
    <div class="sidebar-overlay"></div>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Mensaje de Éxito (Autenticación Completa) -->
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 20px; border-radius: 12px; border-left: 4px solid #10b981; background: #d1fae5; color: #065f46;">
            <div style="display: flex; align-items: center; gap: 15px;">
                <div style="font-size: 32px;">✅</div>
                <div style="flex: 1;">
                    <h5 style="margin: 0 0 5px 0; color: #065f46; font-weight: 600;">
                        ¡Bienvenido, <span id="usuario-nombre">Cargando...</span>!
                    </h5>
                    <p style="margin: 0; font-size: 14px;">
                        Autenticación 2FA completada exitosamente. Accediste al panel de <strong>Administrador</strong>
                    </p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        
        <!-- Topbar -->
        <div class="topbar">
            <div class="topbar-left">
                <button class="btn btn-icon btn-toggle-sidebar d-lg-none">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="topbar-title d-none d-md-block">Panel de Control del Administrador</h5>
            </div>

            <div class="topbar-search d-none d-lg-flex">
                <div class="search-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Buscar empresas, usuarios..." class="search-input">
                    <div class="search-results" style="display: none;"></div>
                </div>
            </div>

            <div class="topbar-right">
                <!-- Notifications Dropdown -->
                <div class="dropdown notification-wrapper">
                    <button class="btn btn-icon btn-notification position-relative" type="button" id="dropdownNotifications" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge" id="notification-count" style="display: none;">0</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end notification-menu" aria-labelledby="dropdownNotifications" style="width: 380px; max-height: 500px; overflow-y: auto;">
                        <div class="notification-header px-3 py-2 border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Notificaciones</h6>
                                <button class="btn btn-sm btn-link text-muted p-0">Marcar todas como leídas</button>
                            </div>
                        </div>
                        <div class="notification-list" id="notification-list">
                            <div class="text-center py-4">
                                <i class="fas fa-bell-slash fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">No hay notificaciones</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings Button -->
                <a href="configuracion.php" class="btn btn-icon" title="Configuración">
                    <i class="fas fa-gear"></i>
                </a>

                <!-- User Menu Dropdown -->
                <div class="dropdown user-menu-wrapper">
                    <button class="btn btn-user" type="button" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://ui-avatars.com/api/?name=Usuario&background=2563eb&color=fff&rounded=true" alt="Usuario" id="user-avatar">
                        <span class="d-none d-md-inline" id="user-name-topbar">Cargando...</span>
                        <i class="fas fa-chevron-down ms-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end user-menu" aria-labelledby="dropdownUser" style="min-width: 250px;">
                        <div class="px-3 py-2 border-bottom">
                            <p class="mb-0 fw-bold" id="user-name-dropdown">Usuario</p>
                            <small class="text-muted" id="user-email-dropdown">email@ejemplo.com</small>
                        </div>
                        <a href="perfil.php" class="dropdown-item menu-link py-2">
                            <i class="fas fa-user me-2"></i> Mi Perfil
                        </a>
                        
                        <div class="dropdown-divider"></div>
                        <a href="./cerrarSession.php" class="dropdown-item menu-link text-danger py-2" >
                            <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <div class="header-content">
                <div>
                    <h1 class="page-title">Panel de Control</h1>
                    <p class="page-subtitle">Resumen de la gestión del sistema y empresas</p>
                </div>
                <div style="display: flex; gap: 10px;">
                    <a href="validacion-empresas.php" class="btn btn-primary btn-lg">
                        <i class="fas fa-check-circle"></i>
                        <span>Validar Empresas</span>
                    </a>
                    <button class="btn btn-outline-primary btn-lg" onclick="actualizarDashboard()">
                        <i class="fas fa-sync"></i>
                        <span>Actualizar</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="content-wrapper">
            <!-- KPI Cards Section -->
            <section class="kpi-section">
                <div class="row g-3 mb-4">
                    <!-- KPI Card 1: Empresas Registradas -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="kpi-card" data-animate="slide-in">
                            <div class="kpi-header">
                                <div class="kpi-icon-wrapper" style="--color: #2563eb;">
                                    <i class="fas fa-building"></i>
                                </div>
                            </div>
                            <div class="kpi-body">
                                <h6 class="kpi-label">Empresas Registradas</h6>
                                <h3 class="kpi-value" id="kpi-empresas-total">
                                    <span class="spinner-border spinner-border-sm" role="status"></span>
                                </h3>
                                <p class="kpi-footer">
                                    <a href="empresas.php" style="text-decoration: none; color: #2563eb;">Ver todas →</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- KPI Card 2: Validación Pendiente -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="kpi-card" data-animate="slide-in">
                            <div class="kpi-header">
                                <div class="kpi-icon-wrapper" style="--color: #f59e0b;">
                                    <i class="fas fa-hourglass"></i>
                                </div>
                                <div class="kpi-change danger" id="kpi-pendientes-badge" style="display: none;">
                                    <i class="fas fa-arrow-up"></i>
                                    <span id="kpi-pendientes-badge-value">0</span>
                                </div>
                            </div>
                            <div class="kpi-body">
                                <h6 class="kpi-label">Pendientes de Validación</h6>
                                <h3 class="kpi-value" id="kpi-empresas-pendientes">
                                    <span class="spinner-border spinner-border-sm" role="status"></span>
                                </h3>
                                <p class="kpi-footer">
                                    <a href="validacion-empresas.php" style="text-decoration: none; color: #f59e0b;">Validar ahora →</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- KPI Card 3: Usuarios Administrativos -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="kpi-card" data-animate="slide-in">
                            <div class="kpi-header">
                                <div class="kpi-icon-wrapper" style="--color: #10b981;">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="kpi-status online">
                                    <span class="status-dot"></span>
                                    <span id="kpi-admin-activos-badge">0</span>
                                </div>
                            </div>
                            <div class="kpi-body">
                                <h6 class="kpi-label">Administradores Activos</h6>
                                <h3 class="kpi-value" id="kpi-admin-activos">
                                    <span class="spinner-border spinner-border-sm" role="status"></span>
                                </h3>
                                <p class="kpi-footer">
                                    <a href="usuarios.php" style="text-decoration: none; color: #10b981;">Gestionar →</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- KPI Card 4: Salud del Sistema -->
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="kpi-card" data-animate="slide-in">
                            <div class="kpi-header">
                                <div class="kpi-icon-wrapper" style="--color: #8b5cf6;">
                                    <i class="fas fa-heartbeat"></i>
                                </div>
                                <div class="kpi-status online">
                                    <span class="status-dot"></span>
                                    <span id="kpi-sistema-porcentaje">0%</span>
                                </div>
                            </div>
                            <div class="kpi-body">
                                <h6 class="kpi-label">Estado del Sistema</h6>
                                <h3 class="kpi-value" id="kpi-sistema-estado">
                                    <span class="spinner-border spinner-border-sm" role="status"></span>
                                </h3>
                                <p class="kpi-footer">
                                    <a href="salud-sistema.php" style="text-decoration: none; color: #8b5cf6;">Detalles →</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Charts and Data Section -->
            <section class="charts-section">
                <div class="row g-3 mb-4">
                    <!-- Empresas por Estado -->
                    <div class="col-12 col-lg-8" data-animate="slide-in">
                        <div class="card-modern">
                            <div class="card-header-modern">
                                <div>
                                    <h5 class="card-title">Empresas por Estado</h5>
                                    <p class="card-subtitle">Distribución de empresas en el sistema</p>
                                </div>
                                <div class="card-actions">
                                    <button class="btn btn-icon btn-sm">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="empresasEstadoChart" style="height: 300px;"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Actividad Reciente por Empresa -->
                    <div class="col-12 col-lg-4" data-animate="slide-in">
                        <div class="card-modern">
                            <div class="card-heade id="estados-resumen">
                                <div class="text-center py-4">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Cargando...)</span>
                                    </div>
                                </div>
                                <div class="metric-item">
                                    <div class="metric-label">Suspendida</div>
                                    <div class="metric-value">
                                        <span class="badge badge-primary">4 (8.51%)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Row -->
                <div class="row g-3 mb-4">
                    <!-- Sistema y Base de Datos -->
                    <div class="col-12 col-md-6" data-animate="slide-in">
                        <div class="card-modern">
                            <div class="card-header-modern">
                                <h5 class="card-title">Estado del Sistema</h5>
                            </div>
                            <div class="card-body">
                                <div class="metric-item">
                                    <div class="metric-label">Base de Datos</div>
                                    <div class="metric-value">
                                        <span class="badge badge-success">En línea</span>
                                    </div>
                                    <div class="progress-bar-wrapper">
                                        <div class="progress-bar-custom" style="width: 75%; background: linear-gradient(90deg, #10b981, #34d399);"></div>
                                    </div>
                                    <small>75% de capacidad utilizada</small>
                                </div>
                                <div class="metric-item">
                                    <div class="metric-label">Espacio en Disco</div>
                                    <div class="metric-value">
                                        <span class="badge badge-info">250 GB</span>
                                    </div>
                                    <div class="progress-bar-wrapper">
                                        <div class="progress-bar-custom" style="width: 60%; background: linear-gradient(90deg, #0ea5e9, #06b6d4);"></div>
                                    </div>
                                    <small>60% disponible</small>
                                </div>
                                <div class="metric-item">
                                    <div class="metric-label">Últimas Acciones</div>
                                    <div class="metric-value">
                                        <span class="badge badge-success">Activas</span>
                                    </div>
                                    <div class="progress-bar-wrapper">
                                        <div class="progress-bar-custom" style="width: 100%; background: linear-gradient(90deg, #10b981, #34d399);"></div>
                                    </div>
                                    <small>Sistema respondiendo normalmente</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Auditoría Reciente -->
                    <div class="col-12 col-md-6" data-animate="slide-in">
                        <div class="card-modern">
                            <div class="card-header-modern">
                                <h5 class="card-title">Actividad de Auditoría Reciente</h5>
                            </div>
                            <div class="card-body">
                                <div class="activity-feed" id="recent-activity">
                                    <div class="activity-item">
                                        <div class="activity-marker success"></div>
                                        <div class="activity-content">
                                            <p class="activity-title">Empresa Validada</p>
                                            <p class="activity-description">TechStore - Empresa registrada correctamente</p>
                                            <span class="activity-time">Hace 2 horas</span>
                                        </div>
                                    </div>
                                    <div class="activity-item">
                                        <div class="activity-marker warning"></div>
                                        <div class="activity-content">
                                            <p class="activity-title">Solicitud Pendiente</p>
                                            <p class="activity-description">LocalShop - Esperando validación de documentos</p>
                                            <spatext-center py-4">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Cargando actividad...
                        <div>
                            <h5 class="card-title">Empresas Registradas</h5>
                            <p class="card-subtitle">Listado de todas las empresas en el sistema</p>
                        </div>
                        <a href="empresas.php" class="link-modern">Ver todas →</a>
                    </div>
                    <div class="table-wrapper">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th style="width: 60px;"></th>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>NIF/CIF</th>
                                    <th>Contacto</th>
                                    <th>Estado</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="empresas-tbody">
                                <tr class="table-row-hover">
                                    <td>
                                        <img src="https://via.placeholder.com/50x50?text=TS" alt="Logo" style="width: 50px; height: 50px; border-radius: 4px; object-fit: contain;">
                                    </td>
                                    <td>
                                        <strong>TechStore</strong>
                                    </td>
                                   >
                                    <td colspan="7" class="text-center py-4">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Cargando empresas...</span>
                                        </div>
                                        <p class="mt-2 text-muted">Cargando listado de empresas...</p

            <!-- Footer -->
            <footer class="app-footer">
                <p>&copy; 2026 PuntoVenta - Sistema de Administración. Todos los derechos reservados.</p>
            </footer>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="../recursos/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 JS -->
    <script src="../recursos/js/sweetalert2.all.js"></script>
    
    <!-- Chart.js -->
    <script src="../recursos/js/chart.umd.js"></script>
    
    <!-- Dashboard JS -->
    <script src="./recursos/js/dashboard.js"></script>
</body>
</html>
