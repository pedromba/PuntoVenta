<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stock - TechStore</title>
  
  <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./recursos/css/empresa-styles.css">
  <link rel="stylesheet" href="./recursos/css/sidebar.css">
  <link rel="stylesheet" href="./recursos/css/formularios.css">
  <link rel="stylesheet" href="./recursos/css/stock.css">
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
            <input type="text" placeholder="Buscar en stock..." id="searchStock">
          </div>
        </div>
        <div class="topbar-right">
          <div class="notification-icon"><i class="fas fa-bell"></i><span class="notification-badge">5</span></div>
          <div class="user-menu">
            <img src="https://via.placeholder.com/40" alt="Usuario" class="user-avatar">
            <span class="user-name">Juan Pérez</span>
          </div>
        </div>
      </div>

      <!-- Page Header -->
      <div class="page-header">
        <div class="header-content">
          <h1>Control de Stock</h1>
          <p class="text-muted">Monitorea inventario y movimientos</p>
        </div>
        <div class="header-buttons">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adjustStockModal">
            <i class="fas fa-exchange"></i> Ajustar Stock
          </button>
        </div>
      </div>

      <!-- Alerts -->
      <div class="alerts-section">
        <div class="alert alert-warning" role="alert">
          <i class="fas fa-exclamation-triangle"></i>
          <strong>5 productos con stock bajo</strong> - Considera realizar un nuevo pedido
          <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      </div>

      <!-- Stats -->
      <div class="stats-cards">
        <div class="stat-card">
          <div class="stat-header"><h6>Stock Total</h6></div>
          <div class="stat-value">245 unidades</div>
          <div class="stat-change">En 5 categorías</div>
        </div>
        <div class="stat-card">
          <div class="stat-header"><h6>Stock Bajo</h6></div>
          <div class="stat-value">5 productos</div>
          <div class="stat-change negative"><i class="fas fa-arrow-down"></i> Requieren atención</div>
        </div>
        <div class="stat-card">
          <div class="stat-header"><h6>Valor Total Stock</h6></div>
          <div class="stat-value">$156,450.00</div>
          <div class="stat-change">Costo de inventario</div>
        </div>
      </div>

      <!-- Filters -->
      <div class="filters-section">
        <div class="filter-group">
          <select id="filterCategory" class="form-select">
            <option value="">Todas las categorías</option>
            <option value="laptops">Laptops</option>
            <option value="moviles">Móviles</option>
            <option value="tablets">Tablets</option>
          </select>
        </div>
        <div class="filter-group">
          <select id="filterStockStatus" class="form-select">
            <option value="">Estado de Stock</option>
            <option value="optimo">Óptimo</option>
            <option value="bajo">Bajo</option>
            <option value="critico">Crítico</option>
          </select>
        </div>
        <button class="btn btn-outline-secondary" id="clearFilters">
          <i class="fas fa-times"></i> Limpiar
        </button>
      </div>

      <!-- Stock Table -->
      <div class="table-card">
        <div class="card-header">
          <h5>Inventario <span class="results-count">(145)</span></h5>
          <button class="btn btn-sm btn-outline-primary"><i class="fas fa-download"></i> Exportar</button>
        </div>
        <div class="table-responsive">
          <table class="stock-table">
            <thead>
              <tr>
                <th>Producto</th>
                <th>SKU</th>
                <th>Categoría</th>
                <th>Costo</th>
                <th>Stock</th>
                <th>Mínimo</th>
                <th>Estado</th>
                <th>Valor</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr class="stock-row" data-status="optimo">
                <td><div class="product-name">Laptop DELL XPS 13</div></td>
                <td>SKU-LP001</td>
                <td><span class="badge bg-primary">Laptops</span></td>
                <td>$899.99</td>
                <td><span class="stock-number">18</span></td>
                <td>5</td>
                <td><span class="status-badge status-optimo"><i class="fas fa-check-circle"></i> Óptimo</span></td>
                <td>$16,199.82</td>
                <td>
                  <button class="btn-action btn-adjust" title="Ajustar"><i class="fas fa-align-justify"></i></button>
                  <button class="btn-action btn-history" title="Historial"><i class="fas fa-history"></i></button>
                </td>
              </tr>

              <tr class="stock-row" data-status="optimo">
                <td><div class="product-name">iPhone 15 Pro Max</div></td>
                <td>SKU-IP001</td>
                <td><span class="badge bg-danger">Móviles</span></td>
                <td>$799.99</td>
                <td><span class="stock-number">25</span></td>
                <td>10</td>
                <td><span class="status-badge status-optimo"><i class="fas fa-check-circle"></i> Óptimo</span></td>
                <td>$19,999.75</td>
                <td>
                  <button class="btn-action btn-adjust" title="Ajustar"><i class="fas fa-align-justify"></i></button>
                  <button class="btn-action btn-history" title="Historial"><i class="fas fa-history"></i></button>
                </td>
              </tr>

              <tr class="stock-row" data-status="bajo">
                <td><div class="product-name">Auriculares Sony WH-1000XM5</div></td>
                <td>SKU-AC001</td>
                <td><span class="badge bg-info">Accesorios</span></td>
                <td>$249.99</td>
                <td><span class="stock-number">3</span></td>
                <td>10</td>
                <td><span class="status-badge status-bajo"><i class="fas fa-exclamation-triangle"></i> Stock Bajo</span></td>
                <td>$749.97</td>
                <td>
                  <button class="btn-action btn-adjust" title="Ajustar"><i class="fas fa-align-justify"></i></button>
                  <button class="btn-action btn-history" title="Historial"><i class="fas fa-history"></i></button>
                </td>
              </tr>

              <tr class="stock-row" data-status="optimo">
                <td><div class="product-name">iPad Air 6</div></td>
                <td>SKU-TB001</td>
                <td><span class="badge bg-success">Tablets</span></td>
                <td>$549.99</td>
                <td><span class="stock-number">12</span></td>
                <td>8</td>
                <td><span class="status-badge status-optimo"><i class="fas fa-check-circle"></i> Óptimo</span></td>
                <td>$6,599.88</td>
                <td>
                  <button class="btn-action btn-adjust" title="Ajustar"><i class="fas fa-align-justify"></i></button>
                  <button class="btn-action btn-history" title="Historial"><i class="fas fa-history"></i></button>
                </td>
              </tr>

              <tr class="stock-row" data-status="critico">
                <td><div class="product-name">MacBook Pro 16"</div></td>
                <td>SKU-LP002</td>
                <td><span class="badge bg-primary">Laptops</span></td>
                <td>$1,799.99</td>
                <td><span class="stock-number">0</span></td>
                <td>2</td>
                <td><span class="status-badge status-critico"><i class="fas fa-times-circle"></i> Crítico</span></td>
                <td>$0.00</td>
                <td>
                  <button class="btn-action btn-adjust" title="Ajustar"><i class="fas fa-align-justify"></i></button>
                  <button class="btn-action btn-history" title="Historial"><i class="fas fa-history"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Modal: Adjust Stock -->
      <div class="modal fade" id="adjustStockModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fas fa-cubes"></i> Ajuste de Inventario</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form id="adjustStockForm" class="needs-validation">
                
                <!-- Sección: Producto -->
                <div class="form-section mb-4">
                  <h6 class="section-title"><i class="fas fa-box"></i> Información del Producto</h6>
                  
                  <div class="mb-3">
                    <label class="form-label">Producto</label>
                    <select class="form-select" id="productSelect" required>
                      <option value="">Seleccionar producto</option>
                      <option value="1" data-stock-actual="18" data-stock-minimo="5">Laptop DELL XPS 13 - SKU-LP001</option>
                      <option value="2" data-stock-actual="25" data-stock-minimo="10">iPhone 15 Pro Max - SKU-IP001</option>
                      <option value="3" data-stock-actual="12" data-stock-minimo="8">iPad Air 6 - SKU-TB001</option>
                    </select>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Stock Actual</label>
                      <input type="number" class="form-control" id="stockActual" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Stock Mínimo</label>
                      <input type="number" class="form-control" id="stockMinimo" readonly>
                    </div>
                  </div>
                </div>

                <!-- Sección: Tipo de Movimiento -->
                <div class="form-section mb-4">
                  <h6 class="section-title"><i class="fas fa-exchange-alt"></i> Tipo de Movimiento</h6>
                  
                  <div class="mb-3">
                    <label class="form-label">Categoría de Movimiento</label>
                    <select class="form-select" id="tipoMovimiento" required>
                      <option value="">Seleccionar tipo</option>
                      <option value="entrada_compra">Entrada - Compra a Proveedor</option>
                      <option value="devolucion">Devolución - Cliente</option>
                      <option value="ajuste_inventario">Ajuste - Reconciliación de Inventario</option>
                      <option value="salida_venta">Salida - Otros (Daño, Pérdida, etc.)</option>
                    </select>
                  </div>
                </div>

                <!-- Sección: Detalles de Ajuste -->
                <div class="form-section mb-4">
                  <h6 class="section-title"><i class="fas fa-calculator"></i> Detalles del Ajuste</h6>
                  
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label class="form-label">Cantidad a Ajustar</label>
                      <div class="input-group">
                        <button type="button" class="btn btn-outline-secondary" id="btnMenos">-</button>
                        <input type="number" class="form-control text-center" id="cantidadAjuste" value="0" required>
                        <button type="button" class="btn btn-outline-secondary" id="btnMas">+</button>
                      </div>
                      <small class="text-muted d-block mt-2">
                        Nuevo Stock: <strong id="nuevoStock">18</strong>
                      </small>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Unidad de Medida</label>
                      <input type="text" class="form-control" value="Unidades" readonly>
                    </div>
                  </div>

                  <div class="alert alert-info d-flex align-items-center" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    <div>Stock actual <strong>18 unidades</strong> → Nuevo stock <strong id="nuevoStockAlert">18</strong></div>
                  </div>
                </div>

                <!-- Sección: Documentación -->
                <div class="form-section mb-4">
                  <h6 class="section-title"><i class="fas fa-file-alt"></i> Documentación</h6>
                  
                  <div class="mb-3">
                    <label class="form-label">Referencia (opcional)</label>
                    <input type="text" class="form-control" id="referencia" placeholder="Ej: Número de compra, ticket de devolución, etc.">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Observaciones</label>
                    <textarea class="form-control" id="observaciones" rows="3" placeholder="Notas sobre el ajuste de stock..."></textarea>
                  </div>
                </div>

              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-success btn-lg" id="confirmarAjusteBtn">
                <i class="fas fa-check"></i> Confirmar Ajuste
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
  <script src="./recursos/js/empresa.js"></script>
</body>
</html>
