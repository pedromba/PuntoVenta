<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías - PuntoVenta Admin</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../recursos/css/all.css">
    
    <!-- CSS Personalizado Dashboard -->
    <link rel="stylesheet" href="./recursos/css/dashboard.css">
    
    <!-- CSS Personalizado Categorías -->
    <link rel="stylesheet" href="./recursos/css/categoriasEmpresas.css">
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../recursos/css/sweetalert2.css">
</head>
<body>
    <!-- Sidebar Moderno (Igual al Dashboard) -->
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
                <h5 class="topbar-title d-none d-md-block">Gestión de Categorías</h5>
            </div>

            <div class="topbar-search d-none d-lg-flex">
                <div class="search-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Buscar categorías..." class="search-input">
                    <div class="search-results" style="display: none;">
                        <div class="result-item">
                            <i class="fas fa-layer-group"></i>
                            <span>Electrónica - Categoría</span>
                        </div>
                    </div>
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
                                    <p class="mb-1"><strong>Nueva categoría</strong></p>
                                    <span>Se agregó exitosamente</span>
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

        <!-- Page Header -->
        <div class="page-header">
            <div class="header-content">
                <div>
                    <h1 class="page-title">
                        <i class="fas fa-layer-group me-2"></i>Gestión de Categorías
                    </h1>
                    <p class="page-subtitle">Administra las categorías de productos de tu negocio</p>
                </div>
                <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalCategoria">
                    <i class="fas fa-plus-circle me-2"></i>Nueva Categoría
                </button>
            </div>
        </div>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Barra de Búsqueda y Filtros -->
            <div class="categorias-toolbar">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input 
                        type="text" 
                        id="searchInput" 
                        placeholder="Buscar categoría..."
                        class="search-input"
                    >
                    <button class="btn-clear-search" id="btnClearSearch">
                        <i class="fas fa-xmark"></i>
                    </button>
                </div>

                <div class="filter-group">
                    <select id="filterEstado" class="filter-select">
                        <option value="">Todos los estados</option>
                        <option value="activo">Activos</option>
                        <option value="inactivo">Inactivos</option>
                    </select>

                    <select id="filterOrden" class="filter-select">
                        <option value="nombre-asc">Nombre (A-Z)</option>
                        <option value="nombre-desc">Nombre (Z-A)</option>
                        <option value="productos-desc">Más productos</option>
                        <option value="fecha-desc">Más recientes</option>
                    </select>

                    <button class="btn btn-secondary btn-sm" id="btnExportar">
                        <i class="fas fa-download me-2"></i>Exportar
                    </button>
                </div>
            </div>

            <!-- Vista en Tabla -->
            <div class="categorias-view" id="viewTabla">
                <div class="card-modern">
                    <div class="table-responsive">
                        <table class="table-categorias">
                            <thead>
                                <tr>
                                    <th class="col-checkbox">
                                        <input type="checkbox" id="selectAll" class="form-check-input">
                                    </th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Productos</th>
                                    <th>Creado</th>
                                    <th>Estado</th>
                                    <th class="col-acciones">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tablaCategorias">
                                <!-- Se cargará dinámicamente -->
                                <tr class="loading-row">
                                    <td colspan="7">
                                        <div class="spinner-border spinner-border-sm me-2" role="status"></div>
                                        Cargando categorías...
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="pagination-wrapper">
                        <div class="pagination-info">
                            Mostrando <strong id="startIndex">0</strong>-<strong id="endIndex">0</strong> 
                            de <strong id="totalRecords">0</strong> categorías
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination" id="paginationControls">
                                <!-- Se cargará dinámicamente -->
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Vista en Grid -->
            <div class="categorias-view" id="viewGrid" style="display: none;">
                <div class="grid-categorias" id="gridCategorias">
                    <!-- Se cargará dinámicamente -->
                </div>

                <!-- Paginación Grid -->
                <div class="pagination-wrapper">
                    <div class="pagination-info">
                        Mostrando <strong id="startIndexGrid">0</strong>-<strong id="endIndexGrid">0</strong> 
                        de <strong id="totalRecordsGrid">0</strong> categorías
                    </div>
                    <nav aria-label="Page navigation">
                        <ul class="pagination" id="paginationControlsGrid">
                            <!-- Se cargará dinámicamente -->
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Vista Vacía -->
            <div class="empty-state" id="emptyState" style="display: none;">
                <div class="empty-icon">
                    <i class="fas fa-inbox"></i>
                </div>
                <h3>No hay categorías</h3>
                <p>Comienza creando tu primera categoría de productos</p>
                <button class="btn btn-primary" id="btnAgregarCategoriaEmpty">
                    <i class="fas fa-plus-circle me-2"></i>Crear Categoría
                </button>
            </div>

            <!-- Footer -->
            <footer class="app-footer">
                <p>&copy; 2026 PuntoVenta. Todos los derechos reservados.</p>
            </footer>
        </div>
    </main>

    <!-- Modal Nueva Categoría -->
    <div class="modal fade" id="modalCategoria" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-custom bg-primary">
                    <h5 class="modal-title text-white">Nueva Categoría</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formCategoria" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label class="form-label">Nombre Categoría <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nombre" placeholder="Electrónica, Ropa, Alimentos, etc." required>
                            <div class="invalid-feedback">El nombre es requerido.</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('formCategoria').dispatchEvent(new Event('submit'))">
                        <i class="fas fa-save me-2"></i>Guardar Categoría
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Agregar/Editar Categoría -->
    <div class="modal fade" id="modalCategoria" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Nueva Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formCategoria" class="needs-validation" novalidate>
                        <input type="hidden" id="categoriaId">

                        <!-- Nombre -->
                        <div class="form-group mb-3">
                            <label class="form-label" for="categoriaNombre">
                                <i class="fas fa-tag me-2"></i>Nombre
                            </label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="categoriaNombre"
                                placeholder="Ej: Electrónica, Ropa, Alimentos"
                                maxlength="100"
                                required
                            >
                            <div class="invalid-feedback">El nombre es requerido</div>
                        </div>

                        <!-- Descripción -->
                        <div class="form-group mb-3">
                            <label class="form-label" for="categoriaDescripcion">
                                <i class="fas fa-align-left me-2"></i>Descripción
                            </label>
                            <textarea 
                                class="form-control" 
                                id="categoriaDescripcion"
                                placeholder="Descripción opcional..."
                                rows="3"
                                maxlength="250"
                            ></textarea>
                            <small class="form-text text-muted">
                                <span id="charCount">0</span>/250 caracteres
                            </small>
                        </div>

                        <!-- Color Identificador -->
                        <div class="form-group mb-3">
                            <label class="form-label" for="categoriaColor">
                                <i class="fas fa-palette me-2"></i>Color Identificador
                            </label>
                            <div class="color-picker-wrapper">
                                <input 
                                    type="color" 
                                    class="color-picker" 
                                    id="categoriaColor"
                                    value="#2563eb"
                                >
                                <div class="color-preview" id="colorPreview" style="background-color: #2563eb;"></div>
                                <span id="colorValue">#2563eb</span>
                            </div>
                        </div>

                        <!-- Estado -->
                        <div class="form-group mb-3">
                            <label class="form-label">
                                <i class="fas fa-toggle-on me-2"></i>Estado
                            </label>
                            <div class="toggle-switch">
                                <input 
                                    type="checkbox" 
                                    id="categoriaActivo" 
                                    class="toggle-input"
                                    checked
                                >
                                <label class="toggle-label" for="categoriaActivo">
                                    <span class="toggle-inner"></span>
                                    <span class="toggle-switch-label" id="estadoLabel">Activo</span>
                                </label>
                            </div>
                        </div>

                        <!-- Alertas -->
                        <div id="alertCategoria" class="alert d-none" role="alert"></div>

                        <!-- Botones -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2"></i>Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary" id="btnGuardarCategoria">
                                <span class="btn-text">
                                    <i class="fas fa-save me-2"></i>Guardar
                                </span>
                                <span class="btn-loading d-none">
                                    <span class="spinner-border spinner-border-sm me-2"></span>Guardando...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Eliminar Categoría -->
    <div class="modal fade" id="modalEliminar" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger bg-opacity-10 border-danger">
                    <h5 class="modal-title text-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>Eliminar Categoría
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar la categoría <strong id="nombreEliminar"></strong>?</p>
                    <div class="alert alert-info" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Nota:</strong> Esta acción no se puede deshacer. Se eliminarán todos los datos asociados.
                    </div>
                    <div id="productosCategoriaInfo" class="alert alert-warning d-none">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        Esta categoría contiene <strong id="countProductos">0</strong> producto(s). 
                        Por favor, reasigna estos productos antes de eliminar.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </button>
                    <button type="button" class="btn btn-danger" id="btnConfirmarEliminar">
                        <span class="btn-text">
                            <i class="fas fa-trash me-2"></i>Eliminar
                        </span>
                        <span class="btn-loading d-none">
                            <span class="spinner-border spinner-border-sm me-2"></span>Eliminando...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón Flotante para Cambiar Vista -->
    <div class="view-toggle-fab">
        <button class="fab-button" id="btnToggleView" title="Cambiar vista">
            <i class="fas fa-border-all"></i>
        </button>
    </div>

    <!-- Toast de Notificaciones -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Bootstrap JS -->
    <script src="../recursos/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="../recursos/js/sweetalert2.all.js"></script>
    
    <!-- Dashboard JS -->
    <script src="./recursos/js/dashboard.js"></script>
    
    <!-- JS Personalizado -->
    <script src="./recursos/js/categoriaempresa.js"></script>
</body>
</html>