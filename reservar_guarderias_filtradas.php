<?php
include('includes/conexion.php');
session_start();

// Validar la recepción de los datos necesarios
if (!isset($_POST['id_guarderia']) || !isset($_POST['nombre_guarderia']) || !isset($_SESSION['checkIn']) || !isset($_SESSION['checkOut'])) {
    die('Error: No se recibieron los datos esperados.');
}

$id_guarderia = $_POST['id_guarderia'];
$nombre_guarderia = $_POST['nombre_guarderia'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];

// Obtener las fechas de búsqueda y otros datos del buscador desde la sesión
$checkIn = $_SESSION['checkIn'];
$checkOut = $_SESSION['checkOut'];

// Guardar en la sesión la información de la reserva actual
$_SESSION['id_guarderia'] = $id_guarderia;
$_SESSION['nombre_guarderia'] = $nombre_guarderia;

// Consulta para obtener el precio por noche
$query_precio = "SELECT precio_noche FROM calendarios_disponibilidad WHERE id_guarderia = ? LIMIT 1";
$stmt_precio = $conn->prepare($query_precio);
$stmt_precio->bind_param("i", $id_guarderia);
$stmt_precio->execute();
$resultado_precio = $stmt_precio->get_result();
$precio = $resultado_precio->fetch_assoc()['precio_noche'];
$stmt_precio->close();
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
<br><br><br>
<a href="index_main.php" class="btn-volver">Volver a Inicio</a>
<div class="form-container">
    <img src="img/logo-removebg-preview.png" alt="Doginn Logo" class="logo">
    <h2><?php echo htmlspecialchars($nombre_guarderia); ?></h2>
    <p><strong>Ubicación: </strong><?php echo htmlspecialchars($direccion); ?></p>
    <p><strong>Teléfono: </strong><?php echo htmlspecialchars($telefono); ?></p>
    <p><strong>Precio por noche: </strong><?php echo htmlspecialchars($precio); ?> €</p>
    <br><br>
    <form action="procesar_reserva_guarderias_filtradas.php" method="post">
        <!-- Campos donde se muestra la fecha seleccionada en el buscador -->
        <a><b>Fechas de Reserva</b></a>
        <label for="checkIn">Fecha de entrada</label>
        <input type="date" id="checkIn" name="checkIn" value="<?php echo htmlspecialchars($checkIn); ?>" readonly>
        
        <label for="checkOut">Fecha de salida</label>
        <input type="date" id="checkOut" name="checkOut" value="<?php echo htmlspecialchars($checkOut); ?>" readonly>
        
        <!-- Campos de entrada de datos del usuario y del perro -->
        <a><b>Datos del Perro</b></a>
        <label for="nombre_perro"></label>
        <input type="text" id="nombre_perro" name="nombre_perro" placeholder="Nombre del Perro" required>

        <label for="raza_perro"></label>
        <input type="text" id="raza_perro" name="raza_perro" placeholder="Raza del Perro" required>

        <label for="edad"></label>
        <input type="number" id="edad" name="edad" placeholder="Edad del Perro" required>
        
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
        <input type="hidden" name="nombre_guarderia" value="<?php echo htmlspecialchars($nombre_guarderia); ?>">

        <!-- Botón para enviar el formulario -->
        <button type="submit" class="boton-enviar-reserva">Enviar Reserva</button>
    </form>
</div>

</body>
</html>
