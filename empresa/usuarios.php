<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión de Usuarios - Mi Empresa</title>
  
  <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Custom CSS -->
  <link rel="stylesheet" href="./recursos/css/empresa-styles.css">
  <link rel="stylesheet" href="./recursos/css/sidebar.css">
  <link rel="stylesheet" href="./recursos/css/formularios.css">
  <link rel="stylesheet" href="./recursos/css/usuarios.css">
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
            <input type="text" placeholder="Buscar usuarios..." id="searchUsers">
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
          <h1>Gestión de Usuarios</h1>
          <p class="text-muted">Administra los usuarios de tu empresa</p>
        </div>
        <div class="header-buttons">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="fas fa-user-plus"></i> Nuevo Usuario
          </button>
        </div>
      </div>

      <!-- Stats Section -->
      <div class="stats-row mb-4">
        <div class="row g-3">
          <div class="col-md-3">
            <div class="stat-card">
              <div class="stat-icon info">
                <i class="fas fa-users"></i>
              </div>
              <div class="stat-content">
                <h6>Total de Usuarios</h6>
                <h4 id="totalUsers">--</h4>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="stat-card">
              <div class="stat-icon success">
                <i class="fas fa-check-circle"></i>
              </div>
              <div class="stat-content">
                <h6>Usuarios Activos</h6>
                <h4 id="activeUsers">--</h4>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="stat-card">
              <div class="stat-icon warning">
                <i class="fas fa-user-tie"></i>
              </div>
              <div class="stat-content">
                <h6>Administradores</h6>
                <h4 id="adminUsers">--</h4>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="stat-card">
              <div class="stat-icon danger">
                <i class="fas fa-ban"></i>
              </div>
              <div class="stat-content">
                <h6>Usuarios Inactivos</h6>
                <h4 id="inactiveUsers">--</h4>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Filters Section -->
      <div class="filters-section">
        <div class="filter-group">
          <select id="filterRol" class="form-select">
            <option value="">Todos los roles</option>
            <option value="admin">Administrador</option>
            <option value="finanzas">Finanzas</option>
            <option value="almacen">Almacén</option>
            <option value="vendedor">Vendedor</option>
          </select>
        </div>
        <div class="filter-group">
          <select id="filterEstado" class="form-select">
            <option value="">Todos los estados</option>
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
          </select>
        </div>
        <button class="btn btn-outline-secondary" id="clearFilters">
          <i class="fas fa-times"></i> Limpiar Filtros
        </button>
      </div>

      <!-- Users Table -->
      <div class="table-card">
        <div class="card-header">
          <h5>Usuarios de la Empresa <span class="results-count" id="usersCount">(0)</span></h5>
        </div>
        <div class="table-responsive">
          <table class="users-table">
            <thead>
              <tr>
                <th>Usuario</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Fecha Registro</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody id="usersTableBody">
              <!-- Filas de ejemplo -->
              <tr class="user-row" data-user-id="1" data-status="activo">
                <td>
                  <div class="user-cell">
                    <img src="https://ui-avatars.com/api/?name=Juan+Perez&background=2563eb&color=fff" alt="Usuario" class="user-avatar">
                    <div class="user-info">
                      <div class="user-name">Juan Pérez</div>
                      <small class="text-muted">ID: #001</small>
                    </div>
                  </div>
                </td>
                <td>juan.perez@empresa.com</td>
                <td>
                  <span class="badge bg-primary">Administrador</span>
                </td>
                <td>
                  <span class="status-badge status-activo">
                    <i class="fas fa-check-circle"></i> Activo
                  </span>
                </td>
                <td><small class="text-muted">15 Feb 2025</small></td>
                <td>
                  <div class="action-buttons">
                    <button class="btn-action btn-edit" title="Editar"><i class="fas fa-edit"></i></button>
                    <button class="btn-action btn-delete" title="Eliminar"><i class="fas fa-trash"></i></button>
                  </div>
                </td>
              </tr>

              <tr class="user-row" data-user-id="2" data-status="activo">
                <td>
                  <div class="user-cell">
                    <img src="https://ui-avatars.com/api/?name=Maria+Garcia&background=10b981&color=fff" alt="Usuario" class="user-avatar">
                    <div class="user-info">
                      <div class="user-name">María García</div>
                      <small class="text-muted">ID: #002</small>
                    </div>
                  </div>
                </td>
                <td>maria.garcia@empresa.com</td>
                <td>
                  <span class="badge bg-success">Vendedor</span>
                </td>
                <td>
                  <span class="status-badge status-activo">
                    <i class="fas fa-check-circle"></i> Activo
                  </span>
                </td>
                <td><small class="text-muted">20 Feb 2025</small></td>
                <td>
                  <div class="action-buttons">
                    <button class="btn-action btn-edit" title="Editar"><i class="fas fa-edit"></i></button>
                    <button class="btn-action btn-delete" title="Eliminar"><i class="fas fa-trash"></i></button>
                  </div>
                </td>
              </tr>

              <tr class="user-row" data-user-id="3" data-status="inactivo">
                <td>
                  <div class="user-cell">
                    <img src="https://ui-avatars.com/api/?name=Carlos+Lopez&background=f59e0b&color=fff" alt="Usuario" class="user-avatar">
                    <div class="user-info">
                      <div class="user-name">Carlos López</div>
                      <small class="text-muted">ID: #003</small>
                    </div>
                  </div>
                </td>
                <td>carlos.lopez@empresa.com</td>
                <td>
                  <span class="badge bg-warning">Almacén</span>
                </td>
                <td>
                  <span class="status-badge status-inactivo">
                    <i class="fas fa-times-circle"></i> Inactivo
                  </span>
                </td>
                <td><small class="text-muted">01 Feb 2025</small></td>
                <td>
                  <div class="action-buttons">
                    <button class="btn-action btn-edit" title="Editar"><i class="fas fa-edit"></i></button>
                    <button class="btn-action btn-delete" title="Eliminar"><i class="fas fa-trash"></i></button>
                  </div>
                </td>
              </tr>

              <tr class="user-row" data-user-id="4" data-status="activo">
                <td>
                  <div class="user-cell">
                    <img src="https://ui-avatars.com/api/?name=Ana+Martinez&background=8b5cf6&color=fff" alt="Usuario" class="user-avatar">
                    <div class="user-info">
                      <div class="user-name">Ana Martínez</div>
                      <small class="text-muted">ID: #004</small>
                    </div>
                  </div>
                </td>
                <td>ana.martinez@empresa.com</td>
                <td>
                  <span class="badge bg-info">Finanzas</span>
                </td>
                <td>
                  <span class="status-badge status-activo">
                    <i class="fas fa-check-circle"></i> Activo
                  </span>
                </td>
                <td><small class="text-muted">10 Feb 2025</small></td>
                <td>
                  <div class="action-buttons">
                    <button class="btn-action btn-edit" title="Editar"><i class="fas fa-edit"></i></button>
                    <button class="btn-action btn-delete" title="Eliminar"><i class="fas fa-trash"></i></button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Modal: Add User -->
      <div class="modal fade" id="addUserModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Nuevo Usuario</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form class="needs-validation" id="addUserForm" novalidate>
                <!-- Nombre del Usuario -->
                <div class="mb-3">
                  <label class="form-label">Nombre Completo <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="nombre" placeholder="Ej: Juan Pérez" required>
                  <div class="invalid-feedback">El nombre es requerido</div>
                </div>

                <!-- Email -->
                <div class="mb-3">
                  <label class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
                  <input type="email" class="form-control" name="email" placeholder="usuario@empresa.com" required>
                  <div class="invalid-feedback">Ingresa un email válido</div>
                </div>

                <!-- Rol -->
                <div class="mb-3">
                  <label class="form-label">Rol <span class="text-danger">*</span></label>
                  <select class="form-select" name="rol" required>
                    <option value="">Selecciona un rol</option>
                    <option value="admin">Administrador</option>
                    <option value="finanzas">Finanzas</option>
                    <option value="almacen">Almacén</option>
                    <option value="vendedor">Vendedor</option>
                  </select>
                  <div class="invalid-feedback">Selecciona un rol</div>
                </div>

                <!-- Estado -->
                <div class="mb-3">
                  <label class="form-label">Estado</label>
                  <select class="form-select" name="activo">
                    <option value="1" selected>Activo</option>
                    <option value="0">Inactivo</option>
                  </select>
                </div>

                <!-- Info -->
                <div class="alert alert-info" role="alert">
                  <i class="fas fa-info-circle me-2"></i>
                  <strong>Nota:</strong> Se enviará un email de bienvenida con las instrucciones de acceso al nuevo usuario
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" id="saveUserBtn">
                <i class="fas fa-save me-2"></i>Crear Usuario
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
  <script src="./recursos/js/usuarios.js"></script>
</body>
</html>
