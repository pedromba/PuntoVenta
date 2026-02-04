/**
 * VENTAS - JavaScript Handler
 * Maneja eventos, validaciones y llamadas AJAX
 */

class VentasManager {
    constructor() {
        this.elementos = {
            tableBody: document.getElementById('ventas-tbody'),
            btnNuevo: document.querySelector('[data-action="nueva-venta"]'),
            btnBuscar: document.querySelector('[data-action="buscar"]'),
            filtroEstado: document.getElementById('filtro-estado'),
            filterFechaInicio: document.getElementById('filter-fecha-inicio'),
            filterFechaFin: document.getElementById('filter-fecha-fin'),
            modalForm: document.getElementById('modalVenta'),
            formVenta: document.getElementById('formVenta')
        };
        
        this.init();
    }

    init() {
        this.bindEvents();
        this.cargarVentas();
    }

    bindEvents() {
        // Nueva venta
        if (this.elementos.btnNuevo) {
            this.elementos.btnNuevo.addEventListener('click', () => this.abrirModalNuevo());
        }

        // Búsqueda
        if (this.elementos.btnBuscar) {
            this.elementos.btnBuscar.addEventListener('click', () => this.buscar());
        }

        // Filtros
        if (this.elementos.filtroEstado) {
            this.elementos.filtroEstado.addEventListener('change', () => this.filtrar());
        }

        if (this.elementos.filterFechaInicio) {
            this.elementos.filterFechaInicio.addEventListener('change', () => this.filtrar());
        }

        if (this.elementos.filterFechaFin) {
            this.elementos.filterFechaFin.addEventListener('change', () => this.filtrar());
        }

        // Form submit
        if (this.elementos.formVenta) {
            this.elementos.formVenta.addEventListener('submit', (e) => this.guardar(e));
        }

        // Eventos delegados
        if (this.elementos.tableBody) {
            this.elementos.tableBody.addEventListener('click', (e) => this.manejadorAcciones(e));
        }
    }

    cargarVentas() {
        this.mostrarCargando();
        
        // TODO: Reemplazar con llamada AJAX
        // fetch('/admin/php/ventas.php?action=list')
        //     .then(res => res.json())
        //     .then(data => this.renderTabla(data))
        //     .catch(error => this.mostrarError('Error al cargar ventas', error));
        
        console.log('Cargando ventas...');
    }

    filtrar() {
        const estado = this.elementos.filtroEstado?.value || '';
        const fechaInicio = this.elementos.filterFechaInicio?.value || '';
        const fechaFin = this.elementos.filterFechaFin?.value || '';
        
        console.log('Filtrando:', { estado, fechaInicio, fechaFin });
        // TODO: Implementar AJAX
    }

    buscar() {
        const folio = document.querySelector('[data-search="folio"]')?.value || '';
        const cliente = document.querySelector('[data-search="cliente"]')?.value || '';
        
        console.log('Buscando:', { folio, cliente });
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
        console.log('Editando venta:', id);
        // TODO: Cargar datos AJAX
        this.abrirModalNuevo();
    }

    abrirDetalles(id) {
        console.log('Ver detalles de venta:', id);
        // TODO: Modal con detalles de líneas de venta
    }

    guardar(e) {
        e.preventDefault();
        
        const cliente = this.elementos.formVenta.querySelector('[name="cliente"]')?.value;
        const usuario = this.elementos.formVenta.querySelector('[name="usuario"]')?.value;

        if (!cliente || !usuario) {
            this.mostrarError('Validación', 'Complete los campos requeridos');
            return;
        }

        const formData = new FormData(this.elementos.formVenta);
        
        // TODO: Reemplazar con llamada AJAX
        console.log('Guardando venta...');
    }

    anularVenta(id) {
        Swal.fire({
            title: '¿Anular venta?',
            text: 'Esta venta se marcará como anulada',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Sí, anular',
            cancelButtonText: 'Cancelar'
        }).then(result => {
            if (result.isConfirmed) {
                console.log('Anulando venta:', id);
                // TODO: Implementar AJAX
            }
        });
    }

    generarFactura(id) {
        console.log('Generando factura para venta:', id);
        // TODO: Implementar AJAX para generar factura
    }

    manejadorAcciones(e) {
        const btnVer = e.target.closest('[data-action="ver"]');
        const btnEditar = e.target.closest('[data-action="editar"]');
        const btnAnular = e.target.closest('[data-action="anular"]');
        const btnFactura = e.target.closest('[data-action="factura"]');

        if (btnVer) {
            const id = btnVer.dataset.id;
            this.abrirDetalles(id);
        } else if (btnEditar) {
            const id = btnEditar.dataset.id;
            this.abrirModalEditar(id);
        } else if (btnAnular) {
            const id = btnAnular.dataset.id;
            this.anularVenta(id);
        } else if (btnFactura) {
            const id = btnFactura.dataset.id;
            this.generarFactura(id);
        }
    }

    limpiarForm() {
        if (this.elementos.formVenta) {
            this.elementos.formVenta.reset();
            this.elementos.formVenta.classList.remove('was-validated');
        }
    }

    renderTabla(data) {
        if (!this.elementos.tableBody) return;

        this.elementos.tableBody.innerHTML = data.map(venta => {
            const statusClass = {
                'completada': 'completada',
                'presupuesto': 'presupuesto',
                'anulada': 'anulada'
            }[venta.estado] || 'completada';

            return `
                <tr>
                    <td><strong>${venta.folio}</strong></td>
                    <td>${venta.cliente}</td>
                    <td>${venta.usuario}</td>
                    <td class="text-end">$${parseFloat(venta.total_neto).toFixed(2)}</td>
                    <td class="text-end">$${parseFloat(venta.total_impuestos).toFixed(2)}</td>
                    <td class="text-end venta-total">$${parseFloat(venta.total_general).toFixed(2)}</td>
                    <td>
                        <span class="metodo-pago">
                            <i class="fas ${venta.metodo_pago === 'Efectivo' ? 'fa-money-bill' : 'fa-credit-card'}"></i>
                            ${venta.metodo_pago}
                        </span>
                    </td>
                    <td>
                        <span class="venta-status ${statusClass}">
                            ${venta.estado}
                        </span>
                    </td>
                    <td>${venta.fecha}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-action" data-action="ver" data-id="${venta.id}" title="Ver">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn-action" data-action="editar" data-id="${venta.id}" title="Editar">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn-action" data-action="factura" data-id="${venta.id}" title="Factura">
                                <i class="fas fa-file-invoice"></i>
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
                    <td colspan="10" class="text-center py-4">
                        <div class="loader-spinner"></div>
                        <p class="text-muted mt-2">Cargando ventas...</p>
                    </td>
                </tr>
            `;
        }
    }

    actualizarMetricas(datos) {
        if (datos.completadas !== undefined) {
            document.getElementById('ventas-completadas').textContent = datos.completadas;
        }
        if (datos.presupuestos !== undefined) {
            document.getElementById('presupuestos').textContent = datos.presupuestos;
        }
        if (datos.anuladas !== undefined) {
            document.getElementById('ventas-anuladas').textContent = datos.anuladas;
        }
        if (datos.ingresos !== undefined) {
            document.getElementById('ingresos-venta').textContent = '$' + parseFloat(datos.ingresos).toFixed(2);
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
    window.ventasManager = new VentasManager();
});
