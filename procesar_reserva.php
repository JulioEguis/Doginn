<?php
include('includes/conexion.php');

// Iniciar sesión
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Variable para seguimiento de intentos
if (!isset($_SESSION['intentos'])) {
    $_SESSION['intentos'] = 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $fecha_inicio = $_POST['fecha_inicio'] ?? null;
    $fecha_fin = $_POST['fecha_fin'] ?? null;
    $nombre_perro = $_POST['nombre_perro'] ?? null;
    $raza_perro = $_POST['raza_perro'] ?? null;
    $edad_perro = $_POST['edad'] ?? null;
    $nombre_usuario = $_POST['nombre_usuario'] ?? null;
    $primer_apellido = $_POST['primer_apellido'] ?? null;
    $segundo_apellido = $_POST['segundo_apellido'] ?? null;
    $email_usuario = $_POST['email_usuario'] ?? null;
    $telefono_usuario = $_POST['telefono_usuario'] ?? null;
    $id_guarderia = $_POST['id_guarderia'] ?? null;

    // Verificar si los datos han sido recibidos correctamente
    error_log("Datos recibidos:");
    error_log("Fecha inicio: " . $fecha_inicio);
    error_log("Fecha fin: " . $fecha_fin);
    error_log("Nombre perro: " . $nombre_perro);
    error_log("Raza perro: " . $raza_perro);
    error_log("Edad perro: " . $edad_perro);
    error_log("Nombre usuario: " . $nombre_usuario);
    error_log("Primer apellido: " . $primer_apellido);
    error_log("Segundo apellido: " . $segundo_apellido);
    error_log("Email usuario: " . $email_usuario);
    error_log("Teléfono usuario: " . $telefono_usuario);
    error_log("ID guardería: " . $id_guarderia);

    // Verificar si se recibieron todos los datos necesarios
    if ($fecha_inicio && $fecha_fin && $nombre_perro && $raza_perro && $edad_perro && $nombre_usuario && $primer_apellido && $segundo_apellido && $email_usuario && $telefono_usuario && $id_guarderia) {
        // Consulta para obtener el ID del usuario basado en el correo electrónico
        $query_usuario = "SELECT * FROM usuarios WHERE email = ?";
        $stmt_usuario = $conn->prepare($query_usuario);
        $stmt_usuario->bind_param("s", $email_usuario);
        $stmt_usuario->execute();
        $resultado_usuario = $stmt_usuario->get_result();

        if ($resultado_usuario->num_rows > 0) {
            $usuario = $resultado_usuario->fetch_assoc();
            $id_usuario = $usuario['id'];

            // Verificar la información del usuario
            if (
                $usuario['nombre'] === $nombre_usuario &&
                $usuario['primer_apellido'] === $primer_apellido &&
                $usuario['segundo_apellido'] === $segundo_apellido &&
                $usuario['telefono'] == $telefono_usuario
            ) {
                error_log("Usuario verificado, ID: " . $id_usuario);

                // Establecer la variable de sesión para el usuario
                $_SESSION['id_usuario'] = $id_usuario;

                // Insertar un nuevo perro con los datos proporcionados
                $query_insertar_perro = "INSERT INTO perros (id_usuario, nombre_perro, raza_perro, edad) VALUES (?, ?, ?, ?)";
                $stmt_insertar_perro = $conn->prepare($query_insertar_perro);
                $stmt_insertar_perro->bind_param("issi", $id_usuario, $nombre_perro, $raza_perro, $edad_perro);
                if ($stmt_insertar_perro->execute()) {
                    $id_perro = $stmt_insertar_perro->insert_id;
                    error_log("Nuevo perro insertado, ID: " . $id_perro);
                } else {
                    error_log("Error al insertar perro: " . $stmt_insertar_perro->error);
                    echo "Error al procesar la reserva: " . $stmt_insertar_perro->error;
                    exit();
                }

                // Obtener el nombre de la guardería
                $query_guarderia = "SELECT nombre_guarderia FROM guarderias WHERE id_guarderia = ?";
                $stmt_guarderia = $conn->prepare($query_guarderia);
                $stmt_guarderia->bind_param("i", $id_guarderia);
                $stmt_guarderia->execute();
                $resultado_guarderia = $stmt_guarderia->get_result();
                $nombre_guarderia = $resultado_guarderia->fetch_assoc()['nombre_guarderia'];

                // Insertar la reserva
                $query_reserva = "INSERT INTO reservas (id_usuario, id_perro, nombre_guarderia, fecha_inicio, fecha_fin, raza_perro, nombre_perro, id_guarderia) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt_reserva = $conn->prepare($query_reserva);
                $stmt_reserva->bind_param("iisssssi", $id_usuario, $id_perro, $nombre_guarderia, $fecha_inicio, $fecha_fin, $raza_perro, $nombre_perro, $id_guarderia);

                if ($stmt_reserva->execute()) {
                    $id_reserva = $stmt_reserva->insert_id;
                    $_SESSION['id_reserva'] = $id_reserva; // Establecer la sesión de id_reserva

                    error_log("¡Ya casi has acabado!");
                    echo "<script>
                            alert('Ya casi has realizado la reserva, solo falta realizar el pago');
                            window.location.href = 'for_pag_secc_guar.php';
                          </script>";
                } else {
                    error_log("Error al realizar la reserva: " . $stmt_reserva->error);
                    echo "Error al realizar la reserva: " . $stmt_reserva->error;
                }
            } else {
                $_SESSION['intentos'] += 1;
                if ($_SESSION['intentos'] >= 2) {
                    echo "<script>
                            alert('Para realizar una reserva debes tener una cuenta en Doginn y haber iniciado sesión.');
                            if (confirm('¿Quieres registrarte o iniciar sesión?')) {
                                window.location.href = 'registro.php';
                            } else {
                                window.location.href = 'login.php';
                            }
                          </script>";
                    session_destroy();
                } else {
                    echo "<script>
                            alert('Los datos introducidos sobre el usuario no son correctos, por favor, verifica estos parámetros.');
                            window.history.back();
                          </script>";
                }
                exit();
            }
        } else {
            // Usuario no existe, mostrar mensaje y redirigir
            echo "<script>
                    alert('Para realizar una reserva debes tener una cuenta en Doginn y haber iniciado sesión.');
                    if (confirm('¿Quieres registrarte o iniciar sesión?')) {
                        window.location.href = 'registro.php';
                    } else {
                        window.location.href = 'login.php';
                    }
                  </script>";
            exit();
        }
    } else {
        error_log("Error: Faltan datos necesarios.");
        echo "<script>
                alert('Error: No se recibieron los datos esperados.');
                window.location.href = 'gestion_reserva.php';
              </script>";
    }
    $conn->close();
} else {
    error_log("Error: Método de solicitud no permitido.");
    echo "<script>
            alert('Error: Método de solicitud no permitido.');
            window.location.href = 'gestion_reserva.php';
          </script>";
}
?>
