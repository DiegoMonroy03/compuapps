<?php
//session_start();



// Obtener el nombre del usuario
$username = 'Admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .user-container {
            max-width: 600px;
            margin-top: 50px;
        }
    </style>
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
        <a class="nav-link" href="logout.php">Cerrar sesion</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="home_admin_view.php">Publicar</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container user-container mt-5">
    <h1>Bienvenido Administrador</h1>

    <?php 
    if (isset($_GET['message'])) {
        echo '<div class="alert alert-success">' . htmlspecialchars($_GET['message']) . '</div>';
    }

    if (isset($_GET['error'])) {
        echo '<div class="alert alert-danger">' . htmlspecialchars($_GET['error']) . '</div>';
    }
    ?>

    <!-- Contenido específico para usuarios normales -->
    <!--<div class="text-center">
        <a href="logout.php" class="btn btn-danger mt-3">Cerrar sesión</a>
    </div> -->
    <!--<a href="logout.php" class="btn btn-danger mt-3">Cerrar sesión</a>-->
    <script>
        // Función para obtener parámetros de la URL
        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        };

        // Obtener el mensaje y mostrarlo si existe
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
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="script.js"></script>

</body>
</html>
