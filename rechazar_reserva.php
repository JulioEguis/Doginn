<?php
// Incluir el archivo de conexión a la base de datos
include('includes/conexion.php');

// Verificar si se ha enviado un formulario para rechazar la reserva
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reserva_id'])) {
    // Obtener el ID de la reserva a rechazar
    $reserva_id = $_POST['reserva_id'];

    // Actualizar el estado de la reserva a "Rechazada" en la base de datos
    $query_rechazar_reserva = "UPDATE reservas SET estado = 'Rechazada' WHERE id = $reserva_id";
    if ($conn->query($query_rechazar_reserva) === TRUE) {
        echo "La reserva ha sido rechazada exitosamente.";
    } else {
        echo "Error al rechazar la reserva: " . $conn->error;
    }
}

// Redirigir de vuelta a la página de gestión de reservas
header("Location: gestion_reservas.php");
exit();
?>