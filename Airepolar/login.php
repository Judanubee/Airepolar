<?php

include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Escapar caracteres especiales para evitar ataques
    $usuario = htmlspecialchars($_POST['usuario']);
    $contraseña = $_POST['contraseña'];

    // Preparar la consulta para verificar si el usuario existe en la db
    $stmt = $conn->prepare("SELECT id, nombre, contraseña, rol FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario); 
    $stmt->execute(); 
    $stmt->store_result(); 

    // Verificación de existencia del usuario
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nombre, $hash, $rol); 
        $stmt->fetch();

        // Verificar si la contraseña ingresada coincide
        if (password_verify($contraseña, $hash)) {
            $_SESSION['id'] = $id; 
            $_SESSION['nombre'] = $nombre; 
            $_SESSION['rol'] = $rol;

            // Redirección según el rol
            if ($rol == 'Admin') {
                header("Location: /Airepolar/administrador/lista_usuarios.php");
            } elseif ($rol == 'Secretaria de compras') {
                header("Location: /Airepolar/secretaria_compras/compras.html");
            } elseif ($rol == 'Secretaria de ventas') {
                header("Location: /Airepolar/secretaria_ventas/ventas.html");
            } elseif ($rol == 'Tecnico') {
                header("Location: /Airepolar/tecnico/tecnico.html");
            } elseif ($rol == 'Cliente') {
                header("Location: /Airepolar/cliente/cliente.html");
            }
            exit();
        } else {
            // Contraseña incorrecta
            echo "<script>alert('usuario o contraseña incorrectos.');
                  window.location.href='index.html';</script>";
        }
    } else {
        // Usuario no encontrado
        echo "<script>alert('usuario o contraseña incorrectos.');
              window.location.href='index.html';</script>";
    }

    // Cerrar la variable $stmt y la conexión
    $stmt->close();
    $conn->close();
}
?>
