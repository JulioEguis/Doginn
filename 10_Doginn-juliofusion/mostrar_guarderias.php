<?php
include('includes/conexion.php');

session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Guarderías Disponibles</title>
    <link rel="stylesheet" href="css/header_mg.css">
    <link rel="stylesheet" href="css/footer_mg.css">
    <link rel="stylesheet" href="css/buscador_mg.css">
    <link rel="icon" href="img/faviusuario.png" type="image/x-icon">
</head>
<body>

<!-- Header -->
<header>
    <div class="container">
        <div class="logo">
            <a href="index_main.php">
                <img src="img/Blog/logo_sf.png" alt="Logo de Mi Empresa" class="logo-img">
            </a>
        </div>
        <nav>
            <ul>
                <li><a href="index_main.php">Home</a></li>
                <li><a href="reservas.php">Guarderías</a></li>
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
<br>

<!-- Barra de búsqueda -->
<div class="buscadorbody">
    <form id="searchForm" action="buscar_guarderias.php" method="post">
        <div class="buscadorinput-container">
            <label class="buscadorlabel" for="location">Ubicación:</label>
            <div class="buscadorinput-with-icon">
                <input class="buscadorinput" type="text" id="location" name="location" required>
                <img class="buscadorimg" src="img/logos buscador/ubicacion.png" alt="Icono de ubicación">
            </div>
        </div>
        
        <div class="buscadorinput-container">
            <label class="buscadorlabel" for="checkIn">Fecha de entrada:</label>
            <div class="buscadorinput-with-icon">
                <input class="buscadorinput" type="date" id="checkIn" name="checkIn">
                <img class="buscadorimg" src="img/logos buscador/calendario.jpg" alt="Icono de calendario">
            </div>
        </div>
        
        <div class="buscadorinput-container">
            <label class="buscadorlabel" for="checkOut">Fecha de salida:</label>
            <div class="buscadorinput-with-icon">
                <input class="buscadorinput" type="date" id="checkOut" name="checkOut">
                <img class="buscadorimg" src="img/logos buscador/calendario.jpg" alt="Icono de calendario">
            </div>
        </div>
        
        <div class="buscadorinput-container">
            <label class="buscadorlabel" for="numDogs">Número de perros:</label>
            <div class="buscadorinput-with-icon">
                <input class="buscadorinput" type="number" id="numDogs" name="numDogs" min="1" value="1" required>
                <img class="buscadorimg" src="img/logos buscador/Nperros.jpg" alt="Icono de perro">
            </div>
        </div>

        <button class="buscadorbutton" type="submit">Buscar</button>
    </form>
</div>

<!-- Guarderías mostradas tras usar el buscador -->
<div class="container">
    <h1 class="resultados-busqueda">Resultados de Búsqueda</h1>
    <?php
    // Verificar si hay un mensaje de error en la sesión
    if (!empty($_SESSION['message'])) {
        echo "<div class='no-results'>";
        echo "<p>" . htmlspecialchars($_SESSION['message']) . "</p>";
        echo "</div>";
        // Limpiar el mensaje después de mostrarlo
        unset($_SESSION['message']);
    }

    if (!empty($_SESSION['guarderias'])) {
        $guarderias_unicas = [];
        foreach ($_SESSION['guarderias'] as $guarderia) {
            if (!in_array($guarderia['id_guarderia'], array_column($guarderias_unicas, 'id_guarderia'))) {
                $guarderias_unicas[] = $guarderia;
            }
        }

        if (empty($guarderias_unicas)) {
            echo "<div class='no-results'>";
            echo "<p>No hay guarderías disponibles para las fechas seleccionadas.</p>";
            echo "</div>";
        } else {
            foreach ($guarderias_unicas as $guarderia) {
                echo "<div class='guarderia'>";
                echo "<div class='info' style='display: flex; align-items: center; justify-content: space-between;'>";
                echo "<div class='image' style='flex: 1; text-align: left;'>";
                echo "<img src='" . htmlspecialchars($guarderia['imagen_url']) . "' alt='Imagen de " . htmlspecialchars($guarderia['nombre_guarderia']) . "' class='imagen-guarderia'>";
                echo "</div>";
                echo "<div class='details' style='flex: 2; text-align: center;'>";
                echo "<h2>" . htmlspecialchars($guarderia['nombre_guarderia']) . "</h2>";
                echo "<p><img src='img/locationon.png' alt='Ubicación' class='icon'> " . htmlspecialchars($guarderia['direccion']) . "</p>";
                echo "<p><img src='img/call24.png' alt='Teléfono' class='icon'> " . htmlspecialchars($guarderia['telefono']) . "</p>";
                echo "<p><img src='img/euro24.png' alt='Precio' class='icon'> " . htmlspecialchars($guarderia['precio_noche']) . " €</p>";
                echo "</div>";
                echo "<div class='button' style='flex: 1; text-align: right;'>";
                echo "<form class='reservar-form' action='reservar_guarderias_filtradas.php' method='POST' onsubmit='return validateDates();'>";
                echo "<input type='hidden' name='id_guarderia' value='" . htmlspecialchars($guarderia['id_guarderia']) . "'>";
                echo "<input type='hidden' name='nombre_guarderia' value='" . htmlspecialchars($guarderia['nombre_guarderia']) . "'>";
                echo "<input type='hidden' name='direccion' value='" . htmlspecialchars($guarderia['direccion']) . "'>";
                echo "<input type='hidden' name='telefono' value='" . htmlspecialchars($guarderia['telefono']) . "'>";
                echo "<button type='submit' class='reservar-button'>Reservar</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        }
    } else {
        echo "<div class='no-results'>";
        echo "<p>No hay guarderías disponibles para las fechas seleccionadas.</p>";
        echo "</div>";
    }
    ?>
</div>

<!-- Botón de Volver -->
<div class="volver-container">
    <a href="index_main.php" class="volver-button">Volver</a>
</div>
<br><br><br><br><br><br>

<!-- Footer -->
<footer class="footer">
    <div class="footer-container">
        <div class="social-icons">
            <a href="https://www.instagram.com"><img src="img/RedesSociales/Instagram_logo_2016.svg.png" alt="Instagram"></a>
            <a href="https://x.com/DoginnES"><img src="img/RedesSociales/twitter-x.png" alt="Twitter"></a>
            <a href="https://www.facebook.com/profile.php?id=61560149064324"><img src="img/RedesSociales/2023_Facebook_icon.svg.png" alt="Facebook"></a>
        </div>
        <div class="footer-links">
            <a href="reservas.php">Guarderías</a>
            <a href="blog_index.php">Nosotros</a>
            <a href="login.php">Inicio Sesión</a>
            <a href="registro.php">Registrarse</a>
            <a href="guarderia_registro.html">Pon tu Guardería</a>
        </div>
    </div>
</footer>

<script>
    function validateDates() {
        const checkIn = "<?php echo isset($_SESSION['checkIn']) ? $_SESSION['checkIn'] : ''; ?>";
        const checkOut = "<?php echo isset($_SESSION['checkOut']) ? $_SESSION['checkOut'] : ''; ?>";

        if (!checkIn || !checkOut) {
            alert('Por favor, para continuar con la reserva seleccione las fechas de entrada y salida.');
            return false;
        }
        return true;
    }
</script>

</body>
</html>
