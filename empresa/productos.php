<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Productos - TechStore</title>
  
  <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="./recursos/css/empresa-styles.css">
  <link rel="stylesheet" href="./recursos/css/sidebar.css">
  <link rel="stylesheet" href="./recursos/css/formularios.css">
  <link rel="stylesheet" href="./recursos/css/productos.css">
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
            <input type="text" placeholder="Buscar productos..." id="searchProducts">
          </div>
        </div>
        <div class="topbar-right">
          <div class="notification-icon"><i class="fas fa-bell"></i><span class="notification-badge">3</span></div>
          <div class="user-menu">
            <img src="https://via.placeholder.com/40" alt="Usuario" class="user-avatar">
            <span class="user-name">Juan Pérez</span>
          </div>
        </div>
      </div>

      <!-- Page Header -->
      <div class="page-header">
        <div class="header-content">
          <h1>Gestión de Productos</h1>
          <p class="text-muted">Administra tu catálogo de productos</p>
        </div>
        <div class="header-buttons">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
            <i class="fas fa-plus"></i> Nuevo Producto
          </button>
        </div>
      </div>

      <!-- Filters Section -->
      <div class="filters-section">
        <div class="filter-group">
          <select id="filterCategory" class="form-select">
            <option value="">Todas las categorías</option>
            <option value="laptops">Laptops</option>
            <option value="moviles">Móviles</option>
            <option value="tablets">Tablets</option>
            <option value="accesorios">Accesorios</option>
          </select>
        </div>
        <div class="filter-group">
          <select id="filterStock" class="form-select">
            <option value="">Estado de Stock</option>
            <option value="disponible">Disponible</option>
            <option value="bajo">Stock Bajo</option>
            <option value="agotado">Agotado</option>
          </select>
        </div>
        <div class="filter-group">
          <select id="sortProducts" class="form-select">
            <option value="reciente">Más Reciente</option>
            <option value="nombre">Nombre (A-Z)</option>
            <option value="precio-asc">Precio (Menor)</option>
            <option value="precio-desc">Precio (Mayor)</option>
          </select>
        </div>
        <button class="btn btn-outline-secondary" id="clearFilters">
          <i class="fas fa-times"></i> Limpiar
        </button>
      </div>

      <!-- Products Table -->
      <div class="table-card">
        <div class="card-header">
          <h5>Productos <span class="results-count">(145)</span></h5>
        </div>
        <div class="table-responsive">
          <table class="products-table">
            <thead>
              <tr>
                <th>Producto</th>
                <th>SKU Interno</th>
                <th>Categoría / Marca</th>
                <th>Precio Compra</th>
                <th>Precio Venta</th>
                <th>Stock Actual / Mínimo</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody id="productsTableBody">
              <!-- Filas de ejemplo - serán reemplazadas por datos dinámicos -->
              <tr class="product-row" data-product-id="1" data-status="activo">
                <td>
                  <div class="product-cell">
                    <div class="product-image">
                      <img src="https://via.placeholder.com/60x60?text=Laptop" alt="Laptop" class="product-img">
                    </div>
                    <div class="product-info">
                      <div class="product-name">Laptop DELL XPS 13</div>
                      <small class="text-muted">SKU: PROD-LP-001</small>
                    </div>
                  </div>
                </td>
                <td><code>PROD-LP-001</code></td>
                <td>
                  <div class="category-badge">
                    <span class="badge bg-primary">Laptops</span>
                    <span class="badge bg-secondary">DELL</span>
                  </div>
                </td>
                <td><strong>$850.00</strong></td>
                <td><strong class="text-success">$1,299.99</strong></td>
                <td>
                  <div class="stock-display">
                    <span class="stock-info">18 / 10</span>
                    <div class="stock-bar"><div class="stock-fill" style="width: 90%;"></div></div>
                  </div>
                </td>
                <td><span class="status-badge status-activo"><i class="fas fa-check-circle"></i> Activo</span></td>
                <td>
                  <div class="action-buttons">
                    <button class="btn-action btn-view" title="Ver"><i class="fas fa-eye"></i></button>
                    <button class="btn-action btn-edit" title="Editar"><i class="fas fa-edit"></i></button>
                    <button class="btn-action btn-delete" title="Eliminar"><i class="fas fa-trash"></i></button>
                  </div>
                </td>
              </tr>

              <tr class="product-row" data-product-id="2" data-status="activo">
                <td>
                  <div class="product-cell">
                    <div class="product-image">
                      <img src="https://via.placeholder.com/60x60?text=iPhone" alt="iPhone" class="product-img">
                    </div>
                    <div class="product-info">
                      <div class="product-name">iPhone 15 Pro Max</div>
                      <small class="text-muted">SKU: PROD-IF-015</small>
                    </div>
                  </div>
                </td>
                <td><code>PROD-IF-015</code></td>
                <td>
                  <div class="category-badge">
                    <span class="badge bg-danger">Móviles</span>
                    <span class="badge bg-secondary">Apple</span>
                  </div>
                </td>
                <td><strong>$750.00</strong></td>
                <td><strong class="text-success">$1,199.99</strong></td>
                <td>
                  <div class="stock-display">
                    <span class="stock-info">25 / 8</span>
                    <div class="stock-bar"><div class="stock-fill" style="width: 100%;"></div></div>
                  </div>
                </td>
                <td><span class="status-badge status-activo"><i class="fas fa-check-circle"></i> Activo</span></td>
                <td>
                  <div class="action-buttons">
                    <button class="btn-action btn-view" title="Ver"><i class="fas fa-eye"></i></button>
                    <button class="btn-action btn-edit" title="Editar"><i class="fas fa-edit"></i></button>
                    <button class="btn-action btn-delete" title="Eliminar"><i class="fas fa-trash"></i></button>
                  </div>
                </td>
              </tr>

              <tr class="product-row" data-product-id="3" data-category="accesorios" data-stock="bajo">
                <td>
                  <div class="product-cell">
                    <div class="product-image">
                      <img src="https://via.placeholder.com/60x60?text=Auriculares" alt="Auriculares" class="product-img">
                    </div>
                    <div class="product-info">
                      <div class="product-name">Auriculares Sony WH-1000XM5</div>
                      <small class="text-muted">SKU: SKU-AC001</small>
                    </div>
                  </div>
                </td>
                <td><code>SKU-AC001</code></td>
                <td>
                  <div class="category-badge">
                    <span class="badge bg-info">Accesorios</span>
                    <span class="badge bg-secondary">Sony</span>
                  </div>
                </td>
                <td><strong>$200.00</strong></td>
                <td><strong class="text-success">$349.99</strong></td>
                <td>
                  <div class="stock-display">
                    <span class="stock-info">3 / 5</span>
                    <div class="stock-bar"><div class="stock-fill" style="width: 15%;"></div></div>
                  </div>
                </td>
                <td><span class="status-badge status-bajo"><i class="fas fa-exclamation-triangle"></i> Stock Bajo</span></td>
                <td>
                  <div class="action-buttons">
                    <button class="btn-action btn-view" title="Ver"><i class="fas fa-eye"></i></button>
                    <button class="btn-action btn-edit" title="Editar"><i class="fas fa-edit"></i></button>
                    <button class="btn-action btn-delete" title="Eliminar"><i class="fas fa-trash"></i></button>
                  </div>
                </td>
              </tr>

              <tr class="product-row" data-product-id="4" data-stock="disponible">
                <td>
                  <div class="product-cell">
                    <div class="product-image">
                      <img src="https://via.placeholder.com/60x60?text=iPad" alt="iPad" class="product-img">
                    </div>
                    <div class="product-info">
                      <div class="product-name">iPad Air 6</div>
                      <small class="text-muted">SKU: SKU-TB001</small>
                    </div>
                  </div>
                </td>
                <td><code>SKU-TB001</code></td>
                <td>
                  <div class="category-badge">
                    <span class="badge bg-success">Tablets</span>
                  </div>
                </td>
                <td><strong>$500.00</strong></td>
                <td><strong class="text-success">$799.99</strong></td>
                <td>
                  <div class="stock-display">
                    <span class="stock-info">12 / 5</span>
                    <div class="stock-bar"><div class="stock-fill" style="width: 60%;"></div></div>
                  </div>
                </td>
                <td><span class="status-badge status-disponible"><i class="fas fa-check-circle"></i> Disponible</span></td>
                <td>
                  <div class="action-buttons">
                    <button class="btn-action btn-view" title="Ver"><i class="fas fa-eye"></i></button>
                    <button class="btn-action btn-edit" title="Editar"><i class="fas fa-edit"></i></button>
                    <button class="btn-action btn-delete" title="Eliminar"><i class="fas fa-trash"></i></button>
                  </div>
                </td>
              </tr>

              <tr class="product-row" data-product-id="5" data-stock="agotado">
                <td>
                  <div class="product-cell">
                    <div class="product-image">
                      <img src="https://via.placeholder.com/60x60?text=MacBook" alt="MacBook" class="product-img">
                    </div>
                    <div class="product-info">
                      <div class="product-name">MacBook Pro 16"</div>
                      <small class="text-muted">SKU: SKU-LP002</small>
                    </div>
                  </div>
                </td>
                <td><code>SKU-LP002</code></td>
                <td>
                  <div class="category-badge">
                    <span class="badge bg-primary">Laptops</span>
                    <span class="badge bg-secondary">Apple</span>
                  </div>
                </td>
                <td><strong>$1,500.00</strong></td>
                <td><strong class="text-success">$2,499.99</strong></td>
                <td>
                  <div class="stock-display">
                    <span class="stock-info">0 / 2</span>
                    <div class="stock-bar"><div class="stock-fill" style="width: 0%;"></div></div>
                  </div>
                </td>
                <td><span class="status-badge status-agotado"><i class="fas fa-times-circle"></i> Agotado</span></td>
                <td>
                  <div class="action-buttons">
                    <button class="btn-action btn-view" title="Ver"><i class="fas fa-eye"></i></button>
                    <button class="btn-action btn-edit" title="Editar"><i class="fas fa-edit"></i></button>
                    <button class="btn-action btn-delete" title="Eliminar"><i class="fas fa-trash"></i></button>
                  </div>
                </td>
              </tr>
                <td>
                  <div class="category-badge">
                    <span class="badge bg-danger">Móviles</span>
                    <span class="badge bg-secondary">Apple</span>
                  </div>
                </td>
                <td><strong>$750.00</strong></td>
                <td><strong class="text-success">$1,199.99</strong></td>
                <td>
                  <div class="stock-display">
                    <span class="stock-info">25 / 8</span>
                    <div class="stock-bar"><div class="stock-fill" style="width: 100%;"></div></div>
                  </div>
                </td>
                <td><span class="status-badge status-activo"><i class="fas fa-check-circle"></i> Activo</span></td>
                <td>
                  <div class="action-buttons">
                    <button class="btn-action btn-view" title="Ver"><i class="fas fa-eye"></i></button>
                    <button class="btn-action btn-edit" title="Editar"><i class="fas fa-edit"></i></button>
                    <button class="btn-action btn-delete" title="Eliminar"><i class="fas fa-trash"></i></button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Modal: Add Product -->
      <div class="modal fade" id="addProductModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Nuevo Producto</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form class="needs-validation" id="addProductForm" novalidate>
                <!-- Nombre del Producto -->
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label class="form-label">Nombre del Producto <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nombre" required placeholder="Ej: Laptop DELL XPS 13">
                    <div class="invalid-feedback">El nombre es requerido</div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">SKU Interno <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="sku_interno" required placeholder="SKU-LP001">
                    <div class="invalid-feedback">El SKU es requerido</div>
                  </div>
                </div>

                <!-- Categoría y Marca -->
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label class="form-label">Categoría <span class="text-danger">*</span></label>
                    <select class="form-select" name="categoria_id" required>
                      <option value="">Selecciona una categoría</option>
                      <!-- Las opciones se cargarán dinámicamente desde la BD -->
                    </select>
                    <div class="invalid-feedback">Selecciona una categoría</div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Marca (Opcional)</label>
                    <select class="form-select" name="marca_id">
                      <option value="">Selecciona una marca</option>
                      <!-- Las opciones se cargarán dinámicamente desde la BD -->
                    </select>
                  </div>
                </div>

                <!-- Unidad de Medida -->
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label class="form-label">Unidad de Medida <span class="text-danger">*</span></label>
                    <select class="form-select" name="unidad_id" required>
                      <option value="">Selecciona una unidad</option>
                      <!-- Las opciones se cargarán dinámicamente desde la BD -->
                    </select>
                    <div class="invalid-feedback">Selecciona una unidad</div>
                  </div>
                </div>

                <!-- Precios -->
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label class="form-label">Precio de Compra <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="precio_compra_actual" required placeholder="0.00" step="0.01" min="0">
                    <div class="invalid-feedback">Ingresa el precio de compra</div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Precio de Venta <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="precio_venta_estandar" required placeholder="0.00" step="0.01" min="0">
                    <div class="invalid-feedback">Ingresa el precio de venta</div>
                  </div>
                </div>

                <!-- Stock -->
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label class="form-label">Stock Actual <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="stock_actual" required placeholder="0" step="0.001" min="0">
                    <div class="invalid-feedback">Ingresa el stock inicial</div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Stock Mínimo <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="stock_minimo" required placeholder="5" step="0.001" min="0">
                    <div class="invalid-feedback">Ingresa el stock mínimo</div>
                  </div>
                </div>

                <!-- Imagen del Producto -->
                <div class="mb-3">
                  <label class="form-label">Imagen del Producto (Opcional)</label>
                  <input type="file" class="form-control" name="imagen_file" id="imagenProducto" accept="image/*">
                  <small class="form-text text-muted d-block mt-2">Formatos soportados: JPG, PNG, GIF (máx. 5MB)</small>
                  <!-- Preview imagen -->
                  <div id="imagenPreview" class="mt-3" style="display: none;">
                    <small class="d-block mb-2">Vista previa:</small>
                    <img id="previewImg" src="" alt="Imagen preview" style="max-height: 200px; border-radius: 4px; border: 1px solid #ddd; padding: 4px;">
                  </div>
                </div>

                <!-- URL de Imagen Alternativa -->
                <div class="mb-3">
                  <label class="form-label text-muted">O URL de la Imagen (alternativa)</label>
                  <input type="url" class="form-control" name="imagen_url" placeholder="https://ejemplo.com/imagen.jpg">
                  <small class="form-text text-muted">Si cargas una imagen arriba, esta URL se ignorará</small>
                </div>

                <!-- Estado -->
                <div class="mb-3">
                  <label class="form-label">Estado</label>
                  <select class="form-select" name="activo">
                    <option value="1" selected>Activo</option>
                    <option value="0">Inactivo</option>
                  </select>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" id="saveProductBtn">
                <i class="fas fa-save me-2"></i>Guardar Producto
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="page-footer">
        <p>&copy; 2024 Sistema de Gestión - TechStore</p>
      </footer>
    </div>
  </div>

  <script src="../recursos/js/bootstrap.bundle.min.js"></script>
  <script src="../recursos/js/sweetalert2.all.js"></script>
  <script src="./recursos/js/empresa.js"></script>
  <script src="./recursos/js/productos.js"></script>
</body>
</html>
