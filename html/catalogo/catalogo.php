<?php
include 'db.php';
session_start();


// Consultar productos
$sql = "SELECT id, nombre, precio, stock FROM productos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
     <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Catálogo de Productos</title>
    <link rel="stylesheet" href="../css/catalogo_cliente.css"> <!-- Asegúrate de enlazar correctamente tu archivo CSS -->
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/index-style.css" />
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
                    <h1 class="logo"><a href="../index.html">Clima Polar</a></h1>
                </div>

                <div class="container-user">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <h1>Catálogo de Productos</h1>
        <div class="productos">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='producto'>";
                    echo "<h2>" . $row["nombre"] . "</h2>";
                    echo "<p>Precio: $" . $row["precio"] . "</p>";
                    echo "<p>Stock: " . $row["stock"] . "</p>";
                    echo "<button class='btn apartar-btn'>Apartarlo</button>";
                    echo "</div>";
                }
            } else {
                echo "<p>No hay productos disponibles.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>


