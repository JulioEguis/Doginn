<?php
// Inicia la sesión de PHP para poder trabajar con variables de sesión
session_start();

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluye el archivo de conexión a la base de datos
    include 'includes/conexion.php';

    // Obtiene los datos del formulario
    $email = $_POST["email"];
    $contrasena = $_POST["password"];

    // Consulta SQL para obtener la contraseña hasheada
    $query = "SELECT * FROM doginn.usuarios WHERE email = '$email'";

    // Ejecuta la consulta
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Verifica si se encontró algún usuario con el correo proporcionado
        if (mysqli_num_rows($result) > 0) {
            // El usuario existe, obtiene sus datos
            $usuario = mysqli_fetch_assoc($result);

            // Verifica la contraseña hasheada
            if (password_verify($contrasena, $usuario['password'])) {
                // El usuario ha iniciado sesión correctamente
                // Almacena la información del usuario en la sesión
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];

                // Redirige al usuario a index_main.php
                header("Location: index_main.php");
                exit();
            } else {
                // Contraseña incorrecta
                $mensaje = "Contraseña incorrecta. ¿No estás registrado? <a href='registro.php'>Regístrate aquí</a>";
            }
        } else {
            // El usuario no está registrado
            $mensaje = "Usuario no registrado. ¿Quieres registrarte? <a href='registro.php'>Haz clic aquí</a>";
        }
    } else {
        // Error en la consulta
        $mensaje = "Error en la consulta: " . mysqli_error($conn);
    }

    // Cierra la conexión a la base de datos
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Configuración del documento HTML -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>

<header class="encabezado-grande">
    <!-- Texto "¿Eres nuevo?" -->
    <a href="#" class="nuevo">¿Eres nuevo?</a>
    <!-- Enlace que envuelve el botón "Regístrate" -->
    <a href="registro.php" class="register-link">
        <!-- Botón "Regístrate" -->
        <button type="submit">Resgístrate</button>
    </a>
</header>

<body class="body-inicio">
<a href="index_main.php"> <img src="img/logo-removebg-preview.png" alt="Logo" class="logo-inicio"> </a>
    <!-- Contenedor principal de la página -->
    <div class="container">
        <h1>Bienvenido a DOGiNN</h1>
        <p>Inicio de sesión</p>
        <?php
            if (isset($mensaje)) : 
        ?>
        <p>
            <?php
                echo $mensaje; 
            ?>
        </p>
        <?php endif; ?>
        <form method="post" action="login.php">
            <!-- Campos de entrada para el correo electrónico y la contraseña -->
            <input type="email" name="email" id="email" placeholder="Email" required>
            <input type="password" name="password" id="password" placeholder="Contraseña" required>
            <!-- Botón para enviar el formulario -->
            <button type="submit">Continuar</button>&nbsp;&nbsp;
            <!-- Enlace para restablecer la contraseña -->
            <a class="forgotpass" href="forgotpass.php">¿Olvidaste tu contraseña?</a>
        </form>
    </div>
</body>
</html>
