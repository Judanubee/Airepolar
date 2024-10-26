<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Clima Polar</title>
    <link rel="stylesheet" href="../../css/styles.css" />
    <style>
        .btn {
            background-color: var(--bluebonito); /* Usa la variable de color azul bonito */
            color: #fff; /* Texto blanco */
            padding: 1rem 2rem; /* Espaciado interno */
            text-decoration: none; /* Sin subrayado */
            border-radius: 0.5rem; /* Bordes redondeados */
            font-size: 1.6rem; /* Tamaño de fuente */
            font-weight: 500; /* Grosor de la fuente */
            display: inline-block; /* Hace que el enlace se comporte como un botón */
            text-align: center; /* Centra el texto */
            transition: background-color 0.3s ease; /* Transición suave para el cambio de color */
            margin-top: 1rem; /* Espaciado superior */
        }

        .btn:hover {
            background-color: var(--dark-color); /* Cambia a color oscuro al pasar el ratón */
        }
    </style>
</head>
<body>
    <header>
        <div class="container-hero">
            <div class="container hero">
                <div class="customer-support">
                    <i class="fa-solid fa-headset"></i>
                    <div class="content-customer-support">
                        <span class="text">Soporte al cliente</span>
                        <span class="number">123-456-7890</span>
                    </div>
                </div>

                <div class="container-logo">
                    <i class="fa fa-area-chart" aria-hidden="true"></i>
                    <h1 class="logo"><a href="../../index.html">Clima Polar</a></h1>
                </div>

                <div class="container-user">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>
    </header>
</body>
</html>


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
    echo "Los datos se han insertado correctamente.";
    echo '<br><a href="/AirePolar/html/agendar/agendar.html" class="btn">Agregar otra agenda</a>';
} else {
    echo "Error al insertar los datos: " . $stmt->error;
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
