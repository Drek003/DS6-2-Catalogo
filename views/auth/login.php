<!DOCTYPE html>
<html lang="en">
<head>  <meta charset="UTF-8">  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CodeCorp Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
  <div class="background-circle"></div>
  
  <div class="container">
    <div class="login-container">      <div class="login-sidebar">
        <div class="brand">
          <div class="logo">
            <i class="bi bi-cart"></i>
          </div>
          <h1>CodeCorp</h1>
        </div>
        <div class="user-profile">
          <div class="avatar-container">
            <div class="avatar-placeholder">
              <i class="bi bi-person-fill"></i>
            </div>
          </div>
          <p class="welcome-text">Bienvenido</p>
        </div>
        <div class="sidebar-footer">
          <div class="world-map"></div>
          <p class="copyright">© 2025 CodeCorp</p>
        </div>
      </div>
      
      <div class="login-content">
        <div class="login-header">
          <h2>Log In</h2>
          <p>Ingrese sus credenciales de acceso</p>
        </div>
        
        <form id="loginForm" class="login-form">          <div class="form-group">
            <label for="user">Usuario</label>
            <div class="input-container">
              <i class="bi bi-envelope-fill"></i>
              <input type="user" id="user" name="user" placeholder="Ingrese su Usuario" required>
              <div class="validation-icon"></div>
            </div>
            <small class="error-message"></small>
          </div>
          
          <div class="form-group">
            <label for="password">Contraseña</label>
            <div class="input-container">
              <i class="bi bi-lock-fill"></i>
              <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required>
              <button type="button" class="toggle-password">
              </button>
              <div class="validation-icon"></div>
            </div>
            <small class="error-message"></small>
          </div>
            <button type="submit" id="loginButton" class="login-button">
            <span>Ingresar</span>
            <i class="bi bi-arrow-right"></i>
          </button>
        </form>  
<script src="../../assets/js/app.js"></script>
</body>
</html>