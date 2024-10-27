<?php
include 'db.php';
session_start();

// Validar el parámetro ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Prevenir SQL injection usando prepared statements
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id); // "i" indica que el parámetro es un entero (integer)
    
    if ($stmt->execute()) {
        echo "Usuario eliminado exitosamente";
    } else {
        echo "Error al intentar eliminar el usuario: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID de usuario no válido";
}

$conn->close();

// Redireccionar después de realizar las operaciones de eliminación
header("Location: ../../administrador/lista_usuarios.php");
exit();
?>

<!-- Botón de cerrar sesión -->
<button onclick="window.location.href='/Airepolar/logout.php';" class="logout-button">Cerrar sesión</button>
