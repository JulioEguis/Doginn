<?php
include('includes/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_guarderia']) && isset($_POST['fechas']) && isset($_POST['disponibles']) && isset($_POST['precio'])) {
        $id_guarderia = $_POST['id_guarderia'];
        $fechas = json_decode($_POST['fechas'], true);
        $disponibles = json_decode($_POST['disponibles'], true);
        $precio_noche = $_POST['precio'];

        // Verificar los datos recibidos
        error_log("ID Guarderia: " . $id_guarderia);
        error_log("Fechas recibidas: " . print_r($fechas, true));
        error_log("Disponibles recibidos: " . print_r($disponibles, true));
        error_log("Precio por noche: " . $precio_noche);

        // Eliminar todas las fechas actuales de la guardería
        $query_delete_all = "DELETE FROM calendarios_disponibilidad WHERE id_guarderia = ?";
        $stmt_delete_all = $conexion->prepare($query_delete_all);
        $stmt_delete_all->bind_param("i", $id_guarderia);
        if ($stmt_delete_all->execute()) {
            error_log("Fechas actuales eliminadas para la guardería ID: " . $id_guarderia);
        } else {
            error_log("Error al eliminar fechas actuales: " . $stmt_delete_all->error);
        }
        $stmt_delete_all->close();

        // Preparar la consulta para insertar disponibilidad con precio
        $query_insert = "INSERT INTO calendarios_disponibilidad (id_guarderia, fecha, precio_noche) VALUES (?, ?, ?)";
        $stmt_insert = $conexion->prepare($query_insert);

        foreach ($fechas as $index => $fecha) {
            if ($disponibles[$index] === 'true') {
                $stmt_insert->bind_param("isd", $id_guarderia, $fecha, $precio_noche);
                if ($stmt_insert->execute()) {
                    error_log("Fecha insertada: " . $fecha);
                } else {
                    error_log("Error al insertar fecha: " . $fecha . " - " . $stmt_insert->error);
                }
            }
        }

        $stmt_insert->close();

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
