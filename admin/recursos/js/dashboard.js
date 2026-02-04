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
        this.notificationBtn?.addEventListener('click', (e) => {
            e.stopPropagation();
            this.notificationMenu?.classList.toggle('active');
            this.userMenu?.classList.remove('active');
        });

        this.userBtn?.addEventListener('click', (e) => {
            e.stopPropagation();
            this.userMenu?.classList.toggle('active');
            this.notificationMenu?.classList.remove('active');
        });

        document.addEventListener('click', () => {
            this.notificationMenu?.classList.remove('active');
            this.userMenu?.classList.remove('active');
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
        this.createVentasChart();
        this.createCategoriasChart();
        // Simular carga de datos
        this.loadDashboardData();
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

    loadDashboardData() {
        // Simular carga de datos del servidor
        setTimeout(() => {
            document.querySelector('.kpi-value:nth-of-type(1)')?.textContent || (
                document.querySelectorAll('.kpi-value')[0].textContent = '12'
            );
            document.querySelectorAll('.kpi-value')[1].textContent = '248';
            document.querySelectorAll('.kpi-value')[2].textContent = '1,350';
            
            // Actualizar barras de progreso
            document.getElementById('ventas-progress')?.style.setProperty('width', '75%');
            document.getElementById('stock-progress')?.style.setProperty('width', '82%');
            document.getElementById('ingresos-progress')?.style.setProperty('width', '68%');
            
            // Valores de métricas
            document.getElementById('total-ventas').textContent = '248';
            document.getElementById('stock-total').textContent = '1,350';
            document.getElementById('ingresos-total').textContent = '$45,280.50';
        }, 500);
    }
}

// Inicializar
document.addEventListener('DOMContentLoaded', () => {
    new Dashboard();
});