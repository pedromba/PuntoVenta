<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Empresas - PuntoVenta Admin</title>
    
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
    <link rel="stylesheet" href="./recursos/css/empresas.css">
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../recursos/css/sweetalert2.css">
</head>
<body>
    <!-- Sidebar -->
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
                    <input type="text" id="searchEmpresas" placeholder="Buscar por nombre, email..." class="search-input" autocomplete="off">
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
                            <option value="electronica">Electrónica</option>
                            <option value="retail">Retail</option>
                            <option value="servicios">Servicios</option>
                            <option value="alimentos">Alimentos</option>
                            <option value="moda">Moda</option>
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
                            <option value="usuarios">Por usuarios</option>
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
                <div class="row g-4" id="empresasContainer">
                    <!-- Empresa Card 1 -->
                    <div class="col-12 col-md-6 col-lg-4 empresa-item" data-categoria="electronica" data-estado="activo">
                        <div class="empresa-card-modern">
                            <!-- Status Badge -->
                            <div class="empresa-status-badge activo">
                                <span class="status-dot"></span>
                                <span>Activa</span>
                            </div>

                            <!-- Header con Logo -->
                            <div class="empresa-card-header">
                                <div class="empresa-logo-wrapper" style="background-image: url('https://via.placeholder.com/200x100?text=TechStore'); background-size: contain; background-repeat: no-repeat; background-position: center;">
                                    <div class="empresa-logo-icon">
                                        <i class="fas fa-laptop"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Body -->
                            <div class="empresa-card-body">
                                <h4 class="empresa-nombre">TechStore</h4>
                                <p class="empresa-nif-text">NIF: <strong>ES12345678X</strong></p>
                                
                                <div class="empresa-categoria-badge">
                                    <span>Electrónica</span>
                                </div>

                                <!-- Stats -->
                                <div class="empresa-card-stats">
                                    <div class="stat-item">
                                        <span class="stat-label">Usuarios</span>
                                        <span class="stat-value">24</span>
                                    </div>
                                    <div class="stat-divider"></div>
                                    <div class="stat-item">
                                        <span class="stat-label">Plan</span>
                                        <span class="stat-value">79 FCFA/mes</span>
                                    </div>
                                </div>

                                <!-- Contact -->
                                <div class="empresa-card-contact">
                                    <a href="mailto:contact@tech.com" class="contact-link" title="Enviar email">
                                        <i class="fas fa-envelope"></i>
                                        <span>contact@tech.com</span>
                                    </a>
                                    <a href="tel:+240222144858" class="contact-link" title="Llamar">
                                        <i class="fas fa-phone"></i>
                                        <span>+240 222 144 858</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="empresa-card-footer">
                                <button class="btn-card-action primary" onclick="verDetalles(1)" title="Ver detalles de la empresa">
                                    <i class="fas fa-eye"></i>
                                    Ver Detalles
                                </button>
                                <button class="btn-card-action secondary" onclick="editarEmpresa(1)" title="Editar información">
                                    <i class="fas fa-pen"></i>
                                    Editar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Empresa Card 2 -->
                    <div class="col-12 col-md-6 col-lg-4 empresa-item" data-categoria="retail" data-estado="activo">
                        <div class="empresa-card-modern">
                            <!-- Status Badge -->
                            <div class="empresa-status-badge activo">
                                <span class="status-dot"></span>
                                <span>Activa</span>
                            </div>

                            <!-- Header con Logo -->
                            <div class="empresa-card-header">
                                <div class="empresa-logo-wrapper" style="background-image: url('https://via.placeholder.com/200x100?text=ShopHub'); background-size: contain; background-repeat: no-repeat; background-position: center; background: linear-gradient(135deg, #10b981, #6ee7b7);">
                                    <div class="empresa-logo-icon" style="color: white;">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Body -->
                            <div class="empresa-card-body">
                                <h4 class="empresa-nombre">StarMart</h4>
                                <p class="empresa-nif-text">NIF: <strong>ES87654321Y</strong></p>
                                
                                <div class="empresa-categoria-badge">
                                    <span>Retail</span>
                                </div>

                                <!-- Stats -->
                                <div class="empresa-card-stats">
                                    <div class="stat-item">
                                        <span class="stat-label">Usuarios</span>
                                        <span class="stat-value">18</span>
                                    </div>
                                    <div class="stat-divider"></div>
                                    <div class="stat-item">
                                        <span class="stat-label">Plan</span>
                                        <span class="stat-value">$399/mes</span>
                                    </div>
                                </div>

                                <!-- Contact -->
                                <div class="empresa-card-contact">
                                    <a href="mailto:info@starmart.com" class="contact-link" title="Enviar email">
                                        <i class="fas fa-envelope"></i>
                                        <span>info@starmart.com</span>
                                    </a>
                                    <a href="tel:+34933456789" class="contact-link" title="Llamar">
                                        <i class="fas fa-phone"></i>
                                        <span>+34 933 456 789</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="empresa-card-footer">
                                <button class="btn-card-action primary" onclick="verDetalles(2)" title="Ver detalles de la empresa">
                                    <i class="fas fa-eye"></i>
                                    Ver Detalles
                                </button>
                                <button class="btn-card-action secondary" onclick="editarEmpresa(2)" title="Editar información">
                                    <i class="fas fa-pen"></i>
                                    Editar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Empresa Card 3 -->
                    <div class="col-12 col-md-6 col-lg-4 empresa-item" data-categoria="servicios" data-estado="inactivo">
                        <div class="empresa-card-modern">
                            <!-- Status Badge -->
                            <div class="empresa-status-badge inactivo">
                                <span class="status-dot"></span>
                                <span>Inactiva</span>
                            </div>

                            <!-- Header con Logo -->
                            <div class="empresa-card-header">
                                <div class="empresa-logo-wrapper" style="background-image: url('https://via.placeholder.com/200x100?text=BusinessFlow'); background-size: contain; background-repeat: no-repeat; background-position: center; background: linear-gradient(135deg, #f59e0b, #fbbf24);">
                                    <div class="empresa-logo-icon" style="color: white;">
                                        <i class="fas fa-briefcase"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Body -->
                            <div class="empresa-card-body">
                                <h4 class="empresa-nombre">BusinessFlow</h4>
                                <p class="empresa-nif-text">NIF: <strong>ES11223344Z</strong></p>
                                
                                <div class="empresa-categoria-badge">
                                    <span>Servicios</span>
                                </div>

                                <!-- Stats -->
                                <div class="empresa-card-stats">
                                    <div class="stat-item">
                                        <span class="stat-label">Usuarios</span>
                                        <span class="stat-value">8</span>
                                    </div>
                                    <div class="stat-divider"></div>
                                    <div class="stat-item">
                                        <span class="stat-label">Plan</span>
                                        <span class="stat-value">$199/mes</span>
                                    </div>
                                </div>

                                <!-- Contact -->
                                <div class="empresa-card-contact">
                                    <a href="mailto:support@business.com" class="contact-link" title="Enviar email">
                                        <i class="fas fa-envelope"></i>
                                        <span>support@business.com</span>
                                    </a>
                                    <a href="tel:+34944567890" class="contact-link" title="Llamar">
                                        <i class="fas fa-phone"></i>
                                        <span>+34 944 567 890</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="empresa-card-footer">
                                <button class="btn-card-action primary" onclick="verDetalles(3)" title="Ver detalles de la empresa">
                                    <i class="fas fa-eye"></i>
                                    Ver Detalles
                                </button>
                                <button class="btn-card-action secondary" onclick="editarEmpresa(3)" title="Editar información">
                                    <i class="fas fa-pen"></i>
                                    Editar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <footer class="app-footer">
                <p>&copy; 2026 PuntoVenta - Sistema de Administración. Todos los derechos reservados.</p>
            </footer>
        </div>
    </main>

    <!-- Modal Nueva Empresa -->
    <div class="modal fade" id="modalEmpresa" tabindex="-1" aria-labelledby="modalEmpresaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-custom bg-primary">
                    <h5 class="modal-title text-white" id="modalEmpresaLabel">Crear Nueva Empresa</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEmpresa" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nombre Comercial <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nombre_comercial" placeholder="Mi Empresa S.A." required>
                                <div class="invalid-feedback">El nombre es requerido.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NIF/CIF <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nif_cif" placeholder="ES12345678X" required>
                                <div class="invalid-feedback">El NIF/CIF es requerido.</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email Contacto <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email_contacto" placeholder="contacto@empresa.com" required>
                                <div class="invalid-feedback">Email válido requerido.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" name="telefono" placeholder="+34 912 345 678">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="direccion" placeholder="Calle 123, Piso 4">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sitio Web</label>
                                <input type="url" class="form-control" name="web" placeholder="https://www.empresa.com">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Categoría <span class="text-danger">*</span></label>
                                <select class="form-select" name="categoria_negocio" required>
                                    <option value="">Seleccionar categoría...</option>
                                    <option value="Alimentos">Alimentos</option>
                                    <option value="Moda">Moda</option>
                                    <option value="Electronica">Electrónica</option>
                                    <option value="Ferreteria">Ferretería</option>
                                    <option value="Libros">Libros</option>
                                    <option value="Farmacia">Farmacia</option>
                                    <option value="Clinica">Clínica</option>
                                    <option value="Vehiculos">Vehículos</option>
                                </select>
                                <div class="invalid-feedback">Selecciona una categoría válida.</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Horario de Atención</label>
                                <input type="text" class="form-control" name="horario_atencion" placeholder="Lunes a Viernes 9:00 - 18:00">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Cuenta Bancaria</label>
                                <input type="text" class="form-control" name="cuenta_bancaria" placeholder="ES91 2100 0418 45023847">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Logo de la Empresa</label>
                            <input type="file" class="form-control" name="logo_file" accept="image/*" id="logoUpload">
                            <small class="form-text text-muted">Formatos soportados: JPG, PNG, GIF (máx. 5MB)</small>
                            <!-- Preview del logo -->
                            <div id="logoPreview" class="mt-2" style="display: none;">
                                <small class="d-block mb-2">Vista previa:</small>
                                <img id="previewImg" src="" alt="Logo preview" style="max-height: 150px; border-radius: 4px; border: 1px solid #ddd; padding: 4px;">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">O URL del Logo (alternativa)</label>
                            <input type="url" class="form-control" name="logo_url" placeholder="https://ejemplo.com/logo.png">
                            <small class="form-text text-muted">Si cargas una imagen arriba, esta URL se ignorará</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select class="form-select" name="estado">
                                <option value="activo" selected>Activo</option>
                                <option value="inactivo">Inactivo</option>
                                <option value="suspendido">Suspendido</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarEmpresa">
                        <i class="fas fa-save me-2"></i>Crear Empresa
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="../recursos/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="../recursos/js/sweetalert2.all.js"></script>

    <!-- Custom JS -->
    <script src="./recursos/js/empresas.js"></script>
    
    <!-- Logo Preview Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logoUpload = document.getElementById('logoUpload');
            const previewDiv = document.getElementById('logoPreview');
            const previewImg = document.getElementById('previewImg');
            
            if (logoUpload) {
                logoUpload.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            previewImg.src = event.target.result;
                            previewDiv.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    } else {
                        previewDiv.style.display = 'none';
                    }
                });
            }
        });
    </script>
</body>
</html>
