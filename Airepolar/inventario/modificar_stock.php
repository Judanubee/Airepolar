<?php
include '../db.php';
session_start();

// Inicializar variables para el mensaje y producto
$message = "";
$product = [];

// Verificar si el formulario de modificación de stock ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $stock = $_POST['stock'];

    // Preparar la consulta SQL para actualizar el stock del producto
    $sql = "UPDATE productos SET stock=? WHERE id=?";
    $stmt = $conn->prepare($sql);

    // Verificar si la consulta se preparó correctamente
    if ($stmt === false) {
        $message = "Error al preparar la consulta: " . $conn->error;
    } else {
        $stmt->bind_param("ii", $stock, $id);

        // Ejecutar la consulta y establecer el mensaje según el resultado
        if ($stmt->execute()) {
            $message = "Stock modificado exitosamente.";
        } else {
            $message = "Error al modificar el stock: " . $stmt->error;
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
    <title>Modificar Stock</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Aquí va tu CSS personalizado */
        .logout-button {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.5rem;
            background-color: var(--primary-color);
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }
        .logout-button:hover {
            background-color: var(--dark-color);
        }
    </style>
</head>
<body>
    <!-- Barra de navegación con logo y opciones de menú -->
    <div class="container-navbar">
        <nav class="navbar">
            <div class="container-logo">
                <i class="logo-icon">️</i>
                <h1 class="logo"><a href="/AirePolar/index.html">Clima Polar</a></h1>
            </div>
            <div class="menu">
                <a href="index.php">Home</a>
                <a href="agregar.php">Agregar</a>
                <button onclick="window.location.href='/Airepolar/logout.php';" class="logout-button">Cerrar sesión</button>
            </div>
        </nav>
    </div>

    <!-- Contenedor principal para el formulario de modificación de stock -->
    <div class="content">
        <div class="form-container">
            <h1>Modificar Stock</h1>
            
            <!-- Mensaje de éxito o error -->
            <?php if ($message): ?>
                <p class="<?php echo strpos($message, 'exitosamente') !== false ? 'success-message' : 'error-message'; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </p>
            <?php endif; ?>

            <!-- Formulario para modificar el stock del producto -->
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
                <div>
                    <label for="stock">Stock:</label>
                    <input type="number" id="stock" name="stock" value="<?php echo htmlspecialchars($product['stock']); ?>" required>
                </div>
                <button type="submit">Modificar Stock</button>
            </form>
            
            <!-- Botón para regresar a la lista de productos -->
            <a href="index.php" class="btn-back">Regresar</a>
        </div>
    </div>
</body>
</html>
