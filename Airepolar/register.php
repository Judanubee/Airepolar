<?php
include 'db.php';
session_start();

// Generar Token CSRF si no existe
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificamos el token CSRF
    if (!hash_equals($_SESSION['token'], $_POST['csrf_token'])) {
        die('Token inválido.');
    }

    // Escapar las entradas del usuario
    $nombre = htmlspecialchars($_POST['nombre']);
    $usuario = htmlspecialchars($_POST['usuario']);
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT); // Cifrado de la contraseña
    $rol = $_POST['rol'];   

    // Verificamos si el usuario existe
    if ($check_usuario = $conn->prepare('SELECT usuario FROM usuarios WHERE usuario = ?')) {
        $check_usuario->bind_param("s", $usuario);
        $check_usuario->execute();
        $check_usuario->store_result();

        // Si el correo ya existe, mostrar un alert
        if ($check_usuario->num_rows > 0) {
            echo "<script>alert('El usuario ya existe'); window.location.href='register.php';</script>";
        } else {
            // Insertar el nuevo usuario
            if ($stmt = $conn->prepare("INSERT INTO usuarios (usuario, nombre, contraseña, rol) VALUES (?, ?, ?, ?)")) {
                $stmt->bind_param("ssss", $usuario, $nombre, $contraseña, $rol);

                // Verificamos si la inserción fue exitosa
                if ($stmt->execute()) {
                    echo "<script>alert('Registro exitoso'); window.location.href='index.html';</script>";
                } else {
                    echo "<script>alert('Error al registrar el usuario'); window.location.href='register.php';</script>";
                }

                // Cerramos el statement después de ejecutarlo
                $stmt->close();
            } else {
                // Mostrar el error si la preparación falla
                echo "Error en la preparación de la consulta: " . $conn->error;
            }
        }

        // Cerrar el statement del check_usuario
        $check_usuario->close();
    } else {
        // Mostrar el error si la preparación falla
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>

<link rel="stylesheet" href="css/index.css" />
<!-- Formulario con token CSRF -->
<form action="register.php" method="post" class="formulario-registro-unique">
    <label for="nombre" class="label-nombre-unique">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required class="input-nombre-unique">
    <br>
    <label for="usuario" class="label-usuario-unique">Usuario:</label>
    <input type="text" id="usuario" name="usuario" required class="input-usuario-unique">
    <br>
    <label for="password" class="label-password-unique">Contraseña:</label>
    <input type="password" id="password" name="contraseña" required class="input-password-unique">
    <br>
    <label for="rol" class="label-rol-unique">Rol:</label>
    <select id="rol" name="rol" class="select-rol-unique">
        <option value="Admin">Admin</option>
        <option value="Cliente">Cliente</option>
        <option value="Secretaria_Ventas">Secretaria Ventas</option>
        <option value="Secretaria_Compras">Secretaria Compras</option>
        <option value="Tecnico">Tecnico</option>
    </select>
    <br>
    <!-- Campo oculto para el token -->
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['token']; ?>" class="csrf-token-unique">
    <button type="submit" class="boton-registrar-unique">Registrar</button>
</form>
