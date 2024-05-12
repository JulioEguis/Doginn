<?php
session_start();
// Destruye todas las variables de sesión.
session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasta Pronto</title>
    <link rel="stylesheet" href="css/despedida.css"> 
</head>
<body>
    <div class="despedida-container">
        <h1>¡Hasta pronto!</h1>
        <p>Has cerrado sesión correctamente. Gracias por usar DOGINN.</p>
        <a href="index_main.php">Volver a la página principal</a> 
    </div>
</body>
</html>
