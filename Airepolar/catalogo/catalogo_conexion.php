<?php
session_start();
$servername = "127.0.0.1";
$username = "u509327142_Judag31";
$password = "RojoVerde27";
$dbname = "u509327142_climapolardame";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener productos
$sql = "SELECT nombre, precio, stock FROM productos";
$result = $conn->query($sql);
?>
