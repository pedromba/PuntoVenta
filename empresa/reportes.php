<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reportes - TechStore</title>
  
  <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./recursos/css/empresa-styles.css">
  <link rel="stylesheet" href="./recursos/css/sidebar.css">
  <link rel="stylesheet" href="./recursos/css/formularios.css">
  <link rel="stylesheet" href="./recursos/css/reportes.css">
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
            <input type="text" placeholder="Buscar reportes..." id="searchReports">
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
          <h1>Reportes y Análisis</h1>
          <p class="text-muted">Visualiza el desempeño de tu negocio</p>
        </div>
        <div class="header-buttons">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#generateReportModal">
            <i class="fas fa-file-pdf"></i> Generar Reporte
          </button>
        </div>
      </div>

      <!-- Date Range Filter -->
      <div class="filters-section">
        <div class="filter-group">
          <label>Desde</label>
          <input type="date" class="form-control" id="dateFrom">
        </div>
        <div class="filter-group">
          <label>Hasta</label>
          <input type="date" class="form-control" id="dateTo">
        </div>
        <div class="filter-group">
          <button class="btn btn-secondary"><i class="fas fa-redo"></i> Aplicar</button>
        </div>
      </div>

      <!-- Summary Cards -->
      <div class="row">
        <div class="col-md-3">
          <div class="summary-card">
            <div class="card-icon bg-primary"><i class="fas fa-dollar-sign"></i></div>
            <div class="card-content">
              <h6>Ventas Totales</h6>
              <p class="card-value">$156,320</p>
              <span class="card-change positive"><i class="fas fa-arrow-up"></i> +23.8%</span>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="summary-card">
            <div class="card-icon bg-success"><i class="fas fa-shopping-cart"></i></div>
            <div class="card-content">
              <h6>Órdenes</h6>
              <p class="card-value">127</p>
              <span class="card-change positive"><i class="fas fa-arrow-up"></i> +12.5%</span>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="summary-card">
            <div class="card-icon bg-warning"><i class="fas fa-average"></i></div>
            <div class="card-content">
              <h6>Ticket Promedio</h6>
              <p class="card-value">$1,231</p>
              <span class="card-change positive"><i class="fas fa-arrow-up"></i> +5.2%</span>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="summary-card">
            <div class="card-icon bg-info"><i class="fas fa-users"></i></div>
            <div class="card-content">
              <h6>Clientes Nuevos</h6>
              <p class="card-value">18</p>
              <span class="card-change positive"><i class="fas fa-arrow-up"></i> +8.3%</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Reports Grid -->
      <div class="reports-grid">
        <div class="report-card">
          <div class="report-header">
            <h6><i class="fas fa-line-chart"></i> Ventas Diarias</h6>
            <span class="badge bg-primary">En vivo</span>
          </div>
          <div class="report-content">
            <p class="text-muted">Análisis de ventas por día</p>
            <div class="chart-placeholder">
              <i class="fas fa-chart-line"></i><br><small>Gráfico de línea</small>
            </div>
          </div>
          <div class="report-footer">
            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i> Ver</button>
            <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-download"></i> Descargar</button>
          </div>
        </div>

        <div class="report-card">
          <div class="report-header">
            <h6><i class="fas fa-pie-chart"></i> Ventas por Categoría</h6>
            <span class="badge bg-success">Actualizado</span>
          </div>
          <div class="report-content">
            <p class="text-muted">Distribución de ventas por categoría</p>
            <div class="chart-placeholder">
              <i class="fas fa-chart-pie"></i><br><small>Gráfico circular</small>
            </div>
          </div>
          <div class="report-footer">
            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i> Ver</button>
            <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-download"></i> Descargar</button>
          </div>
        </div>

        <div class="report-card">
          <div class="report-header">
            <h6><i class="fas fa-bar-chart"></i> Productos Top</h6>
            <span class="badge bg-info">Top 10</span>
          </div>
          <div class="report-content">
            <p class="text-muted">Productos más vendidos</p>
            <div class="mini-list">
              <div class="list-item">1. Laptop DELL XPS 13 - $18,999</div>
              <div class="list-item">2. iPhone 15 Pro Max - $15,199</div>
              <div class="list-item">3. iPad Air 6 - $6,599</div>
            </div>
          </div>
          <div class="report-footer">
            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i> Ver</button>
            <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-download"></i> Descargar</button>
          </div>
        </div>

        <div class="report-card">
          <div class="report-header">
            <h6><i class="fas fa-user-chart"></i> Clientes Frecuentes</h6>
            <span class="badge bg-warning">Top 15</span>
          </div>
          <div class="report-content">
            <p class="text-muted">Clientes con más compras</p>
            <div class="mini-list">
              <div class="list-item">1. Juan López - 15 compras - $24,500</div>
              <div class="list-item">2. María García - 12 compras - $18,900</div>
              <div class="list-item">3. Carlos Martín - 10 compras - $15,450</div>
            </div>
          </div>
          <div class="report-footer">
            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i> Ver</button>
            <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-download"></i> Descargar</button>
          </div>
        </div>

        <div class="report-card">
          <div class="report-header">
            <h6><i class="fas fa-money-bill-wave"></i> Ingresos Mensuales</h6>
            <span class="badge bg-success">Mes Actual</span>
          </div>
          <div class="report-content">
            <p class="text-muted">Tendencia de ingresos</p>
            <div class="chart-placeholder">
              <i class="fas fa-chart-bar"></i><br><small>Gráfico de barras</small>
            </div>
          </div>
          <div class="report-footer">
            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i> Ver</button>
            <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-download"></i> Descargar</button>
          </div>
        </div>

        <div class="report-card">
          <div class="report-header">
            <h6><i class="fas fa-box"></i> Stock y Movimientos</h6>
            <span class="badge bg-info">Inventario</span>
          </div>
          <div class="report-content">
            <p class="text-muted">Estado del inventario</p>
            <div class="mini-list">
              <div class="list-item">Stock Total: 245 unidades</div>
              <div class="list-item">Stock Bajo: 5 productos</div>
              <div class="list-item">Valor: $156,450</div>
            </div>
          </div>
          <div class="report-footer">
            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i> Ver</button>
            <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-download"></i> Descargar</button>
          </div>
        </div>
      </div>

      <!-- Modal: Generate Report -->
      <div class="modal fade" id="generateReportModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Generar Reporte</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form id="generateReportForm">
                <div class="mb-3">
                  <label>Tipo de Reporte</label>
                  <select class="form-select" required>
                    <option>Seleccionar tipo</option>
                    <option>Resumen de Ventas</option>
                    <option>Análisis de Productos</option>
                    <option>Reporte de Clientes</option>
                    <option>Estado de Inventario</option>
                    <option>Análisis Financiero</option>
                  </select>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label>Desde</label>
                    <input type="date" class="form-control" required>
                  </div>
                  <div class="col-md-6">
                    <label>Hasta</label>
                    <input type="date" class="form-control" required>
                  </div>
                </div>
                <div class="mb-3">
                  <label>Formato</label>
                  <div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="format" value="pdf" id="formatPdf" checked>
                      <label class="form-check-label">PDF</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="format" value="excel" id="formatExcel">
                      <label class="form-check-label">Excel</label>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary"><i class="fas fa-download"></i> Generar</button>
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
