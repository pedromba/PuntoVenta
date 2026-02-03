class EmpresasManager {
    constructor() {
        this.searchInput = document.getElementById('searchEmpresas');
        this.filterCategoria = document.getElementById('filterCategoria');
        this.filterEstado = document.getElementById('filterEstado');
        this.filterOrden = document.getElementById('filterOrden');
        this.btnLimpiarFiltros = document.getElementById('btnLimpiarFiltros');
        this.btnCrearEmpresa = document.getElementById('btnCrearEmpresa');
        this.toggleBtn = document.querySelector('.btn-toggle-sidebar');
        this.sidebar = document.querySelector('.sidebar');
        this.overlay = document.querySelector('.sidebar-overlay');
        this.menuItems = document.querySelectorAll('.menu-item');
        
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.setupIntersectionObserver();
        this.setupDropdowns();
    }

    setupEventListeners() {
        // Search
        this.searchInput?.addEventListener('input', (e) => this.handleSearch(e));

        // Filters
        this.filterCategoria?.addEventListener('change', () => this.applyFilters());
        this.filterEstado?.addEventListener('change', () => this.applyFilters());
        this.filterOrden?.addEventListener('change', () => this.applyFilters());
        this.btnLimpiarFiltros?.addEventListener('click', () => this.clearFilters());

        // Create
        this.btnCrearEmpresa?.addEventListener('click', () => this.showCreateModal());

        // Sidebar
        this.toggleBtn?.addEventListener('click', () => this.toggleSidebar());
        this.overlay?.addEventListener('click', () => this.closeSidebar());
        this.menuItems.forEach(item => {
            item.addEventListener('click', (e) => {
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

    handleResize() {
        if (window.innerWidth >= 992) {
            this.closeSidebar();
        }
    }

    handleSearch(e) {
        const searchTerm = e.target.value.toLowerCase();
        console.log('Buscando:', searchTerm);
        // TODO: Implementar búsqueda en tiempo real
    }

    applyFilters() {
        const categoria = this.filterCategoria.value;
        const estado = this.filterEstado.value;
        const orden = this.filterOrden.value;
        
        console.log('Filtros aplicados:', { categoria, estado, orden });
        // TODO: Implementar filtrado dinámico
    }

    clearFilters() {
        this.searchInput.value = '';
        this.filterCategoria.value = '';
        this.filterEstado.value = '';
        this.filterOrden.value = 'reciente';
        this.applyFilters();
    }

    showCreateModal() {
        console.log('Abriendo modal de crear empresa');
        // TODO: Mostrar modal de creación
        alert('Modal de crear empresa (próximamente)');
    }

    setupDropdowns() {
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', (e) => {
                e.stopPropagation();
                console.log('Dropdown abierto');
                // TODO: Implementar dropdown de opciones
            });
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
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    new EmpresasManager();
});