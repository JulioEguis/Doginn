<?php
include('includes/conexion.php');
session_start();

if (!isset($_SESSION['usuario_id'])) {
    echo "<script>
            alert('Para hacer una reserva primero debes iniciar sesión.');
            window.location.href = 'login.php';
          </script>";
    exit();
}

$id_usuario = $_SESSION['usuario_id'];  // Usar el valor correcto de la sesión

// Validar la recepción de los datos del formulario
if (!isset($_POST['nombre_perro']) || !isset($_POST['raza_perro']) || !isset($_POST['edad']) ||
    !isset($_POST['nombre_usuario']) || !isset($_POST['primer_apellido']) || !isset($_POST['segundo_apellido']) ||
    !isset($_POST['email_usuario']) || !isset($_POST['telefono_usuario']) || !isset($_POST['id_guarderia']) ||
    !isset($_POST['checkIn']) || !isset($_POST['checkOut'])) {
    die('Error: No se recibieron los datos esperados.');
}

// Recoger los datos del formulario
$nombre_perro = $_POST['nombre_perro'];
$raza_perro = $_POST['raza_perro'];
$edad = $_POST['edad'];
$nombre_usuario = $_POST['nombre_usuario'];
$primer_apellido = $_POST['primer_apellido'];
$segundo_apellido = $_POST['segundo_apellido'];
$email_usuario = $_POST['email_usuario'];
$telefono_usuario = $_POST['telefono_usuario'];
$id_guarderia = $_POST['id_guarderia'];
$nombre_guarderia = $_POST['nombre_guarderia'];
$checkIn = $_POST['checkIn'];
$checkOut = $_POST['checkOut'];

// Verificar si los datos del usuario coinciden con los que hay en la base de datos
$query_verificar_usuario = "
SELECT COUNT(*) as count FROM usuarios
WHERE id = ? AND nombre = ? AND primer_apellido = ? AND segundo_apellido = ? AND email = ? AND telefono = ?
";
$stmt_verificar = $conexion->prepare($query_verificar_usuario);
$stmt_verificar->bind_param("issssi", $id_usuario, $nombre_usuario, $primer_apellido, $segundo_apellido, $email_usuario, $telefono_usuario);
$stmt_verificar->execute();
$result_verificar = $stmt_verificar->get_result();
$row_verificar = $result_verificar->fetch_assoc();

if ($row_verificar['count'] == 0) {
    die('Error: Los datos del usuario no coinciden con los registrados en el sistema. Por favor verifica los parámetros y asegúrate de introducir los datos correctos del usuario.');
}

// Insertar el perro en la tabla perros
$query_perro = "
INSERT INTO perros (id_usuario, nombre_perro, raza_perro, edad)
VALUES (?, ?, ?, ?)
";
$stmt_perro = $conexion->prepare($query_perro);
$stmt_perro->bind_param("isss", $id_usuario, $nombre_perro, $raza_perro, $edad);
$stmt_perro->execute();

// Obtener el id del perro insertado
$id_perro = $stmt_perro->insert_id;

// Insertar la reserva en la tabla reservas
$query_reserva = "
INSERT INTO reservas (id_usuario, id_perro, nombre_guarderia, fecha_inicio, fecha_fin, raza_perro, nombre_perro, id_guarderia)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)
";
$stmt_reserva = $conexion->prepare($query_reserva);
$stmt_reserva->bind_param("iisssssi", $id_usuario, $id_perro, $nombre_guarderia, $checkIn, $checkOut, $raza_perro, $nombre_perro, $id_guarderia);
$stmt_reserva->execute();

// Obtener el id de la reserva insertada
$id_reserva = $stmt_reserva->insert_id;

// Verificar si la reserva fue insertada correctamente
if ($id_reserva) {
    // Guardar en la sesión la información de la reserva actual
    $_SESSION['id_reserva'] = $id_reserva;
    // Redirigir a la siguiente página
    header("Location: pregunta_prepago.php");
    exit();
} else {
    die('Error: No se pudo crear la reserva.');
}

$stmt_reserva->close();
$stmt_perro->close();
$stmt_verificar->close();
$conexion->close();
?>
