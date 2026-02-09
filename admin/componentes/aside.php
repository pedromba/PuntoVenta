 <aside class="sidebar">
        <!-- Branding -->
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <div class="brand-text">
                <h4 class="m-0">PuntoVenta</h4>
                <small>Admin System</small>
            </div>
            <button class="btn-sidebar-close d-lg-none">
                <i class="fas fa-xmark"></i>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="sidebar-menu">
            <!-- Dashboard -->
            <div class="menu-group">
                <div class="menu-title">Panel Principal</div>
                <ul class="menu-list">
                    <li>
                        <a href="dashboard.php" class="menu-item active" data-section="dashboard">
                            <span class="menu-icon"><i class="fas fa-chart-line"></i></span>
                            <span class="menu-text">Dashboard</span>
                            <span class="badge badge-pulse">HOY</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Gestión de Empresas -->
            <div class="menu-group">
                <div class="menu-title">Gestión de Empresas</div>
                <ul class="menu-list">
                    <li>
                        <a href="./empresas.php" class="menu-item" data-section="empresas">
                            <span class="menu-icon"><i class="fas fa-building"></i></span>
                            <span class="menu-text">Empresas Registradas</span>
                        </a>
                    </li>
                    <li>
                        <a href="validacion-empresas.php" class="menu-item" data-section="validacion">
                            <span class="menu-icon"><i class="fas fa-check-circle"></i></span>
                            <span class="menu-text">Validar Empresas</span>
                            <span class="badge badge-danger">5</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Administración del Sistema -->
            <div class="menu-group">
                <div class="menu-title">Administración</div>
                <ul class="menu-list">
                    <li>
                        <a href="usuarios.php" class="menu-item" data-section="usuarios">
                            <span class="menu-icon"><i class="fas fa-users"></i></span>
                            <span class="menu-text">Usuarios Admin</span>
                        </a>
                    </li>
                    <li>
                        <a href="configuracion.php" class="menu-item" data-section="configuracion">
                            <span class="menu-icon"><i class="fas fa-cogs"></i></span>
                            <span class="menu-text">Configuración</span>
                        </a>
                    </li>
                    <li>
                        <a href="roles-permisos.php" class="menu-item" data-section="roles">
                            <span class="menu-icon"><i class="fas fa-lock"></i></span>
                            <span class="menu-text">Roles y Permisos</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Monitoreo y Reportes -->
            <div class="menu-group">
                <div class="menu-title">Monitoreo</div>
                <ul class="menu-list">
                    <li>
                        <a href="auditoria.php" class="menu-item" data-section="auditoria">
                            <span class="menu-icon"><i class="fas fa-history"></i></span>
                            <span class="menu-text">Auditoría</span>
                        </a>
                    </li>
                    <li>
                        <a href="reportes-admin.php" class="menu-item" data-section="reportes">
                            <span class="menu-icon"><i class="fas fa-file-alt"></i></span>
                            <span class="menu-text">Reportes</span>
                        </a>
                    </li>
                    <li>
                        <a href="salud-sistema.php" class="menu-item" data-section="salud">
                            <span class="menu-icon"><i class="fas fa-heartbeat"></i></span>
                            <span class="menu-text">Salud del Sistema</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Configuración Técnica -->
            <div class="menu-group">
                <div class="menu-title">Técnico</div>
                <ul class="menu-list">
                    <li>
                        <a href="integraciones.php" class="menu-item" data-section="integraciones">
                            <span class="menu-icon"><i class="fas fa-plug"></i></span>
                            <span class="menu-text">Integraciones</span>
                        </a>
                    </li>
                    <li>
                        <a href="respaldos.php" class="menu-item" data-section="respaldos">
                            <span class="menu-icon"><i class="fas fa-hdd"></i></span>
                            <span class="menu-text">Respaldos</span>
                        </a>
                    </li>
                    <li>
                        <a href="logs.php" class="menu-item" data-section="logs">
                            <span class="menu-icon"><i class="fas fa-terminal"></i></span>
                            <span class="menu-text">Logs del Sistema</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Sidebar Footer -->
        <div class="sidebar-footer">
            <div class="user-card">
                <div class="user-avatar">
                    <img src="https://ui-avatars.com/api/?name=Admin+User&background=2563eb&color=fff&rounded=true" alt="Admin">
                </div>
                <div class="user-info">
                    <div class="user-name">Administrador</div>
                    <div class="user-status">En línea</div>
                </div>
                <button class="btn btn-sm btn-ghost">
                    <i class="fas fa-ellipsis-vertical"></i>
                </button>
            </div>
        </div>
    </aside>

    <!-- Script para mantener estado activo del menú -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener el nombre del archivo actual
            const currentPage = window.location.pathname.split('/').pop() || 'dashboard.php';
            
            // Obtener todos los links del menú
            const menuItems = document.querySelectorAll('.menu-item');
            
            // Remover clase active de todos
            menuItems.forEach(item => {
                item.classList.remove('active');
            });
            
            // Agregar clase active al link correspondiente
            menuItems.forEach(item => {
                const href = item.getAttribute('href');
                // Comparar el href con la página actual
                if (href && (href === currentPage || href === './' + currentPage)) {
                    item.classList.add('active');
                }
            });
            
            // Agregar evento click para mantener activo
            menuItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    // Remover active de todos
                    menuItems.forEach(el => {
                        el.classList.remove('active');
                    });
                    // Agregar active al clickeado
                    this.classList.add('active');
                });
            });
        });
    </script>