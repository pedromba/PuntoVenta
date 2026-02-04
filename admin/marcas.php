<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Marcas - PuntoVenta Admin</title>

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
    <link rel="stylesheet" href="./recursos/css/marcas.css">

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
                <h5 class="topbar-title d-none d-md-block">Gestión de Marcas</h5>
            </div>

            <div class="topbar-search d-none d-lg-flex">
                <div class="search-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Buscar marcas, proveedores..." class="search-input" data-search="marcas">
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
                                    <p class="mb-1"><strong>Nueva Marca</strong></p>
                                    <span>Se agregó una nueva marca al sistema</span>
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
                        <h1 class="page-title">Gestión de Marcas</h1>
                        <p class="page-description">Administra las marcas de productos de tu empresa</p>
                    </div>
                    <div class="header-actions">
                        <button class="btn btn-primary btn-lg" data-action="nueva-marca" data-bs-toggle="modal" data-bs-target="#modalMarca">
                            <i class="fas fa-plus me-2"></i>Nueva Marca
                        </button>
                    </div>
                </div>
            </section>

            <!-- Filters and Search -->
            <section class="filters-section mb-4">
                <div class="card-modern">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Buscar marca..." data-search="marcas">
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-outline-primary w-100" data-action="buscar">
                                    <i class="fas fa-search me-2"></i>Filtrar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Marcas Table -->
            <section class="content-section">
                <div class="card-modern">
                    <div class="card-header-modern">
                        <h5 class="card-title">Marcas Registradas</h5>
                        <div class="header-stats">
                            <span class="stat-badge">Total: --</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-modern">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="form-check-input"></th>
                                        <th>Nombre</th>
                                        <th>Productos</th>
                                        <th>Fecha Registro</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="marcas-tbody">
                                    <tr class="table-row-hover">
                                        <td colspan="5" class="text-center text-muted py-4">
                                            <i class="fas fa-spinner fa-spin me-2"></i>Cargando marcas...
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

    <!-- Modal Marca -->
    <div class="modal fade" id="modalMarca" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-header-custom marcas">
                    <h5 class="modal-title">Nueva Marca</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formMarca" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label class="form-label">Nombre de la Marca</label>
                            <input type="text" class="form-control" name="nombre" placeholder="Ej: Samsung, LG, etc." required>
                            <div class="invalid-feedback">El nombre de la marca es requerido</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control" name="descripcion" rows="3" placeholder="Información sobre la marca..."></textarea>
                        </div>

                        <div class="mb-0">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" name="activo" checked>
                                <span class="form-check-label">Marca Activa</span>
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('formMarca').dispatchEvent(new Event('submit'))">
                        <i class="fas fa-save me-2"></i>Guardar Marca
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

    <!-- Marcas JS -->
    <script src="./recursos/js/marcas.js"></script>
</body>

</html>