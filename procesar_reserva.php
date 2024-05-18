<?php
include('includes/conexion.php');

// Iniciar sesión
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $fecha_inicio = $_POST['fecha_inicio'] ?? null;
    $fecha_fin = $_POST['fecha_fin'] ?? null;
    $raza_perro = $_POST['raza_perro'] ?? null;
    $nombre_usuario = $_POST['nombre_usuario'] ?? null;
    $email_usuario = $_POST['email_usuario'] ?? null;
    $telefono_usuario = $_POST['telefono_usuario'] ?? null;
    $id_guarderia = $_POST['id_guarderia'] ?? null;

    // Verificar si los datos han sido recibidos correctamente
    error_log("Datos recibidos:");
    error_log("Fecha inicio: " . $fecha_inicio);
    error_log("Fecha fin: " . $fecha_fin);
    error_log("Raza perro: " . $raza_perro);
    error_log("Nombre usuario: " . $nombre_usuario);
    error_log("Email usuario: " . $email_usuario);
    error_log("Teléfono usuario: " . $telefono_usuario);
    error_log("ID guardería: " . $id_guarderia);

    // Verificar si se recibieron todos los datos necesarios
    if ($fecha_inicio && $fecha_fin && $raza_perro && $nombre_usuario && $email_usuario && $telefono_usuario && $id_guarderia) {
        // Consulta para obtener el ID del usuario basado en el correo electrónico
        $query_usuario = "SELECT id FROM usuarios WHERE email = ?";
        $stmt_usuario = $conexion->prepare($query_usuario);
        $stmt_usuario->bind_param("s", $email_usuario);
        $stmt_usuario->execute();
        $resultado_usuario = $stmt_usuario->get_result();

        if ($resultado_usuario->num_rows > 0) {
            $usuario = $resultado_usuario->fetch_assoc();
            $id_usuario = $usuario['id'];
            error_log("Usuario existente, ID: " . $id_usuario);
        } else {
            // Insertar un nuevo usuario si no existe
            $query_insertar_usuario = "INSERT INTO usuarios (nombre, email, telefono) VALUES (?, ?, ?)";
            $stmt_insertar_usuario = $conexion->prepare($query_insertar_usuario);
            $stmt_insertar_usuario->bind_param("sss", $nombre_usuario, $email_usuario, $telefono_usuario);
            if ($stmt_insertar_usuario->execute()) {
                $id_usuario = $stmt_insertar_usuario->insert_id;
                error_log("Nuevo usuario insertado, ID: " . $id_usuario);
            } else {
                error_log("Error al insertar usuario: " . $stmt_insertar_usuario->error);
                echo "Error al procesar la reserva: " . $stmt_insertar_usuario->error;
                exit();
            }
        }

        // Establecer la variable de sesión para el usuario
        $_SESSION['id_usuario'] = $id_usuario;

        // Insertar la reserva
        $query_reserva = "INSERT INTO reservas (id_usuario, id_perro, nombre_guarderia, fecha_inicio, fecha_fin, raza_perro) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_reserva = $conexion->prepare($query_reserva);
        $stmt_reserva->bind_param("iissss", $id_usuario, $id_guarderia, $id_guarderia, $fecha_inicio, $fecha_fin, $raza_perro);

        if ($stmt_reserva->execute()) {
            error_log("Reserva realizada con éxito para el usuario ID: " . $id_usuario);
            echo "<script>
                    alert('Reserva realizada con éxito.');
                    window.location.href = 'reservas_usuario.php';
                  </script>";
        } else {
            error_log("Error al realizar la reserva: " . $stmt_reserva->error);
            echo "Error al realizar la reserva: " . $stmt_reserva->error;
        }
    } else {
        error_log("Error: Faltan datos necesarios.");
        echo "<script>
                alert('Error: No se recibieron los datos esperados.');
                window.location.href = 'gestion_reserva.php';
              </script>";
    }
    $conexion->close();
} else {
    error_log("Error: Método de solicitud no permitido.");
    echo "<script>
            alert('Error: Método de solicitud no permitido.');
            window.location.href = 'gestion_reserva.php';
          </script>";
}
?>
