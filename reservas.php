<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas de Guarderías</title>
    <link rel="stylesheet" href="css/imagenes_guarderia.css">
  
</head>
<body>
<a href="index_main.php" class="btn-cerrar-sesion">Inicio</a>
<img src="img/logo-removebg-preview.png" alt="Logo de Doginn" class="logo-doginn">
    <h2>Guarderías</h2>

    <div class="contenedor-guarderias">
        <?php
        // Incluir el archivo de conexión a la base de datos
        include 'includes/conexion.php';

        // Consulta SQL para obtener los datos de la tabla guarderias
        $sql = "SELECT * FROM guarderias";
        $result = $conexion->query($sql);

        // Verifica si hay resultados
        if ($result->num_rows > 0) {
            // Itera sobre los resultados y muestra cada guardería
            while ($row = $result->fetch_assoc()) {
                echo "<div class='guarderia'>";
                // Consulta SQL para obtener la imagen representativa de esta guardería
                $id_guarderia = $row['id_guarderia'];
                $sql_imagen_representativa = "SELECT imagen_url FROM imagenes_guarderia WHERE id_guarderia = $id_guarderia LIMIT 1";
                $result_imagen_representativa = $conexion->query($sql_imagen_representativa);
                // Verifica si hay una imagen representativa
                if ($result_imagen_representativa->num_rows > 0) {
                    $imagen_representativa = $result_imagen_representativa->fetch_assoc();
                    echo "<img src='imagenes_guarderia/" . $imagen_representativa['imagen_url'] . "' alt='Imagen de la guardería' class='imagen-representativa' data-guarderia-id='" . $id_guarderia . "'>";
                }
                echo "<h3 class='nombre-guarderia'>" . $row['nombre_guarderia'] . "</h3>";
                echo "<p>" . $row['direccion'] . "</p>";
                echo "<p>" . $row['telefono'] . "</p>";
                // Consulta SQL para obtener las imágenes adicionales de esta guardería
                $sql_imagenes_adicionales = "SELECT imagen_url FROM imagenes_guarderia WHERE id_guarderia = $id_guarderia LIMIT 1, 10";
                $result_imagenes_adicionales = $conexion->query($sql_imagenes_adicionales);
                // Verifica si hay imágenes adicionales
                if ($result_imagenes_adicionales->num_rows > 0) {
                    echo "<div class='imagenes-adicionales'>";
                    // Itera sobre los resultados y muestra cada imagen adicional
                    while ($imagen_adicional = $result_imagenes_adicionales->fetch_assoc()) {
                        echo "<img src='imagenes_guarderia/" . $imagen_adicional['imagen_url'] . "' alt='Imagen adicional de la guardería'>";
                    }
                    echo "</div>"; // Cierra el div de imágenes adicionales
                }
                // Botón para mostrar más imágenes
                echo "<button class='btn-mas-imagenes'>Más Imágenes</button>";
                echo "</div>"; // Cierra el div de guardería
            }
        } else {
            echo "No se encontraron resultados.";
        }

        // Cierra la conexión
        $conexion->close();
        ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtener todos los botones de "Más Imágenes"
            const botonesMasImagenes = document.querySelectorAll('.btn-mas-imagenes');
            
            // Iterar sobre los botones y agregar un event listener a cada uno
            botonesMasImagenes.forEach(boton => {
                boton.addEventListener('click', function() {
                    const imagenesAdicionales = boton.parentElement.querySelector('.imagenes-adicionales');
                    if (imagenesAdicionales.style.display === 'none') {
                        imagenesAdicionales.style.display = 'block';
                        boton.textContent = 'Menos Imágenes';
                    } else {
                        imagenesAdicionales.style.display = 'none';
                        boton.textContent = 'Más Imágenes';
                    }
                });
            });
        });
    </script>
</body>
</html>
