<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Establece el juego de caracteres UTF-8 para admitir caracteres especiales -->
    <meta charset="UTF-8">
    <!-- Configura la vista del contenido para dispositivos móviles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Establece el título de la página -->
    <title>Restablece tu contraseña</title>
    <!-- Enlaza a un archivo CSS específico para la página de restablecimiento de contraseña -->
    <link rel="stylesheet" href="css/forgotpass.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

</head>

<!-- Enlace para usuarios que ya tienen cuenta -->
<header class="encabezado-forgot">
        <a class="cuenta">¿Ya tienes cuenta?</a>
        <!-- Botón que redirige a la página de inicio de sesión -->
        
        <a href="login.php">
            <button type="submit" class="login-link">Inicia sesión</button>
        </a>

</header>

<body>
    <!-- imagen logo -->

<a href="index_main.php"><img src="img/logo-removebg-preview.png" alt="Logo de Doginn" class="logo-forgot"></a>
    <!-- Contenedor principal de la página -->
    <div class="container">
        <!-- Encabezado principal de la página -->
        <h1>Restablece tu contraseña</h1>
        <!-- Descripción del propósito de la página -->
        <p>Introduce tu correo electrónico para recuperar tu cuenta</p>
        <!-- Formulario para ingresar la dirección de correo electrónico -->
        <form>
            <!-- Campo de entrada para el correo electrónico, marcado como obligatorio -->
            <input type="email" name="email" id="email" placeholder="Email" required>
            <!-- Información adicional para el usuario -->
            <p>Enviaremos un enlace de recuperación a tu correo electrónico</p>
            <!-- Botón de envío del formulario -->
            <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>
