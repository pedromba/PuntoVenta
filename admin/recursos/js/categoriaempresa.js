// ==========================================
// GESTIÓN DE CATEGORÍAS
// ==========================================

class CategoriasManager {
    constructor() {
        this.currentPage = 1;
        this.itemsPerPage = 10;
        this.categorias = [];
        this.filteredCategorias = [];
        this.viewMode = 'tabla'; // 'tabla' o 'grid'
        this.currentEditId = null;
        this.init();
    }

    // Inicialización
    init() {
        this.cacheDOMElements();
        this.bindEvents();
        this.loadCategorias();
    }

    // Cache de elementos del DOM
    cacheDOMElements() {
        // Búsqueda y Filtros
        this.searchInput = document.getElementById('searchInput');
        this.filterEstado = document.getElementById('filterEstado');
        this.filterOrden = document.getElementById('filterOrden');
        this.btnClearSearch = document.getElementById('btnClearSearch');
        this.btnExportar = document.getElementById('btnExportar');

        // Vistas
        this.viewTabla = document.getElementById('viewTabla');
        this.viewGrid = document.getElementById('viewGrid');
        this.emptyState = document.getElementById('emptyState');

        // Tabla
        this.tablaCategorias = document.getElementById('tablaCategorias');
        this.gridCategorias = document.getElementById('gridCategorias');
        this.selectAll = document.getElementById('selectAll');

        // Paginación
        this.paginationControls = document.getElementById('paginationControls');
        this.paginationControlsGrid = document.getElementById('paginationControlsGrid');
        this.startIndex = document.getElementById('startIndex');
        this.endIndex = document.getElementById('endIndex');
        this.totalRecords = document.getElementById('totalRecords');

        // Botones principales
        this.btnAgregarCategoria = document.getElementById('btnAgregarCategoria');
        this.btnAgregarCategoriaEmpty = document.getElementById('btnAgregarCategoriaEmpty');
        this.btnToggleView = document.getElementById('btnToggleView');

        // Modal
        this.modalCategoria = new bootstrap.Modal(document.getElementById('modalCategoria'));
        this.modalEliminar = new bootstrap.Modal(document.getElementById('modalEliminar'));
        this.formCategoria = document.getElementById('formCategoria');
        this.categoriaId = document.getElementById('categoriaId');
        this.categoriaNombre = document.getElementById('categoriaNombre');
        this.categoriaDescripcion = document.getElementById('categoriaDescripcion');
        this.categoriaColor = document.getElementById('categoriaColor');
        this.categoriaActivo = document.getElementById('categoriaActivo');
        this.btnGuardarCategoria = document.getElementById('btnGuardarCategoria');
        this.modalTitle = document.getElementById('modalTitle');
        this.estadoLabel = document.getElementById('estadoLabel');
        this.alertCategoria = document.getElementById('alertCategoria');
        this.charCount = document.getElementById('charCount');
        this.colorPreview = document.getElementById('colorPreview');
        this.colorValue = document.getElementById('colorValue');

        // Modal eliminar
        this.btnConfirmarEliminar = document.getElementById('btnConfirmarEliminar');
        this.nombreEliminar = document.getElementById('nombreEliminar');
        this.productosCategoriaInfo = document.getElementById('productosCategoriaInfo');
        this.countProductos = document.getElementById('countProductos');

        // Toast
        this.toastContainer = document.getElementById('toastContainer');
    }

    // Vinculación de eventos
    bindEvents() {
        // Búsqueda
        this.searchInput.addEventListener('input', () => this.handleSearch());
        this.btnClearSearch.addEventListener('click', () => this.clearSearch());

        // Filtros
        this.filterEstado.addEventListener('change', () => this.applyFilters());
        this.filterOrden.addEventListener('change', () => this.applyFilters());

        // Botones principales
        this.btnAgregarCategoria.addEventListener('click', () => this.openModalAgregar());
        this.btnAgregarCategoriaEmpty.addEventListener('click', () => this.openModalAgregar());
        this.btnToggleView.addEventListener('click', () => this.toggleView());
        this.btnExportar.addEventListener('click', () => this.exportarDatos());

        // Modal
        this.formCategoria.addEventListener('submit', (e) => this.handleSubmit(e));
        this.selectAll.addEventListener('change', (e) => this.toggleSelectAll(e));
        this.categoriaDescripcion.addEventListener('input', () => this.updateCharCount());
        this.categoriaColor.addEventListener('change', (e) => this.updateColorPreview(e));
        this.categoriaActivo.addEventListener('change', () => this.updateEstadoLabel());

        // Botón eliminar
        this.btnConfirmarEliminar.addEventListener('click', () => this.confirmarEliminar());
    }

