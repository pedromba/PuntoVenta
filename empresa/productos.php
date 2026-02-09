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
              <tr class="product-row" data-product-id="1" data-status="activo">
                <td>
                  <div class="product-cell">
                    <div class="product-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"><i class="fas fa-laptop"></i></div>
                    <div class="product-info">
                      <div class="product-name">Laptop DELL XPS 13</div>
                      <div class="product-description">Intel Core i7 - 16GB RAM</div>
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
                    <div class="product-image" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);"><i class="fas fa-mobile"></i></div>
                    <div class="product-info">
                      <div class="product-name">iPhone 15 Pro Max</div>
                      <div class="product-description">256GB - Space Black</div>
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

              <tr class="product-row" data-category="accesorios" data-stock="bajo">
                <td>
                  <div class="product-cell">
                    <div class="product-image" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);"><i class="fas fa-headphones"></i></div>
                    <div class="product-info">
                      <div class="product-name">Auriculares Sony WH-1000XM5</div>
                      <div class="product-sku">SKU-AC001</div>
                    </div>
                  </div>
                </td>
                <td>SKU-AC001</td>
                <td><span class="badge bg-info">Accesorios</span></td>
                <td>$349.99</td>
                <td>
                  <div class="stock-display">
                    <span class="stock-number">3</span>
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

              <tr class="product-row" data-category="tablets" data-stock="disponible">
                <td>
                  <div class="product-cell">
                    <div class="product-image" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);"><i class="fas fa-tablet"></i></div>
                    <div class="product-info">
                      <div class="product-name">iPad Air 6</div>
                      <div class="product-sku">SKU-TB001</div>
                    </div>
                  </div>
                </td>
                <td>SKU-TB001</td>
                <td><span class="badge bg-success">Tablets</span></td>
                <td>$799.99</td>
                <td>
                  <div class="stock-display">
                    <span class="stock-number">12</span>
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

              <tr class="product-row" data-category="laptops" data-stock="agotado">
                <td>
                  <div class="product-cell">
                    <div class="product-image" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);"><i class="fas fa-laptop"></i></div>
                    <div class="product-info">
                      <div class="product-name">MacBook Pro 16"</div>
                      <div class="product-sku">SKU-LP002</div>
                    </div>
                  </div>
                </td>
                <td>SKU-LP002</td>
                <td><span class="badge bg-primary">Laptops</span></td>
                <td>$2,499.99</td>
                <td>
                  <div class="stock-display">
                    <span class="stock-number">0</span>
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
              <form class="needs-validation" id="addProductForm">
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label>Nombre del Producto</label>
                    <input type="text" class="form-control" required placeholder="Ej: Laptop DELL XPS 13">
                  </div>
                  <div class="col-md-6">
                    <label>SKU</label>
                    <input type="text" class="form-control" required placeholder="SKU-LP001">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label>Categoría</label>
                    <select class="form-select" required>
                      <option>Laptops</option>
                      <option>Móviles</option>
                      <option>Tablets</option>
                      <option>Accesorios</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label>Precio</label>
                    <input type="number" class="form-control" required placeholder="0.00" step="0.01">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label>Stock Inicial</label>
                    <input type="number" class="form-control" required placeholder="0">
                  </div>
                  <div class="col-md-6">
                    <label>Stock Mínimo</label>
                    <input type="number" class="form-control" required placeholder="5">
                  </div>
                </div>
                <div class="mb-3">
                  <label>Descripción</label>
                  <textarea class="form-control" rows="3" placeholder="Descripción del producto..."></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" id="saveProductBtn">Guardar Producto</button>
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
