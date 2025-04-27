<?php
include 'includes/conexion.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Recoger los datos del formulario
    $nombre = $_POST['nombre_guarderia'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
 

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO guarderias (nombre_guarderia, direccion, telefono) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nombre, $direccion, $telefono);
    $stmt->execute();

    if($stmt->affected_rows > 0){
        echo "Guardería registrada con éxito.";
    } else {
        echo "Error al registrar la guardería: " . $conn->error;
    }
    $stmt->close();
}
$conn->close();
?>
