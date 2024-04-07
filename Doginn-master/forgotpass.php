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
</head>
<body>
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
