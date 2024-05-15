<?php
// Incluir el archivo de conexión a la base de datos
include('includes/conexion.php');

// Iniciar sesión
session_start();

// Verificar si el usuario ya ha iniciado sesión
if (!isset($_SESSION['id_guarderia'])) {
    // Si no ha iniciado sesión, redirigir al formulario de inicio de sesión
    header("Location: login_guarderia.php");
    exit();
}

// Obtener el ID de la guardería desde la sesión
$guarderia_id = $_SESSION['id_guarderia'];

// Obtener información específica de la guardería desde la base de datos
$sql = "SELECT nombre_guarderia FROM guarderias WHERE id_guarderia = $guarderia_id";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $nombre_guarderia = $fila['nombre_guarderia'];
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Administración de Guardería</title>
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
</head>
<body>
    <div class="container">
    <img src="img/logo-removebg-preview.png" alt="Logo de la guardería" style="max-width: 20%; height: auto;">
        <h2>Bienvenida Guardería, <?php echo $nombre_guarderia; ?>!</h2>
        <p>Total de reservas: <?php echo $total_reservas; ?></p>
        <a href="gestion_reserva.php" class="btn-administracion">Gestión de Reservas</a>
        <a href="subir_fotos.php" class="btn-administracion">Subir Fotos</a>
        <a href="cambiar_datos.php" class="btn-administracion">Cambiar Datos</a>
        <a href="publicar_disponibilidad.php" class="btn-administracion">Publicar Disponibilidad</a>
        
    </div>
    <div class="btn-cerrar-sesion-container">
    <a href="logout.php" class="btn-cerrar-sesion">Cerrar Sesión</a>
</div>


</body>
</html>
