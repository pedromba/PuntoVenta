/**
 * GESTIÓN DE USUARIOS CON ROLES MÚLTIPLES
 * Sistema PuntoVenta
 */

// Variables globales
let rolesDisponibles = [];
let rolesSeleccionados = [];

// =============================================
// INICIALIZACIÓN
// =============================================

document.addEventListener('DOMContentLoaded', function() {
    cargarRolesDisponibles();
    cargarUsuarios();
    configurarEventos();
});

// =============================================
// CARGAR ROLES DISPONIBLES
// =============================================

async function cargarRolesDisponibles() {
    try {
        const response = await fetch('php/usuarios/obtener_roles.php');
        const data = await response.json();
        
        if (data.success) {
            rolesDisponibles = data.roles;
            renderizarRolesSeleccion();
        } else {
            console.error('Error al cargar roles:', data.message);
        }
    } catch (error) {
        console.error('Error al cargar roles:', error);
    }
}

// =============================================
// RENDERIZAR SELECCIÓN DE ROLES
// =============================================

function renderizarRolesSeleccion() {
    const container = document.getElementById('rolesSelection');
    if (!container) return;
    
    // Limpiar contenedor
    container.innerHTML = '';
    
    // Agregar info
    const info = document.createElement('div');
    info.className = 'alert alert-info small mb-3';
    info.innerHTML = '<i class="fas fa-info-circle me-1"></i> Puedes asignar múltiples roles al usuario';
    container.appendChild(info);
    
    // Agregar checkboxes de roles
    rolesDisponibles.forEach(rol => {
        const roleDiv = document.createElement('div');
        roleDiv.className = 'role-checkbox';
        roleDiv.innerHTML = `
            <input type="checkbox" id="rol_${rol.id}" value="${rol.id}" data-nombre="${rol.nombre}">
            <label class="role-checkbox-label" for="rol_${rol.id}">
                <span class="role-checkbox-title">${rol.nombre}</span>
                <span class="role-checkbox-desc">${rol.descripcion || 'Sin descripción'}</span>
            </label>
        `;
        
        // Evento de cambio
        const checkbox = roleDiv.querySelector('input[type="checkbox"]');
        checkbox.addEventListener('change', function() {
            actualizarRolesSeleccionados();
            
            if (this.checked) {
                roleDiv.classList.add('selected');
            } else {
                roleDiv.classList.remove('selected');
            }
        });
        
        container.appendChild(roleDiv);
    });
}

// =============================================
// ACTUALIZAR ROLES SELECCIONADOS
// =============================================

function actualizarRolesSeleccionados() {
    rolesSeleccionados = [];
    const checkboxes = document.querySelectorAll('#rolesSelection input[type="checkbox"]:checked');
    
    checkboxes.forEach(checkbox => {
        rolesSeleccionados.push({
            id: checkbox.value,
            nombre: checkbox.dataset.nombre
        });
    });
    
    // Actualizar campo oculto
    const rolesInput = document.getElementById('rolesInput');
    if (rolesInput) {
        rolesInput.value = JSON.stringify(rolesSeleccionados.map(r => r.id));
    }
    
    console.log('Roles seleccionados:', rolesSeleccionados);
}

// =============================================
// CARGAR USUARIOS
// =============================================

async function cargarUsuarios() {
    try {
        const response = await fetch('php/usuarios/listar_usuarios.php');
        const data = await response.json();
        
        if (data.success) {
            renderizarUsuarios(data.usuarios);
            actualizarEstadisticas(data.estadisticas);
        } else {
            console.error('Error al cargar usuarios:', data.message);
        }
    } catch (error) {
        console.error('Error al cargar usuarios:', error);
        mostrarNotificacion('Error al cargar usuarios', 'error');
    }
}

// =============================================
// RENDERIZAR USUARIOS EN LA TABLA
// =============================================

