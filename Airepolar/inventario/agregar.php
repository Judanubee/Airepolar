<?php
// Configuración de la base de datos
include '../db.php';
session_start();

$message = "";

// Procesar el formulario de agregar producto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stock = $_POST['stock'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $fecha_agregado = $_POST['fecha_agregado'];

    $sql = "INSERT INTO productos (stock, nombre, descripcion, precio, fecha_agregado) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $stock, $nombre, $descripcion, $precio, $fecha_agregado);

    if ($stmt->execute()) {
        $message = "Producto agregado exitosamente";
    } else {
        $message = "Error al agregar el producto: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   
</head>
<body>
    <div class="container-hero">
        <div class="container-logo">
            <i class="fa fa-area-chart" aria-hidden="true"></i>
            <h1 class="logo"><a href="/AirePolar/index.html">Clima Polar</a></h1>
        </div>
        <!-- Botón de Cerrar Sesión -->
        <button onclick="window.location.href='/Airepolar/logout.php';" class="logout-button">Cerrar sesión</button>
    </div>

    <div class="content">
        <div class="form-container">
            <h1>Agregar Producto</h1>
            <?php if ($message): ?>
                <p class="message <?php echo strpos($message, 'exitosamente') !== false ? 'success-message' : 'error-message'; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </p>
            <?php endif; ?>
            <form method="POST" action="">
                <input type="text" name="stock" placeholder="Stock" required>
                <input type="text" name="nombre" placeholder="Nombre" required>
                <input type="text" name="descripcion" placeholder="Descripción" required>
                <input type="text" name="precio" placeholder="Precio" required>
                <input type="date" name="fecha_agregado" placeholder="Fecha Agregado" required>
                <button type="submit">Agregar</button>
                <a href="index.php" class="action-btn">Regresar</a>
            </form>
        </div>
    </div>
</body>
</html>
