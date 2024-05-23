<?php
session_start();
// Si se presiona el botón de atras
if (isset($_POST['atras'])) {
    // Redirigir a la página de index_main.php
    header("Location: index_main.php");
    exit;
}

// Si se presiona el botón de cancelar
if (isset($_POST['cancelar'])) {
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

    // Eliminamos el registro de la base de datos
    $sql = "DELETE FROM guarderias WHERE id = ?";

    if ($stmt = $conexion->prepare($sql)) {
        // Vinculamos variables a la declaración preparada como parámetros
        $stmt->bind_param("i", $param_id);

        // Establecemos los parámetros
        $param_id = $_SESSION['user_id'];

        // Intentamos ejecutar la declaración preparada
        if ($stmt->execute()) {
            // Redirigir a la página de registro_cancelado.html
            header("Location: registro_cancelado.html");
            exit;
        } else {
            echo "Oops! Algo salió mal. Por favor, inténtalo de nuevo más tarde.";
        }
    }

    // Cerramos la declaración preparada
    $stmt->close();

    // Cerramos la conexión
    $conexion->close();
}

// Si se presiona el botón de aceptar
if (isset($_POST['aceptar'])) {
    // Redirigir a la página principal
    header("Location: index_main.php");
    exit;
}

// Si se presiona el botón de rechazar
if (isset($_POST['rechazar'])) {
    // Redirigir a la página de rechazo_compromiso.php
    header("Location: rechazo_compromiso.html");
    exit;
}
?>
