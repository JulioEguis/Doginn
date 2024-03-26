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
    <link rel="stylesheet" href="css/menudespegable.css">
    
</head>
<body>
    <!-- Encabezado de la página -->
    <header>
    <h1 class="titulo">DOGINN <span>Booking</span></h1>
    <img id="menu-usuario-btn" class="menu-btn" src="img/usuario.svg" alt="Usuario" style="width: 35px; height: 35px;">
    <img id="menu-lineas-btn" class="menu-btn" src="img/lineas.svg" alt="Líneas" style="width: 35px; height: 35px;">
  
    <div id="menu-desplegable" class="menu-desplegable">
        <nav>
            <ul>
                <li><a href="login.php">Iniciar Sesión</a></li>
                <li><a href="registro.php">Regístrate</a></li>
            </ul>
        </nav>
    </div>
</header>



    <div class="usuario-info">
        <!-- Imprime el saludo de usuario -->
        <?php if ($saludo !== ""): ?>
            <span class="saludo-usuario"><?php echo $saludo; ?></span>
            <a href="cerrar_sesion.php" class="boton-cerrar-sesion">Cerrar sesión</a>
        <?php endif; ?>
    </div>
    <!-- Barra de navegación -->
    <div class="nav-bg">
        <nav class="navegacion-principal contenedor">
            <a href="#">Inicio</a>
            <a href="reservas.php">Guarderías</a>
            <a href="#">Galeria</a>
            <a href="#">Contacto</a>
       
           
        </nav>
    </div>

    <!-- Sección principal (Hero) -->
    <section class="hero">
    <div class="contenido-hero">
        <?php if (!isset($_SESSION['usuario_nombre'])): ?>
            <h2>Reservas <span>de Guarderías Caninas</span></h2>
            <div class="ubicacion">
                <!-- Icono de ubicación -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin" width="88" height="88" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FFC107" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z"/>
                    <circle cx="12" cy="11" r="3" />
                    <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 0 1 -2.827 0l-4.244-4.243a8 8 0 1 1 11.314 0z" />
                </svg>
                <p>Madrid</p>
            </div>
            <!-- Botones para iniciar sesión y registrarse solo se muestran si el usuario no ha iniciado sesión -->
            <a class="boton" href="login.php">Inicia Sesión</a>
            <p></p>
            <a class="boton" href="registro.php">Regístrate</a>
        <?php endif; ?>
        </div> <!-- .contenido-hero -->
    </section>

    <!-- Contenido principal (Main) -->
    <main class="contenedor sombra">
        <h2>Reserva</h2>

        <!-- Sección de servicios -->
        <div class="servicios">
            <!-- Servicio 1: Blog -->
            <section class="servicio">
                <h3>Blog</h3>
                <div class="iconos">
                    <!-- Icono del blog -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-palette" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <path d="M12 21a9 9 0 1 1 0 -18a9 8 0 0 1 9 8a4.5 4 0 0 1 -4.5 4h-2.5a2 2 0 0 0 -1 3.75a1.3 1.3 0 0 1 -1 2.25" />
                        <circle cx="7.5" cy="10.5" r=".5" fill="currentColor" />
                        <circle cx="12" cy="7.5" r=".5" fill="currentColor" />
                        <circle cx="16.5" cy="10.5" r=".5" fill="currentColor" />
                    </svg>
                </div>
                <p> Pellentesque odio ex, bibendum quis convallis scelerisque, eleifend vitae lectus. Quisque in erat justo. </p>
            </section>
       
            <!-- Servicio 2: Formación -->
            <section class="servicio">
                <h3>Formación</h3>
                <div class="iconos">
                    <!-- Iconos de Android y Apple para representar la formación -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-android" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <line x1="4" y1="10" x2="10" y2="10" />
                        <line x1="4" y1="6" x2="10" y2="6" />
                        <line x1="4" y1="14" x2="10" y2="14" />
                        <line x1="4" y1="18" x2="10" y2="18" />
                        <line x1="14" y1="10" x2="20" y2="10" />
                        <line x1="14" y1="6" x2="20" y2="6" />
                        <line x1="14" y1="14" x2="20" y2="14" />
                        <line x1="14" y1="18" x2="20" y2="18" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-apple" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <path d="M8 3.5c-1.101 0-2 .899-2 2v13c0 1.101 .899 2 2 2h8c1.101 0 2 -.899 2 -2v-13c0-1.101-.899-2-2-2h-8a2 2 0 0 0-2 2z" />
                        <path d="M12 15a2 2 0 0 0 0-4v4z" />
                    </svg>
                </div>
                <p> Vestibulum dapibus augue eget libero volutpat, ut ultrices tellus congue. </p>
            </section>
       

        <section class="servicio">
                <h3>Notas de prensa</h3>
                <div class="iconos">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-credit-card" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <rect x="3" y="5" width="18" height="14" rx="3" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                        <line x1="7" y1="15" x2="7.01" y2="15" />
                        <line x1="11" y1="15" x2="13" y2="15" />
                    </svg>
                </div>
                <p> Pellentesque odio ex, bibendum quis convallis scelerisque, eleifend vitae lectus. Quisque in erat justo. </p>
            </section>
            </div>

        <!-- Sección de contacto -->
        <section class="contacto">
            <h2>Contacto</h2>
            <form class="formulario">
                <fieldset>
                    <legend>Contactános llenando todos los campos</legend>

                    <div class="contenedor-campos">
                        <div class="campo">
                            <label for="nombre">Nombre</label>
                            <input id="nombre" class="input-text" type="text" placeholder="Tu Nombre" required>
                        </div>

                        <div class="campo">
                            <label for="telefono">Teléfono</label>
                            <input id="telefono" class="input-text" type="tel" placeholder="Tu Teléfono" required>
                        </div>

                        <div class="campo">
                            <label for="correo">Correo</label>
                            <input id="correo" class="input-text" type="email" placeholder="Tu Email" required>
                        </div>
                
                        <div class="campo">
                            <label for="mensaje">Mensaje</label>
                            <textarea id="mensaje" class="input-text" required></textarea>
                        </div>
                    </div>

                    <div class="alinear-derecha flex">
                        <input class="boton w-sm-100" type="submit" value="Enviar">
                    </div>
                </fieldset>
            </form>
        </section>
    </main>
    
    <footer class="footer">
        <p>Todos los derechos reservados. Sergio y Julio</p>
    </footer>
    <script src="js/despegable.js"></script>


</body>
</html>
