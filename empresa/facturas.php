<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Facturas - TechStore</title>
  
  <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./recursos/css/empresa-styles.css">
  <link rel="stylesheet" href="./recursos/css/sidebar.css">
  <link rel="stylesheet" href="./recursos/css/formularios.css">
  <link rel="stylesheet" href="./recursos/css/facturas.css">
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
            <input type="text" placeholder="Buscar factura..." id="searchInvoice">
          </div>
        </div>
        <div class="topbar-right">
          <div class="notification-icon"><i class="fas fa-bell"></i><span class="notification-badge">2</span></div>
          <div class="user-menu">
            <img src="https://via.placeholder.com/40" alt="Usuario" class="user-avatar">
            <span class="user-name">Juan Pérez</span>
          </div>
        </div>
      </div>

      <!-- Page Header -->
      <div class="page-header">
        <div class="header-content">
          <h1>Facturas</h1>
          <p class="text-muted">Gestiona tus documentos de facturación</p>
        </div>
        <div class="header-buttons">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newInvoiceModal">
            <i class="fas fa-file-invoice"></i> Nueva Factura
          </button>
        </div>
      </div>

      <!-- Stats -->
      <div class="stats-cards">
        <div class="stat-card">
          <div class="stat-header"><h6>Total Facturado</h6></div>
          <div class="stat-value">$156,320</div>
          <div class="stat-change">Mes actual</div>
        </div>
        <div class="stat-card">
          <div class="stat-header"><h6>Facturas Emitidas</h6></div>
          <div class="stat-value">127</div>
          <div class="stat-change">En el mes</div>
        </div>
        <div class="stat-card">
          <div class="stat-header"><h6>Pendiente de Pago</h6></div>
          <div class="stat-value">$12,450</div>
          <div class="stat-change negative">15 facturas</div>
        </div>
      </div>

      <!-- Filters -->
      <div class="filters-section">
        <div class="filter-group">
          <select id="filterStatus" class="form-select">
            <option value="">Todos los estados</option>
            <option value="pagada">Pagada</option>
            <option value="pendiente">Pendiente</option>
            <option value="parcial">Pago Parcial</option>
            <option value="cancelada">Cancelada</option>
          </select>
        </div>
        <div class="filter-group">
          <input type="date" id="filterDate" class="form-control">
        </div>
        <button class="btn btn-outline-secondary" id="clearFilters">
          <i class="fas fa-times"></i> Limpiar
        </button>
      </div>

      <!-- Invoices Table -->
      <div class="table-card">
        <div class="card-header">
          <h5>Historial de Facturas <span class="results-count">(127)</span></h5>
          <button class="btn btn-sm btn-outline-primary"><i class="fas fa-download"></i> Exportar</button>
        </div>
        <div class="table-responsive">
          <table class="invoices-table">
            <thead>
              <tr>
                <th>Número Factura</th>
                <th>Serie / Correlativo</th>
                <th>Cliente / Razon Social</th>
                <th>Venta Asociada</th>
                <th>Fecha Emisión</th>
                <th>Total General</th>
                <th>PDF</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr class="invoice-row" data-invoice-id="1">
                <td><strong class="invoice-number">F-00000001</strong></td>
                <td>
                  <div class="serie-info">
                    <span class="badge bg-info">F</span>
                    <code>00000001</code>
                  </div>
                </td>
                <td>
                  <div class="client-info">
                    <div class="client-name">Juan Díaz</div>
                    <small class="text-muted">NIF/CIF: 12345678A</small>
                  </div>
                </td>
                <td>
                  <a href="#" class="sale-link">V-2024-001456</a>
                </td>
                <td>09/02/2024 14:32</td>
                <td><strong class="amount">$2,932.50</strong></td>
                <td>
                  <a href="#" class="btn-pdf" title="Descargar PDF">
                    <i class="fas fa-file-pdf"></i>
                  </a>
                </td>
                <td>
                  <div class="action-buttons">
                    <button class="btn-action btn-view" title="Ver"><i class="fas fa-eye"></i></button>
                    <button class="btn-action btn-print" title="Imprimir"><i class="fas fa-print"></i></button>
                    <button class="btn-action btn-download" title="Descargar"><i class="fas fa-download"></i></button>
                  </div>
                </td>
              </tr>

              <tr class="invoice-row" data-invoice-id="2">
                <td><strong class="invoice-number">F-00000002</strong></td>
                <td>
                  <div class="serie-info">
                    <span class="badge bg-info">F</span>
                    <code>00000002</code>
                  </div>
                </td>
                <td>
                  <div class="client-info">
                    <div class="client-name">María López</div>
                    <small class="text-muted">NIF/CIF: 87654321B</small>
                  </div>
                </td>
                <td>
                  <a href="#" class="sale-link">V-2024-001455</a>
                </td>
                <td>09/02/2024 11:15</td>
                <td><strong class="amount">$828.00</strong></td>
                <td>
                  <a href="#" class="btn-pdf" title="Descargar PDF">
                    <i class="fas fa-file-pdf"></i>
                  </a>
                </td>
                <td>
                  <div class="action-buttons">
                    <button class="btn-action btn-view" title="Ver"><i class="fas fa-eye"></i></button>
                    <button class="btn-action btn-print" title="Imprimir"><i class="fas fa-print"></i></button>
                    <button class="btn-action btn-download" title="Descargar"><i class="fas fa-download"></i></button>
                  </div>
                </td>
              </tr>

              <tr class="invoice-row" data-invoice-id="3">
                <td><strong class="invoice-number">F-00000003</strong></td>
                <td>Carlos Martín</td>
                <td>20/01/2024</td>
                <td>04/02/2024</td>
                <td>Servidor y equipamiento</td>
                <td>$8,750.00</td>
                <td><span class="status-badge status-pagada"><i class="fas fa-check-circle"></i> Pagada</span></td>
                <td>
                  <button class="btn-action btn-view" title="Ver"><i class="fas fa-eye"></i></button>
                  <button class="btn-action btn-print" title="Imprimir"><i class="fas fa-print"></i></button>
                  <button class="btn-action btn-download" title="Descargar"><i class="fas fa-download"></i></button>
                </td>
              </tr>

              <tr class="invoice-row" data-status="parcial">
                <td><strong>FAC-2024-0004</strong></td>
                <td>Ana Sánchez</td>
                <td>22/01/2024</td>
                <td>06/02/2024</td>
                <td>Impresoras y tóner</td>
                <td>$1,200.00</td>
                <td><span class="status-badge status-parcial"><i class="fas fa-minus-circle"></i> Pago Parcial</span></td>
                <td>
                  <button class="btn-action btn-view" title="Ver"><i class="fas fa-eye"></i></button>
                  <button class="btn-action btn-print" title="Imprimir"><i class="fas fa-print"></i></button>
                  <button class="btn-action btn-download" title="Descargar"><i class="fas fa-download"></i></button>
                </td>
              </tr>

              <tr class="invoice-row" data-status="pendiente">
                <td><strong>FAC-2024-0005</strong></td>
                <td>Pedro Gómez</td>
                <td>25/01/2024</td>
                <td>10/02/2024</td>
                <td>Licencias software y soporte</td>
                <td>$5,600.00</td>
                <td><span class="status-badge status-pendiente"><i class="fas fa-clock"></i> Pendiente</span></td>
                <td>
                  <button class="btn-action btn-view" title="Ver"><i class="fas fa-eye"></i></button>
                  <button class="btn-action btn-print" title="Imprimir"><i class="fas fa-print"></i></button>
                  <button class="btn-action btn-download" title="Descargar"><i class="fas fa-download"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Modal: New Invoice (Generar Factura desde Venta) -->
      <div class="modal fade" id="newInvoiceModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fas fa-file-invoice"></i> Generar Nueva Factura</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form id="newInvoiceForm" class="needs-validation">
                
                <!-- Sección: Seleccionar Venta -->
                <div class="form-section mb-4">
                  <h6 class="section-title"><i class="fas fa-link"></i> Venta Asociada</h6>
                  <div class="mb-3">
                    <label class="form-label">Seleccionar Venta Completada</label>
                    <select class="form-select" id="ventaSelect" required>
                      <option value="">-- Buscar venta --</option>
                      <option value="456" data-total="2932.50" data-cliente="Juan Díaz">V-2024-001456 - Juan Díaz - $2,932.50</option>
                      <option value="455" data-total="828.00" data-cliente="María López">V-2024-001455 - María López - $828.00</option>
                      <option value="453" data-total="2599.99" data-cliente="Fernando Martínez">V-2024-001453 - Fernando Martínez - $2,599.99</option>
                    </select>
                    <small class="text-muted">Solo se pueden facturar ventas con estado "Completada"</small>
                  </div>
                </div>

                <!-- Sección: Datos de Factura -->
                <div class="form-section mb-4">
                  <h6 class="section-title"><i class="fas fa-file-alt"></i> Datos de Factura</h6>
                  
                  <div class="row mb-3">
                    <div class="col-md-4">
                      <label class="form-label">Serie</label>
                      <select class="form-select" id="serieFactura" data-factura-number=".factura-number" required>
                        <option value="F">F - Factura</option>
                        <option value="NC">NC - Nota de Crédito</option>
                        <option value="ND">ND - Nota de Débito</option>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Correlativo</label>
                      <input type="number" class="form-control" id="correlativoFactura" value="1" min="1" required>
                    </div>
                    <div class="col-md-4">
                      <label class="form-label">Número Factura</label>
                      <div class="input-group">
                        <input type="text" class="form-control form-control-plaintext factura-number" readonly value="F-00000001">
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label class="form-label">Cliente</label>
                      <input type="text" class="form-control" id="clienteFactura" readonly placeholder="">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Fecha de Emisión</label>
                      <input type="date" class="form-control" id="fechaEmision" required>
                    </div>
                  </div>
                </div>

                <!-- Sección: Detalles de Venta -->
                <div class="form-section mb-4">
                  <h6 class="section-title"><i class="fas fa-receipt"></i> Detalles de Venta</h6>
                  
                  <div class="invoice-details-preview">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th>Producto</th>
                          <th>Cantidad</th>
                          <th>Precio Unit.</th>
                          <th>Subtotal</th>
                        </tr>
                      </thead>
                      <tbody id="detallesVentaBody">
                        <tr>
                          <td colspan="4" class="text-center text-muted"><small>Selecciona una venta para ver detalles</small></td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="3" class="text-end">Total Neto:</th>
                          <th class="text-end"><span id="totalNeto">$0.00</span></th>
                        </tr>
                        <tr>
                          <th colspan="3" class="text-end">Impuestos (15%):</th>
                          <th class="text-end"><span id="totalImpuestos">$0.00</span></th>
                        </tr>
                        <tr class="fw-bold">
                          <th colspan="3" class="text-end">Total General:</th>
                          <th class="text-end"><span id="totalGeneral">$0.00</span></th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>

                <!-- Sección: Información Adicional -->
                <div class="form-section mb-4">
                  <h6 class="section-title"><i class="fas fa-sticky-note"></i> Información Adicional</h6>
                  <div class="mb-3">
                    <label class="form-label">Notas en Factura (opcional)</label>
                    <textarea class="form-control" id="notasFactura" rows="2" placeholder="Condiciones de pago, observaciones, etc..."></textarea>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="generarPDF" checked>
                    <label class="form-check-label" for="generarPDF">
                      Generar PDF automáticamente
                    </label>
                  </div>
                </div>

              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-success" id="guardarFacturaBtn">
                <i class="fas fa-save"></i> Generar Factura
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
