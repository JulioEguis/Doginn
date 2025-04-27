<?php
session_start();
// Incluir el archivo de conexión a la base de datos
include('includes/conexion.php');

// Obtener el nombre de la guardería desde la sesión antes de destruirla
$guarderia_id = $_SESSION['id_guarderia'];

$query_nombre_guarderia = "SELECT nombre_guarderia FROM guarderias WHERE id_guarderia = ?";
$stmt = $conn->prepare($query_nombre_guarderia);
$stmt->bind_param("i", $guarderia_id);
$stmt->execute();
$stmt->bind_result($nombre_guarderia);
$stmt->fetch();
$stmt->close();

// Destruir todas las variables de sesión.
session_destroy();

// Redirigir a la página de despedida con el nombre de la guardería
header("Location: despedida.php?nombre_guarderia=" . urlencode($nombre_guarderia));
exit();
?>
