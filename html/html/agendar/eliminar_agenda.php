<?php
// Datos de conexión
include 'db.php';
session_start();

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
