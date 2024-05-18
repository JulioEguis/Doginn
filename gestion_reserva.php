<?php
include('includes/conexion.php');

$id_guarderia = $_GET['id_guarderia']; // Asegúrate de que 'id_guarderia' se pasa correctamente por URL

// Obtener las fechas disponibles
$fechas_disponibles = [];
$query = "SELECT fecha FROM calendarios_disponibilidad WHERE id_guarderia = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id_guarderia);
$stmt->execute();
$resultado = $stmt->get_result();
while ($fila = $resultado->fetch_assoc()) {
    $fechas_disponibles[] = $fila['fecha'];
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Guardería</title>
    <link rel="stylesheet" href="css/gestion_reserva.css">
    <link rel="icon" href="img/faviusuario.png" type="image/x-icon">
</head>
<body>

<a href="index_main.php" class="btn-volver">Volver a Inicio</a>
<div class="form-container">

        <img src="img/logo-removebg-preview.png" alt="Doginn Logo" class="logo">
        
    <h2>Reserva de Guardería</h2>
    <form action="procesar_reserva.php" method="post">
        <label for="fecha_inicio">Fecha de Inicio:</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" required>
        
        <label for="fecha_fin">Fecha de Fin:</label>
        <input type="date" id="fecha_fin" name="fecha_fin" required>
        
        <label for="raza_perro">Raza del Perro:</label>
        <input type="text" id="raza_perro" name="raza_perro" required>
        
        <label for="nombre_usuario">Tu Nombre:</label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" required>
        
        <label for="email_usuario">Correo Electrónico:</label>
        <input type="email" id="email_usuario" name="email_usuario" required>
        
        <label for="telefono_usuario">Número de Teléfono:</label>
        <input type="tel" id="telefono_usuario" name="telefono_usuario" required>
        
        <input type="hidden" name="id_guarderia" value="<?php echo htmlspecialchars($id_guarderia); ?>">

        <button type="submit">Enviar Reserva</button>
    </form>
 

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fechasDisponibles = <?php echo json_encode($fechas_disponibles); ?>;
            const fechaInicioInput = document.getElementById('fecha_inicio');
            const fechaFinInput = document.getElementById('fecha_fin');

            fechaInicioInput.addEventListener('input', function() {
                const fechaSeleccionada = fechaInicioInput.value;
                if (!fechasDisponibles.includes(fechaSeleccionada)) {
                    alert('La fecha de inicio seleccionada no está disponible.');
                    fechaInicioInput.value = '';
                }
            });

            fechaFinInput.addEventListener('input', function() {
                const fechaSeleccionada = fechaFinInput.value;
                if (!fechasDisponibles.includes(fechaSeleccionada)) {
                    alert('La fecha de fin seleccionada no está disponible.');
                    fechaFinInput.value = '';
                }
            });
        });
    </script>
</body>
</html>
