// Clientes Module

document.addEventListener('DOMContentLoaded', function() {
  initializeViewToggle();
  initializeClientGrid();
  initializeClientModal();
});

// View Toggle (Grid/List)
function initializeViewToggle() {
  const gridViewBtn = document.querySelector('[data-view="grid"]');
  const listViewBtn = document.querySelector('[data-view="list"]');
  const clientsGrid = document.querySelector('.clients-grid');
  const clientsList = document.querySelector('.clients-list');

  if (!gridViewBtn || !listViewBtn) return;

  gridViewBtn.addEventListener('click', function() {
    gridViewBtn.classList.add('active');
    listViewBtn.classList.remove('active');
    if (clientsGrid) clientsGrid.style.display = 'grid';
    if (clientsList) clientsList.classList.remove('active');
  });

  listViewBtn.addEventListener('click', function() {
    listViewBtn.classList.add('active');
    gridViewBtn.classList.remove('active');
    if (clientsGrid) clientsGrid.style.display = 'none';
    if (clientsList) clientsList.classList.add('active');
  });
}

// Client Card Actions
function initializeClientGrid() {
  const viewBtns = document.querySelectorAll('.btn-ver');
  const editBtns = document.querySelectorAll('.btn-editar');
  const deleteBtns = document.querySelectorAll('.btn-eliminar');

  viewBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const card = this.closest('.client-card');
      const clientName = card.querySelector('.client-name').textContent;
      showNotification(`Abriendo perfil de: ${clientName}`);
      // Load client details
    });
  });

  editBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const card = this.closest('.client-card');
      const clientName = card.querySelector('.client-name').textContent;
      showNotification(`Editando: ${clientName}`);
      
      // Populate modal with client data
      const modal = document.querySelector('#addClientModal');
      if (modal) {
        const nameInput = modal.querySelector('input[name="name"]');
        if (nameInput) nameInput.value = clientName;
        showModal('addClientModal');
      }
    });
  });

  deleteBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const card = this.closest('.client-card');
      const clientName = card.querySelector('.client-name').textContent;

      Swal.fire({
        title: '¿Eliminar cliente?',
        text: `Estás a punto de eliminar a: ${clientName}`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          card.remove();
          showNotification('Cliente eliminado', 'success');
          updateClientCount();
        }
      });
    });
  });
}

// Client Modal
function initializeClientModal() {
  const addBtn = document.querySelector('[data-bs-target="#addClientModal"]');
  if (!addBtn) return;

  addBtn.addEventListener('click', function() {
    document.getElementById('addClientForm').reset();
  });
}

// Add/Edit Client Form
document.addEventListener('submit', function(e) {
  if (e.target.id === 'addClientForm') {
    e.preventDefault();
    const formData = new FormData(e.target);
    
    showNotification('Cliente guardado correctamente', 'success');
    hideModal('addClientModal');
    e.target.reset();
    
    // In a real app, update the grid/list
    setTimeout(() => {
      location.reload();
    }, 1500);
  }
});

// Update client count
function updateClientCount() {
  const cards = document.querySelectorAll('.client-card').length;
  const countElement = document.querySelector('.stat-value');
  if (countElement && cards > 0) {
    // Get parent stat-value and update
    const statCards = document.querySelectorAll('.stat-value');
    if (statCards[0]) {
      statCards[0].textContent = cards + ' clientes';
    }
  }
}

// Search functionality for clients
const searchInput = document.getElementById('searchClients');
if (searchInput) {
  searchInput.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const cards = document.querySelectorAll('.client-card');

    cards.forEach(card => {
      const clientName = card.querySelector('.client-name').textContent.toLowerCase();
      const clientEmail = card.querySelector('.client-email').textContent.toLowerCase();
      
      if (clientName.includes(searchTerm) || clientEmail.includes(searchTerm)) {
        card.style.display = '';
      } else {
        card.style.display = 'none';
      }
    });
  });
}

console.log('Clientes module loaded');
