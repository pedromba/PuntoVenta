// Configuración Module

document.addEventListener('DOMContentLoaded', function() {
  initializeSettingsNav();
  initializeFormHandlers();
  initializeSecuritySettings();
});

// Settings Navigation
function initializeSettingsNav() {
  const navItems = document.querySelectorAll('.nav-item');

  navItems.forEach(item => {
    item.addEventListener('click', function() {
      // Remove active from all
      navItems.forEach(nav => nav.classList.remove('active'));
      document.querySelectorAll('.settings-section').forEach(section => {
        section.classList.remove('active');
      });

      // Add active to clicked
      this.classList.add('active');
      const sectionId = this.getAttribute('data-section');
      const section = document.getElementById(sectionId);
      if (section) {
        section.classList.add('active');
      }
    });
  });
}

// Form Handlers
function initializeFormHandlers() {
  const forms = document.querySelectorAll('.settings-section form');

  forms.forEach(form => {
    const submitBtn = form.querySelector('.btn-primary');
    if (submitBtn) {
      submitBtn.addEventListener('click', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        
        Swal.fire({
          icon: 'success',
          title: 'Cambios Guardados',
          text: 'La configuración ha sido actualizada correctamente',
          confirmButtonText: 'OK'
        }).then(() => {
          showNotification('Cambios guardados', 'success');
        });
      });
    }
  });
}

// Security Settings
function initializeSecuritySettings() {
  const twoFactorSwitch = document.getElementById('securityTwo');
  
  if (twoFactorSwitch) {
    twoFactorSwitch.addEventListener('change', function() {
      if (this.checked) {
        showNotification('Autenticación de dos factores habilitada', 'success');
      } else {
        Swal.fire({
          title: 'Desactivar 2FA',
          text: '¿Estás seguro de que deseas desactivar la autenticación de dos factores?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#dc2626',
          cancelButtonColor: '#6b7280',
          confirmButtonText: 'Desactivar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (!result.isConfirmed) {
            this.checked = true;
          } else {
            showNotification('2FA desactivado', 'success');
          }
        });
      }
    });
  }

  // Change Password
  const passwordBtn = document.querySelector('.security-group .btn-primary');
  if (passwordBtn) {
    passwordBtn.addEventListener('click', function(e) {
      e.preventDefault();
      
      const inputs = document.querySelectorAll('.security-group .form-group input');
      const [currentPwd, newPwd, confirmPwd] = Array.from(inputs);

      if (!currentPwd.value || !newPwd.value || !confirmPwd.value) {
        showNotification('Por favor completa todos los campos', 'warning');
        return;
      }

      if (newPwd.value !== confirmPwd.value) {
        showNotification('Las contraseñas no coinciden', 'warning');
        return;
      }

      if (newPwd.value.length < 8) {
        showNotification('La contraseña debe tener al menos 8 caracteres', 'warning');
        return;
      }

      Swal.fire({
        icon: 'success',
        title: 'Contraseña Actualizada',
        text: 'Tu contraseña ha sido cambiada correctamente',
        confirmButtonText: 'OK'
      }).then(() => {
        inputs.forEach(input => input.value = '');
        showNotification('Contraseña actualizada', 'success');
      });
    });
  }

  // Close all sessions
  const closeAllSessionsBtn = document.querySelector('.btn-outline-secondary');
  if (closeAllSessionsBtn && closeAllSessionsBtn.textContent.includes('Cerrar Todas')) {
    closeAllSessionsBtn.addEventListener('click', function(e) {
      e.preventDefault();
      
      Swal.fire({
        title: 'Cerrar Todas las Sesiones',
        text: 'Esto te desconectará de todos los dispositivos',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Cerrar Sesiones',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          showNotification('Todas las sesiones han sido cerradas', 'success');
          setTimeout(() => {
            window.location.href = '/PuntoVenta/index.php';
          }, 1500);
        }
      });
    });
  }

  // Close individual session
  const sessionCloseButtons = document.querySelectorAll('.session-item .btn');
  sessionCloseButtons.forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      const sessionItem = this.closest('.session-item');
      
      Swal.fire({
        title: 'Cerrar Sesión',
        text: '¿Deseas cerrar esta sesión?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Cerrar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          sessionItem.remove();
          showNotification('Sesión cerrada', 'success');
        }
      });
    });
  });
}

// Add User Modal
const addUserModal = document.querySelector('#addUserModal');
if (addUserModal) {
  const submitBtn = addUserModal.querySelector('.modal-footer .btn-primary');
  if (submitBtn) {
    submitBtn.addEventListener('click', function(e) {
      e.preventDefault();
      
      const form = addUserModal.querySelector('form');
      const formData = new FormData(form);

      if (!formData.get('Nombre Completo') || !formData.get('Email')) {
        showNotification('Por favor completa los campos requeridos', 'warning');
        return;
      }

      Swal.fire({
        icon: 'success',
        title: 'Usuario Creado',
        text: 'El usuario ha sido creado correctamente',
        confirmButtonText: 'OK'
      }).then(() => {
        form.reset();
        const modal = bootstrap.Modal.getInstance(addUserModal);
        modal.hide();
        showNotification('Usuario agregado', 'success');
      });
    });
  }
}

console.log('Configuración module loaded');
