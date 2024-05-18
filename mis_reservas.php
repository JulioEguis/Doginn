<?php
include('includes/conexion.php');

// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Iniciar sesión
session_start();

// Verificar si el usuario ya ha iniciado sesión
if (!isset($_SESSION['id_guarderia'])) {
    header("Location: login_guarderia.php");
    exit();
}

// Obtener el ID de la guardería desde la sesión
$guarderia_id = $_SESSION['id_guarderia'];

// Obtener las reservas confirmadas para la guardería
$reservas = [];
$query = "SELECT r.fecha_inicio, r.fecha_fin, r.raza_perro, u.nombre AS nombre_usuario, u.email
          FROM reservas r
          JOIN usuarios u ON r.id_usuario = u.id
          WHERE r.id_perro = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $guarderia_id);
$stmt->execute();
$resultado = $stmt->get_result();
while ($fila = $resultado->fetch_assoc()) {
    $reservas[] = $fila;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reservas</title>
    <link rel="stylesheet" href="css/mis_reservas.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="container">
    <img src="img/logo-removebg-preview.png" alt="Logo de la guardería" class="logo">
        <h2>Reservas Confirmadas</h2>
        <?php if (empty($reservas)): ?>
            <p>No hay reservas confirmadas.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Fecha de Inicio</th>
                        <th>Fecha de Fin</th>
                        <th>Raza del Perro</th>
                        <th>Nombre del Usuario</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservas as $reserva): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($reserva['fecha_inicio']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['fecha_fin']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['raza_perro']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['nombre_usuario']); ?></td>
                            <td><?php echo htmlspecialchars($reserva['email']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    <div class="btn-volver-container">
        <a href="dashboard1.php" class="btn-volver">Volver al Dashboard</a>
    </div>
</body>
</html>
