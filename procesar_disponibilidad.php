<?php
include('includes/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_guarderia']) && isset($_POST['fechas']) && isset($_POST['disponibles'])) {
        $id_guarderia = $_POST['id_guarderia'];
        $fechas = json_decode($_POST['fechas'], true);
        $disponibles = json_decode($_POST['disponibles'], true);

        // Verificar los datos recibidos
        error_log("ID Guarderia: " . $id_guarderia);
        error_log("Fechas recibidas: " . print_r($fechas, true));
        error_log("Disponibles recibidos: " . print_r($disponibles, true));

        // Preparar la consulta para insertar disponibilidad
        $query_insert = "INSERT INTO calendarios_disponibilidad (id_guarderia, fecha) VALUES (?, ?) ON DUPLICATE KEY UPDATE fecha = VALUES(fecha)";
        $stmt_insert = $conexion->prepare($query_insert);

        // Preparar la consulta para eliminar disponibilidad
        $query_delete = "DELETE FROM calendarios_disponibilidad WHERE id_guarderia = ? AND fecha = ?";
        $stmt_delete = $conexion->prepare($query_delete);

        foreach ($fechas as $index => $fecha) {
            if ($disponibles[$index] === 'true') {
                $stmt_insert->bind_param("is", $id_guarderia, $fecha);
                if ($stmt_insert->execute()) {
                    error_log("Fecha insertada: " . $fecha);
                } else {
                    error_log("Error al insertar fecha: " . $fecha . " - " . $stmt_insert->error);
                }
            } else {
                $stmt_delete->bind_param("is", $id_guarderia, $fecha);
                if ($stmt_delete->execute()) {
                    error_log("Fecha eliminada: " . $fecha);
                } else {
                    error_log("Error al eliminar fecha: " . $fecha . " - " . $stmt_delete->error);
                }
            }
        }

        echo "<script>
                alert('Disponibilidad actualizada correctamente.');
                window.location.href = 'publicar_disponibilidad.php';
              </script>";
        $conexion->close();
        exit();
    } else {
        error_log("Error: No se recibieron los datos esperados.");
        echo "<script>
                alert('Error: No se recibieron los datos esperados.');
                window.location.href = 'publicar_disponibilidad.php';
              </script>";
        exit();
    }
} else {
    echo "Método no permitido.";
    exit();
}
?>
