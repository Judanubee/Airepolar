<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=
    <title>Administrador</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/index-style.css">
    <link rel="stylesheet" href="../css/administrador-style.css"> <!-- Asegúrate de que la ruta sea correcta -->
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
    <br><br><br>
    <center><h1>Bienvenido Administrador</h1></center><br><br><br>
    <div class="container">
           <!-- Mostrar mensajes de éxito o error -->
    <?php if (isset($_GET['action'])): ?>
        <?php if ($_GET['action'] == 'add'): ?>
            <?php if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
                <div class="message success">Usuario agregado exitosamente.</div>
            <?php elseif (isset($_GET['error'])): ?>
                <div class="message error">Error al agregar el usuario: <?php echo htmlspecialchars($_GET['error']); ?></div>
            <?php endif; ?>
        <?php elseif ($_GET['action'] == 'update'): ?>
            <?php if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
                <div class="message success">Usuario actualizado con éxito.</div>
            <?php elseif (isset($_GET['error'])): ?>
                <div class="message error">Error al actualizar el usuario: <?php echo htmlspecialchars($_GET['error']); ?></div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>

        
        <div class="form-container">
            <h2>Agregar Usuario</h2>
            <form action="../php/usuarios/agregar_usuario.php" method="POST">
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required>
            
                <label for="contraseña">Contraseña:</label>
                <input type="password" id="contraseña" name="contraseña" required>
            
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
                
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" required>
                
                <label for="tipo_usuario">Tipo de Usuario:</label>
                <select id="tipo_usuario" name="tipo_usuario" required>
                    <option value="administrador">Administrador</option>
                    <option value="op_inventario">Operador Inventario</option>
                    <option value="op_servicios">Operador Servicios</option>
                    <option value="admin_catalogo">Administrador Catálogo</option>
                </select>
                
                <button type="submit">Agregar Usuario</button>
                <button class="button-link" onclick="window.location.href='lista_usuarios.php'; return false;">Ver usuarios</button>

            </form>
        </div>
        
    </div>
</body>
</html>