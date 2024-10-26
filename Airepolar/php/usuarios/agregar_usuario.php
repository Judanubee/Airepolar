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

// Obtener datos del formulario
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$tipo_usuario = $_POST['tipo_usuario'];

// Hashear la contraseña
// Preparar la consulta SQL
$sql = "INSERT INTO trabajadores (usuario, contraseña, nombre, apellido, tipo_usuario) 
        VALUES ('$usuario', '$contraseña', '$nombre', '$apellido', '$tipo_usuario')";

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
