
<?php
// Datos de conexión a la base de datos (ajustar según tus credenciales de PHPMyAdmin)
// mysql://dajdgv8izdx4tcrh:cu32yzvacbwgml27@vvfv20el7sb2enn3.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/sry1zz8n0zm8ltsz
/*$servername = "mysql://utb4v6im1bvgb4x0:pp3webnl29j458m2@otmaa16c1i9nwrek.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/rmepvv886j1zozss";
$username = "utb4v6im1bvgb4x0";
$password = "pp3webnl29j458m2";
$dbname = "rmepvv886j1zozss";*/

$puerto = 3306;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "posterdb";

// Crear conexión
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}
?>

