<?php
// Configuración de la base de datos
include '../db.php';
session_start();

$message = "";

// Procesar la eliminación del producto
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $sql = "DELETE FROM productos WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $id);

    if ($stmt->execute()) {
        $message = "Producto eliminado exitosamente";
    } else {
        $message = "Error al eliminar el producto: " . $conn->error;
    }

    $stmt->close();
}

// Obtener los productos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container-hero">
        <div class="container-logo">
            <i class="fa fa-area-chart" aria-hidden="true"></i>
            <h1 class="logo"><a href="/Airepolar/index.html">Clima Polar</a></h1>
        </div>
        <!-- Botón de Cerrar Sesión -->
        <button onclick="window.location.href='/Airepolar/logout.php';" class="logout-button">Cerrar sesión</button>
    </div>

    <div class="content">
        <div class="table-container">
            <div class="table-title">Inventario</div>
            <div class="search-container">
                <form action="index.php" method="GET">
                    <input type="text" name="search" placeholder="Buscar por nombre o ID">
                    <button type="submit">Buscar</button>
                </form>
                <a href="agregar.php" class="btn">Agregar</a>
            </div>
            <?php if ($message): ?>
                <p class="message <?php echo strpos($message, 'exitosamente') !== false ? 'success-message' : 'error-message'; ?>">
                    <?php echo htmlspecialchars($message); ?>
                </p>
            <?php endif; ?>
            <?php if ($result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Stock</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Fecha Agregado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['stock']); ?></td>
                                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                                <td><?php echo htmlspecialchars($row['precio']); ?></td>
                                <td><?php echo htmlspecialchars($row['fecha_agregado']); ?></td>
                                <td>
                                    <a href="modificar.php?id=<?php echo $row['id']; ?>" class="btn">Modificar</a>
                                    <a href="?delete_id=<?php echo $row['id']; ?>" class="btn" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
                                    <a href="modificar_stock.php?id=<?php echo $row['id']; ?>" class="btn">Modificar Stock</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
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
