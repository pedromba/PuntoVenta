<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clientes - TechStore</title>
  
  <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./recursos/css/empresa-styles.css">
  <link rel="stylesheet" href="./recursos/css/sidebar.css">
  <link rel="stylesheet" href="./recursos/css/formularios.css">
  <link rel="stylesheet" href="./recursos/css/clientes.css">
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
            <input type="text" placeholder="Buscar clientes..." id="searchClientes">
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
          <h1>Gestión de Clientes</h1>
          <p class="text-muted">Administra tu cartera de clientes</p>
        </div>
        <div class="header-buttons">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClientModal">
            <i class="fas fa-plus"></i> Nuevo Cliente
          </button>
        </div>
      </div>

      <!-- Stats -->
      <div class="stats-cards">
        <div class="stat-card">
          <div class="stat-header"><h6>Total Clientes</h6></div>
          <div class="stat-value">89</div>
          <div class="stat-change positive"><i class="fas fa-arrow-up"></i> 5 nuevos hoy</div>
        </div>
        <div class="stat-card">
          <div class="stat-header"><h6>Clientes Activos</h6></div>
          <div class="stat-value">76</div>
          <div class="stat-change">85.4% del total</div>
        </div>
        <div class="stat-card">
          <div class="stat-header"><h6>Gasto Promedio</h6></div>
          <div class="stat-value">$1,245.87</div>
          <div class="stat-change positive"><i class="fas fa-arrow-up"></i> 12% vs mes anterior</div>
        </div>
      </div>

      <!-- Filters -->
      <div class="filters-section">
        <div class="filter-group">
          <select id="filterStatus" class="form-select">
            <option value="">Estado</option>
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
            <option value="suspendido">Suspendido</option>
          </select>
        </div>
        <div class="filter-group">
          <select id="sortClientes" class="form-select">
            <option value="reciente">Más Reciente</option>
            <option value="nombre">Nombre (A-Z)</option>
            <option value="gasto">Mayor Gasto</option>
          </select>
        </div>
        <button class="btn btn-outline-secondary" id="clearFilters">
          <i class="fas fa-times"></i> Limpiar
        </button>
      </div>

      <!-- Clients Grid/List -->
      <div class="table-card">
        <div class="card-header">
          <h5>Clientes Registrados <span class="results-count">(89)</span></h5>
          <div class="view-toggle">
            <button class="btn-view active" data-view="grid"><i class="fas fa-th"></i></button>
            <button class="btn-view" data-view="list"><i class="fas fa-list"></i></button>
          </div>
        </div>
        <div class="clients-grid" id="clientsView">
          <!-- Grid View -->
          <div class="clients-container">
            <div class="client-card">
              <div class="client-header">
                <div class="client-avatar-large">JD</div>
                <div class="client-status-badge status-activo">
                  <span class="status-dot"></span> Activo
                </div>
              </div>
              <div class="client-body">
                <h5 class="client-name">Juan Díaz</h5>
                <p class="client-email">juan.diaz@email.com</p>
                <p class="client-phone"><i class="fas fa-phone"></i> +505-8765-4321</p>
                <div class="client-stats">
                  <div class="stat">
                    <span class="stat-label">Compras</span>
                    <span class="stat-value">12</span>
                  </div>
                  <div class="stat">
                    <span class="stat-label">Gasto Total</span>
                    <span class="stat-value">$3,245.50</span>
                  </div>
                </div>
              </div>
              <div class="client-footer">
                <button class="btn btn-sm btn-outline-primary" title="Ver"><i class="fas fa-eye"></i> Ver</button>
                <button class="btn btn-sm btn-outline-secondary" title="Editar"><i class="fas fa-edit"></i></button>
                <button class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash"></i></button>
              </div>
            </div>

            <div class="client-card">
              <div class="client-header">
                <div class="client-avatar-large">ML</div>
                <div class="client-status-badge status-activo">
                  <span class="status-dot"></span> Activo
                </div>
              </div>
              <div class="client-body">
                <h5 class="client-name">María López</h5>
                <p class="client-email">maria.lopez@email.com</p>
                <p class="client-phone"><i class="fas fa-phone"></i> +505-7654-3210</p>
                <div class="client-stats">
                  <div class="stat">
                    <span class="stat-label">Compras</span>
                    <span class="stat-value">8</span>
                  </div>
                  <div class="stat">
                    <span class="stat-label">Gasto Total</span>
                    <span class="stat-value">$2,150.30</span>
                  </div>
                </div>
              </div>
              <div class="client-footer">
                <button class="btn btn-sm btn-outline-primary" title="Ver"><i class="fas fa-eye"></i> Ver</button>
                <button class="btn btn-sm btn-outline-secondary" title="Editar"><i class="fas fa-edit"></i></button>
                <button class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash"></i></button>
              </div>
            </div>

            <div class="client-card">
              <div class="client-header">
                <div class="client-avatar-large">CR</div>
                <div class="client-status-badge status-activo">
                  <span class="status-dot"></span> Activo
                </div>
              </div>
              <div class="client-body">
                <h5 class="client-name">Carlos Rubio</h5>
                <p class="client-email">carlos.rubio@email.com</p>
                <p class="client-phone"><i class="fas fa-phone"></i> +505-6543-2109</p>
                <div class="client-stats">
                  <div class="stat">
                    <span class="stat-label">Compras</span>
                    <span class="stat-value">15</span>
                  </div>
                  <div class="stat">
                    <span class="stat-label">Gasto Total</span>
                    <span class="stat-value">$5,678.90</span>
                  </div>
                </div>
              </div>
              <div class="client-footer">
                <button class="btn btn-sm btn-outline-primary" title="Ver"><i class="fas fa-eye"></i> Ver</button>
                <button class="btn btn-sm btn-outline-secondary" title="Editar"><i class="fas fa-edit"></i></button>
                <button class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash"></i></button>
              </div>
            </div>

            <div class="client-card">
              <div class="client-header">
                <div class="client-avatar-large">FM</div>
                <div class="client-status-badge status-inactivo">
                  <span class="status-dot"></span> Inactivo
                </div>
              </div>
              <div class="client-body">
                <h5 class="client-name">Fernando Martínez</h5>
                <p class="client-email">fernando.m@email.com</p>
                <p class="client-phone"><i class="fas fa-phone"></i> +505-5432-1098</p>
                <div class="client-stats">
                  <div class="stat">
                    <span class="stat-label">Compras</span>
                    <span class="stat-value">3</span>
                  </div>
                  <div class="stat">
                    <span class="stat-label">Gasto Total</span>
                    <span class="stat-value">$899.99</span>
                  </div>
                </div>
              </div>
              <div class="client-footer">
                <button class="btn btn-sm btn-outline-primary" title="Ver"><i class="fas fa-eye"></i> Ver</button>
                <button class="btn btn-sm btn-outline-secondary" title="Editar"><i class="fas fa-edit"></i></button>
                <button class="btn btn-sm btn-outline-danger" title="Eliminar"><i class="fas fa-trash"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal: Add Client -->
      <div class="modal fade" id="addClientModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Nuevo Cliente</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form id="addClientForm" class="needs-validation">
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label>Nombre</label>
                    <input type="text" class="form-control" required placeholder="Nombre completo">
                  </div>
                  <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" class="form-control" required placeholder="cliente@email.com">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label>Teléfono</label>
                    <input type="tel" class="form-control" required placeholder="+505-xxxx-xxxx">
                  </div>
                  <div class="col-md-6">
                    <label>Empresa (Opcional)</label>
                    <input type="text" class="form-control" placeholder="Nombre de empresa">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-12">
                    <label>Dirección</label>
                    <input type="text" class="form-control" placeholder="Dirección completa">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                    <label>Estado</label>
                    <select class="form-select" required>
                      <option>Activo</option>
                      <option>Inactivo</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label>Tipo de Cliente</label>
                    <select class="form-select" required>
                      <option>Minorista</option>
                      <option>Mayorista</option>
                      <option>Distribuidor</option>
                    </select>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary">Guardar Cliente</button>
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
  <script src="./recursos/js/clientes.js"></script>
</body>
</html>
