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
    <div class="container-navbar">
        <nav class="navbar">
            <div class="container-logo">
                <i class="logo-icon">️</i>
                <h1 class="logo"><a href="/AirePolar/index.html">Clima Polar</a></h1>
            </div>
            <div class="menu">
                <a href="index.php">Home</a>
                <a href="agregar.php">Agregar</a>
                <button onclick="window.location.href='/Airepolar/logout.php';" class="logout-button">Cerrar sesión</button> <!-- Botón de cerrar sesión -->
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
