<?php

//session_start();
include_once 'home_post_view.php';
require_once 'config.php';
$visible = false;
/*$sql_user = "SELECT * FROM usuario ";
$result_user = $mysqli->query($sql_user);
if ($result_user->num_rows > 0) {
    while ($row = $result_user->fetch_assoc()) {
        $user_id = $row['user_id'];
        $user_name = $row['user'];
        if ($user_id == 1 && $user_name == 'Admin'){
            
            echo "<div class='text-center'>";
            echo "<a href='home_admin_view.php' class='btn btn-primary mt-3'>Muro Administrador</a>";
            echo "</div>";
            echo "<br>";
        }
    }
}*/


// Consulta SQL para obtener las publicaciones del administrador
$sql = "SELECT * FROM post ORDER BY post_id DESC"; // Suponiendo que 'Admin' es el nombre del usuario administrador

// Ejecutar consulta
$result = $mysqli->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='container mt-5'>";
        echo "<div class='row justify-content-center'>";
        echo "<div class='col-md-8'>"; // Ajustar tamaño de la columna
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . htmlspecialchars($row['titulo']) . "</h5>";
        echo "<p class='card-text'>" . htmlspecialchars($row['poster']) . "</p>";
        // Mostrar video si está presente
        $videoUrl = $row['video'];

        if (strlen($videoUrl) > 0) {
        // Usar una expresión regular para extraer el ID
            preg_match('/d\/(.+?)\//', $videoUrl, $matches);

            // Verificar si se encontró el ID
            if (isset($matches[1])) {
                $fileId = $matches[1];
                //echo $fileId; // Esto imprimirá el ID
            } else {
                echo "No se pudo encontrar el ID.";
            }
            // Mostrar video si está presente
            $videoUrlf = "https://drive.google.com/file/d/" . $fileId . "/preview";
            //echo $videoUrlf;
            /*echo '<iframe width="640" height="480" src="' . $videoUrlf . '" frameborder="0" allowfullscreen></iframe>';*/
            echo '<div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; height: auto;">
                    <iframe src="' . $videoUrlf . '" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" frameborder="0" allowfullscreen></iframe>
                  </div>';

        }
        // Mostrar imagen si está presente
        if (!empty($row['imagen'])) {
            $base64_image = base64_encode($row['imagen']);
            $imageMimeType = 'image/jpeg'; // Ajusta según el tipo MIME de tu imagen
            
            echo "<div class='responsive-img-container'>";
            echo "<img src='data:" . $imageMimeType . ";base64," . $base64_image . "' class='card-img-top img-fluid' alt='Imagen del post'>";
            echo "</div>";
        }

        
        // Formulario para comentarios
        echo "<form action='guardar_comentario.php' method='post'>";
        echo "<div class='form-group'>";
        echo "<label for='commentText'>Tu comentario:</label>";
        echo "<textarea class='form-control' id='commentText' name='commentText' rows='3' required></textarea>";
        echo "</div>";
        echo "<input type='hidden' name='postId' value='" . htmlspecialchars($row['post_id']) . "'>"; // Id del post
        echo "<button type='submit' class='btn btn-primary'>Enviar comentario</button>";
        echo "</form>";
        
        // Mostrar comentarios asociados al post
        $postId = $row['post_id'];
        $sql_comments = "SELECT c.texto, u.user FROM comentarios c
                         INNER JOIN usuario u ON c.user_id = u.user_id
                         WHERE c.post_id = ?
                         ORDER BY c.post_id DESC";
        
        if ($stmt_comments = $mysqli->prepare($sql_comments)) {
            $stmt_comments->bind_param("i", $postId);
            $stmt_comments->execute();
            $stmt_comments->bind_result($commentText, $userName);
            
            echo "<div class='mt-3'>";
            echo "<h6>Comentarios:</h6>";
            
            while ($stmt_comments->fetch()) {
                echo "<p><strong>" . htmlspecialchars($userName) . ":</strong> " . htmlspecialchars($commentText) . "</p>";
            }
            
            echo "</div>";
            
            $stmt_comments->close();
        } else {
            echo "Error al preparar la consulta de comentarios: " . $mysqli->error;
        }
        
        echo "</div>"; // Cierre de card-body
        echo "</div>"; // Cierre de card
        echo "</div>"; // Cierre de col-md-8
        echo "</div>"; // Cierre de row
        echo "</div>"; // Cierre de container
        echo "<br>";
    }
} else {
    echo "No se encontraron publicaciones del administrador.";
}
// Cerrar conexión
$mysqli->close();
?>
