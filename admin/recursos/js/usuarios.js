/**
 * USUARIOS - JavaScript Handler
 * Maneja eventos, validaciones y llamadas AJAX
 */

class UsuariosManager {
    constructor() {
        this.elementos = {
            tableBody: document.getElementById('usuarios-tbody'),
            btnNuevo: document.querySelector('[data-action="nuevo-usuario"]'),
            filtroRol: document.getElementById('filtro-rol'),
            filtroEstado: document.getElementById('filtro-estado'),
            modalForm: document.getElementById('modalUsuario'),
            formUsuario: document.getElementById('formUsuario')
        };
        
        this.roles = {
            'superadmin': 'Superadministrador',
            'admin': 'Administrador',
            'finanzas': 'Finanzas',
            'almacen': 'Almacén',
            'vendedor': 'Vendedor'
        };

        this.init();
    }

    init() {
        this.bindEvents();
        this.cargarUsuarios();
    }

    bindEvents() {
        // Nuevo usuario
        if (this.elementos.btnNuevo) {
            this.elementos.btnNuevo.addEventListener('click', () => this.abrirModalNuevo());
        }

        // Filtros
        if (this.elementos.filtroRol) {
            this.elementos.filtroRol.addEventListener('change', () => this.filtrar());
        }

        if (this.elementos.filtroEstado) {
            this.elementos.filtroEstado.addEventListener('change', () => this.filtrar());
        }

        // Form submit
        if (this.elementos.formUsuario) {
            this.elementos.formUsuario.addEventListener('submit', (e) => this.guardar(e));
        }

        // Eventos delegados
        if (this.elementos.tableBody) {
            this.elementos.tableBody.addEventListener('click', (e) => this.manejadorAcciones(e));
        }

        // Búsqueda
        const inputBusqueda = document.querySelector('[data-search="usuarios"]');
        if (inputBusqueda) {
            inputBusqueda.addEventListener('input', () => this.buscar());
        }

        // Validar contraseña
        const inputPassword = this.elementos.formUsuario?.querySelector('[name="password"]');
        if (inputPassword) {
            inputPassword.addEventListener('input', (e) => this.validarFuerzaContraseña(e.target.value));
        }
    }

    cargarUsuarios() {
        this.mostrarCargando();
        
        // TODO: Reemplazar con llamada AJAX
        // fetch('/admin/php/usuarios.php?action=list')
        //     .then(res => res.json())
        //     .then(data => {
        //         this.renderTabla(data);
        //         this.actualizarMetricas(data);
        //     })
        //     .catch(error => this.mostrarError('Error al cargar usuarios', error));
        
        console.log('Cargando usuarios...');
    }

    filtrar() {
        const rol = this.elementos.filtroRol?.value || '';
        const estado = this.elementos.filtroEstado?.value || '';
        
        console.log('Filtrando usuarios:', { rol, estado });
        // TODO: Implementar AJAX
    }

    buscar() {
        const termino = document.querySelector('[data-search="usuarios"]')?.value || '';
        console.log('Buscando usuario:', termino);
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
        console.log('Editando usuario:', id);
        // TODO: Cargar datos AJAX y rellenar formulario
        this.abrirModalNuevo();
    }

    guardar(e) {
        e.preventDefault();
        
        const nombre = this.elementos.formUsuario.querySelector('[name="nombre"]')?.value;
        const email = this.elementos.formUsuario.querySelector('[name="email"]')?.value;
        const rol = this.elementos.formUsuario.querySelector('[name="rol"]')?.value;

        if (!nombre || !email || !rol) {
            this.mostrarError('Validación', 'Complete los campos requeridos');
            return;
        }

        if (!this.validarEmail(email)) {
            this.mostrarError('Validación', 'Email inválido');
            return;
        }

        const formData = new FormData(this.elementos.formUsuario);
        
        // TODO: Reemplazar con llamada AJAX
        console.log('Guardando usuario...');
    }

    desactivarUsuario(id) {
        Swal.fire({
            title: '¿Desactivar usuario?',
            text: 'El usuario no podrá acceder al sistema',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Sí, desactivar',
            cancelButtonText: 'Cancelar'
        }).then(result => {
            if (result.isConfirmed) {
                console.log('Desactivando usuario:', id);
                // TODO: Implementar AJAX
            }
        });
    }

