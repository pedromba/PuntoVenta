/**
 * Gestión de Perfil de Usuario
 */

document.addEventListener('DOMContentLoaded', () => {
    cargarDatosPerfil();
    setupFormHandlers();
});

/**
 * Cargar datos del perfil del usuario
 */
async function cargarDatosPerfil() {
    console.log('🔄 Cargando datos del perfil...');
    
    try {
        const response = await fetch('./php/perfil/obtener_perfil.php', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
            credentials: 'same-origin'
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        console.log('✅ Datos del perfil:', data);

        if (data.success) {
            renderizarPerfil(data.usuario);
        } else {
            throw new Error(data.error || 'Error desconocido');
        }

    } catch (error) {
        console.error('❌ Error al cargar perfil:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo cargar la información del perfil'
        });
    }
}

/**
 * Renderizar datos del perfil en la interfaz
 */
function renderizarPerfil(usuario) {
    // Header
    document.getElementById('profile-name').textContent = usuario.nombre;
    document.getElementById('profile-email').querySelector('span').textContent = usuario.email;
    
    // Avatar
    const avatar = document.getElementById('profile-avatar');
    avatar.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(usuario.nombre)}&background=667eea&color=fff&size=120&rounded=true`;
    
    // Roles
    const rolesContainer = document.getElementById('profile-roles');
    rolesContainer.innerHTML = usuario.roles.map(rol => 
        `<span class="badge badge-role bg-light text-dark me-2">
            <i class="fas fa-user-tag me-1"></i>${escapeHtml(rol)}
        </span>`
    ).join('');
    
    // Formulario
    document.getElementById('nombre').value = usuario.nombre;
    document.getElementById('email').value = usuario.email;
    
    // Información adicional
    document.getElementById('fecha-registro').textContent = formatearFecha(usuario.fecha_registro);
    document.getElementById('ultimo-login').textContent = usuario.ultimo_login 
        ? formatearFecha(usuario.ultimo_login) 
        : 'Primera sesión';
    document.getElementById('empresa-nombre').textContent = usuario.empresa_nombre || 'N/A';
    document.getElementById('estado-cuenta').textContent = usuario.activo === 'si' ? 'Activo' : 'Inactivo';
    document.getElementById('estado-cuenta').className = usuario.activo === 'si' 
        ? 'badge bg-success' 
        : 'badge bg-danger';
}

/**
 * Configurar manejadores de formularios
 */
function setupFormHandlers() {
    // Formulario de perfil
    document.getElementById('form-perfil').addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const formData = new FormData(e.target);
        const datos = Object.fromEntries(formData);
        
        try {
            const response = await fetch('./php/perfil/actualizar_perfil.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                credentials: 'same-origin',
                body: JSON.stringify(datos)
            });

            const data = await response.json();

            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Actualizado!',
                    text: 'Tu perfil ha sido actualizado correctamente',
                    timer: 2000,
                    showConfirmButton: false
                });
                
                // Actualizar sesión y recargar
                setTimeout(() => {
                    cargarDatosPerfil();
                }, 2000);
            } else {
                throw new Error(data.error || 'Error al actualizar');
            }
        } catch (error) {
            console.error('❌ Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message
            });
        }
    });

    // Formulario de contraseña
    document.getElementById('form-password').addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const formData = new FormData(e.target);
        const datos = Object.fromEntries(formData);
        
        // Validar que las contraseñas coincidan
        if (datos.password_nueva !== datos.password_confirmar) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Las contraseñas nuevas no coinciden'
            });
            return;
        }
        
        try {
            const response = await fetch('./php/perfil/cambiar_password.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                credentials: 'same-origin',
                body: JSON.stringify(datos)
            });

            const data = await response.json();

            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Contraseña actualizada!',
                    text: 'Tu contraseña ha sido cambiada correctamente',
                    timer: 2000,
                    showConfirmButton: false
                });
                
                // Limpiar formulario
                e.target.reset();
            } else {
                throw new Error(data.error || 'Error al cambiar contraseña');
            }
        } catch (error) {
            console.error('❌ Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message
            });
        }
    });
}

/**
 * Formatear fecha
 */
function formatearFecha(fechaStr) {
    if (!fechaStr) return 'N/A';
    
    const fecha = new Date(fechaStr);
    const opciones = { 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    };
    
    return fecha.toLocaleDateString('es-ES', opciones);
}

/**
 * Escape HTML
 */
function escapeHtml(text) {
    if (!text) return '';
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.toString().replace(/[&<>"']/g, m => map[m]);
}

/**
 * Función global para cerrar sesión (ya existe en dashboard.js pero la duplicamos por si acaso)
 */
function logout(event) {
    event.preventDefault();
    
    Swal.fire({
        title: '¿Cerrar sesión?',
        text: "Se cerrará tu sesión actual",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#2563eb',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Sí, cerrar sesión',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '../recursos/php/logout.php';
        }
    });
}