function renderizarUsuarios(usuarios) {
    const tbody = document.getElementById('usersTableBody');
    if (!tbody) return;
    
    tbody.innerHTML = '';
    
    usuarios.forEach(usuario => {
        const tr = document.createElement('tr');
        tr.className = 'user-row';
        tr.dataset.userId = usuario.id;
        tr.dataset.status = usuario.activo === 'si' ? 'activo' : 'inactivo';
        
        // Generar badges de roles
        let rolesBadges = '';
        if (usuario.roles && usuario.roles.length > 0) {
            const colores = ['primary', 'success', 'info', 'warning', 'danger', 'secondary'];
            rolesBadges = usuario.roles.map((rol, index) => 
                `<span class="badge bg-${colores[index % colores.length]}">${rol.nombre}</span>`
            ).join(' ');
        } else {
            rolesBadges = '<span class="badge bg-secondary">Sin rol</span>';
        }
        
        tr.innerHTML = `
            <td>
                <div class="user-cell">
                    <img src="${generarAvatar(usuario.nombre)}" alt="Usuario" class="user-avatar">
                    <div class="user-info">
                        <div class="user-name">${usuario.nombre}</div>
                        <small class="text-muted">ID: #${String(usuario.id).padStart(3, '0')}</small>
                    </div>
                </div>
            </td>
            <td>${usuario.email}</td>
            <td>
                <div class="roles-badges">
                    ${rolesBadges}
                </div>
            </td>
            <td>
                <span class="status-badge status-${usuario.activo === 'si' ? 'activo' : 'inactivo'}">
                    <i class="fas fa-${usuario.activo === 'si' ? 'check' : 'times'}-circle"></i> 
                    ${usuario.activo === 'si' ? 'Activo' : 'Inactivo'}
                </span>
            </td>
            <td><small class="text-muted">${formatearFecha(usuario.fecha_registro)}</small></td>
            <td>
                <div class="action-buttons">
                    <button class="btn-action btn-edit" onclick="editarUsuario(${usuario.id})" title="Editar">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn-action btn-delete" onclick="eliminarUsuario(${usuario.id})" title="Eliminar">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        `;
        
        tbody.appendChild(tr);
    });
    
    // Actualizar contador
    const usersCount = document.getElementById('usersCount');
    if (usersCount) {
        usersCount.textContent = `(${usuarios.length})`;
    }
}

// =============================================
// ACTUALIZAR ESTADÍSTICAS
// =============================================

function actualizarEstadisticas(stats) {
    if (!stats) return;
    
    const elementos = {
        totalUsers: stats.total || 0,
        activeUsers: stats.activos || 0,
        adminUsers: stats.administradores || 0,
        inactiveUsers: stats.inactivos || 0
    };
    
    Object.keys(elementos).forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.textContent = elementos[id];
        }
    });
}

// =============================================
// CONFIGURAR EVENTOS
// =============================================

function configurarEventos() {
    // Botón guardar usuario
    const saveUserBtn = document.getElementById('saveUserBtn');
    if (saveUserBtn) {
        saveUserBtn.addEventListener('click', guardarUsuario);
    }
    
    // Búsqueda
    const searchInput = document.getElementById('searchUsers');
    if (searchInput) {
        searchInput.addEventListener('input', filtrarUsuarios);
    }
    
    // Filtros
    const filterRol = document.getElementById('filterRol');
    const filterEstado = document.getElementById('filterEstado');
    
    if (filterRol) filterRol.addEventListener('change', filtrarUsuarios);
    if (filterEstado) filterEstado.addEventListener('change', filtrarUsuarios);
    
    // Limpiar filtros
    const clearFilters = document.getElementById('clearFilters');
    if (clearFilters) {
        clearFilters.addEventListener('click', () => {
            if (searchInput) searchInput.value = '';
            if (filterRol) filterRol.value = '';
            if (filterEstado) filterEstado.value = '';
            filtrarUsuarios();
        });
    }
    
    // Modal de agregar usuario
    const addUserModal = document.getElementById('addUserModal');
    if (addUserModal) {
        addUserModal.addEventListener('shown.bs.modal', function() {
            renderizarRolesSeleccion();
        });
        
        addUserModal.addEventListener('hidden.bs.modal', function() {
            limpiarFormulario();
        });
    }
}

