<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salud del Sistema - PuntoVenta Admin</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../recursos/css/all.css">
    
    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="./recursos/css/dashboard.css">
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../recursos/css/sweetalert2.css">
</head>
<body>
    <!-- Sidebar -->
    <?php include "./componentes/aside.php" ?>

    <div class="sidebar-overlay"></div>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div class="topbar-left">
                <button class="btn btn-icon btn-toggle-sidebar d-lg-none">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="topbar-title d-none d-md-block">Salud del Sistema</h5>
            </div>

            <div class="topbar-right">
                <button class="btn btn-icon" onclick="refrescarSalud()">
                    <i class="fas fa-sync"></i>
                </button>
                <div class="user-menu-wrapper">
                    <button class="btn btn-user">
                        <img src="https://ui-avatars.com/api/?name=Admin+System&background=2563eb&color=fff&rounded=true" alt="Admin">
                        <span class="d-none d-md-inline">Admin</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <div class="header-content">
                <div>
                    <h1 class="page-title">Salud del Sistema</h1>
                    <p class="page-subtitle">Monitoreo del estado y rendimiento de PuntoVenta</p>
                </div>
                <span class="badge bg-success" id="status-badge">
                    <i class="fas fa-circle me-2"></i>Sistema Óptimo
                </span>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="content-wrapper">
            <!-- Status Overview -->
            <div class="row g-3 mb-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card-modern">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="text-muted">Base de Datos</h6>
                                <span class="badge bg-success">En línea</span>
                            </div>
                            <h3 class="mb-2">98%</h3>
                            <small class="text-muted">Respuesta promedio: 45ms</small>
                            <div class="progress mt-3" style="height: 6px;">
                                <div class="progress-bar" style="width: 98%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card-modern">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="text-muted">Servidor Web</h6>
                                <span class="badge bg-success">En línea</span>
                            </div>
                            <h3 class="mb-2">100%</h3>
                            <small class="text-muted">Disponibilidad: 99.9%</small>
                            <div class="progress mt-3" style="height: 6px;">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card-modern">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="text-muted">Memoria</h6>
                                <span class="badge bg-warning">Moderado</span>
                            </div>
                            <h3 class="mb-2">72%</h3>
                            <small class="text-muted">8.6 GB de 12 GB</small>
                            <div class="progress mt-3" style="height: 6px;">
                                <div class="progress-bar bg-warning" style="width: 72%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="card-modern">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="text-muted">Disco</h6>
                                <span class="badge bg-success">Bueno</span>
                            </div>
                            <h3 class="mb-2">58%</h3>
                            <small class="text-muted">232 GB de 400 GB</small>
                            <div class="progress mt-3" style="height: 6px;">
                                <div class="progress-bar" style="width: 58%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Information -->
            <div class="row g-3 mb-4">
                <!-- Base de Datos -->
                <div class="col-lg-6">
                    <div class="card-modern">
                        <div class="card-header-modern">
                            <h5 class="card-title">Base de Datos MySQL</h5>
                        </div>
                        <div class="card-body">
                            <div class="metric-item">
                                <div class="metric-label">Estado</div>
                                <div class="metric-value">
                                    <span class="badge bg-success">Conectada</span>
                                </div>
                            </div>
                            <div class="metric-item">
                                <div class="metric-label">Versión</div>
                                <div class="metric-value">MySQL 8.0.32</div>
                            </div>
                            <div class="metric-item">
                                <div class="metric-label">Tamaño Base de Datos</div>
                                <div class="metric-value">2.4 GB</div>
                            </div>
                            <div class="metric-item">
                                <div class="metric-label">Conexiones Activas</div>
                                <div class="metric-value">42 de 150</div>
                            </div>
                            <div class="metric-item">
                                <div class="metric-label">Queries por segundo</div>
                                <div class="metric-value">523</div>
                            </div>
                            <button class="btn btn-sm btn-primary mt-3">
                                <i class="fas fa-database me-2"></i>Optimizar BD
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Servidor -->
                <div class="col-lg-6">
                    <div class="card-modern">
                        <div class="card-header-modern">
                            <h5 class="card-title">Información del Servidor</h5>
                        </div>
                        <div class="card-body">
                            <div class="metric-item">
                                <div class="metric-label">Sistema Operativo</div>
                                <div class="metric-value">Ubuntu 22.04 LTS</div>
                            </div>
                            <div class="metric-item">
                                <div class="metric-label">PHP</div>
                                <div class="metric-value">8.2.13</div>
                            </div>
                            <div class="metric-item">
                                <div class="metric-label">Nginx/Apache</div>
                                <div class="metric-value">Nginx 1.24.0</div>
                            </div>
                            <div class="metric-item">
                                <div class="metric-label">Uptime del Servidor</div>
                                <div class="metric-value">45 días 12 horas</div>
                            </div>
                            <div class="metric-item">
                                <div class="metric-label">Última Actualización</div>
                                <div class="metric-value">2026-01-28</div>
                            </div>
                            <button class="btn btn-sm btn-secondary mt-3">
                                <i class="fas fa-terminal me-2"></i>Reiniciar Servicios
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alertas Recientes -->
            <section class="card-modern mb-4">
                <div class="card-header-modern">
                    <h5 class="card-title">Alertas Recientes</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group">
                        <div class="list-group-item border-0">
                            <div class="d-flex align-items-start">
                                <div class="badge bg-warning text-dark me-3 mt-1">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div>
                                    <strong>Uso de memoria elevado</strong>
                                    <p class="mb-1 text-muted">La memoria está al 72% de capacidad</p>
                                    <small class="text-muted">Hace 2 horas</small>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item border-0">
                            <div class="d-flex align-items-start">
                                <div class="badge bg-info text-white me-3 mt-1">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div>
                                    <strong>Respaldo completado</strong>
                                    <p class="mb-1 text-muted">Base de datos respaldada exitosamente</p>
                                    <small class="text-muted">Hace 4 horas</small>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item border-0">
                            <div class="d-flex align-items-start">
                                <div class="badge bg-success text-white me-3 mt-1">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <strong>Actualización completada</strong>
                                    <p class="mb-1 text-muted">PuntoVenta actualizado a versión 2.0.1</p>
                                    <small class="text-muted">Hace 1 día</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Uptime y Performance -->
            <div class="row g-3 mb-4">
                <div class="col-lg-6">
                    <div class="card-modern">
                        <div class="card-header-modern">
                            <h5 class="card-title">Disponibilidad (Últimos 30 días)</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="uptimeChart" style="height: 200px;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card-modern">
                        <div class="card-header-modern">
                            <h5 class="card-title">Estadísticas de Uptime</h5>
                        </div>
                        <div class="card-body">
                            <div class="metric-item">
                                <div class="metric-label">Este Mes</div>
                                <div class="metric-value">99.95%</div>
                            </div>
                            <div class="metric-item">
                                <div class="metric-label">Últimos 3 Meses</div>
                                <div class="metric-value">99.97%</div>
                            </div>
                            <div class="metric-item">
                                <div class="metric-label">Últimos 12 Meses</div>
                                <div class="metric-value">99.94%</div>
                            </div>
                            <div class="metric-item">
                                <div class="metric-label">Tiempo Inactivo Total</div>
                                <div class="metric-value">3 horas 12 minutos</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="app-footer">
                <p>&copy; 2026 PuntoVenta - Sistema de Administración.</p>
            </footer>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="../recursos/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chart.js -->
    <script src="../recursos/js/chart.umd.js"></script>
    
    <script>
        function refrescarSalud() {
            console.log('Refrescando datos de salud...');
            // Aquí se recargará la información
        }

        // Gráfico de Uptime
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('uptimeChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Día 1', 'Día 5', 'Día 10', 'Día 15', 'Día 20', 'Día 25', 'Día 30'],
                        datasets: [{
                            label: 'Uptime (%)',
                            data: [99.9, 99.95, 99.92, 99.98, 99.95, 99.96, 99.95],
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false }
                        },
                        scales: {
                            y: { 
                                min: 99,
                                max: 100
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>
