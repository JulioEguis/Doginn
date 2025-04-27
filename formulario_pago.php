<?php
include('includes/conexion.php');
session_start();

if (!isset($_SESSION['id_reserva'])) {
    die('Error: No hay reserva activa.');
}

$id_reserva = $_SESSION['id_reserva'];

// Obtener la información de la reserva
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

    // Guardar el total en la sesión para usar en el procesamiento del pago
    $_SESSION['total'] = $total;
} else {
    die('Error: Reserva no encontrada.');
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Métodos de pago</title>
    <link rel="stylesheet" href="css/formulario_pago.css">
</head>
<body>
    <div class="logo-container">
        <img src="img/logo-removebg-preview.png" alt="Doginn Logo" class="logo">
    </div>
    
    <div class="container">
        <div class="payment-method">
            <h2>Métodos de pago</h2>
            <div class="card-payment">
                <h3>Tarjeta de crédito</h3>
                <form action="procesar_pago.php" method="post">
                    <label for="card-number">Número de tarjeta</label>
                    <input type="text" id="card-number" name="card-number" placeholder="1234 5678 9012 3456" required>
                    <br>

                    <div class="card-details">
                        <div class="expiry-date">
                            <label for="expiry-date">Fecha de expiración</label>
                            <input type="text" id="expiry-date" name="expiry-date" placeholder="MM/AA" required>
                        </div>
                        <div class="cvv">
                            <label for="cvv">CVC / CVV</label>
                            <input type="text" id="cvv" name="cvv" placeholder="3 dígitos" required>
                        </div>
                    </div>
                    <button type="submit">Pagar ahora</button>
                </form>
            </div>
        </div>
        <div class="order-summary">
            <h2>Resumen del pedido</h2>
            <p>Total Reserva: <span><?php echo number_format($total_reserva, 2); ?> €</span></p>
            <p>Gastos de Gestión: <span><?php echo number_format($gastos_gestion, 2); ?> €</span></p>
            <hr>
            <p>Total: <span><?php echo number_format($total, 2); ?> €</span></p>
            <p>IVA incluido</p>
        </div>
    </div>
</body>
</html>
