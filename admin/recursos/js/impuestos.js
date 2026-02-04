/**
 * IMPUESTOS - JavaScript Handler
 * Maneja eventos, validaciones y llamadas AJAX
 */

class ImputesManager {
    constructor() {
        this.elementos = {
            tableBody: document.getElementById('impuestos-tbody'),
            btnNuevo: document.querySelector('[data-action="nuevo-impuesto"]'),
            filtroEstado: document.getElementById('filtro-estado'),
            modalForm: document.getElementById('modalImpuesto'),
            formImpuesto: document.getElementById('formImpuesto')
        };
        
        this.init();
    }

    init() {
        this.bindEvents();
        this.cargarImpuestos();
    }

    bindEvents() {
        // Nuevo impuesto
        if (this.elementos.btnNuevo) {
            this.elementos.btnNuevo.addEventListener('click', () => this.abrirModalNuevo());
        }

        // Filtro estado
        if (this.elementos.filtroEstado) {
            this.elementos.filtroEstado.addEventListener('change', () => this.filtrar());
        }

        // Form submit
        if (this.elementos.formImpuesto) {
            this.elementos.formImpuesto.addEventListener('submit', (e) => this.guardar(e));
        }

        // Eventos delegados
        if (this.elementos.tableBody) {
            this.elementos.tableBody.addEventListener('click', (e) => this.manejadorAcciones(e));
        }

        // Validar porcentaje en tiempo real
        const inputPorcentaje = this.elementos.formImpuesto?.querySelector('[name="porcentaje"]');
        if (inputPorcentaje) {
            inputPorcentaje.addEventListener('input', (e) => this.actualizarPreview());
        }

        // Búsqueda
        const inputBusqueda = document.querySelector('[data-search="impuestos"]');
        if (inputBusqueda) {
            inputBusqueda.addEventListener('input', () => this.buscar());
        }
    }

    cargarImpuestos() {
        this.mostrarCargando();
        
        // TODO: Reemplazar con llamada AJAX
        // fetch('/admin/php/impuestos.php?action=list')
        //     .then(res => res.json())
        //     .then(data => {
        //         this.renderTabla(data);
        //         this.actualizarMetricas(data);
        //     })
        //     .catch(error => this.mostrarError('Error al cargar impuestos', error));
        
        console.log('Cargando impuestos...');
    }

    filtrar() {
        const estado = this.elementos.filtroEstado?.value || '';
        console.log('Filtrando impuestos por estado:', estado);
        // TODO: Implementar AJAX
    }

    buscar() {
        const termino = document.querySelector('[data-search="impuestos"]')?.value || '';
        console.log('Buscando impuesto:', termino);
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
        console.log('Editando impuesto:', id);
        // TODO: Cargar datos AJAX y rellenar formulario
        this.abrirModalNuevo();
    }

    guardar(e) {
        e.preventDefault();
        
        const nombre = this.elementos.formImpuesto.querySelector('[name="nombre"]')?.value;
        const porcentaje = this.elementos.formImpuesto.querySelector('[name="porcentaje"]')?.value;

        if (!nombre || !porcentaje) {
            this.mostrarError('Validación', 'Complete todos los campos');
            return;
        }

        if (porcentaje < 0 || porcentaje > 100) {
            this.mostrarError('Validación', 'El porcentaje debe estar entre 0 y 100');
            return;
        }

        const formData = new FormData(this.elementos.formImpuesto);
        
        // TODO: Reemplazar con llamada AJAX
        console.log('Guardando impuesto...');
    }

    desactivarImpuesto(id) {
        Swal.fire({
            title: '¿Desactivar impuesto?',
            text: 'No se aplicará a nuevas transacciones',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Sí, desactivar',
            cancelButtonText: 'Cancelar'
        }).then(result => {
            if (result.isConfirmed) {
                console.log('Desactivando impuesto:', id);
                // TODO: Implementar AJAX
            }
        });
    }

