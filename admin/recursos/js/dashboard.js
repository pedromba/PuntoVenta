class Dashboard {
    constructor() {
        this.sidebar = document.querySelector('.sidebar');
        this.overlay = document.querySelector('.sidebar-overlay');
        this.toggleBtn = document.querySelector('.btn-toggle-sidebar');
        this.closeBtn = document.querySelector('.btn-sidebar-close');
        this.menuItems = document.querySelectorAll('.menu-item');
        this.notificationBtn = document.querySelector('.btn-notification');
        this.notificationMenu = document.querySelector('.notification-menu');
        this.userBtn = document.querySelector('.btn-user');
        this.userMenu = document.querySelector('.user-menu');
        
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.setupIntersectionObserver();
        this.initCharts();
        this.setupDropdowns();
    }

    setupEventListeners() {
        // Sidebar toggle
        this.toggleBtn?.addEventListener('click', () => this.toggleSidebar());
        this.closeBtn?.addEventListener('click', () => this.closeSidebar());
        this.overlay?.addEventListener('click', () => this.closeSidebar());

        // Menu items
        this.menuItems.forEach(item => {
            item.addEventListener('click', (e) => {
                const href = item.getAttribute('href');
                
                // Si el enlace es un archivo .php válido, permitir navegación
                if (href && href !== '#' && href.endsWith('.php')) {
                    this.setActiveMenu(item);
                    if (window.innerWidth < 992) {
                        this.closeSidebar();
                    }
                    // Permitir que el navegador navegue
                    return true;
                }
                
                // Para otros casos, prevenir por defecto
                e.preventDefault();
                this.setActiveMenu(item);
                if (window.innerWidth < 992) {
                    this.closeSidebar();
                }
            });
        });

        // Window resize
        window.addEventListener('resize', () => this.handleResize());
    }

    toggleSidebar() {
        this.sidebar?.classList.toggle('active');
        this.overlay?.classList.toggle('active');
    }

    closeSidebar() {
        this.sidebar?.classList.remove('active');
        this.overlay?.classList.remove('active');
    }

    setActiveMenu(item) {
        this.menuItems.forEach(m => m.classList.remove('active'));
        item.classList.add('active');
    }

    handleResize() {
        if (window.innerWidth >= 992) {
            this.closeSidebar();
        }
    }

    setupDropdowns() {
        // Bootstrap maneja los dropdowns automáticamente con data-bs-toggle
        // Mantener código legacy si hay elementos no migrados a Bootstrap
        this.notificationBtn?.addEventListener('click', (e) => {
            if (!e.target.closest('[data-bs-toggle="dropdown"]')) {
                e.stopPropagation();
                this.notificationMenu?.classList.toggle('active');
                this.userMenu?.classList.remove('active');
            }
        });

        this.userBtn?.addEventListener('click', (e) => {
            if (!e.target.closest('[data-bs-toggle="dropdown"]')) {
                e.stopPropagation();
                this.userMenu?.classList.toggle('active');
                this.notificationMenu?.classList.remove('active');
            }
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('.dropdown-menu') && !e.target.closest('[data-bs-toggle="dropdown"]')) {
                this.notificationMenu?.classList.remove('active');
                this.userMenu?.classList.remove('active');
            }
        });
    }

    setupIntersectionObserver() {
        const options = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    observer.unobserve(entry.target);
                }
            });
        }, options);

        document.querySelectorAll('[data-animate="slide-in"]').forEach(el => {
            el.style.opacity = '0';
            observer.observe(el);
        });
    }

    initCharts() {
        // Los gráficos se crearán cuando los datos se carguen dinámicamente
        this.empresasChart = null;
        this.loadDashboardData();
    }

    /**
     * Carga todos los datos del dashboard desde el endpoint PHP
     */
    async loadDashboardData() {
        console.log('🔄 Cargando datos del dashboard...');
        
        try {
            const response = await fetch('./php/obtener_datos_dashboard.php', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                },
                credentials: 'same-origin'
            });

            console.log('📡 Respuesta recibida:', response.status);

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            console.log('✅ Datos del dashboard:', data);

            if (data.success) {
                this.renderDashboardData(data);
            } else {
                throw new Error(data.error || 'Error desconocido');
            }

        } catch (error) {
            console.error('❌ Error al cargar datos del dashboard:', error);
            this.showError('Error al cargar los datos del dashboard. Por favor, recarga la página.');
        }
    }

    /**
     * Renderiza todos los datos en el dashboard
     */
    renderDashboardData(data) {
        console.log('🎨 Renderizando datos del dashboard...');
        
        // 1. Actualizar nombre de usuario
        this.updateUsuario(data.usuario);
        
        // 2. Actualizar tarjetas KPI
        this.updateKPIs(data.kpis);
        
        // 3. Crear gráfico de empresas por estado
        this.createEmpresasEstadoChart(data.graficos.empresas_por_estado);
        
        // 4. Actualizar resumen de estados
        this.updateEstadosResumen(data.graficos.empresas_por_estado.resumen);
        
        // 5. Actualizar actividad reciente
        this.updateActividadReciente(data.actividad_reciente);
        
        // 6. Actualizar tabla de empresas (pequeño preview)
        this.updateEmpresasTabla(data.actividad_reciente);
        
        // 7. Actualizar notificaciones
        this.updateNotificaciones(data.notificaciones);
        
        console.log('✅ Dashboard renderizado completamente');
    }

    /**
     * Actualiza el nombre del usuario en el mensaje de bienvenida y topbar
     */
    updateUsuario(usuario) {
        // Actualizar mensaje de bienvenida
        const nombreEl = document.getElementById('usuario-nombre');
        if (nombreEl && usuario.nombre) {
            nombreEl.textContent = usuario.nombre;
        }
        
        // Actualizar topbar
        const userNameTopbar = document.getElementById('user-name-topbar');
        const userNameDropdown = document.getElementById('user-name-dropdown');
        const userEmailDropdown = document.getElementById('user-email-dropdown');
        const userAvatar = document.getElementById('user-avatar');
        
        if (userNameTopbar && usuario.nombre) {
            userNameTopbar.textContent = usuario.nombre;
        }
        
        if (userNameDropdown && usuario.nombre) {
            userNameDropdown.textContent = usuario.nombre;
        }
        
        if (userEmailDropdown && usuario.email) {
            userEmailDropdown.textContent = usuario.email;
        }
        
        if (userAvatar && usuario.nombre) {
            const initials = usuario.nombre.split(' ').map(n => n[0]).join('').toUpperCase();
            userAvatar.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(usuario.nombre)}&background=2563eb&color=fff&rounded=true`;
            userAvatar.alt = usuario.nombre;
        }
    }

    /**
     * Actualiza las tarjetas KPI
     */
    updateKPIs(kpis) {
        // KPI 1: Total de empresas
        const empresasTotalEl = document.getElementById('kpi-empresas-total');
        if (empresasTotalEl) {
            empresasTotalEl.innerHTML = kpis.empresas_total;
        }

        // KPI 2: Empresas pendientes
        const empresasPendientesEl = document.getElementById('kpi-empresas-pendientes');
        if (empresasPendientesEl) {
            empresasPendientesEl.innerHTML = kpis.empresas_pendientes;
        }

        // Badge de pendientes
        const pendientesBadge = document.getElementById('kpi-pendientes-badge');
        const pendientesBadgeValue = document.getElementById('kpi-pendientes-badge-value');
        if (kpis.empresas_pendientes > 0 && pendientesBadge) {
            pendientesBadge.style.display = 'flex';
            if (pendientesBadgeValue) {
                pendientesBadgeValue.textContent = kpis.empresas_pendientes;
            }
        }

        // KPI 3: Administradores activos
        const adminActivosEl = document.getElementById('kpi-admin-activos');
        const adminActivosBadgeEl = document.getElementById('kpi-admin-activos-badge');
        if (adminActivosEl) {
            adminActivosEl.innerHTML = kpis.admin_activos;
        }
        if (adminActivosBadgeEl) {
            adminActivosBadgeEl.textContent = kpis.admin_activos;
        }

        // KPI 4: Estado del sistema
        const sistemaEstadoEl = document.getElementById('kpi-sistema-estado');
        const sistemaPorcentajeEl = document.getElementById('kpi-sistema-porcentaje');
        if (sistemaEstadoEl) {
            sistemaEstadoEl.innerHTML = kpis.sistema_estado;
        }
        if (sistemaPorcentajeEl) {
            sistemaPorcentajeEl.textContent = kpis.sistema_porcentaje + '%';
        }
    }

    /**
     * Crea el gráfico de empresas por estado
     */
    createEmpresasEstadoChart(chartData) {
        const ctx = document.getElementById('empresasEstadoChart');
        if (!ctx) return;

        // Destruir gráfico anterior si existe
        if (this.empresasChart) {
            this.empresasChart.destroy();
        }

        // Colores según el estado
        const coloresEstado = {
            'Activo': '#10b981',
            'Inactivo': '#f59e0b',
            'Suspendido': '#ef4444'
        };

        const backgroundColors = chartData.labels.map(label => coloresEstado[label] || '#6b7280');

        this.empresasChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Número de Empresas',
                    data: chartData.data,
                    backgroundColor: backgroundColors,
                    borderColor: backgroundColors,
                    borderWidth: 2,
                    borderRadius: 8,
                    barThickness: 60
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleFont: { size: 13, weight: 'bold', family: "'Sora', sans-serif" },
                        bodyFont: { size: 12, family: "'Sora', sans-serif" },
                        cornerRadius: 6,
                        displayColors: true,
                        callbacks: {
                            label: (context) => {
                                return 'Empresas: ' + context.parsed.y;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#9ca3af',
                            font: { size: 12, family: "'Sora', sans-serif" },
                            stepSize: 1
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#1f2937',
                            font: { size: 13, family: "'Sora', sans-serif", weight: '500' }
                        }
                    }
                }
            }
        });
    }

    /**
     * Actualiza el resumen de estados
     */
    updateEstadosResumen(resumen) {
        const contenedor = document.getElementById('estados-resumen');
        if (!contenedor) return;

        const badgeColors = {
            'Activo': 'badge-success',
            'Inactivo': 'badge-warning',
            'Suspendido': 'badge-danger'
        };

        let html = '';
        resumen.forEach(item => {
            const badgeClass = badgeColors[item.estado] || 'badge-primary';
            html += `
                <div class="metric-item">
                    <div class="metric-label">${item.estado}</div>
                    <div class="metric-value">
                        <span class="badge ${badgeClass}">${item.cantidad} (${item.porcentaje}%)</span>
                    </div>
                </div>
            `;
        });

        contenedor.innerHTML = html;
    }

    /**
     * Actualiza la actividad reciente
     */
    updateActividadReciente(actividad) {
        const contenedor = document.getElementById('recent-activity');
        if (!contenedor) return;

        if (!actividad || actividad.length === 0) {
            contenedor.innerHTML = `
                <div class="text-center py-3 text-muted">
                    <i class="fas fa-inbox" style="font-size: 24px; margin-bottom: 10px;"></i>
                    <p>No hay actividad reciente</p>
                </div>
            `;
            return;
        }

        const markerColors = {
            'activo': 'success',
            'inactivo': 'warning',
            'suspendido': 'danger'
        };

        let html = '';
        actividad.forEach(item => {
            const markerClass = markerColors[item.estado.toLowerCase()] || 'info';
            html += `
                <div class="activity-item">
                    <div class="activity-marker ${markerClass}"></div>
                    <div class="activity-content">
                        <p class="activity-title">Empresa: ${this.escapeHtml(item.nombre_comercial)}</p>
                        <p class="activity-description">Estado: ${item.estado}</p>
                        <span class="activity-time">${item.fecha_relativa || item.fecha_formateada}</span>
                    </div>
                </div>
            `;
        });

        contenedor.innerHTML = html;
    }

    /**
     * Actualiza la tabla de empresas
     */
    updateEmpresasTabla(empresas) {
        const tbody = document.getElementById('empresas-tbody');
        if (!tbody) return;

        if (!empresas || empresas.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">
                        No hay empresas registradas
                    </td>
                </tr>
            `;
            return;
        }

        const badgeColors = {
            'activo': 'badge-success',
            'inactivo': 'badge-warning',
            'suspendido': 'badge-danger'
        };

        let html = '';
        empresas.forEach(empresa => {
            const badgeClass = badgeColors[empresa.estado.toLowerCase()] || 'badge-secondary';
            const iniciales = this.getIniciales(empresa.nombre_comercial);
            
            html += `
                <tr class="table-row-hover">
                    <td>
                        <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(iniciales)}&background=2563eb&color=fff&size=50" 
                             alt="Logo" 
                             style="width: 50px; height: 50px; border-radius: 4px; object-fit: contain;">
                    </td>
                    <td>
                        <strong>${this.escapeHtml(empresa.nombre_comercial)}</strong>
                    </td>
                    <td>
                        <span class="badge badge-light">-</span>
                    </td>
                    <td>-</td>
                    <td>
                        <small>-</small>
                    </td>
                    <td>
                        <span class="badge ${badgeClass}">${this.capitalizar(empresa.estado)}</span>
                    </td>
                    <td class="text-center">
                        <a href="empresas.php" class="btn btn-sm btn-primary" title="Ver">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
            `;
        });

        tbody.innerHTML = html;
    }

    /**
     * Actualiza las notificaciones en el dropdown
     */
    updateNotificaciones(notificaciones) {
        const notificationList = document.getElementById('notification-list');
        const notificationCount = document.getElementById('notification-count');
        
        if (!notificationList) return;
        
        if (!notificaciones || notificaciones.length === 0) {
            notificationList.innerHTML = `
                <div class="text-center py-4">
                    <i class="fas fa-bell-slash fa-2x text-muted mb-2"></i>
                    <p class="text-muted mb-0">No hay notificaciones</p>
                </div>
            `;
            if (notificationCount) {
                notificationCount.style.display = 'none';
            }
            return;
        }
        
        // Actualizar badge de conteo
        if (notificationCount) {
            const unreadCount = notificaciones.filter(n => !n.leida).length;
            if (unreadCount > 0) {
                notificationCount.textContent = unreadCount > 9 ? '9+' : unreadCount;
                notificationCount.style.display = 'flex';
            } else {
                notificationCount.style.display = 'none';
            }
        }
        
        // Generar HTML de notificaciones
        const notificacionesHTML = notificaciones.map(notif => {
            const iconClass = {
                'danger': 'fa-circle-exclamation',
                'warning': 'fa-exclamation-triangle',
                'info': 'fa-info-circle',
                'success': 'fa-check-circle'
            }[notif.tipo] || 'fa-bell';
            
            const bgClass = {
                'danger': 'bg-danger',
                'warning': 'bg-warning',
                'info': 'bg-info',
                'success': 'bg-success'
            }[notif.tipo] || 'bg-primary';
            
            return `
                <div class="dropdown-item ${!notif.leida ? 'bg-light' : ''} py-3 border-bottom">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle ${bgClass} bg-opacity-10 text-${notif.tipo || 'primary'} d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="fas ${iconClass}"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="mb-1 fw-bold">${this.escapeHtml(notif.titulo || 'Notificación')}</p>
                            <p class="mb-1 small text-muted">${this.escapeHtml(notif.mensaje || '')}</p>
                            <small class="text-muted">${notif.tiempo || ''}</small>
                        </div>
                    </div>
                </div>
            `;
        }).join('');
        
        notificationList.innerHTML = notificacionesHTML;
    }

    /**
     * Muestra un mensaje de error
     */
    showError(mensaje) {
        console.error('Error:', mensaje);
        // Podrías usar SweetAlert2 aquí si está disponible
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: mensaje,
                confirmButtonText: 'Recargar',
                confirmButtonColor: '#2563eb'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        } else {
            alert(mensaje);
        }
    }

    // Utilidades
    escapeHtml(text) {
        if (!text) return '';
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.toString().replace(/[&<>"']/g, m => map[m]);
    }

    getIniciales(nombre) {
        if (!nombre) return 'N/A';
        return nombre.split(' ').map(p => p[0]).join('').toUpperCase().substring(0, 2);
    }

    capitalizar(text) {
        if (!text) return '';
        return text.charAt(0).toUpperCase() + text.slice(1).toLowerCase();
    }

    createVentasChart() {
        const ctx = document.getElementById('ventasChart');
        if (!ctx) return;

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
                datasets: [
                    {
                        label: 'Ventas Completadas',
                        data: [1200, 1900, 1500, 2200, 2800, 3100, 2600],
                        borderColor: '#2563eb',
                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#2563eb',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                    },
                    {
                        label: 'Ventas Pendientes',
                        data: [400, 600, 500, 700, 800, 600, 500],
                        borderColor: '#f59e0b',
                        backgroundColor: 'rgba(245, 158, 11, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#f59e0b',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            color: '#6b7280',
                            font: { size: 13, family: "'Sora', sans-serif", weight: '500' },
                            padding: 15,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    filler: {
                        propagate: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6',
                            drawBorder: false,
                            lineWidth: 1
                        },
                        ticks: {
                            color: '#9ca3af',
                            font: { size: 12, family: "'Sora', sans-serif" },
                            callback: (value) => '$' + value.toLocaleString()
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#9ca3af',
                            font: { size: 12, family: "'Sora', sans-serif" }
                        }
                    }
                }
            }
        });
    }

    createCategoriasChart() {
        const ctx = document.getElementById('categoriasChart');
        if (!ctx) return;

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Electrónica', 'Ropa', 'Alimentos', 'Otros'],
                datasets: [{
                    data: [35, 25, 20, 20],
                    backgroundColor: [
                        '#2563eb',
                        '#10b981',
                        '#f59e0b',
                        '#ef4444'
                    ],
                    borderColor: '#fff',
                    borderWidth: 3,
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#6b7280',
                            font: { size: 12, family: "'Sora', sans-serif" },
                            padding: 15,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleFont: { size: 13, weight: 'bold' },
                        bodyFont: { size: 12 },
                        cornerRadius: 6,
                        displayColors: true,
                        callbacks: {
                            label: (context) => {
                                return context.label + ': ' + context.parsed.y + '%';
                            }
                        }
                    }
                }
            }
        });
    }

        });
    }
}

// Función global para actualizar el dashboard
function actualizarDashboard() {
    console.log('🔄 Actualizando dashboard...');
    if (window.dashboardInstance) {
        window.dashboardInstance.loadDashboardData();
    } else {
        location.reload();
    }
}

// Función global para cerrar sesión
function logout(event) {
    event.preventDefault();
    
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: '¿Cerrar sesión?',
            text: "Se cerrará tu sesión actual",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Sí, cerrar sesión',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../recursos/php/logout.php';
            }
        });
    } else {
        if (confirm('¿Deseas cerrar sesión?')) {
            window.location.href = '../recursos/php/logout.php';
        }
    }
}

// Inicializar
document.addEventListener('DOMContentLoaded', () => {
    window.dashboardInstance = new Dashboard();
});