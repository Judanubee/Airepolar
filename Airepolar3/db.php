<?php
//configuracion de variables
$servername = 'mysql-juliodanielbernal.alwaysdata.net';
$dbname = 'juliodanielbernal_db2';
$username= '377233';
$password = '#RojosVerdes';
//crear conexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}