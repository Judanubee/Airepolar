<?php
include 'db.php';
session_start();


// Obtener productos
$sql = "SELECT nombre, precio, stock FROM productos";
$result = $conn->query($sql);
?>
