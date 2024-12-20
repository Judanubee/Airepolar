<?php
ob_start(); // Iniciar el buffer de salida

include '../../db.php';
session_start();

// Obtener datos del formulario
$id = $_POST['id'];
$usuario = $_POST['usuario'];
$new_password = $_POST['password'];
$nombre = $_POST['nombre'];
$rol = $_POST['rol'];

// Preparar la consulta SQL
if (!empty($new_password)) {
    // Si hay una nueva contraseña, usarla directamente (no recomendado por seguridad)
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);   
    $sql = "UPDATE usuarios SET usuario=?, contraseña=?, nombre=?, rol=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en preparación de consulta: " . $conn->error);
    }
    $stmt->bind_param("ssssi", $usuario, $hashed_password, $nombre, $rol, $id);
} else {
    // Si no hay nueva contraseña, no la actualices
    $sql = "UPDATE usuarios SET usuario=?, nombre=?, rol=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en preparación de consulta: " . $conn->error);
    }
    $stmt->bind_param("sssi", $usuario, $nombre, $rol, $id);
}

// Ejecutar la consulta
if ($stmt->execute()) {
    // Si la actualización es exitosa, redirigir con mensaje de éxito
    header("Location: ../../administrador/lista_usuarios.php?action=update&success=1");
} else {
    // Si ocurre un error, redirigir con mensaje de error
    header("Location: ../../administrador/lista_usuarios.php?action=update&error=" . urlencode($stmt->error));
}

$stmt->close();
$conn->close();
ob_end_flush(); // Finalizar el buffer de salida y enviar la salida
?>
