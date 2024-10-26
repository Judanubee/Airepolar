<?php
$servername = "127.0.0.1";
$username = "u509327142_Judag31";
$password = "RojoVerde27";
$dbname = "u509327142_climapolardame";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validar el parámetro ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Prevenir SQL injection usando prepared statements
    $stmt = $conn->prepare("DELETE FROM trabajadores WHERE id_trabajador = ?");
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
