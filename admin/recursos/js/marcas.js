/**
 * MARCAS - JavaScript Handler
 * Maneja eventos, validaciones y llamadas AJAX
 */

class MarcasManager {
    constructor() {
        this.elementos = {
            tableBody: document.getElementById('marcas-tbody'),
            btnNuevo: document.querySelector('[data-action="nueva-marca"]'),
            btnBuscar: document.querySelector('[data-action="buscar"]'),
            modalForm: document.getElementById('modalMarca'),
            formMarca: document.getElementById('formMarca')
        };
        
        this.init();
    }

    init() {
        this.bindEvents();
        this.cargarMarcas();
    }

    bindEvents() {
        // Nueva marca
        if (this.elementos.btnNuevo) {
            this.elementos.btnNuevo.addEventListener('click', () => this.abrirModalNuevo());
        }

        // Búsqueda
        if (this.elementos.btnBuscar) {
            this.elementos.btnBuscar.addEventListener('click', () => this.buscar());
        }

        // Form submit
        if (this.elementos.formMarca) {
            this.elementos.formMarca.addEventListener('submit', (e) => this.guardar(e));
        }

        // Eventos delegados
        if (this.elementos.tableBody) {
            this.elementos.tableBody.addEventListener('click', (e) => this.manejadorAcciones(e));
        }

        // Búsqueda en tiempo real
        const inputBusqueda = document.querySelector('[data-search="marcas"]');
        if (inputBusqueda) {
            inputBusqueda.addEventListener('input', () => this.buscar());
        }
    }

    cargarMarcas() {
        this.mostrarCargando();
        
        // TODO: Reemplazar con llamada AJAX
        // fetch('/admin/php/marcas.php?action=list')
        //     .then(res => res.json())
        //     .then(data => this.renderTabla(data))
        //     .catch(error => this.mostrarError('Error al cargar marcas', error));
        
        console.log('Cargando marcas...');
    }

    buscar() {
        const termino = document.querySelector('[data-search="marcas"]')?.value || '';
        console.log('Buscando marca:', termino);
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
        console.log('Editando marca:', id);
        // TODO: Cargar datos AJAX
        this.abrirModalNuevo();
    }

    guardar(e) {
        e.preventDefault();
        
        const nombre = this.elementos.formMarca.querySelector('[name="nombre"]')?.value;
        
        if (!nombre) {
            this.mostrarError('Validación', 'El nombre de la marca es requerido');
            return;
        }

        const formData = new FormData(this.elementos.formMarca);
        
        // TODO: Reemplazar con llamada AJAX
        console.log('Guardando marca...');
    }

    eliminar(id) {
        Swal.fire({
            title: '¿Eliminar marca?',
            text: 'Se eliminarán los productos asociados',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then(result => {
            if (result.isConfirmed) {
                console.log('Eliminando marca:', id);
                // TODO: Implementar AJAX
            }
        });
    }

    manejadorAcciones(e) {
        const btnEditar = e.target.closest('[data-action="editar"]');
        const btnEliminar = e.target.closest('[data-action="eliminar"]');

        if (btnEditar) {
            const id = btnEditar.dataset.id;
            this.abrirModalEditar(id);
        } else if (btnEliminar) {
            const id = btnEliminar.dataset.id;
            this.eliminar(id);
        }
    }

    limpiarForm() {
        if (this.elementos.formMarca) {
            this.elementos.formMarca.reset();
            this.elementos.formMarca.classList.remove('was-validated');
        }
    }

    renderTabla(data) {
        if (!this.elementos.tableBody) return;

        this.elementos.tableBody.innerHTML = data.map(marca => `
            <tr>
                <td><input type="checkbox" class="form-check-input"></td>
                <td>${marca.nombre}</td>
                <td>
                    <span class="product-count">
                        <i class="fas fa-box"></i>
                        ${marca.productos_count}
                    </span>
                </td>
                <td>${marca.fecha_registro}</td>
                <td>
                    <div class="action-buttons">
                        <button class="btn-action" data-action="editar" data-id="${marca.id}" title="Editar">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-action delete" data-action="eliminar" data-id="${marca.id}" title="Eliminar">
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
                    <td colspan="5" class="text-center py-4">
                        <div class="loader-spinner"></div>
                        <p class="text-muted mt-2">Cargando marcas...</p>
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
    window.marcasManager = new MarcasManager();
});
