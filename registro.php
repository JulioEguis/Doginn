<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Configuración del documento HTML -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Enlace a la hoja de estilos CSS para la página de registro -->
    <link rel="stylesheet" href="css/registro.css"> 
    
</head>

<!-- Enlace para usuarios que ya tienen cuenta -->
<header class="encabezado-registro">
        <a class="cuenta">¿Ya tienes cuenta?</a>
        <!-- Botón que redirige a la página de inicio de sesión -->
        
        <a href="login.php">
            <button type="submit" class="login-link">Inicia sesión</button>
        </a>

</header>
<body>
        <!-- imagen logo -->

<a href="index_main.php"><img src="img/logo-removebg-preview.png" alt="Logo de Doginn" class="logo-registro"></a>
    <div class="container">

        <h1>Regístrate en DOGiNN</h1>
        <!-- Descripción del formulario -->
        <p>Introduce tus datos</p>
        <!-- Formulario de registro utilizando el método POST -->
        <form method="post" action="registro.php">
            <!-- Campos de entrada para nombre, apellidos, correo electrónico y contraseña -->
            <input type="nombre" name="nombre" id="nombre" placeholder="Nombre" required>
            <input type="primer_apellido" name="primer_apellido" id="primer_apellido" placeholder="Primer apellido" required>
            <input type="segundo_apellido" name="segundo_apellido" id="segundo_apellido" placeholder="Segundo apellido" required>
            <input type="telefono" name="telefono" id="telefono" placeholder="Teléfono" required>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <input type="password" name="password" id="password" placeholder="Contraseña" required>
            <input type="password" name="confirmar_password" id="confirmar_password" placeholder="Confirma tu contraseña" required>
            <!-- Botón para enviar el formulario -->
            <button type="submit">Continuar</button>
        </form>
        <a href="guarderia_registro.html" class="btn-registro-guarderia">Registro para Guarderías</a>

    </div>

    <?php
    // Incluye el archivo de procesamiento del registro
    include 'backend/registro_be.php';
    ?>
</body>
</html>
