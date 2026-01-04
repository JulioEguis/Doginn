<?php
include('includes/conexion.php');
session_start();

$id_guarderia = $_SESSION['id_guarderia'];
$id_reserva = $_GET['id_reserva'];

// Obtener los detalles de la factura
$query_factura = "
    SELECT 
        f.`id factura`, 
        f.total, 
        f.fecha, 
        f.nombre_guarderia,
        r.fecha_inicio,
        r.fecha_fin,
        r.nombre_perro
    FROM facturas f
    JOIN reservas r ON f.`id reserva` = r.id_reserva
    WHERE f.`id reserva` = ? AND r.id_guarderia = ?
";
$stmt_factura = $conexion->prepare($query_factura);
$stmt_factura->bind_param("ii", $id_reserva, $id_guarderia);
$stmt_factura->execute();
$resultado_factura = $stmt_factura->get_result();
$factura = $resultado_factura->fetch_assoc();

if (!$factura) {
    echo "<script>
            alert('Factura no encontrada.');
            window.location.href = 'mis_reservas.php';
          </script>";
    exit();
}

$stmt_factura->close();
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Facturas</title>
    <link rel="stylesheet" href="css/factura.css">
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
        }
        .info-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .info-table {
            margin: auto;
            width: 80%;
        }
        .info-table th, .info-table td {
            border: none;
            padding: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center;">Mis Facturas</h1>
        <div class="info-container">
            <table class="info-table">
                <tr>
                    <th>Guardería</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Nombre del Perro</th>
                </tr>
                <tr>
                    <td><?php echo htmlspecialchars($factura['nombre_guarderia']); ?></td>
                    <td><?php echo htmlspecialchars($factura['fecha_inicio']); ?></td>
                    <td><?php echo htmlspecialchars($factura['fecha_fin']); ?></td>
                    <td><?php echo htmlspecialchars($factura['nombre_perro']); ?></td>
                </tr>
            </table>
        </div>
        <table>
            <tr>
                <th>ID Factura</th>
                <th>Total</th>
                <th>Fecha</th>
            </tr>
            <tr>
                <td><?php echo htmlspecialchars($factura['id factura']); ?></td>
                <td><?php echo htmlspecialchars($factura['total']); ?> €</td>
                <td><?php echo htmlspecialchars($factura['fecha']); ?></td>
            </tr>
        </table>
        <div class="btn-container">
            <a href="mis_reservas_guarderias.php" class="btn">Volver a Mis Reservas</a>
            <a href="index_main.php" class="btn">Volver a la Página Principal</a>
        </div>
    </div>
</body>
</html>
