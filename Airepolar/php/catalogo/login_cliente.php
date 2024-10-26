<?php
session_start();

// Crear conexión
$servername = "192.168.0.7";
$username = "Judag31";
$password = "123";
$dbname = "climapolar";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Crear una sesión de invitado
$_SESSION['username'] = 'guest';
$_SESSION['tipo_usuario'] = 'cliente';

// Insertar registro en la tabla de clientes
$sql = "INSERT INTO clientes (usuario, hora) VALUES ('guest', NOW())";
if (!$conn->query($sql)) {
    echo "Error al registrar la entrada: " . $conn->error;
}

// Redirigir al catálogo de productos
header("Location: ../../catalogo.html");

$conn->close();
?>
