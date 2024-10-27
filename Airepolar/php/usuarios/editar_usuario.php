<?php
include 'db.php';
session_start();

$id = $_GET['id'];
$sql = "SELECT * FROM usuarios WHERE id=$id";
$result = $conn->query($sql);
$usuario = $result->fetch_assoc();

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
                <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
                
                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="id" name="usuario" value="<?php echo $usuario['usuario']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password">
                </div>
                
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="rol">Rol</label>
                    <select id="rol" name="rol" required>
                        <option value="Admin" <?php if ($usuario['rol'] == 'Admin') echo 'selected'; ?>>Admin</option>
                        <option value="Secretaria de compras" <?php if ($usuario['rol'] == 'Secretaria de compras') echo 'selected'; ?>>Secretaria de compras</option>
                        <option value="Secretaria de ventas" <?php if ($usuario['rol'] == 'Secretaria de ventas') echo 'selected'; ?>>Secretaria de ventas</option>
                        <option value="Tecnico" <?php if ($usuario['rol'] == 'Tecnico') echo 'selected'; ?>>Tecnico</option>
                        <option value="Cliente" <?php if ($usuario['rol'] == 'Cliente') echo 'selected'; ?>>Cliente</option>

                    </select>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="button-link">Actualizar Usuario</button>
                </div>
            </form>
        </div>
        
        <!-- Botón de cerrar sesión -->
        <button onclick="window.location.href='/Airepolar/logout.php';" class="logout-button">Cerrar sesión</button>
    </div>
</body>
</html>
