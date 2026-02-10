<?php 
// Inicializar sesión y verificar slug
include './init.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - <?php echo htmlspecialchars($empresa_nombre); ?></title>
  <meta name="empresa-slug" content="<?php echo htmlspecialchars($empresa_slug); ?>"
  
  <!-- Bootstrap CSS -->
  <link href="/PuntoVenta/recursos/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="./recursos/css/empresa-styles.css">
  <link rel="stylesheet" href="./recursos/css/sidebar.css">
  <link rel="stylesheet" href="./recursos/css/formularios.css">
  <link rel="stylesheet" href="./recursos/css/dashboard.css">
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
            <input type="text" placeholder="Buscar...">
          </div>
        </div>

        <div class="topbar-right">
          <div class="notification-icon">
            <i class="fas fa-bell"></i>
            <span class="notification-badge">3</span>
          </div>
          <div class="user-menu">
            <img src="https://via.placeholder.com/40" alt="Usuario" class="user-avatar">
            <span class="user-name"><?php echo htmlspecialchars($usuario_nombre); ?></span>
            <i class="fas fa-chevron-down"></i>
            <div class="user-dropdown" style="display: none; position: absolute; top: 100%; right: 0; background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); z-index: 1000; min-width: 200px;">
              <a href="<?php echo urlEmpresa('configuracion'); ?>" style="display: block; padding: 12px 16px; color: #333; text-decoration: none; border-bottom: 1px solid #eee;">
                <i class="fas fa-cog"></i> Configuración
              </a>
              <a href="<?php echo urlEmpresa('perfil'); ?>" style="display: block; padding: 12px 16px; color: #333; text-decoration: none; border-bottom: 1px solid #eee;">
                <i class="fas fa-user"></i> Mi Perfil
              </a>
              <a href="javascript:logout();" style="display: block; padding: 12px 16px; color: #dc3545; text-decoration: none;">
                <i class="fas fa-sign-out-alt"></i> Cerrar sesión
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Page Header -->
      <div class="page-header">
        <div class="header-content">
          <h1>Dashboard - <?php echo htmlspecialchars($empresa_nombre); ?></h1>
          <p class="text-muted">Bienvenido <?php echo htmlspecialchars($usuario_nombre); ?></p>
        </div>
        <div class="header-buttons">
          <button class="btn btn-outline-secondary" data-bs-toggle="tooltip" title="Descargar reporte">
            <i class="fas fa-download"></i> Descargar
          </button>
          <button class="btn btn-primary">
            <i class="fas fa-calendar"></i> Hoy
          </button>
        </div>
      </div>

      <!-- KPI Cards Section -->
      <div class="kpi-section">
        <div class="kpi-card">
          <div class="kpi-header">
            <h3 class="kpi-title">Ventas Hoy</h3>
            <div class="kpi-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
              <i class="fas fa-shopping-cart"></i>
            </div>
          </div>
          <div class="kpi-body">
            <div class="kpi-value">$2,847.50</div>
            <div class="kpi-change positive">
              <i class="fas fa-arrow-up"></i> 12.5% vs ayer
            </div>
          </div>
        </div>

        <div class="kpi-card">
          <div class="kpi-header">
            <h3 class="kpi-title">Productos</h3>
            <div class="kpi-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
              <i class="fas fa-box"></i>
            </div>
          </div>
          <div class="kpi-body">
            <div class="kpi-value">145</div>
            <div class="kpi-change">
              <i class="fas fa-info-circle"></i> 12 sin stock
            </div>
          </div>
        </div>

        <div class="kpi-card">
          <div class="kpi-header">
            <h3 class="kpi-title">Clientes</h3>
            <div class="kpi-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
              <i class="fas fa-users"></i>
            </div>
          </div>
          <div class="kpi-body">
            <div class="kpi-value">89</div>
            <div class="kpi-change positive">
              <i class="fas fa-arrow-up"></i> 5 nuevos hoje
            </div>
          </div>
        </div>

        <div class="kpi-card">
          <div class="kpi-header">
            <h3 class="kpi-title">Ingresos Mes</h3>
            <div class="kpi-icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
              <i class="fas fa-dollar-sign"></i>
            </div>
          </div>
          <div class="kpi-body">
            <div class="kpi-value">$156,320</div>
            <div class="kpi-change positive">
              <i class="fas fa-arrow-up"></i> 23.8% vs mes pasado
            </div>
          </div>
        </div>
      </div>

      <!-- Charts Section -->
      <div class="charts-section">
        <div class="chart-card">
          <div class="card-header">
            <h5>Ventas Últimos 7 Días</h5>
            <div class="chart-actions">
              <button class="btn-chart-action">
                <i class="fas fa-ellipsis-h"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart-placeholder">
              <div class="chart-bars">
                <div class="bar" style="height: 40%;" title="Lunes: $1,200"></div>
                <div class="bar" style="height: 65%;" title="Martes: $2,050"></div>
                <div class="bar" style="height: 75%;" title="Miércoles: $2,350"></div>
                <div class="bar" style="height: 55%;" title="Jueves: $1,750"></div>
                <div class="bar" style="height: 70%;" title="Viernes: $2,200"></div>
                <div class="bar" style="height: 85%;" title="Sábado: $2,650"></div>
                <div class="bar" style="height: 45%;" title="Domingo: $1,400"></div>
              </div>
              <div class="chart-labels">
                <span>Lun</span><span>Mar</span><span>Mié</span><span>Jue</span><span>Vie</span><span>Sáb</span><span>Dom</span>
              </div>
            </div>
          </div>
        </div>

        <div class="chart-card">
          <div class="card-header">
            <h5>Categorías Más Vendidas</h5>
            <div class="chart-actions">
              <button class="btn-chart-action">
                <i class="fas fa-ellipsis-h"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="category-list">
              <div class="category-item">
                <div class="category-info">
                  <span class="category-name">Laptops</span>
                  <span class="category-value">$45,230</span>
                </div>
                <div class="progress-bar">
                  <div class="progress-fill" style="width: 100%; background: #667eea;"></div>
                </div>
              </div>

              <div class="category-item">
                <div class="category-info">
                  <span class="category-name">Móviles</span>
                  <span class="category-value">$38,450</span>
                </div>
                <div class="progress-bar">
                  <div class="progress-fill" style="width: 85%; background: #f093fb;"></div>
                </div>
              </div>

              <div class="category-item">
                <div class="category-info">
                  <span class="category-name">Accesorios</span>
                  <span class="category-value">$28,900</span>
                </div>
                <div class="progress-bar">
                  <div class="progress-fill" style="width: 64%; background: #4facfe;"></div>
                </div>
              </div>

              <div class="category-item">
                <div class="category-info">
                  <span class="category-name">Tablets</span>
                  <span class="category-value">$22,100</span>
                </div>
                <div class="progress-bar">
                  <div class="progress-fill" style="width: 49%; background: #43e97b;"></div>
                </div>
              </div>

              <div class="category-item">
                <div class="category-info">
                  <span class="category-name">Otros</span>
                  <span class="category-value">$21,640</span>
                </div>
                <div class="progress-bar">
                  <div class="progress-fill" style="width: 48%; background: #fa709a;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Activity Section -->
      <div class="activity-section">
        <div class="activity-card">
          <div class="card-header">
            <h5>Actividad Reciente</h5>
            <a href="<?php echo urlEmpresa('ventas'); ?>" class="link-primary">Ver todo</a>
          </div>
          <div class="card-body">
            <div class="activity-list">
              <div class="activity-item">
                <div class="activity-icon" style="background: #e7f5ff;">
                  <i class="fas fa-shopping-bag" style="color: #0066cc;"></i>
                </div>
                <div class="activity-content">
                  <div class="activity-title">Nueva venta registrada</div>
                  <div class="activity-description">Orden #V-2024-001456 - $1,245.50</div>
                  <div class="activity-time">Hace 2 horas</div>
                </div>
              </div>

              <div class="activity-item">
                <div class="activity-icon" style="background: #fff3e0;">
                  <i class="fas fa-user-plus" style="color: #ff6600;"></i>
                </div>
                <div class="activity-content">
                  <div class="activity-title">Nuevo cliente agregado</div>
                  <div class="activity-description">Fernando López - Empresa xyz</div>
                  <div class="activity-time">Hace 4 horas</div>
                </div>
              </div>

              <div class="activity-item">
                <div class="activity-icon" style="background: #f3e5f5;">
                  <i class="fas fa-package" style="color: #9c27b0;"></i>
                </div>
                <div class="activity-content">
                  <div class="activity-title">Stock bajo en producto</div>
                  <div class="activity-description">Laptop DELL XPS 13 - Solo 2 unidades</div>
                  <div class="activity-time">Hace 6 horas</div>
                </div>
              </div>

              <div class="activity-item">
                <div class="activity-icon" style="background: #e8f5e9;">
                  <i class="fas fa-check-circle" style="color: #4caf50;"></i>
                </div>
                <div class="activity-content">
                  <div class="activity-title">Pedido completado</div>
                  <div class="activity-description">Orden #V-2024-001455 entregada a Cliente Demo</div>
                  <div class="activity-time">Hace 8 horas</div>
                </div>
              </div>
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
  
  <script>
    /**
     * Manejo del menú de usuario
     */
    document.querySelector('.user-menu').addEventListener('click', function(e) {
      const dropdown = this.querySelector('.user-dropdown');
      if (dropdown) {
        dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        e.stopPropagation();
      }
    });
    
    // Cerrar menú al hacer click en otra parte
    document.addEventListener('click', function() {
      const dropdown = document.querySelector('.user-dropdown');
      if (dropdown) {
        dropdown.style.display = 'none';
      }
    });
    
    /**
     * Función logout
     */
    function logout() {
      if (confirm('¿Deseas cerrar sesión exitosamente?')) {
        // Hacer request POST a logout
        fetch('/PuntoVenta/config/process_logout.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          }
        }).then(response => {
          if (response.ok) {
            window.location.href = '/PuntoVenta/index.php?logout=success';
          }
        }).catch(error => {
          console.error('Error:', error);
          window.location.href = '/PuntoVenta/index.php';
        });
      }
    }
  </script>
</body>
</html>
