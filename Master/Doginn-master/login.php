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
    $result = mysqli_query($conexion, $query);

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
        $mensaje = "Error en la consulta: " . mysqli_error($conexion);
    }

    // Cierra la conexión a la base de datos
    mysqli_close($conexion);
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
</head>
<body>
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
        
        <!-- Enlaces adicionales para usuarios nuevos -->
        <a class="nuevo">¿Eres nuevo?</a>
        <!-- Botón que redirige a la página de registro -->
        <a href="registro.php">
            <button type="submit" class="register-link">Resgístrate</button>
        </a>
    </div>
</body>
</html>
