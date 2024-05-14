<?php
session_start();
// Comprueba si la clave 'usuario_nombre' existe en el array $_SESSION
if (isset($_SESSION['usuario_nombre'])) {
    $saludo = "Hola, " . $_SESSION['usuario_nombre'];
} else {
    // si no hay nombre de usuario, la variable $saludo se establece en una cadena vacía
    $saludo = ""; // si no hay nombre de usuario, la variable $saludo se establece en una cadena vacía
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

</head>

<body>



    <header>
        <!-- Botones de inicio, registro, pon tu guarderia -->
        <div class="botones-container">
            <a  href="guarderia_registro.html" class="loginbotones" >Pon tu Guardería</a>
            <a  href="login.php" class="loginbotones" >Iniciar Sesión</a>
            <a href="login_guarderia.php" class="loginbotones">Administración Guarderías</a>
            <a  href="registro.php" class="loginbotones" >Registrarse</a>
        </div>

        <video autoplay muted loop class="video-header">
            <source src="video/correperro.mp4" type="video/mp4">
            Tu navegador no admite la etiqueta de video.


        </video>
        <img src="img/logodoginn.png" alt="Logo de la página" class="logo">

        

        <!-- Botón azul -->
        <a href="reservas.php" class="button-header blue" style="left: 20%;">Guarderías</a>
        
        <!-- Botón transparente -->
        <a href="#" class="button-header transparent" style="left: 80%;">Nosotros</a>

    </header>
    


<!--
    Este bloque de código representa un formulario de búsqueda.
    Contiene campos para ingresar la ubicación, la fecha de entrada,
    la fecha de salida y el número de perros. Cuenta con una funcion de autorrellenado 
    de js. Archivo jquery-3.7.1.min.js
-->


<div class="buscadorbody">
    <form id="searchForm" class="buscadorhorizontal-form">
        
        <!-- Campo de entrada para la ubicación -->
        <div class="buscadorinput-container">
            <label class="buscadorlabel" for="location">Ubicación:</label>
            <div class="buscadorinput-with-icon">
                <input class="buscadorinput" type="text" id="location" name="location" required>
                <img class="buscadorimg" src="img/logos buscador/ubicacion.png" alt="Icono de ubicación">
            </div>
        </div>
        
        <!-- Campo de entrada para la fecha de entrada -->
        <div class="buscadorinput-container">
            <label class="buscadorlabel" for="checkIn">Fecha de entrada:</label>
            <div class="buscadorinput-with-icon">
                <input class="buscadorinput" type="date" id="checkIn" name="checkIn" required>
                <img class="buscadorimg" src="img/logos buscador/calendario.jpg" alt="Icono de calendario">
            </div>
        </div>
        
        <!-- Campo de entrada para la fecha de salida -->
        <div class="buscadorinput-container">
            <label class="buscadorlabel" for="checkOut">Fecha de salida:</label>
            <div class="buscadorinput-with-icon">
                <input class="buscadorinput" type="date" id="checkOut" name="checkOut" required>
                <img class="buscadorimg" src="img/logos buscador/calendario.jpg" alt="Icono de calendario">
            </div>
        </div>
        
        <!-- Campo de entrada para el número de perros -->
        <div class="buscadorinput-container">
            <label class="buscadorlabel" for="numDogs">Número de perros:</label>
            <div class="buscadorinput-with-icon">
                <input class="buscadorinput" type="number" id="numDogs" name="numDogs" min="1" value="1" required>
                <img class="buscadorimg" src="img/logos buscador/Nperros.jpg" alt="Icono de perro">
            </div>
        </div>
        
        <!-- Botón para enviar el formulario de búsqueda -->
        <button class="buscadorbutton" type="submit">Buscar</button>
    </form>
</div>


<!--
    Este bloque de código son los destinos mas populares junto con imagenes y botones.
-->

<p class="destinos-populares">Destinos España</p>
<div class="populargaleria">
    <a href="pagina_madrid.html" class="boton-galeria">
  
            <img src="img/popular/madrid.jpg" class="popularimg">
            <span class="popularciudad">Barcelona</span>
       
    </a>
    <a href="pagina_barcelona.html" class="boton-galeria">
    <img src="img/popular/madrid.jpg" class="popularimg">
        <span class="popularciudad">Barcelona</span>
        
    </a>
    <a href="pagina_sevilla.html" class="boton-galeria">
    <img src="img/popular/madrid.jpg" class="popularimg">
        <span class="popularciudad">Sevilla</span>
    </a>
    <a href="pagina_valencia.html" class="boton-galeria">
    <img src="img/popular/madrid.jpg" class="popularimg">
        <span class="popularciudad">Valencia</span>
    </a>
</div>

<!--
    Este bloque de código son los destinos de España con imagenes y botones.
-->

<p class="destinos-espana">Destinos más populares</p>



<div class="carousel-container">
    <div class="carousel">
        <div class="carouselslide">
            <img src="img/carousel/murcia.jpg" alt="Imagen 1">
            
        </div>
        <div class="carouselslide">
            <img src="img/carousel/vitoria.jpg" alt="Imagen 2">
        
        </div>
        <div class="carouselslide">
            <img src="img/carousel/sansebastian.jpg" alt="Imagen 3">
        
        </div>
        <div class="carouselslide">
            <img src="img/carousel/malaga.jpg" alt="Imagen 4">
            
        </div>
        <div class="carouselslide">
            <img src="img/carousel/Acorua.png" alt="Imagen 4">
            
        </div>
        <div class="carouselslide">
            <img src="img/carousel/alicante.jpg" alt="Imagen 4">
            
        </div>
    </div>
    <button class="prev">&gt;</button>
    <button class="next">&gt;</button>
</div>

<!--
    Este bloque de código es la descripcion de compromiso y cuidado
-->


<!-- Contenedor para una imagen con texto -->
<div class="image-with-text">
    <!-- Imagen con su descripción -->
    <img src="img/Cuidadocompromiso/perroespalda.jpg" alt="Descripción de la imagen">
    <!-- Contenedor para el texto asociado a la imagen -->
    <div class="text-container">
        <!-- Título del texto -->
        <h2 class="titulo">Cuidado</h2>
        <!-- Párrafo con la descripción -->
        <p class="texto">En DoGinn, nos preocupamos profundamente por la salud y 
            felicidad de los perros. Creemos que cada perro merece jugar, alimentarse 
            bien y tener suficiente espacio para vivir cómodamente.</p>
    </div>
</div>

<!-- Contenedor para otra imagen con texto -->
<div class="image-with-text2">
    <!-- Imagen con su descripción -->
    <img src="img/Cuidadocompromiso/perrojugando.jpg" alt="Descripción de la imagen">
    <!-- Contenedor para el texto asociado a la segunda imagen -->
    <div class="text-container2">
        <!-- Título del texto -->
        <h2 class="titulo">Compromiso</h2>
        <!-- Párrafo con la descripción -->
        <p class="texto2">Nuestros hoteles para perros cumplen con los más altos estándares de cuidado. 
            Garantizamos que cada perro reciba atención personalizada, áreas de juego adecuadas y una dieta balanceada durante su estadía.</p>
    </div>
</div>


<div class="formulario-container">
        <div class="formulario-logo-container">
            <img src="img/logo-removebg-preview.png" alt="Logo de la página" class="formulario-logo">
        </div>
        <div class="formulario-form-container">
            <form class="formulario-form">
                <div class="formulario-form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="formulario-form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="formulario-form-group">
                    <label for="message">Mensaje:</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>


    

<footer class="footer">
    <!-- Contenedor para los íconos de redes sociales -->
    <div class="social-icons">
        <!-- Enlace a Instagram -->
        <a href="https://www.instagram.com"><img src="img/RedesSociales/Instagram_logo_2016.svg.png" alt="Instagram"></a>
        <!-- Enlace a Twitter -->
        <a href="https://twitter.com"><img src="img/RedesSociales/twitter-x.png" alt="Twitter"></a>
        <!-- Enlace a Facebook -->
        <a href="https://www.facebook.com"><img src="img/RedesSociales/2023_Facebook_icon.svg.png" alt="Facebook"></a>
    </div>

    <!-- Contenedor para los enlaces del footer -->
    <div class="footer-links">
        <!-- Enlace a la página de Guarderías -->
        <a href="reservas.php">Guarderías</a>
        <!-- Enlace a la página Nosotros -->
        <a href="nosotros.html">Nosotros</a>
        <!-- Enlace a la página de Inicio de Sesión -->
        <a href="login.php">Inicio Sesión</a>
        <!-- Enlace a la página de Registro -->
        <a href="registro.php">Registrarse</a>
        <!-- Enlace a la página de Pon tu Guardería -->
        <a href="guarderia_registro.html">Pon tu Guardería</a>
    </div>
</footer>

</body>
</html>

