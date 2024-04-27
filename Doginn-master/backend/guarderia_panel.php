<?php
include 'includes/conexion.php';
session_start();

// Verifica si la guardería está logueada
if(!isset($_SESSION['id_guarderia'])){
    header('Location: login.php'); // Redirecciona al login si no está logueada
    exit;
}

// Obtener información de la guardería desde la base de datos
$id_guarderia = $_SESSION['id_guarderia'];
$sql = "SELECT * FROM guarderias WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_guarderia);
$stmt->execute();
$result = $stmt->get_result();
$guarderia = $result->fetch_assoc();


?>
