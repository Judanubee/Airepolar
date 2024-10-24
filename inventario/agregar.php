<?php
// Configuración de la base de datos
include 'db.php';
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
    <style>
        :root {
           --primary-color: #5783bc;
    --background-color: #cadffb;
    --dark-color: #2d2c55;
    --bluebonito: #5f95e7; /* Color azul bonito */
        }
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--background-color);
        }
        .container-hero {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: var(--primary-color);
            padding: 1rem;
        }
        .container-logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .container-logo i {
            font-size: 2rem;
            color: #fff;
        }
        .container-logo h1 a {
            text-decoration: none;
            color: #fff;
            font-size: 2rem;
            text-transform: uppercase;
            letter-spacing: -1px;
        }
        .content {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 80vh;
            padding: 1rem;
        }
        .form-container {
            background-color: #fff;
            padding: 3rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }
        .form-container h1 {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 0.5rem;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        form input {
            margin-bottom: 1rem;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 0.5rem;
            font-size: 1rem;
        }
        form button {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            background-color: var(--primary-color);
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 1rem;
        }
        form button:hover {
            background-color: var(--dark-color);
        }
        .message {
            margin-top: 1rem;
            font-weight: bold;
        }
        .success-message {
            color: green;
        }
        .error-message {
            color: red;
        }
        .action-btn {
            text-decoration: none;
            background-color: var(--primary-color);
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            display: inline-block;
            margin-top: 1rem;
            text-align: center;
        }
        .action-btn:hover {
            background-color: var(--dark-color);
        }
    </style>
</head>
<body>
    <div class="container-hero">
        <div class="container-logo">
            <i class="fa fa-area-chart" aria-hidden="true"></i>
            <h1 class="logo"><a href="/AirePolar/index.html">Clima Polar</a></h1>
        </div>
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
