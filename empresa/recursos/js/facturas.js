// Facturas Module

document.addEventListener('DOMContentLoaded', function() {
  initializeInvoiceFilters();
  initializeInvoiceModal();
  initializeInvoiceActions();
});

// Invoice Filters
function initializeInvoiceFilters() {
  const statusFilter = document.getElementById('filterStatus');
  const dateFilter = document.getElementById('filterDate');
  const clearBtn = document.getElementById('clearFilters');

  if (!statusFilter) return;

  function filterInvoices() {
    const status = statusFilter.value;
    const date = dateFilter ? dateFilter.value : '';
    const rows = document.querySelectorAll('table tbody tr');

    let visibleCount = 0;

    rows.forEach(row => {
      let show = true;

      if (status) {
        const rowStatus = row.getAttribute('data-status');
        if (rowStatus !== status) show = false;
      }

      if (date && show) {
        const rowDate = row.cells[2].textContent; // Fecha emisión
        if (!rowDate.includes(date)) show = false;
      }

      row.style.display = show ? '' : 'none';
      if (show) visibleCount++;
    });

    const countSpan = document.querySelector('.results-count');
    if (countSpan) {
      countSpan.textContent = `(${visibleCount})`;
    }
  }

  statusFilter.addEventListener('change', filterInvoices);
  if (dateFilter) dateFilter.addEventListener('change', filterInvoices);

  if (clearBtn) {
    clearBtn.addEventListener('click', function() {
      statusFilter.value = '';
      if (dateFilter) dateFilter.value = '';
      const rows = document.querySelectorAll('table tbody tr');
      rows.forEach(row => row.style.display = '');
      const countSpan = document.querySelector('.results-count');
      if (countSpan) {
        countSpan.textContent = `(${rows.length})`;
      }
    });
  }
}

// New Invoice Modal
function initializeInvoiceModal() {
  const newInvoiceBtn = document.querySelector('[data-bs-target="#newInvoiceModal"]');
  if (!newInvoiceBtn) return;

  newInvoiceBtn.addEventListener('click', function() {
    document.getElementById('newInvoiceForm').reset();
    resetInvoiceCalculations();
  });

  // Add product line
  const addLineBtn = document.querySelector('.invoice-items + .btn');
  if (addLineBtn) {
    addLineBtn.addEventListener('click', addInvoiceLine);
  }

  // Form calculations
  const form = document.getElementById('newInvoiceForm');
  if (form) {
    form.addEventListener('input', calculateInvoiceTotal);
  }
}

function addInvoiceLine() {
  const container = document.querySelector('.invoice-items');
  if (!container) return;

  const newLine = document.createElement('div');
  newLine.className = 'invoice-item';
  newLine.innerHTML = `
    <select class="form-select" placeholder="Producto">
      <option>Seleccionar producto</option>
    </select>
    <input type="number" class="form-control" placeholder="Cantidad" min="1" oninput="calculateInvoiceTotal()">
    <input type="number" class="form-control" placeholder="Precio" min="0" step="0.01" oninput="calculateInvoiceTotal()">
    <button type="button" class="btn btn-outline-danger" onclick="this.closest('.invoice-item').remove(); calculateInvoiceTotal();">
      <i class="fas fa-trash"></i>
    </button>
  `;
  container.appendChild(newLine);
}

function calculateInvoiceTotal() {
  const items = document.querySelectorAll('.invoice-item');
  let subtotal = 0;

  items.forEach(item => {
    const inputs = item.querySelectorAll('input');
    if (inputs[0] && inputs[1]) {
      const quantity = parseFloat(inputs[0].value) || 0;
      const price = parseFloat(inputs[1].value) || 0;
      subtotal += quantity * price;
    }
  });

  const iva = subtotal * 0.21;
  const total = subtotal + iva;

  const summaryRows = document.querySelectorAll('.summary-row');
  if (summaryRows.length >= 3) {
    summaryRows[0].querySelector('strong').textContent = `$${subtotal.toFixed(2)}`;
    summaryRows[1].querySelector('strong').textContent = `$${iva.toFixed(2)}`;
    summaryRows[2].querySelector('strong').textContent = `$${total.toFixed(2)}`;
  }
}

function resetInvoiceCalculations() {
  const summaryRows = document.querySelectorAll('.summary-row strong');
  if (summaryRows.length >= 3) {
    summaryRows.forEach(row => row.textContent = '$0.00');
  }
}

// Invoice Actions
function initializeInvoiceActions() {
  const viewBtns = document.querySelectorAll('.btn-view');
  const printBtns = document.querySelectorAll('.btn-print');
  const downloadBtns = document.querySelectorAll('.btn-download');

  viewBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const row = this.closest('tr');
      const invoiceNumber = row.cells[0].textContent;
      showNotification(`Abriendo factura: ${invoiceNumber}`);
      // Load invoice details
    });
  });

  printBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const row = this.closest('tr');
      const invoiceNumber = row.cells[0].textContent;
      window.print();
      showNotification(`Imprimiendo: ${invoiceNumber}`, 'success');
    });
  });

  downloadBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const row = this.closest('tr');
      const invoiceNumber = row.cells[0].textContent;
      const filename = invoiceNumber + '_' + new Date().getTime() + '.pdf';
      showNotification(`Descargando: ${filename}`, 'success');
    });
  });
}

// Form submission
document.addEventListener('submit', function(e) {
  if (e.target.id === 'newInvoiceForm') {
    e.preventDefault();
    
    const clientSelect = e.target.querySelector('select');
    const items = e.target.querySelectorAll('.invoice-item');

    if (!clientSelect.value) {
      showNotification('Por favor selecciona un cliente', 'warning');
      return;
    }

    if (items.length === 0) {
      showNotification('Por favor agrega al menos un producto', 'warning');
      return;
    }

    // Check if all product lines are completed
    let allCompleted = true;
    items.forEach(item => {
      const inputs = item.querySelectorAll('input');
      if (!inputs[0].value || !inputs[1].value) {
        allCompleted = false;
      }
    });

    if (!allCompleted) {
      showNotification('Por favor completa todos los productos', 'warning');
      return;
    }

    Swal.fire({
      title: 'Generar Factura',
      text: '¿Deseas guardar y generar la factura?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#2563eb',
      cancelButtonColor: '#6b7280',
      confirmButtonText: 'Generar PDF',
      cancelButtonText: 'Solo Guardar'
    }).then((result) => {
      if (result.isConfirmed) {
        showNotification('Factura generada y descargada', 'success');
        hideModal('newInvoiceModal');
        e.target.reset();
        setTimeout(() => {
          location.reload();
        }, 1500);
      } else {
        showNotification('Factura guardada correctamente', 'success');
        hideModal('newInvoiceModal');
        e.target.reset();
      }
    });
  }
});

// Search invoices
const searchInput = document.getElementById('searchInvoice');
if (searchInput) {
  searchInput.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('table tbody tr');

    rows.forEach(row => {
      const invoiceNumber = row.cells[0].textContent.toLowerCase();
      const clientName = row.cells[1].textContent.toLowerCase();
      
      if (invoiceNumber.includes(searchTerm) || clientName.includes(searchTerm)) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  });
}

console.log('Facturas module loaded');
