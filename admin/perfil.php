<?php
session_start();

// Verificar autenticación
if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header('Location: ../index.php');
    exit();
}

// Verificar que sea administrador
if (!$_SESSION['es_superadmin'] && !in_array('Administrador', $_SESSION['roles'] ?? [])) {
    header('Location: ../empresa/dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - PuntoVenta Admin</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="./recursos/enlaces/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./recursos/enlaces/all.css">
    
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="./recursos/enlaces/sweetalert2.css">
    
    <!-- CSS Personalizado -->
    <link rel="stylesheet" href="./recursos/css/dashboard.css">
    
    <style>
        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px;
            border-radius: 16px;
            color: white;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }
        
        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
            background-size: cover;
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 5px solid white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            object-fit: cover;
            position: relative;
            z-index: 1;
        }
        
        .profile-info {
            position: relative;
            z-index: 1;
        }
        
        .card-profile {
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            margin-bottom: 24px;
        }
        
        .card-profile .card-header {
            background: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
            padding: 20px 24px;
            border-radius: 16px 16px 0 0 !important;
        }
        
        .card-profile .card-body {
            padding: 24px;
        }
        
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .btn-save {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 32px;
            font-weight: 600;
            transition: transform 0.2s;
        }
        
        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }
        
        .badge-role {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .info-item {
            padding: 16px;
            background: #f8f9fa;
            border-radius: 12px;
            margin-bottom: 16px;
        }
        
        .info-item i {
            width: 24px;
            text-align: center;
            color: #667eea;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <?php include "./componentes/aside.php" ?>

    <!-- Overlay Sidebar Mobile -->
    <div class="sidebar-overlay"></div>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div class="topbar-left">
                <button class="btn btn-icon btn-toggle-sidebar d-lg-none">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="topbar-title d-none d-md-block">Mi Perfil</h5>
            </div>

            <div class="topbar-right">
                <a href="dashboard.php" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i>
                    <span class="d-none d-md-inline ms-2">Volver al Dashboard</span>
                </a>
            </div>
        </div>

        <!-- Content -->
        <div class="content-wrapper">
            <!-- Profile Header -->
            <div class="profile-header">
                <div class="d-flex align-items-center gap-4">
                    <img src="https://ui-avatars.com/api/?name=Usuario&background=667eea&color=fff&size=120&rounded=true" 
                         alt="Avatar" 
                         class="profile-avatar"
                         id="profile-avatar">
                    <div class="profile-info">
                        <h2 class="mb-2" id="profile-name">Cargando...</h2>
                        <p class="mb-2 opacity-75" id="profile-email">
                            <i class="fas fa-envelope me-2"></i>
                            <span>Cargando...</span>
                        </p>
                        <div id="profile-roles"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Información Personal -->
                <div class="col-lg-8">
                    <div class="card-profile">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-user me-2"></i>
                                Información Personal
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="form-perfil">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="nombre" class="form-label">Nombre Completo</label>
                                        <input type="text" class="form-control form-control-lg" id="nombre" name="nombre" required>
                                    </div>
                                    
                                    <div class="col-md-12 mb-3">
                                        <label for="email" class="form-label">Correo Electrónico</label>
                                        <input type="email" class="form-control form-control-lg" id="email" name="email" required readonly>
                                        <small class="text-muted">El email no puede ser modificado</small>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end gap-2 mt-4">
                                    <button type="button" class="btn btn-secondary" onclick="cargarDatosPerfil()">
                                        <i class="fas fa-undo me-2"></i>
                                        Descartar Cambios
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-save">
                                        <i class="fas fa-save me-2"></i>
                                        Guardar Cambios
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Cambiar Contraseña -->
                    <div class="card-profile">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-lock me-2"></i>
                                Cambiar Contraseña
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="form-password">
                                <div class="mb-3">
                                    <label for="password_actual" class="form-label">Contraseña Actual</label>
                                    <input type="password" class="form-control form-control-lg" id="password_actual" name="password_actual" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password_nueva" class="form-label">Nueva Contraseña</label>
                                    <input type="password" class="form-control form-control-lg" id="password_nueva" name="password_nueva" required minlength="8">
                                    <small class="text-muted">Mínimo 8 caracteres</small>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password_confirmar" class="form-label">Confirmar Nueva Contraseña</label>
                                    <input type="password" class="form-control form-control-lg" id="password_confirmar" name="password_confirmar" required>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-key me-2"></i>
                                    Actualizar Contraseña
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Información Adicional -->
                <div class="col-lg-4">
                    <div class="card-profile">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-info-circle me-2"></i>
                                Detalles de Cuenta
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="info-item">
                                <i class="fas fa-calendar me-2"></i>
                                <strong>Registrado:</strong>
                                <div class="mt-1" id="fecha-registro">Cargando...</div>
                            </div>
                            
                            <div class="info-item">
                                <i class="fas fa-clock me-2"></i>
                                <strong>Último acceso:</strong>
                                <div class="mt-1" id="ultimo-login">Cargando...</div>
                            </div>
                            
                            <div class="info-item">
                                <i class="fas fa-building me-2"></i>
                                <strong>Empresa:</strong>
                                <div class="mt-1" id="empresa-nombre">Cargando...</div>
                            </div>
                            
                            <div class="info-item">
                                <i class="fas fa-shield-alt me-2"></i>
                                <strong>Estado:</strong>
                                <div class="mt-1">
                                    <span class="badge bg-success" id="estado-cuenta">Activo</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="./recursos/enlaces/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 JS -->
    <script src="./recursos/enlaces/sweetalert2.all.js"></script>
    
    <!-- Dashboard JS (para sidebar) -->
    <script src="./recursos/js/dashboard.js"></script>
    
    <script src="./recursos/js/perfil.js"></script>
</body>
</html>
