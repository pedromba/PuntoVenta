<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Categorías de Productos - Mi Empresa</title>
  
  <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Custom CSS -->
  <link rel="stylesheet" href="./recursos/css/empresa-styles.css">
  <link rel="stylesheet" href="./recursos/css/sidebar.css">
  <link rel="stylesheet" href="./recursos/css/formularios.css">
  <link rel="stylesheet" href="./recursos/css/categorias.css">
</head>
<body>
  <div class="wrapper">
    <?php include './componentes/aside.php'; ?>

    <div class="main-content">
      <!-- Topbar -->
      <div class="topbar">
        <div class="topbar-left">
          <button class="btn-toggle-sidebar"><i class="fas fa-bars"></i></button>
          <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Buscar categorías..." id="searchCategories">
          </div>
        </div>
        <div class="topbar-right">
          <div class="notification-icon"><i class="fas fa-bell"></i><span class="notification-badge">3</span></div>
          <div class="user-menu">
            <img src="https://via.placeholder.com/40" alt="Usuario" class="user-avatar">
            <span class="user-name">Mi Empresa</span>
          </div>
        </div>
      </div>

      <!-- Page Header -->
      <div class="page-header">
        <div class="header-content">
          <h1>Categorías de Productos</h1>
          <p class="text-muted">Organiza tus productos por categorías</p>
        </div>
        <div class="header-buttons">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            <i class="fas fa-folder-plus"></i> Nueva Categoría
          </button>
        </div>
      </div>

      <!-- Stats Section -->
      <div class="stats-row mb-4">
        <div class="row g-3">
          <div class="col-md-4">
            <div class="stat-card">
              <div class="stat-icon info">
                <i class="fas fa-layer-group"></i>
              </div>
              <div class="stat-content">
                <h6>Total Categorías</h6>
                <h4 id="totalCategories">--</h4>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="stat-card">
              <div class="stat-icon success">
                <i class="fas fa-check-circle"></i>
              </div>
              <div class="stat-content">
                <h6>Categorías Activas</h6>
                <h4 id="activeCategories">--</h4>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="stat-card">
              <div class="stat-icon warning">
                <i class="fas fa-box"></i>
              </div>
              <div class="stat-content">
                <h6>Productos Asociados</h6>
                <h4 id="totalProducts">--</h4>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Filters Section -->
      <div class="filters-section">
        <div class="filter-group">
          <select id="filterEstado" class="form-select">
            <option value="">Todos los estados</option>
            <option value="activo">Activas</option>
            <option value="inactivo">Inactivas</option>
          </select>
        </div>
        <button class="btn btn-outline-secondary" id="clearFilters">
          <i class="fas fa-times"></i> Limpiar Filtros
        </button>
      </div>

      <!-- Categories Table -->
      <div class="table-card">
        <div class="card-header">
          <h5>Categorías de tu Empresa <span class="results-count" id="categoriesCount">(0)</span></h5>
        </div>
        <div class="table-responsive">
          <table class="categories-table">
            <thead>
              <tr>
                <th>Nombre Categoría</th>
                <th>Productos</th>
                <th>Estado</th>
                <th>Fecha Creación</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody id="categoriesTableBody">
              <!-- Filas de ejemplo -->
              <tr class="category-row" data-category-id="1" data-status="activo">
                <td>
                  <div class="category-cell">
                    <div class="category-icon">
                      <i class="fas fa-laptop"></i>
                    </div>
                    <div class="category-info">
                      <div class="category-name">Laptops</div>
                      <small class="text-muted">ID: #1</small>
                    </div>
                  </div>
                </td>
                <td>
                  <span class="badge bg-secondary">12</span>
                </td>
                <td>
                  <span class="status-badge status-activo">
                    <i class="fas fa-check-circle"></i> Activa
                  </span>
                </td>
                <td><small class="text-muted">15 Feb 2025</small></td>
                <td>
                  <div class="action-buttons">
                    <button class="btn-action btn-edit" title="Editar" onclick="editCategory(1)"><i class="fas fa-edit"></i></button>
                    <button class="btn-action btn-delete" title="Eliminar" onclick="deleteCategory(1)"><i class="fas fa-trash"></i></button>
                  </div>
                </td>
              </tr>

              <tr class="category-row" data-category-id="2" data-status="activo">
                <td>
                  <div class="category-cell">
                    <div class="category-icon">
                      <i class="fas fa-mobile"></i>
                    </div>
                    <div class="category-info">
                      <div class="category-name">Móviles</div>
                      <small class="text-muted">ID: #2</small>
                    </div>
                  </div>
                </td>
                <td>
                  <span class="badge bg-secondary">8</span>
                </td>
                <td>
                  <span class="status-badge status-activo">
                    <i class="fas fa-check-circle"></i> Activa
                  </span>
                </td>
                <td><small class="text-muted">15 Feb 2025</small></td>
                <td>
                  <div class="action-buttons">
                    <button class="btn-action btn-edit" title="Editar" onclick="editCategory(2)"><i class="fas fa-edit"></i></button>
                    <button class="btn-action btn-delete" title="Eliminar" onclick="deleteCategory(2)"><i class="fas fa-trash"></i></button>
                  </div>
                </td>
              </tr>

              <tr class="category-row" data-category-id="3" data-status="activo">
                <td>
                  <div class="category-cell">
                    <div class="category-icon">
                      <i class="fas fa-headphones"></i>
                    </div>
                    <div class="category-info">
                      <div class="category-name">Accesorios</div>
                      <small class="text-muted">ID: #3</small>
                    </div>
                  </div>
                </td>
                <td>
                  <span class="badge bg-secondary">5</span>
                </td>
                <td>
                  <span class="status-badge status-activo">
                    <i class="fas fa-check-circle"></i> Activa
                  </span>
                </td>
                <td><small class="text-muted">15 Feb 2025</small></td>
                <td>
                  <div class="action-buttons">
                    <button class="btn-action btn-edit" title="Editar" onclick="editCategory(3)"><i class="fas fa-edit"></i></button>
                    <button class="btn-action btn-delete" title="Eliminar" onclick="deleteCategory(3)"><i class="fas fa-trash"></i></button>
                  </div>
                </td>
              </tr>

              <tr class="category-row" data-category-id="4" data-status="activo">
                <td>
                  <div class="category-cell">
                    <div class="category-icon">
                      <i class="fas fa-tablet"></i>
                    </div>
                    <div class="category-info">
                      <div class="category-name">Tablets</div>
                      <small class="text-muted">ID: #4</small>
                    </div>
                  </div>
                </td>
                <td>
                  <span class="badge bg-secondary">3</span>
                </td>
                <td>
                  <span class="status-badge status-activo">
                    <i class="fas fa-check-circle"></i> Activa
                  </span>
                </td>
                <td><small class="text-muted">15 Feb 2025</small></td>
                <td>
                  <div class="action-buttons">
                    <button class="btn-action btn-edit" title="Editar" onclick="editCategory(4)"><i class="fas fa-edit"></i></button>
                    <button class="btn-action btn-delete" title="Eliminar" onclick="deleteCategory(4)"><i class="fas fa-trash"></i></button>
                  </div>
                </td>
              </tr>

              <tr class="category-row" data-category-id="5" data-status="inactivo">
                <td>
                  <div class="category-cell">
                    <div class="category-icon">
                      <i class="fas fa-watch"></i>
                    </div>
                    <div class="category-info">
                      <div class="category-name">Wearables</div>
                      <small class="text-muted">ID: #5</small>
                    </div>
                  </div>
                </td>
                <td>
                  <span class="badge bg-secondary">0</span>
                </td>
                <td>
                  <span class="status-badge status-inactivo">
                    <i class="fas fa-times-circle"></i> Inactiva
                  </span>
                </td>
                <td><small class="text-muted">10 Feb 2025</small></td>
                <td>
                  <div class="action-buttons">
                    <button class="btn-action btn-edit" title="Editar" onclick="editCategory(5)"><i class="fas fa-edit"></i></button>
                    <button class="btn-action btn-delete" title="Eliminar" onclick="deleteCategory(5)"><i class="fas fa-trash"></i></button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Modal: Add/Edit Category -->
      <div class="modal fade" id="addCategoryModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalTitle">Nueva Categoría</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form class="needs-validation" id="categoryForm" novalidate>
                <!-- Nombre de Categoría -->
                <div class="mb-3">
                  <label class="form-label">Nombre de la Categoría <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="nombre" id="categoryName" placeholder="Ej: Laptops, Móviles, Accesorios..." required>
                  <div class="invalid-feedback">El nombre de la categoría es requerido</div>
                </div>

                <!-- Estado -->
                <div class="mb-3">
                  <label class="form-label">Estado</label>
                  <select class="form-select" name="activo" id="categoryStatus">
                    <option value="1" selected>Activa</option>
                    <option value="0">Inactiva</option>
                  </select>
                </div>

                <!-- Info -->
                <div class="alert alert-info" role="alert">
                  <i class="fas fa-info-circle me-2"></i>
                  <strong>Nota:</strong> Las categorías te ayudan a organizar mejor tu catálogo de productos
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" id="saveCategoryBtn">
                <i class="fas fa-save me-2"></i>Guardar Categoría
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="page-footer">
        <p>&copy; 2025 Sistema de Gestión - PuntoVenta</p>
      </footer>
    </div>
  </div>

  <script src="../recursos/js/bootstrap.bundle.min.js"></script>
  <script src="../recursos/js/sweetalert2.all.js"></script>
  <script src="./recursos/js/empresa.js"></script>
  
  <!-- Script para funcionalidades básicas -->
  <script>
    // Funciones básicas para editar y eliminar
    function editCategory(categoryId) {
      // Aquí se implementará la lógica de edición
      const modal = new bootstrap.Modal(document.getElementById('addCategoryModal'));
      document.getElementById('modalTitle').textContent = 'Editar Categoría';
      document.getElementById('saveCategoryBtn').innerHTML = '<i class="fas fa-save me-2"></i>Actualizar Categoría';
      modal.show();
    }

    function deleteCategory(categoryId) {
      // Aquí se implementará la lógica de eliminación
      Swal.fire({
        title: '¿Eliminar categoría?',
        text: 'Esta acción no se puede deshacer',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d'
      });
    }
  </script>
</body>
</html>
