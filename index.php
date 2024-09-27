<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
  <title>Inicio de Sesión</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="uploads/logo2.jpg" width="30" height="30" class="d-inline-block align-top" alt="Logo">
    CompuApps
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Inicio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="registro.php">Registrarse</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contacto.php">Contacto</a>
      </li>
    </ul>
  </div>
</nav>

<br>
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">Inicio</div>
        <div class="card-body">
          <form id="loginForm">
            <div class="form-group">
              <label for="loginUsername">Usuario</label>
              <input type="text" id="loginUsername" name="username" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="loginPassword">Contraseña</label>
              <input type="password" id="loginPassword" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Iniciar</button>
          </form>
          <hr>
          <p>¿Nuevo usuario? <a href="registro.php">Registrarse aquí</a></p>
          <div id="error-msg" class="alert alert-danger mt-3" role="alert" style="display: none;">
            Contraseña incorrecta. Inténtelo nuevamente.
          </div>
        </div>
      </div>
    </div>
  </div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="script.js"></script>
</body>
</html>
