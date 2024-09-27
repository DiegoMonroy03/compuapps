
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Administrador</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .admin-container {
            max-width: 600px;
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container admin-container mt-5">
    <h1>Bienvenido, Administrador</h1>

    <?php 
    if (isset($_GET['message'])) {
        echo '<div class="alert alert-success">' . htmlspecialchars($_GET['message']) . '</div>';
    }

    if (isset($_GET['error'])) {
        echo '<div class="alert alert-danger">' . htmlspecialchars($_GET['error']) . '</div>';
    }
    ?>

    <!-- Formulario para crear nuevas publicaciones -->
    <div class="card mt-4">
        <div class="card-header">Nueva Publicación</div>
        <div class="card-body">
            <form id="postForm" action="home_admin.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="postTitle">Título</label>
                    <input type="text" id="postTitle" name="postTitle" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="postContent">Contenido</label>
                    <textarea id="postContent" name="postContent" class="form-control" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="postImage">Imagen</label>
                    <input type="file" id="postImage" name="postImage" class="form-control-file">
                </div>
                <div class="form-group">
                    <label for="videoUrl">URL del Video (Google Drive)</label>
                    <input type="text" id="videoUrl" name="videoUrl" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Publicar</button>
            </form>
        </div>
    </div>
    <a href="home_post_admin.php" class="btn btn-primary mt-3">Muro Principal</a>
    <a href="logout.php" class="btn btn-danger mt-3">Cerrar sesión</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>
