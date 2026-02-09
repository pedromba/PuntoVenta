<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles y Permisos - PuntoVenta Admin</title>
    
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
                <h5 class="topbar-title d-none d-md-block">Gestión de Roles y Permisos</h5>
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

        <!-- Page Header -->
        <div class="page-header">
            <div class="header-content">
                <div>
                    <h1 class="page-title">Roles y Permisos</h1>
                    <p class="page-subtitle">Define los roles y permisos para los administradores del sistema</p>
                </div>
                <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#modalNuevoRol">
                    <i class="fas fa-plus"></i>
                    <span>Nuevo Rol</span>
                </button>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="content-wrapper">
            <div class="row">
                <!-- Roles List -->
                <div class="col-lg-4 mb-4">
                    <div class="card-modern">
                        <div class="card-header-modern">
                            <h5 class="card-title">Roles Disponibles</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group">
                                <button class="list-group-item list-group-item-action active" onclick="seleccionarRol(1)">
                                    <strong>Administrador</strong>
                                    <small class="d-block text-muted">Acceso total</small>
                                </button>
                                <button class="list-group-item list-group-item-action" onclick="seleccionarRol(2)">
                                    <strong>Supervisor</strong>
                                    <small class="d-block text-muted">Validación y reportes</small>
                                </button>
                                <button class="list-group-item list-group-item-action" onclick="seleccionarRol(3)">
                                    <strong>Operador</strong>
                                    <small class="d-block text-muted">Visualización y apoyo</small>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rol Details -->
                <div class="col-lg-8">
                    <div class="card-modern mb-4" id="rolDetails">
                        <div class="card-header-modern">
                            <h5 class="card-title">Detalles del Rol: Administrador</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nombre del Rol</label>
                                <input type="text" class="form-control" value="Administrador">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Descripción</label>
                                <textarea class="form-control" rows="2">Acceso completo a todas las funciones del sistema</textarea>
                            </div>

                            <h6 class="mb-3">Permisos de Gestión</h6>
                            <div class="permission-group mb-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm-empresas" checked>
                                    <label class="form-check-label" for="perm-empresas">
                                        <strong>Gestión de Empresas</strong>
                                        <small class="d-block text-muted">Ver, crear, editar, eliminar y validar empresas</small>
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm-usuarios" checked>
                                    <label class="form-check-label" for="perm-usuarios">
                                        <strong>Gestión de Usuarios Admin</strong>
                                        <small class="d-block text-muted">Ver, crear, editar y eliminar usuarios administrativos</small>
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm-config" checked>
                                    <label class="form-check-label" for="perm-config">
                                        <strong>Configuración del Sistema</strong>
                                        <small class="d-block text-muted">Modificar configuración global del sistema</small>
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="perm-respaldos" checked>
                                    <label class="form-check-label" for="perm-respaldos">
                                        <strong>Gestión de Respaldos</strong>
                                        <small class="d-block text-muted">Crear, descargar y restaurar respaldos</small>
                                    </label>
                                </div>
                            </div>

                            <h6 class="mb-3">Permisos de Monitoreo</h6>
                            <div class="permission-group mb-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm-auditoria" checked>
                                    <label class="form-check-label" for="perm-auditoria">
                                        <strong>Auditoría</strong>
                                        <small class="d-block text-muted">Ver registro completo de acciones</small>
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm-reportes" checked>
                                    <label class="form-check-label" for="perm-reportes">
                                        <strong>Reportes</strong>
                                        <small class="d-block text-muted">Generar y exportar reportes del sistema</small>
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="perm-salud" checked>
                                    <label class="form-check-label" for="perm-salud">
                                        <strong>Salud del Sistema</strong>
                                        <small class="d-block text-muted">Monitorear estado y métricas del sistema</small>
                                    </label>
                                </div>
                            </div>

                            <div class="alert alert-info mb-3">
                                <i class="fas fa-info-circle me-2"></i>
                                Los cambios en los permisos afectarán a todos los usuarios con este rol de forma inmediata.
                            </div>

                            <button class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar Cambios
                            </button>
                            <button class="btn btn-outline-danger ms-2">
                                <i class="fas fa-trash me-2"></i>Eliminar Rol
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Usuarios por Rol -->
            <section class="table-section" data-animate="slide-in">
                <div class="card-modern">
                    <div class="card-header-modern">
                        <div>
                            <h5 class="card-title">Usuarios por Rol</h5>
                            <p class="card-subtitle">Asignación de roles a administradores</p>
                        </div>
                    </div>
                    <div class="table-wrapper">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Email</th>
                                    <th>Rol Asignado</th>
                                    <th>Activo</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <strong>Carlos Admin</strong>
                                    </td>
                                    <td>carlos@puntoventa.com</td>
                                    <td>
                                        <span class="badge bg-primary">Administrador</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Sí</span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>María Supervisor</strong>
                                    </td>
                                    <td>maria@puntoventa.com</td>
                                    <td>
                                        <span class="badge bg-success">Supervisor</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Sí</span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Juan Operador</strong>
                                    </td>
                                    <td>juan@puntoventa.com</td>
                                    <td>
                                        <span class="badge bg-warning">Operador</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Sí</span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <footer class="app-footer">
                <p>&copy; 2026 PuntoVenta - Sistema de Administración.</p>
            </footer>
        </div>
    </main>

    <!-- Modal Nuevo Rol -->
    <div class="modal fade" id="modalNuevoRol" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear Nuevo Rol</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nombre del Rol</label>
                        <input type="text" class="form-control" placeholder="Ej: Analista">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Descripción</label>
                        <textarea class="form-control" rows="3" placeholder="Descripción del rol..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Crear Rol</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="../recursos/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function seleccionarRol(rolId) {
            const roles = {
                1: {
                    nombre: 'Administrador',
                    descripcion: 'Acceso total a todas las funciones del sistema'
                },
                2: {
                    nombre: 'Supervisor',
                    descripcion: 'Validación de empresas y generación de reportes'
                },
                3: {
                    nombre: 'Operador',
                    descripcion: 'Visualización de información y apoyo técnico'
                }
            };

            const rol = roles[rolId];
            document.querySelector('.list-group-item.active')?.classList.remove('active');
            event.target.closest('.list-group-item')?.classList.add('active');
            
            document.querySelector('.card-title').textContent = `Detalles del Rol: ${rol.nombre}`;
        }
    </script>
</body>
</html>
