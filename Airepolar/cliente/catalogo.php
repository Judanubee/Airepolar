<?php
include '../db.php';
session_start();

// Consultar productos para mostrarlos en el catálogo
$sql = "SELECT id, nombre, precio, stock FROM productos";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
    <link rel="stylesheet" href="../css/catalogo_cliente.css"> <!-- Asegúrate de enlazar correctamente tu archivo CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/index-style.css">

</head>
<body>
          <!-- Botón de cerrar sesión -->
          <button onclick="window.location.href='/Airepolar/logout.php';" class="logout-button">Cerrar sesión</button>
    <!-- Encabezado con soporte al cliente, logo y usuario -->
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
                    <h1 class="logo"><a href="../index.html">Clima Polar</a></h1>
                </div>
                <div class="container-user">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenedor principal para mostrar los productos -->
    <div class="container">
        <h1>Catálogo de Productos</h1>
        <div class="productos">
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="producto">
                        <h2><?php echo htmlspecialchars($row["nombre"]); ?></h2>
                        <p>Precio: $<?php echo htmlspecialchars($row["precio"]); ?></p>
                        <p>Stock: <?php echo htmlspecialchars($row["stock"]); ?></p>
                        <button class="btn apartar-btn">Apartarlo</button>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No hay productos disponibles.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
