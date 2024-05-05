<?php
include 'includes/conexion.php';
session_start();

// Verifica si la guardería está logueada y si el método es POST
if(isset($_SESSION['id_guarderia']) && $_SERVER["REQUEST_METHOD"] == "POST"){
    // Recoger los datos del formulario de edición
    $nombre = $_POST['nombre_guarderia'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $id_guarderia = $_SESSION['id_guarderia'];

    // Actualizar los datos en la base de datos
    $sql = "UPDATE guarderias SET nombre = ?, direccion = ?, telefono = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssi", $nombre, $direccion, $telefono, $id_guarderia);
    $stmt->execute();

    if($stmt->affected_rows > 0){
        echo "Información de la guardería actualizada con éxito.";
    } else {
        echo "Error al actualizar la información: " . $conexion->error;
    }
    $stmt->close();
}
$conexion->close();
?>
