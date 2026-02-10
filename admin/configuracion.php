<?php
// Datos de ejemplo - En producción vendrían de la BD
$empresas = [
    ['id' => 1, 'nombre_comercial' => 'Empresa A', 'nif_cif' => '12345678A', 'telefono' => '+34 123 456 789', 'email_contacto' => 'contacto@empresaa.com', 'categoria_empresa_id' => 1, 'estado' => 'activo'],
    ['id' => 2, 'nombre_comercial' => 'Empresa B', 'nif_cif' => '87654321B', 'telefono' => '+34 987 654 321', 'email_contacto' => 'contacto@empresab.com', 'categoria_empresa_id' => 2, 'estado' => 'activo'],
];

$categorias = [
    ['id' => 1, 'nombre' => 'Alimentos', 'activo' => true],
    ['id' => 2, 'nombre' => 'Moda', 'activo' => true],
    ['id' => 3, 'nombre' => 'Electrónica', 'activo' => true],
    ['id' => 4, 'nombre' => 'Ferretería', 'activo' => true],
];

$categoria_map = array_column($categorias, 'nombre', 'id');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Configuración del Sistema - Admin</title>
  
  <link href="../recursos/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./recursos/css/dashboard.css">

  <style>
    :root {
      --primary: #2563eb;
      --danger: #ef4444;
      --success: #10b981;
      --warning: #f59e0b;
      --light: #f8fafc;
      --border: #e2e8f0;
      --text-dark: #1e293b;
      --text-muted: #64748b;
    }

    body {
      background-color: #f1f5f9;
    }

    .page-header {
      padding: 2rem;
      background: white;
      border-bottom: 1px solid var(--border);
      margin-bottom: 2rem;
    }

    .page-header h1 {
      font-size: 28px;
      font-weight: 700;
      margin: 0;
      color: var(--text-dark);
    }

    .page-header p {
      margin: 0.5rem 0 0;
      color: var(--text-muted);
    }

    .nav-tabs-custom {
      display: flex;
      gap: 1rem;
      border-bottom: 2px solid var(--border);
      padding: 0 2rem 0;
      margin-bottom: 2rem;
    }

    .nav-tab-btn {
      padding: 1rem 0;
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

    .nav-tab-btn:hover {
      color: var(--primary);
    }

    .nav-tab-btn.active {
      color: var(--primary);
      border-bottom-color: var(--primary);
    }

    .nav-tab-btn i {
      margin-right: 0.5rem;
    }

    .section {
      display: none;
      animation: fadeIn 0.3s ease;
    }

    .section.active {
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
      margin-bottom: 2rem;
    }

    .card-header-custom {
      padding: 1.5rem;
      border-bottom: 1px solid var(--border);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .card-header-custom h4 {
      margin: 0;
      font-size: 18px;
      font-weight: 600;
      color: var(--text-dark);
    }

    .card-body {
      padding: 1.5rem;
    }

    .btn-primary {
      background: var(--primary);
      color: white;
      border: none;
      padding: 0.75rem 1.5rem;
      border-radius: 6px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-flex;
      gap: 0.5rem;
      align-items: center;
    }

    .btn-primary:hover {
      background: #1d4ed8;
      transform: translateY(-2px);
    }

    .btn-sm {
      padding: 0.5rem 1rem;
      font-size: 13px;
    }

    .btn-danger {
      background: var(--danger);
      color: white;
    }

    .btn-danger:hover {
      background: #dc2626;
    }

    .btn-edit {
      background: var(--primary);
      color: white;
      padding: 0.5rem 1rem;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 13px;
    }

    .table-custom {
      width: 100%;
      border-collapse: collapse;
    }

    .table-custom thead {
      background: var(--light);
      border-bottom: 2px solid var(--border);
    }

    .table-custom th {
      padding: 1rem;
      text-align: left;
      font-weight: 600;
      color: var(--text-dark);
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .table-custom td {
      padding: 1rem;
      border-bottom: 1px solid var(--border);
      color: var(--text-dark);
    }

    .table-custom tbody tr:hover {
      background: #f8fafc;
    }

    .badge {
      display: inline-block;
      padding: 0.35rem 0.75rem;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
    }

    .badge-success {
      background: rgba(16, 185, 129, 0.1);
      color: var(--success);
    }

    .badge-danger {
      background: rgba(239, 68, 68, 0.1);
      color: var(--danger);
    }

    .badge-warning {
      background: rgba(245, 158, 11, 0.1);
      color: var(--warning);
    }

    .form-group {
      margin-bottom: 1.5rem;
      display: flex;
      flex-direction: column;
    }

    .form-group label {
      font-size: 13px;
      font-weight: 600;
      color: var(--text-dark);
      margin-bottom: 0.5rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .form-control {
      border: 1px solid var(--border);
      padding: 0.75rem 1rem;
      border-radius: 6px;
      font-family: inherit;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .select-estado {
      padding: 0.5rem;
      border-radius: 4px;
      font-size: 12px;
      font-weight: 600;
      border: none;
      cursor: pointer;
    }

    .select-estado.activo {
      background: rgba(16, 185, 129, 0.1);
      color: var(--success);
    }

    .select-estado.inactivo {
      background: rgba(107, 114, 128, 0.1);
      color: var(--text-muted);
    }

    .select-estado.suspendido {
      background: rgba(239, 68, 68, 0.1);
      color: var(--danger);
    }

    .actions {
      display: flex;
      gap: 0.5rem;
    }

    .form-row {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
      margin-bottom: 1.5rem;
    }

    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      z-index: 1000;
      align-items: center;
      justify-content: center;
    }

    .modal.show {
      display: flex;
    }

    .modal-content {
      background: white;
      border-radius: 10px;
      padding: 2rem;
      max-width: 600px;
      max-height: 90vh;
      overflow-y: auto;
      width: 90%;
    }

    .modal-header {
      margin-bottom: 1.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-header h5 {
      margin: 0;
      font-size: 20px;
      font-weight: 600;
    }

    .modal-close {
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
      color: var(--text-muted);
    }

    @media (max-width: 768px) {
      .page-header {
        padding: 1.5rem;
      }

      .nav-tabs-custom {
        padding: 0 1rem;
      }

      .card {
        margin-bottom: 1.5rem;
      }

      .form-row {
        grid-template-columns: 1fr;
      }

      .table-custom {
        font-size: 12px;
      }

      .table-custom th,
      .table-custom td {
        padding: 0.75rem 0.5rem;
      }
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <?php include "./componentes/aside.php" ?>

  <main class="main-content" style="flex: 1; display: flex; flex-direction: column;">
    <!-- Page Header -->
    <div class="page-header">
      <h1><i class="fas fa-cog"></i> Configuración del Sistema</h1>
      <p>Gestiona empresas, categorías y configuración global</p>
    </div>

    <!-- Content -->
    <div style="padding: 0 2rem 2rem; flex: 1;">
      <!-- Navigation Tabs -->
      <div class="nav-tabs-custom">
        <button class="nav-tab-btn active" data-section="empresas">
          <i class="fas fa-building"></i> Empresas
        </button>
        <button class="nav-tab-btn" data-section="categorias">
          <i class="fas fa-tags"></i> Categorías
        </button>
        <button class="nav-tab-btn" data-section="global">
          <i class="fas fa-sliders-h"></i> Configuración Global
        </button>
      </div>

      <!-- SECCIÓN 1: GESTIÓN DE EMPRESAS -->
      <div class="section active" id="empresas">
        <div class="card">
          <div class="card-header-custom">
            <h4>Empresas Registradas</h4>
            <button class="btn-primary btn-sm" onclick="abrirModalEmpresa()">
              <i class="fas fa-plus"></i> Nueva Empresa
            </button>
          </div>
          <div class="card-body">
            <table class="table-custom">
              <thead>
                <tr>
                  <th>Nombre Comercial</th>
                  <th>NIF/CIF</th>
                  <th>Teléfono</th>
                  <th>Email</th>
                  <th>Categoría</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($empresas as $emp): ?>
                <tr>
                  <td><strong><?= htmlspecialchars($emp['nombre_comercial']) ?></strong></td>
                  <td><?= htmlspecialchars($emp['nif_cif']) ?></td>
                  <td><?= htmlspecialchars($emp['telefono']) ?></td>
                  <td><?= htmlspecialchars($emp['email_contacto']) ?></td>
                  <td><?= htmlspecialchars($categoria_map[$emp['categoria_empresa_id']] ?? 'N/A') ?></td>
                  <td>
                    <span class="badge <?= $emp['estado'] === 'activo' ? 'badge-success' : ($emp['estado'] === 'suspendido' ? 'badge-danger' : 'badge-warning') ?>">
                      <?= ucfirst($emp['estado']) ?>
                    </span>
                  </td>
                  <td>
                    <div class="actions">
                      <button class="btn-edit btn-sm" onclick="editarEmpresa(<?= $emp['id'] ?>)">
                        <i class="fas fa-edit"></i> Editar
                      </button>
                      <button class="btn-primary btn-sm btn-danger" onclick="eliminarEmpresa(<?= $emp['id'] ?>)">
                        <i class="fas fa-trash"></i> Eliminar
                      </button>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- SECCIÓN 2: GESTIÓN DE CATEGORÍAS -->
      <div class="section" id="categorias">
        <div class="card">
          <div class="card-header-custom">
            <h4>Categorías de Empresa</h4>
            <button class="btn-primary btn-sm" onclick="abrirModalCategoria()">
              <i class="fas fa-plus"></i> Nueva Categoría
            </button>
          </div>
          <div class="card-body">
            <table class="table-custom">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($categorias as $cat): ?>
                <tr>
                  <td><strong><?= htmlspecialchars($cat['nombre']) ?></strong></td>
                  <td>
                    <span class="badge <?= $cat['activo'] ? 'badge-success' : 'badge-warning' ?>">
                      <?= $cat['activo'] ? 'Activo' : 'Inactivo' ?>
                    </span>
                  </td>
                  <td>
                    <div class="actions">
                      <button class="btn-edit btn-sm" onclick="editarCategoria(<?= $cat['id'] ?>)">
                        <i class="fas fa-edit"></i> Editar
                      </button>
                      <button class="btn-primary btn-sm btn-danger" onclick="eliminarCategoria(<?= $cat['id'] ?>)">
                        <i class="fas fa-trash"></i> Eliminar
                      </button>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- SECCIÓN 3: CONFIGURACIÓN GLOBAL -->
      <div class="section" id="global">
        <div class="card">
          <div class="card-header-custom">
            <h4>Configuración Global del Sistema</h4>
          </div>
          <div class="card-body">
            <form>
              <div class="form-row">
                <div class="form-group">
                  <label>Nombre del Sistema</label>
                  <input type="text" class="form-control" value="PuntoVenta" placeholder="Nombre del sistema">
                </div>
                <div class="form-group">
                  <label>Versión</label>
                  <input type="text" class="form-control" value="1.0.0" placeholder="Versión" readonly>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label>Email de Soporte</label>
                  <input type="email" class="form-control" value="soporte@puntoventa.local" placeholder="Email de soporte">
                </div>
                <div class="form-group">
                  <label>Teléfono de Soporte</label>
                  <input type="tel" class="form-control" value="+34 900 000 000" placeholder="Teléfono de soporte">
                </div>
              </div>

              <div class="form-group">
                <label>Moneda por Defecto</label>
                <input type="text" class="form-control" value="EUR" placeholder="EUR" maxlength="3">
              </div>

              <div class="form-group">
                <label>Zona Horaria</label>
                <select class="form-control">
                  <option selected>Europe/Madrid</option>
                  <option>America/New_York</option>
                  <option>America/Los_Angeles</option>
                  <option>Asia/Tokyo</option>
                </select>
              </div>

              <button type="button" class="btn-primary" onclick="guardarConfiguracion()">
                <i class="fas fa-save"></i> Guardar Configuración
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Modal: Nueva/Editar Empresa -->
  <div class="modal" id="modalEmpresa">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="modalEmpresaTitle">Nueva Empresa</h5>
        <button class="modal-close" onclick="cerrarModalEmpresa()">&times;</button>
      </div>
      <form>
        <div class="form-group">
          <label>Nombre Comercial *</label>
          <input type="text" class="form-control" placeholder="Nombre comercial" required>
        </div>

        <div class="form-group">
          <label>NIF/CIF *</label>
          <input type="text" class="form-control" placeholder="NIF/CIF" required>
        </div>

        <div class="form-group">
          <label>Categoría *</label>
          <select class="form-control" required>
            <option value="">-- Seleccionar --</option>
            <?php foreach ($categorias as $cat): ?>
            <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nombre']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Teléfono</label>
            <input type="tel" class="form-control" placeholder="+34 123 456 789">
          </div>
          <div class="form-group">
            <label>Email de Contacto</label>
            <input type="email" class="form-control" placeholder="contacto@empresa.com">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Web</label>
            <input type="url" class="form-control" placeholder="www.empresa.com">
          </div>
          <div class="form-group">
            <label>Dirección</label>
            <input type="text" class="form-control" placeholder="Calle, número...">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Cuenta Bancaria</label>
            <input type="text" class="form-control" placeholder="IBAN">
          </div>
          <div class="form-group">
            <label>Horario de Atención</label>
            <input type="text" class="form-control" placeholder="09:00 - 18:00">
          </div>
        </div>

        <div class="form-group">
          <label>Estado</label>
          <select class="form-control">
            <option selected>activo</option>
            <option>inactivo</option>
            <option>suspendido</option>
          </select>
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
          <button type="button" class="btn-primary" style="background: #94a3b8; border: none; color: white; cursor: pointer;" onclick="cerrarModalEmpresa()">Cancelar</button>
          <button type="submit" class="btn-primary" onclick="guardarEmpresa(event)">Guardar Empresa</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal: Nueva/Editar Categoría -->
  <div class="modal" id="modalCategoria">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Nueva Categoría</h5>
        <button class="modal-close" onclick="cerrarModalCategoria()">&times;</button>
      </div>
      <form>
        <div class="form-group">
          <label>Nombre *</label>
          <input type="text" class="form-control" placeholder="Nombre de categoría" required>
        </div>

        <div class="form-group">
          <label>Descripción</label>
          <textarea class="form-control" placeholder="Descripción (opcional)" rows="3"></textarea>
        </div>

        <div class="form-group">
          <label>Estado</label>
          <select class="form-control">
            <option selected>activo</option>
            <option>inactivo</option>
          </select>
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
          <button type="button" class="btn-primary" style="background: #94a3b8; border: none; color: white; cursor: pointer;" onclick="cerrarModalCategoria()">Cancelar</button>
          <button type="submit" class="btn-primary" onclick="guardarCategoria(event)">Guardar Categoría</button>
        </div>
      </form>
    </div>
  </div>

  <script src="../recursos/js/bootstrap.bundle.min.js"></script>
  <script>
    // Navegación de tabs
    document.querySelectorAll('.nav-tab-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const sectionId = btn.getAttribute('data-section');
        
        document.querySelectorAll('.nav-tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        
        document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
        document.getElementById(sectionId).classList.add('active');
      });
    });

    // Modales de Empresa
    function abrirModalEmpresa() {
      document.getElementById('modalEmpresa').classList.add('show');
      document.getElementById('modalEmpresaTitle').textContent = 'Nueva Empresa';
    }

    function cerrarModalEmpresa() {
      document.getElementById('modalEmpresa').classList.remove('show');
    }

    function editarEmpresa(id) {
      document.getElementById('modalEmpresaTitle').textContent = 'Editar Empresa';
      abrirModalEmpresa();
      // TODO: Cargar datos de ID y mostrar
    }

    function eliminarEmpresa(id) {
      if (confirm('¿Estás seguro de eliminar esta empresa?')) {
        console.log('Eliminar empresa:', id);
      }
    }

    function guardarEmpresa(e) {
      e.preventDefault();
      console.log('Guardar empresa');
    }

    // Modales de Categoría
    function abrirModalCategoria() {
      document.getElementById('modalCategoria').classList.add('show');
    }

    function cerrarModalCategoria() {
      document.getElementById('modalCategoria').classList.remove('show');
    }

    function editarCategoria(id) {
      abrirModalCategoria();
      // TODO: Cargar datos de ID y mostrar
    }

    function eliminarCategoria(id) {
      if (confirm('¿Estás seguro de eliminar esta categoría?')) {
        console.log('Eliminar categoría:', id);
      }
    }

    function guardarCategoria(e) {
      e.preventDefault();
      console.log('Guardar categoría');
    }

    function guardarConfiguracion() {
      console.log('Guardar configuración global');
    }

    // Cerrar modales al hacer click fuera
    window.addEventListener('click', (e) => {
      if (e.target === document.getElementById('modalEmpresa')) {
        cerrarModalEmpresa();
      }
      if (e.target === document.getElementById('modalCategoria')) {
        cerrarModalCategoria();
      }
    });
  </script>
</body>
</html>
