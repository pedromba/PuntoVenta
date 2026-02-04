/**
 * ESTADÍSTICAS - JavaScript Handler
 * Maneja eventos de reportes y gráficos
 */

class EstadisticasManager {
    constructor() {
        this.elementos = {
            filterFechaInicio: document.getElementById('filter-fecha-inicio'),
            filterFechaFin: document.getElementById('filter-fecha-fin'),
            btnGenerar: document.querySelector('[data-action="generar"]'),
            btnExportarPDF: document.querySelector('[data-action="exportar-pdf"]'),
            btnExportarExcel: document.querySelector('[data-action="exportar-excel"]'),
            tableBody: document.getElementById('top-productos-tbody'),
            chartVentas: document.getElementById('ventasPoFechaChart'),
            chartCategorias: document.getElementById('categoriasDistribucionChart')
        };

        this.charts = {};
        this.init();
    }

    init() {
        this.bindEvents();
        this.cargarEstadisticas();
    }

    bindEvents() {
        // Botón generar reporte
        if (this.elementos.btnGenerar) {
            this.elementos.btnGenerar.addEventListener('click', () => this.generarReporte());
        }

        // Botones exportar
        if (this.elementos.btnExportarPDF) {
            this.elementos.btnExportarPDF.addEventListener('click', () => this.exportarPDF());
        }

        if (this.elementos.btnExportarExcel) {
            this.elementos.btnExportarExcel.addEventListener('click', () => this.exportarExcel());
        }

        // Filtros
        if (this.elementos.filterFechaInicio) {
            this.elementos.filterFechaInicio.addEventListener('change', () => this.generarReporte());
        }

        if (this.elementos.filterFechaFin) {
            this.elementos.filterFechaFin.addEventListener('change', () => this.generarReporte());
        }
    }

    cargarEstadisticas() {
        this.mostrarCargandoGraficos();
        
        // TODO: Reemplazar con llamada AJAX
        // fetch('/admin/php/estadisticas.php?action=list')
        //     .then(res => res.json())
        //     .then(data => {
        //         this.actualizarMetricas(data);
        //         this.renderTabla(data.top_productos);
        //         this.inicializarGraficos(data);
        //     })
        //     .catch(error => this.mostrarError('Error al cargar estadísticas', error));
        
        console.log('Cargando estadísticas...');
    }

    generarReporte() {
        const fechaInicio = this.elementos.filterFechaInicio?.value || '';
        const fechaFin = this.elementos.filterFechaFin?.value || '';
        
        console.log('Generando reporte:', { fechaInicio, fechaFin });
        
        // TODO: Implementar AJAX para generar reporte con fechas
        this.mostrarCargandoGraficos();
        this.cargarEstadisticas();
    }

    inicializarGraficos(datos) {
        // Gráfico: Ventas por Fecha
        if (this.elementos.chartVentas && datos.ventas_por_fecha) {
            this.crearGraficoVentas(datos.ventas_por_fecha);
        }

        // Gráfico: Distribución por Categorías
        if (this.elementos.chartCategorias && datos.distribucion_categorias) {
            this.crearGraficoDistribucion(datos.distribucion_categorias);
        }
    }

