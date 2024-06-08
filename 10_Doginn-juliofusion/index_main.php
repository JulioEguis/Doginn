<?php
session_start();
// Comprueba si la clave 'usuario_nombre' existe en el array $_SESSION
if (isset($_SESSION['usuario_nombre'])) {
    $saludo = "Hola " . $_SESSION['usuario_nombre'];
    $logged_in = true;
} else {
    $saludo = ""; // si no hay nombre de usuario, la variable $saludo se establece en una cadena vacía
    $logged_in = false;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DOGINN</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="preload" href="css/normalize.css" as="style">
    <link rel="stylesheet" href="css/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preload" href="css/styles.css" as="style">
    <!-- Enlaza la hoja de estilos styles.css -->
    <link href="css/styles.css" rel="stylesheet">
    <link rel="preload" href="css/login.css" as="style">
    <link rel="stylesheet" href="css/login.css">
    <link rel="preload" href="css/cerrar_sesion.css" as="style">
    <link rel="stylesheet" href="css/cerrar_sesion.css">
    <link rel="stylesheet" href="css/despegable.css">
    <link rel="stylesheet" href="css/titulo.css">
    <link rel="stylesheet" href="css/pontuguarde.css">  

    <link rel="preconnect" href="https://fonts.googleapis.com"> <!-- Enlace fuente de letra personalizado -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>  <!-- Enlace fuente de letra personalizado -->
    <link href="https://fonts.googleapis.com/css2?family=ADLaM+Display&display=swap" rel="stylesheet">  <!-- Enlace fuente de letra personalizado -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Enlace a la biblioteca jQuery -->
    <script src="js/Buscador/jquery-3.7.1.min.js"></script> <!-- Asegúrate de reemplazar "x.x.x" con la versión de jQuery que descargaste -->

    <!-- Enlace a la biblioteca jQuery UI -->
    <script src="js/Buscador/jquery-ui-1.13.2.custom/jquery-ui.min.js"></script>

    <!-- Enlace a archivos de JavaScript personalizados -->
    <script src="js/Buscador/buscador.js"></script>

    <script src="js/Carousel/carousel.js"></script>

    <style>
        <?php if ($logged_in): ?>
        .loginbotones.logged-in {
            background-color: green;
            color: white;
        }
        <?php endif; ?>
    </style>
</head>
<body>

<header>
    <video autoplay muted loop class="video-header">
        <source src="video/correperro.mp4" type="video/mp4">
        Tu navegador no admite la etiqueta de video.
    </video>
    <img src="img/logodoginn.png" alt="Logo de la página" class="logo">

    <!-- Contenedor centrado de enlaces -->
    <div class="botones-container">
        <!-- Enlace a Guarderías -->
        <a href="reservas.php" class="enlace-header">
            <img src="img/home_and.png" alt="Icono de Guarderías"> <!-- Añade la ruta correcta al ícono -->
            Guarderías
        </a>
        
        <!-- Enlace a Nosotros -->
        <a href="blog_index.php" class="enlace-header">
            <img src="img/dogicon.png" alt="Icono de Nosotros"> <!-- Añade la ruta correcta al ícono -->
            Nosotros
        </a>

        <?php if (!$logged_in): ?>
            <a href="guarderia_registro.html" class="enlace-header">
                <img src="img/registraguarde.png" alt="Icono de Registro"> <!-- Añade la ruta correcta al ícono -->
                Registra tu Guardería
            </a>
            <a href="login_guarderia.php" class="enlace-header">
                <img src="img/accesoguarde.png" alt="Icono de Acceso Guardería"> <!-- Añade la ruta correcta al ícono -->
                Accede a tu Guardería
            </a>
            <a href="registro.php" class="enlace-header">
                <img src="img/iconregistro.png" alt="Icono de Registro"> <!-- Añade la ruta correcta al ícono -->
                Regístrate
            </a>
            <a href="login.php" class="enlace-header">
                <img src="img/login_24.png" alt="Icono de Iniciar Sesión"> <!-- Añade la ruta correcta al ícono -->
                Iniciar Sesión
            </a>
        <?php else: ?>
            <a class="enlace-header">
                <img src="img/icons/usuario-icon.png" alt="Icono de Usuario"> <!-- Añade la ruta correcta al ícono -->
                <?php echo $saludo; ?>
            </a>
            <a href="mis_reservas.php" class="enlace-header">
                <img src="img/icons/reservas-icon.png" alt="Icono de Reservas"> <!-- Añade la ruta correcta al ícono -->
                Mis Reservas
            </a>
            <a href="logout_usuario.php" class="enlace-header">
                <img src="img/icons/logout-icon.png" alt="Icono de Cerrar Sesión"> <!-- Añade la ruta correcta al ícono -->
                Cerrar sesión
            </a>
        <?php endif; ?>
    </div>
</header>




    <!-- Formulario de búsqueda -->
    <div class="buscadorbody">
        <form id="searchForm" class="buscadorhorizontal-form" action="buscar_guarderias.php" method="post">
            <div class="buscadorinput-container">
                <label class="buscadorlabel" for="location" style="text-align: center;">Ubicación</label>
                <div class="buscadorinput-with-icon">
                    <input class="buscadorinput" type="text" id="location" name="location" required>
                    <img class="buscadorimg" src="img/logos buscador/ubicacion.png" alt="Icono de ubicación">
                </div>
            </div>
            <div class="buscadorinput-container">
                <label class="buscadorlabel" for="checkIn" style="text-align: center;">Fecha de entrada</label>
                <div class="buscadorinput-with-icon">
                    <input class="buscadorinput" type="date" id="checkIn" name="checkIn">
                    <img class="buscadorimg" src="img/logos buscador/calendario.jpg" alt="Icono de calendario">
                </div>
            </div>
            <div class="buscadorinput-container">
                <label class="buscadorlabel" for="checkOut" style="text-align: center;">Fecha de salida</label>
                <div class="buscadorinput-with-icon">
                    <input class="buscadorinput" type="date" id="checkOut" name="checkOut">
                    <img class="buscadorimg" src="img/logos buscador/calendario.jpg" alt="Icono de calendario">
                </div>
            </div>
            <div class="buscadorinput-container">
                <label class="buscadorlabel" for="numDogs" style="text-align: center;">Número de perros</label>
                <div class="buscadorinput-with-icon">
                    <input class="buscadorinput" type="number" id="numDogs" name="numDogs" min="1" value="1">
                    <img class="buscadorimg" src="img/logos buscador/Nperros.jpg" alt="Icono de perro">
                </div>
            </div>
            <button class="buscadorbutton" type="submit">Buscar</button>
        </form>
    </div>

    <!-- Guarderías más populares -->
    <p class="destinos-espana">Guarderías más populares</p>

    <div class="inicio-contenedor-guarderias">
    <?php
    // Incluir el archivo de conexión a la base de datos
    include 'includes/conexion.php';

    // Consulta SQL para obtener los datos de la tabla guarderias
    $sql = "
    SELECT g.*, MIN(cd.precio_noche) AS precio_minimo, ig.imagen_url 
    FROM guarderias g
    LEFT JOIN calendarios_disponibilidad cd ON g.id_guarderia = cd.id_guarderia
    LEFT JOIN imagenes_guarderia ig ON g.id_guarderia = ig.id_guarderia
    GROUP BY g.id_guarderia
";
    $result = $conexion->query($sql);

    // Verifica si hay resultados
    if ($result->num_rows > 0) {
        // Itera sobre los resultados y muestra cada guardería
        while ($row = $result->fetch_assoc()) {
            echo "<div class='guarderia-contenedor'>";
            echo "<div class='inicio-guarderia'>";
            if ($row['imagen_url']) {
                $imagePath = $row['imagen_url'];
                echo "<a href='gestion_reserva.php?id_guarderia=" . $row['id_guarderia'] . "'>";
                echo "<img src='" . $imagePath . "' alt='Imagen de la guardería' class='inicio-imagen-guarderia'>";
                echo "</a>";
            }
            echo "</div>"; // Cierra el div de la imagen de guardería
            // Información de la guardería
            echo "<div class='info-guarderia'>";
            echo "<h3 class='inicio-nombre-guarderia'>" . $row['nombre_guarderia'] . "</h3>";
            echo "<p class='inicio-direccion'>" . $row['direccion'] . "</p>";
            echo "<p class='inicio-precio'>Precio por noche: " . number_format($row['precio_minimo'], 2) . " €</p>";
            echo "<p class='inicio-puntuacion'><span class='estrella'>★</span> " . number_format($row['puntuacion'], 2) . "</p>";
            echo "</div>"; // Cierra el div de información de guardería
            echo "</div>"; // Cierra el div de guarderia-contenedor
        }
    } else {
        echo "No se encontraron resultados.";
    }

    // Cierra la conexión
    $conexion->close();
    ?>
</div>

    <!-- Sección Informativa -->
    <section class="info-section">
        <h1 class="info-section-titulo">Sección Informativa</h1>
        <div class="info-grid">
            <div class="info-item">
                <img src="img/Cuidadocompromiso/perroespalda.jpg" alt="Descripción de la imagen" class="info-item-image">
                <div class="info-item-text">
                    <h2 class="info-item-titulo">Cuidado</h2>
                    <p class="info-item-descripcion">En Doginn, nos preocupamos profundamente por la salud y 
                    felicidad de los perros. Creemos que cada perro merece jugar, alimentarse 
                    bien y tener suficiente espacio para vivir cómodamente.</p>
                </div>
            </div>
            <div class="info-item">
                <img src="img/Cuidadocompromiso/perrojugando.jpg" alt="Descripción de la imagen" class="info-item-image">
                <div class="info-item-text">
                    <h2 class="info-item-titulo">Compromiso</h2>
                    <p class="info-item-descripcion">Nuestros hoteles para perros cumplen con los más altos estándares de cuidado. 
                    Garantizamos que cada perro reciba atención personalizada, áreas de juego adecuadas y una dieta balanceada durante su estadía.</p>
                </div>
            </div>
            <div class="info-item">
                <img src="img/Cuidadocompromiso/descanso.jpg" alt="Descripción de la imagen" class="info-item-image">
                <div class="info-item-text">
                    <h2 class="info-item-titulo">Descanso</h2>
                    <p class="info-item-descripcion">Verificamos que cada guardería ofrezca un espacio tranquilo y cómodo para descansar, con camas limpias y un ambiente relajante para asegurar el bienestar de los perros.</p>
                </div>
            </div>
            <div class="info-item">
                <img src="img/Cuidadocompromiso/alimentacion.jpg" alt="Descripción de la imagen" class="info-item-image">
                <div class="info-item-text">
                    <h2 class="info-item-titulo">Alimentación</h2>
                    <p class="info-item-descripcion">Nuestras guarderías asociadas ofrecen una dieta balanceada y adaptada a las necesidades individuales de cada perro, asegurando su nutrición y bienestar durante toda su estadía.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <!-- Contenedor para los íconos de redes sociales -->
        <div class="social-icons">
            <!-- Enlace a Instagram -->
            <a href="https://www.instagram.com"><img src="img/RedesSociales/Instagram_logo_2016.svg.png" alt="Instagram"></a>
            <!-- Enlace a Twitter -->
            <a href="https://x.com/DoginnES"><img src="img/RedesSociales/twitter-x.png" alt="Twitter"></a>
            <!-- Enlace a Facebook -->
            <a href="https://www.facebook.com/profile.php?id=61560149064324"><img src="img/RedesSociales/2023_Facebook_icon.svg.png" alt="Facebook"></a>
        </div>

        <!-- Contenedor para los enlaces del footer -->
        <div class="footer-links">
            <a href="reservas.php">Guarderías</a>
            <a href="blog_index.php">Nosotros</a>
            <a href="login.php">Inicio Sesión</a>
            <a href="registro.php">Registrarse</a>
            <a href="guarderia_registro.html">Pon tu Guardería</a>
        </div>
    </footer>
</body>
</html>
