<?php
// Incluir el archivo de conexión
include 'includes/conexion.php'; // Asegúrate de que esta ruta es correcta

// Comprobar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Asignar los valores enviados desde el formulario a variables
    $nombre = isset($_POST['nombre_guarderia']) ? trim($_POST['nombre_guarderia']) : null;
    $direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : null;
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : null;

    // Comprobar que los campos no estén vacíos
    if (empty($nombre) || empty($direccion) || empty($telefono)) {
        die("Por favor, completa todos los campos del formulario.");
    }

    // Preparar y vincular los parámetros a la sentencia SQL
    $sql = "INSERT INTO guarderias (nombre_guarderia, direccion, telefono) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (false === $stmt) {
        die('Error de preparación: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param('sss', $nombre, $direccion, $telefono);

    // Ejecutar la sentencia y comprobar si hubo errores
    if ($stmt->execute()) {
        echo "La guardería ha sido registrada exitosamente.";
    } else {
        echo "Error al registrar la guardería: " . htmlspecialchars($stmt->error);
    }

    // Cerrar sentencia y conexión
    $stmt->close();
    $conn->close();
} else {
    echo "Este script solo acepta solicitudes POST.";
}
?>


