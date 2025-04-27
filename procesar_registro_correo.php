<?php
// Declaramos las variables con los datos de conexión
$servername = "localhost"; // Nombre del servidor de la base de datos
$usuario = "root"; // Nombre de usuario de la base de datos
$password = ""; // Contraseña del usuario de la base de datos (sin password)
$database = "doginn"; // Nombre de la base de datos a la que nos conectaremos

// Creamos una instancia de la clase mysqli para establecer la conexión
$conn = new mysqli($servername, $usuario, $password, $database);

// Verificamos si la conexión fue exitosa
if ($conn->connect_error) {
    // Si hay un error en la conexión, mostramos un mensaje y terminamos la ejecución del script
    die("Error al conectar la base de datos de la página: " . $conn->connect_error);
}

// Verificamos si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibimos los datos del formulario
    $nombre_guarderia = $_POST["nombre_guarderia"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];
    $correo_electronico = $_POST['correo'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hasheamos la contraseña

    // Preparamos la consulta SQL para insertar los datos del usuario en la base de datos
    $sql = "INSERT INTO guarderias (nombre_guarderia, direccion, telefono, correo_electronico, password) VALUES (?, ?, ?, ?, ?)";

    // Preparamos la consulta
    $stmt = $conn->prepare($sql);

    // Vinculamos los parámetros
    $stmt->bind_param("sssss", $nombre_guarderia, $direccion, $telefono, $correo_electronico, $password);

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
    $conn->close();
}
?>
