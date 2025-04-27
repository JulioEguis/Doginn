<?php
include 'includes/conexion.php';  // Conexión a la base de datos
session_start();

// Recoger los datos del formulario y sanitizarlos
$location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);
$checkIn = filter_input(INPUT_POST, 'checkIn', FILTER_SANITIZE_STRING);
$checkOut = filter_input(INPUT_POST, 'checkOut', FILTER_SANITIZE_STRING);
$numDogs = filter_input(INPUT_POST, 'numDogs', FILTER_SANITIZE_NUMBER_INT);

// Verifica que al menos se ha recibido la ubicación
if (!$location) {
    die('La ubicación es obligatoria.');
}

// Construir la consulta base
$query = "
SELECT g.id_guarderia, g.nombre_guarderia, g.direccion, g.telefono, ig.imagen_url, MIN(cd.precio_noche) AS precio_noche
FROM guarderias g
LEFT JOIN imagenes_guarderia ig ON g.id_guarderia = ig.id_guarderia
LEFT JOIN calendarios_disponibilidad cd ON g.id_guarderia = cd.id_guarderia
WHERE g.direccion LIKE CONCAT('%', ?, '%')
";

// Si se han recibido fechas de entrada y salida, añadir la condición de fechas
if ($checkIn && $checkOut) {
    $query .= " AND g.id_guarderia IN (
        SELECT cd_inner.id_guarderia
        FROM calendarios_disponibilidad cd_inner
        WHERE (STR_TO_DATE(?, '%Y-%m-%d') <= cd_inner.fecha AND STR_TO_DATE(?, '%Y-%m-%d') >= cd_inner.fecha)
    )";
}

// Añadir la cláusula GROUP BY al final
$query .= " GROUP BY g.id_guarderia, g.nombre_guarderia, g.direccion, g.telefono, ig.imagen_url";

// Preparar la consulta SQL
$stmt = $conn->prepare($query);
if (!$stmt) {
    die('Error de preparación de la consulta: ' . $conn->error);
}

// Vincular parámetros según los casos
if ($checkIn && $checkOut) {
    $stmt->bind_param("sss", $location, $checkIn, $checkOut);
} else {
    $stmt->bind_param("s", $location);
}

// Ejecutar la consulta
$stmt->execute();
$result = $stmt->get_result();
if (!$result) {
    die('Error al obtener los resultados: ' . $stmt->error);
}

// Verificar y recoger los resultados
$guarderias = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $guarderias[] = $row;
    }
} else {
    // Si no hay resultados, también puedes guardar un mensaje de error
    $_SESSION['message'] = 'No hay guarderías disponibles para las fechas y ubicación seleccionadas.';
}

// Guardar los resultados en la sesión y redirigir a mostrar_guarderias.php
$_SESSION['guarderias'] = $guarderias;
$_SESSION['checkIn'] = $checkIn;  // Guardar fecha de entrada en la sesión
$_SESSION['checkOut'] = $checkOut;  // Guardar fecha de salida en la sesión
header("Location: mostrar_guarderias.php");
exit;
?>
