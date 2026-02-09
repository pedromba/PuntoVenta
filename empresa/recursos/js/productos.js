// Productos Module

document.addEventListener('DOMContentLoaded', function() {
  initializeProductFilters();
  initializeProductModal();
  initializeProductTable();
});

// Initialize Product Filters
function initializeProductFilters() {
  const categoryFilter = document.getElementById('filterCategory');
  const stockFilter = document.getElementById('filterStockStatus');
  const sortFilter = document.getElementById('sortBy');
  const clearBtn = document.getElementById('clearFilters');

  if (!categoryFilter) return;

  function filterProducts() {
    const category = categoryFilter.value;
    const stock = stockFilter ? stockFilter.value : '';
    const rows = document.querySelectorAll('table tbody tr');

    let visibleCount = 0;

    rows.forEach(row => {
      let show = true;

      if (category) {
        const rowCategory = row.getAttribute('data-category');
        if (rowCategory !== category) show = false;
      }

      if (stock && show) {
        const rowStock = row.getAttribute('data-stock');
        if (rowStock !== stock) show = false;
      }

      row.style.display = show ? '' : 'none';
      if (show) visibleCount++;
    });

    // Update results count
    const countSpan = document.querySelector('.results-count');
    if (countSpan) {
      countSpan.textContent = `(${visibleCount})`;
    }
  }

  categoryFilter.addEventListener('change', filterProducts);
  if (stockFilter) stockFilter.addEventListener('change', filterProducts);

  if (clearBtn) {
    clearBtn.addEventListener('click', function() {
      categoryFilter.value = '';
      if (stockFilter) stockFilter.value = '';
      if (sortFilter) sortFilter.value = '';
      rows = document.querySelectorAll('table tbody tr');
      rows.forEach(row => row.style.display = '');
      const countSpan = document.querySelector('.results-count');
      if (countSpan) {
        countSpan.textContent = `(${rows.length})`;
      }
    });
  }
}

// Product Modal
function initializeProductModal() {
  const addBtn = document.querySelector('[data-bs-target="#addProductModal"]');
  if (!addBtn) return;

  addBtn.addEventListener('click', function() {
    document.getElementById('productForm').reset();
  });
}

// Product Table Actions
function initializeProductTable() {
  const editBtns = document.querySelectorAll('.btn-edit');
  const deleteBtns = document.querySelectorAll('.btn-delete');

  editBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const row = this.closest('tr');
      const name = row.cells[0].textContent;
      showNotification(`Editar producto: ${name}`);
    });
  });

  deleteBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const row = this.closest('tr');
      const name = row.cells[0].textContent;
      
      Swal.fire({
        title: '¿Eliminar producto?',
        text: `Estás a punto de eliminar: ${name}`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          row.style.display = 'none';
          showNotification('Producto eliminado', 'success');
        }
      });
    });
  });
}

// Add Product Form Handler
document.addEventListener('submit', function(e) {
  if (e.target.id === 'addProductForm') {
    e.preventDefault();
    const formData = new FormData(e.target);
    showNotification('Producto agregado correctamente', 'success');
    hideModal('addProductModal');
    e.target.reset();
  }
});

console.log('Productos module loaded');
