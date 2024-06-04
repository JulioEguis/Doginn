<?php
// Incluir el archivo de conexión a la base de datos
include('includes/conexion.php');

// Verificar si se ha enviado un formulario para aceptar la reserva
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reserva_id'])) {
    // Obtener el ID de la reserva a aceptar
    $reserva_id = $_POST['reserva_id'];

    // Actualizar el estado de la reserva a "Aceptada" en la base de datos
    $query_aceptar_reserva = "UPDATE reservas SET estado = 'Aceptada' WHERE id = $reserva_id";
    if ($conexion->query($query_aceptar_reserva) === TRUE) {
        echo "La reserva ha sido aceptada exitosamente.";
    } else {
        echo "Error al aceptar la reserva: " . $conexion->error;
    }
}

// Redirigir de vuelta a la página de gestión de reservas
header("Location: gestion_reserva.php");
exit();
?>