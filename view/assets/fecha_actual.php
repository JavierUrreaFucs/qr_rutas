<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rutas";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
// Obtener la fecha actual
$fecha_actual = date('Y-m-d');

// Actualizar el campo 'cupo' a la primera hora del día siguiente
$fecha_siguiente = date('Y-m-d', strtotime('+1 day', strtotime($fecha_actual)));

$sql1 = "UPDATE rutas SET cupo = 19 WHERE id_rutas = 1";
$sql2 = "UPDATE rutas SET cupo = 23 WHERE id_rutas = 2";
$sql3 = "UPDATE rutas SET cupo = 19 WHERE id_rutas = 3";
$sql4 = "UPDATE rutas SET cupo = 23 WHERE id_rutas = 4";

if (($conn->query($sql1) === TRUE) && ($conn->query($sql2) === TRUE) && ($conn->query($sql3) === TRUE) && ($conn->query($sql4) === TRUE)) {
    echo "Campos actualizados correctamente";
} else {
    echo "Error al actualizar el campo: " . $conn->error;
}

$conn->close();

?>
