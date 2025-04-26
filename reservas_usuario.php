<?php
include('includes/conexion.php');

// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

// Obtener las reservas del usuario desde la base de datos
$reservas = [];
$query = "SELECT r.fecha_inicio, r.fecha_fin, r.raza_perro, r.nombre_guarderia
          FROM reservas r 
          WHERE r.id_usuario = ?";
$stmt = $conexion->prepare($query);
if ($stmt) {
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    while ($fila = $resultado->fetch_assoc()) {
        $reservas[] = $fila;
    }
    $stmt->close();
} else {
    // Error en la preparación de la consulta
    error_log("Error en la preparación de la consulta: " . $conexion->error);
    echo "Error en la preparación de la consulta.";
    exit();
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reservas</title>
    <link rel="stylesheet" href="css/reservas_usuario.css">
    <link rel="icon" href="img/faviusuario.png" type="image/x-icon">
</head>
<body>
<body>
    <div class="logo-container">
        <img src="img/tenor.gif" alt="Logo de la guardería" class="logo">
    </div>
    <h2>Mis Reservas</h2>
    
    <div class="reservas-container">
        <?php if (empty($reservas)): ?>
            <p>No has realizado ninguna reserva.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Nombre de la Guardería</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        <th>Raza del Perro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservas as $reserva): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($reserva['nombre_guarderia']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['fecha_inicio']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['fecha_fin']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['raza_perro']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <div class="buttons-container">
        <a href="reservas.php" class="btn-volver">Volver a Guarderías</a>
        <a href="despedida.php" class="btn-cerrar-sesion">Cerrar Sesión</a>
    </div>
</body>
</html>