    manejadorAcciones(e) {
        const btnEditar = e.target.closest('[data-action="editar"]');
        const btnDesactivar = e.target.closest('[data-action="desactivar"]');

        if (btnEditar) {
            const id = btnEditar.dataset.id;
            this.abrirModalEditar(id);
        } else if (btnDesactivar) {
            const id = btnDesactivar.dataset.id;
            this.desactivarImpuesto(id);
        }
    }

    limpiarForm() {
        if (this.elementos.formImpuesto) {
            this.elementos.formImpuesto.reset();
            this.elementos.formImpuesto.classList.remove('was-validated');
            this.actualizarPreview();
        }
    }

    actualizarPreview() {
        const nombre = this.elementos.formImpuesto?.querySelector('[name="nombre"]')?.value || 'Nuevo Impuesto';
        const porcentaje = this.elementos.formImpuesto?.querySelector('[name="porcentaje"]')?.value || 0;
        const barraWidth = Math.min(porcentaje * 5, 100);

        // Actualizar preview visual
        const barraLleno = this.elementos.formImpuesto?.querySelector('.porcentaje-bar-fill');
        if (barraLleno) {
            barraLleno.style.width = barraWidth + '%';
        }

        // Ejemplo de cálculo
        const inputEjemplo = this.elementos.formImpuesto?.querySelector('[data-calculate-example]');
        if (inputEjemplo && inputEjemplo.value) {
            const monto = parseFloat(inputEjemplo.value) || 0;
            const resultado = monto * (porcentaje / 100);
            
            const resultElement = this.elementos.formImpuesto?.querySelector('[data-resultado]');
            if (resultElement) {
                resultElement.textContent = '$' + resultado.toFixed(2);
            }
        }
    }

    renderTabla(data) {
        if (!this.elementos.tableBody) return;

        this.elementos.tableBody.innerHTML = data.map(impuesto => {
            const barraWidth = Math.min(impuesto.porcentaje * 5, 100);

            return `
                <tr>
                    <td><input type="checkbox" class="form-check-input"></td>
                    <td class="impuesto-nombre">${impuesto.nombre}</td>
                    <td>
                        <div class="porcentaje-display">
                            <span class="porcentaje-valor">${parseFloat(impuesto.porcentaje).toFixed(2)}</span>
                            <span class="porcentaje-simbolo">%</span>
                        </div>
                        <div class="porcentaje-bar">
                            <div class="porcentaje-bar-fill" style="width: ${barraWidth}%"></div>
                        </div>
                    </td>
                    <td>
                        <span class="impuesto-status ${impuesto.activo ? 'activo' : 'inactivo'}">
                            <i class="fas ${impuesto.activo ? 'fa-check-circle' : 'fa-times-circle'}"></i>
                            ${impuesto.activo ? 'Activo' : 'Inactivo'}
                        </span>
                    </td>
                    <td><span class="fecha-impuesto">${impuesto.fecha_creacion}</span></td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-action" data-action="editar" data-id="${impuesto.id}" title="Editar">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn-action delete" data-action="desactivar" data-id="${impuesto.id}" title="Desactivar">
                                <i class="fas fa-ban"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        }).join('');
    }

    mostrarCargando() {
        if (this.elementos.tableBody) {
            this.elementos.tableBody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center py-4">
                        <div class="loader-spinner"></div>
                        <p class="text-muted mt-2">Cargando impuestos...</p>
                    </td>
                </tr>
            `;
        }
    }

    actualizarMetricas(datos) {
        if (datos.total !== undefined) {
            document.getElementById('total-impuestos').textContent = datos.total;
        }
        if (datos.activos !== undefined) {
            document.getElementById('impuestos-activos').textContent = datos.activos;
        }
        if (datos.tasa_promedio !== undefined) {
            document.getElementById('tasa-promedio').textContent = parseFloat(datos.tasa_promedio).toFixed(2) + '%';
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
    window.imputesManager = new ImputesManager();
});
