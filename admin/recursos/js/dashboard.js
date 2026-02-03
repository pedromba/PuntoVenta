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
        this.createRevenueChart();
        this.createPlansChart();
    }

    createRevenueChart() {
        const ctx = document.getElementById('revenueChart');
        if (!ctx) return;

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                datasets: [{
                    label: 'Ingresos',
                    data: [8500, 9200, 8800, 10500, 12300, 13500, 14200, 13800, 15600, 14800, 16200, 14250],
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.08)',
                    borderWidth: 2.5,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#2563eb',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2.5,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    pointHoverBorderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { display: false },
                    filler: {
                        propagate: true
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
                            callback: (value) => '$' + (value / 1000).toFixed(0) + 'K'
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

    createPlansChart() {
        const ctx = document.getElementById('plansChart');
        if (!ctx) return;

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pro', 'Premium', 'Básico', 'Prueba'],
                datasets: [{
                    data: [28, 12, 5, 2],
                    backgroundColor: [
                        '#2563eb',
                        '#10b981',
                        '#f59e0b',
                        '#ef4444'
                    ],
                    borderColor: '#fff',
                    borderWidth: 2
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
                            padding: 16,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    }
                }
            }
        });
    }
}

// Inicializar
document.addEventListener('DOMContentLoaded', () => {
    new Dashboard();
});