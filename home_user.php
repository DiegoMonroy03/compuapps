<?php
session_start();

// Verificar si el usuario está autenticado
$loggedIn = isset($_SESSION['username']);
$username = $loggedIn ? $_SESSION['username'] : null;

// Incluye archivo de conexión a la base de datos
include_once 'home_user_view.php';
require_once 'config.php';

// Definir el número de publicaciones por página
$postsPerPage = 3;

// Obtener el número de la página actual desde la URL, si no existe se asume que es la página 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

// Calcular el índice de inicio para la consulta SQL
$start = ($page - 1) * $postsPerPage;

// Consulta SQL para obtener las publicaciones con límite y desplazamiento (paginación)
$sql = "SELECT * FROM post ORDER BY post_id DESC LIMIT ?, ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('ii', $start, $postsPerPage);
$stmt->execute();
$result = $stmt->get_result();

// Verificar si hay resultados
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Mostrar cada post
        echo "<div class='container mt-5'>";
        echo "<div class='row justify-content-center'>";
        echo "<div class='col-md-8'>";
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . htmlspecialchars($row['titulo']) . "</h5>";
        echo "<p class='card-text'>" . htmlspecialchars($row['poster']) . "</p>";

        // Mostrar video si existe
        if (!empty($row['video'])) {
            preg_match('/d\/(.+?)\//', $row['video'], $matches);
            if (isset($matches[1])) {
                $fileId = $matches[1];
                $videoUrlf = "https://drive.google.com/file/d/" . $fileId . "/preview";
                echo '<iframe width="640" height="480" src="' . $videoUrlf . '" frameborder="0" allowfullscreen></iframe>';
            }
        }

        // Mostrar imagen si existe
        if (!empty($row['imagen'])) {
            $base64_image = base64_encode($row['imagen']);
            $imageMimeType = 'image/jpeg';
            echo "<img src='data:" . $imageMimeType . ";base64," . $base64_image . "' class='card-img-top img-fluid' alt='Imagen del post'>";
        }

        // Solo permitir comentarios si el usuario está autenticado
        if ($loggedIn) {
            echo "<form action='guardar_comentario.php' method='post'>";
            echo "<div class='form-group'>";
            echo "<label for='commentText'>Tu comentario:</label>";
            echo "<textarea class='form-control' id='commentText' name='commentText' rows='3' required></textarea>";
            echo "</div>";
            echo "<input type='hidden' name='postId' value='" . htmlspecialchars($row['post_id']) . "'>";
            echo "<button type='submit' class='btn btn-primary'>Enviar comentario</button>";
            echo "</form>";
        } else {
            // Si no está autenticado, mostrar un mensaje
            echo "<p>Para comentar, <a href='index.php'>inicia sesión</a> o <a href='registro.php'>regístrate aquí</a>.</p>";
        }

        // Mostrar comentarios
        $postId = $row['post_id'];
        $sql_comments = "SELECT c.texto, u.user FROM comentarios c INNER JOIN usuario u ON c.user_id = u.user_id WHERE c.post_id = ? ORDER BY c.post_id DESC";
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
        }
        echo "</div>"; // Cerrar card-body
        echo "</div>"; // Cerrar card
        echo "</div>"; // Cerrar col-md-8
        echo "</div>"; // Cerrar row
        echo "</div>"; // Cerrar container
        echo "<br>";
    }
} else {
    echo "No se encontraron publicaciones.";
}

// Consulta para obtener el total de publicaciones (necesaria para calcular el número de páginas)
$sql_total = "SELECT COUNT(*) AS total FROM post";
$result_total = $mysqli->query($sql_total);
$totalPosts = $result_total->fetch_assoc()['total'];

// Calcular el número total de páginas
$totalPages = ceil($totalPosts / $postsPerPage);

// Mostrar enlaces de paginación
echo '<br>';
echo '<nav aria-label="Page navigation">';
echo '<ul class="pagination justify-content-center">';

if ($page > 1) {
    echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">Anterior</a></li>';
}

for ($i = 1; $i <= $totalPages; $i++) {
    $active = $i == $page ? 'active' : '';
    echo '<li class="page-item ' . $active . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
}

if ($page < $totalPages) {
    echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">Siguiente</a></li>';
}

echo '</ul>';
echo '</nav>';
echo '<br>';

// Cerrar conexión
$mysqli->close();
?>
