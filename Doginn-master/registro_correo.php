<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro con Correo Electrónico</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/styleregistro_correo.css">
</head>
<body>
    <div class="container">
        <h2>Registro con Correo Electrónico</h2>
        <form action="procesar_registro_correo.php" method="POST" id="registroForm" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre_guarderia">Nombre de la Guardería</label>
                <input type="text" name="nombre_guarderia" id="nombre_guarderia" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" name="correo" id="correo" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" id="direccion" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="tel" name="telefono" id="telefono" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" name="password" id="contrasena" required minlength="8">
                <small>La contraseña debe tener al menos 8 caracteres.</small>
            </div>
            <div class="form-group">
                <label for="confirmar_contrasena">Confirmar Contraseña</label>
                <input type="password" name="confirmar_contrasena" id="confirmar_contrasena" required minlength="8">
            </div>
         
            <button type="submit" class="btn-continuar">Registrarse</button>

        </form>
    </div>
    

    <script>
        function togglePassword() {
            var x = document.getElementById("contrasena");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
</html>
