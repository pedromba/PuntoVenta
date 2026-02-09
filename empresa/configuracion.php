<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Configuración - TechStore</title>
  
  <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./recursos/css/empresa-styles.css">
  <link rel="stylesheet" href="./recursos/css/sidebar.css">
  <link rel="stylesheet" href="./recursos/css/formularios.css">
  <style>
    /* Variables */
    :root {
      --primary-color: #2563eb;
      --primary-light: #f0f7ff;
      --border-color: #e5e7eb;
      --text-primary: #1f2937;
      --text-muted: #6b7280;
      --bg-light: #f9fafb;
      --success: #10b981;
      --warning: #f59e0b;
      --danger: #ef4444;
      --info: #3b82f6;
    }

    /* Settings Container */
    .settings-container {
      display: flex;
      flex-direction: column;
      gap: 20px;
      margin: 20px;
      margin-top: 20px;
    }

    /* Tabs Navigation */
    .settings-tabs {
      display: flex;
      gap: 0;
      border-bottom: 2px solid var(--border-color);
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
      background: white;
      padding: 0 20px;
      margin: 0 20px;
      border-radius: 12px 12px 0 0;
      margin-bottom: -1px;
    }

    .settings-tabs::-webkit-scrollbar {
      height: 4px;
    }

    .settings-tabs::-webkit-scrollbar-thumb {
      background: var(--border-color);
      border-radius: 2px;
    }

    .settings-tab {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 16px 16px;
      background: none;
      border: none;
      cursor: pointer;
      color: var(--text-muted);
      font-size: 14px;
      font-weight: 500;
      white-space: nowrap;
      transition: all 0.3s ease;
      border-bottom: 3px solid transparent;
      margin-bottom: -2px;
      position: relative;
    }

    .settings-tab:hover {
      color: var(--primary-color);
      background: var(--primary-light);
    }

    .settings-tab.active {
      color: var(--primary-color);
      border-bottom-color: var(--primary-color);
      background: none;
    }

    .settings-tab i {
      font-size: 16px;
    }

    /* Settings Content */
    .settings-content {
      min-height: 400px;
      background: white;
      padding: 30px;
      margin: 0 20px 20px 20px;
      border-radius: 0 0 12px 12px;
      border: 1px solid var(--border-color);
      border-top: none;
      box-shadow: var(--box-shadow);
    }

    .settings-section {
      display: none;
      animation: fadeIn 0.3s ease-in;
    }

    .settings-section.active {
      display: block;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Section Header */
    .section-header {
      margin-bottom: 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
      padding-bottom: 20px;
      border-bottom: 1px solid var(--border-color);
    }

    .section-header h4 {
      font-size: 20px;
      font-weight: 600;
      color: var(--text-primary);
      margin: 0;
    }

    .section-subtitle {
      color: var(--text-muted);
      font-size: 14px;
      margin-top: 4px;
    }

    /* Form Groups */
    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      color: var(--text-primary);
      font-weight: 500;
      margin-bottom: 8px;
      font-size: 14px;
    }

    .form-control {
      border: 1px solid var(--border-color);
      border-radius: 6px;
      padding: 10px 12px;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    /* Cards Layout */
    .settings-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
      margin-bottom: 30px;
      margin-top: 20px;
    }

    .settings-card {
      border: 1px solid var(--border-color);
      border-radius: 8px;
      padding: 20px;
      background: white;
      transition: all 0.3s ease;
    }

    .settings-card:hover {
      border-color: var(--primary-color);
      box-shadow: 0 4px 12px rgba(37, 99, 235, 0.08);
    }

    .settings-card h5 {
      font-size: 16px;
      font-weight: 600;
      color: var(--text-primary);
      margin-bottom: 8px;
    }

    .settings-card p {
      color: var(--text-muted);
      font-size: 13px;
      margin-bottom: 16px;
    }

    /* List Items */
    .settings-list {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .settings-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 16px;
      border: 1px solid var(--border-color);
      border-radius: 6px;
      transition: all 0.3s ease;
    }

    .settings-item:hover {
      background: var(--bg-light);
      border-color: var(--primary-color);
    }

    .settings-item-info h6 {
      font-size: 14px;
      font-weight: 600;
      color: var(--text-primary);
      margin: 0 0 4px 0;
    }

    .settings-item-info p {
      color: var(--text-muted);
      font-size: 13px;
      margin: 0;
    }

    .settings-item-actions {
      display: flex;
      gap: 8px;
    }

    /* Buttons */
    .btn {
      border-radius: 6px;
      font-weight: 500;
      font-size: 14px;
      padding: 8px 16px;
      transition: all 0.3s ease;
    }

    .btn-primary {
      background: var(--primary-color);
      border: none;
      color: white;
    }

    .btn-primary:hover {
      background: #1d4ed8;
      color: white;
    }

    .btn-outline-primary {
      border: 1px solid var(--primary-color);
      color: var(--primary-color);
      background: white;
    }

    .btn-outline-primary:hover {
      background: var(--primary-light);
    }

    .btn-sm {
      padding: 6px 12px;
      font-size: 12px;
    }

    /* Status Badges */
    .status-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
    }

    .status-active {
      background: rgba(16, 185, 129, 0.1);
      color: var(--success);
    }

    .status-inactive {
      background: rgba(107, 114, 128, 0.1);
      color: var(--text-muted);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .settings-tabs {
        flex-wrap: wrap;
        padding: 0;
        margin: 0;
      }

      .settings-tab {
        padding: 12px 12px;
        font-size: 12px;
        flex: 1;
      }

      .settings-content {
        padding: 20px;
        margin: 0;
      }

      .section-header {
        flex-direction: column;
        align-items: flex-start;
      }

      .settings-cards {
        grid-template-columns: 1fr;
      }

      .settings-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
      }

      .settings-item-actions {
        width: 100%;
      }

      .settings-item-actions button {
        flex: 1;
      }
    }
  </style>
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
            <input type="text" placeholder="Buscar en configuración..." id="searchSettings">
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
          <h1><i class="fas fa-cog"></i> Configuración</h1>
          <p class="text-muted">Administra los parámetros de tu empresa</p>
        </div>
      </div>

      <!-- Settings Container -->
      <div class="settings-container">
        <!-- Tabs Navigation -->
        <div class="settings-tabs">
          <button class="settings-tab active" data-section="general">
            <i class="fas fa-building"></i> General
          </button>
          <button class="settings-tab" data-section="usuarios">
            <i class="fas fa-users"></i> Usuarios
          </button>
          <button class="settings-tab" data-section="impuestos">
            <i class="fas fa-percentage"></i> Impuestos
          </button>
          <button class="settings-tab" data-section="pago">
            <i class="fas fa-credit-card"></i> Métodos Pago
          </button>
          <button class="settings-tab" data-section="fiscal">
            <i class="fas fa-receipt"></i> Datos Fiscales
          </button>
          <button class="settings-tab" data-section="seguridad">
            <i class="fas fa-lock"></i> Seguridad
          </button>
        </div>

        <!-- Settings Content -->
        <div class="settings-content">
          <!-- General Settings -->
          <section class="settings-section active" id="general">
            <div class="section-header">
              <div>
                <h4>Información General</h4>
                <p class="section-subtitle">Datos básicos de tu empresa</p>
              </div>
              <button class="btn btn-primary"><i class="fas fa-save"></i> Guardar Cambios</button>
            </div>

            <form>
              <div class="row g-4">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nombre de la Empresa</label>
                    <input type="text" class="form-control" value="TechStore" placeholder="Nombre legal">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nombre Comercial</label>
                    <input type="text" class="form-control" value="TechStore Electronics" placeholder="Nombre comercial">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email Principal</label>
                    <input type="email" class="form-control" value="info@techstore.com">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Teléfono</label>
                    <input type="tel" class="form-control" value="+34 912-345-678">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Dirección</label>
                    <input type="text" class="form-control" value="Calle Principal 123, 28001 Madrid" placeholder="Dirección completa">
                  </div>
                </div>
              </div>
            </form>
          </section>

          <!-- Users Settings -->
          <section class="settings-section" id="usuarios">
            <div class="section-header">
              <div>
                <h4>Gestión de Usuarios</h4>
                <p class="section-subtitle">Administra los usuarios de tu empresa</p>
              </div>
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="fas fa-user-plus"></i> Nuevo Usuario
              </button>
            </div>

            <div class="settings-list">
              <div class="settings-item">
                <div class="settings-item-info">
                  <h6>Juan Pérez</h6>
                  <p>juan@techstore.com • <span class="badge bg-danger">Administrador</span></p>
                </div>
                <div class="settings-item-actions">
                  <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                  <button class="btn btn-sm btn-outline-primary"><i class="fas fa-trash"></i></button>
                </div>
              </div>

              <div class="settings-item">
                <div class="settings-item-info">
                  <h6>María García</h6>
                  <p>maria@techstore.com • <span class="badge bg-warning">Vendedor</span></p>
                </div>
                <div class="settings-item-actions">
                  <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                  <button class="btn btn-sm btn-outline-primary"><i class="fas fa-trash"></i></button>
                </div>
              </div>

              <div class="settings-item">
                <div class="settings-item-info">
                  <h6>Carlos López</h6>
                  <p>carlos@techstore.com • <span class="badge bg-info">Almacén</span></p>
                </div>
                <div class="settings-item-actions">
                  <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                  <button class="btn btn-sm btn-outline-primary"><i class="fas fa-trash"></i></button>
                </div>
              </div>
            </div>
          </section>

          <!-- Taxes Settings -->
          <section class="settings-section" id="impuestos">
            <div class="section-header">
              <div>
                <h4>Configuración de Impuestos</h4>
                <p class="section-subtitle">Define los impuestos de tus productos</p>
              </div>
              <button class="btn btn-primary"><i class="fas fa-plus"></i> Agregar Impuesto</button>
            </div>

            <div class="settings-cards">
              <div class="settings-card">
                <h5><i class="fas fa-percent"></i> IVA Estándar</h5>
                <p>Aplicable a la mayoría de productos</p>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                  <span style="font-size: 28px; font-weight: 700; color: var(--primary-color);">21%</span>
                  <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                </div>
              </div>

              <div class="settings-card">
                <h5><i class="fas fa-percent"></i> IVA Reducido</h5>
                <p>Productos de primera necesidad</p>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                  <span style="font-size: 28px; font-weight: 700; color: var(--primary-color);">10%</span>
                  <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                </div>
              </div>

              <div class="settings-card">
                <h5><i class="fas fa-percent"></i> IVA Superreducido</h5>
                <p>Alimentos básicos</p>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                  <span style="font-size: 28px; font-weight: 700; color: var(--primary-color);">4%</span>
                  <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                </div>
              </div>
            </div>
          </section>

          <!-- Payment Methods -->
          <section class="settings-section" id="pago">
            <div class="section-header">
              <div>
                <h4>Métodos de Pago</h4>
                <p class="section-subtitle">Configura las formas de pago disponibles</p>
              </div>
            </div>

            <div class="settings-list">
              <div class="settings-item">
                <div class="settings-item-info">
                  <h6><i class="fas fa-credit-card"></i> Tarjeta de Crédito/Débito</h6>
                  <p>Visa, Mastercard, American Express</p>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" checked>
                </div>
              </div>

              <div class="settings-item">
                <div class="settings-item-info">
                  <h6><i class="fas fa-money-bill"></i> Efectivo</h6>
                  <p>Pago en efectivo en tienda</p>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" checked>
                </div>
              </div>

              <div class="settings-item">
                <div class="settings-item-info">
                  <h6><i class="fas fa-bank"></i> Transferencia Bancaria</h6>
                  <p>Depósito directo a cuenta bancaria</p>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" checked>
                </div>
              </div>

              <div class="settings-item">
                <div class="settings-item-info">
                  <h6><i class="fas fa-paypal"></i> PayPal</h6>
                  <p>Pago con PayPal</p>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox">
                </div>
              </div>
            </div>
          </section>

          <!-- Fiscal Data -->
          <section class="settings-section" id="fiscal">
            <div class="section-header">
              <div>
                <h4>Datos Fiscales</h4>
                <p class="section-subtitle">Información fiscal de tu empresa</p>
              </div>
              <button class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
            </div>

            <form>
              <div class="row g-4">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>NIF/CIF</label>
                    <input type="text" class="form-control" value="B12345678" placeholder="NIF/CIF">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Régimen IVA</label>
                    <select class="form-control">
                      <option>Normal</option>
                      <option>Simplificado</option>
                      <option>Recargo Equivalencia</option>
                    </select>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Cuenta Bancaria</label>
                    <input type="text" class="form-control" placeholder="ES91 2100 0418 45023847">
                  </div>
                </div>
              </div>
            </form>
          </section>

          <!-- Security -->
          <section class="settings-section" id="seguridad">
            <div class="section-header">
              <div>
                <h4>Seguridad</h4>
                <p class="section-subtitle">Opciones de seguridad y privacidad</p>
              </div>
            </div>

            <div class="row g-4">
              <div class="col-md-6">
                <div class="settings-card">
                  <h5><i class="fas fa-lock"></i> Autenticación</h5>
                  <p>Dos factores (2FA)</p>
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="twoFa" checked>
                    <label class="form-check-label">Activado</label>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="settings-card">
                  <h5><i class="fas fa-key"></i> Cambiar Contraseña</h5>
                  <p>Actualiza tu contraseña</p>
                  <button class="btn btn-sm btn-outline-primary">Cambiar</button>
                </div>
              </div>
            </div>

            <div class="settings-card" style="margin-top: 20px;">
              <h5><i class="fas fa-globe"></i> Sesiones Activas</h5>
              <p style="margin-bottom: 20px;">Gestiona tus sesiones abiertas</p>
              <div class="settings-list">
                <div class="settings-item">
                  <div class="settings-item-info">
                    <h6>Chrome - Windows</h6>
                    <p>IP: 192.168.1.100 • Última actividad: Hace 5 minutos</p>
                  </div>
                  <button class="btn btn-sm btn-outline-primary">Cerrar</button>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>

      <!-- Modal: Add User -->
      <div class="modal fade" id="addUserModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Nuevo Usuario</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form>
                <div class="mb-3">
                  <label>Nombre Completo</label>
                  <input type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label>Email</label>
                  <input type="email" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label>Rol</label>
                  <select class="form-select" required>
                    <option>Seleccionar rol</option>
                    <option>Administrador</option>
                    <option>Vendedor</option>
                    <option>Almacén</option>
                    <option>Contable</option>
                  </select>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary">Crear Usuario</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="page-footer">
        <p>&copy; 2026 PuntoVenta - Sistema de Gestión</p>
      </footer>
    </div>
  </div>

  <script src="../recursos/js/bootstrap.bundle.min.js"></script>
  <script src="./recursos/js/empresa.js"></script>
  <script>
    // Settings Tabs
    document.querySelectorAll('.settings-tab').forEach(tab => {
      tab.addEventListener('click', function() {
        const sectionId = this.getAttribute('data-section');
        
        // Remove active from all tabs
        document.querySelectorAll('.settings-tab').forEach(t => t.classList.remove('active'));
        // Add active to clicked tab
        this.classList.add('active');
        
        // Hide all sections
        document.querySelectorAll('.settings-section').forEach(s => s.classList.remove('active'));
        // Show selected section
        document.getElementById(sectionId).classList.add('active');
      });
    });
  </script>
