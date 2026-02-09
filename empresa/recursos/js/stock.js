// Stock Module

document.addEventListener('DOMContentLoaded', function() {
  initializeStockFilters();
  initializeStockActions();
  initializeAdjustStockModal();
});

// Initialize Stock Filters
function initializeStockFilters() {
  const categoryFilter = document.getElementById('filterCategory');
  const statusFilter = document.getElementById('filterStockStatus');
  const clearBtn = document.getElementById('clearFilters');

  if (!categoryFilter) return;

  function filterStock() {
    const category = categoryFilter.value;
    const status = statusFilter ? statusFilter.value : '';
    const rows = document.querySelectorAll('table tbody tr');

    let visibleCount = 0;

    rows.forEach(row => {
      let show = true;

      if (category) {
        const rowCategory = row.getAttribute('data-category');
        if (rowCategory !== category) show = false;
      }

      if (status && show) {
        const rowStatus = row.getAttribute('data-status');
        if (rowStatus !== status) show = false;
      }

      row.style.display = show ? '' : 'none';
      if (show) visibleCount++;
    });

    const countSpan = document.querySelector('.results-count');
    if (countSpan) {
      countSpan.textContent = `(${visibleCount})`;
    }
  }

  categoryFilter.addEventListener('change', filterStock);
  if (statusFilter) statusFilter.addEventListener('change', filterStock);

  if (clearBtn) {
    clearBtn.addEventListener('click', function() {
      categoryFilter.value = '';
      if (statusFilter) statusFilter.value = '';
      const rows = document.querySelectorAll('table tbody tr');
      rows.forEach(row => row.style.display = '');
      const countSpan = document.querySelector('.results-count');
      if (countSpan) {
        countSpan.textContent = `(${rows.length})`;
      }
    });
  }
}

// Stock Actions
function initializeStockActions() {
  const adjustBtns = document.querySelectorAll('.btn-adjust');
  const historyBtns = document.querySelectorAll('.btn-history');

  adjustBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const row = this.closest('tr');
      const productName = row.cells[0].textContent;
      const currentStock = row.cells[4].textContent;
      
      // Populate modal
      const modal = document.querySelector('#adjustStockModal');
      if (modal) {
        const productSelect = modal.querySelector('select');
        const currentStockInput = modal.querySelectorAll('input')[0];
        
        if (productSelect) productSelect.value = productName;
        if (currentStockInput) currentStockInput.value = currentStock;
        
        showModal('adjustStockModal');
      }
    });
  });

  historyBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const row = this.closest('tr');
      const productName = row.cells[0].textContent;
      showNotification(`Historial de: ${productName}`);
      // Load history panel
    });
  });
}

// Adjust Stock Modal
function initializeAdjustStockModal() {
  const form = document.querySelector('#adjustStockForm');
  if (!form) return;

  const submitBtn = document.querySelector('#adjustStockModal .modal-footer .btn-primary');
  if (submitBtn) {
    submitBtn.addEventListener('click', function() {
      const productSelect = form.querySelector('select');
      const newStock = form.querySelectorAll('input')[1];
      const reason = form.querySelectorAll('select')[1];

      if (!newStock.value) {
        showNotification('Por favor completa todos los campos', 'warning');
        return;
      }

      Swal.fire({
        title: 'Confirmar ajuste',
        text: `Se ajustará el stock a: ${newStock.value}`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#2563eb',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          form.reset();
          hideModal('adjustStockModal');
          showNotification('Stock ajustado correctamente', 'success');
          // Update table
          setTimeout(() => {
            location.reload();
          }, 1000);
        }
      });
    });
  }
}

// Search Stock
const searchInput = document.getElementById('searchStock');
if (searchInput) {
  searchInput.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('table tbody tr');

    rows.forEach(row => {
      const productName = row.cells[0].textContent.toLowerCase();
      const sku = row.cells[1].textContent.toLowerCase();
      
      if (productName.includes(searchTerm) || sku.includes(searchTerm)) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  });
}

console.log('Stock module loaded');
