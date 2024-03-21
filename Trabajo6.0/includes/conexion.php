<?php
// Declaramos las variables con los datos de conexión
$servername = "localhost"; // Nombre del servidor de la base de datos
$usuario = "root"; // Nombre de usuario de la base de datos
$password = "root"; // Contraseña del usuario de la base de datos (sin password)
$database = "doginn"; // Nombre de la base de datos a la que nos conectaremos

// Creamos una instancia de la clase mysqli para establecer la conexión
$conexion = new mysqli($servername, $usuario, $password, $database);

// Verificamos si la conexión fue exitosa
if ($conexion->connect_error) {
    // Si hay un error en la conexión, mostramos un mensaje y terminamos la ejecución del script
    die("Error al conectar la base de datos de la página: " . $conexion->connect_error);
}
?>
