<?php
mysqli_report(MYSQLI_REPORT_OFF);

$servername = "localhost";
$usuario = "usuario_bd";
$password = "password_bd";
$database = "doginn";

$port = 3306;

$conexion = new mysqli($servername, $usuario, $password, $database, $port);

if ($conexion->connect_error) {
    die("ERROR MYSQL: " . $conexion->connect_error);
}

$conexion->set_charset("utf8mb4");
