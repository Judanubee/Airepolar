<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Clima Polar</title>
    <link rel="stylesheet" href="../../css/styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="agenda-container-hero">
            <div class="agenda-container-hero-content">
                <div class="agenda-customer-support">
                    <i class="fa-solid fa-headset"></i>
                    <div class="agenda-customer-support-content">
                        <span class="agenda-text">Soporte al cliente</span>
                        <span class="agenda-number">123-456-7890</span>
                    </div>
                </div>

                <div class="agenda-logo-container">
                    <i class="fa fa-area-chart" aria-hidden="true"></i>
                    <h1 class="agenda-logo"><a href="../../index.html">Clima Polar</a></h1>
                </div>

                <div class="agenda-user-container">
                    <i class="fa-solid fa-user"></i>
                    <!-- Botón de Cerrar sesión -->
                    <button onclick="window.location.href='/Airepolar/logout.php';" class="agenda-logout-button">Cerrar sesión</button>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="agenda-message-container">
            <?php
            // Datos de conexión
            $servername = "127.0.0.1";
            $username = "u509327142_Judag31";
            $password = "RojoVerde27";
            $dbname = "u509327142_climapolardame";

            // Crear conexión
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verificar conexión
            if ($conn->connect_error) {
                die("La conexión ha fallado: " . $conn->connect_error);
            }

            // Obtener datos del formulario
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $fecha = $_POST['fecha'];
            $detalles = $_POST['detalles'];

            // Preparar y vincular
            $stmt = $conn->prepare("INSERT INTO agendas (nombre, correo, telefono, fecha, detalles) VALUES (?, ?, ?, ?, ?)");

            if ($stmt === false) {
                die("Error en la preparación: " . $conn->error);
            }

            $stmt->bind_param("sssss", $nombre, $correo, $telefono, $fecha, $detalles);

            // Ejecutar la declaración
            if ($stmt->execute()) {
                echo "<p class='agenda-success-message'>Los datos se han insertado correctamente.</p>";
                echo '<a href="/AirePolar/html/agendar/agendar.html" class="agenda-btn">Agregar otra agenda</a>';
            } else {
                echo "<p class='agenda-error-message'>Error al insertar los datos: " . $stmt->error . "</p>";
            }

            // Cerrar conexión
            $stmt->close();
            $conn->close();
            ?>
        </div>
    </main>
</body>
</html>
