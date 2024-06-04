<?php
include('includes/conexion.php');

$id_guarderia = $_GET['id_guarderia']; // Asegúrate de que 'id_guarderia' se pasa correctamente por URL

// Obtener el nombre, dirección, teléfono y precio por noche de la guardería
$nombre_guarderia = "";
$direccion = "";
$telefono = "";
$precio_noche = 0;

$query_guarderia = "SELECT nombre_guarderia, direccion, telefono FROM guarderias WHERE id_guarderia = ?";
$stmt_guarderia = $conexion->prepare($query_guarderia);
$stmt_guarderia->bind_param("i", $id_guarderia);
$stmt_guarderia->execute();
$resultado_guarderia = $stmt_guarderia->get_result();
if ($fila_guarderia = $resultado_guarderia->fetch_assoc()) {
    $nombre_guarderia = $fila_guarderia['nombre_guarderia'];
    $direccion = $fila_guarderia['direccion'];
    $telefono = $fila_guarderia['telefono'];
}
$stmt_guarderia->close();

$query_precio = "SELECT MIN(precio_noche) AS precio_noche FROM calendarios_disponibilidad WHERE id_guarderia = ?";
$stmt_precio = $conexion->prepare($query_precio);
$stmt_precio->bind_param("i", $id_guarderia);
$stmt_precio->execute();
$resultado_precio = $stmt_precio->get_result();
if ($fila_precio = $resultado_precio->fetch_assoc()) {
    $precio_noche = $fila_precio['precio_noche'];
}
$stmt_precio->close();

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
    <!-- Incluye jQuery y jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- CSS para estilos de fechas disponibles y no disponibles -->
    <style>
        .available {
            background-color: green !important;
            color: white !important;
        }
        .unavailable {
            background-color: red !important;
            color: white !important;
        }
        .today a {
            font-weight: bold !important;
            color: black !important;
        }
    </style>
</head>
<body>

<a href="index_main.php" class="btn-volver">Volver a Inicio</a>
<div class="form-container">
    <img src="img/logo-removebg-preview.png" alt="Doginn Logo" class="logo">
    <!-- Mostrar el nombre de la guardería aquí -->
    <h1><?php echo htmlspecialchars($nombre_guarderia); ?></h1><br>
    <p><strong>Ubicación: </strong><?php echo htmlspecialchars($direccion); ?></p>
    <p><strong>Precio por noche: </strong> <?php echo htmlspecialchars($precio_noche); ?> €</p>
    <p><strong>Teléfono: </strong> <?php echo htmlspecialchars($telefono); ?></p>
    <br><br>
    <form action="procesar_reserva.php" method="post">
        <!-- Campos de entrada de fecha -->
        <a><b>Selección de fechas</b></a>
        <label for="fecha_inicio"></label>
        <input type="text" id="fecha_inicio" name="fecha_inicio" placeholder="Fecha de Inicio" required>
        
        <label for="fecha_fin"></label>
        <input type="text" id="fecha_fin" name="fecha_fin" placeholder="Fecha de Salida" required>
        
        <!-- Campos de entrada de datos del usuario y del perro -->
        <a><b>Datos del Perro</b></a>
        <label for="nombre_perro"></label>
        <input type="text" id="nombre_perro" name="nombre_perro" placeholder="Nombre del Perro" required>

        <label for="raza_perro"></label>
        <input type="text" id="raza_perro" name="raza_perro" placeholder="Raza del Perro" required>

        <label for="edad"></label>
        <input type="text" id="edad" name="edad" placeholder="Edad del Perro" required>
        

        <a><b>Datos del Usuario</b></a>
        <label for="nombre_usuario"></label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" placeholder="Nombre" required>

        <label for="primer_apellido"></label>
        <input type="text" id="primer_apellido" name="primer_apellido" placeholder="Primer Apellido" required>

        <label for="segundo_apellido"></label>
        <input type="text" id="segundo_apellido" name="segundo_apellido" placeholder="Segundo Apellido" required>
        
        <label for="email_usuario"></label>
        <input type="email" id="email_usuario" name="email_usuario" placeholder="Correo Electrónico" required>
        
        <label for="telefono_usuario"></label>
        <input type="tel" id="telefono_usuario" name="telefono_usuario" placeholder="Teléfono" required>
        
        <!-- Campo oculto para enviar el ID de la guardería -->
        <input type="hidden" name="id_guarderia" value="<?php echo htmlspecialchars($id_guarderia); ?>">

        <!-- Botón para enviar el formulario -->
        <div class="btn-container">
            <button type="submit" class="btn">Enviar Reserva</button>
        </div>
    </form>
</div>

<!-- Script para manejar el Datepicker -->
<script>
    $(document).ready(function() {
        // Obtener las fechas disponibles desde PHP
        const fechasDisponibles = <?php echo json_encode($fechas_disponibles); ?>;
        const hoy = new Date();
        const hoyFormatted = formatDate(hoy);

        // Función para formatear las fechas en formato 'YYYY-MM-DD'
        function formatDate(date) {
            let d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) 
                month = '0' + month;
            if (day.length < 2) 
                day = '0' + day;

            return [year, month, day].join('-');
        }

        // Función para verificar si una fecha está disponible
        function isDateAvailable(date) {
            return fechasDisponibles.includes(formatDate(date));
        }

        // Función para resaltar las fechas en el Datepicker
        function highlightDates(date) {
            const formattedDate = formatDate(date);
            if (formattedDate === hoyFormatted) {
                if (isDateAvailable(date)) {
                    return [true, "available today", "Hoy"];
                } else {
                    return [false, "unavailable today", "Hoy no disponible"];
                }
            } else if (date < hoy) {
                return [false, "unavailable", "No disponible"];
            } else if (isDateAvailable(date)) {
                return [true, "available", "Disponible"];
            } else {
                return [false, "unavailable", "No disponible"];
            }
        }

        // Inicializar el Datepicker para el campo de fecha de inicio
        $("#fecha_inicio").datepicker({
            beforeShowDay: highlightDates,
            dateFormat: 'yy-mm-dd',
            minDate: 0
        });

        // Inicializar el Datepicker para el campo de fecha de fin
        $("#fecha_fin").datepicker({
            beforeShowDay: highlightDates,
            dateFormat: 'yy-mm-dd',
            minDate: 0
        });
    });
</script>

</body>
</html>
