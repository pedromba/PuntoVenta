<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validación de Empresas - PuntoVenta Admin</title>
    
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
                <h5 class="topbar-title d-none d-md-block">Validación de Solicitudes de Empresas</h5>
            </div>

            <div class="topbar-search d-none d-lg-flex">
                <div class="search-wrapper">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchEmpresas" placeholder="Buscar empresa por nombre, CUIT..." class="search-input">
                </div>
            </div>

            <div class="topbar-right">
                <!-- Notifications -->
                <div class="notification-wrapper">
                    <button class="btn btn-icon btn-notification position-relative">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">0</span>
                    </button>
                </div>

                <!-- Settings -->
                <button class="btn btn-icon">
                    <i class="fas fa-gear"></i>
                </button>

                <!-- User Menu -->
                <div class="user-menu-wrapper">
                    <button class="btn btn-user">
                        <img src="https://ui-avatars.com/api/?name=Admin+System&background=2563eb&color=fff&rounded=true" alt="Admin">
                        <span class="d-none d-md-inline">Admin</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="user-menu">
                        <a href="#" class="menu-link">
                            <i class="fas fa-user"></i> Mi Perfil
                        </a>
                        <a href="#" class="menu-link">
                            <i class="fas fa-key"></i> Cambiar Contraseña
                        </a>
                        <hr class="my-2">
                        <a href="#" class="menu-link text-danger">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <div class="header-content">
                <div>
                    <h1 class="page-title">Validación de Empresas</h1>
                    <p class="page-subtitle">Revisa y valida las nuevas empresas que se registran en el sistema</p>
                </div>
                <div style="display: flex; gap: 10px;">
                    <a href="dashboard.php" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-arrow-left"></i>
                        <span>Volver</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="content-wrapper">
            <!-- Empresas Pendientes de Validación -->
            <section class="table-section">
                <div class="card-modern">
                    <div class="card-header-modern">
                        <div>
                            <h5 class="card-title">Solicitudes Pendientes</h5>
                            <p class="card-subtitle">Empresas esperando validación del administrador</p>
                        </div>
                        <div style="display: flex; gap: 10px;">
                            <input type="text" placeholder="Filtrar..." class="form-control" style="max-width: 200px;">
                        </div>
                    </div>
                    <div class="table-wrapper">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>Nombre Empresa</th>
                                    <th>Tipo Negocio</th>
                                    <th>NIF/CIF</th>
                                    <th>Email Contacto</th>
                                    <th>Fecha Solicitud</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="empresas-pendientes">
                                <?php if (!empty($empresas_pendientes)): ?>
                                    <?php foreach ($empresas_pendientes as $empresa): ?>
                                    <tr>
                                        <td>
                                            <strong>LocalShop S.L.</strong>
                                        </td>
                                        <td>Comercio</td>
                                        <td>B12345678</td>
                                        <td>info@localshop.es</td>
                                        <td>04/02/2026</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-success" onclick="abrirValidacion(1)">
                                                <i class="fas fa-check-circle"></i> Validar
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="fas fa-inbox"></i> No hay empresas pendientes de validación
                                        </td>
                                    </tr>
                                <?php endif; ?>
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

    <!-- Modal de Validación -->
    <div class="modal fade" id="modalValidacion" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Validar Empresa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info mb-3">
                        <i class="fas fa-info-circle me-2"></i>
                        Revisa los documentos y datos de la empresa antes de validar
                    </div>

                    <!-- Información de la Empresa -->
                    <div class="mb-3">
                        <h6 class="mb-3">Información de la Empresa</h6>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label fw-bold">Nombre:</label>
                                <p id="modal-nombre">--</p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label fw-bold">NIF/CIF:</label>
                                <p id="modal-nif">--</p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label fw-bold">Email:</label>
                                <p id="modal-email">--</p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label fw-bold">Teléfono:</label>
                                <p id="modal-telefono">--</p>
                            </div>
                            <div class="col-12 mb-2">
                                <label class="form-label fw-bold">Dirección:</label>
                                <p id="modal-direccion">--</p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Documentos -->
                    <div class="mb-3">
                        <h6 class="mb-3">Documentos Adjuntos</h6>
                        <div id="modal-documentos">
                            <p class="text-muted">Cargando documentos...</p>
                        </div>
                    </div>

                    <hr>

                    <!-- Decisión -->
                    <div class="mb-3">
                        <h6 class="mb-3">Decisión</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="decision" id="aprobar" value="aprobar">
                            <label class="form-check-label" for="aprobar">
                                ✓ Aprobar - La empresa cumple con todos los requisitos
                            </label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="decision" id="rechazar" value="rechazar">
                            <label class="form-check-label" for="rechazar">
                                ✗ Rechazar - La empresa no cumple con los requisitos
                            </label>
                        </div>
                    </div>

                    <!-- Comentarios -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Comentarios / Observaciones</label>
                        <textarea class="form-control" id="comentarios" rows="3" placeholder="Añade observaciones sobre tu decisión..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" id="btnConfirmarValidacion">
                        <i class="fas fa-check me-2"></i>Confirmar Validación
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="../recursos/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="../recursos/js/sweetalert2.all.js"></script>
    
    <!-- Validación JS -->
    <script>
        function abrirValidacion(empresaId) {
            // Fetch datos de la empresa vía AJAX
            fetch(`./php/obtener-empresa.php?id=${empresaId}`)
                .then(response => response.json())
                .then(data => {
                    const empresa = data.empresa;
                    
                    document.getElementById('modal-nombre').textContent = empresa.nombre_comercial;
                    document.getElementById('modal-nif').textContent = empresa.nif_cif;
                    document.getElementById('modal-email').textContent = empresa.email_contacto || 'N/A';
                    document.getElementById('modal-telefono').textContent = empresa.telefono || 'N/A';
                    document.getElementById('modal-direccion').textContent = empresa.direccion || 'N/A';

                    // Simular documentos (adaptar según tu sistema)
                    document.getElementById('modal-documentos').innerHTML = `
                        <div class="alert alert-info">
                            <small>Documentos del registro: ${empresa.nif_cif}</small>
                        </div>
                    `;

                    const modal = new bootstrap.Modal(document.getElementById('modalValidacion'));
                    modal.show();

                    document.getElementById('btnConfirmarValidacion').onclick = function() {
                        confirmarValidacion(empresaId);
                    };
                })
                .catch(error => {
                    alert('Error al cargar los datos de la empresa');
                    console.error(error);
                });
        }

        function confirmarValidacion(empresaId) {
            const decision = document.querySelector('input[name="decision"]:checked');
            const comentarios = document.getElementById('comentarios').value;

            if (!decision) {
                Swal.fire('Error', 'Por favor selecciona una decisión', 'error');
                return;
            }

            const nuevoEstado = decision.value === 'aprobar' ? 'activo' : 'suspendido';

            // Enviar validación al servidor
            fetch('./php/validar-empresa.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    empresa_id: empresaId,
                    estado: nuevoEstado,
                    comentarios: comentarios
                })
            })
            .then(response => response.json())
            .then(data => {
                const modal = bootstrap.Modal.getInstance(document.getElementById('modalValidacion'));
                modal.hide();

                if (data.success) {
                    Swal.fire(
                        decision.value === 'aprobar' ? 'Empresa Aprobada' : 'Empresa Rechazada',
                        data.message,
                        decision.value === 'aprobar' ? 'success' : 'warning'
                    ).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(error => {
                alert('Error al procesar la validación');
                console.error(error);
            });
        }
    </script>
</body>
</html>
