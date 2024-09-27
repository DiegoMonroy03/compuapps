<?php
session_start();
include_once 'home_admin_view.php';
require_once 'config.php';

//header('Content-Type: application/json'); // Forzar siempre la respuesta como JSON

$message = '';
$error = '';

$userId = '1'; // Obtener de la sesión en una implementación real

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $postTitle = $_POST['postTitle'] ?? null;
    $postContent = $_POST['postContent'] ?? null;

    if (empty($postTitle)) {
        echo json_encode(['error' => 'El título es obligatorio.']);
        exit;
    }
    if (empty($postContent)) {
        echo json_encode(['error' => 'El contenido es obligatorio.']);
        exit;
    }

    $videoUrl = $_POST['videoUrl'] ?? null;

    // Validar imagen si se subió
    if (isset($_FILES['postImage']) && $_FILES['postImage']['error'] === UPLOAD_ERR_OK) {
        $imageTmpName = $_FILES['postImage']['tmp_name'];
        $imageData = file_get_contents($imageTmpName);
    } else {
        $imageData = null;
    }

    $currentDateShort = date('d-m-Y');

    // Preparar la consulta
    if ($imageData !== null && $videoUrl !== null) {
        $sql = "INSERT INTO post (titulo, poster, fecha, imagen, video, user_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sssssi", $postTitle, $postContent, $currentDateShort, $imageData, $videoUrl, $userId);
    } elseif ($imageData !== null) {
        $sql = "INSERT INTO post (titulo, poster, fecha, imagen, user_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssssi", $postTitle, $postContent, $currentDateShort, $imageData, $userId);
    } elseif ($videoUrl !== null) {
        $sql = "INSERT INTO post (titulo, poster, fecha, video, user_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssssi", $postTitle, $postContent, $currentDateShort, $videoUrl, $userId);
    } else {
        $sql = "INSERT INTO post (titulo, poster, fecha, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("sssi", $postTitle, $postContent, $currentDateShort, $userId);
    }

    /*if ($stmt) {
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Publicación creada correctamente.']);
        } else {
            echo json_encode(['error' => 'Error al crear la publicación: ' . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['error' => 'Error en la preparación de la consulta.']);
    }*/
    if ($stmt && $stmt->execute()) {
        header('Location: home_admin.php?message=Publicación creada correctamente.');
        exit;
    } else {
        header('Location: home_admin.php?error=Error al crear la publicación.');
        exit;
    }
} else {
    //echo json_encode(['error' => 'Método no permitido.']);
}
?>
