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
</head>
<body>
    <!-- Sidebar (Same as Dashboard) -->
    <aside class="sidebar">
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

        <nav class="sidebar-menu">
            <div class="menu-group">
                <div class="menu-title">Inicio</div>
                <ul class="menu-list">
                    <li>
                        <a href="dashboard.php" class="menu-item" data-section="dashboard">
                            <span class="menu-icon"><i class="fas fa-house"></i></span>
                            <span class="menu-text">Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="menu-group">
                <div class="menu-title">Empresas</div>
                <ul class="menu-list">
                    <li>
                        <a href="empresas.php" class="menu-item active" data-section="empresas">
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
                    <input type="text" id="searchEmpresas" placeholder="Buscar por nombre, NIF..." class="search-input">
                </div>
            </div>

            <div class="topbar-right">
                <div class="notification-wrapper">
                    <button class="btn btn-icon btn-notification position-relative">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                </div>
                <button class="btn btn-icon">
                    <i class="fas fa-gear"></i>
                </button>
                <div class="user-menu-wrapper">
                    <button class="btn btn-user">
                        <img src="https://ui-avatars.com/api/?name=Admin+User&background=2563eb&color=fff&rounded=true" alt="Admin">
                        <span class="d-none d-md-inline">Admin</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
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
                <button class="btn btn-primary btn-lg" id="btnCrearEmpresa">
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Empresas JS -->
    <script src="./recursos/js/empresas.js"></script>
</body>
</html>