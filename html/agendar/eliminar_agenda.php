<?php
// Datos de conexión
$servername = "127.0.0.1";
$username = "u509327142_Judag31";
$password = "RojoVerde27";
$dbname = "u509327142_climapolardame";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}

// Obtener el ID de la URL
$id = $_GET["id"];

// Eliminar registro
$sql = "DELETE FROM agendas WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Registro eliminado exitosamente";
} else {
    echo "Error eliminando el registro: " . $conn->error;
}

$conn->close();
header("Location: ver_agendas.php");
exit();
?>
