<?php
// Incluir el archivo de conexión a la base de datos
include('includes/conexion.php');

// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_guarderia'])) {
    header("Location: login_guarderia.php");
    exit();
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre_guarderia = $_POST['nombre_guarderia'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo_electronico = $_POST['correo_electronico'];
    $id_guarderia = $_SESSION['id_guarderia'];

    // Actualizar datos en la base de datos
    $sql = "UPDATE guarderias SET nombre_guarderia = '$nombre_guarderia', direccion = '$direccion', telefono = '$telefono', correo_electronico = '$correo_electronico' WHERE id_guarderia = $id_guarderia";

    if ($conexion->query($sql) === TRUE) {
        echo "Los datos se han actualizado correctamente.";
    } else {
        echo "Error al actualizar los datos: " . $conexion->error;
    }
}

// Obtener los datos de la guardería actual
$id_guarderia = $_SESSION['id_guarderia'];
$sql = "SELECT * FROM guarderias WHERE id_guarderia = $id_guarderia";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $nombre_guarderia_actual = $fila['nombre_guarderia'];
    $direccion_actual = $fila['direccion'];
    $telefono_actual = $fila['telefono'];
    $correo_electronico_actual = $fila['correo_electronico'];
} else {
    die("No se encontró información de la guardería.");
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Datos de la Guardería</title>
    <link rel="stylesheet" type="text/css" href="css/cambiar_datos.css">
</head>
<body>
<div class="container">
    <h2>Cambiar Datos de la Guardería</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="nombre_guarderia">Nombre de la Guardería:</label>
            <input type="text" name="nombre_guarderia" id="nombre_guarderia" value="<?php echo htmlspecialchars($nombre_guarderia_actual); ?>">
        </div>
        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" id="direccion" value="<?php echo htmlspecialchars($direccion_actual); ?>">
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" value="<?php echo htmlspecialchars($telefono_actual); ?>">
        </div>
        <div class="form-group">
            <label for="correo_electronico">Correo Electrónico:</label>
            <input type="email" name="correo_electronico" id="correo_electronico" value="<?php echo htmlspecialchars($correo_electronico_actual); ?>">
        </div>
        <div id="mensaje"></div>
        <button type="submit" class="btn-submit">Guardar Cambios</button>
    </form>
    <a href="dashboard1.php" class="btn-volver">Volver al Dashboard</a>
</div>

<!-- Script JavaScript -->
<script>
    // Obtener el elemento del mensaje
    var mensajeElemento = document.getElementById("mensaje");

    // Función para mostrar el mensaje
    function mostrarMensaje(mensaje) {
        // Asignar el mensaje al contenido del elemento
        mensajeElemento.textContent = mensaje;
        // Mostrar el mensaje estableciendo la visibilidad del elemento
        mensajeElemento.style.display = "block";
        // Desaparecer el mensaje después de 6 segundos
        setTimeout(function() {
            mensajeElemento.style.display = "none";
        }, 6000);
    }

    // Llamar a la función para mostrar el mensaje
    mostrarMensaje("Los datos se han actualizado correctamente.");
</script>
</body>
</html>
