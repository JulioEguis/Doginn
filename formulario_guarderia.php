<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro de Guardería en Doginn</title>
    <link rel="stylesheet" href="css/formulario_guarderia.css">
</head>
<body>
    <div class="container">
        <h2>Inicia sesión o regístrate</h2>
        <p>¡Te damos la bienvenida a Doginn!</p>
        <!-- <form action="#" method="POST"> -->
            <!-- <div class="form-group"> -->
                <!-- <label for="pais">País o región</label> -->
                <!-- <select name="pais" id="pais"> -->
                    <!-- <option value="+34">España (+34)</option> -->
                    <!-- Agrega más opciones de países si es necesario -->
                <!-- </select> -->
            <!-- </div> -->
            <!-- <div class="form-group"> -->
                <!-- <label for="telefono">Número de teléfono</label> -->
                <!-- <input type="tel" name="telefono" id="telefono" placeholder="+34 XXX XXX XXX" required> -->
                <!-- <small>Te llamaremos o enviaremos un SMS para confirmar tu número. Se aplican las tarifas estándar de mensajes y datos. <a href="#">Política de Privacidad</a></small> -->
            <!-- </div> -->
            <button type="submit" class="btn-continuar">Registrate</button>
        </form>
        <div class="alt-login">
            <p>o</p>
            <button class="btn-facebook">Registrate con Facebook</button>
            <button class="btn-google">Registrate con Google</button>
            <button class="btn-apple">Registrate con Apple</button>
            <!-- <button class="btn-email">Continúa con el correo electrónico</button> -->
            <button onclick="location.href='registro_correo.php'" class="btn-email">Registrate con el correo electrónico</button>
        </div>
    </div>
</body>
</html>