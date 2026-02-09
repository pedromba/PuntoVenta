// ============ EMPRESAS PAGE - JAVASCRIPT ============

document.addEventListener('DOMContentLoaded', function() {
    initializeEventListeners();
    initializeSearch();
    initializeFilters();
});

/**
 * Inicializar event listeners
 */
function initializeEventListeners() {
    // Botón guardar empresa
    const btnGuardarEmpresa = document.getElementById('btnGuardarEmpresa');
    if (btnGuardarEmpresa) {
        btnGuardarEmpresa.addEventListener('click', guardarEmpresa);
    }

    // Botón limpiar filtros
    const btnLimpiarFiltros = document.getElementById('btnLimpiarFiltros');
    if (btnLimpiarFiltros) {
        btnLimpiarFiltros.addEventListener('click', limpiarFiltros);
    }
}

/**
 * Inicializar búsqueda
 */
function initializeSearch() {
    const searchInput = document.getElementById('searchEmpresas');
    
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const query = e.target.value.toLowerCase().trim();
            buscarEmpresas(query);
        });

        // Cerrar resultados al hacer click afuera
        document.addEventListener('click', function(e) {
            const searchResults = document.querySelector('.search-results');
            if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.style.display = 'none';
            }
        });
    }
}

/**
 * Buscar empresas
 */
function buscarEmpresas(query) {
    const empresasContainer = document.getElementById('empresasContainer');
    const empresas = empresasContainer.querySelectorAll('.empresa-item');
    let coincidencias = 0;

    empresas.forEach(empresa => {
        const nombre = empresa.querySelector('.empresa-nombre').textContent.toLowerCase();
        const nif = empresa.querySelector('.empresa-nif-text').textContent.toLowerCase();
        const email = empresa.querySelector('.contact-link').textContent.toLowerCase();

        if (nombre.includes(query) || nif.includes(query) || email.includes(query)) {
            empresa.style.display = '';
            coincidencias++;
        } else {
            empresa.style.display = 'none';
        }
    });

    // Actualizar contador
    actualizarResultadosFiltros();
}

/**
 * Inicializar filtros
 */
function initializeFilters() {
    const filterCategoria = document.getElementById('filterCategoria');
    const filterEstado = document.getElementById('filterEstado');
    const filterOrden = document.getElementById('filterOrden');

    if (filterCategoria) {
        filterCategoria.addEventListener('change', aplicarFiltros);
    }
    if (filterEstado) {
        filterEstado.addEventListener('change', aplicarFiltros);
    }
    if (filterOrden) {
        filterOrden.addEventListener('change', aplicarFiltros);
    }
}

/**
 * Aplicar filtros
 */
function aplicarFiltros() {
    const categoria = document.getElementById('filterCategoria').value;
    const estado = document.getElementById('filterEstado').value;
    const orden = document.getElementById('filterOrden').value;
    const empresasContainer = document.getElementById('empresasContainer');
    const empresas = Array.from(empresasContainer.querySelectorAll('.empresa-item'));

    // Filtrar
    empresas.forEach(empresa => {
        const cumpleCategoria = !categoria || empresa.dataset.categoria === categoria;
        const cumpleEstado = !estado || empresa.dataset.estado === estado;

        if (cumpleCategoria && cumpleEstado) {
            empresa.style.display = '';
        } else {
            empresa.style.display = 'none';
        }
    });

    // Ordenar
    const empresasVisibles = empresas.filter(e => e.style.display !== 'none');
    
    if (orden === 'nombre') {
        empresasVisibles.sort((a, b) => {
            const nameA = a.querySelector('.empresa-nombre').textContent;
            const nameB = b.querySelector('.empresa-nombre').textContent;
            return nameA.localeCompare(nameB);
        });
    } else if (orden === 'usuarios') {
        empresasVisibles.sort((a, b) => {
            const usersA = parseInt(a.querySelector('.stat-value').textContent);
            const usersB = parseInt(b.querySelector('.stat-value').textContent);
            return usersB - usersA;
        });
    }

    // Reordenar en el DOM
    empresasVisibles.forEach(empresa => {
        empresasContainer.appendChild(empresa);
    });

    actualizarResultadosFiltros();
}

