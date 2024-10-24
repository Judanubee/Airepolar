<?php
ob_start(); // Iniciar el buffer de salida

include 'db.php';
session_start();

// Obtener datos del formulario
$id = $_POST['id'];
$username = $_POST['username'];
$new_password = $_POST['password'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$tipo_usuario = $_POST['tipo_usuario'];

// Preparar la consulta SQL
if (!empty($new_password)) {
    // Si hay una nueva contraseña, usarla directamente (no recomendado por seguridad)
    $sql = "UPDATE trabajadores SET usuario=?, contraseña=?, nombre=?, apellido=?, tipo_usuario=? WHERE id_trabajador=?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en preparación de consulta: " . $conn->error);
    }
    $stmt->bind_param("sssssi", $username, $new_password, $nombre, $apellido, $tipo_usuario, $id);
} else {
    // Si no hay nueva contraseña, no la actualices
    $sql = "UPDATE trabajadores SET usuario=?, nombre=?, apellido=?, tipo_usuario=? WHERE id_trabajador=?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en preparación de consulta: " . $conn->error);
    }
    $stmt->bind_param("ssssi", $username, $nombre, $apellido, $tipo_usuario, $id);
}

// Ejecutar la consulta
if ($stmt->execute()) {
    // Si la actualización es exitosa, redirigir con mensaje de éxito
    header("Location: /AirePolar/administrador/lista_usuarios.php?action=update&success=1");
} else {
    // Si ocurre un error, redirigir con mensaje de error
    header("Location: /AirePolar/administrador/editar_usuario.php?action=update&error=" . urlencode($stmt->error));
}

$stmt->close();
$conn->close();
ob_end_flush(); // Finalizar el buffer de salida y enviar la salida
?>