    resetearPassword(id) {
        Swal.fire({
            title: 'Resetear Contraseña',
            text: 'Se enviará un email con instrucciones al usuario',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#667eea',
            confirmButtonText: 'Enviar',
            cancelButtonText: 'Cancelar'
        }).then(result => {
            if (result.isConfirmed) {
                console.log('Reseteando contraseña del usuario:', id);
                // TODO: Implementar AJAX
            }
        });
    }

    manejadorAcciones(e) {
        const btnEditar = e.target.closest('[data-action="editar"]');
        const btnDesactivar = e.target.closest('[data-action="desactivar"]');
        const btnPassword = e.target.closest('[data-action="password"]');

        if (btnEditar) {
            const id = btnEditar.dataset.id;
            this.abrirModalEditar(id);
        } else if (btnDesactivar) {
            const id = btnDesactivar.dataset.id;
            this.desactivarUsuario(id);
        } else if (btnPassword) {
            const id = btnPassword.dataset.id;
            this.resetearPassword(id);
        }
    }

    limpiarForm() {
        if (this.elementos.formUsuario) {
            this.elementos.formUsuario.reset();
            this.elementos.formUsuario.classList.remove('was-validated');
            
            // Limpiar indicador de fuerza de contraseña
            const strengthBar = this.elementos.formUsuario.querySelector('.password-strength-bar');
            if (strengthBar) {
                strengthBar.className = 'password-strength-bar';
                strengthBar.style.width = '0%';
            }
        }
    }

    renderTabla(data) {
        if (!this.elementos.tableBody) return;

        this.elementos.tableBody.innerHTML = data.map(usuario => {
            const roleClass = usuario.rol.toLowerCase();

            return `
                <tr>
                    <td><input type="checkbox" class="form-check-input"></td>
                    <td>
                        <div class="usuario-card">
                            <div class="usuario-avatar" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                                ${usuario.nombre.charAt(0)}
                            </div>
                            <div class="usuario-info">
                                <div class="usuario-nombre">${usuario.nombre}</div>
                                <div class="usuario-email">${usuario.email}</div>
                            </div>
                        </div>
                    </td>
                    <td>${usuario.empresa}</td>
                    <td>
                        <span class="role-badge ${roleClass}">
                            ${this.roles[usuario.rol] || usuario.rol}
                        </span>
                    </td>
                    <td>
                        <span class="usuario-status ${usuario.activo ? 'activo' : 'inactivo'}">
                            <i class="fas ${usuario.activo ? 'fa-check-circle' : 'fa-times-circle'}"></i>
                            ${usuario.activo ? 'Activo' : 'Inactivo'}
                        </span>
                    </td>
                    <td>
                        <span class="ultimo-acceso ${!usuario.ultimo_acceso ? 'nunca' : ''}">
                            ${usuario.ultimo_acceso || 'Nunca'}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-action" data-action="editar" data-id="${usuario.id}" title="Editar">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn-action" data-action="password" data-id="${usuario.id}" title="Reset Password">
                                <i class="fas fa-key"></i>
                            </button>
                            <button class="btn-action delete" data-action="desactivar" data-id="${usuario.id}" title="Desactivar">
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
                    <td colspan="7" class="text-center py-4">
                        <div class="loader-spinner"></div>
                        <p class="text-muted mt-2">Cargando usuarios...</p>
                    </td>
                </tr>
            `;
        }
    }

    actualizarMetricas(datos) {
        if (datos.total !== undefined) {
            document.getElementById('total-usuarios').textContent = datos.total;
        }
        if (datos.activos !== undefined) {
            document.getElementById('usuarios-activos').textContent = datos.activos;
        }
        if (datos.inactivos !== undefined) {
            document.getElementById('usuarios-inactivos').textContent = datos.inactivos;
        }
        if (datos.administradores !== undefined) {
            document.getElementById('total-admins').textContent = datos.administradores;
        }
    }

    validarFuerzaContraseña(password) {
        const strengthBar = this.elementos.formUsuario.querySelector('.password-strength-bar');
        if (!strengthBar) return;

        let strength = 0;
        
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;
        if (password.match(/[^a-zA-Z0-9]/)) strength++;

        strengthBar.className = 'password-strength-bar';
        
        if (strength <= 1) {
            strengthBar.classList.add('weak');
            strengthBar.style.width = '33%';
        } else if (strength === 2) {
            strengthBar.classList.add('medium');
            strengthBar.style.width = '66%';
        } else {
            strengthBar.classList.add('strong');
            strengthBar.style.width = '100%';
        }
    }

    validarEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
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
    window.usuariosManager = new UsuariosManager();
});
