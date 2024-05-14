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

// Consultar las reservas de la guardería
$query_reservas = "SELECT * FROM reservas WHERE id_guarderia = $guarderia_id";
$resultado_reservas = $conexion->query($query_reservas);

// Cerrar la conexión a la base de datos
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Reservas - <?php echo $nombre_guarderia; ?></title>
    <link rel="stylesheet" type="text/css" href="css/gestionreservas.css">
</head>
<body>
<div class="container">
        <div class="logo-container">
            <img src="img/doginn_logo.png" alt="Logo de Doginn" class="logo">
        </div>
        <h2>Gestión de Reservas - <?php echo $nombre_guarderia; ?></h2>
        <div class="reservas">
            <?php if ($resultado_reservas->num_rows > 0): ?>
                <?php while ($reserva = $resultado_reservas->fetch_assoc()): ?>
                    <div class="reserva">
                        <p><strong>Nombre del Cliente:</strong> <?php echo $reserva['nombre_cliente']; ?></p>
                        <p><strong>Fecha de Reserva:</strong> <?php echo $reserva['fecha_reserva']; ?></p>
                        <p><strong>Estado:</strong> <?php echo $reserva['estado']; ?></p>
                        <!-- Agregar botones para anular, aceptar o rechazar la reserva -->
                        <div class="acciones">
                            <form action="anular_reserva.php" method="post">
                                <input type="hidden" name="reserva_id" value="<?php echo $reserva['id']; ?>">
                                <button type="submit" class="btn-anular">Anular</button>
                            </form>
                            <form action="aceptar_reserva.php" method="post">
                                <input type="hidden" name="reserva_id" value="<?php echo $reserva['id']; ?>">
                                <button type="submit" class="btn-aceptar">Aceptar</button>
                            </form>
                            <form action="rechazar_reserva.php" method="post">
                                <input type="hidden" name="reserva_id" value="<?php echo $reserva['id']; ?>">
                                <button type="submit" class="btn-rechazar">Rechazar</button>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No hay reservas disponibles.</p>
            <?php endif; ?>
        </div>
        <a href="dashboard1.php" class="btn-volver">Volver al Dashboard</a>
        <a href="logout.php" class="btn-cerrar-sesion">Cerrar Sesión</a>
    </div>
</body>
</html>
