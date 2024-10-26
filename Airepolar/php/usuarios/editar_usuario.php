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

$id = $_GET['id'];
$sql = "SELECT * FROM trabajadores WHERE id_trabajador=$id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" href="../../css/index-style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Usuario</h1>
        <?php
        if (isset($_GET['success'])) {
            echo '<p class="success-message">Usuario actualizado exitosamente.</p>';
        } elseif (isset($_GET['error'])) {
            echo '<p class="error-message">Error al actualizar el usuario: ' . htmlspecialchars($_GET['error']) . '</p>';
        }
        ?>
        <div class="form-container">
            <form action="actualizar_usuarios.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $user['id_trabajador']; ?>">
                
                <div class="form-group">
                    <label for="username">Usuario</label>
                    <input type="text" id="username" name="username" value="<?php echo $user['usuario']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password">
                </div>
                
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $user['nombre']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido" name="apellido" value="<?php echo $user['apellido']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="tipo_usuario">Tipo de Usuario</label>
                    <select id="tipo_usuario" name="tipo_usuario" required>
                        <option value="administrador" <?php if ($user['tipo_usuario'] == 'administrador') echo 'selected'; ?>>Administrador</option>
                        <option value="op_inventario" <?php if ($user['tipo_usuario'] == 'op_inventario') echo 'selected'; ?>>Operador Inventario</option>
                        <option value="op_servicios" <?php if ($user['tipo_usuario'] == 'op_servicios') echo 'selected'; ?>>Operador Servicios</option>
                        <option value="admin_catalogo" <?php if ($user['tipo_usuario'] == 'admin_catalogo') echo 'selected'; ?>>Administrador Catálogo</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="button-link">Actualizar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
