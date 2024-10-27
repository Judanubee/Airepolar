<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrador</title>
    <link rel="stylesheet" href="../css/index.css" />

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
                <!-- Botón de Cerrar Sesión -->
                <button onclick="window.location.href='/Airepolar/logout.php';" class="logout-button">Cerrar sesión</button>
            </div>
        </div>
    </div>
</header>
<br> <br><br>
<div class="container">  
    <div class="form-container">
        <h2>Lista de Usuarios</h2>
        <form method="GET" action="">
            <label for="search">Buscar Usuario:</label>
            <input type="text" id="search" name="search" placeholder="Ingrese nombre, usuario o tipo">
            <button type="submit">Buscar</button>
            <button class="button-link" onclick="window.location.href='lista_usuarios.php'; return false;">limpiar busqueda</button>
        </form>
    </div>
    <div class="form-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Tipo de Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php   
               include '../db.php';
                session_start();

                // Filtrar resultados si hay una búsqueda
                $search = isset($_GET['search']) ? $_GET['search'] : '';
                $sql = "SELECT * FROM usuarios";
                if (!empty($search)) {
                    $search = $conn->real_escape_string($search);
                    $sql .= " WHERE usuario LIKE '%$search%' OR nombre LIKE '%$search%' OR usuario LIKE '%$search%' OR rol LIKE '%$search%'";
                }

                $result = $conn->query($sql);

                // Verificar si hay resultados
                if ($result->num_rows > 0) {
                    // Recorrer y mostrar los resultados
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['usuario'] . "</td>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['rol'] . "</td>";
                        echo "<td>
                                <a href='../php/usuarios/editar_usuario.php?id=" . $row['id'] . "'>Editar</a>
                                <a href='../php/usuarios/borrar_usuario.php?id=" . $row['id'] . "'>Eliminar</a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No hay usuarios</td></tr>";
                }
                $conn->close();
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>


