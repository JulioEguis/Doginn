<?php
session_start(); // empieza la sesion, 

// verifica si hay un usuario, o no
if ( isset( $_SESSION['usuario_nombre'] ) ) {
    $saludo = "Hola " . $_SESSION['usuario_nombre']; // ensaje de saludo, ss
    $logged_in = true; // el usuario esta logueado
} else {
    $saludo = ""; // mensaje vacio si no hay usuario
    $logged_in = false; // el usuario no esta logueado
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DOGINN</title>
<!-- icono de la página, perritos -->
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- cargar css de normalizacion, ??? -->
<link rel="preload" href="css/normalize.css" as="style">
<link rel="stylesheet" href="css/normalize.css">
<!-- fuente de google, ??? -->
<link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
<!-- css principal, estilos bonitos -->
<link rel="preload" href="css/styles.css" as="style">
<link href="css/styles.css" rel="stylesheet">
<!-- ccss de login, para iniciar sesion -->
<link rel="preload" href="css/login.css" as="style">
<link rel="stylesheet" href="css/login.css">
<!-- --css de cerrar sesion, adios! -->
<link rel="preload" href="css/cerrar_sesion.css" as="style">
<link rel="stylesheet" href="css/cerrar_sesion.css">
<!-- argar otros css, muchos estilos -->
<link rel="stylesheet" href="css/despegable.css">
<link rel="stylesheet" href="css/titulo.css">

<!-- conctar a google fonts, letras bonitas -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=ADLaM+Display&display=swap" rel="stylesheet">
<!-- jquery ui, mas -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- cargar scripts, magia -->
<script src="js/Buscador/jquery-3.7.1.min.js"></script>
<script src="js/Buscador/jquery-ui-1.13.2.custom/jquery-ui.min.js"></script>
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
<source src="video/videoperro.mp4" type="video/mp4">
tu navegador no soporta video.
</video>
<img src="img/logodoginn.png" alt="logo de la pagina" class="logo">

    <!-- contenedor de enlaces centrado -->
    <div class="botones-container">
    <!-- enlace a guarderias -->
    <a href="reservas.php" class="enlace-header">
    <img src="img/homedog2.png" alt="icono de guarderias"> <!-- icono de guarderias -->
    Guarderías
    </a>

    <span class="enlace-header">
<img src="img/pets.png" alt="icono de nosotros">
Nosotros
</span>

    <?php if (!$logged_in): ?>
    <a href="guarderia_registro.html" class="enlace-header">
    <img src="img/registraguarde1.png" alt="icono de registro"> <!-- icono de registro -->
    Registro Guardería
    </a>
    <a href="login_guarderia.php" class="enlace-header">
    <img src="img/accesoguarde1.png" alt="icono de acceso guardería"> <!-- icono de acceso -->
    Acceso Guardería
    </a>
    <a href="registro.php" class="enlace-header">
    <img src="img/usuario1.png" alt="icono de registro"> <!-- icono de registro -->
    Regístrate
    </a>
<a href="login.php" class="enlace-header">
<img src="img/login1.png" alt="icono de iniciar sesión"> <!-- icono de iniciar sesión -->
Iniciar Sesión
</a>
<?php else: ?>
<a href="mis_reservas.php" class="enlace-header">
<img src="img/menu.png" alt=""> <!-- icono de reservas -->
Mis Reservas
</a>

<a href="logout_usuario.php" class="enlace-header">
<img src="img/dangerous.png" alt=""> <!-- icono de cerrar sesión -->
Cerrar Sesión
</a>
<div class="saludo-usuario">
<?php echo $saludo; ?>
</div>
<?php endif; ?>
</div>
</header>

<!-- formulario de búsqueda -->
<div class="buscadorbody">
<form id="searchForm" class="buscadorhorizontal-form" action="buscar_guarderias.php" method="post">
<div class="buscadorinput-container">
<label class="buscadorlabel" for="location" style="text-align: center;">Ubicación</label>
<div class="buscadorinput-with-icon">
<input class="buscadorinput" type="text" id="location" name="location" required>
<img class="buscadorimg" src="img/logos buscador/ubicacion.png" alt="icono de ubicación">
</div>
</div>
<div class="buscadorinput-container">
<label class="buscadorlabel" for="checkIn" style="text-align: center;">Fecha Entrada</label>
<div class="buscadorinput-with-icon">
<input class="buscadorinput" type="date" id="checkIn" name="checkIn">
<img class="buscadorimg" src="img/logos buscador/calendario.jpg" alt="icono de calendario">
</div>
</div>
<div class="buscadorinput-container">
<label class="buscadorlabel" for="checkOut" style="text-align: center;">Fecha Salida</label>
<div class="buscadorinput-with-icon">
<input class="buscadorinput" type="date" id="checkOut" name="checkOut">
<img class="buscadorimg" src="img/logos buscador/calendario.jpg" alt="icono de calendario">
</div>
</div>
<div class="buscadorinput-container">
<label class="buscadorlabel" for="numDogs" style="text-align: center;">Número de Perros</label>
<div class="buscadorinput-with-icon">
<input class="buscadorinput" type="number" id="numDogs" name="numDogs" min="1" value="1">
<img class="buscadorimg" src="img/logos buscador/Nperros.jpg" alt="icono de perro">
</div>
</div>
<button class="buscadorbutton" type="submit">Buscar</button>
</form>
</div>

<!-- guarderías más populares -->
<p class="destinos-espana"></p>

<div class="inicio-contenedor-guarderias">
<?php
// incluir conexion a base de datos
include 'includes/conexion.php';

// consulta sql para datos de guarderias
$sql = "
SELECT g.*, MIN(cd.precio_noche) AS precio_minimo, ig.imagen_url 
FROM guarderias g
LEFT JOIN calendarios_disponibilidad cd ON g.id_guarderia = cd.id_guarderia
LEFT JOIN imagenes_guarderia ig ON g.id_guarderia = ig.id_guarderia
GROUP BY g.id_guarderia
";
$result = $conn->query($sql);

// verifica si hay resultados
if ($result->num_rows > 0) {
// mostrar cada guarderia
while ($row = $result->fetch_assoc()) {
echo "<div class='guarderia-contenedor'>";
echo "<div class='inicio-guarderia'>";
if ($row['imagen_url']) {
$imagePath = $row['imagen_url'];
echo "<a href='gestion_reserva.php?id_guarderia=" . $row['id_guarderia'] . "'>";
echo "<img src='" . $imagePath . "' alt='imagen de la guardería' class='inicio-imagen-guarderia'>";
echo "</a>";
}
echo "</div>"; // cierra div imagen guarderia
// info de la guarderia
echo "<div class='info-guarderia'>";
echo "<h3 class='inicio-nombre-guarderia'>" . $row['nombre_guarderia'] . "</h3>";
echo "<p class='inicio-direccion'>" . $row['direccion'] . "</p>";
echo "<p class='inicio-precio'> " . number_format($row['precio_minimo'], 2) . " € noche</p>";
echo "<p class='inicio-puntuacion'><span class='estrella'>★</span> " . number_format($row['puntuacion'], 2) . "</p>";
echo "</div>"; // cierra div info guarderia
echo "</div>"; // cierra div guarderia contenedor
}
} else {
echo "no se encontraron resultados.";
}

// cierra conexion
$conn->close();
?>
</div>

<section class="info-section">
    <h1 class="info-section-titulo">Sección Informativa</h1>
    <div class="info-grid">
        <div class="info-item">
            <img src="img/Cuidadocompromiso/perroespalda.jpg" alt="Descripción de la imagen" class="info-item-image">
            <div class="info-item-text">
                <h2 class="info-item-titulo">Cuidado</h2>
                <p class="info-item-descripcion">En DoGinn, nos preocupamos profundamente por la salud y 
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
            <img src="img/Cuidadocompromiso/alimentacion.jpg" alt="Descripción de la imagen" class="info-item-image">
            <div class="info-item-text">
                <h2 class="info-item-titulo">Alimentación</h2>
                <p class="info-item-descripcion">Nuestras guarderías asociadas ofrecen una dieta balanceada y adaptada a las necesidades individuales de cada perro, asegurando su nutrición y bienestar durante toda su estadía.</p>
            </div>
        </div>
        <div class="info-item">
            <img src="img/Cuidadocompromiso/descanso.jpg" alt="Descripción de la imagen" class="info-item-image">
            <div class="info-item-text">
                <h2 class="info-item-titulo">Descanso</h2>
                <p class="info-item-descripcion">Verificamos que cada guardería ofrezca un espacio tranquilo y cómodo para descansar, con camas limpias y un ambiente relajante para asegurar el bienestar de los perros.</p>
            </div>
        </div>
    </div>
</section>



<footer class="footer">
<!-- contenedor para los iconos de redes sociales -->
<div class="social-icons">
<!-- enlace a instagram -->
<a href="https://www.instagram.com"><img src="img/RedesSociales/Instagram_logo_2016.svg.png" alt="instagram"></a>
<!-- enlace a twitter -->
<a href="https://x.com/DoginnES"><img src="img/RedesSociales/twitter-x.png" alt="twitter"></a>
<!-- enlace a facebook -->
<a href="https://www.facebook.com/profile.php?id=61560149064324"><img src="img/RedesSociales/2023_Facebook_icon.svg.png" alt="facebook"></a>
</div>

<!-- contenedor para los enlaces del footer -->
<div class="footer-links">
<a href="reservas.php">Guarderías</a>
<!-- <a href="blog_index.php">Nosotros</a> -->
<a href="login.php">Inicio sesión</a>
<a href="registro.php">Registrarse</a>
<a href="guarderia_registro.html">Pon tu guardería</a>
</div>
</footer>
</body>
</html>
