/**
 * MOVIMIENTOS - JavaScript Handler
 * Maneja eventos de movimientos de stock
 */

class MovimientosManager {
    constructor() {
        this.elementos = {
            tableBody: document.getElementById('movimientos-tbody'),
            filtroTipo: document.getElementById('filtro-tipo'),
            filterFechaInicio: document.getElementById('filter-fecha-inicio'),
            filterFechaFin: document.getElementById('filter-fecha-fin'),
            modalForm: document.getElementById('modalMovimiento'),
            formMovimiento: document.getElementById('formMovimiento')
        };
        
        this.tiposMovimiento = {
            'entrada_compra': 'Entrada por Compra',
            'salida_venta': 'Salida por Venta',
            'devolucion': 'Devolución',
            'ajuste_inventario': 'Ajuste de Inventario'
        };

        this.init();
    }

    init() {
        this.bindEvents();
        this.cargarMovimientos();
    }

    bindEvents() {
        // Filtro tipo movimiento
        if (this.elementos.filtroTipo) {
            this.elementos.filtroTipo.addEventListener('change', () => this.filtrar());
        }

        // Filtros de fecha
        if (this.elementos.filterFechaInicio) {
            this.elementos.filterFechaInicio.addEventListener('change', () => this.filtrar());
        }

        if (this.elementos.filterFechaFin) {
            this.elementos.filterFechaFin.addEventListener('change', () => this.filtrar());
        }

        // Form submit
        if (this.elementos.formMovimiento) {
            this.elementos.formMovimiento.addEventListener('submit', (e) => this.guardar(e));
        }

        // Eventos delegados
        if (this.elementos.tableBody) {
            this.elementos.tableBody.addEventListener('click', (e) => this.manejadorAcciones(e));
        }

        // Click en tarjetas de tipo movimiento
        document.querySelectorAll('[data-movement-type]').forEach(card => {
            card.addEventListener('click', () => {
                const tipo = card.dataset.movementType;
                this.elementos.filtroTipo.value = tipo;
                this.filtrar();
            });
        });
    }

    cargarMovimientos() {
        this.mostrarCargando();
        
        // TODO: Reemplazar con llamada AJAX
        // fetch('/admin/php/movimientos.php?action=list')
        //     .then(res => res.json())
        //     .then(data => {
        //         this.renderTabla(data);
        //         this.actualizarMetricas(data);
        //     })
        //     .catch(error => this.mostrarError('Error al cargar movimientos', error));
        
        console.log('Cargando movimientos...');
    }

    filtrar() {
        const tipo = this.elementos.filtroTipo?.value || '';
        const fechaInicio = this.elementos.filterFechaInicio?.value || '';
        const fechaFin = this.elementos.filterFechaFin?.value || '';
        
        console.log('Filtrando movimientos:', { tipo, fechaInicio, fechaFin });
        // TODO: Implementar AJAX
    }

    verDetalles(id) {
        console.log('Ver detalles del movimiento:', id);
        // TODO: Modal con detalles del movimiento
    }

    deshacer(id) {
        Swal.fire({
            title: '¿Deshacer movimiento?',
            text: 'Se revertirán los cambios en el stock',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Sí, deshacer',
            cancelButtonText: 'Cancelar'
        }).then(result => {
            if (result.isConfirmed) {
                console.log('Deshaciendo movimiento:', id);
                // TODO: Implementar AJAX
            }
        });
    }

    manejadorAcciones(e) {
        const btnDetalles = e.target.closest('[data-action="detalles"]');
        const btnDeshacer = e.target.closest('[data-action="deshacer"]');

        if (btnDetalles) {
            const id = btnDetalles.dataset.id;
            this.verDetalles(id);
        } else if (btnDeshacer) {
            const id = btnDeshacer.dataset.id;
            this.deshacer(id);
        }
    }

    renderTabla(data) {
        if (!this.elementos.tableBody) return;

        this.elementos.tableBody.innerHTML = data.map(mov => {
            const tipoClass = mov.tipo_movimiento.replace('_', '-');
            const tipoTexto = this.tiposMovimiento[mov.tipo_movimiento] || mov.tipo_movimiento;

            return `
                <tr>
                    <td>${mov.producto}</td>
                    <td>
                        <span class="tipo-movimiento ${tipoClass}">
                            <i class="fas ${this.getIconoTipo(mov.tipo_movimiento)}"></i>
                            ${tipoTexto}
                        </span>
                    </td>
                    <td>
                        <strong class="cantidad-movimiento ${tipoClass === 'entrada-compra' ? 'entrada' : 'salida'}">
                            ${mov.tipo_movimiento.includes('entrada') ? '+' : '-'}${mov.cantidad}
                        </strong>
                    </td>
                    <td>
                        <code class="referencia-movimiento">${mov.referencia}</code>
                    </td>
                    <td>
                        <div class="usuario-movimiento">
                            <div class="usuario-avatar">${mov.usuario.charAt(0)}</div>
                            <div class="usuario-nombre">${mov.usuario}</div>
                        </div>
                    </td>
                    <td><span class="fecha-movimiento">${mov.fecha}</span></td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-action" data-action="detalles" data-id="${mov.id}" title="Detalles">
                                <i class="fas fa-info-circle"></i>
                            </button>
                            <button class="btn-action delete" data-action="deshacer" data-id="${mov.id}" title="Deshacer">
                                <i class="fas fa-undo"></i>
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
                    <td colspan="7" class="text-center py-4">
                        <div class="loader-spinner"></div>
                        <p class="text-muted mt-2">Cargando movimientos...</p>
                    </td>
                </tr>
            `;
        }
    }

    actualizarMetricas(datos) {
        if (datos.entrada_compra !== undefined) {
            document.getElementById('entradas-compra').textContent = datos.entrada_compra;
        }
        if (datos.salida_venta !== undefined) {
            document.getElementById('salidas-venta').textContent = datos.salida_venta;
        }
        if (datos.devolucion !== undefined) {
            document.getElementById('devoluciones').textContent = datos.devolucion;
        }
        if (datos.ajuste_inventario !== undefined) {
            document.getElementById('ajustes-inventario').textContent = datos.ajuste_inventario;
        }
    }

    getIconoTipo(tipo) {
        const iconos = {
            'entrada_compra': 'fa-arrow-down',
            'salida_venta': 'fa-arrow-up',
            'devolucion': 'fa-undo',
            'ajuste_inventario': 'fa-sync-alt'
        };
        return iconos[tipo] || 'fa-box';
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
    window.movimientosManager = new MovimientosManager();
});
