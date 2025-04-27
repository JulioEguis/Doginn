<?php
session_start(); // Empezamos la sesión

// Checa si hay un usuario logueado o no
$loggedIn = isset($_SESSION['usuario_id']);

// Conexión a la base de datos
include 'includes/conexion.php';

// Consulta SQL para las guarderías
$sql = "
    SELECT g.*, MIN(cd.precio_noche) AS precio_minimo
    FROM guarderias g
    LEFT JOIN calendarios_disponibilidad cd ON g.id_guarderia = cd.id_guarderia
    GROUP BY g.id_guarderia
";
$result = $conexion->query($sql); // Ejecuta la consulta
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas de Guarderías</title>
    <link rel="stylesheet" href="css/imagenes_guarderia.css">
    <link rel="stylesheet" href="css/header_mg.css">
    <link rel="stylesheet" href="css/footer_mg.css">
    <link rel="icon" href="img/faviusuario.png" type="image/x-icon">
</head>
<body>
<header>
    <div class="container">
        <div class="logo">
            <a href="index_main.php">
                <img src="img/blog/logo_sf.png" alt="Logo de Mi Empresa" class="logo-img">
            </a>
        </div>
        <nav>
            <ul>
                <li><a href="index_main.php">Home</a></li>
                <li><a href="blog_index.php">Nosotros</a></li>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">Registra tu guardería</a>
                    <div class="dropdown-content">
                        <a href="guarderia_registro.html">Registrarse</a>
                        <a href="login_guarderia.php">Iniciar Sesión</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">Usuario</a>
                    <div class="dropdown-content">
                        <a href="registro.php">Registrarse</a>
                        <a href="login.php">Iniciar Sesión</a>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</header>
<br><br><br><br><br><br>

<h2>Nuestras guarderías</h2>
<!-- Modal para ver imagen grande -->
<div id="modal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modal-img">
</div>

<div class="contenedor-guarderias">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) { // Loop para mostrar guarderías
            echo "<div class='guarderia'>";
            $id_guarderia = $row['id_guarderia'];
            $sql_imagen_representativa = "SELECT imagen_url FROM imagenes_guarderia WHERE id_guarderia = $id_guarderia LIMIT 1";
            $result_imagen_representativa = $conexion->query($sql_imagen_representativa);
            if ($result_imagen_representativa->num_rows > 0) {
                $imagen_representativa = $result_imagen_representativa->fetch_assoc();
                echo "<img src='" . htmlspecialchars($imagen_representativa['imagen_url']) . "' alt='Imagen de la guardería' class='imagen-representativa' data-guarderia-id='" . $id_guarderia . "'>";
            }
            echo "<h3 class='nombre-guarderia'>" . htmlspecialchars($row['nombre_guarderia']) . "</h3>";
            echo "<p><img src='img/locationon.png' alt='Dirección' class='icon'>" . htmlspecialchars($row['direccion']) . "</p>";
            echo "<p><img src='img/call24.png' alt='Teléfono' class='icon'>" . htmlspecialchars($row['telefono']) . "</p>";
            echo "<p><img src='img/euro24.png' alt='Precio' class='icon'>" . htmlspecialchars($row['precio_minimo']) . " €</p>";
            
            // Más imágenes de la guardería
            $sql_imagenes_adicionales = "SELECT imagen_url FROM imagenes_guarderia WHERE id_guarderia = $id_guarderia LIMIT 1, 10";
            $result_imagenes_adicionales = $conexion->query($sql_imagenes_adicionales);
            if ($result_imagenes_adicionales->num_rows > 0) {
                echo "<div class='imagenes-adicionales' style='display: none;'>";
                while ($imagen_adicional = $result_imagenes_adicionales->fetch_assoc()) {
                    echo "<img src='" . htmlspecialchars($imagen_adicional['imagen_url']) . "' alt='Imagen adicional de la guardería'>";
                }
                echo "</div>";
            }
            echo "<button class='btn-mas-imagenes'>Más Imágenes</button>";
            echo "<a href='#' class='btn-hacer-reserva' data-guarderia-id='" . $id_guarderia . "'>Hacer Reserva</a>";
            echo "</div>";
        }
    } else {
        echo "No se encontraron resultados.";
    }
    $conexion->close();
    ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loggedIn = <?php echo json_encode($loggedIn); ?>;
        
        // Botones de "Más Imágenes"
        const botonesMasImagenes = document.querySelectorAll('.btn-mas-imagenes');
        
        // Agregar evento a cada botón
        botonesMasImagenes.forEach(boton => {
            boton.addEventListener('click', function() {
                const guarderia = boton.parentElement;
                const imagenesAdicionales = guarderia.querySelector('.imagenes-adicionales');
                const mostrandoMasImagenes = imagenesAdicionales.style.display === 'block';

                // Ocultar todas las imágenes adicionales
                document.querySelectorAll('.imagenes-adicionales').forEach(imagenes => {
                    imagenes.style.display = 'none';
                    imagenes.parentElement.classList.remove('expandido');
                });

                // Cambiar texto del botón
                document.querySelectorAll('.btn-mas-imagenes').forEach(btn => {
                    btn.textContent = 'Más Imágenes';
                });

                if (mostrandoMasImagenes) {
                    imagenesAdicionales.style.display = 'none';
                    boton.textContent = 'Más Imágenes';
                } else {
                    imagenesAdicionales.style.display = 'block';
                    boton.textContent = 'Menos Imágenes';
                    guarderia.classList.add('expandido');
                }
            });
        });

        // Botones para hacer reserva
        const botonesHacerReserva = document.querySelectorAll('.btn-hacer-reserva');

        botonesHacerReserva.forEach(boton => {
            boton.addEventListener('click', function(event) {
                if (!loggedIn) {
                    event.preventDefault();
                    alert('Para reservar, primero debes iniciar sesión');
                    window.location.href = 'login.php';
                } else {
                    const idGuarderia = boton.getAttribute('data-guarderia-id');
                    window.location.href = 'gestion_reserva.php?id_guarderia=' + idGuarderia;
                }
            });
        });

        // Modal para imágenes
        var modal = document.getElementById("modal");
        var img = document.querySelectorAll(".imagen-representativa, .imagenes-adicionales img");
        var modalImg = document.getElementById("modal-img");
        img.forEach(imagen => {
            imagen.addEventListener('click', function() {
                modal.style.display = "block";
                modalImg.src = this.src;
            });
        });

        var span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Cerrar modal al hacer clic fuera de la imagen
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    });
</script>

<br>
<!-- Botón volver final página -->
<div class="volver-container">
    <a href="index_main.php" class="volver-button">Volver</a>
</div>
<br><br>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="left">
            <a href="index_main.php">Doginn & Company</a>
        </div>
        <div class="center">
            <a href="mailto:doginnenterprise@gmail.com">doginnenterprise@gmail.com</a>
        </div>
        <div class="right">
            © Todos los derechos reservados 2024
        </div>
    </div>
</footer>

<!-- Estilos extra -->
<style>
    .reservar-button {
        background-color: #5986d9;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
        font-size: 16px;
    }

    .reservar-button:hover {
        background-color: #476bb5;
    }

    .container {
        margin-top: 20px;
    }

