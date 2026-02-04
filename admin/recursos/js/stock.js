/**
 * STOCK - JavaScript Handler
 * Maneja eventos, validaciones y llamadas AJAX
 */

class StockManager {
    constructor() {
        this.elementos = {
            tableBody: document.getElementById('stock-tbody'),
            btnBajoStock: document.querySelector('[data-action="bajo-stock"]'),
            filtroEstado: document.getElementById('filtro-estado'),
            modalForm: document.getElementById('modalStock'),
            formStock: document.getElementById('formStock')
        };
        
        this.init();
    }

    init() {
        this.bindEvents();
        this.cargarStock();
    }

    bindEvents() {
        // Filtro de estado
        if (this.elementos.filtroEstado) {
            this.elementos.filtroEstado.addEventListener('change', () => this.filtrarPorEstado());
        }

        // Botón Bajo Stock
        if (this.elementos.btnBajoStock) {
            this.elementos.btnBajoStock.addEventListener('click', () => this.filtrarBajoStock());
        }

        // Form submit
        if (this.elementos.formStock) {
            this.elementos.formStock.addEventListener('submit', (e) => this.guardar(e));
        }

        // Eventos delegados
        if (this.elementos.tableBody) {
            this.elementos.tableBody.addEventListener('click', (e) => this.manejadorAcciones(e));
        }

        // Búsqueda en tiempo real
        const inputBusqueda = document.querySelector('[data-search="stock"]');
        if (inputBusqueda) {
            inputBusqueda.addEventListener('input', () => this.buscar());
        }
    }

    cargarStock() {
        this.mostrarCargando();
        
        // TODO: Reemplazar con llamada AJAX
        // fetch('/admin/php/stock.php?action=list')
        //     .then(res => res.json())
        //     .then(data => {
        //         this.renderTabla(data);
        //         this.actualizarMetricas(data);
        //     })
        //     .catch(error => this.mostrarError('Error al cargar stock', error));
        
        console.log('Cargando stock...');
    }

    filtrarPorEstado() {
        const estado = this.elementos.filtroEstado?.value || '';
        console.log('Filtrando por estado:', estado);
        // TODO: Implementar AJAX
    }

    filtrarBajoStock() {
        this.elementos.filtroEstado.value = 'bajo';
        this.filtrarPorEstado();
    }

    buscar() {
        const termino = document.querySelector('[data-search="stock"]')?.value || '';
        console.log('Buscando producto:', termino);
        // TODO: Implementar AJAX
    }

    ajustarStock(id) {
        Swal.fire({
            title: 'Ajustar Stock',
            html: `
                <div class="text-start">
                    <div class="form-group mb-3">
                        <label class="form-label">Stock Actual</label>
                        <input type="number" id="stock-actual" class="form-control" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Stock Nuevo</label>
                        <input type="number" id="stock-nuevo" class="form-control" step="1" placeholder="0">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Motivo del Ajuste</label>
                        <select id="motivo-ajuste" class="form-select">
                            <option value="">Seleccionar motivo...</option>
                            <option value="inventario">Conteo de Inventario</option>
                            <option value="rotura">Rotura/Deterioro</option>
                            <option value="perdida">Pérdida</option>
                            <option value="devolucion">Devolución</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Observaciones</label>
                        <textarea id="observaciones-ajuste" class="form-control" rows="2" placeholder="Detalles..."></textarea>
                    </div>
                </div>
            `,
            showCancelButton: true,
            confirmButtonColor: '#667eea',
            confirmButtonText: 'Guardar Ajuste',
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const motivo = document.getElementById('motivo-ajuste').value;
                const stockNuevo = document.getElementById('stock-nuevo').value;
                
                if (!motivo || stockNuevo === '') {
                    Swal.showValidationMessage('Complete todos los campos');
                    return false;
                }
                
                return {
                    stock_nuevo: stockNuevo,
                    motivo: motivo,
                    observaciones: document.getElementById('observaciones-ajuste').value
                };
            }
        }).then(result => {
            if (result.isConfirmed) {
                console.log('Ajustando stock:', id, result.value);
                // TODO: Implementar AJAX
            }
        });
    }

    verHistorial(id) {
        console.log('Ver historial de movimientos:', id);
        // TODO: Modal con historial de movimientos del producto
    }

    generarReporteStock() {
        console.log('Generando reporte de stock...');
        // TODO: Exportar a Excel/PDF
    }

    manejadorAcciones(e) {
        const btnAjustar = e.target.closest('[data-action="ajustar"]');
        const btnHistorial = e.target.closest('[data-action="historial"]');

        if (btnAjustar) {
            const id = btnAjustar.dataset.id;
            this.ajustarStock(id);
        } else if (btnHistorial) {
            const id = btnHistorial.dataset.id;
            this.verHistorial(id);
        }
    }

    renderTabla(data) {
        if (!this.elementos.tableBody) return;

        this.elementos.tableBody.innerHTML = data.map(producto => {
            const porcentajeStock = (producto.stock_actual / producto.stock_minimo) * 100;
            let statusClass = 'optimo';
            let statusTexto = 'Óptimo';

            if (porcentajeStock <= 50) {
                statusClass = 'agotado';
                statusTexto = 'Agotado';
            } else if (porcentajeStock <= 100) {
                statusClass = 'bajo';
                statusTexto = 'Bajo';
            }

            return `
                <tr>
                    <td><code>${producto.sku}</code></td>
                    <td>${producto.nombre}</td>
                    <td>${producto.categoria}</td>
                    <td>
                        <strong>${producto.stock_actual}</strong>
                        <div class="stock-progress">
                            <div class="stock-progress-bar ${statusClass}" style="width: ${Math.min(porcentajeStock, 100)}%"></div>
                        </div>
                    </td>
                    <td>${producto.stock_minimo}</td>
                    <td>
                        <span class="stock-status ${statusClass}">
                            ${statusTexto}
                        </span>
                    </td>
                    <td>$${parseFloat(producto.valor_inventario).toFixed(2)}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-action" data-action="ajustar" data-id="${producto.id}" title="Ajustar Stock">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                            <button class="btn-action" data-action="historial" data-id="${producto.id}" title="Historial">
                                <i class="fas fa-history"></i>
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
                    <td colspan="8" class="text-center py-4">
                        <div class="loader-spinner"></div>
                        <p class="text-muted mt-2">Cargando inventario...</p>
                    </td>
                </tr>
            `;
        }
    }

    actualizarMetricas(datos) {
        if (datos.total !== undefined) {
            document.getElementById('stock-total-cantidad').textContent = datos.total;
        }
        if (datos.bajo_stock !== undefined) {
            document.getElementById('bajo-stock').textContent = datos.bajo_stock;
        }
        if (datos.sin_stock !== undefined) {
            document.getElementById('sin-stock').textContent = datos.sin_stock;
        }
        if (datos.rotacion !== undefined) {
            document.getElementById('rotacion-promedio').textContent = (datos.rotacion).toFixed(2);
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
    window.stockManager = new StockManager();
});
