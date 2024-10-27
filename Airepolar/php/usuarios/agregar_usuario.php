<?php

include 'Airepolar\db.php';
session_start();

// Obtener datos del formulario
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
$nombre = $_POST['nombre'];
$rol = $_POST['rol'];

// Hashear la contraseña (puedes usar password_hash si deseas)
$contraseña_hashed = password_hash($contraseña, PASSWORD_DEFAULT); // Asegúrate de usar un hash

// Preparar la consulta SQL
$sql = "INSERT INTO usuarios (usuario, contraseña, nombre, rol) 
        VALUES ('$usuario', '$contraseña_hashed', '$nombre', '$rol')";

if ($conn->query($sql) === TRUE) {
    // Si la inserción es exitosa, redirigir con mensaje de éxito
    header("Location: ../../administrador/administrador.php?action=add&success=1");
} else {
    // Si ocurre un error, redirigir con mensaje de error
    header("Location: ../../administrador/administrador.php?action=add&error=" . urlencode($conn->error));
}

$conn->close();
exit();
?>

<!-- Botón de cerrar sesión -->
<button onclick="window.location.href='/Airepolar/logout.php';" class="logout-button">Cerrar sesión</button>
