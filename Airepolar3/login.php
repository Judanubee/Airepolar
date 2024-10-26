<?php

include 'db.php';
session_start();


// Obtener datos del formulario
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

// Consultar base de datos para trabajadores
$sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND contraseña='$contraseña'";
$result = $conn->query($sql);
 
if ($result->num_rows > 0) {
    // Datos de usuario válidos (trabajador)
    $row = $result->fetch_assoc();
    $_SESSION['username'] = $row['usuario'];
    $_SESSION['rol'] = $row['rol'];

    if ($row['rol'] == 'Admin') {
        header("Location: /AirePolar/administrador\administrador.php");
    } elseif ($row['rol'] == 'op_inventario') {
        header("Location: /AirePolar/inventario/index.php");
    } elseif ($row['rol'] == 'op_servicios') {
        header("Location: servicios.html");
    } else {
        // Si el tipo de usuario no es reconocido
        echo "Tipo de usuario no reconocido.";
    }
} else { {
        // Datos de usuario inválidos
        echo "<!DOCTYPE html>
              <html lang='es'>
              <head>
                  <meta charset='UTF-8'>
                  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                  <title>Error de Inicio de Sesión</title>
                  <style>
                      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

                      :root {
                          --primary-color: #c7a17a;
                          --background-color: #f9f5f0;
                          --dark-color: #151515;
                      }

                      html {
                          font-size: 62.5%;
                          font-family: 'Poppins', sans-serif;
                      }

                      * {
                          margin: 0;
                          padding: 0;
                          box-sizing: border-box;
                      }

                      body {
                          display: flex;
                          justify-content: center;
                          align-items: center;
                          height: 100vh;
                          background-color: var(--background-color);
                      }

                      .error-container {
                          text-align: center;
                          background-color: rgba(255, 255, 255, 0.8);
                          padding: 2rem;
                          border-radius: 1rem;
                          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                      }

                      .error-container p {
                          font-size: 1.6rem;
                          color: var(--dark-color);
                          margin-bottom: 2rem;
                      }

                      .error-container button {
                          background-color: var(--primary-color);
                          color: #fff;
                          padding: 1rem 2rem;
                          border: none;
                          border-radius: 0.5rem;
                          font-size: 1.6rem;
                          cursor: pointer;
                      }

                      .error-container button:hover {
                          background-color: var(--dark-color);
                      }
                  </style>
              </head>
              <body>
                  <div class='error-container'>
                      <p>Usuario o contraseña incorrectos.</p>
                      <form action='index.html' method='get'>
                          <button type='submit'>Volver a intentar</button>
                      </form>
                      
                  </div>
              </body>
              </html>";
    }
}

$conn->close();
?>
