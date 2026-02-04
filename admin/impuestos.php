<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Impuestos - PuntoVenta Admin</title>
    
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
    <link rel="stylesheet" href="./recursos/css/impuestos.css">
    
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
                <h5 class="topbar-title d-none d-md-block">Configuración de Impuestos</h5>
            </div>

            <div class="topbar-search d-none d-lg-flex">
                <div class="search-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Buscar impuestos, códigos, porcentajes..." class="search-input" data-search="impuestos">
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
                                <div class="notification-icon info">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="notification-content">
                                    <p class="mb-1"><strong>Nuevo Impuesto</strong></p>
                                    <span>Se configuró un nuevo impuesto en el sistema</span>
                                    <small>Hace 1h</small>
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
                        <h1 class="page-title">Configuración de Impuestos</h1>
                        <p class="page-description">Administra las tasas de impuestos aplicables a los productos</p>
                    </div>
                    <div class="header-actions">
                        <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalImpuesto">
                            <i class="fas fa-plus me-2"></i>Nuevo Impuesto
                        </button>
                    </div>
                </div>
            </section>

            <!-- Impuestos Summary -->
            <section class="stats-row mb-4">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card-modern">
                            <div class="card-body text-center">
                                <div class="stat-icon info">
                                    <i class="fas fa-percent"></i>
                                </div>
                                <h6 class="mt-3">Total Impuestos</h6>
                                <h4 class="stat-value" id="total-impuestos">--</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-modern">
                            <div class="card-body text-center">
                                <div class="stat-icon success">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <h6 class="mt-3">Activos</h6>
                                <h4 class="stat-value" id="impuestos-activos">--</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-modern">
                            <div class="card-body text-center">
                                <div class="stat-icon warning">
                                    <i class="fas fa-calculator"></i>
                                </div>
                                <h6 class="mt-3">Tasa Promedio</h6>
                                <h4 class="stat-value" id="tasa-promedio">--</h4>
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
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Buscar impuesto...">
                            </div>
                            <div class="col-md-3">
                                <select class="form-select">
                                    <option value="">Todos los estados</option>
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-outline-primary w-100">
                                    <i class="fas fa-filter me-2"></i>Filtrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Impuestos Table -->
            <section class="content-section">
                <div class="card-modern">
                    <div class="card-header-modern">
                        <h5 class="card-title">Tasas de Impuestos</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-modern">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="form-check-input"></th>
                                        <th>Nombre del Impuesto</th>
                                        <th>Porcentaje</th>
                                        <th>Estado</th>
                                        <th>Fecha Creación</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="impuestos-tbody">
                                    <tr class="table-row-hover">
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="fas fa-spinner fa-spin me-2"></i>Cargando impuestos...
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

    <!-- Modal Nuevo Impuesto -->
    <div class="modal fade" id="modalImpuesto" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-custom bg-warning">
                    <h5 class="modal-title text-dark">Nuevo Impuesto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formImpuesto" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nombre del Impuesto <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nombre" placeholder="IVA, Impuesto Municipal, etc." required>
                                <div class="invalid-feedback">El nombre es requerido.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Código <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="codigo" placeholder="IVA_21" required>
                                <div class="invalid-feedback">El código es requerido.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control" name="descripcion" rows="2" placeholder="Descripción del impuesto..."></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Porcentaje (%) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="porcentaje" placeholder="0.00" step="0.01" min="0" max="100" required>
                                    <span class="input-group-text">%</span>
                                </div>
                                <div class="invalid-feedback">El porcentaje es requerido.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tipo Aplicación <span class="text-danger">*</span></label>
                                <select class="form-select" name="tipo_aplicacion" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="venta">Sobre Venta</option>
                                    <option value="compra">Sobre Compra</option>
                                    <option value="ambas">Ambas</option>
                                </select>
                                <div class="invalid-feedback">Selecciona un tipo.</div>
                            </div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="activo" id="impuestoActivo" checked>
                            <label class="form-check-label" for="impuestoActivo">Impuesto Activo</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-warning" onclick="document.getElementById('formImpuesto').dispatchEvent(new Event('submit'))">
                        <i class="fas fa-save me-2"></i>Guardar Impuesto
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
    
    <!-- Impuestos JS -->
    <script src="./recursos/js/impuestos.js"></script>
</body>
</html>
