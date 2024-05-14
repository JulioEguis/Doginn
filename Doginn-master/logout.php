<?php
session_start();
// Destruye todas las variables de sesión.
session_destroy();

// Redirigir a la página de despedida
header("Location: despedida.php");
exit(); // Asegúrate de salir del script después de la redirección
?>
