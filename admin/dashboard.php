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
                                    <p class="mb-1"><strong>Validación Pendiente</strong></p>
                                    <span>5 empresas esperando validación</span>
                                    <small>Hace 5 min</small>
                                </div>
                            </div>
                            <div class="notification-item unread">
                                <div class="notification-icon warning">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="mb-1"><strong>Alerta del Sistema</strong></p>
                                    <span>Uso de memoria al 78%</span>
                                    <small>Hace 15 min</small>
                                </div>
                            </div>
                            <div class="notification-item">
                                <div class="notification-icon info">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="mb-1"><strong>Respaldo Completado</strong></p>
                                    <span>Base de datos respaldada exitosamente</span>
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
                        <img src="https://ui-avatars.com/api/?name=Admin+System&background=2563eb&color=fff&rounded=true" alt="Admin">
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
                        <a href="#" class="menu-link text-danger" onclick="logout(event)">
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
                                <h3 class="kpi-value">47</h3>
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
                                <?php if ($stats['empresas_pendientes'] > 0): ?>
                                <div class="kpi-change danger">
                                    <i class="fas fa-arrow-up"></i>
                                    <span><?= $stats['empresas_pendientes'] ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="kpi-body">
                                <h6 class="kpi-label">Pendientes de Validación</h6>
                                <h3 class="kpi-value">5</h3>
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
                                    <span><?= $stats['admin_activos'] ?></span>
                                </div>
                            </div>
                            <div class="kpi-body">
                                <h6 class="kpi-label">Administradores Activos</h6>
                                <h3 class="kpi-value">3</h3>
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
                                    <span>100%</span>
                                </div>
                            </div>
                            <div class="kpi-body">
                                <h6 class="kpi-label">Estado del Sistema</h6>
                                <h3 class="kpi-value">Óptimo</h3>
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
                            <div class="card-header-modern">
                                <div>
                                    <h5 class="card-title">Resumen de Estados</h5>
                                    <p class="card-subtitle">Distribución actual</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="metric-item">
                                    <div class="metric-label">Activa</div>
                                    <div class="metric-value">
                                        <span class="badge badge-primary">38 (80.85%)</span>
                                    </div>
                                </div>
                                <div class="metric-item">
                                    <div class="metric-label">Pendiente</div>
                                    <div class="metric-value">
                                        <span class="badge badge-primary">5 (10.64%)</span>
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
                                            <span class="activity-time">Hace 4 horas</span>
                                        </div>
                                    </div>
                                    <div class="activity-item">
                                        <div class="activity-marker info"></div>
                                        <div class="activity-content">
                                            <p class="activity-title">Acceso Administrativo</p>
                                            <p class="activity-description">Admin inició sesión en el sistema</p>
                                            <span class="activity-time">Hace 6 horas</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Empresas Registradas Table -->
            <section class="table-section" data-animate="slide-in">
                <div class="card-modern">
                    <div class="card-header-modern">
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
                                    <td>
                                        <span class="badge badge-light">Electrónica</span>
                                    </td>
                                    <td>ES12345678X</td>
                                    <td>
                                        <small>contact@techstore.com</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-success">Activa</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="empresas.php" class="btn btn-sm btn-primary" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="table-row-hover">
                                    <td>
                                        <img src="https://via.placeholder.com/50x50?text=SM" alt="Logo" style="width: 50px; height: 50px; border-radius: 4px; object-fit: contain;">
                                    </td>
                                    <td>
                                        <strong>StarMart</strong>
                                    </td>
                                    <td>
                                        <span class="badge badge-light">Retail</span>
                                    </td>
                                    <td>ES87654321Y</td>
                                    <td>
                                        <small>info@starmart.com</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-success">Activa</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="empresas.php" class="btn btn-sm btn-primary" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="table-row-hover">
                                    <td>
                                        <img src="https://via.placeholder.com/50x50?text=LS" alt="Logo" style="width: 50px; height: 50px; border-radius: 4px; object-fit: contain;">
                                    </td>
                                    <td>
                                        <strong>LocalShop S.L.</strong>
                                    </td>
                                    <td>
                                        <span class="badge badge-light">Comercio</span>
                                    </td>
                                    <td>B12345678</td>
                                    <td>
                                        <small>info@localshop.es</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-warning">Pendiente</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="empresas.php" class="btn btn-sm btn-primary" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <footer class="app-footer">
                <p>&copy; 2026 PuntoVenta - Sistema de Administración. Todos los derechos reservados.</p>
            </footer>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="../recursos/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chart.js -->
    <script src="../recursos/js/chart.umd.js"></script>
    
    <!-- Dashboard JS -->
    <script src="./recursos/js/dashboard.js"></script>
    
    <script>
        function actualizarDashboard() {
            location.reload();
        }
    </script>
</body>
</html>
