<!-- Empresa Sidebar Navigation -->
<aside class="sidebar sidebar-empresa" role="navigation" aria-label="Navegación principal">
  <!-- Header con Logo -->
  <div class="sidebar-header">
    <div class="logo-section">
      <div class="logo-icon">
        <i class="fas fa-store"></i>
      </div>
      <div class="empresa-info">
        <h2 class="empresa-name">TechStore</h2>
        <p class="empresa-type">Electrónica</p>
      </div>
    </div>
    <button class="btn-close-sidebar" aria-label="Cerrar menú">
      <i class="fas fa-times"></i>
    </button>
  </div>

  <!-- Navigation Menu -->
  <nav class="sidebar-nav">
    <!-- Sección: Gestión -->
    <div class="nav-section">
      <h3 class="nav-section-title">
        <i class="fas fa-briefcase"></i>
        <span>Gestión</span>
      </h3>
      <ul class="nav-menu">
        <li class="nav-item">
          <a href="/PuntoVenta/empresa/dashboard.php" class="nav-link active">
            <i class="fas fa-chart-line"></i>
            <span class="nav-text">Dashboard</span>
            <span class="nav-tooltip">Ver resumen general</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="/PuntoVenta/empresa/productos.php" class="nav-link">
            <i class="fas fa-box"></i>
            <span class="nav-text">Productos</span>
            <span class="nav-badge">145</span>
            <span class="nav-tooltip">Catálogo de productos</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="/PuntoVenta/empresa/categorias.php" class="nav-link">
            <i class="fas fa-layer-group"></i>
            <span class="nav-text">Categorías</span>
            <span class="nav-tooltip">Organizar por categorías</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="/PuntoVenta/empresa/ventas.php" class="nav-link">
            <i class="fas fa-shopping-cart"></i>
            <span class="nav-text">Ventas</span>
            <span class="nav-badge hot">12</span>
            <span class="nav-tooltip">Registro de ventas</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="/PuntoVenta/empresa/clientes.php" class="nav-link">
            <i class="fas fa-users"></i>
            <span class="nav-text">Clientes</span>
            <span class="nav-badge">89</span>
            <span class="nav-tooltip">Gestión de clientes</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="/PuntoVenta/empresa/stock.php" class="nav-link">
            <i class="fas fa-warehouse"></i>
            <span class="nav-text">Stock</span>
            <span class="nav-tooltip">Control de inventario</span>
          </a>
        </li>
      </ul>
    </div>

    <!-- Sección: Negocio -->
    <div class="nav-section">
      <h3 class="nav-section-title">
        <i class="fas fa-chart-bar"></i>
        <span>Negocio</span>
      </h3>
      <ul class="nav-menu">
        <li class="nav-item">
          <a href="/PuntoVenta/empresa/reportes.php" class="nav-link">
            <i class="fas fa-file-chart-bar"></i>
            <span class="nav-text">Reportes</span>
            <span class="nav-tooltip">Análisis y reportes</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="/PuntoVenta/empresa/facturas.php" class="nav-link">
            <i class="fas fa-receipt"></i>
            <span class="nav-text">Facturas</span>
            <span class="nav-tooltip">Sistema de facturación</span>
          </a>
        </li>
      </ul>
    </div>

    <!-- Sección: Administración -->
    <div class="nav-section">
      <h3 class="nav-section-title">
        <i class="fas fa-sliders-h"></i>
        <span>Administración</span>
      </h3>
      <ul class="nav-menu">
        <li class="nav-item">
          <a href="/PuntoVenta/empresa/usuarios.php" class="nav-link">
            <i class="fas fa-users"></i>
            <span class="nav-text">Usuarios</span>
            <span class="nav-tooltip">Gestionar usuarios de empresa</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="/PuntoVenta/empresa/configuracion.php" class="nav-link">
            <i class="fas fa-cog"></i>
            <span class="nav-text">Configuración</span>
            <span class="nav-tooltip">Configurar empresa</span>
          </a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Sidebar Footer con Stats -->
  <div class="sidebar-footer">
    <div class="quick-stats">
      <div class="stat-box">
        <div class="stat-icon">
          <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="stat-content">
          <div class="stat-value">$24.5K</div>
          <div class="stat-label">Ventas Hoy</div>
        </div>
      </div>
      <div class="stat-box">
        <div class="stat-icon">
          <i class="fas fa-calendar-alt"></i>
        </div>
        <div class="stat-content">
          <div class="stat-value">$156K</div>
          <div class="stat-label">Este Mes</div>
        </div>
      </div>
    </div>
    
    <!-- User Info -->
    <div class="sidebar-user">
      <img src="https://via.placeholder.com/40" alt="Usuario" class="user-avatar">
      <div class="user-info">
        <p class="user-name">Juan Pérez</p>
        <p class="user-role">Administrador</p>
      </div>
      <a href="#" class="btn-logout" title="Cerrar sesión">
        <i class="fas fa-sign-out-alt"></i>
      </a>
    </div>
  </div>
</aside>

<!-- Script para mantener estado activo del menú -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Obtener el nombre del archivo actual de la URL
    const currentPath = window.location.pathname;
    const currentFile = currentPath.split('/').pop() || 'dashboard.php';
    
    // Obtener todos los links del menú
    const navLinks = document.querySelectorAll('.nav-link');
    
    // Remover clase active de todos
    navLinks.forEach(link => {
      link.classList.remove('active');
    });
    
    // Agregar clase active al link correspondiente
    navLinks.forEach(link => {
      const href = link.getAttribute('href');
      // Comparar el final del href con el archivo actual
      if (href && href.endsWith(currentFile)) {
        link.classList.add('active');
      }
    });
    
    // Agregar evento click para mantener activo
    navLinks.forEach(link => {
      link.addEventListener('click', function(e) {
        // Remover active de todos
        navLinks.forEach(el => {
          el.classList.remove('active');
        });
        // Agregar active al clickeado
        this.classList.add('active');
      });
    });
  });
</script>
