<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicar Disponibilidad</title>
    <link rel="stylesheet" type="text/css" href="css/calendario.css">
    <style>
        .titulo {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="titulo">Calendario de Disponibilidad</div>
    <div class="calendario-container">
        <table class="calendario">
            <thead>
                <tr>
                    <th>Enero</th>
                    <th>Febrero</th>
                    <th>Marzo</th>
                    <th>Abril</th>
                    <th>Mayo</th>
                    <th>Junio</th>
                    <th>Julio</th>
                    <th>Agosto</th>
                    <th>Septiembre</th>
                    <th>Octubre</th>
                    <th>Noviembre</th>
                    <th>Diciembre</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Generar los días del año
                for ($i = 1; $i <= 31; $i++) {
                    echo "<tr>";
                    for ($j = 1; $j <= 12; $j++) {
                        echo "<td>";
                        // Botón para seleccionar el día
                        echo "<button class='dia disponible' data-mes='$j' data-dia='$i' data-disponible='true'>$i</button>";
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Leyenda -->
        <div class="leyenda">
            <span class="leyenda-disponible"></span> Disponible
            <span class="leyenda-no-disponible"></span> Reservado
        </div>
    </div>

    <script>
     document.addEventListener("DOMContentLoaded", function() {
    // Obtener todos los botones de días del calendario
    var botonesDia = document.querySelectorAll(".dia");

    // Iterar sobre cada botón de día
    botonesDia.forEach(function(btn) {

        // Agregar un evento de clic a cada botón
        btn.addEventListener("click", function() {
            // Obtener el estado de disponibilidad actual del día
            var disponible = (this.getAttribute("data-disponible") === "true");

            // Cambiar el estado de disponibilidad del día
            if (disponible) { // Si está disponible, cambiar a no disponible
                this.classList.remove("disponible");
                this.classList.add("no-disponible");
                this.setAttribute("data-disponible", "false");
                // Aquí puedes enviar la información de disponibilidad al servidor utilizando AJAX
            } else { // Si no está disponible, cambiar a disponible
                this.classList.remove("no-disponible");
                this.classList.add("disponible");
                this.setAttribute("data-disponible", "true");
                // Aquí puedes enviar la información de disponibilidad al servidor utilizando AJAX
            }
        });
    });
});




    </script>
</body>
</html>
