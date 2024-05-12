<?php
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

// Verificar si se ha enviado un formulario para subir una nueva foto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['imagen'])) {
    // Guardar la imagen en una carpeta del servidor
    $carpeta_destino = "/opt/lampp/htdocs/Doginn/Doginn-master/imagenes_guarderia/";
    $nombre_imagen = $_FILES['imagen']['name'];
    $ruta_servidor = $carpeta_destino . $nombre_imagen;
    
    // Mover la imagen al servidor y cambiar los permisos
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_servidor)) {
        // Cambiar los permisos de la imagen para que sean accesibles
        chmod($ruta_servidor, 0777);

        // Insertar la ruta de la imagen en la base de datos
        $query_insertar_imagen = "INSERT INTO imagenes_guarderia (id_guarderia, imagen_url, ruta_imagen) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($query_insertar_imagen);
        $stmt->bind_param("iss", $guarderia_id, $nombre_imagen, $ruta_servidor);

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

// Mostrar todas las imágenes de la guardería
echo "<h2 class='gallery-title'>Imágenes de la Guardería</h2>";
echo "<div class='gallery'>";
if ($resultado_imagenes->num_rows > 0) {
    while ($fila_imagen = $resultado_imagenes->fetch_assoc()) {
        echo "<div class='image-container'>";
        // Construir la ruta completa de la imagen
        $nombre_imagen = $fila_imagen['imagen_url'];
        $ruta_imagen_completa = "/Doginn/Doginn-master/imagenes_guarderia/" . $nombre_imagen;
        // Mostrar la imagen
        echo "<img src='" . $ruta_imagen_completa . "' alt='Imagen de la guardería'>";
        
        // Formulario para eliminar la imagen
        echo "<form action='subir_fotos.php' method='post' onsubmit='return confirmarEliminacion()'>";
        echo "<input type='hidden' name='id_imagen' value='" . $fila_imagen['id'] . "'>";
        echo "<button type='submit' class='delete-btn' name='eliminar_imagen'>Eliminar</button>";
        echo "</form>";
        
        echo "</div>";
    }
} else {
    echo "No se encontraron imágenes.";
}
echo "</div>";
?>

<!-- Formulario para subir más fotos -->
<form action="subir_fotos.php" method="post" enctype="multipart/form-data">
    <h2>Subir Nuevas Fotos</h2>
    <label for="imagen" class="upload-btn">Seleccionar Foto</label>
    <input type="file" name="imagen" id="imagen" required>
    <span id="file-selected-message" class="upload-message"></span>
    <button type="submit" class="upload-btn">Subir Foto</button>
    <link rel="stylesheet" type="text/css" href="css/subir_fotos.css">
</form>

<a href="dashboard1.php" class="upload-btn dashboard-btn">Volver al Dashboard</a>
<a href="logout.php" class="btn-cerrar-sesion">Cerrar Sesión</a>

<script>
    // Obtener referencia al campo de entrada de archivos
    var input = document.getElementById('imagen');

    // Agregar un evento change para detectar cuando se seleccione un archivo
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