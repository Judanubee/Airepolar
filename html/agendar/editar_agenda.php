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

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $fecha = $_POST["fecha"];
    $detalles = $_POST["detalles"];

    // Actualizar registro
    $sql = "UPDATE agendas SET nombre='$nombre', correo='$correo', telefono='$telefono', fecha='$fecha', detalles='$detalles' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro actualizado exitosamente";
    } else {
        echo "Error actualizando el registro: " . $conn->error;
    }

    $conn->close();
    header("Location: ver_agendas.php");
    exit();
} else {
    // Obtener el ID de la URL
    $id = $_GET["id"];

    // Obtener los datos actuales de la agenda
    $sql = "SELECT * FROM agendas WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No se encontró la agenda";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Agenda</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <style>
        .container-center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container container-center">
        <div>
            <h2 class="title">Editar Agenda</h2>
            <div class="appointment-form">
                <form method="POST" action="editar_agenda.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <div>
                        <label>Nombre:</label>
                        <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>">
                    </div>
                    <div>
                        <label>Correo Electrónico:</label>
                        <input type="email" name="correo" value="<?php echo $row['correo']; ?>">
                    </div>
                    <div>
                        <label>Teléfono:</label>
                        <input type="text" name="telefono" value="<?php echo $row['telefono']; ?>">
                    </div>
                    <div>
                        <label>Fecha de la Cita:</label>
                        <input type="date" name="fecha" value="<?php echo $row['fecha']; ?>">
                    </div>
                    <div>
                        <label>Detalles:</label>
                        <textarea name="detalles"><?php echo $row['detalles']; ?></textarea>
                    </div>
                    <div>
                        <input type="submit" value="Actualizar" class="submit-btn">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
