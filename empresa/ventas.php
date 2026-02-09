<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ventas - TechStore</title>
  
  <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./recursos/css/empresa-styles.css">
  <link rel="stylesheet" href="./recursos/css/sidebar.css">
  <link rel="stylesheet" href="./recursos/css/formularios.css">
  <link rel="stylesheet" href="./recursos/css/ventas.css">
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
            <input type="text" placeholder="Buscar ventas..." id="searchVentas">
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
          <h1>Registro de Ventas</h1>
          <p class="text-muted">Administra todas tus transacciones</p>
        </div>
        <div class="header-buttons">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newSaleModal">
            <i class="fas fa-plus"></i> Nueva Venta
          </button>
        </div>
      </div>

      <!-- Stats Cards -->
      <div class="stats-cards">
        <div class="stat-card">
          <div class="stat-header"><h6>Ventas Hoy</h6></div>
          <div class="stat-value">12</div>
          <div class="stat-change positive"><i class="fas fa-arrow-up"></i> 15% vs ayer</div>
        </div>
        <div class="stat-card">
          <div class="stat-header"><h6>Ingresos Hoy</h6></div>
          <div class="stat-value">$2,847.50</div>
          <div class="stat-change positive"><i class="fas fa-arrow-up"></i> 23% vs ayer</div>
        </div>
        <div class="stat-card">
          <div class="stat-header"><h6>Ticket Promedio</h6></div>
          <div class="stat-value">$237.29</div>
          <div class="stat-change">Sin cambios</div>
        </div>
      </div>

      <!-- Filters -->
      <div class="filters-section">
        <div class="filter-group">
          <select id="filterStatus" class="form-select">
            <option value="">Estado</option>
            <option value="completada">Completada</option>
            <option value="pendiente">Pendiente</option>
            <option value="cancelada">Cancelada</option>
          </select>
        </div>
        <div class="filter-group">
          <input type="date" id="filterDate" class="form-control">
        </div>
        <div class="filter-group">
          <select id="sortSales" class="form-select">
            <option value="reciente">Más Reciente</option>
            <option value="monto-desc">Mayor Monto</option>
            <option value="monto-asc">Menor Monto</option>
          </select>
        </div>
        <button class="btn btn-outline-secondary" id="clearFilters">
          <i class="fas fa-times"></i> Limpiar
        </button>
      </div>

      <!-- Sales Table -->
      <div class="table-card">
        <div class="card-header">
          <h5>Ventas Registradas <span class="results-count">(245)</span></h5>
          <button class="btn btn-sm btn-outline-primary"><i class="fas fa-download"></i> Descargar</button>
        </div>
        <div class="table-responsive">
          <table class="sales-table">
            <thead>
              <tr>
                <th>Folio Venta</th>
                <th>Cliente</th>
                <th>Items</th>
                <th>Total Neto</th>
                <th>Impuestos</th>
                <th>Total General</th>
                <th>Método Pago</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr class="sale-row" data-status="completada">
                <td>
                  <a href="#" class="sale-number"><strong>V-2024-001456</strong></a>
                </td>
                <td>
                  <div class="client-info">
                    <div class="client-avatar">JD</div>
                    <div>
                      <div class="client-name">Juan Díaz</div>
                      <span class="client-type">Cliente</span>
                    </div>
                  </div>
                </td>
                <td><span class="badge bg-light">3 productos</span></td>
                <td><strong>$2,550.00</strong></td>
                <td><strong class="text-warning">$382.50</strong></td>
                <td><strong class="text-success">$2,932.50</strong></td>
                <td><span class="payment-badge">Efectivo</span></td>
                <td><span class="status-badge status-completada"><i class="fas fa-check"></i> Completada</span></td>
                <td>09/02/2024 14:32</td>
                <td>
                  <div class="action-buttons">
                    <button class="btn-action btn-view" title="Ver"><i class="fas fa-eye"></i></button>
                    <button class="btn-action btn-print" title="Imprimir"><i class="fas fa-print"></i></button>
                  </div>
                </td>
              </tr>

              <tr class="sale-row" data-status="completada">
                <td><a href="#" class="sale-number"><strong>V-2024-001455</strong></a></td>
                <td>
                  <div class="client-info">
                    <div class="client-avatar">ML</div>
                    <div>
                      <div class="client-name">María López</div>
                      <span class="client-type">Cliente</span>
                    </div>
                  </div>
                </td>
                <td><span class="badge bg-light">1 producto</span></td>
                <td><strong>$720.00</strong></td>
                <td><strong class="text-warning">$108.00</strong></td>
                <td><strong class="text-success">$828.00</strong></td>
                <td><span class="payment-badge">Tarjeta</span></td>
                <td><span class="status-badge status-completada"><i class="fas fa-check"></i> Completada</span></td>
                <td>09/02/2024 11:15</td>
                <td>
                  <div class="action-buttons">
                    <button class="btn-action btn-view" title="Ver"><i class="fas fa-eye"></i></button>
                    <button class="btn-action btn-print" title="Imprimir"><i class="fas fa-print"></i></button>
                  </div>
                </td>
              </tr>

              <tr class="sale-row" data-status="presupuesto">
                <td><a href="#" class="sale-number"><strong>V-2024-001454</strong></a></td>
                <td>
                  <div class="client-info">
                    <div class="client-avatar">CR</div>
                    <div>
                      <div class="client-name">Carlos Rubio</div>
                      <div class="client-phone">+505-6543-2109</div>
                    </div>
                  </div>
                </td>
                <td><span class="badge bg-light" data-bs-toggle="tooltip" title="Auriculares Sony WH-1000XM5, Cable USB-C">2 productos</span></td>
                <td><span class="sale-amount">$449.98</span></td>
                <td>02/09/2024 09:30</td>
                <td><span class="status-badge status-pendiente"><i class="fas fa-clock"></i> Pendiente</span></td>
                <td>
                  <div class="action-buttons">
                    <button class="btn-action btn-view" title="Ver"><i class="fas fa-eye"></i></button>
                    <button class="btn-action btn-print" title="Imprimir"><i class="fas fa-print"></i></button>
                    <button class="btn-action btn-delete" title="Eliminar"><i class="fas fa-trash"></i></button>
                  </div>
                </td>
              </tr>

              <tr class="sale-row" data-status="completada">
                <td><a href="#" class="sale-number">#V-2024-001453</a></td>
                <td>
                  <div class="client-info">
                    <div class="client-avatar">FM</div>
                    <div>
                      <div class="client-name">Fernando Martínez</div>
                      <div class="client-phone">+505-5432-1098</div>
                    </div>
                  </div>
                </td>
                <td><span class="badge bg-light" data-bs-toggle="tooltip" title="MacBook Pro 16">1 producto</span></td>
                <td><span class="sale-amount">$2,499.99</span></td>
                <td>02/09/2024 08:45</td>
                <td><span class="status-badge status-completada"><i class="fas fa-check"></i> Completada</span></td>
                <td>
                  <div class="action-buttons">
                    <button class="btn-action btn-view" title="Ver"><i class="fas fa-eye"></i></button>
                    <button class="btn-action btn-print" title="Imprimir"><i class="fas fa-print"></i></button>
                    <button class="btn-action btn-delete" title="Eliminar"><i class="fas fa-trash"></i></button>
                  </div>
                </td>
              </tr>

              <tr class="sale-row" data-status="cancelada">
                <td><a href="#" class="sale-number">#V-2024-001452</a></td>
                <td>
                  <div class="client-info">
                    <div class="client-avatar">SP</div>
                    <div>
                      <div class="client-name">Sandra Pérez</div>
                      <div class="client-phone">+505-4321-0987</div>
                    </div>
                  </div>
                </td>
                <td><span class="badge bg-light" data-bs-toggle="tooltip" title="Mouse inalámbrico, Teclado mecánico">2 productos</span></td>
                <td><span class="sale-amount">$149.98</span></td>
                <td>01/09/2024 16:20</td>
                <td><span class="status-badge status-cancelada"><i class="fas fa-times"></i> Cancelada</span></td>
                <td>
                  <div class="action-buttons">
                    <button class="btn-action btn-view" title="Ver"><i class="fas fa-eye"></i></button>
                    <button class="btn-action btn-print" title="Imprimir"><i class="fas fa-print"></i></button>
                    <button class="btn-action btn-delete" title="Eliminar"><i class="fas fa-trash"></i></button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Modal: New Sale -->
      <div class="modal fade" id="newSaleModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Registrar Nueva Venta</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form id="newSaleForm" class="needs-validation">
                <!-- Sección: Cliente -->
                <div class="form-section mb-4">
                  <h6 class="section-title"><i class="fas fa-user"></i> Cliente</h6>
                  <div class="mb-3">
                    <label class="form-label">Seleccionar Cliente</label>
                    <select class="form-select" id="clienteSelect" required>
                      <option value="">-- Buscar o agregar cliente --</option>
                      <option value="1">Juan Díaz - Cliente</option>
                      <option value="2">María López - Cliente</option>
                      <option value="3">Fernando Martínez - Cliente</option>
                    </select>
                  </div>
                </div>

                <!-- Sección: Detalles de Venta -->
                <div class="form-section mb-4">
                  <h6 class="section-title"><i class="fas fa-box-open"></i> Productos</h6>
                  <div class="product-lines">
                    <div class="product-line mb-3 p-3 bg-light rounded">
                      <div class="row g-2">
                        <div class="col-md-5">
                          <label class="form-label">Producto</label>
                          <select class="form-select product-select" data-line="1" required>
                            <option value="">Seleccionar producto</option>
                            <option value="1" data-sku="PROD-LP-001" data-price="1299.99">Laptop DELL XPS 13</option>
                            <option value="2" data-sku="PROD-IF-015" data-price="1199.99">iPhone 15 Pro Max</option>
                            <option value="3" data-sku="PROD-IA-006" data-price="599.99">iPad Air 6</option>
                          </select>
                          <small class="text-muted">SKU: <span class="sku-display">--</span></small>
                        </div>
                        <div class="col-md-2">
                          <label class="form-label">Cantidad</label>
                          <input type="number" class="form-control qty-input" data-line="1" value="1" min="1" required>
                        </div>
                        <div class="col-md-3">
                          <label class="form-label">Precio Unitario</label>
                          <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control price-input" data-line="1" step="0.01" required>
                          </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                          <button type="button" class="btn btn-sm btn-outline-danger btn-remove-line" style="width: 100%;">
                            <i class="fas fa-trash"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-sm btn-outline-primary" id="addProductLineBtn">
                    <i class="fas fa-plus"></i> Agregar Línea
                  </button>
                </div>

                <!-- Sección: Totales -->
                <div class="form-section mb-4">
                  <h6 class="section-title"><i class="fas fa-calculator"></i> Totales</h6>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Total Neto</label>
                      <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control total-neto" readonly value="0.00" step="0.01">
                      </div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Impuestos (15%)</label>
                      <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control total-impuestos" readonly value="0.00" step="0.01">
                      </div>
                    </div>
                    <div class="col-md-12 mb-3">
                      <label class="form-label"><strong>Total General</strong></label>
                      <div class="input-group input-group-lg">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control total-general fw-bold" readonly value="0.00" step="0.01">
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Sección: Forma de Pago -->
                <div class="form-section mb-4">
                  <h6 class="section-title"><i class="fas fa-credit-card"></i> Forma de Pago</h6>
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Método de Pago</label>
                      <select class="form-select" id="metodoPago" required>
                        <option value="">Seleccionar método</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="tarjeta">Tarjeta Débito/Crédito</option>
                        <option value="transferencia">Transferencia Bancaria</option>
                        <option value="credito">Crédito</option>
                      </select>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Estado Inicial</label>
                      <select class="form-select" id="estadoVenta" required>
                        <option value="presupuesto">Presupuesto</option>
                        <option value="completada">Completada</option>
                      </select>
                    </div>
                  </div>
                </div>

                <!-- Sección: Notas -->
                <div class="form-section mb-4">
                  <h6 class="section-title"><i class="fas fa-sticky-note"></i> Notas</h6>
                  <textarea class="form-control" id="notasVenta" rows="2" placeholder="Observaciones o notas adicionales..."></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary btn-lg" id="guardarVentaBtn">
                <i class="fas fa-save"></i> Registrar Venta
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
  <script src="./recursos/js/ventas.js"></script>
</body>
</html>
