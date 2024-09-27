<?php
// Incluir archivo de conexión a la base de datos
session_start();
//include_once 'home_user.php';

if (!isset($_SESSION['username'])) {
    header("location: index.html"); // Redirigir si no hay sesión activa
    exit;
}
//include_once 'home_post_view.php';
require_once 'config.php';

/*$message = '';
$error = '';
$error_c = '';*/

$message = '';
$error = '';

// Verificar si el formulario de comentario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $commentText = $_POST['commentText'];
    $postId = $_POST['postId'];
    //$userId = $_SESSION['user_id']; // Asegúrate de tener un campo `user_id` en tu tabla de usuarios o ajusta según sea necesario

    // Validar que el comentario no esté vacío
    if (empty($commentText)) {
        echo "Por favor, ingrese un comentario.";
    } else {
        // Consulta SQL para insertar el comentario
        $sql_user = "SELECT user_id FROM usuario WHERE user = '{$_SESSION['username']}'";
        $stmt_user = $mysqli->query($sql_user);
        if ($stmt_user->num_rows > 0) {
            while ($row = $stmt_user->fetch_assoc()) {
                $userId = $row['user_id'];
            }
        }
        $sql = "INSERT INTO comentarios (post_id, user_id, texto) VALUES (?, ?, ?)";
        
        if ($userId == 1) {
            if ($stmt = $mysqli->prepare($sql)) {
                /*$message = "guardado correctamente.";
                $error = "al guardar el comentario: " . $stmt->error;
                $error_c = "al preparar la consulta: " . $mysqli->error;*/
                $stmt->bind_param("iis", $postId, $userId, $commentText);

                if ($stmt && $stmt->execute()) {
                    header('Location: home_post_admin.php?message=Publicación creada correctamente.');
                    exit;
                } else {
                    header('Location: home_post_admin.php?error=Error al crear la publicación.');
                    exit;
                }

                
                /*if ($stmt->execute()) {
                    echo "</div>";
                    echo "<div class='card bg-success text-white mt-4' style='max-width: 300px; margin: 0 auto; font-size: 12px; padding: 0px;'>";
                    echo "<div class='card-body'>";
                    echo "Comentario " .$message;
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    header("Location: home_post_admin.php?msg=success");
                    
                } else {
                    echo "</div>";
                    echo "<div class='card bg-success text-white mt-4' style='max-width: 300px; margin: 0 auto; font-size: 12px; padding: 0px;'>";
                    echo "<div class='card-body'>";
                    echo "Error " .$error_c;
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    header("Location: home_post_admin.php?msg=error&error_msg=" . urlencode($stmt->error));
        
                    
                }*/
            } 
            $mysqli->close();
        } else {
            if ($stmt = $mysqli->prepare($sql)) {
                /*$message = "guardado correctamente.";
                $error = "al guardar el comentario: " . $stmt->error;
                $error_c = "al preparar la consulta: " . $mysqli->error;*/
                $stmt->bind_param("iis", $postId, $userId, $commentText);

                if ($stmt && $stmt->execute()) {
                    header('Location: home_user.php?message=Publicación creada correctamente.');
                    exit;
                } else {
                    header('Location: home_user.php?error=Error al crear la publicación.');
                    exit;
                }
                /*if ($stmt->execute()) {
                    echo "</div>";
                    echo "<div class='card bg-success text-white mt-4' style='max-width: 300px; margin: 0 auto; font-size: 12px; padding: 0px;'>";
                    echo "<div class='card-body'>";
                    echo "Comentario " .$message;
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    header("Location: home_user.php?msg=success");
                    
                } else {
                    echo "</div>";
                    echo "<div class='card bg-success text-white mt-4' style='max-width: 300px; margin: 0 auto; font-size: 12px; padding: 0px;'>";
                    echo "<div class='card-body'>";
                    echo "Error " .$error_c;
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    header("Location: home_user.php?msg=error&error_msg=" . urlencode($stmt->error));
        
                    
                }*/
            } 
            $mysqli->close();
        }       
    }
} else {
    // Si el método de solicitud no es POST, redirigir a home_user.php
    header("Location: home_user.php");
    exit();
}

// Cerrar conexión
$mysqli->close();
?>
