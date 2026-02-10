<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Ventas - PuntoVenta Admin</title>
    
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
    <link rel="stylesheet" href="./recursos/css/ventas.css">
    
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
                <h5 class="topbar-title d-none d-md-block">Gestión de Ventas</h5>
            </div>

            <div class="topbar-search d-none d-lg-flex">
                <div class="search-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Buscar clientes, facturas, ventas..." class="search-input" data-search="ventas">
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
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="mb-1"><strong>Venta Completada</strong></p>
                                    <span>Venta #001 - $500.00 completada</span>
                                    <small>Hace 15 min</small>
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
                        <h1 class="page-title">Registro de Ventas</h1>
                        <p class="page-description">Visualiza y gestiona todas las transacciones de ventas</p>
                    </div>
                    <div class="header-actions">
                        <button class="btn btn-primary btn-lg" data-action="nueva-venta" data-bs-toggle="modal" data-bs-target="#modalVenta">
                            <i class="fas fa-plus me-2"></i>Nueva Venta
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
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <h6 class="mt-3">Ventas Completadas</h6>
                                <h4 class="stat-value" id="ventas-completadas">--</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-modern">
                            <div class="card-body text-center">
                                <div class="stat-icon warning">
                                    <i class="fas fa-hourglass-half"></i>
                                </div>
                                <h6 class="mt-3">Presupuestos</h6>
                                <h4 class="stat-value" id="presupuestos">--</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-modern">
                            <div class="card-body text-center">
                                <div class="stat-icon danger">
                                    <i class="fas fa-ban"></i>
                                </div>
                                <h6 class="mt-3">Anuladas</h6>
                                <h4 class="stat-value" id="ventas-anuladas">--</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-modern">
                            <div class="card-body text-center">
                                <div class="stat-icon info">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <h6 class="mt-3">Ingresos Total</h6>
                                <h4 class="stat-value" id="ingresos-venta">--</h4>
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
                                <input type="text" class="form-control" placeholder="Buscar folio...">
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" id="filtro-estado">
                                    <option value="">Todos los estados</option>
                                    <option value="completada">Completada</option>
                                    <option value="presupuesto">Presupuesto</option>
                                    <option value="anulada">Anulada</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control" id="filter-fecha-inicio">
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control" id="filter-fecha-fin">
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-outline-primary w-100" data-action="buscar">
                                    <i class="fas fa-search me-2"></i>Filtrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Ventas Table -->
            <section class="content-section">
                <div class="card-modern">
                    <div class="card-header-modern">
                        <h5 class="card-title">Historial de Ventas</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-modern">
                                <thead>
                                    <tr>
                                        <th>Folio</th>
                                        <th>Cliente</th>
                                        <th>Usuario</th>
                                        <th>Total Neto</th>
                                        <th>Impuestos</th>
                                        <th>Total</th>
                                        <th>Método Pago</th>
                                        <th>Estado</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="ventas-tbody">
                                    <tr class="table-row-hover">
                                        <td colspan="10" class="text-center text-muted py-4">
                                            <i class="fas fa-spinner fa-spin me-2"></i>Cargando ventas...
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

    <!-- Modal Venta -->
    <div class="modal fade" id="modalVenta" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-custom ventas">
                    <h5 class="modal-title">Nueva Venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formVenta" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Cliente</label>
                                    <input type="text" class="form-control" name="cliente" required>
                                    <div class="invalid-feedback">Ingrese el nombre del cliente</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Usuario</label>
                                    <select class="form-select" name="usuario" required>
                                        <option value="">Seleccionar usuario</option>
                                        <option value="1">Admin User</option>
                                        <option value="2">Vendedor 1</option>
                                    </select>
                                    <div class="invalid-feedback">Seleccione un usuario</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tipo de Venta</label>
                                    <select class="form-select" name="tipo_venta" required>
                                        <option value="">Seleccionar tipo</option>
                                        <option value="venta">Venta Completada</option>
                                        <option value="presupuesto">Presupuesto</option>
                                    </select>
                                    <div class="invalid-feedback">Seleccione el tipo de venta</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Método de Pago</label>
                                    <select class="form-select" name="metodo_pago" required>
                                        <option value="">Seleccionar método</option>
                                        <option value="efectivo">Efectivo</option>
                                        <option value="tarjeta">Tarjeta</option>
                                        <option value="cheque">Cheque</option>
                                    </select>
                                    <div class="invalid-feedback">Seleccione un método de pago</div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('formVenta').dispatchEvent(new Event('submit'))">
                        <i class="fas fa-plus me-2"></i>Registrar Venta
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
    
    <!-- Ventas JS -->
    <script src="./recursos/js/ventas.js"></script>
</body>
</html>