/**
 * Limpiar filtros
 */
function limpiarFiltros() {
    document.getElementById('filterCategoria').value = '';
    document.getElementById('filterEstado').value = '';
    document.getElementById('filterOrden').value = 'reciente';
    document.getElementById('searchEmpresas').value = '';

    const empresasContainer = document.getElementById('empresasContainer');
    empresasContainer.querySelectorAll('.empresa-item').forEach(empresa => {
        empresa.style.display = '';
    });

    actualizarResultadosFiltros();
}

/**
 * Actualizar resultados de filtros
 */
function actualizarResultadosFiltros() {
    const empresasContainer = document.getElementById('empresasContainer');
    const empresasVisibles = empresasContainer.querySelectorAll('.empresa-item:not([style*="display: none"])').length;
    const resultCount = document.getElementById('resultCount');
    
    if (resultCount) {
        resultCount.innerHTML = `Mostrando <strong>${empresasVisibles}</strong> empresa${empresasVisibles !== 1 ? 's' : ''}`;
    }
}

/**
 * Ver detalles de empresa
 */
function verDetalles(empresaId) {
    // Simulación - En producción sería una llamada AJAX o redirección
    Swal.fire({
        title: 'Detalles de la Empresa',
        html: `
            <div style="text-align: left;">
                <p><strong>ID:</strong> ${empresaId}</p>
                <p><strong>Esta funcionalidad será implementada en el backend</strong></p>
                <p>Se mostrará información completa de la empresa</p>
            </div>
        `,
        icon: 'info',
        confirmButtonText: 'Cerrar',
        confirmButtonColor: '#2563eb'
    });
}

/**
 * Editar empresa
 */
function editarEmpresa(empresaId) {
    // Simulación - En producción sería una llamada AJAX o redirección
    Swal.fire({
        title: 'Editar Empresa',
        html: `
            <div style="text-align: left;">
                <p><strong>ID:</strong> ${empresaId}</p>
                <p><strong>Esta funcionalidad será implementada en el backend</strong></p>
                <p>Se mostrará un formulario para editar los datos de la empresa</p>
            </div>
        `,
        icon: 'warning',
        confirmButtonText: 'Cerrar',
        confirmButtonColor: '#2563eb'
    });
}

/**
 * Guardar nueva empresa
 */
function guardarEmpresa() {
    const form = document.getElementById('formEmpresa');
    
    // Validar formulario
    if (!form.checkValidity()) {
        form.classList.add('was-validated');
        return;
    }

    // Simulación - En producción sería una llamada AJAX
    Swal.fire({
        title: '¡Empresa Creada!',
        text: 'La empresa ha sido creada exitosamente.',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#10b981'
    }).then(() => {
        // Limpiar formulario
        form.reset();
        form.classList.remove('was-validated');
        
        // Cerrar modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('modalEmpresa'));
        modal.hide();

        // En producción aquí se llamaría al backend
    });
}

/**
 * Validación de formulario en tiempo real
 */
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('.needs-validation');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            if (!form.checkValidity()) {
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
});

/**
 * Funciones auxiliares
 */

/**
 * Mostrar notificación
 */
function mostrarNotificacion(titulo, mensaje, tipo = 'info') {
    Swal.fire({
        title: titulo,
        text: mensaje,
        icon: tipo,
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#2563eb'
    });
}

/**
 * Mostrar confirmación
 */
function mostrarConfirmacion(titulo, mensaje, callback) {
    Swal.fire({
        title: titulo,
        text: mensaje,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, continuar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280'
    }).then((result) => {
        if (result.isConfirmed) {
            if (callback) callback();
        }
    });
}

/**
 * Exportar empresas (simulado)
 */
function exportarEmpresas() {
    Swal.fire({
        title: 'Exportar Datos',
        text: 'Esta funcionalidad será implementada en el backend',
        icon: 'info',
        confirmButtonText: 'Aceptar'
    });
}

/**
 * Imprimir empresas
 */
function imprimirEmpresas() {
    window.print();
}
