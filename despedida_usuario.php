<?php
session_start();
// Destruye todas las variables de sesión.
session_destroy();

// Obtener el nombre del usuario de los parámetros de URL
$nombre_usuario = isset($_GET['nombre_usuario']) ? htmlspecialchars($_GET['nombre_usuario']) : "usuario";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasta Pronto</title>
    <link rel="stylesheet" href="css/despedida.css"> 
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="despedida-container">
        <img src="img/despedida.png" alt="Logo de DOGINN" class="logo"> <!-- Añade la imagen aquí -->
        <h1>¡Hasta pronto, <?php echo $nombre_usuario; ?>!</h1>
        <p>Has cerrado sesión correctamente. Gracias por usar Doginn.</p>
        <a href="index_main.php" class="btn-volver">Volver a la página principal</a> 
    </div>
</body>
</html>
