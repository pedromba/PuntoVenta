/**
 * PRODUCTOS - JavaScript Handler
 * Maneja eventos, validaciones y llamadas AJAX
 */

class ProductosManager {
    constructor() {
        this.elementos = {
            tableBody: document.getElementById('productos-tbody'),
            btnNuevo: document.querySelector('[data-action="nuevo-producto"]'),
            btnBuscar: document.querySelector('[data-action="buscar"]'),
            filtroCategoria: document.getElementById('filtro-categoria'),
            filtroBrand: document.getElementById('filtro-marca'),
            modalForm: document.getElementById('modalProducto'),
            formProducto: document.getElementById('formProducto')
        };
        
        this.init();
    }

    init() {
        this.bindEvents();
        this.cargarProductos();
    }

    bindEvents() {
        // Nuevo producto
        if (this.elementos.btnNuevo) {
            this.elementos.btnNuevo.addEventListener('click', () => this.abrirModalNuevo());
        }

        // Búsqueda
        if (this.elementos.btnBuscar) {
            this.elementos.btnBuscar.addEventListener('click', () => this.buscar());
        }

        // Filtros
        if (this.elementos.filtroCategoria) {
            this.elementos.filtroCategoria.addEventListener('change', () => this.filtrar());
        }

        if (this.elementos.filtroBrand) {
            this.elementos.filtroBrand.addEventListener('change', () => this.filtrar());
        }

        // Form submit
        if (this.elementos.formProducto) {
            this.elementos.formProducto.addEventListener('submit', (e) => this.guardar(e));
        }

        // Eventos delegados para acciones de fila
        if (this.elementos.tableBody) {
            this.elementos.tableBody.addEventListener('click', (e) => this.manejadorAcciones(e));
        }
    }

    cargarProductos() {
        this.mostrarCargando();
        
        // TODO: Reemplazar con llamada AJAX
        // fetch('/admin/php/productos.php?action=list')
        //     .then(res => res.json())
        //     .then(data => this.renderTabla(data))
        //     .catch(error => this.mostrarError('Error al cargar productos', error));
        
        console.log('Cargando productos...');
    }

    filtrar() {
        const categoria = this.elementos.filtroCategoria?.value || '';
        const marca = this.elementos.filtroBrand?.value || '';
        
        console.log('Filtrando por:', { categoria, marca });
        this.cargarProductos();
    }

    buscar() {
        const busqueda = document.querySelector('[data-search="productos"]')?.value || '';
        const sku = document.querySelector('[data-search="sku"]')?.value || '';
        
        console.log('Buscando:', { busqueda, sku });
        // TODO: Implementar AJAX
    }

    abrirModalNuevo() {
        if (this.elementos.modalForm) {
            this.limpiarForm();
            const modal = new bootstrap.Modal(this.elementos.modalForm);
            modal.show();
        }
    }

    abrirModalEditar(id) {
        console.log('Editando producto:', id);
        // TODO: Cargar datos AJAX y rellenar formulario
        this.abrirModalNuevo();
    }

    guardar(e) {
        e.preventDefault();
        
        if (!this.validarForm()) return;

        const formData = new FormData(this.elementos.formProducto);
        
        // TODO: Reemplazar con llamada AJAX
        // fetch('/admin/php/productos.php?action=save', {
        //     method: 'POST',
        //     body: formData
        // })
        // .then(res => res.json())
        // .then(data => {
        //     if (data.success) {
        //         this.mostrarExito('Producto guardado correctamente');
        //         bootstrap.Modal.getInstance(this.elementos.modalForm).hide();
        //         this.cargarProductos();
        //     } else {
        //         this.mostrarError('Error al guardar', data.message);
        //     }
        // });
        
        console.log('Guardando producto...');
    }

    eliminar(id) {
        Swal.fire({
            title: '¿Eliminar producto?',
            text: 'Esta acción no se puede deshacer',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then(result => {
            if (result.isConfirmed) {
                console.log('Eliminando producto:', id);
                // TODO: Implementar AJAX DELETE
            }
        });
    }

    manejadorAcciones(e) {
        const btnEditar = e.target.closest('[data-action="editar"]');
        const btnEliminar = e.target.closest('[data-action="eliminar"]');
        const btnVer = e.target.closest('[data-action="ver"]');

        if (btnEditar) {
            const id = btnEditar.dataset.id;
            this.abrirModalEditar(id);
        } else if (btnEliminar) {
            const id = btnEliminar.dataset.id;
            this.eliminar(id);
        } else if (btnVer) {
            const id = btnVer.dataset.id;
            console.log('Ver detalle:', id);
        }
    }

    validarForm() {
        const nombre = this.elementos.formProducto.querySelector('[name="nombre"]')?.value;
        const precio = this.elementos.formProducto.querySelector('[name="precio_venta"]')?.value;
        const stock = this.elementos.formProducto.querySelector('[name="stock"]')?.value;

        if (!nombre || !precio || !stock) {
            this.mostrarError('Validación', 'Complete todos los campos requeridos');
            return false;
        }

        return true;
    }

    limpiarForm() {
        if (this.elementos.formProducto) {
            this.elementos.formProducto.reset();
            this.elementos.formProducto.classList.remove('was-validated');
        }
    }

    renderTabla(data) {
        if (!this.elementos.tableBody) return;

        this.elementos.tableBody.innerHTML = data.map(producto => `
            <tr>
                <td><input type="checkbox" class="form-check-input"></td>
                <td>${producto.nombre}</td>
                <td><code>${producto.sku}</code></td>
                <td>${producto.categoria}</td>
                <td>${producto.marca}</td>
                <td><strong>${producto.stock}</strong></td>
                <td>$${parseFloat(producto.precio).toFixed(2)}</td>
                <td>
                    <span class="badge ${producto.estado === 'Activo' ? 'badge-stock-optimo' : 'badge-stock-agotado'}">
                        ${producto.estado}
                    </span>
                </td>
                <td>
                    <div class="action-buttons">
                        <button class="btn-action" data-action="ver" data-id="${producto.id}" title="Ver">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn-action" data-action="editar" data-id="${producto.id}" title="Editar">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action delete" data-action="eliminar" data-id="${producto.id}" title="Eliminar">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');
    }

    mostrarCargando() {
        if (this.elementos.tableBody) {
            this.elementos.tableBody.innerHTML = `
                <tr>
                    <td colspan="9" class="text-center py-4">
                        <div class="loader-spinner"></div>
                        <p class="text-muted mt-2">Cargando productos...</p>
                    </td>
                </tr>
            `;
        }
    }

    mostrarExito(mensaje) {
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: mensaje,
            timer: 3000,
            timerProgressBar: true
        });
    }

    mostrarError(titulo, mensaje) {
        Swal.fire({
            icon: 'error',
            title: titulo,
            text: mensaje
        });
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    window.productosManager = new ProductosManager();
});