    crearGraficoVentas(datos) {
        const ctx = this.elementos.chartVentas.getContext('2d');
        
        // Destruir gráfico anterior si existe
        if (this.charts.ventas) {
            this.charts.ventas.destroy();
        }

        this.charts.ventas = new Chart(ctx, {
            type: 'line',
            data: {
                labels: datos.fechas || [],
                datasets: [
                    {
                        label: 'Ventas (Neto)',
                        data: datos.montos_netos || [],
                        borderColor: '#667eea',
                        backgroundColor: 'rgba(102, 126, 234, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointBackgroundColor: '#667eea',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2
                    },
                    {
                        label: 'Impuestos',
                        data: datos.impuestos || [],
                        borderColor: '#f59e0b',
                        backgroundColor: 'rgba(245, 158, 11, 0.1)',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: '#f59e0b'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: (value) => '$' + value.toFixed(0)
                        }
                    }
                }
            }
        });
    }

    crearGraficoDistribucion(datos) {
        const ctx = this.elementos.chartCategorias.getContext('2d');
        
        // Destruir gráfico anterior si existe
        if (this.charts.categorias) {
            this.charts.categorias.destroy();
        }

        const colores = [
            '#667eea', '#764ba2', '#f59e0b', '#10b981',
            '#3b82f6', '#06b6d4', '#8b5cf6', '#ef4444'
        ];

        this.charts.categorias = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: datos.categorias || [],
                datasets: [
                    {
                        data: datos.valores || [],
                        backgroundColor: colores.slice(0, (datos.categorias || []).length),
                        borderColor: '#fff',
                        borderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'right'
                    }
                }
            }
        });
    }

    exportarPDF() {
        Swal.fire({
            title: 'Exportar Reporte',
            text: 'Generando PDF del reporte...',
            icon: 'info',
            didOpen: () => {
                Swal.showLoading();
            }
        });

        const fechaInicio = this.elementos.filterFechaInicio?.value || '';
        const fechaFin = this.elementos.filterFechaFin?.value || '';

        console.log('Exportando PDF:', { fechaInicio, fechaFin });
        // TODO: Implementar AJAX para generar y descargar PDF
        // window.open(`/admin/php/estadisticas.php?action=export_pdf&fecha_inicio=${fechaInicio}&fecha_fin=${fechaFin}`, '_blank');
        
        setTimeout(() => {
            Swal.fire({
                icon: 'success',
                title: 'PDF Generado',
                text: 'El archivo se está descargando...',
                timer: 2000
            });
        }, 1500);
    }

    exportarExcel() {
        Swal.fire({
            title: 'Exportar Reporte',
            text: 'Generando Excel del reporte...',
            icon: 'info',
            didOpen: () => {
                Swal.showLoading();
            }
        });

        const fechaInicio = this.elementos.filterFechaInicio?.value || '';
        const fechaFin = this.elementos.filterFechaFin?.value || '';

        console.log('Exportando Excel:', { fechaInicio, fechaFin });
        // TODO: Implementar AJAX para generar y descargar Excel
        
        setTimeout(() => {
            Swal.fire({
                icon: 'success',
                title: 'Excel Generado',
                text: 'El archivo se está descargando...',
                timer: 2000
            });
        }, 1500);
    }

    renderTabla(data) {
        if (!this.elementos.tableBody) return;

        this.elementos.tableBody.innerHTML = data.map((producto, index) => {
            const rankClass = `rank-${index + 1}`;
            const variacion = producto.variacion || 0;
            const variacionClass = variacion >= 0 ? 'positiva' : 'negativa';

            return `
                <tr>
                    <td>
                        <span class="producto-rank ${rankClass}">
                            ${index + 1}
                        </span>
                    </td>
                    <td>
                        <div class="producto-info">
                            <div class="producto-icon">
                                <i class="fas fa-box"></i>
                            </div>
                            <div class="producto-details">
                                <div class="producto-nombre">${producto.nombre}</div>
                                <div class="producto-sku">${producto.sku}</div>
                            </div>
                        </div>
                    </td>
                    <td class="text-end">
                        <strong class="metrica-display">${producto.unidades_vendidas}</strong>
                    </td>
                    <td class="text-end">
                        <strong class="metrica-display">$${parseFloat(producto.ingresos).toFixed(2)}</strong>
                    </td>
                    <td class="text-end">
                        <span class="metrica-variacion ${variacionClass}">
                            <i class="fas fa-${variacion >= 0 ? 'arrow-up' : 'arrow-down'}"></i>
                            ${variacion >= 0 ? '+' : ''}${variacion.toFixed(2)}%
                        </span>
                    </td>
                </tr>
            `;
        }).join('');
    }

    mostrarCargandoGraficos() {
        if (this.elementos.chartVentas) {
            this.elementos.chartVentas.getContext('2d').clearRect(0, 0, this.elementos.chartVentas.width, this.elementos.chartVentas.height);
        }
        if (this.elementos.chartCategorias) {
            this.elementos.chartCategorias.getContext('2d').clearRect(0, 0, this.elementos.chartCategorias.width, this.elementos.chartCategorias.height);
        }
    }

    actualizarMetricas(datos) {
        if (datos.ingresos !== undefined) {
            document.getElementById('ingresos-reporte').textContent = '$' + parseFloat(datos.ingresos).toFixed(2);
        }
        if (datos.numero_ventas !== undefined) {
            document.getElementById('numero-ventas').textContent = datos.numero_ventas;
        }
        if (datos.ticket_promedio !== undefined) {
            document.getElementById('ticket-promedio').textContent = '$' + parseFloat(datos.ticket_promedio).toFixed(2);
        }
        if (datos.margen_promedio !== undefined) {
            document.getElementById('margen-promedio').textContent = parseFloat(datos.margen_promedio).toFixed(2) + '%';
        }
    }

    mostrarError(titulo, mensaje) {
        Swal.fire({
            icon: 'error',
            title: titulo,
            text: mensaje
        });
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    window.estadisticasManager = new EstadisticasManager();
});
