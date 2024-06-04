<?php
session_start();


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Reserva</title>
    <link rel="stylesheet" href="css/gestion_reserva.css">
    <link rel="icon" href="img/faviusuario.png" type="image/x-icon">
    <style>
        .btn-volver, .btn-opcion {
            background-color: #5986d9;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            display: inline-block;
            margin-top: 20px;
            margin-right: 10px;
        }

        .btn-volver:hover, .btn-opcion:hover {
            background-color: #476bb5;
        }

        .form-container {
            text-align: center;
            margin-top: 50px;
        }

        .logo {
            width: 150px;
            margin-bottom: 20px;
        }

        .btn-container {
            display: flex; 
            justify-content: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <img src="img/logo-removebg-preview.png" alt="Doginn Logo" class="logo">
    <h2>¡Reserva Confirmada!</h2>
    <p>Gracias por reservar con nosotros. Tu reserva se ha realizado correctamente.</p>
    <p>¿Deseas ver tus reservas?</p>
    <div class="btn-container">
        <a href="mis_reservas.php" class="btn-opcion">Sí</a>
        <a href="index_main.php" class="btn-opcion">No</a>
    </div>
    <a href="index_main.php" class="btn-volver">Volver al Inicio</a>
</div>

</body>
</html>
