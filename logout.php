<?php
session_start(); // Inicia la sesión
session_unset(); // Elimina todas las variables de sesión
session_destroy(); // Destruye la sesión

// Redirige al usuario a la página de inicio o de login
header("Location: /Airepolar/index.html");
exit();
?>
