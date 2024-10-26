<?php
// Configuración de la base de datos
include 'db.php';
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
    <style>
        :root {
            --primary-color: #007bff; /* Azul primario */
            --background-color: #f8f9fa; /* Color de fondo claro */
            --dark-color: #343a40; /* Color oscuro */
            --highlight-color: #0056b3; /* Azul más oscuro para botones */
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
            flex-direction: column;
            align-items: center;
            padding: 1rem;
        }
        .table-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1200px;
        }
        .table-title {
            font-size: 2.5rem;
            color: var(--primary-color); /* Color del título */
            margin-bottom: 1rem;
            border-bottom: 2px solid var(--primary-color); /* Línea debajo del título */
            padding-bottom: 0.5rem;
            text-align: center;
        }
        .search-container {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        .search-container input[type="text"] {
            padding: 0.5rem;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 0.5rem;
        }
        .search-container button {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.5rem;
            background-color: var(--primary-color);
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }
        .search-container button:hover {
            background-color: var(--highlight-color);
        }
        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }
        .table-container th, .table-container td {
            padding: 0.75rem;
            border: 1px solid #ccc;
            text-align: left;
        }
        .table-container th {
            background-color: #f8f8f8;
        }
        .table-container .btn {
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            background-color: var(--primary-color);
            color: #fff;
            font-weight: bold;
        }
        .table-container .btn:hover {
            background-color: var(--highlight-color);
        }
        .message {
            margin-bottom: 1rem;
            font-weight: bold;
        }
        .success-message {
            color: green;
        }
        .error-message {
            color: red;
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
