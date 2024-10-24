<?php
session_start();

// Crear conexión
include 'db.php';
session_start();


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
