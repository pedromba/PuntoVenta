<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Administradores - PuntoVenta Admin</title>
    
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
                <h5 class="topbar-title d-none d-md-block">Gestión de Usuarios</h5>
            </div>

            <div class="topbar-search d-none d-lg-flex">
                <div class="search-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Buscar usuarios, email, rol..." class="search-input" data-search="usuarios">
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
                                    <p class="mb-1"><strong>Nuevo Usuario</strong></p>
                                    <span>Se creó un nuevo usuario en el sistema</span>
                                    <small>Hace 45 min</small>
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
                        <h1 class="page-title">Gestión de Usuarios</h1>
                        <p class="page-description">Administra los usuarios y asigna roles y permisos</p>
                    </div>
                    <div class="header-actions">
                        <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalUsuario">
                            <i class="fas fa-user-plus me-2"></i>Nuevo Usuario
                        </button>
                    </div>
                </div>
            </section>

            <!-- Users Summary -->
            <section class="stats-row mb-4">
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="card-modern">
                            <div class="card-body text-center">
                                <div class="stat-icon info">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h6 class="mt-3">Total Usuarios</h6>
                                <h4 class="stat-value" id="total-usuarios">--</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-modern">
                            <div class="card-body text-center">
                                <div class="stat-icon success">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <h6 class="mt-3">Usuarios Activos</h6>
                                <h4 class="stat-value" id="usuarios-activos">--</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-modern">
                            <div class="card-body text-center">
                                <div class="stat-icon danger">
                                    <i class="fas fa-ban"></i>
                                </div>
                                <h6 class="mt-3">Inactivos</h6>
                                <h4 class="stat-value" id="usuarios-inactivos">--</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-modern">
                            <div class="card-body text-center">
                                <div class="stat-icon warning">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <h6 class="mt-3">Administradores</h6>
                                <h4 class="stat-value" id="total-admins">--</h4>
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
                                <input type="text" class="form-control" placeholder="Buscar usuario...">
                            </div>
                            <div class="col-md-3">
                                <select class="form-select">
                                    <option value="">Todos los roles</option>
                                    <option value="superadmin">Super Admin</option>
                                    <option value="admin">Admin</option>
                                    <option value="finanzas">Finanzas</option>
                                    <option value="almacen">Almacén</option>
                                    <option value="vendedor">Vendedor</option>
                                </select>
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

            <!-- Usuarios Table -->
            <section class="content-section">
                <div class="card-modern">
                    <div class="card-header-modern">
                        <h5 class="card-title">Lista de Usuarios</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-modern">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="form-check-input"></th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Empresa</th>
                                        <th>Rol</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="usuarios-tbody">
                                    <tr class="table-row-hover">
                                        <td><input type="checkbox" class="form-check-input"></td>
                                        <td>
                                            <strong>Carlos Admin</strong>
                                        </td>
                                        <td>carlos.admin@puntoventa.es</td>
                                        <td>PuntoVenta Co.</td>
                                        <td>
                                            <span class="badge bg-danger">
                                                Superadmin
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">
                                                Activo
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <tr class="table-row-hover">
                                        <td><input type="checkbox" class="form-check-input"></td>
                                        <td>
                                            <strong>María Finanzas</strong>
                                        </td>
                                        <td>maria.finanzas@puntoventa.es</td>
                                        <td>PuntoVenta Co.</td>
                                        <td>
                                            <span class="badge bg-info">
                                                Finanzas
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">
                                                Activo
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <tr class="table-row-hover">
                                        <td><input type="checkbox" class="form-check-input"></td>
                                        <td>
                                            <strong>Juan Almacén</strong>
                                        </td>
                                        <td>juan.almacen@puntoventa.es</td>
                                        <td>PuntoVenta Co.</td>
                                        <td>
                                            <span class="badge bg-warning">
                                                Almacén
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">
                                                Activo
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
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

    <!-- Modal Nuevo Usuario -->
    <div class="modal fade" id="modalUsuario" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-custom bg-primary">
                    <h5 class="modal-title text-white">Nuevo Usuario</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formUsuario" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nombre <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nombre" placeholder="Juan Pérez" required>
                                <div class="invalid-feedback">El nombre es requerido.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" placeholder="usuario@example.com" required>
                                <div class="invalid-feedback">Email válido requerido.</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Contraseña <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" placeholder="••••••••" required>
                                <div class="invalid-feedback">La contraseña es requerida.</div>
                                <small class="form-text text-muted">Mín. 8 caracteres</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Confirmar Contraseña <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password_confirm" placeholder="••••••••" required>
                                <div class="invalid-feedback">Las contraseñas no coinciden.</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Empresa <span class="text-danger">*</span></label>
                                <select class="form-select" name="empresa_id" required>
                                    <option value="">Seleccionar empresa...</option>
                                </select>
                                <div class="invalid-feedback">Selecciona una empresa válida.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Rol <span class="text-danger">*</span></label>
                                <select class="form-select" name="rol" required>
                                    <option value="">Seleccionar rol...</option>
                                    <option value="superadmin">Super Admin</option>
                                    <option value="admin">Administrador</option>
                                    <option value="finanzas">Finanzas</option>
                                    <option value="almacen">Almacén</option>
                                    <option value="vendedor">Vendedor</option>
                                </select>
                                <div class="invalid-feedback">Selecciona un rol válido.</div>
                            </div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="activo" id="usuarioActivo" checked>
                            <label class="form-check-label" for="usuarioActivo">Usuario Activo</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('formUsuario').dispatchEvent(new Event('submit'))">
                        <i class="fas fa-user-plus me-2"></i>Crear Usuario
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
    
    <!-- Usuarios JS -->
    <script src="./recursos/js/usuarios.js"></script>
</body>
</html>
