<?php
session_start();
// Incluir el archivo de conexión a la base de datos
include('includes/conexion.php');

// Obtener el nombre del usuario desde la sesión antes de destruirla
$usuario_id = $_SESSION['usuario_id'];

$query_nombre_usuario = "SELECT nombre FROM usuarios WHERE id = ?";
$stmt = $conexion->prepare($query_nombre_usuario);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$stmt->bind_result($nombre_usuario);
$stmt->fetch();
$stmt->close();

// Destruir todas las variables de sesión.
session_destroy();

// Redirigir a la página de despedida con el nombre del usuario
header("Location: despedida_usuario.php?nombre_usuario=" . urlencode($nombre_usuario));
exit();
?>
