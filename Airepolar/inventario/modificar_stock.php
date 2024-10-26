<?php
// Configuración de la base de datos
include 'db.php';
session_start();

// Procesar el formulario de modificación de stock
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $stock = $_POST['stock'];

    $sql = "UPDATE productos SET stock=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $stock, $id);

    if ($stmt->execute()) {
        $message = "Stock modificado exitosamente";
    } else {
        $message = "Error al modificar el stock";
    }

    $stmt->close();
}

// Obtener los datos del producto
$id = $_GET['id'];
$sql = "SELECT * FROM productos WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    die("Producto no encontrado");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Stock</title>
    <link rel="stylesheet" href="styles.css">
    <style>
       :root {
    --primary-color: #5783bc;
    --background-color: #cadffb;
    --dark-color: #2d2c55;
    --bluebonito: #5f95e7; /* Color azul bonito */
        }
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container-navbar {
            background-color: var(--primary-color);
            padding: 1rem;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .container-logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .container-logo i {
            font-size: 3rem;
            color: #fff;
        }
        .container-logo h1 a {
            text-decoration: none;
            color: #fff;
            font-size: 2.5rem;
            text-transform: uppercase;
            letter-spacing: -1px;
        }
        .menu a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            padding: 0.5rem 1rem;
        }
        .menu a:hover {
            background-color: var(--dark-color);
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
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }
        .form-container h1 {
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            color: #333;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
        }
        .form-container form div {
            margin-bottom: 1rem;
        }
        .form-container form label {
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #555;
        }
        .form-container form input {
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            font-size: 1rem;
            width: 100%;
        }
        .form-container form button {
            padding: 0.75rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 1rem;
            background-color: var(--primary-color);
            color: #fff;
        }
        .form-container form button:hover {
            background-color: var(--dark-color);
        }
        .form-container .btn-back {
            background-color: #888;
            color: #fff;
            text-align: center;
            text-decoration: none;
            padding: 0.75rem;
            border-radius: 0.5rem;
            font-size: 1rem;
            display: inline-block;
            margin-top: 1rem;
        }
        .form-container .btn-back:hover {
            background-color: #666;
        }
        .success-message {
            color: green;
            font-weight: bold;
        }
        .error-message {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container-navbar">
        <nav class="navbar">
            <div class="container-logo">
                <i class="logo-icon">️</i> <!-- Reemplaza con el logo adecuado -->
            <h1 class="logo"><a href="/AirePolar/index.html">Clima Polar</a></h1>
            </div>
            <div class="menu">
                <a href="index.php">Home</a>
                <a href="agregar.php">Agregar</a>
            </div>
        </nav>
    </div>

    <div class="content">
        <div class="form-container">
            <h1>Modificar Stock</h1>
            <?php if ($message): ?>
                <p class="<?php echo strpos($message, 'exitosamente') !== false ? 'success-message' : 'error-message'; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </p>
            <?php endif; ?>
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">
                <div>
                    <label for="stock">Stock:</label>
                    <input type="number" id="stock" name="stock" value="<?php echo htmlspecialchars($product['stock']); ?>" required>
                </div>
                <button type="submit">Modificar Stock</button>
            </form>
            <a href="index.php" class="btn-back">Regresar</a>
        </div>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
