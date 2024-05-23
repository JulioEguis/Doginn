<?php
// Incluye el archivo de conexión a la base de datos
include 'includes/conexion.php';

// Consulta SQL para obtener los datos de la tabla guarderias, incluyendo la imagen
$sql = "SELECT nombre_guarderia, direccion, telefono, imagen_url FROM guarderias";
$result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas de Guarderías</title>
    <link rel="stylesheet" href="css/imagenes_guarde.css">
   
</head>
<body>
    <h2>Reservas de Guarderías</h2>

  <div class="contenedor-guarderias">
        <?php
        // Verifica si hay resultados
        if ($result->num_rows > 0) {
            // Itera sobre los resultados y muestra cada guardería
            while ($row = $result->fetch_assoc()) {
                echo "<div class='guarderia'>";
                echo "<img src='".$row["imagen_url"]."' alt='Imagen de la guardería'>";
                echo "<h3>".$row["nombre_guarderia"]."</h3>";
                echo "<p>".$row["direccion"]."</p>";
                echo "<p>".$row["telefono"]."</p>";
                echo "</div>";
            }
        } else {
            echo "No se encontraron resultados.";
        }

        // Cierra la conexión
        $conexion->close();
        ?>
    </div>
</body>
</html>