<?php
// Static data for audit log template
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auditoría del Sistema - PuntoVenta Admin</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../recursos/css/all.css">
    <link rel="stylesheet" href="./recursos/css/dashboard.css">
    
</head>
<body>
    <?php include "./componentes/aside.php" ?>
    <div class="sidebar-overlay"></div>

    <main class="main-content">
        <div class="topbar">
            <div class="topbar-left">
                <button class="btn btn-icon btn-toggle-sidebar d-lg-none"><i class="fas fa-bars"></i></button>
                <h5 class="topbar-title d-none d-md-block">Auditoría del Sistema</h5>
            </div>
            <div class="topbar-right">
                <div class="user-menu-wrapper">
                    <button class="btn btn-user">
                        <img src="https://ui-avatars.com/api/?name=Admin+System&background=2563eb&color=fff&rounded=true" alt="Admin">
                        <span class="d-none d-md-inline">Admin</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="page-header">
            <div class="header-content">
                <div>
                    <h1 class="page-title">Auditoría del Sistema</h1>
                    <p class="page-subtitle">Registro de todas las acciones realizadas en el sistema</p>
                </div>
            </div>
        </div>

        <div class="content-wrapper">
            <!-- Filtros -->
            <section class="filters-section mb-4">
                <div class="filters-container">
                    <div class="filter-group">
                        <input type="date" class="form-control" placeholder="Desde">
                    </div>
                    <div class="filter-group">
                        <input type="date" class="form-control" placeholder="Hasta">
                    </div>
                    <div class="filter-group">
                        <select class="form-select">
                            <option>Todos los tipos</option>
                            <option>Validación de Empresa</option>
                            <option>Cambio de Configuración</option>
                            <option>Acceso de Usuario</option>
                            <option>Cambio de Rol</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <input type="text" class="form-control" placeholder="Buscar usuario o acción...">
                    </div>
                </div>
            </section>

            <!-- Tabla de Auditoría -->
            <section class="table-section">
                <div class="card-modern">
                    <div class="card-header-modern">
                        <h5 class="card-title">Registro de Acciones</h5>
                    </div>
                    <div class="table-wrapper">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>Fecha y Hora</th>
                                    <th>Usuario</th>
                                    <th>Tipo de Acción</th>
                                    <th>Descripción</th>
                                    <th>IP</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>04/02/2026 14:32:15</td>
                                    <td>Carlos Admin</td>
                                    <td>
                                        <span class="badge badge-primary">
                                            Validación Empresa
                                        </span>
                                    </td>
                                    <td>
                                        <small>Empresa validada: LocalShop S.L. (ID: 15)</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-light">192.168.1.105</span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-info" title="Detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>

                                <tr>
                                    <td>03/02/2026 10:15:42</td>
                                    <td>María Supervisor</td>
                                    <td>
                                        <span class="badge badge-warning">
                                            Cambio Configuración
                                        </span>
                                    </td>
                                    <td>
                                        <small>Modificado: Tasa impuesto general 21% a 23%</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-light">192.168.1.110</span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-info" title="Detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>

                                <tr>
                                    <td>02/02/2026 16:48:30</td>
                                    <td>Juan Operador</td>
                                    <td>
                                        <span class="badge badge-info">
                                            Acceso Usuario
                                        </span>
                                    </td>
                                    <td>
                                        <small>Inicio de sesión en consola de administración</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-light">192.168.1.115</span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-info" title="Detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>

                                <tr>
                                    <td>01/02/2026 09:22:11</td>
                                    <td>Carlos Admin</td>
                                    <td>
                                        <span class="badge badge-success">
                                            Cambio Rol
                                        </span>
                                    </td>
                                    <td>
                                        <small>Usuario María promovida de Operador a Supervisor</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-light">192.168.1.105</span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-info" title="Detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>

                                <tr>
                                    <td>31/01/2026 13:45:58</td>
                                    <td>Sistema</td>
                                    <td>
                                        <span class="badge badge-secondary">
                                            Respaldo Sistema
                                        </span>
                                    </td>
                                    <td>
                                        <small>Respaldo automático completado exitosamente (2.4 GB)</small>
                                    </td>
                                    <td>
                                        <span class="badge badge-light">127.0.0.1</span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-info" title="Detalles">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <footer class="app-footer">
                <p>&copy; 2026 PuntoVenta - Sistema de Administración.</p>
            </footer>
        </div>
    </main>

    <script src="../recursos/js/bootstrap.bundle.min.js"></script>
</body>
</html>
