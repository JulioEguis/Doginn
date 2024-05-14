<?php
// Incluir el archivo de conexión a la base de datos
include('includes/conexion.php');

// Verificar si se ha enviado un formulario para anular la reserva
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reserva_id'])) {
    // Obtener el ID de la reserva a anular
    $reserva_id = $_POST['reserva_id'];

    // Actualizar el estado de la reserva a "Anulada" en la base de datos
    $query_anular_reserva = "UPDATE reservas SET estado = 'Anulada' WHERE id = $reserva_id";
    if ($conexion->query($query_anular_reserva) === TRUE) {
        echo "La reserva ha sido anulada exitosamente.";
    } else {
        echo "Error al anular la reserva: " . $conexion->error;
    }
}

// Redirigir de vuelta a la página de gestión de reservas
header("Location: gestionreservas.php");
exit();
?>
