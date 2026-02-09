<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Acceso - Portal Empresa</title>
  
  <link href="/PuntoVenta/recursos/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .container-auth {
      background: white;
      border-radius: 15px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
      overflow: hidden;
      display: grid;
      grid-template-columns: 1fr 1fr;
      width: 90%;
      max-width: 900px;
    }

    .auth-left {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 60px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

    .auth-left h1 {
      font-size: 32px;
      font-weight: 700;
      margin-bottom: 15px;
    }

    .auth-left p {
      font-size: 14px;
      opacity: 0.9;
      margin-bottom: 30px;
    }

    .features {
      text-align: left;
      width: 100%;
    }

    .feature-item {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 15px;
      font-size: 13px;
    }

    .feature-item i {
      font-size: 18px;
    }

    .auth-right {
      padding: 60px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .logo-section {
      text-align: center;
      margin-bottom: 30px;
    }

    .logo-section i {
      font-size: 48px;
      color: #667eea;
      margin-bottom: 10px;
    }

    .logo-section h2 {
      font-size: 24px;
      color: #111827;
      font-weight: 700;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: #6b7280;
      margin-bottom: 8px;
      text-transform: uppercase;
    }

    input {
      width: 100%;
      padding: 12px 15px;
      border: 2px solid #e5e7eb;
      border-radius: 8px;
      font-family: 'Poppins', sans-serif;
      font-size: 14px;
      transition: border-color 0.3s;
    }

    input:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .btn-login {
      width: 100%;
      padding: 12px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      font-family: 'Poppins', sans-serif;
      cursor: pointer;
      font-size: 14px;
      transition: transform 0.2s, box-shadow 0.2s;
      margin-top: 10px;
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    .forgot-password {
      text-align: center;
      margin-top: 15px;
    }

    .forgot-password a {
      font-size: 12px;
      color: #667eea;
      text-decoration: none;
      font-weight: 600;
    }

    .forgot-password a:hover {
      text-decoration: underline;
    }

    .demo-section {
      margin-top: 30px;
      padding-top: 20px;
      border-top: 2px solid #e5e7eb;
    }

    .demo-section h3 {
      font-size: 13px;
      color: #6b7280;
      font-weight: 600;
      text-transform: uppercase;
      margin-bottom: 15px;
    }

    .demo-buttons {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 10px;
    }

    .demo-btn {
      padding: 10px;
      border: 2px solid #e5e7eb;
      background: white;
      border-radius: 6px;
      cursor: pointer;
      font-size: 12px;
      font-weight: 600;
      color: #667eea;
      transition: all 0.3s;
      font-family: 'Poppins', sans-serif;
    }

    .demo-btn:hover {
      background: #f3f4f6;
      border-color: #667eea;
    }

    @media (max-width: 768px) {
      .container-auth {
        grid-template-columns: 1fr;
      }

      .auth-left {
        padding: 40px 30px;
      }

      .auth-right {
        padding: 40px 30px;
      }

      .auth-left h1 {
        font-size: 24px;
      }
    }

    .module-list {
      display: grid;
      grid-template-columns: 1fr;
      gap: 10px;
      margin-top: 20px;
    }

    .module-btn {
      padding: 12px;
      border: 2px solid #e5e7eb;
      background: white;
      border-radius: 8px;
      cursor: pointer;
      font-size: 13px;
      font-weight: 600;
      color: #111827;
      transition: all 0.3s;
      font-family: 'Poppins', sans-serif;
      text-align: left;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .module-btn:hover {
      background: #667eea;
      color: white;
      border-color: #667eea;
    }

    .module-btn i {
      font-size: 16px;
    }
  </style>
</head>
<body>
  <div class="container-auth">
    <!-- Left Side -->
    <div class="auth-left">
      <h1>Portal Empresa</h1>
      <p>Sistema completo de gestión empresarial</p>
      
      <div class="features">
        <div class="feature-item">
          <i class="fas fa-check-circle"></i>
          <span>Gestión integrada de productos</span>
        </div>
        <div class="feature-item">
          <i class="fas fa-check-circle"></i>
          <span>Control de ventas en tiempo real</span>
        </div>
        <div class="feature-item">
          <i class="fas fa-check-circle"></i>
          <span>Inventario y stock automático</span>
        </div>
        <div class="feature-item">
          <i class="fas fa-check-circle"></i>
          <span>Reportes y análisis completos</span>
        </div>
        <div class="feature-item">
          <i class="fas fa-check-circle"></i>
          <span>Facturación electrónica</span>
        </div>
        <div class="feature-item">
          <i class="fas fa-check-circle"></i>
          <span>Gestión de clientes y crédito</span>
        </div>
      </div>
    </div>

    <!-- Right Side -->
    <div class="auth-right">
      <div class="logo-section">
        <i class="fas fa-store"></i>
        <h2>TechStore</h2>
      </div>

      <form id="loginForm">
        <div class="form-group">
          <label>Usuario o Email</label>
          <input type="text" placeholder="empresa@techstore.com" required>
        </div>

        <div class="form-group">
          <label>Contraseña</label>
          <input type="password" placeholder="••••••••" required>
        </div>

        <div class="form-group">
          <label style="display: flex; align-items: center; text-transform: none; font-weight: 400;">
            <input type="checkbox" style="width: auto; margin-right: 8px;">
            Recuérdame
          </label>
        </div>

        <button type="submit" class="btn-login">Acceder al Sistema</button>
      </form>

      <div class="forgot-password">
        <a href="#"><i class="fas fa-key"></i> ¿Olvidaste tu contraseña?</a>
      </div>

      <!-- Demo Links -->
      <div class="demo-section">
        <h3>Acceso Rápido - Demo</h3>
        <div class="module-list">
          <a href="/PuntoVenta/empresa/dashboard.php" class="module-btn">
            <i class="fas fa-chart-line"></i> Dashboard
          </a>
          <a href="/PuntoVenta/empresa/productos.php" class="module-btn">
            <i class="fas fa-box"></i> Productos
          </a>
          <a href="/PuntoVenta/empresa/ventas.php" class="module-btn">
            <i class="fas fa-shopping-cart"></i> Ventas
          </a>
          <a href="/PuntoVenta/empresa/clientes.php" class="module-btn">
            <i class="fas fa-users"></i> Clientes
          </a>
          <a href="/PuntoVenta/empresa/stock.php" class="module-btn">
            <i class="fas fa-warehouse"></i> Stock
          </a>
          <a href="/PuntoVenta/empresa/facturas.php" class="module-btn">
            <i class="fas fa-receipt"></i> Facturas
          </a>
          <a href="/PuntoVenta/empresa/reportes.php" class="module-btn">
            <i class="fas fa-chart-bar"></i> Reportes
          </a>
          <a href="/PuntoVenta/empresa/configuracion.php" class="module-btn">
            <i class="fas fa-cog"></i> Configuración
          </a>
        </div>
      </div>
    </div>
  </div>

  <script src="../recursos/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
      e.preventDefault();
      // Simulate login and redirect to dashboard
      setTimeout(() => {
        window.location.href = '/PuntoVenta/empresa/dashboard.php';
      }, 500);
    });
  </script>
</body>
</html>
