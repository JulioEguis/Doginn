<?php
// Incluir el archivo de conexión a la base de datos
include('includes/conexion.php');

// Verificar si se ha enviado un formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $correo_electronico = $_POST['correo_electronico'];
    $password = $_POST['password'];

    // Consultar la base de datos para verificar las credenciales
    $query = "SELECT id_guarderia, password FROM guarderias WHERE correo_electronico = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $correo_electronico);
    $stmt->execute();
    $stmt->store_result();

    // Verificar si se encontró una guardería con el correo electrónico proporcionado
    if ($stmt->num_rows > 0) {
        // Enlazar el resultado de la consulta
        $stmt->bind_result($id_guarderia, $hashed_password);
        $stmt->fetch();
        
        // Verificar si la contraseña ingresada coincide con la contraseña hasheada en la base de datos
        if (password_verify($password, $hashed_password)) {
            // Iniciar sesión y redirigir al dashboard
            session_start();
            $_SESSION['id_guarderia'] = $id_guarderia;
            header("Location: dashboard1.php");
            exit();
        } else {
            // Mostrar mensaje de error si las credenciales son incorrectas
            $error = "Correo electrónico o contraseña incorrectos.";
        }
    } else {
        // Mostrar mensaje de error si no se encuentra un usuario con el correo electrónico proporcionado
        $error = "Correo electrónico o contraseña incorrectos.";
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicia Sesión en tu Guardería</title>
    <link rel="stylesheet" href="css/login_guarderia.css"> 
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
<a href="index_main.php" class="btn-cerrar-sesion">Inicio</a>

<div class="container">
        <img src="img/logo-removebg-preview.png" alt="Logo de la guardería" class="logo">
        <h2>Iniciar Sesión - Guardería</h2>
        <form action="login_guarderia.php" method="POST">
            <div class="form-group">
                <label for="correo">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo_electronico" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn-login">Iniciar Sesión</button>
        </form>
        <?php if(isset($error)) { ?>
            <p><?php echo $error; ?></p>
        <?php } ?>
    </div>
</body>
</html>
