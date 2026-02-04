/**
 * CAJAS - JavaScript Handler
 * Maneja eventos de cajas, cierre y arqueo
 */

class CajasManager {
    constructor() {
        this.elementos = {
            tableBody: document.getElementById('cajas-tbody'),
            btnAbrirCaja: document.querySelector('[data-action="abrir-caja"]'),
            btnNuevo: document.querySelector('[data-action="nueva-caja"]'),
            modalForm: document.getElementById('modalCaja'),
            formCaja: document.getElementById('formCaja')
        };
        
        this.init();
    }

    init() {
        this.bindEvents();
        this.cargarCajas();
    }

    bindEvents() {
        // Abrir caja
        if (this.elementos.btnAbrirCaja) {
            this.elementos.btnAbrirCaja.addEventListener('click', () => this.abrirCaja());
        }

        if (this.elementos.btnNuevo) {
            this.elementos.btnNuevo.addEventListener('click', () => this.abrirModalNuevo());
        }

        // Form submit
        if (this.elementos.formCaja) {
            this.elementos.formCaja.addEventListener('submit', (e) => this.guardar(e));
        }

        // Eventos delegados
        if (this.elementos.tableBody) {
            this.elementos.tableBody.addEventListener('click', (e) => this.manejadorAcciones(e));
        }
    }

    cargarCajas() {
        this.mostrarCargando();
        
        // TODO: Reemplazar con llamada AJAX
        // fetch('/admin/php/cajas.php?action=list')
        //     .then(res => res.json())
        //     .then(data => {
        //         this.renderTabla(data);
        //         this.actualizarMetricas(data);
        //     })
        //     .catch(error => this.mostrarError('Error al cargar cajas', error));
        
        console.log('Cargando cajas...');
    }

    abrirCaja() {
        Swal.fire({
            title: 'Abrir Nueva Caja',
            html: `
                <div class="text-start">
                    <div class="form-group mb-3">
                        <label class="form-label">Usuario</label>
                        <input type="text" id="usuario-caja" class="form-control" disabled value="Mi Usuario">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Monto de Apertura</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" id="monto-apertura" class="form-control" step="0.01" placeholder="0.00" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Observaciones</label>
                        <textarea id="observaciones-caja" class="form-control" rows="3" placeholder="Notas iniciales..."></textarea>
                    </div>
                </div>
            `,
            showCancelButton: true,
            confirmButtonColor: '#3b82f6',
            confirmButtonText: 'Abrir Caja',
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const monto = document.getElementById('monto-apertura').value;
                if (!monto || monto <= 0) {
                    Swal.showValidationMessage('Ingrese un monto válido');
                    return false;
                }
                return {
                    monto: monto,
                    observaciones: document.getElementById('observaciones-caja').value
                };
            }
        }).then(result => {
            if (result.isConfirmed) {
                console.log('Abriendo caja con monto:', result.value.monto);
                // TODO: Implementar AJAX
                this.mostrarExito('Caja abierta correctamente');
                this.cargarCajas();
            }
        });
    }

    cerrarCaja(id) {
        Swal.fire({
            title: 'Cerrar y Arquear Caja',
            html: `
                <div class="text-start">
                    <div class="form-group mb-3">
                        <label class="form-label">Monto Cierre Físico</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" id="monto-cierre" class="form-control" step="0.01" placeholder="0.00" required>
                        </div>
                        <small class="text-muted">Total en efectivo contado</small>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Observaciones de Cierre</label>
                        <textarea id="observaciones-cierre" class="form-control" rows="3" placeholder="Detalles del arqueo..."></textarea>
                    </div>
                </div>
            `,
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            confirmButtonText: 'Cerrar Caja',
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const monto = document.getElementById('monto-cierre').value;
                if (!monto || monto < 0) {
                    Swal.showValidationMessage('Ingrese un monto válido');
                    return false;
                }
                return {
                    monto: monto,
                    observaciones: document.getElementById('observaciones-cierre').value
                };
            }
        }).then(result => {
            if (result.isConfirmed) {
                console.log('Cerrando caja:', id, result.value);
                // TODO: Implementar AJAX
            }
        });
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
        console.log('Guardando caja...');
        // TODO: Implementar AJAX
    }

    manejadorAcciones(e) {
        const btnCerrar = e.target.closest('[data-action="cerrar"]');
        const btnDetalles = e.target.closest('[data-action="detalles"]');
        const btnReporte = e.target.closest('[data-action="reporte"]');

        if (btnCerrar) {
            const id = btnCerrar.dataset.id;
            this.cerrarCaja(id);
        } else if (btnDetalles) {
            const id = btnDetalles.dataset.id;
            console.log('Ver detalles de caja:', id);
        } else if (btnReporte) {
            const id = btnReporte.dataset.id;
            console.log('Reporte de caja:', id);
        }
    }

    limpiarForm() {
        if (this.elementos.formCaja) {
            this.elementos.formCaja.reset();
            this.elementos.formCaja.classList.remove('was-validated');
        }
    }

    renderTabla(data) {
        if (!this.elementos.tableBody) return;

        this.elementos.tableBody.innerHTML = data.map(caja => {
            const statusClass = caja.estado === 'abierta' ? 'abierta' : 'cerrada';
            const diferencia = parseFloat(caja.diferencia || 0);
            const diferenciaClass = diferencia === 0 ? 'positiva' : (diferencia > 0 ? 'positiva' : 'negativa');

            return `
                <tr>
                    <td>${caja.usuario}</td>
                    <td class="monto-display">$${parseFloat(caja.monto_apertura).toFixed(2)}</td>
                    <td class="monto-display">$${parseFloat(caja.monto_cierre_sistema || 0).toFixed(2)}</td>
                    <td class="monto-display">$${parseFloat(caja.monto_cierre_fisico || 0).toFixed(2)}</td>
                    <td>
                        <span class="monto-diferencia ${diferenciaClass}">
                            ${diferencia >= 0 ? '+' : ''}$${diferencia.toFixed(2)}
                        </span>
                    </td>
                    <td>
                        <span class="caja-status ${statusClass}">
                            ${caja.estado === 'abierta' ? '<i class="fas fa-unlock-alt"></i>' : '<i class="fas fa-lock"></i>'}
                            ${caja.estado === 'abierta' ? 'Abierta' : 'Cerrada'}
                        </span>
                    </td>
                    <td>${caja.fecha_apertura}</td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-action" data-action="detalles" data-id="${caja.id}" title="Detalles">
                                <i class="fas fa-info-circle"></i>
                            </button>
                            ${caja.estado === 'abierta' ? `
                                <button class="btn-action" data-action="cerrar" data-id="${caja.id}" title="Cerrar">
                                    <i class="fas fa-times"></i>
                                </button>
                            ` : `
                                <button class="btn-action" data-action="reporte" data-id="${caja.id}" title="Reporte">
                                    <i class="fas fa-file-pdf"></i>
                                </button>
                            `}
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
                        <p class="text-muted mt-2">Cargando cajas...</p>
                    </td>
                </tr>
            `;
        }
    }

    actualizarMetricas(datos) {
        if (datos.abiertas !== undefined) {
            document.getElementById('cajas-abiertas').textContent = datos.abiertas;
        }
        if (datos.cerradas !== undefined) {
            document.getElementById('cajas-cerradas').textContent = datos.cerradas;
        }
        if (datos.arqueos_correctos !== undefined) {
            document.getElementById('arqueos-correctos').textContent = datos.arqueos_correctos;
        }
        if (datos.diferencias !== undefined) {
            document.getElementById('diferencias').textContent = datos.diferencias;
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
    window.cajasManager = new CajasManager();
});
