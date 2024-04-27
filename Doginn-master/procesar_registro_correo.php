<?php
// Declaramos las variables con los datos de conexión
$servername = "localhost"; // Nombre del servidor de la base de datos
$usuario = "root"; // Nombre de usuario de la base de datos
$password = ""; // Contraseña del usuario de la base de datos (sin password)
$database = "doginn"; // Nombre de la base de datos a la que nos conectaremos

// Creamos una instancia de la clase mysqli para establecer la conexión
$conexion = new mysqli($servername, $usuario, $password, $database);

// Verificamos si la conexión fue exitosa
if ($conexion->connect_error) {
    // Si hay un error en la conexión, mostramos un mensaje y terminamos la ejecución del script
    die("Error al conectar la base de datos de la página: " . $conexion->connect_error);
}

// Verificamos si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibimos los datos del formulario
    $nombre_guarderia = $_POST["nombre_guarderia"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];

    // Ruta de almacenamiento de las imágenes
    $ruta_imagenes = "img/";

    // Procesamos y movemos las imágenes
    $imagen1 = $_FILES["imagen1"]["name"];
    $imagen2 = $_FILES["imagen2"]["name"];
    $imagen3 = $_FILES["imagen3"]["name"];
    $imagen4 = $_FILES["imagen4"]["name"];
    $imagen5 = $_FILES["imagen5"]["name"];

    move_uploaded_file($_FILES["imagen1"]["tmp_name"], $ruta_imagenes . $imagen1);
    move_uploaded_file($_FILES["imagen2"]["tmp_name"], $ruta_imagenes . $imagen2);
    move_uploaded_file($_FILES["imagen3"]["tmp_name"], $ruta_imagenes . $imagen3);
    move_uploaded_file($_FILES["imagen4"]["tmp_name"], $ruta_imagenes . $imagen4);
    move_uploaded_file($_FILES["imagen5"]["tmp_name"], $ruta_imagenes . $imagen5);

    // Definimos la URL de la imagen
    $imagen_url = $ruta_imagenes . $imagen1;

    // Preparamos la consulta SQL para insertar los datos del usuario en la base de datos
    $sql = "INSERT INTO guarderias (nombre_guarderia, direccion, telefono, imagen_url) VALUES (?, ?, ?, ?)";

    // Preparamos la consulta
    $stmt = $conexion->prepare($sql);

    // Vinculamos los parámetros
    $stmt->bind_param("ssss", $nombre_guarderia, $direccion, $telefono, $imagen_url);

    // Ejecutamos la consulta
    if ($stmt->execute()) {
        // Si la consulta se ejecuta con éxito, redirigimos al usuario a una página de éxito
        header("Location: registro_exitoso.html");
        exit;
    } else {
        // Si hay un error al ejecutar la consulta, mostramos un mensaje de error
        echo "Error al intentar registrar la guardería: " . $conexion->error;
    }

    // Cerramos la conexión con la base de datos
    $conexion->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestro compromiso</title>
    <link rel="stylesheet" href="css/registro_exitoso.css">
</head>
<body>
    <div class="container">
        <h2>Nuestro compromiso de la comunidad</h2>
        <p>Airbnb es una comunidad donde cualquier persona puede sentirse como en casa donde vaya. Para asegurarnos de que es así, te pedimos que te comprometas a lo siguiente:</p>
        <ul>
            <li>Me comprometo a respetar y tratar sin prejuicios a todos los miembros de la comunidad de Airbnb, independientemente de su origen, religión, nacionalidad, etnia, color de piel, sexo, identidad de género, orientación sexual o edad, o de si tienen una discapacidad.</li>
        </ul>
        <form action="procesar_compromiso.php" method="post">
            <button type="submit" name="aceptar" class="btn-continuar">Aceptar y Continuar</button>
            <button type="submit" name="rechazar" class="btn-rechazar">Rechazar</button>
        </form>
    </div>
</body>
</html>
