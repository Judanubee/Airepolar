<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ver Agendas</title>
    <link rel="stylesheet" href="../../css/styles.css" />
    <style>
        .agendas-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .agendas-table th,
        .agendas-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .agendas-table th {
            background-color: var(--primary-color);
            color: white;
            text-transform: uppercase;
        }

        .agendas-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .agendas-table tr:hover {
            background-color: #ddd;
        }

        .btn {
            padding: 0.5rem 1rem;
            margin: 0.2rem;
            border: none;
            border-radius: 0.3rem;
            color: white;
            cursor: pointer;
        }

        .btn-edit {
            background-color: #4CAF50; /* Verde */
        }

        .btn-delete {
            background-color: #f44336; /* Rojo */
        }
    </style>
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
                    <h1 class="logo"><a href="../../index.html">Clima Polar</a></h1>
                </div>

                <div class="container-user">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>

        <div class="container-navbar">
            <nav class="navbar container">
                <ul class="menu">
                    <li><a href="#">Servicios</a>
                        <ul class="submenu">
                            <li><a href="/AirePolar/html/agendar/agendar.html">Agendar</a></li>
                            <li><a href="/AirePolar/html/agendar/ver_agendas.html">Ver agendas</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="agendas-section">
        <div class="container">
            <h2>Agendas Registradas</h2>
            <table class="agendas-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo Electrónico</th>
                        <th>Teléfono</th>
                        <th>Fecha de la Cita</th>
                        <th>Detalles</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Datos de conexión
                    include 'db.php';
session_start();


                    // Consultar datos
                    $sql = "SELECT id, nombre, correo, telefono, fecha, detalles FROM agendas";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Mostrar datos de cada fila
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row["nombre"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["correo"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["telefono"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["fecha"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["detalles"]) . "</td>";
                            echo "<td>";
                            echo "<button class='btn btn-edit' onclick='editAgenda(" . $row["id"] . ")'>Editar</button>";
                            echo "<button class='btn btn-delete' onclick='deleteAgenda(" . $row["id"] . ")'>Eliminar</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No hay agendas registradas</td></tr>";
                    }

                    // Cerrar conexión
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <script>
        function editAgenda(id) {
            window.location.href = `editar_agenda.php?id=${id}`;
        }

        function deleteAgenda(id) {
            if (confirm('¿Está seguro de que desea eliminar esta agenda?')) {
                window.location.href = `eliminar_agenda.php?id=${id}`;
            }
        }
    </script>
</body>
</html>