    // Cargar categorías
    loadCategorias() {
        // Simular carga desde API/base de datos
        this.categorias = [
            {
                id: 1,
                nombre: 'Electrónica',
                descripción: 'Productos electrónicos en general',
                color: '#2563eb',
                productos: 24,
                estado: 'activo',
                fechaCreacion: '2025-12-15'
            },
            {
                id: 2,
                nombre: 'Ropa',
                descripción: 'Prendas de vestir',
                color: '#8b5cf6',
                productos: 45,
                estado: 'activo',
                fechaCreacion: '2025-12-10'
            },
            {
                id: 3,
                nombre: 'Alimentos',
                descripción: 'Productos alimenticios frescos y envasados',
                color: '#10b981',
                productos: 78,
                estado: 'activo',
                fechaCreacion: '2025-11-20'
            },
            {
                id: 4,
                nombre: 'Libros',
                descripción: 'Literatura y educación',
                color: '#f59e0b',
                productos: 15,
                estado: 'activo',
                fechaCreacion: '2025-11-05'
            },
            {
                id: 5,
                nombre: 'Hogar',
                descripción: 'Decoración y artículos para el hogar',
                color: '#ef4444',
                productos: 0,
                estado: 'inactivo',
                fechaCreacion: '2025-10-01'
            }
        ];

        this.filteredCategorias = [...this.categorias];
        this.renderCategorias();
    }

    // Renderizar categorías
    renderCategorias() {
        if (this.filteredCategorias.length === 0) {
            this.viewTabla.style.display = 'none';
            this.viewGrid.style.display = 'none';
            this.emptyState.style.display = 'block';
            return;
        }

        this.emptyState.style.display = 'none';

        if (this.viewMode === 'tabla') {
            this.renderTabla();
            this.viewTabla.style.display = 'block';
            this.viewGrid.style.display = 'none';
        } else {
            this.renderGrid();
            this.viewTabla.style.display = 'none';
            this.viewGrid.style.display = 'block';
        }

        this.updatePaginationInfo();
    }