// =============================================
// GUARDAR USUARIO
// =============================================

async function guardarUsuario() {
    const form = document.getElementById('addUserForm');
    if (!form || !form.checkValidity()) {
        form.classList.add('was-validated');
        return;
    }
    
    // Validar que se hayan seleccionado roles
    if (rolesSeleccionados.length === 0) {
        mostrarNotificacion('Debes seleccionar al menos un rol', 'warning');
        return;
    }
    
    const formData = new FormData(form);
    formData.append('roles', JSON.stringify(rolesSeleccionados.map(r => r.id)));
    
    try {
        const response = await fetch('php/usuarios/guardar_usuario.php', {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            mostrarNotificacion(data.message || 'Usuario creado exitosamente', 'success');
            
            // Cerrar modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('addUserModal'));
            modal.hide();
            
            // Recargar usuarios
            cargarUsuarios();
        } else {
            mostrarNotificacion(data.message || 'Error al crear usuario', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        mostrarNotificacion('Error de conexión', 'error');
    }
}

// =============================================
// EDITAR USUARIO
// =============================================

async function editarUsuario(id) {
    try {
        const response = await fetch(`php/usuarios/obtener_usuario.php?id=${id}`);
        const data = await response.json();
        
        if (data.success) {
            const usuario = data.usuario;
            
            // Cargar datos en formulario
            Swal.fire({
                title: 'Editar Usuario',
                html: `
                    <div class="text-start">
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" id="edit_nombre" class="form-control" value="${usuario.nombre}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" id="edit_email" class="form-control" value="${usuario.email}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select id="edit_activo" class="form-select">
                                <option value="si" ${usuario.activo === 'si' ? 'selected' : ''}>Activo</option>
                                <option value="no" ${usuario.activo === 'no' ? 'selected' : ''}>Inactivo</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Roles Asignados</label>
                            <div id="edit_roles_container"></div>
                        </div>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonText: 'Guardar Cambios',
                cancelButtonText: 'Cancelar',
                didOpen: () => {
                    renderizarRolesEdicion(usuario.roles || []);
                },
                preConfirm: () => {
                    const rolesEditados = [];
                    document.querySelectorAll('#edit_roles_container input[type="checkbox"]:checked').forEach(cb => {
                        rolesEditados.push(cb.value);
                    });
                    
                    return {
                        id: id,
                        nombre: document.getElementById('edit_nombre').value,
                        email: document.getElementById('edit_email').value,
                        activo: document.getElementById('edit_activo').value,
                        roles: rolesEditados
                    };
                }
            }).then(async (result) => {
                if (result.isConfirmed) {
                    await actualizarUsuario(result.value);
                }
            });
        }
    } catch (error) {
        console.error('Error:', error);
        mostrarNotificacion('Error al cargar usuario', 'error');
    }
}

// =============================================
// RENDERIZAR ROLES PARA EDICIÓN
// =============================================

function renderizarRolesEdicion(rolesUsuario) {
    const container = document.getElementById('edit_roles_container');
    if (!container) return;
    
    const rolesIds = rolesUsuario.map(r => r.id.toString());
    
    container.innerHTML = rolesDisponibles.map(rol => `
        <div class="role-checkbox ${rolesIds.includes(rol.id.toString()) ? 'selected' : ''}">
            <input type="checkbox" 
                   id="edit_rol_${rol.id}" 
                   value="${rol.id}" 
                   ${rolesIds.includes(rol.id.toString()) ? 'checked' : ''}>
            <label class="role-checkbox-label" for="edit_rol_${rol.id}">
                <span class="role-checkbox-title">${rol.nombre}</span>
            </label>
        </div>
    `).join('');
    
    // Agregar eventos
    container.querySelectorAll('.role-checkbox').forEach(div => {
        const checkbox = div.querySelector('input[type="checkbox"]');
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                div.classList.add('selected');
            } else {
                div.classList.remove('selected');
            }
        });
    });
}

// =============================================
// ACTUALIZAR USUARIO
// =============================================

async function actualizarUsuario(datos) {
    try {
        const formData = new FormData();
        formData.append('id', datos.id);
        formData.append('nombre', datos.nombre);
        formData.append('email', datos.email);
        formData.append('activo', datos.activo);
        formData.append('roles', JSON.stringify(datos.roles));
        
        const response = await fetch('php/usuarios/actualizar_usuario.php', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            mostrarNotificacion(result.message || 'Usuario actualizado', 'success');
            cargarUsuarios();
        } else {
            mostrarNotificacion(result.message || 'Error al actualizar', 'error');
        }
    } catch (error) {
        console.error('Error:', error);
        mostrarNotificacion('Error de conexión', 'error');
    }
}

// =============================================
// ELIMINAR USUARIO
// =============================================

async function eliminarUsuario(id) {
    const result = await Swal.fire({
        title: '¿Eliminar usuario?',
        text: 'Esta acción no se puede deshacer',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    });
    
    if (result.isConfirmed) {
        try {
            const response = await fetch('php/usuarios/eliminar_usuario.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id })
            });
            
            const data = await response.json();
            
            if (data.success) {
                mostrarNotificacion(data.message || 'Usuario eliminado', 'success');
                cargarUsuarios();
            } else {
                mostrarNotificacion(data.message || 'Error al eliminar', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            mostrarNotificacion('Error de conexión', 'error');
        }
    }
}

// =============================================
// FILTRAR USUARIOS
// =============================================

function filtrarUsuarios() {
    const searchValue = document.getElementById('searchUsers')?.value.toLowerCase() || '';
    const rolFilter = document.getElementById('filterRol')?.value.toLowerCase() || '';
    const estadoFilter = document.getElementById('filterEstado')?.value.toLowerCase() || '';
    
    const rows = document.querySelectorAll('.user-row');
    let visibleCount = 0;
    
    rows.forEach(row => {
        const nombre = row.querySelector('.user-name')?.textContent.toLowerCase() || '';
        const email = row.querySelector('.user-cell + td')?.textContent.toLowerCase() || '';
        const roles = Array.from(row.querySelectorAll('.roles-badges .badge')).map(b => b.textContent.toLowerCase());
        const estado = row.dataset.status || '';
        
        const matchSearch = nombre.includes(searchValue) || email.includes(searchValue);
        const matchRol = !rolFilter || roles.some(r => r.includes(rolFilter));
        const matchEstado = !estadoFilter || estado === estadoFilter;
        
        if (matchSearch && matchRol && matchEstado) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    const usersCount = document.getElementById('usersCount');
    if (usersCount) {
        usersCount.textContent = `(${visibleCount})`;
    }
}

// =============================================
// UTILIDADES
// =============================================

function generarAvatar(nombre) {
    const iniciales = nombre.split(' ').map(n => n[0]).join('').toUpperCase();
    const colores = ['2563eb', '10b981', 'f59e0b', '8b5cf6', 'ef4444'];
    const color = colores[Math.floor(Math.random() * colores.length)];
    return `https://ui-avatars.com/api/?name=${encodeURIComponent(nombre)}&background=${color}&color=fff`;
}

function formatearFecha(fecha) {
    if (!fecha) return 'N/A';
    const date = new Date(fecha);
    return date.toLocaleDateString('es-ES', { year: 'numeric', month: 'short', day: 'numeric' });
}

function limpiarFormulario() {
    const form = document.getElementById('addUserForm');
    if (form) {
        form.reset();
        form.classList.remove('was-validated');
    }
    
    rolesSeleccionados = [];
    
    // Desmarcar todos los checkboxes
    document.querySelectorAll('#rolesSelection input[type="checkbox"]').forEach(cb => {
        cb.checked = false;
    });
    
    document.querySelectorAll('.role-checkbox').forEach(div => {
        div.classList.remove('selected');
    });
}

function mostrarNotificacion(mensaje, tipo = 'info') {
    const iconos = {
        success: 'success',
        error: 'error',
        warning: 'warning',
        info: 'info'
    };
    
    Swal.fire({
        icon: iconos[tipo] || 'info',
        title: mensaje,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
}
