<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Cajas - PuntoVenta Admin</title>
    
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
    <link rel="stylesheet" href="./recursos/css/cajas.css">
    
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
                <h5 class="topbar-title d-none d-md-block">Gestión de Cajas</h5>
            </div>

            <div class="topbar-search d-none d-lg-flex">
                <div class="search-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Buscar cajas, registros..." class="search-input" data-search="cajas">
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
                                <div class="notification-icon warning">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="mb-1"><strong>Diferencia de Caja</strong></p>
                                    <span>Diferencia detectada: $50.00</span>
                                    <small>Hace 5 min</small>
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
                        <h1 class="page-title">Gestión de Cajas</h1>
                        <p class="page-description">Administra la apertura y cierre de cajas, arqueos y reportes</p>
                    </div>
                    <div class="header-actions">
                        <button class="btn btn-success btn-lg" data-action="abrir-caja">
                            <i class="fas fa-unlock-alt me-2"></i>Abrir Caja
                        </button>
                    </div>
                </div>
            </section>

            <!-- Quick Stats -->
            <section class="stats-row mb-4">
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="card-modern">
                            <div class="card-body text-center">
                                <div class="stat-icon success">
                                    <i class="fas fa-unlock-alt"></i>
                                </div>
                                <h6 class="mt-3">Cajas Abiertas</h6>
                                <h4 class="stat-value" id="cajas-abiertas">--</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-modern">
                            <div class="card-body text-center">
                                <div class="stat-icon info">
                                    <i class="fas fa-lock-alt"></i>
                                </div>
                                <h6 class="mt-3">Cajas Cerradas Hoy</h6>
                                <h4 class="stat-value" id="cajas-cerradas">--</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-modern">
                            <div class="card-body text-center">
                                <div class="stat-icon warning">
                                    <i class="fas fa-balancing-scale"></i>
                                </div>
                                <h6 class="mt-3">Arqueos Correctos</h6>
                                <h4 class="stat-value" id="arqueos-correctos">--</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-modern">
                            <div class="card-body text-center">
                                <div class="stat-icon danger">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <h6 class="mt-3">Diferencias Encontradas</h6>
                                <h4 class="stat-value" id="diferencias">--</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Filters and Search -->
            <section class="filters-section mb-4">
                <div class="card-modern">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <select class="form-select">
                                    <option value="">Todos los usuarios</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select">
                                    <option value="">Todas las cajas</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select">
                                    <option value="">Todos los estados</option>
                                    <option value="abierta">Abierta</option>
                                    <option value="cerrada">Cerrada</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-outline-primary w-100">
                                    <i class="fas fa-search me-2"></i>Filtrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Cajas Table -->
            <section class="content-section">
                <div class="card-modern">
                    <div class="card-header-modern">
                        <h5 class="card-title">Historial de Cajas</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-modern">
                                <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Apertura</th>
                                        <th>Cierre Sistema</th>
                                        <th>Cierre Físico</th>
                                        <th>Diferencia</th>
                                        <th>Estado</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="cajas-tbody">
                                    <tr class="table-row-hover">
                                        <td colspan="8" class="text-center text-muted py-4">
                                            <i class="fas fa-spinner fa-spin me-2"></i>Cargando cajas...
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

    <!-- Modal Caja -->
    <div class="modal fade" id="modalCaja" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-header-custom cajas">
                    <h5 class="modal-title">Detalles de la Caja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formCaja" class="needs-validation" novalidate>
                        <div class="caja-details">
                            <div class="detail-row">
                                <span class="detail-label">Usuario:</span>
                                <span class="detail-value" id="caja-usuario">--</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Estado:</span>
                                <span class="detail-value" id="caja-estado">Abierta</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Apertura:</span>
                                <span class="detail-value" id="caja-fecha">--</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Monto Apertura:</span>
                                <span class="detail-value" id="caja-monto-apertura">$0.00</span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('formCaja').dispatchEvent(new Event('submit'))">
                        <i class="fas fa-save me-2"></i>Guardar
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
    
    <!-- Cajas JS -->
    <script src="./recursos/js/cajas.js"></script>
</body>
</html>