    // Renderizar tabla
    renderTabla() {
        const start = (this.currentPage - 1) * this.itemsPerPage;
        const end = start + this.itemsPerPage;
        const categoriasPage = this.filteredCategorias.slice(start, end);

        this.tablaCategorias.innerHTML = categoriasPage.map(cat => `
            <tr>
                <td class="col-checkbox">
                    <input type="checkbox" class="form-check-input categoria-check" data-id="${cat.id}">
                </td>
                <td>
                    <div class="categoria-cell">
                        <div class="categoria-avatar" style="background-color: ${cat.color}">
                            ${cat.nombre[0].toUpperCase()}
                        </div>
                        <div>
                            <p class="categoria-name">${cat.nombre}</p>
                            <p class="categoria-desc">${cat.descripción || 'Sin descripción'}</p>
                        </div>
                    </div>
                </td>
                <td>${this.truncateText(cat.descripción, 40)}</td>
                <td><span class="badge">${cat.productos}</span></td>
                <td>${this.formatDate(cat.fechaCreacion)}</td>
                <td>
                    <span class="status-badge ${cat.estado}">
                        <span class="status-dot"></span>
                        ${cat.estado === 'activo' ? 'Activo' : 'Inactivo'}
                    </span>
                </td>
                <td>
                    <div class="action-buttons">
                        <button class="btn-action" onclick="categoriasManager.editCategoria(${cat.id})" title="Editar">
                            <i class="fas fa-pen"></i>
                        </button>
                        <button class="btn-action btn-danger" onclick="categoriasManager.deleteCategoria(${cat.id})" title="Eliminar">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');

        this.renderPagination('tabla');
    }

    // Renderizar grid
    renderGrid() {
        const start = (this.currentPage - 1) * this.itemsPerPage;
        const end = start + this.itemsPerPage;
        const categoriasPage = this.filteredCategorias.slice(start, end);

        this.gridCategorias.innerHTML = categoriasPage.map(cat => `
            <div class="categoria-card">
                <div class="card-header-cat">
                    <div class="card-color-icon" style="background-color: ${cat.color}">
                        ${cat.nombre[0].toUpperCase()}
                    </div>
                    <button class="card-menu" onclick="categoriasManager.editCategoria(${cat.id})">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>
                <h5 class="card-title-cat">${cat.nombre}</h5>
                <p class="card-desc-cat">${cat.descripción || 'Sin descripción'}</p>
                <div class="card-stats">
                    <div class="stat-item">
                        <div class="stat-value">${cat.productos}</div>
                        <div class="stat-label">Productos</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">${cat.estado === 'activo' ? '✓' : '✗'}</div>
                        <div class="stat-label">Estado</div>
                    </div>
                </div>
                <div class="card-actions">
                    <button class="btn btn-sm btn-primary" onclick="categoriasManager.editCategoria(${cat.id})">
                        <i class="fas fa-pen me-1"></i>Editar
                    </button>
                    <button class="btn btn-sm btn-danger" onclick="categoriasManager.deleteCategoria(${cat.id})">
                        <i class="fas fa-trash me-1"></i>Eliminar
                    </button>
                </div>
            </div>
        `).join('');

        this.renderPagination('grid');
    }

    // Renderizar paginación
    renderPagination(type) {
        const totalPages = Math.ceil(this.filteredCategorias.length / this.itemsPerPage);
        const paginationControls = type === 'tabla' ? this.paginationControls : this.paginationControlsGrid;

        let html = '';

        if (this.currentPage > 1) {
            html += `<li class="page-item">
                <button class="page-link" onclick="categoriasManager.previousPage()">
                    <i class="fas fa-chevron-left"></i> Anterior
                </button>
            </li>`;
        }

        for (let i = 1; i <= totalPages; i++) {
            if (i === this.currentPage) {
                html += `<li class="page-item">
                    <button class="page-link active">${i}</button>
                </li>`;
            } else {
                html += `<li class="page-item">
                    <button class="page-link" onclick="categoriasManager.goToPage(${i})">${i}</button>
                </li>`;
            }
        }

        if (this.currentPage < totalPages) {
            html += `<li class="page-item">
                <button class="page-link" onclick="categoriasManager.nextPage()">
                    Siguiente <i class="fas fa-chevron-right"></i>
                </button>
            </li>`;
        }

        paginationControls.innerHTML = html;
    }

    // Búsqueda
    handleSearch() {
        const searchTerm = this.searchInput.value.toLowerCase();
        this.btnClearSearch.classList.toggle('active', searchTerm.length > 0);
        this.applyFilters();
    }

    clearSearch() {
        this.searchInput.value = '';
        this.btnClearSearch.classList.remove('active');
        this.applyFilters();
    }

    // Aplicar filtros
    applyFilters() {
        const searchTerm = this.searchInput.value.toLowerCase();
        const estado = this.filterEstado.value;
        const orden = this.filterOrden.value;

        this.filteredCategorias = this.categorias.filter(cat => {
            const matchSearch = cat.nombre.toLowerCase().includes(searchTerm) ||
                              cat.descripción.toLowerCase().includes(searchTerm);
            const matchEstado = !estado || cat.estado === estado;
            return matchSearch && matchEstado;
        });

        this.ordenarCategorias(orden);
        this.currentPage = 1;
        this.renderCategorias();
    }

    // Ordenar categorías
    ordenarCategorias(orden) {
        const sorted = [...this.filteredCategorias];
        switch(orden) {
            case 'nombre-asc':
                sorted.sort((a, b) => a.nombre.localeCompare(b.nombre));
                break;
            case 'nombre-desc':
                sorted.sort((a, b) => b.nombre.localeCompare(a.nombre));
                break;
            case 'productos-desc':
                sorted.sort((a, b) => b.productos - a.productos);
                break;
            case 'fecha-desc':
                sorted.sort((a, b) => new Date(b.fechaCreacion) - new Date(a.fechaCreacion));
                break;
        }
        this.filteredCategorias = sorted;
    }

    // Modal agregar
    openModalAgregar() {
        this.currentEditId = null;
        this.formCategoria.reset();
        this.modalTitle.textContent = 'Nueva Categoría';
        this.categoriaNombre.focus();
        this.alertCategoria.classList.add('d-none');
        this.modalCategoria.show();
    }

    // Editar categoría
    editCategoria(id) {
        const categoria = this.categorias.find(c => c.id === id);
        if (!categoria) return;

        this.currentEditId = id;
        this.categoriaNombre.value = categoria.nombre;
        this.categoriaDescripcion.value = categoria.descripción;
        this.categoriaColor.value = categoria.color;
        this.categoriaActivo.checked = categoria.estado === 'activo';
        this.updateColorPreview();
        this.updateEstadoLabel();
        this.updateCharCount();
        this.modalTitle.textContent = 'Editar Categoría';
        this.alertCategoria.classList.add('d-none');
        this.modalCategoria.show();
    }

    // Eliminar categoría
    deleteCategoria(id) {
        const categoria = this.categorias.find(c => c.id === id);
        if (!categoria) return;

        this.nombreEliminar.textContent = categoria.nombre;
        this.countProductos.textContent = categoria.productos;

        if (categoria.productos > 0) {
            this.productosCategoriaInfo.classList.remove('d-none');
        } else {
            this.productosCategoriaInfo.classList.add('d-none');
        }

        this.currentEditId = id;
        this.modalEliminar.show();
    }

    // Confirmar eliminar
    confirmarEliminar() {
        const btn = this.btnConfirmarEliminar;
        const btnText = btn.querySelector('.btn-text');
        const btnLoading = btn.querySelector('.btn-loading');

        btn.disabled = true;
        btnText.classList.add('d-none');
        btnLoading.classList.remove('d-none');

        // Simular eliminación
        setTimeout(() => {
            this.categorias = this.categorias.filter(c => c.id !== this.currentEditId);
            this.filteredCategorias = this.filteredCategorias.filter(c => c.id !== this.currentEditId);
            this.currentPage = 1;
            this.renderCategorias();
            this.modalEliminar.hide();
            this.showToast('Categoría eliminada correctamente', 'success');

            btn.disabled = false;
            btnText.classList.remove('d-none');
            btnLoading.classList.add('d-none');
        }, 800);
    }

    // Guardar categoría
    handleSubmit(e) {
        e.preventDefault();

        if (!this.formCategoria.checkValidity()) {
            this.formCategoria.classList.add('was-validated');
            return;
        }

        const nombre = this.categoriaNombre.value.trim();
        const descripción = this.categoriaDescripcion.value.trim();
        const color = this.categoriaColor.value;
        const activo = this.categoriaActivo.checked;

        // Validar nombre único
        if (this.categorias.some(c => c.id !== this.currentEditId && c.nombre.toLowerCase() === nombre.toLowerCase())) {
            this.showAlert('El nombre de la categoría ya existe', 'danger');
            return;
        }

        const btn = this.btnGuardarCategoria;
        const btnText = btn.querySelector('.btn-text');
        const btnLoading = btn.querySelector('.btn-loading');

        btn.disabled = true;
        btnText.classList.add('d-none');
        btnLoading.classList.remove('d-none');

        // Simular guardado en API
        setTimeout(() => {
            if (this.currentEditId) {
                // Editar
                const index = this.categorias.findIndex(c => c.id === this.currentEditId);
                if (index !== -1) {
                    this.categorias[index] = {
                        ...this.categorias[index],
                        nombre,
                        descripción,
                        color,
                        estado: activo ? 'activo' : 'inactivo'
                    };
                }
                this.showToast('Categoría actualizada correctamente', 'success');
            } else {
                // Crear nueva
                const newCategoria = {
                    id: Math.max(...this.categorias.map(c => c.id), 0) + 1,
                    nombre,
                    descripción,
                    color,
                    productos: 0,
                    estado: activo ? 'activo' : 'inactivo',
                    fechaCreacion: new Date().toISOString().split('T')[0]
                };
                this.categorias.push(newCategoria);
                this.showToast('Categoría creada correctamente', 'success');
            }

            this.applyFilters();
            this.modalCategoria.hide();

            btn.disabled = false;
            btnText.classList.remove('d-none');
            btnLoading.classList.add('d-none');
            this.formCategoria.classList.remove('was-validated');
        }, 800);
    }

    // Actualizar conteo de caracteres
    updateCharCount() {
        this.charCount.textContent = this.categoriaDescripcion.value.length;
    }

    // Actualizar color
    updateColorPreview(e) {
        const color = this.categoriaColor.value;
        this.colorPreview.style.backgroundColor = color;
        this.colorValue.textContent = color.toUpperCase();
    }

    // Actualizar estado
    updateEstadoLabel() {
        this.estadoLabel.textContent = this.categoriaActivo.checked ? 'Activo' : 'Inactivo';
    }

    // Toggle Select All
    toggleSelectAll(e) {
        const checkboxes = document.querySelectorAll('.categoria-check');
        checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
    }

    // Toggle Vista
    toggleView() {
        this.viewMode = this.viewMode === 'tabla' ? 'grid' : 'tabla';
        this.currentPage = 1;
        this.renderCategorias();
    }

    // Exportar datos
    exportarDatos() {
        const csv = [
            ['Nombre', 'Descripción', 'Productos', 'Estado', 'Creado'],
            ...this.filteredCategorias.map(cat => [
                cat.nombre,
                cat.descripción,
                cat.productos,
                cat.estado,
                cat.fechaCreacion
            ])
        ].map(row => row.map(cell => `"${cell}"`).join(',')).join('\n');

        const link = document.createElement('a');
        link.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv);
        link.download = `categorias_${new Date().toISOString().split('T')[0]}.csv`;
        link.click();

        this.showToast('Datos exportados correctamente', 'success');
    }

    // Utilidades
    formatDate(date) {
        return new Date(date).toLocaleDateString('es-ES', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
    }

    truncateText(text, length) {
        return text && text.length > length ? text.substring(0, length) + '...' : text || '-';
    }

    showAlert(message, type = 'info') {
        this.alertCategoria.className = `alert alert-${type}`;
        this.alertCategoria.innerHTML = `<i class="fas fa-info-circle me-2"></i>${message}`;
        this.alertCategoria.classList.remove('d-none');
    }

    showToast(message, type = 'info') {
        const icons = {
            success: 'fa-check-circle',
            error: 'fa-times-circle',
            warning: 'fa-exclamation-circle',
            info: 'fa-info-circle'
        };

        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = `
            <i class="fas ${icons[type]} toast-icon"></i>
            <span class="toast-message">${message}</span>
            <button class="toast-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        `;

        this.toastContainer.appendChild(toast);
        setTimeout(() => toast.remove(), 4000);
    }

    // Paginación
    previousPage() {
        if (this.currentPage > 1) {
            this.currentPage--;
            this.renderCategorias();
            window.scrollTo(0, 0);
        }
    }

    nextPage() {
        const totalPages = Math.ceil(this.filteredCategorias.length / this.itemsPerPage);
        if (this.currentPage < totalPages) {
            this.currentPage++;
            this.renderCategorias();
            window.scrollTo(0, 0);
        }
    }

    goToPage(page) {
        this.currentPage = page;
        this.renderCategorias();
        window.scrollTo(0, 0);
    }

    // Actualizar información de paginación
    updatePaginationInfo() {
        const start = (this.currentPage - 1) * this.itemsPerPage + 1;
        const end = Math.min(start + this.itemsPerPage - 1, this.filteredCategorias.length);

        this.startIndex.textContent = this.filteredCategorias.length === 0 ? 0 : start;
        this.endIndex.textContent = end;
        this.totalRecords.textContent = this.filteredCategorias.length;
    }
}

// Inicializar cuando el DOM esté listo
let categoriasManager;
document.addEventListener('DOMContentLoaded', () => {
    categoriasManager = new CategoriasManager();
});