</body>
</html>
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
            <input type="text" placeholder="Buscar configuración..." id="searchSettings">
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
          <h1>Configuración</h1>
          <p class="text-muted">Administra los parámetros de tu empresa</p>
        </div>
      </div>

      <!-- Settings Tabs -->
      <div class="settings-container">
        <div class="settings-sidebar">
          <nav class="settings-nav">
            <button class="nav-item active" data-section="general">
              <i class="fas fa-building"></i> Información General
            </button>
            <button class="nav-item" data-section="fiscal">
              <i class="fas fa-receipt"></i> Datos Fiscales
            </button>
            <button class="nav-item" data-section="usuarios">
              <i class="fas fa-users"></i> Usuarios
            </button>
            <button class="nav-item" data-section="impuestos">
              <i class="fas fa-percentage"></i> Impuestos
            </button>
            <button class="nav-item" data-section="pago">
              <i class="fas fa-credit-card"></i> Métodos de Pago
            </button>
            <button class="nav-item" data-section="seguridad">
              <i class="fas fa-lock"></i> Seguridad
            </button>
          </nav>
        </div>

        <div class="settings-content">
          <!-- Section: General Information -->
          <section class="settings-section active" id="general">
            <div class="section-header">
              <h4>Información General</h4>
              <p class="text-muted">Datos básicos de tu empresa</p>
            </div>

            <form>
              <div class="row mb-4">
                <div class="col-md-6">
                  <label>Nombre de la Empresa</label>
                  <input type="text" class="form-control" value="TechStore" placeholder="Nombre legal">
                </div>
                <div class="col-md-6">
                  <label>Nombre Comercial</label>
                  <input type="text" class="form-control" value="TechStore Electronics" placeholder="Nombres comercial">
                </div>
              </div>

              <div class="row mb-4">
                <div class="col-md-6">
                  <label>Email Principal</label>
                  <input type="email" class="form-control" value="info@techstore.com">
                </div>
                <div class="col-md-6">
                  <label>Teléfono</label>
                  <input type="tel" class="form-control" value="+34 912-345-678">
                </div>
              </div>

              <div class="mb-4">
                <label>Dirección</label>
                <input type="text" class="form-control" value="Calle Principal 123, Madrid" placeholder="Dirección completa">
              </div>

              <div class="row mb-4">
                <div class="col-md-3">
                  <label>Código Postal</label>
                  <input type="text" class="form-control" value="28001">
                </div>
                <div class="col-md-3">
                  <label>Ciudad</label>
                  <input type="text" class="form-control" value="Madrid">
                </div>
                <div class="col-md-3">
                  <label>Provincia</label>
                  <input type="text" class="form-control" value="Madrid">
                </div>
                <div class="col-md-3">
                  <label>País</label>
                  <input type="text" class="form-control" value="España">
                </div>
              </div>

              <div class="row mb-4">
                <div class="col-md-6">
                  <label>Sitio Web</label>
                  <input type="url" class="form-control" value="https://www.techstore.com">
                </div>
                <div class="col-md-6">
                  <label>Redes Sociales</label>
                  <input type="text" class="form-control" placeholder="@techstore_oficial">
                </div>
              </div>

              <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar Cambios</button>
            </form>
          </section>

          <!-- Section: Tax Data -->
          <section class="settings-section" id="fiscal">
            <div class="section-header">
              <h4>Datos Fiscales</h4>
              <p class="text-muted">Información tributaria de la empresa</p>
            </div>

            <form>
              <div class="row mb-4">
                <div class="col-md-6">
                  <label>NIF/CIF</label>
                  <input type="text" class="form-control" value="A12345678" placeholder="Número de identificación fiscal">
                </div>
                <div class="col-md-6">
                  <label>Régimen Fiscal</label>
                  <select class="form-select">
                    <option>Régimen General</option>
                    <option selected>IVA Estándar</option>
                    <option>Simplificado</option>
                    <option>Especial</option>
                  </select>
                </div>
              </div>

              <div class="row mb-4">
                <div class="col-md-6">
                  <label>Tipo IVA Estándar</label>
                  <input type="number" class="form-control" value="21" min="0" max="100" step="0.01">
                  <small>%</small>
                </div>
                <div class="col-md-6">
                  <label>Número de Empleados</label>
                  <input type="number" class="form-control" value="15" min="0">
                </div>
              </div>

              <div class="mb-4">
                <label>Descripción de Actividad</label>
                <textarea class="form-control" rows="3">Venta de productos electrónicos y tecnología en general. Servicios de consultoría en tecnología.</textarea>
              </div>

              <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar Cambios</button>
            </form>
          </section>

          <!-- Section: Users -->
          <section class="settings-section" id="usuarios">
            <div class="section-header">
              <h4>Gestión de Usuarios</h4>
              <p class="text-muted">Administra los usuarios de tu empresa</p>
            </div>

            <div class="users-header mb-4">
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="fas fa-user-plus"></i> Nuevo Usuario
              </button>
            </div>

            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><strong>Juan Pérez</strong></td>
                    <td>juan@techstore.com</td>
                    <td><span class="badge bg-danger">Administrador</span></td>
                    <td><span class="status-badge status-optimo">Activo</span></td>
                    <td>
                      <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                      <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                    </td>
                  </tr>
                  <tr>
                    <td><strong>María García</strong></td>
                    <td>maria@techstore.com</td>
                    <td><span class="badge bg-warning">Vendedor</span></td>
                    <td><span class="status-badge status-optimo">Activo</span></td>
                    <td>
                      <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                      <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                    </td>
                  </tr>
                  <tr>
                    <td><strong>Carlos López</strong></td>
                    <td>carlos@techstore.com</td>
                    <td><span class="badge bg-info">Almacén</span></td>
                    <td><span class="status-badge status-optimo">Activo</span></td>
                    <td>
                      <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
                      <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </section>

          <!-- Section: Taxes -->
          <section class="settings-section" id="impuestos">
            <div class="section-header">
              <h4>Configuración de Impuestos</h4>
              <p class="text-muted">Define los impuestos aplicables a tus productos</p>
            </div>

            <div class="taxes-list">
              <div class="tax-item">
                <div class="tax-info">
                  <h6>IVA Estándar</h6>
                  <p class="text-muted">Aplicable a la mayoría de productos</p>
                </div>
                <div class="tax-percentage">21%</div>
                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
              </div>

              <div class="tax-item">
                <div class="tax-info">
                  <h6>IVA Reducido</h6>
                  <p class="text-muted">Productos de primera necesidad</p>
                </div>
                <div class="tax-percentage">10%</div>
                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
              </div>

              <div class="tax-item">
                <div class="tax-info">
                  <h6>IVA Superreducido</h6>
                  <p class="text-muted">Alimentos básicos</p>
                </div>
                <div class="tax-percentage">4%</div>
                <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></button>
              </div>
            </div>

            <button class="btn btn-outline-primary mt-4"><i class="fas fa-plus"></i> Agregar Impuesto</button>
          </section>

          <!-- Section: Payment Methods -->
          <section class="settings-section" id="pago">
            <div class="section-header">
              <h4>Métodos de Pago</h4>
              <p class="text-muted">Configura los métodos de pago disponibles</p>
            </div>

            <div class="payment-methods">
              <div class="payment-item">
                <div class="payment-info">
                  <h6><i class="fas fa-credit-card"></i> Tarjeta de Débito/Crédito</h6>
                  <p class="text-muted">Visa, Mastercard, American Express</p>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" checked>
                </div>
              </div>

              <div class="payment-item">
                <div class="payment-info">
                  <h6><i class="fas fa-money-bill"></i> Efectivo</h6>
                  <p class="text-muted">Pago en efectivo en tienda</p>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" checked>
                </div>
              </div>

              <div class="payment-item">
                <div class="payment-info">
                  <h6><i class="fas fa-link"></i> Transferencia Bancaria</h6>
                  <p class="text-muted">Depósito directo a cuenta bancaria</p>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" checked>
                </div>
              </div>

              <div class="payment-item">
                <div class="payment-info">
                  <h6><i class="fas fa-mobile-alt"></i> PayPal</h6>
                  <p class="text-muted">Pago con PayPal</p>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox">
                </div>
              </div>
            </div>
          </section>

          <!-- Section: Security -->
          <section class="settings-section" id="seguridad">
            <div class="section-header">
              <h4>Seguridad</h4>
              <p class="text-muted">Opciones de seguridad y privacidad</p>
            </div>

            <form>
              <div class="security-group">
                <h6>Autenticación</h6>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="securityTwo" checked>
                  <label class="form-check-label">Autenticación de dos factores (2FA)</label>
                  <small class="d-block text-muted">Requiere código adicional al iniciar sesión</small>
                </div>
              </div>

              <div class="security-group">
                <h6>Contraseña</h6>
                <div class="form-group mb-3">
                  <label>Cambiar Contraseña</label>
                  <input type="password" class="form-control" placeholder="Contraseña actual">
                </div>
                <div class="form-group mb-3">
                  <input type="password" class="form-control" placeholder="Nueva contraseña">
                </div>
                <div class="form-group mb-3">
                  <input type="password" class="form-control" placeholder="Confirmar contraseña">
                </div>
                <button type="button" class="btn btn-primary">Actualizar Contraseña</button>
              </div>

              <div class="security-group">
                <h6>Sesiones Activas</h6>
                <div class="session-item">
                  <div>
                    <p><strong>Navegador Chrome</strong> - Windows</p>
                    <small class="text-muted">IP: 192.168.1.100 • Última actividad: Hace 5 minutos</small>
                  </div>
                  <button class="btn btn-sm btn-outline-danger">Cerrar</button>
                </div>
                <button class="btn btn-outline-secondary mt-3">Cerrar Todas las Sesiones</button>
              </div>
            </form>
          </section>
        </div>
      </div>

      <!-- Modal: Add User -->
      <div class="modal fade" id="addUserModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Nuevo Usuario</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form>
                <div class="mb-3">
                  <label>Nombre Completo</label>
                  <input type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label>Email</label>
                  <input type="email" class="form-control" required>
                </div>
                <div class="mb-3">
                  <label>Rol</label>
                  <select class="form-select" required>
                    <option>Seleccionar rol</option>
                    <option>Administrador</option>
                    <option>Vendedor</option>
                    <option>Almacén</option>
                    <option>Contable</option>
                  </select>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary">Crear Usuario</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="6age-footer">
        <p>&copy; 2024 Sistema de Gestión - TechStore</p>
      </footer>
    </div>
  </div>

  <script src="../recursos/js/bootstrap.bundle.min.js"></script>
  <script src="./recursos/js/empresa.js"></script>
  <script src="./recursos/js/configuracion.js"></script>
</body>
</html>
