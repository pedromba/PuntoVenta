<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión de Cajas - TechStore</title>
  
  <link href="/PuntoVenta/recursos/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./recursos/css/empresa-styles.css">
  <link rel="stylesheet" href="./recursos/css/sidebar.css">
  <link rel="stylesheet" href="./recursos/css/formularios.css">
  <style>
    .cash-box { background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%); color: white; padding: 20px; border-radius: 12px; }
    .cash-amount { font-size: 32px; font-weight: 700; }
    .cash-label { font-size: 12px; opacity: 0.9; }
    .form-section { background: var(--light); padding: 15px; border-radius: 8px; }
    .form-section h6 { margin-bottom: 15px; font-weight: 600; color: var(--text-primary); }
    .status-badge.status-abierta { background: #d1fae5; color: #065f46; }
    .status-badge.status-cerrada { background: #fee2e2; color: #991b1b; }
    .table-responsive { border-radius: 8px; overflow: hidden; }
  </style>
</head>
<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <?php include './componentes/aside.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
      <!-- Topbar -->
      <div class="topbar">
        <div class="topbar-left">
          <button class="btn-toggle-sidebar">
            <i class="fas fa-bars"></i>
          </button>
          <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Buscar cajas...">
          </div>
        </div>

        <div class="topbar-right">
          <div class="notification-icon">
            <i class="fas fa-bell"></i>
            <span class="notification-badge">2</span>
          </div>
          <div class="user-menu">
            <img src="https://via.placeholder.com/40" alt="Usuario" class="user-avatar">
            <span class="user-name">Juan Pérez</span>
            <i class="fas fa-chevron-down"></i>
          </div>
        </div>
      </div>

      <!-- Page Header -->
      <div class="page-header">
        <div class="header-content">
          <h1>Gestión de Cajas</h1>
          <p class="text-muted">Administra la apertura, cierre y arqueo de cajas</p>
        </div>
        <div class="header-buttons">
          <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#abrirCajaModal">
            <i class="fas fa-unlock"></i> Abrir Caja
          </button>
        </div>
      </div>

      <!-- Cajas Summary -->
      <div class="row g-3 mb-4">
        <div class="col-md-3">
          <div class="card shadow-sm">
            <div class="card-body text-center">
              <div class="cash-box mb-3">
                <i class="fas fa-lock-open" style="font-size: 24px;"></i>
              </div>
              <h6 class="text-muted">Cajas Abiertas</h6>
              <h4 class="cash-amount">2</h4>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card shadow-sm">
            <div class="card-body text-center">
              <div class="cash-box mb-3">
                <i class="fas fa-lock" style="font-size: 24px;"></i>
              </div>
              <h6 class="text-muted">Cajas Cerradas (Hoy)</h6>
              <h4 class="cash-amount">5</h4>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card shadow-sm">
            <div class="card-body text-center">
              <div class="cash-box mb-3" style="background: linear-gradient(135deg, #059669 0%, #047857 100%);">
                <i class="fas fa-dollar-sign" style="font-size: 24px;"></i>
              </div>
              <h6 class="text-muted">Total en Cajas</h6>
              <h4 class="cash-amount">$12,450</h4>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card shadow-sm">
            <div class="card-body text-center">
              <div class="cash-box mb-3" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                <i class="fas fa-exclamation-circle" style="font-size: 24px;"></i>
              </div>
              <h6 class="text-muted">Diferencias</h6>
              <h4 class="cash-amount">$125.50</h4>
            </div>
          </div>
        </div>
      </div>

      <!-- Cajas Table -->
      <div class="table-card">
        <div class="card-header">
          <h5>Historial de Cajas <span class="results-count">(42)</span></h5>
        </div>

        <!-- Filtros -->
        <div style="padding: 15px; background: var(--light); border-bottom: 1px solid var(--border-color); display: flex; gap: 10px; flex-wrap: wrap;">
          <select class="form-select" style="max-width: 200px;">
            <option>Todas las cajas</option>
            <option>Cajas Abiertas</option>
            <option>Cajas Cerradas</option>
            <option>Con Diferencias</option>
          </select>
          <select class="form-select" style="max-width: 200px;">
            <option>Todos los usuarios</option>
            <option>Juan Pérez</option>
            <option>María López</option>
          </select>
          <input type="date" class="form-control" style="max-width: 150px;">
          <button class="btn btn-outline-secondary">
            <i class="fas fa-times"></i> Limpiar
          </button>
        </div>

        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID Caja</th>
                <th>Usuario</th>
                <th>Apertura</th>
                <th>Monto Inicial</th>
                <th>Movimientos</th>
                <th>Cierre Sistema</th>
                <th>Cierre Fisico</th>
                <th>Diferencia</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <!-- Caja Abierta -->
              <tr data-caja-id="1" data-status="abierta">
                <td><strong>#CAJA-001</strong></td>
                <td>
                  <div class="d-flex align-items-center">
                    <div style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #667eea, #764ba2); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; margin-right: 10px;">JP</div>
                    Juan Pérez
                  </div>
                </td>
                <td>09/02/2024 08:30</td>
                <td><strong>$1,000.00</strong></td>
                <td>
                  <div class="text-center">
                    <span class="badge bg-light text-dark">12 ventas</span>
                    <br><small class="text-muted">$5,250.00</small>
                  </div>
                </td>
                <td><strong class="text-success">$6,250.00</strong></td>
                <td>--</td>
                <td>--</td>
                <td><span class="status-badge status-abierta"><i class="fas fa-lock-open"></i> Abierta</span></td>
                <td>
                  <button class="btn-action btn-view" title="Ver"><i class="fas fa-eye"></i></button>
                  <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#cerrarCajaModal" title="Cerrar Caja">
                    <i class="fas fa-lock"></i>
                  </button>
                </td>
              </tr>

              <!-- Caja Cerrada -->
              <tr data-caja-id="2" data-status="cerrada">
                <td><strong>#CAJA-002</strong></td>
                <td>
                  <div class="d-flex align-items-center">
                    <div style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #f093fb, #f5576c); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; margin-right: 10px;">ML</div>
                    María López
                  </div>
                </td>
                <td>08/02/2024 09:00</td>
                <td><strong>$1,500.00</strong></td>
                <td>
                  <div class="text-center">
                    <span class="badge bg-light text-dark">18 ventas</span>
                    <br><small class="text-muted">$8,750.00</small>
                  </div>
                </td>
                <td><strong class="text-success">$10,250.00</strong></td>
                <td><strong>$10,250.00</strong></td>
                <td class="text-success"><strong>$0.00</strong></td>
                <td><span class="status-badge status-cerrada"><i class="fas fa-lock"></i> Cerrada</span></td>
                <td>
                  <button class="btn-action btn-view" title="Ver"><i class="fas fa-eye"></i></button>
                  <button class="btn-action btn-print" title="Recibo"><i class="fas fa-print"></i></button>
                </td>
              </tr>

              <!-- Caja con Diferencia -->
              <tr data-caja-id="3" data-status="cerrada">
                <td><strong>#CAJA-003</strong></td>
                <td>
                  <div class="d-flex align-items-center">
                    <div style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #4facfe, #00f2fe); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; margin-right: 10px;">FM</div>
                    Fernando Martín
                  </div>
                </td>
                <td>08/02/2024 10:15</td>
                <td><strong>$800.00</strong></td>
                <td>
                  <div class="text-center">
                    <span class="badge bg-light text-dark">8 ventas</span>
                    <br><small class="text-muted">$3,850.00</small>
                  </div>
                </td>
                <td><strong class="text-success">$4,650.00</strong></td>
                <td><strong>$4,500.00</strong></td>
                <td class="text-danger"><strong>-$150.00</strong></td>
                <td><span class="status-badge status-cerrada"><i class="fas fa-lock"></i> Cerrada</span></td>
                <td>
                  <button class="btn-action btn-view" title="Ver"><i class="fas fa-eye"></i></button>
                  <button class="btn-action btn-print" title="Recibo"><i class="fas fa-print"></i></button>
                </td>
              </tr>

              <!-- Caja Cerrada Sin Diferencias -->
              <tr data-caja-id="4" data-status="cerrada">
                <td><strong>#CAJA-004</strong></td>
                <td>
                  <div class="d-flex align-items-center">
                    <div style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #43e97b, #38f9d7); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; margin-right: 10px;">SP</div>
                    Sandra Pérez
                  </div>
                </td>
                <td>07/02/2024 08:45</td>
                <td><strong>$1,200.00</strong></td>
                <td>
                  <div class="text-center">
                    <span class="badge bg-light text-dark">15 ventas</span>
                    <br><small class="text-muted">$6,500.00</small>
                  </div>
                </td>
                <td><strong class="text-success">$7,700.00</strong></td>
                <td><strong>$7,700.00</strong></td>
                <td class="text-success"><strong>$0.00</strong></td>
                <td><span class="status-badge status-cerrada"><i class="fas fa-lock"></i> Cerrada</span></td>
                <td>
                  <button class="btn-action btn-view" title="Ver"><i class="fas fa-eye"></i></button>
                  <button class="btn-action btn-print" title="Recibo"><i class="fas fa-print"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Modal: Abrir Caja -->
      <div class="modal fade" id="abrirCajaModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fas fa-unlock"></i> Abrir Nueva Caja</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form id="abrirCajaForm" class="needs-validation">

                <!-- Información General -->
                <div class="form-section mb-4">
                  <h6 class="section-title"><i class="fas fa-info-circle"></i> Información General</h6>
                  
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label class="form-label">Usuario Responsable</label>
                      <input type="text" class="form-control" value="Juan Pérez" readonly>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Fecha/Hora Apertura</label>
                      <input type="datetime-local" class="form-control" required>
                    </div>
                  </div>
                </div>

                <!-- Monto Inicial -->
                <div class="form-section mb-4">
                  <h6 class="section-title"><i class="fas fa-dollar-sign"></i> Monto de Apertura</h6>
                  
                  <div class="mb-3">
                    <label class="form-label">Monto Inicial en Caja</label>
                    <div class="input-group input-group-lg">
                      <span class="input-group-text">$</span>
                      <input type="number" class="form-control" id="montoApertura" step="0.01" min="0" placeholder="0.00" required>
                    </div>
                    <small class="text-muted">Dinero en efectivo disponible para iniciar caja</small>
                  </div>

                  <!-- Desglose de billetes (opcional) -->
                  <div class="collapse" id="desgloseMontos">
                    <div class="card card-body bg-light mt-3">
                      <h6 class="mb-3">Desglose de Billetes/Monedas (opcional)</h6>
                      <div class="row g-2">
                        <div class="col-md-4">
                          <label class="form-label">$100 x</label>
                          <input type="number" class="form-control form-control-sm" min="0">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">$50 x</label>
                          <input type="number" class="form-control form-control-sm" min="0">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">$20 x</label>
                          <input type="number" class="form-control form-control-sm" min="0">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">$10 x</label>
                          <input type="number" class="form-control form-control-sm" min="0">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">$5 x</label>
                          <input type="number" class="form-control form-control-sm" min="0">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">$1 x</label>
                          <input type="number" class="form-control form-control-sm" min="0">
                        </div>
                      </div>
                    </div>
                  </div>

                  <button type="button" class="btn btn-sm btn-outline-secondary mt-2" data-bs-toggle="collapse" data-bs-target="#desgloseMontos">
                    <i class="fas fa-chevron-down"></i> Desglosar Montos
                  </button>
                </div>

                <!-- Notas -->
                <div class="form-section">
                  <h6 class="section-title"><i class="fas fa-sticky-note"></i> Notas</h6>
                  <textarea class="form-control" rows="2" placeholder="Observaciones o notas al abrir caja..."></textarea>
                </div>

              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary btn-lg" id="confirmarAperturaBth">
                <i class="fas fa-unlock"></i> Abrir Caja
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal: Cerrar y Arquear Caja -->
      <div class="modal fade" id="cerrarCajaModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fas fa-lock"></i> Cerrar y Arquear Caja</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form id="cerrarCajaForm" class="needs-validation">

                <!-- Información de Caja -->
                <div class="form-section mb-4">
                  <h6 class="section-title"><i class="fas fa-info-circle"></i> Caja Actual</h6>
                  
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label class="form-label">ID Caja</label>
                      <input type="text" class="form-control" value="CAJA-001" readonly>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Usuario</label>
                      <input type="text" class="form-control" value="Juan Pérez" readonly>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label class="form-label">Apertura</label>
                      <input type="datetime-local" class="form-control" value="2026-02-09T08:30" readonly>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Monto Inicial</label>
                      <input type="text" class="form-control" value="$1,000.00" readonly>
                    </div>
                  </div>
                </div>

                <!-- Totales del Sistema -->
                <div class="form-section mb-4">
                  <h6 class="section-title"><i class="fas fa-computer"></i> Totales Según Sistema</h6>
                  
                  <div class="alert alert-info">
                    <div class="row">
                      <div class="col-md-6">
                        <small class="text-muted">Monto Inicial</small>
                        <h5>$1,000.00</h5>
                      </div>
                      <div class="col-md-6">
                        <small class="text-muted">Total Ventas</small>
                        <h5 class="text-success">+$5,250.00</h5>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                        <small class="text-muted">TOTAL ESPERADO EN CAJA (Sistema)</small>
                        <h4 class="fw-bold">$6,250.00</h4>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Conteo Físico -->
                <div class="form-section mb-4">
                  <h6 class="section-title"><i class="fas fa-coins"></i> Conteo Físico</h6>
                  
                  <div class="mb-3">
                    <label class="form-label">Total Contado en Caja (Físico)</label>
                    <div class="input-group input-group-lg">
                      <span class="input-group-text">$</span>
                      <input type="number" class="form-control" id="montoCierre" step="0.01" min="0" placeholder="0.00" required>
                    </div>
                  </div>

                  <!-- Desglose de billetes -->
                  <div class="collapse" id="desgloseMontosCierre">
                    <div class="card card-body bg-light mt-3">
                      <h6 class="mb-3">Desglose de Billetes/Monedas Contados</h6>
                      <div class="row g-2">
                        <div class="col-md-4">
                          <label class="form-label">$100 x</label>
                          <input type="number" class="form-control form-control-sm" min="0" data-valor="100">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">$50 x</label>
                          <input type="number" class="form-control form-control-sm" min="0" data-valor="50">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">$20 x</label>
                          <input type="number" class="form-control form-control-sm" min="0" data-valor="20">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">$10 x</label>
                          <input type="number" class="form-control form-control-sm" min="0" data-valor="10">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">$5 x</label>
                          <input type="number" class="form-control form-control-sm" min="0" data-valor="5">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">$1 x</label>
                          <input type="number" class="form-control form-control-sm" min="0" data-valor="1">
                        </div>
                      </div>
                    </div>
                  </div>

                  <button type="button" class="btn btn-sm btn-outline-secondary mt-2" data-bs-toggle="collapse" data-bs-target="#desgloseMontosCierre">
                    <i class="fas fa-chevron-down"></i> Desglosar Montos
                  </button>
                </div>

                <!-- Resultado del Arqueo -->
                <div class="form-section mb-4">
                  <h6 class="section-title"><i class="fas fa-balance-scale"></i> Resultado del Arqueo</h6>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="p-3 bg-light rounded">
                        <small class="text-muted">Esperado (Sistema)</small>
                        <h5 class="fw-bold mb-0">$6,250.00</h5>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="p-3 bg-light rounded">
                        <small class="text-muted">Contado (Físico)</small>
                        <h5 class="fw-bold mb-0" id="totalContado">$0.00</h5>
                      </div>
                    </div>
                  </div>

                  <div class="alert alert-warning mt-3 d-flex align-items-center" id="diferenciaAlert" style="display: none;">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <div>
                      <strong>Diferencia detectada:</strong> <span id="montosDiferencia">$0.00</span>
                    </div>
                  </div>
                </div>

                <!-- Notas de Cierre -->
                <div class="form-section">
                  <h6 class="section-title"><i class="fas fa-sticky-note"></i> Notas de Cierre</h6>
                  <textarea class="form-control" rows="2" placeholder="Observaciones sobre diferencias o eventos del día..."></textarea>
                </div>

              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-success btn-lg" id="confirmarCierreBtn">
                <i class="fas fa-lock"></i> Confirmar Cierre
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="page-footer">
        <p>&copy; 2024 Sistema de Gestión - TechStore. Todos los derechos reservados.</p>
      </footer>
    </div>
  </div>

  <!-- Scripts -->
  <script src="../recursos/js/bootstrap.bundle.min.js"></script>
  <script src="./recursos/js/empresa.js"></script>
</body>
</html>
