/**
 * FACTURAS - JavaScript Handler
 * Maneja eventos, validaciones y llamadas AJAX
 */

class FacturasManager {
    constructor() {
        this.elementos = {
            tableBody: document.getElementById('facturas-tbody'),
            btnNuevo: document.querySelector('[data-action="nueva-factura"]'),
            filterFechaInicio: document.getElementById('filter-fecha-inicio'),
            filterFechaFin: document.getElementById('filter-fecha-fin'),
            modalForm: document.getElementById('modalFactura'),
            formFactura: document.getElementById('formFactura')
        };
        
        this.init();
    }

    init() {
        this.bindEvents();
        this.cargarFacturas();
    }

    bindEvents() {
        // Nueva factura
        if (this.elementos.btnNuevo) {
            this.elementos.btnNuevo.addEventListener('click', () => this.abrirModalNuevo());
        }

        // Filtros de fecha
        if (this.elementos.filterFechaInicio) {
            this.elementos.filterFechaInicio.addEventListener('change', () => this.filtrar());
        }

        if (this.elementos.filterFechaFin) {
            this.elementos.filterFechaFin.addEventListener('change', () => this.filtrar());
        }

        // Form submit
        if (this.elementos.formFactura) {
            this.elementos.formFactura.addEventListener('submit', (e) => this.guardar(e));
        }

        // Eventos delegados
        if (this.elementos.tableBody) {
            this.elementos.tableBody.addEventListener('click', (e) => this.manejadorAcciones(e));
        }

        // Búsqueda en tiempo real
        const inputBusqueda = document.querySelector('[data-search="factura"]');
        if (inputBusqueda) {
            inputBusqueda.addEventListener('input', () => this.buscar());
        }
    }

    cargarFacturas() {
        this.mostrarCargando();
        
        // TODO: Reemplazar con llamada AJAX
        // fetch('/admin/php/facturas.php?action=list')
        //     .then(res => res.json())
        //     .then(data => {
        //         this.renderTabla(data);
        //         this.actualizarMetricas(data);
        //     })
        //     .catch(error => this.mostrarError('Error al cargar facturas', error));
        
        console.log('Cargando facturas...');
    }

    filtrar() {
        const fechaInicio = this.elementos.filterFechaInicio?.value || '';
        const fechaFin = this.elementos.filterFechaFin?.value || '';
        
        console.log('Filtrando facturas por fecha:', { fechaInicio, fechaFin });
        // TODO: Implementar AJAX
    }

    buscar() {
        const numero = document.querySelector('[data-search="factura"]')?.value || '';
        console.log('Buscando factura:', numero);
        // TODO: Implementar AJAX
    }

    abrirModalNuevo() {
        if (this.elementos.modalForm) {
            this.limpiarForm();
            const modal = new bootstrap.Modal(this.elementos.modalForm);
            modal.show();
        }
    }

    guardar(e) {
        e.preventDefault();
        
        const venta = this.elementos.formFactura.querySelector('[name="venta_id"]')?.value;
        const serie = this.elementos.formFactura.querySelector('[name="serie"]')?.value;

        if (!venta || !serie) {
            this.mostrarError('Validación', 'Complete los campos requeridos');
            return;
        }

        const formData = new FormData(this.elementos.formFactura);
        
        // TODO: Reemplazar con llamada AJAX
        console.log('Generando factura...');
    }

    descargarPDF(id, numero) {
        console.log('Descargando PDF de factura:', id);
        // TODO: Implementar descarga AJAX
        // window.open(`/admin/php/facturas.php?action=download&id=${id}`, '_blank');
    }

    verDetalles(id) {
        console.log('Ver detalles de factura:', id);
        // TODO: Modal con detalles completos de la factura
    }

    anularFactura(id) {
        Swal.fire({
            title: '¿Anular factura?',
            text: 'Se marcará como documento anulado',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Sí, anular',
            cancelButtonText: 'Cancelar'
        }).then(result => {
            if (result.isConfirmed) {
                console.log('Anulando factura:', id);
                // TODO: Implementar AJAX
            }
        });
    }

    manejadorAcciones(e) {
        const btnDescargar = e.target.closest('[data-action="descargar"]');
        const btnDetalles = e.target.closest('[data-action="detalles"]');
        const btnAnular = e.target.closest('[data-action="anular"]');

        if (btnDescargar) {
            const id = btnDescargar.dataset.id;
            const numero = btnDescargar.dataset.numero;
            this.descargarPDF(id, numero);
        } else if (btnDetalles) {
            const id = btnDetalles.dataset.id;
            this.verDetalles(id);
        } else if (btnAnular) {
            const id = btnAnular.dataset.id;
            this.anularFactura(id);
        }
    }

    limpiarForm() {
        if (this.elementos.formFactura) {
            this.elementos.formFactura.reset();
            this.elementos.formFactura.classList.remove('was-validated');
        }
    }

    renderTabla(data) {
        if (!this.elementos.tableBody) return;

        this.elementos.tableBody.innerHTML = data.map(factura => {
            const statusClass = {
                'emitida': 'emitida',
                'anulada': 'anulada',
                'pendiente': 'pendiente'
            }[factura.estado] || 'emitida';

            return `
                <tr>
                    <td><code class="numero-factura">${factura.numero_factura}</code></td>
                    <td>${factura.venta_folio || '-'}</td>
                    <td>${factura.cliente}</td>
                    <td class="text-end">$${parseFloat(factura.monto).toFixed(2)}</td>
                    <td>${factura.fecha_emision}</td>
                    <td>
                        <button class="pdf-link" data-action="descargar" data-id="${factura.id}" data-numero="${factura.numero_factura}">
                            <i class="fas fa-file-pdf"></i>
                            PDF
                        </button>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-action" data-action="detalles" data-id="${factura.id}" title="Detalles">
                                <i class="fas fa-info-circle"></i>
                            </button>
                            ${factura.estado !== 'anulada' ? `
                                <button class="btn-action delete" data-action="anular" data-id="${factura.id}" title="Anular">
                                    <i class="fas fa-ban"></i>
                                </button>
                            ` : ''}
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
                    <td colspan="7" class="text-center py-4">
                        <div class="loader-spinner"></div>
                        <p class="text-muted mt-2">Cargando facturas...</p>
                    </td>
                </tr>
            `;
        }
    }

    actualizarMetricas(datos) {
        if (datos.total !== undefined) {
            document.getElementById('total-facturas').textContent = datos.total;
        }
        if (datos.emitidas_hoy !== undefined) {
            document.getElementById('emitidas-hoy').textContent = datos.emitidas_hoy;
        }
        if (datos.ingresos !== undefined) {
            document.getElementById('ingresos-fiscales').textContent = '$' + parseFloat(datos.ingresos).toFixed(2);
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
    window.facturasManager = new FacturasManager();
});
