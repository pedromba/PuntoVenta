// Empresa Module - Shared JavaScript

document.addEventListener('DOMContentLoaded', function() {
  initializeSidebar();
  initializeSearch();
  initializeNotifications();
  initializeUserMenu();
});

// Sidebar Toggle
function initializeSidebar() {
  const toggleBtn = document.querySelector('.btn-toggle-sidebar');
  const sidebar = document.querySelector('.sidebar');
  
  if (toggleBtn && sidebar) {
    toggleBtn.addEventListener('click', function() {
      sidebar.classList.toggle('active');
    });

    // Close sidebar on link click
    const sidebarLinks = sidebar.querySelectorAll('a');
    sidebarLinks.forEach(link => {
      link.addEventListener('click', function() {
        if (window.innerWidth <= 768) {
          sidebar.classList.remove('active');
        }
      });
    });
  }

  // Close sidebar on outside click
  document.addEventListener('click', function(event) {
    if (!event.target.closest('.sidebar') && !event.target.closest('.btn-toggle-sidebar')) {
      if (sidebar) {
        sidebar.classList.remove('active');
      }
    }
  });
}

// Search Functionality
function initializeSearch() {
  const searchBox = document.querySelector('.search-box input');
  if (!searchBox) return;

  searchBox.addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    console.log('Buscando:', searchTerm);
    // Backend filtering would go here
  });
}

// Notifications
function initializeNotifications() {
  const notificationIcon = document.querySelector('.notification-icon');
  if (!notificationIcon) return;

  notificationIcon.addEventListener('click', function() {
    console.log('Notifications clicked');
    // Show notifications panel
  });
}

// User Menu
function initializeUserMenu() {
  const userMenu = document.querySelector('.user-menu');
  if (!userMenu) return;

  userMenu.addEventListener('click', function() {
    console.log('User menu clicked');
    // Show user dropdown menu
  });
}

// Clear Filters Helper
function initializeClearFilters() {
  const clearBtn = document.getElementById('clearFilters');
  if (!clearBtn) return;

  clearBtn.addEventListener('click', function() {
    const selects = document.querySelectorAll('.filters-section .form-select');
    const inputs = document.querySelectorAll('.filters-section .form-control');
    
    selects.forEach(select => select.value = '');
    inputs.forEach(input => input.value = '');
    
    // Show all table rows
    const tableRows = document.querySelectorAll('table tbody tr');
    tableRows.forEach(row => row.style.display = '');
  });
}

// File Download Helper
function downloadFile(filename, content) {
  const element = document.createElement('a');
  element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(content));
  element.setAttribute('download', filename);
  element.style.display = 'none';
  document.body.appendChild(element);
  element.click();
  document.body.removeChild(element);
}

// Modal Helper
function showModal(modalId) {
  const modal = new bootstrap.Modal(document.getElementById(modalId));
  modal.show();
}

function hideModal(modalId) {
  const modal = bootstrap.Modal.getInstance(document.getElementById(modalId));
  if (modal) {
    modal.hide();
  }
}

// Toast Notification
function showNotification(message, type = 'success') {
  Swal.fire({
    icon: type,
    title: message,
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
}

// Logout
function logout() {
  localStorage.clear();
  window.location.href = '/PuntoVenta/index.php';
}

// Initialize on page load
window.addEventListener('load', function() {
  initializeClearFilters();
});

// Responsive sidebar
window.addEventListener('resize', function() {
  const sidebar = document.querySelector('.sidebar');
  if (window.innerWidth > 768 && sidebar) {
    sidebar.classList.remove('active');
  }
});

console.log('Empresa module initialized');
