<?php
include('includes/conexion.php');
session_start();

$usuario_id = $_SESSION['usuario_id'];
$id_reserva = $_SESSION['id_reserva'];
$total = $_SESSION['total'];

// Obtener la información de la reserva nuevamente para asegurar la consistencia
$query = "
    SELECT 
        r.fecha_inicio, 
        r.fecha_fin, 
        cd.precio_noche, 
        g.nombre_guarderia 
    FROM reservas r
    JOIN calendarios_disponibilidad cd ON r.id_guarderia = cd.id_guarderia
    JOIN guarderias g ON r.id_guarderia = g.id_guarderia
    WHERE r.id_reserva = ?
";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id_reserva);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $reserva = $result->fetch_assoc();
    $fecha_inicio = new DateTime($reserva['fecha_inicio']);
    $fecha_fin = new DateTime($reserva['fecha_fin']);
    $precio_noche = $reserva['precio_noche'];
    $nombre_guarderia = $reserva['nombre_guarderia'];

    $interval = $fecha_inicio->diff($fecha_fin);
    $noches = $interval->d;

    $total_reserva = $noches * $precio_noche;
    $gastos_gestion = $total_reserva * 0.15;
    $total = $total_reserva + $gastos_gestion;

    // Insertar la factura en la base de datos
    $insert_query = "
        INSERT INTO facturas (`id usuario`, `id reserva`, total, fecha, nombre_guarderia) 
        VALUES (?, ?, ?, NOW(), ?)
    ";
    $insert_stmt = $conn->prepare($insert_query);
    $insert_stmt->bind_param('iiis', $usuario_id, $id_reserva, $total, $nombre_guarderia);

    if ($insert_stmt->execute()) {
        // Redirigir al usuario a la página de confirmación
        header("Location: confirmacion_reserva_guarderias_filtradas.php");
        exit();
    } else {
        echo "Error al procesar el pago.";
    }

    $insert_stmt->close();
} else {
    die('Error: Reserva no encontrada.');
}

$stmt->close();
$conn->close();
?>
