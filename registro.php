<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro Usuario</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Registro de usuario</div>
                    <div class="card-body">
                        <form id="registerForm" action="register_process.php" method="post">
                            <div class="form-group">
                                <label for="registerUsername">Nombre de Usuario</label>
                                <input type="text" id="registerUsername" name="registerUsername" class="form-control" required>
                                <div id="usernameError" class="error text-danger"></div>
                            </div>
                            <div class="form-group">
                                <label for="registerPassword">Contraseña (mínimo 8 caracteres)</label>
                                <input type="password" id="registerPassword" name="registerPassword" class="form-control" pattern=".{8,}" required>
                                <div id="passwordError" class="error text-danger"></div>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </form>
                        <div id="errorMsg" class="alert alert-danger" style="display: none;">
                            Ha ocurrido un error. Por favor, inténtelo nuevamente más tarde.
                        </div>
                        <div id="successMsg" class="alert alert-success" style="display: none;">
                            ¡Registro exitoso!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script_rigistro.js"></script>
</body>
</html>
