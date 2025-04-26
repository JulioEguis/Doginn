<?php
// Iniciar sesión (reemplazar con el código de inicio de sesión real)
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Administración de Guardería</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <div class="container">
        <h2>Bienvenido al Dashboard</h2>
        <a href="gestion_reservas.php" class="btn-administracion">Administración de Reservas</a>
        <a href="subir_fotos.php" class="btn-administracion">Subir Fotos</a>
        <a href="cambiar_datos.php" class="btn-administracion">Cambiar Datos</a>
        <a href="publicar_disponibilidad.php" class="btn-administracion">Publicar Disponibilidad</a>
        <p>Bienvenido, <?php echo $_SESSION['nombre_guarderia']; ?></p> <!-- Mostrar el nombre de la guardería -->
    </div>
</body>
</html>
