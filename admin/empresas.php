<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Empresas - PuntoVenta Admin</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="./recursos/css/dashboard.css">
    <link rel="stylesheet" href="./recursos/css/empresas.css">
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../recursos/css/sweetalert2.css">
</head>
<body>
    <!-- Sidebar (Same as Dashboard) -->
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
                <h5 class="topbar-title d-none d-md-block">Gestión de Empresas</h5>
            </div>

            <div class="topbar-search d-none d-lg-flex">
                <div class="search-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchEmpresas" placeholder="Buscar por nombre, CUIT, email..." class="search-input" data-search="empresas">
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
                                    <p class="mb-1"><strong>Nueva Empresa</strong></p>
                                    <span>Se registró una nueva empresa en el sistema</span>
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
                    <h1 class="page-title">Gestión de Empresas</h1>
                    <p class="page-subtitle">Administra todas las empresas del sistema</p>
                </div>
                <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalEmpresa">
                    <i class="fas fa-plus"></i>
                    <span>Crear Empresa</span>
                </button>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="content-wrapper">
            <!-- Filters Section -->
            <section class="filters-section">
                <div class="filters-container">
                    <div class="filter-group">
                        <select id="filterCategoria" class="form-select">
                            <option value="">Todas las categorías</option>
                            <option value="Alimentos">Alimentos</option>
                            <option value="Moda">Moda</option>
                            <option value="Electronica">Electrónica</option>
                            <option value="Ferreteria">Ferretería</option>
                            <option value="Libros">Libros</option>
                            <option value="Farmacia">Farmacia</option>
                            <option value="Clinica">Clínica</option>
                            <option value="Vehiculos">Vehículos</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <select id="filterEstado" class="form-select">
                            <option value="">Todos los estados</option>
                            <option value="activo">Activa</option>
                            <option value="inactivo">Inactiva</option>
                            <option value="suspendido">Suspendida</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <select id="filterOrden" class="form-select">
                            <option value="reciente">Más recientes</option>
                            <option value="nombre">Por nombre (A-Z)</option>
                            <option value="ingresos">Por ingresos</option>
                        </select>
                    </div>

                    <button class="btn btn-outline-secondary" id="btnLimpiarFiltros">
                        <i class="fas fa-redo"></i>
                        Limpiar filtros
                    </button>
                </div>

                <div class="filter-results">
                    <p id="resultCount">Mostrando <strong>47</strong> empresas</p>
                </div>
            </section>

            <!-- Empresas Grid -->
            <section class="empresas-grid">
                <div class="row g-3">
                    <!-- Empresa Card 1 -->
                    <div class="col-12 col-md-6 col-lg-4" data-animate="slide-in">
                        <div class="empresa-card">
                            <div class="empresa-header">
                                <div class="empresa-status activo">
                                    <span class="status-dot"></span>
                                    <span class="status-text">Activa</span>
                                </div>
                                <button class="btn btn-icon btn-sm dropdown-toggle">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>

                            <div class="empresa-logo">
                                <div class="logo-placeholder">
                                    <i class="fas fa-building"></i>
                                </div>
                            </div>

                            <div class="empresa-info">
                                <h5 class="empresa-nombre">TechStore</h5>
                                <p class="empresa-nif">NIF: ES12345678X</p>
                                <div class="empresa-categoria">
                                    <span class="badge-category">Electrónica</span>
                                </div>
                            </div>

                            <div class="empresa-stats">
                                <div class="stat">
                                    <span class="stat-value">24</span>
                                    <span class="stat-label">Usuarios</span>
                                </div>
                                <div class="stat">
                                    <span class="stat-value">$599</span>
                                    <span class="stat-label">Plan/mes</span>
                                </div>
                            </div>

                            <div class="empresa-contact">
                                <div class="contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <span>contact@tech.com</span>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-phone"></i>
                                    <span>+34 912 345 678</span>
                                </div>
                            </div>

                            <div class="empresa-actions">
                                <button class="btn btn-sm btn-primary w-100">
                                    <i class="fas fa-eye"></i>
                                    Ver Detalles
                                </button>
                                <button class="btn btn-sm btn-outline-secondary w-100">
                                    <i class="fas fa-pen"></i>
                                    Editar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Empresa Card 2 -->
                    <div class="col-12 col-md-6 col-lg-4" data-animate="slide-in">
                        <div class="empresa-card">
                            <div class="empresa-header">
                                <div class="empresa-status activo">
                                    <span class="status-dot"></span>
                                    <span class="status-text">Activa</span>
                                </div>
                                <button class="btn btn-icon btn-sm dropdown-toggle">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>

                            <div class="empresa-logo">
                                <div class="logo-placeholder" style="background: linear-gradient(135deg, #10b981, #6ee7b7);">
                                    S
                                </div>
                            </div>

                            <div class="empresa-info">
                                <h5 class="empresa-nombre">StarMart</h5>
                                <p class="empresa-nif">NIF: ES87654321Y</p>
                                <div class="empresa-categoria">
                                    <span class="badge-category">Retail</span>
                                </div>
                            </div>

                            <div class="empresa-stats">
                                <div class="stat">
                                    <span class="stat-value">89</span>
                                    <span class="stat-label">Usuarios</span>
                                </div>
                                <div class="stat">
                                    <span class="stat-value">$999</span>
                                    <span class="stat-label">Plan/mes</span>
                                </div>
                            </div>

                            <div class="empresa-contact">
                                <div class="contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <span>info@starmart.com</span>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-phone"></i>
                                    <span>+34 933 456 789</span>
                                </div>
                            </div>

                            <div class="empresa-actions">
                                <button class="btn btn-sm btn-primary w-100">
                                    <i class="fas fa-eye"></i>
                                    Ver Detalles
                                </button>
                                <button class="btn btn-sm btn-outline-secondary w-100">
                                    <i class="fas fa-pen"></i>
                                    Editar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Empresa Card 3 -->
                    <div class="col-12 col-md-6 col-lg-4" data-animate="slide-in">
                        <div class="empresa-card">
                            <div class="empresa-header">
                                <div class="empresa-status inactivo">
                                    <span class="status-dot"></span>
                                    <span class="status-text">Inactiva</span>
                                </div>
                                <button class="btn btn-icon btn-sm dropdown-toggle">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>

                            <div class="empresa-logo">
                                <div class="logo-placeholder" style="background: linear-gradient(135deg, #8b5cf6, #d8b4fe);">
                                    B
                                </div>
                            </div>

                            <div class="empresa-info">
                                <h5 class="empresa-nombre">BusinessFlow</h5>
                                <p class="empresa-nif">NIF: ES56789012Z</p>
                                <div class="empresa-categoria">
                                    <span class="badge-category">Servicios</span>
                                </div>
                            </div>

                            <div class="empresa-stats">
                                <div class="stat">
                                    <span class="stat-value">12</span>
                                    <span class="stat-label">Usuarios</span>
                                </div>
                                <div class="stat">
                                    <span class="stat-value">$299</span>
                                    <span class="stat-label">Plan/mes</span>
                                </div>
                            </div>

                            <div class="empresa-contact">
                                <div class="contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <span>hello@busflow.es</span>
                                </div>
                                <div class="contact-item">
                                    <i class="fas fa-phone"></i>
                                    <span>+34 945 678 901</span>
                                </div>
                            </div>

                            <div class="empresa-actions">
                                <button class="btn btn-sm btn-primary w-100">
                                    <i class="fas fa-eye"></i>
                                    Ver Detalles
                                </button>
                                <button class="btn btn-sm btn-outline-secondary w-100">
                                    <i class="fas fa-pen"></i>
                                    Editar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- More company cards can be added here -->
                </div>
            </section>

            <!-- Pagination -->
            <nav class="pagination-section">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#"><i class="fas fa-chevron-left"></i></a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                    </li>
                </ul>
            </nav>

            <!-- Footer -->
            <footer class="app-footer">
                <p>&copy; 2026 PuntoVenta. Todos los derechos reservados.</p>
            </footer>
        </div>
    </main>

    <!-- Modal Nueva Empresa -->
    <div class="modal fade" id="modalEmpresa" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-custom bg-primary">
                    <h5 class="modal-title text-white">Crear Empresa</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formEmpresa" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nombre Empresa <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nombre" placeholder="Mi Empresa S.A." required>
                                <div class="invalid-feedback">El nombre es requerido.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Razón Social</label>
                                <input type="text" class="form-control" name="razon_social" placeholder="Razón social completa">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">CUIT <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="cuit" placeholder="20-12345678-9" required>
                                <div class="invalid-feedback">El CUIT es requerido.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" placeholder="contacto@empresa.com" required>
                                <div class="invalid-feedback">Email válido requerido.</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" name="telefono" placeholder="+54 9 11 XXXX-XXXX">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Web</label>
                                <input type="url" class="form-control" name="web" placeholder="https://www.empresa.com">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dirección <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="direccion" placeholder="Calle 123, Piso 4" required>
                            <div class="invalid-feedback">La dirección es requerida.</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ciudad</label>
                                <input type="text" class="form-control" name="ciudad" placeholder="Buenos Aires">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Provincia</label>
                                <input type="text" class="form-control" name="provincia" placeholder="Buenos Aires">
                            </div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="activa" id="empresaActiva" checked>
                            <label class="form-check-label" for="empresaActiva">Empresa Activa</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('formEmpresa').dispatchEvent(new Event('submit'))">
                        <i class="fas fa-save me-2"></i>Crear Empresa
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="../recursos/js/sweetalert2.all.js"></script>
    
    <!-- Dashboard JS -->
    <script src="./recursos/js/dashboard.js"></script>
    
    <!-- Empresas JS -->
    <script src="./recursos/js/empresas.js"></script>
</body>
</html>