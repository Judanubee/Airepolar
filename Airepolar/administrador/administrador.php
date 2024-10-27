<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrador</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/index-style.css">
    <link rel="stylesheet" href="../css/administrador-style.css">
</head>
<body>
<header>
    <div class="admin-container-hero">
        <div class="admin-container-hero-content">
            <div class="admin-customer-support">
                <i class="fa-solid fa-headset"></i>
                <div class="admin-customer-support-info">
                    <span class="admin-support-text">Soporte al cliente</span>
                    <span class="admin-support-number">123-456-7890</span>
                </div>
            </div>

            <div class="admin-container-logo">
                <i class="fa fa-area-chart" aria-hidden="true"></i>
                <h1 class="admin-logo"><a href="../index.html">Clima Polar</a></h1>
            </div>

            <div class="admin-container-user">
                <i class="fa-solid fa-user"></i>
                <!-- Botón de Cerrar Sesión -->
                <button onclick="window.location.href='/Airepolar/logout.php';" class="admin-logout-button">Cerrar sesión</button>
            </div>
        </div>
    </div>
</header>

<br><br><br>
<center><h1>Bienvenido Administrador</h1></center><br><br><br>

<div class="admin-main-container">
    <!-- Mostrar mensajes de éxito o error -->
    <?php if (isset($_GET['action'])): ?>
        <?php if ($_GET['action'] == 'add'): ?>
            <?php if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
                <div class="admin-message admin-success-message">Usuario agregado exitosamente.</div>
            <?php elseif (isset($_GET['error'])): ?>
                <div class="admin-message admin-error-message">Error al agregar el usuario: <?php echo htmlspecialchars($_GET['error']); ?></div>
            <?php endif; ?>
        <?php elseif ($_GET['action'] == 'update'): ?>
            <?php if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
                <div class="admin-message admin-success-message">Usuario actualizado con éxito.</div>
            <?php elseif (isset($_GET['error'])): ?>
                <div class="admin-message admin-error-message">Error al actualizar el usuario: <?php echo htmlspecialchars($_GET['error']); ?></div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>

    <div class="admin-form-container">
        <h2>Agregar Usuario</h2>
        <form action="../php/usuarios/agregar_usuario.php" method="POST">
            <label for="usuario" class="admin-label">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required class="admin-input">
        
            <label for="contraseña" class="admin-label">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" required class="admin-input">
        
            <label for="nombre" class="admin-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required class="admin-input">
            
            <label for="apellido" class="admin-label">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required class="admin-input">
            
            <label for="tipo_usuario" class="admin-label">Tipo de Usuario:</label>
            <select id="tipo_usuario" name="tipo_usuario" required class="admin-select">
                <option value="administrador">Administrador</option>
                <option value="op_inventario">Operador Inventario</option>
                <option value="op_servicios">Operador Servicios</option>
                <option value="admin_catalogo">Administrador Catálogo</option>
            </select>
            
            <button type="submit" class="admin-submit-button">Agregar Usuario</button>
            <button class="admin-button-link" onclick="window.location.href='lista_usuarios.php'; return false;">Ver usuarios</button>
        </form>
    </div>
</div>
</body>
</html>
