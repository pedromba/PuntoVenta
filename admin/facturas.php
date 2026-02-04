<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Facturas - PuntoVenta Admin</title>
    
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
    <link rel="stylesheet" href="./recursos/css/facturas.css">
    
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
                <h5 class="topbar-title d-none d-md-block">Gestión de Facturas</h5>
            </div>

            <div class="topbar-search d-none d-lg-flex">
                <div class="search-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Buscar facturas, CUIT, clientes..." class="search-input" data-search="facturas">
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
                                    <p class="mb-1"><strong>Factura Emitida</strong></p>
                                    <span>Factura A-0001-00000123 generada exitosamente</span>
                                    <small>Hace 30 min</small>
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
                        <h1 class="page-title">Gestión de Facturas</h1>
                        <p class="page-description">Administra las facturas fiscales emitidas y sus registros</p>
                    </div>
                    <div class="header-actions">
                        <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalFactura">
                            <i class="fas fa-file-invoice-dollar me-2"></i>Nueva Factura
                        </button>
                        <button class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-file-pdf me-2"></i>Descargar Reporte
                        </button>
                    </div>
                </div>
            </section>

            <!-- Quick Stats -->
            <section class="stats-row mb-4">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card-modern">
                            <div class="card-body text-center">
                                <div class="stat-icon info">
                                    <i class="fas fa-file-invoice"></i>
                                </div>
                                <h6 class="mt-3">Total Facturas</h6>
                                <h4 class="stat-value" id="total-facturas">--</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-modern">
                            <div class="card-body text-center">
                                <div class="stat-icon success">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <h6 class="mt-3">Emitidas Hoy</h6>
                                <h4 class="stat-value" id="emitidas-hoy">--</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-modern">
                            <div class="card-body text-center">
                                <div class="stat-icon warning">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <h6 class="mt-3">Ingresos Fiscales</h6>
                                <h4 class="stat-value" id="ingresos-fiscales">--</h4>
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
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Buscar número de factura...">
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-outline-primary w-100">
                                    <i class="fas fa-search me-2"></i>Filtrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Facturas Table -->
            <section class="content-section">
                <div class="card-modern">
                    <div class="card-header-modern">
                        <h5 class="card-title">Historial de Facturas</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-modern">
                                <thead>
                                    <tr>
                                        <th>Número Factura</th>
                                        <th>Venta Asociada</th>
                                        <th>Cliente</th>
                                        <th>Monto Total</th>
                                        <th>Fecha Emisión</th>
                                        <th>PDF</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="facturas-tbody">
                                    <tr class="table-row-hover">
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="fas fa-spinner fa-spin me-2"></i>Cargando facturas...
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

    <!-- Modal Nueva Factura -->
    <div class="modal fade" id="modalFactura" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-custom bg-primary">
                    <h5 class="modal-title text-white">Nueva Factura</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formFactura" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Venta Asociada <span class="text-danger">*</span></label>
                                <select class="form-select" name="venta_id" required>
                                    <option value="">Seleccionar venta...</option>
                                </select>
                                <div class="invalid-feedback">Selecciona una venta válida.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tipo Factura <span class="text-danger">*</span></label>
                                <select class="form-select" name="tipo_factura" required>
                                    <option value="">Seleccionar tipo...</option>
                                    <option value="A">Factura A</option>
                                    <option value="B">Factura B</option>
                                    <option value="C">Factura C</option>
                                </select>
                                <div class="invalid-feedback">Selecciona un tipo válido.</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Número Factura <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="numero_factura" placeholder="A-0001-00000001" required>
                                <div class="invalid-feedback">El número de factura es requerido.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Fecha Emisión <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="fecha_emision" required>
                                <div class="invalid-feedback">La fecha es requerida.</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">CUIT Empresa <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="cuit_empresa" placeholder="20-12345678-9" required>
                                <div class="invalid-feedback">El CUIT es requerido.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Punto de Venta <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="punto_venta" placeholder="0001" required>
                                <div class="invalid-feedback">El punto de venta es requerido.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Observaciones</label>
                            <textarea class="form-control" name="observaciones" rows="2" placeholder="Observaciones adicionales..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('formFactura').dispatchEvent(new Event('submit'))">
                        <i class="fas fa-save me-2"></i>Generar Factura
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ajuste de Stock -->
    <div class="modal fade" id="modalAjusteStock" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-custom bg-success">
                    <h5 class="modal-title text-white">Ajustar Stock</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formAjusteStock" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label class="form-label">Producto <span class="text-danger">*</span></label>
                            <select class="form-select" name="producto_id" required>
                                <option value="">Seleccionar producto...</option>
                            </select>
                            <div class="invalid-feedback">Selecciona un producto válido.</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Stock Actual</label>
                                <input type="text" class="form-control" id="stockActual" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tipo Movimiento <span class="text-danger">*</span></label>
                                <select class="form-select" name="tipo_movimiento" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="entrada">Entrada (+)</option>
                                    <option value="salida">Salida (-)</option>
                                </select>
                                <div class="invalid-feedback">Selecciona un tipo de movimiento.</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cantidad <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="cantidad" placeholder="0" min="1" required>
                            <div class="invalid-feedback">La cantidad es requerida.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Motivo <span class="text-danger">*</span></label>
                            <select class="form-select" name="motivo" required>
                                <option value="">Seleccionar motivo...</option>
                                <option value="compra">Compra</option>
                                <option value="venta">Venta</option>
                                <option value="ajuste">Ajuste por Inventario</option>
                                <option value="rotura">Rotura/Daño</option>
                                <option value="devolucion">Devolución</option>
                            </select>
                            <div class="invalid-feedback">El motivo es requerido.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Observaciones</label>
                            <textarea class="form-control" name="observaciones" rows="2" placeholder="Detalles adicionales..."></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" onclick="document.getElementById('formAjusteStock').dispatchEvent(new Event('submit'))">
                        <i class="fas fa-check me-2"></i>Registrar Ajuste
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
    
    <!-- Facturas JS -->
    <script src="./recursos/js/facturas.js"></script>
</body>
</html>
