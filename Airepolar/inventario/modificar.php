<?php
include '../db.php';
session_start();

// Inicializar variables para el mensaje y producto
$message = "";
$product = [];

// Comprobar si se envió el formulario de modificación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    // Preparar la consulta SQL para actualizar el producto
    $sql = "UPDATE productos SET nombre=?, descripcion=?, precio=? WHERE id=?";
    $stmt = $conn->prepare($sql);

    // Verificar si la consulta se preparó correctamente
    if ($stmt === false) {
        $message = "Error al preparar la consulta: " . $conn->error;
    } else {
        $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $id);

        // Ejecutar la consulta y establecer el mensaje según el resultado
        if ($stmt->execute()) {
            $message = "Producto modificado exitosamente.";
        } else {
            $message = "Error al modificar el producto: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Cargar los datos actuales del producto si se pasó un ID por GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM productos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Si se encuentra el producto, asignar los valores a $product
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        $message = "Producto no encontrado.";
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
    <title>Modificar Producto</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Encabezado con logo y botón de cerrar sesión -->
    <div class="container-hero">
        <div class="container-logo">
            <i class="fa fa-area-chart" aria-hidden="true"></i>
            <h1 class="logo"><a href="/AirePolar/index.html">Clima Polar</a></h1>
        </div>
        <button onclick="window.location.href='/Airepolar/logout.php';" class="logout-button">Cerrar sesión</button>
    </div>

    <!-- Contenedor principal del contenido -->
    <div class="content">
        <div class="form-container">
            <h1>Modificar Producto</h1>
            
            <!-- Mensaje de éxito o error -->
            <?php if ($message): ?>
                <p class="<?php echo strpos($message, 'exitosamente') !== false ? 'success-message' : 'error-message'; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </p>
            <?php endif; ?>

            <!-- Formulario para modificar producto -->
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
                <div>
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($product['nombre']); ?>" required>
                </div>
                <div>
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($product['descripcion']); ?></textarea>
                </div>
                <div>
                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio" step="0.01" value="<?php echo htmlspecialchars($product['precio']); ?>" required>
                </div>
                <button type="submit">Modificar Producto</button>
            </form>
            
            <!-- Botón para regresar a la lista de productos -->
            <a href="index.php" class="btn-back">Regresar</a>
        </div>
    </div>
</body>
</html>
