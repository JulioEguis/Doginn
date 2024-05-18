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

<!-- Modal para mostrar la imagen ampliada -->
<div id="modal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modal-img">
</div>

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
            echo "<p><svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-map-pin' width='30' height='20' viewBox='0 0 24 24' stroke-width='1.5' stroke='#FFC107' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                        <path stroke='none' d='M0 0h24v24H0z'/>
                        <circle cx='12' cy='11' r='3' />
                        <path d='M17.657 16.657L13.414 20.9a1.998 1.998 0 0 1 -2.827 0l-4.244-4.243a8 8 0 1 1 11.314 0z' />
                    </svg>" . $row['direccion'] . "</p>";
            echo "<p><svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-phone-call' width='30' height='20' viewBox='0 0 24 24' stroke-width='1.5' stroke='#00abfb' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                      <path stroke='none' d='M0 0h24v24H0z' fill='none'/>
                      <path d='M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2' />
                      <path d='M15 7a2 2 0 0 1 2 2' />
                      <path d='M15 3a6 6 0 0 1 6 6' />
                    </svg>" . $row['telefono'] . "</p>";
            // Consulta SQL para obtener las imágenes adicionales de esta guardería
            $sql_imagenes_adicionales = "SELECT imagen_url FROM imagenes_guarderia WHERE id_guarderia = $id_guarderia LIMIT 1, 10";
            $result_imagenes_adicionales = $conexion->query($sql_imagenes_adicionales);
            // Verifica si hay imágenes adicionales
            if ($result_imagenes_adicionales->num_rows > 0) {
                echo "<div class='imagenes-adicionales' style='display: none;'>";
                // Itera sobre los resultados y muestra cada imagen adicional
                while ($imagen_adicional = $result_imagenes_adicionales->fetch_assoc()) {
                    echo "<img src='imagenes_guarderia/" . $imagen_adicional['imagen_url'] . "' alt='Imagen adicional de la guardería'>";
                }
                echo "</div>"; // Cierra el div de imágenes adicionales
            }
            // Botón para mostrar más imágenes
            echo "<button class='btn-mas-imagenes'>Más Imágenes</button>";
            echo "<a href='gestion_reserva.php?id_guarderia=" . $id_guarderia . "' class='btn-hacer-reserva'>Hacer Reserva</a>";
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
                // Obtener la guardería asociada al botón
                const guarderia = boton.parentElement;
                // Obtener las imágenes adicionales de la guardería
                const imagenesAdicionales = guarderia.querySelector('.imagenes-adicionales');
                // Alternar la visibilidad de las imágenes adicionales
                imagenesAdicionales.style.display = imagenesAdicionales.style.display === 'none' ? 'block' : 'none';
                // Cambiar el texto del botón
                boton.textContent = imagenesAdicionales.style.display === 'none' ? 'Más Imágenes' : 'Menos Imágenes';
            });
        });

        // Obtener el modal
        var modal = document.getElementById("modal");

        // Obtener la imagen y establecerla como contenido del modal
        var img = document.querySelectorAll(".imagen-representativa, .imagenes-adicionales img");
        var modalImg = document.getElementById("modal-img");
        img.forEach(imagen => {
            imagen.addEventListener('click', function() {
                modal.style.display = "block";
                modalImg.src = this.src;
            });
        });

        // Obtener el elemento <span> que cierra el modal
        var span = document.getElementsByClassName("close")[0];

        // Cuando se hace clic en <span> (x), se cierra el modal
        span.onclick = function() {
            modal.style.display = "none";
        }
    });
</script>
</body>
</html>
