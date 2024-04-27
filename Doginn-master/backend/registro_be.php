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
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmar_password = $_POST["confirmar_password"];

    // Verificamos si las contraseñas coinciden
    if ($password !== $confirmar_password) {
        echo "Las contraseñas no coinciden. Por favor, verifica.";
        
    } else {
        // Verificamos si el email ya existe en la base de datos
        $consulta_email_existente = "SELECT * FROM doginn.usuarios WHERE email = '$email'";
        $resultado_email_existente = mysqli_query($conexion, $consulta_email_existente);

        if (mysqli_num_rows($resultado_email_existente) > 0) {
            echo "Este email ya existe. Introduce uno nuevo.";
            
        } else {
            // Aplicamos hash a la contraseña
            $contrasena_hasheada = password_hash($password, PASSWORD_DEFAULT);

            // Consulta SQL para insertar el nuevo usuario en la base de datos
            $query = "INSERT INTO doginn.usuarios (nombre, primer_apellido, segundo_apellido, email, password) VALUES ('$nombre', '$primer_apellido', '$segundo_apellido', '$email', '$contrasena_hasheada')";

            $result = mysqli_query($conexion, $query);

            if ($result) {
              
                echo "Registro exitoso";
            } else {
                echo "Error en la consulta: " . mysqli_error($conexion);
            }
        }
    }

    // Cerramos la conexión a la base de datos
    mysqli_close($conexion);
}
?>