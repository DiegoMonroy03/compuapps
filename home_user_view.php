<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está autenticado
$loggedIn = isset($_SESSION['username']);
$username = $loggedIn ? $_SESSION['username'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .user-users-container {
            max-width: 600px;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
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
      <?php if ($loggedIn): ?>
        <a class="navbar-brand" href="www.telegram.com">
            <img src="uploads/tlg.png" width="30" height="30" class="d-inline-block align-top" alt="Telegram" >
        </a>
        <a class="navbar-brand" href="www.facebook.com">
            <img src="uploads/fb.png" width="40" height="30" class="d-inline-block align-top" alt="face" >
        </a>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Cerrar Sesión</a>
        </li>
      <?php else: ?>
        <a class="navbar-brand" href="www.telegram.com">
            <img src="uploads/tlg.png" width="30" height="30" class="d-inline-block align-top" alt="Telegram" >
        </a>
        <a class="navbar-brand" href="www.facebook.com">
            <img src="uploads/fb.png" width="40" height="30" class="d-inline-block align-top" alt="face" >
        </a>
        <li class="nav-item">
          <a class="nav-link" href="index.php">Iniciar Sesión</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="registro.php">Registro</a>
        </li>
      <?php endif; ?>
      <li class="nav-item">
        <a class="nav-link" href="contacto.php">Contacto</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container user-users-container mt-5">
    <?php if ($loggedIn): ?>
        <h1>Bienvenido, <?php echo htmlspecialchars($username); ?></h1>
    <?php else: ?>
        <h1>Bienvenido, visitante</h1>
        <!--<p>Para agregar comentarios, por favor <a href="index.php">inicia sesión</a> o <a href="registro.php">regístrate aquí</a>.</p>-->
    <?php endif; ?>

    <!-- Mostrar mensajes de éxito o error -->
    <?php 
    if (isset($_GET['message'])) {
        echo '<div class="alert alert-success">' . htmlspecialchars($_GET['message']) . '</div>';
    }

    if (isset($_GET['error'])) {
        echo '<div class="alert alert-danger">' . htmlspecialchars($_GET['error']) . '</div>';
    }
    ?>
</div>

<script>
    // Obtener parámetros de la URL
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    };

    // Mostrar mensajes basados en los parámetros de la URL
    document.addEventListener('DOMContentLoaded', function() {
        var msg = getUrlParameter('msg');
        var error_msg = getUrlParameter('error_msg');
        
        if (msg === 'success') {
            alert('Comentario guardado correctamente.');
        } else if (msg === 'error') {
            alert('Error al guardar el comentario: ' + error_msg);
        }
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="script.js"></script>

</body>
</html>
