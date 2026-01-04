<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php?error=not_logged_in");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Proceso de Reserva</title>
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
    <h2>¡Ya casi has acabado!</h2>
    <p>El último paso es realizar el pago</p>

    <div class="btn-container">
        <form action="formulario_pago.php" method="post">
            <button type="submit" class="btn-opcion">Continuar</button>
        </form>
    </div>
</div>

</body>
</html>
