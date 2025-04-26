<?php
include('includes/conexion.php');
session_start();



$id_usuario = $_SESSION['usuario_id'];

// Obtener reservas del usuario
$query_reservas = "
    SELECT 
        reservas.id_reserva, 
        usuarios.nombre, 
        usuarios.primer_apellido, 
        usuarios.segundo_apellido, 
        reservas.nombre_guarderia, 
        reservas.fecha_inicio, 
        reservas.fecha_fin, 
        reservas.nombre_perro, 
        reservas.raza_perro 
    FROM reservas 
    JOIN usuarios ON reservas.id_usuario = usuarios.id 
    WHERE reservas.id_usuario = ?
";
$stmt_reservas = $conexion->prepare($query_reservas);
$stmt_reservas->bind_param("i", $id_usuario);
$stmt_reservas->execute();
$resultado_reservas = $stmt_reservas->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reservas</title>
    <link rel="stylesheet" href="css/mis_reservas.css">
    <link rel="icon" href="img/faviusuario.png" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            background-color: #007BFF;
            color: #fff;
            text-align: center;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center;">Mis Reservas</h1>
        <?php if ($resultado_reservas->num_rows > 0): ?>
            <table>
                <tr>
                    <th>ID Reserva</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Guardería</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Nombre del Perro</th>
                    <th>Raza del Perro</th>
                    <th>Acciones</th>
                </tr>
                <?php while ($reserva = $resultado_reservas->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($reserva['id_reserva']); ?></td>
                        <td><?php echo htmlspecialchars($reserva['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($reserva['primer_apellido'] . ' ' . $reserva['segundo_apellido']); ?></td>
                        <td><?php echo htmlspecialchars($reserva['nombre_guarderia']); ?></td>
                        <td><?php echo htmlspecialchars($reserva['fecha_inicio']); ?></td>
                        <td><?php echo htmlspecialchars($reserva['fecha_fin']); ?></td>
                        <td><?php echo htmlspecialchars($reserva['nombre_perro']); ?></td>
                        <td><?php echo htmlspecialchars($reserva['raza_perro']); ?></td>
                        <td><a href="mis_facturas.php?id_reserva=<?php echo $reserva['id_reserva']; ?>">Ver factura</a></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p style="text-align: center;">No tienes reservas realizadas.</p>
        <?php endif; ?>
        <div class="btn-container">
            <a href="index_main.php" class="btn">Volver al Inicio</a>
        </div>
    </div>
</body>
</html>
