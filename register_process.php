<?php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

$username = $_POST['registerUsername'] ?? '';
$password = $_POST['registerPassword'] ?? '';
// Verificar si los campos están vacíos
if (empty($username) || empty($password)) {
    echo json_encode(['status' => 'error', 'message' => 'Por favor, complete todos los campos.']);
    exit;
}

// Verificar si el usuario ya existe
$sql_check_user = "SELECT user_id FROM usuario WHERE user = ?";
if ($stmt_check_user = $mysqli->prepare($sql_check_user)) {
    $stmt_check_user->bind_param("s", $username);
    $stmt_check_user->execute();
    $stmt_check_user->store_result();
    
    if ($stmt_check_user->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'El usuario ya existe. Por favor, elija otro nombre de usuario.']);
        exit;
    }
    $stmt_check_user->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error en la preparación de la consulta.']);
    exit;
}

// Generar el hash de la contraseña
$password_hashed = password_hash($password, PASSWORD_DEFAULT);

// Insertar el nuevo usuario en la base de datos
$sql_insert_user = "INSERT INTO usuario (user, password) VALUES (?, ?)";
if ($stmt_insert_user = $mysqli->prepare($sql_insert_user)) {
    $stmt_insert_user->bind_param("ss", $username, $password_hashed);
    
    if ($stmt_insert_user->execute()) {
        echo json_encode(['status' => 'success', 'message' => '¡Registro exitoso! Ahora puedes iniciar sesión.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al registrar el usuario.']);
    }
    
    $stmt_insert_user->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error en la preparación de la consulta.']);
}

$mysqli->close();
?>
