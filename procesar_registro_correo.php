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
    $correo_electronico = $_POST['correo'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hasheamos la contraseña
    
    // Ruta de almacenamiento de las imágenes
    $ruta_imagenes = "img/";

    // Procesamos y movemos las imágenes
    $imagen1 = $_FILES["imagen1"]["name"];
    $imagen2 = $_FILES["imagen2"]["name"];

    move_uploaded_file($_FILES["imagen1"]["tmp_name"], $ruta_imagenes . $imagen1);
    move_uploaded_file($_FILES["imagen2"]["tmp_name"], $ruta_imagenes . $imagen2);

    // Definimos la URL de las imágenes
    $imagen_url1 = $ruta_imagenes . $imagen1;
    $imagen_url2 = $ruta_imagenes . $imagen2;

    // Preparamos la consulta SQL para insertar los datos del usuario en la base de datos
    $sql = "INSERT INTO guarderias (nombre_guarderia, direccion, telefono, imagen_url, correo_electronico, password) VALUES (?, ?, ?, ?, ?, ?)";

    // Preparamos la consulta
    $stmt = $conexion->prepare($sql);

    // Vinculamos los parámetros
    $stmt->bind_param("ssssss", $nombre_guarderia, $direccion, $telefono, $imagen_url1, $correo_electronico, $password);

    // Ejecutamos la consulta
    if ($stmt->execute()) {
        // Si la consulta se ejecuta con éxito, redirigimos al usuario a una página de éxito
        header("Location: registrook.html");
        exit;
    } else {
        // Si hay un error al ejecutar la consulta, mostramos un mensaje de error
        echo "Error al intentar registrar la guardería: " . $stmt->error;
    }

    // Cerramos la conexión con la base de datos
    $conexion->close();
}
?>
