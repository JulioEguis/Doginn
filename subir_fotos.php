<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir el archivo de conexión a la base de datos
include('includes/conexion.php');

// Verificar si la guardería ha iniciado sesión
session_start();
if (!isset($_SESSION['id_guarderia'])) {
    // Si la guardería no ha iniciado sesión, redirigirla al formulario de inicio de sesión
    header("Location: login_guarderia.php");
    exit();
}

// Obtener el ID de la guardería que ha iniciado sesión
$guarderia_id = $_SESSION['id_guarderia'];

// Obtener el nombre de la guardería desde la base de datos
$query_nombre_guarderia = "SELECT nombre_guarderia FROM guarderias WHERE id_guarderia = ?";
$stmt_nombre_guarderia = $conexion->prepare($query_nombre_guarderia);
if (!$stmt_nombre_guarderia) {
    die("Error en la preparación de la consulta: " . $conexion->error);
}
$stmt_nombre_guarderia->bind_param("i", $guarderia_id);
$stmt_nombre_guarderia->execute();
$stmt_nombre_guarderia->bind_result($nombre_guarderia);
$stmt_nombre_guarderia->fetch();
$stmt_nombre_guarderia->close();

// Verificar si se ha enviado un formulario para subir una nueva foto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['imagen'])) {
    // Guardar la imagen en una carpeta del servidor
    $carpeta_destino = "imagenes_guarderia/";  // Ruta relativa a la raíz del servidor web
    $nombre_imagen = basename($_FILES['imagen']['name']);
    $ruta_servidor = $carpeta_destino . $nombre_imagen;

    // Verificar si el directorio existe, si no, crear el directorio
    if (!is_dir($carpeta_destino)) {
        mkdir($carpeta_destino, 0777, true);
    }
    
    // Mover la imagen al servidor y cambiar los permisos
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_servidor)) {
        // Cambiar los permisos de la imagen para que sean accesibles
        chmod($ruta_servidor, 0777);

        // Insertar la ruta completa de la imagen en la base de datos
        $imagen_url = $carpeta_destino . $nombre_imagen;  // Esto incluye la ruta completa

        $stmt = $conexion->prepare("INSERT INTO imagenes_guarderia (id_guarderia, imagen_url, ruta_imagen) VALUES (?, ?, ?)");
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }
        $stmt->bind_param("iss", $guarderia_id, $imagen_url, $ruta_servidor);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Imagen subida exitosamente.";
            // Redirigir al usuario a una página de confirmación después de subir la imagen
            header("Location: confirmacion_subida.php");
            exit();
        } else {
            echo "Error al subir la imagen: " . $stmt->error;
        }
    } else {
        echo "Error al mover la imagen al servidor.";
    }
}

// Verificar si se ha enviado un formulario para eliminar una imagen
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar_imagen'])) {
    // Obtener el ID de la imagen a eliminar
    $id_imagen = $_POST['id_imagen'];

    // Preparar la declaración SQL para eliminar la imagen de la base de datos
    $query_eliminar_imagen = "DELETE FROM imagenes_guarderia WHERE id = ?";
    $stmt = $conexion->prepare($query_eliminar_imagen);
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }
    $stmt->bind_param("i", $id_imagen);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Imagen eliminada exitosamente.";
        // Actualizar la página para reflejar los cambios
        header("Location: subir_fotos.php");
        exit();
    } else {
        echo "Error al eliminar la imagen: " . $stmt->error;
    }
}

// Consultar todas las imágenes de la guardería que ha iniciado sesión
$query_consulta_imagenes = "SELECT imagen_url, id FROM imagenes_guarderia WHERE id_guarderia = $guarderia_id";
$resultado_imagenes = $conexion->query($query_consulta_imagenes);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Fotos</title>
    <link rel="stylesheet" type="text/css" href="css/subir_fotos.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>

<div class="container">
    <div class="titulo-container">
        <h2 class="guarderia-title">Guardería</h2>
        <h3 class="gallery-title"><?php echo htmlspecialchars($nombre_guarderia); ?></h3>
    </div>
    <div class="gallery">
        <?php
        if ($resultado_imagenes->num_rows > 0) {
            while ($fila_imagen = $resultado_imagenes->fetch_assoc()) {
                echo "<div class='image-container'>";
                // Construir la ruta completa de la imagen
                $nombre_imagen = $fila_imagen['imagen_url'];
                $ruta_imagen_completa = $nombre_imagen;
                // Mostrar la imagen
                echo "<img src='" . $ruta_imagen_completa . "' alt='Imagen de la guardería'>";
                // Formulario para eliminar la imagen
                echo "<form action='subir_fotos.php' method='post' onsubmit='return confirmarEliminacion()'>";
                echo "<input type='hidden' name='id_imagen' value='" . $fila_imagen['id'] . "'>";
                echo "<button type='submit' class='delete-btn' name='eliminar_imagen'>X</button>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "No se encontraron imágenes.";
        }
        ?>
    </div>
   <!-- Formulario para subir más fotos -->
<div class="form-container">
    <form action="subir_fotos.php" method="post" enctype="multipart/form-data">
        <h2>Subir Nuevas Fotos</h2>
        <label for="imagen" class="upload-btn">Seleccionar Foto</label>
        <input type="file" name="imagen" id="imagen" required>
        <span id="file-selected-message" class="upload-message"></span>
        <button type="submit" class="upload-btn">Subir Foto</button>
    </form>
    <a href="dashboard1.php" class="upload-btn dashboard-btn">Volver al Dashboard</a>
    <a href="logout.php" class="btn-cerrar-sesion">Cerrar Sesión</a>
</div>

<script>
    // Obtener referencia al campo de entrada de archivos
    var input = document.getElementById('imagen');

    // Agregar un evento  para detectar cuando se seleccione un archivo
    input.addEventListener('change', function() {
        // Obtener el nombre del archivo seleccionado
        var fileName = input.files[0].name;
        // Mostrar el mensaje con el nombre del archivo seleccionado
        document.getElementById('file-selected-message').textContent = 'Archivo seleccionado: ' + fileName;
    });

    function confirmarEliminacion() {
        return confirm("¿Estás seguro de que deseas eliminar esta imagen?");
    }
</script>

</body>
</html>
