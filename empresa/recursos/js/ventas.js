// Ventas Module

document.addEventListener('DOMContentLoaded', function() {
  initializeSalesFilters();
  initializeSalesModal();
  initializeSalesTable();
  initializeProductsCount();
});

// Initialize Sales Filters
function initializeSalesFilters() {
  const statusFilter = document.getElementById('filterStatus');
  const dateFilter = document.getElementById('filterDate');
  const sortFilter = document.getElementById('sortBy');
  const clearBtn = document.getElementById('clearFilters');

  if (!statusFilter) return;

  function filterSales() {
    const status = statusFilter.value;
    const date = dateFilter ? dateFilter.value : '';
    const rows = document.querySelectorAll('table tbody tr');

    let visibleCount = 0;

    rows.forEach(row => {
      let show = true;

      if (status) {
        const rowStatus = row.getAttribute('data-estado');
        if (rowStatus !== status) show = false;
      }

      if (date && show) {
        const rowDate = row.getAttribute('data-date');
        if (rowDate !== date) show = false;
      }

      row.style.display = show ? '' : 'none';
      if (show) visibleCount++;
    });

    const countSpan = document.querySelector('.results-count');
    if (countSpan) {
      countSpan.textContent = `(${visibleCount})`;
    }
  }

  statusFilter.addEventListener('change', filterSales);
  if (dateFilter) dateFilter.addEventListener('change', filterSales);

  if (clearBtn) {
    clearBtn.addEventListener('click', function() {
      statusFilter.value = '';
      if (dateFilter) dateFilter.value = '';
      if (sortFilter) sortFilter.value = '';
      const rows = document.querySelectorAll('table tbody tr');
      rows.forEach(row => row.style.display = '');
      const countSpan = document.querySelector('.results-count');
      if (countSpan) {
        countSpan.textContent = `(${rows.length})`;
      }
    });
  }
}

// Sales Modal
function initializeSalesModal() {
  const addBtn = document.querySelector('[data-bs-target="#newSaleModal"]');
  if (!addBtn) return;

  addBtn.addEventListener('click', function() {
    const form = document.getElementById('newSaleForm');
    if (form) form.reset();
  });

  // Dynamic product items
  const addProductBtn = document.querySelector('#addProductLine');
  if (addProductBtn) {
    addProductBtn.addEventListener('click', addProductLine);
  }
}

function addProductLine() {
  const container = document.querySelector('.sale-products');
  if (!container) return;

  const newItem = document.createElement('div');
  newItem.className = 'product-line mb-3';
  newItem.innerHTML = `
    <div class="row">
      <div class="col-md-7">
        <select class="form-select" placeholder="Producto">
          <option>Seleccionar producto</option>
        </select>
      </div>
      <div class="col-md-2">
        <input type="number" class="form-control" placeholder="Cantidad" min="1">
      </div>
      <div class="col-md-2">
        <input type="number" class="form-control" placeholder="Precio" min="0" step="0.01">
      </div>
      <div class="col-md-1">
        <button type="button" class="btn btn-sm btn-outline-danger" onclick="this.closest('.product-line').remove()">
          <i class="fas fa-trash"></i>
        </button>
      </div>
    </div>
  `;
  container.appendChild(newItem);
}

// Sales Table Actions
function initializeSalesTable() {
  const viewBtns = document.querySelectorAll('.btn-view');
  const printBtns = document.querySelectorAll('.btn-print');

  viewBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const row = this.closest('tr');
      const saleNumber = row.cells[0].textContent;
      showNotification(`Abriendo venta: ${saleNumber}`);
    });
  });

  printBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const row = this.closest('tr');
      const saleNumber = row.cells[0].textContent;
      window.print();
      showNotification(`Imprimiendo venta: ${saleNumber}`, 'success');
    });
  });
}

// Products Count Tooltip
function initializeProductsCount() {
  const productsCounts = document.querySelectorAll('.products-count');
  
  productsCounts.forEach(elem => {
    elem.addEventListener('mouseenter', function() {
      // Initialize tooltip if using Bootstrap
      new bootstrap.Tooltip(this);
    });
  });
}

// New Sale Form Handler
document.addEventListener('submit', function(e) {
  if (e.target.id === 'newSaleForm') {
    e.preventDefault();
    const formData = new FormData(e.target);
    
    Swal.fire({
      icon: 'success',
      title: 'Venta Registrada',
      text: 'La venta ha sido registrada correctamente',
      confirmButtonText: 'OK'
    }).then(() => {
      hideModal('newSaleModal');
      e.target.reset();
      location.reload();
    });
  }
});

console.log('Ventas module loaded');
