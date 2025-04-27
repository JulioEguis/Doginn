<?php
session_start();

// Verificamos si se ha enviado el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluimos el archivo de conexión a la base de datos
    include 'includes/conexion.php';
  
    // Obtenemos los datos del formulario
    $nombre = $_POST["nombre"];
    $primer_apellido = $_POST["primer_apellido"];
    $segundo_apellido = $_POST["segundo_apellido"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmar_password = $_POST["confirmar_password"];

    // Verificamos si las contraseñas coinciden
    if ($password !== $confirmar_password) {
        echo "<script>alert('Las contraseñas no coinciden. Por favor, verifica.'); window.history.back();</script>";
    } else {
        // Verificamos si el email ya existe en la base de datos
        $consulta_email_existente = "SELECT * FROM doginn.usuarios WHERE email = '$email'";
        $resultado_email_existente = mysqli_query($conn, $consulta_email_existente);

        if (mysqli_num_rows($resultado_email_existente) > 0) {
            echo "<script>alert('Este email ya existe. Introduce uno nuevo.'); window.history.back();</script>";
        } else {
            // Verificamos si el teléfono ya existe en la base de datos
            $consulta_telefono_existente = "SELECT * FROM doginn.usuarios WHERE telefono = '$telefono'";
            $resultado_telefono_existente = mysqli_query($conn, $consulta_telefono_existente);

            if (mysqli_num_rows($resultado_telefono_existente) > 0) {
                echo "<script>alert('Este teléfono ya existe. Introduce otro.'); window.history.back();</script>";
            } else {
                // Aplicamos hash a la contraseña
                $contrasena_hasheada = password_hash($password, PASSWORD_DEFAULT);

                // Consulta SQL para insertar el nuevo usuario en la base de datos
                $query = "INSERT INTO doginn.usuarios (nombre, primer_apellido, segundo_apellido, telefono, email, password) VALUES ('$nombre', '$primer_apellido', '$segundo_apellido', '$telefono', '$email', '$contrasena_hasheada')";

                $result = mysqli_query($conn, $query);

                if ($result) {
                    echo "<script>
                            alert('Te has registrado correctamente. Ahora debes iniciar sesión.');
                            window.location.href = 'login.php';
                          </script>";
                } else {
                    echo "<script>alert('Error en la consulta: " . mysqli_error($conn) . "'); window.history.back();</script>";
                }
            }
        }
    }

    // Cerramos la conexión a la base de datos
    mysqli_close($conn);
}
?>
