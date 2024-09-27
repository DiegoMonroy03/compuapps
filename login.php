<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    echo json_encode(['status' => 'error', 'message' => 'Por favor, complete todos los campos.']);
    exit;
}

// Preparar la consulta SQL para verificar las credenciales
$sql = "SELECT * FROM usuario WHERE user = ?";
if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("s", $username);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $row['user']; // Guardar el nombre del usuario en la sesión
                if ($row['user'] == 'Admin' && $row['user_id'] == 1) {
                    echo json_encode(['status' => 'success_admin']);
                } else {
                    echo json_encode(['status' => 'success_user']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Contraseña incorrecta.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Usuario no encontrado.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error en la ejecución de la consulta.']);
    }
    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error en la preparación de la consulta.']);
}
$mysqli->close();
?>
