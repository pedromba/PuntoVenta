<?php
$empresa = [
    'nombre_comercial' => 'Tu Empresa',
    'nif_cif' => '12345678A',
    'direccion' => 'Calle Principal 123',
    'telefono' => '+34 123 456 789',
    'email_contacto' => 'contacto@empresa.com',
    'web' => 'www.empresa.com',
    'cuenta_bancaria' => 'ES1234567890123456',
    'horario_atencion' => '09:00 - 18:00'
];

$apariencia = [
    'color_primario' => '#2563eb',
    'color_secundario' => '#2c3e50',
    'fuente_familia' => 'Poppins, sans-serif',
    'modo_oscuro_activado' => false
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Configuración - Empresa</title>
  
  <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./recursos/css/empresa-styles.css">
  <link rel="stylesheet" href="./recursos/css/sidebar.css">
  <link rel="stylesheet" href="./recursos/css/formularios.css">
  
  <style>
    :root {
      --primary: #2563eb;
      --secondary: #2c3e50;
      --light: #f8fafc;
      --border: #e2e8f0;
      --text-dark: #1e293b;
      --text-muted: #64748b;
    }

    body {
      background-color: #f1f5f9;
      color: var(--text-dark);
    }

    .wrapper {
      display: flex;
      min-height: 100vh;
    }

    .main-content {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .page-header {
      padding: 2rem 2rem 1rem;
      background: white;
      border-bottom: 1px solid var(--border);
    }

    .page-header h1 {
      font-size: 28px;
      font-weight: 700;
      margin: 0 0 0.5rem;
      color: var(--text-dark);
    }

    .page-header p {
      margin: 0;
      font-size: 14px;
    }

    .section-container {
      padding: 2rem;
      flex: 1;
    }

    .nav-sections {
      display: flex;
      gap: 1rem;
      margin-bottom: 2rem;
      border-bottom: 2px solid var(--border);
      padding-bottom: 0;
    }

    .nav-btn {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      padding: 1rem 1.5rem;
      background: none;
      border: none;
      cursor: pointer;
      font-size: 15px;
      font-weight: 500;
      color: var(--text-muted);
      border-bottom: 3px solid transparent;
      margin-bottom: -2px;
      transition: all 0.3s ease;
      white-space: nowrap;
    }

    .nav-btn:hover {
      color: var(--primary);
    }

    .nav-btn.active {
      color: var(--primary);
      border-bottom-color: var(--primary);
    }

    .nav-btn i {
      font-size: 16px;
    }

    .settings-section {
      display: none;
      animation: fadeIn 0.3s ease;
    }

    .settings-section.active {
      display: block;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .card {
      background: white;
      border: 1px solid var(--border);
      border-radius: 10px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
      overflow: hidden;
    }

    .card-header {
      padding: 2rem;
      border-bottom: 1px solid var(--border);
      background: linear-gradient(135deg, #f8fafc 0%, white 100%);
    }

    .card-header h4 {
      margin: 0 0 0.5rem;
      font-size: 18px;
      font-weight: 600;
      color: var(--text-dark);
    }

    .card-header p {
      margin: 0;
      font-size: 13px;
      color: var(--text-muted);
    }

    .card-body {
      padding: 2rem;
    }

    .form-group-row {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .form-group {
      display: flex;
      flex-direction: column;
    }

    .form-label {
      font-size: 13px;
      font-weight: 600;
      color: var(--text-dark);
      margin-bottom: 0.5rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .form-control, .form-select {
      border: 1px solid var(--border);
      border-radius: 6px;
      padding: 0.75rem 1rem;
      font-size: 14px;
      font-family: inherit;
      transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .form-control[type="color"] {
      padding: 0.5rem;
      height: 44px;
      cursor: pointer;
    }

    .color-picker-group {
      display: flex;
      gap: 1rem;
      align-items: flex-start;
    }

    .color-preview {
      display: flex;
      gap: 0.75rem;
      align-items: center;
      flex: 1;
    }

    .color-preview input[type="color"] {
      width: 50px;
      height: 50px;
      border-radius: 6px;
      border: 2px solid var(--border);
      cursor: pointer;
    }

    .color-preview input[type="text"] {
      flex: 1;
      font-family: 'Courier New', monospace;
      font-size: 13px;
      background: var(--light);
    }

    .color-preview-swatch {
      width: 50px;
      height: 50px;
      border-radius: 6px;
      border: 2px solid var(--border);
    }

    .color-info {
      font-size: 12px;
      color: var(--text-muted);
      margin-top: 0.5rem;
    }

    .form-check {
      margin-top: 0.5rem;
    }

    .form-check-input {
      width: 44px;
      height: 24px;
      margin: 0;
      cursor: pointer;
      border-radius: 12px;
      border: 1px solid var(--border);
      appearance: none;
      background: white;
      position: relative;
      transition: all 0.3s ease;
    }

    .form-check-input:checked {
      background: var(--primary);
      border-color: var(--primary);
    }

    .form-check-input::after {
      content: '';
      position: absolute;
      width: 18px;
      height: 18px;
      background: white;
      border-radius: 10px;
      top: 2px;
      left: 2px;
      transition: left 0.3s ease;
    }

    .form-check-input:checked::after {
      left: 20px;
    }

    .form-check-label {
      margin-left: 0.75rem;
      font-size: 14px;
      cursor: pointer;
      user-select: none;
    }

    .btn-submit {
      background: var(--primary);
      color: white;
      border: none;
      padding: 0.75rem 2rem;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-flex;
      gap: 0.5rem;
      align-items: center;
    }

    .btn-submit:hover {
      background: #1d4ed8;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    .form-actions {
      display: flex;
      justify-content: flex-end;
      gap: 1rem;
      margin-top: 2rem;
      padding-top: 2rem;
      border-top: 1px solid var(--border);
    }

    .page-footer {
      text-align: center;
      padding: 2rem;
      color: var(--text-muted);
      font-size: 13px;
      border-top: 1px solid var(--border);
      background: white;
      margin-top: auto;
    }

    @media (max-width: 768px) {
      .form-group-row {
        grid-template-columns: 1fr;
        gap: 1rem;
      }

      .nav-sections {
        overflow-x: auto;
        padding-bottom: 0;
      }

      .nav-btn {
        padding: 0.75rem 1rem;
        font-size: 13px;
      }

      .section-container {
        padding: 1.5rem 1rem;
      }

      .card-header, .card-body {
        padding: 1.5rem;
      }
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <?php include './componentes/aside.php'; ?>
    
    <div class="main-content">
      <!-- Page Header -->
      <div class="page-header">
        <h1><i class="fas fa-cog"></i> Configuración</h1>
        <p class="text-muted">Gestiona los datos y la apariencia de tu empresa</p>
      </div>

      <!-- Content -->
      <div class="section-container">
        <!-- Navegación de Secciones -->
        <div class="nav-sections">
          <button class="nav-btn active" data-section="empresa">
            <i class="fas fa-building"></i> Datos de Empresa
          </button>
          <button class="nav-btn" data-section="apariencia">
            <i class="fas fa-palette"></i> Apariencia
          </button>
        </div>

        <!-- SECCIÓN 1: DATOS DE EMPRESA -->
        <div class="settings-section active" id="empresa">
          <div class="card">
            <div class="card-header">
              <h4>Datos de Empresa</h4>
              <p>Información básica de tu negocio</p>
            </div>
            <div class="card-body">
              <form>
                <div class="form-group-row">
                  <div class="form-group">
                    <label class="form-label">Nombre Comercial</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($empresa['nombre_comercial']) ?>" placeholder="Ej: Mi Tienda">
                  </div>
                  <div class="form-group">
                    <label class="form-label">NIF/CIF</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($empresa['nif_cif']) ?>" placeholder="Ej: 12345678A">
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="form-group">
                    <label class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" value="<?= htmlspecialchars($empresa['telefono']) ?>" placeholder="Ej: +34 123 456 789">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Email de Contacto</label>
                    <input type="email" class="form-control" value="<?= htmlspecialchars($empresa['email_contacto']) ?>" placeholder="Ej: contacto@empresa.com">
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="form-group">
                    <label class="form-label">Sitio Web</label>
                    <input type="url" class="form-control" value="<?= htmlspecialchars($empresa['web']) ?>" placeholder="Ej: www.empresa.com">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Horario de Atención</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($empresa['horario_atencion']) ?>" placeholder="Ej: 09:00 - 18:00">
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="form-group">
                    <label class="form-label">Dirección</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($empresa['direccion']) ?>" placeholder="Calle, número, etc.">
                  </div>
                  <div class="form-group">
                    <label class="form-label">Cuenta Bancaria</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($empresa['cuenta_bancaria']) ?>" placeholder="IBAN">
                  </div>
                </div>

                <div class="form-actions">
                  <button type="button" class="btn-submit">
                    <i class="fas fa-save"></i> Guardar Cambios
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- SECCIÓN 2: APARIENCIA -->
        <div class="settings-section" id="apariencia">
          <div class="card">
            <div class="card-header">
              <h4>Apariencia</h4>
              <p>Personalización de colores y estilos</p>
            </div>
            <div class="card-body">
              <form>
                <div class="form-group-row">
                  <div class="form-group">
                    <label class="form-label">Color Primario</label>
                    <div class="color-picker-group">
                      <div class="color-preview">
                        <input type="color" id="color_primario" value="<?= $apariencia['color_primario'] ?>">
                        <input type="text" id="color_primario_text" value="<?= $apariencia['color_primario'] ?>" readonly>
                      </div>
                    </div>
                    <div class="color-info">Se aplica a botones y elementos principales</div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="form-group">
                    <label class="form-label">Color Secundario</label>
                    <div class="color-picker-group">
                      <div class="color-preview">
                        <input type="color" id="color_secundario" value="<?= $apariencia['color_secundario'] ?>">
                        <input type="text" id="color_secundario_text" value="<?= $apariencia['color_secundario'] ?>" readonly>
                      </div>
                    </div>
                    <div class="color-info">Se aplica a elementos secundarios</div>
                  </div>
                </div>

                <div class="form-group-row">
                  <div class="form-group">
                    <label class="form-label">Familia de Fuentes</label>
                    <select class="form-select">
                      <option value="Poppins, sans-serif" <?= $apariencia['fuente_familia'] === 'Poppins, sans-serif' ? 'selected' : '' ?>>Poppins</option>
                      <option value="Inter, sans-serif" <?= $apariencia['fuente_familia'] === 'Inter, sans-serif' ? 'selected' : '' ?>>Inter</option>
                      <option value="Roboto, sans-serif" <?= $apariencia['fuente_familia'] === 'Roboto, sans-serif' ? 'selected' : '' ?>>Roboto</option>
                      <option value="Ubuntu, sans-serif" <?= $apariencia['fuente_familia'] === 'Ubuntu, sans-serif' ? 'selected' : '' ?>>Ubuntu</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="form-label">Modo Oscuro</label>
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="modo_oscuro" <?= $apariencia['modo_oscuro_activado'] ? 'checked' : '' ?>>
                      <label class="form-check-label" for="modo_oscuro">
                        <span id="modo_oscuro_text"><?= $apariencia['modo_oscuro_activado'] ? 'Activado' : 'Desactivado' ?></span>
                      </label>
                    </div>
                  </div>
                </div>

                <div class="form-actions">
                  <button type="button" class="btn-submit">
                    <i class="fas fa-save"></i> Guardar Cambios
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="page-footer">
        <p>&copy; 2026 PuntoVenta - Sistema de Gestión</p>
      </footer>
    </div>
  </div>

  <script src="../recursos/js/bootstrap.bundle.min.js"></script>
  <script>
    // Navegación entre secciones
    document.querySelectorAll('.nav-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const sectionId = btn.getAttribute('data-section');
        
        document.querySelectorAll('.nav-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        
        document.querySelectorAll('.settings-section').forEach(sec => sec.classList.remove('active'));
        document.getElementById(sectionId).classList.add('active');
      });
    });

    // Color Primario
    document.getElementById('color_primario')?.addEventListener('input', (e) => {
      document.getElementById('color_primario_text').value = e.target.value;
      document.documentElement.style.setProperty('--primary', e.target.value);
    });

    // Color Secundario
    document.getElementById('color_secundario')?.addEventListener('input', (e) => {
      document.getElementById('color_secundario_text').value = e.target.value;
      document.documentElement.style.setProperty('--secondary', e.target.value);
    });

    // Modo Oscuro
    document.getElementById('modo_oscuro')?.addEventListener('change', (e) => {
      document.getElementById('modo_oscuro_text').textContent = e.target.checked ? 'Activado' : 'Desactivado';
      document.body.classList.toggle('dark-mode', e.target.checked);
    });
  </script>
</body>
</html>
