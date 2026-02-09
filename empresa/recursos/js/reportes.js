// Reportes Module

document.addEventListener('DOMContentLoaded', function() {
  initializeReportGeneration();
  initializeReportButtons();
  initializeDateFilters();
});

// Report Generation Modal
function initializeReportGeneration() {
  const generateBtn = document.querySelector('[data-bs-target="#generateReportModal"] .btn-primary') || 
                     document.querySelector('.modal-footer .btn-primary');
  
  if (generateBtn) {
    generateBtn.addEventListener('click', function() {
      const form = document.querySelector('#generateReportForm');
      const reportType = form.querySelector('select').value;
      const dateFrom = form.querySelectorAll('input')[0].value;
      const dateTo = form.querySelectorAll('input')[1].value;
      const format = document.querySelector('input[name="format"]:checked').value;

      if (!reportType || !dateFrom || !dateTo) {
        showNotification('Por favor completa todos los campos', 'warning');
        return;
      }

      Swal.fire({
        title: 'Generando reporte...',
        html: 'Por favor espera mientras se genera el reporte',
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        }
      });

      setTimeout(() => {
        Swal.fire({
          icon: 'success',
          title: 'Reporte Generado',
          text: `Reporte de ${reportType} en formato ${format.toUpperCase()}`,
          confirmButtonText: 'Descargar'
        }).then((result) => {
          if (result.isConfirmed) {
            // Simulate download
            showNotification('Reporte descargado', 'success');
            hideModal('generateReportModal');
          }
        });
      }, 2000);
    });
  }
}

// Report View/Download Buttons
function initializeReportButtons() {
  const viewBtns = document.querySelectorAll('.report-footer .btn-outline-primary');
  const downloadBtns = document.querySelectorAll('.report-footer .btn-outline-secondary');

  viewBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const reportCard = this.closest('.report-card');
      const reportTitle = reportCard.querySelector('.report-header h6').textContent;
      showNotification(`Abriendo: ${reportTitle}`);
      // Open report in modal/panel
    });
  });

  downloadBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const reportCard = this.closest('.report-card');
      const reportTitle = reportCard.querySelector('.report-header h6').textContent;
      
      // Simulate download
      const filename = reportTitle.replace(/\s+/g, '_') + '_' + new Date().getTime() + '.pdf';
      showNotification(`Descargando: ${filename}`, 'success');
    });
  });
}

// Date Filter
function initializeDateFilters() {
  const dateFrom = document.getElementById('dateFrom');
  const dateTo = document.getElementById('dateTo');
  const filterBtn = document.querySelector('.filters-section button:not(.btn-outline-secondary)');

  if (filterBtn) {
    filterBtn.addEventListener('click', function() {
      const from = dateFrom ? dateFrom.value : null;
      const to = dateTo ? dateTo.value : null;

      if (from && to) {
        const fromDate = new Date(from);
        const toDate = new Date(to);

        if (fromDate > toDate) {
          showNotification('La fecha inicial no puede ser mayor a la final', 'warning');
          return;
        }

        showNotification(`Filtros aplicados: ${from} a ${to}`, 'success');
        // Filter reports based on date range
      } else {
        showNotification('Por favor selecciona ambas fechas', 'warning');
      }
    });
  }
}

// Search Reports
const searchInput = document.getElementById('searchReports');
if (searchInput) {
  searchInput.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const reportCards = document.querySelectorAll('.report-card');

    reportCards.forEach(card => {
      const title = card.querySelector('.report-header h6').textContent.toLowerCase();
      const description = card.querySelector('.report-content p').textContent.toLowerCase();
      
      if (title.includes(searchTerm) || description.includes(searchTerm)) {
        card.style.display = '';
      } else {
        card.style.display = 'none';
      }
    });
  });
}

console.log('Reportes module loaded');
