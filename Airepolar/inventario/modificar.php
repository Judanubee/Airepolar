<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #5783bc;
            --background-color: #cadffb;
            --dark-color: #2d2c55;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container-hero {
            display: flex;
            justify-content: space-between;
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
        .form-container form input,
        .form-container form textarea {
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 0.5rem;
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
            background-color: #8b6d49;
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
    <div class="container-hero">
        <div class="container-logo">
            <i class="fa fa-area-chart" aria-hidden="true"></i>
            <h1 class="logo"><a href="/AirePolar/index.html">Clima Polar</a></h1>
        </div>
        <button onclick="window.location.href='/Airepolar/logout.php';" class="logout-button">Cerrar sesión</button> <!-- Botón de cerrar sesión -->
    </div>

    <div class="content">
        <div class="form-container">
            <h1>Modificar Producto</h1>
            <?php if ($message): ?>
                <p class="<?php echo strpos($message, 'exitosamente') !== false ? 'success-message' : 'error-message'; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </p>
            <?php endif; ?>
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
            <a href="index.php" class="btn-back">Regresar</a>
        </div>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
