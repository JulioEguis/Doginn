<?php
include('includes/conexion.php');

// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_guarderia'])) {
    header("Location: login_guarderia.php");
    exit();
}

$guarderia_id = $_SESSION['id_guarderia']; // Obtener el ID de la guardería de la sesión

// Recuperar las fechas disponibles desde la base de datos
$fechas_disponibles = [];
$query_fechas = "SELECT fecha FROM calendarios_disponibilidad WHERE id_guarderia = ?";
$stmt_fechas = $conexion->prepare($query_fechas);
$stmt_fechas->bind_param("i", $guarderia_id);
$stmt_fechas->execute();
$result_fechas = $stmt_fechas->get_result();
while ($row = $result_fechas->fetch_assoc()) {
    $fechas_disponibles[] = $row['fecha'];
}
$stmt_fechas->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicar Disponibilidad</title>
    <link rel="stylesheet" type="text/css" href="css/calendario.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
<a href="dashboard1.php" class="btn-volver-apanel">Volver al panel</a>
    <div class="calendario-container">
        <div class="titulo">Calendario de Disponibilidad 2024</div>
        <p class="explicacion">
            Primer paso: Selecciona la disponibilidad que tiene tu guardería durante el año 2024.<br>
            Los días que selecciones y cambien del color rojo al verde serán los días que aparecerá tu guardería como disponible en nuestra base de datos.
        </p>
        <table class="calendario">
            <thead>
                <tr>
                    <!-- Añadir checkboxes para seleccionar todo el mes -->
                    <th>Enero <input type="checkbox" class="seleccionar-mes" data-mes="01"></th>
                    <th>Febrero <input type="checkbox" class="seleccionar-mes" data-mes="02"></th>
                    <th>Marzo <input type="checkbox" class="seleccionar-mes" data-mes="03"></th>
                    <th>Abril <input type="checkbox" class="seleccionar-mes" data-mes="04"></th>
                    <th>Mayo <input type="checkbox" class="seleccionar-mes" data-mes="05"></th>
                    <th>Junio <input type="checkbox" class="seleccionar-mes" data-mes="06"></th>
                    <th>Julio <input type="checkbox" class="seleccionar-mes" data-mes="07"></th>
                    <th>Agosto <input type="checkbox" class="seleccionar-mes" data-mes="08"></th>
                    <th>Septiembre <input type="checkbox" class="seleccionar-mes" data-mes="09"></th>
                    <th>Octubre <input type="checkbox" class="seleccionar-mes" data-mes="10"></th>
                    <th>Noviembre <input type="checkbox" class="seleccionar-mes" data-mes="11"></th>
                    <th>Diciembre <input type="checkbox" class="seleccionar-mes" data-mes="12"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Crear filas para cada día del mes
                for ($i = 1; $i <= 31; $i++) {
                    echo "<tr>";
                    for ($j = 1; $j <= 12; $j++) {
                        $mes = str_pad($j, 2, '0', STR_PAD_LEFT); // Formatear el mes
                        $dia = str_pad($i, 2, '0', STR_PAD_LEFT); // Formatear el día
                        $fecha = "2024-$mes-$dia"; // Crear la fecha completa
                        $clase_disponible = in_array($fecha, $fechas_disponibles) ? 'disponible' : 'no-disponible'; // Asignar clase según disponibilidad
                        $data_disponible = in_array($fecha, $fechas_disponibles) ? 'true' : 'false'; // Asignar atributo data-disponible
                        echo "<td>";
                        if (checkdate($j, $i, 2024)) { // Verificar si la fecha es válida
                            echo "<button type='button' class='dia $clase_disponible' data-fecha='$fecha' data-disponible='$data_disponible'>$i</button>";
                        } else {
                            echo "-"; // Mostrar guion si la fecha no es válida (por ejemplo, 30 de febrero)
                        }
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="seleccionar-todo-ano-container">
            <!-- Checkbox para seleccionar todo el año -->
            <input type="checkbox" id="seleccionar-todo-ano"> Seleccionar todo el año
        </div>
        <div class="leyenda">
            <span class="leyenda-disponible"></span> Disponible
            <span class="leyenda-no-disponible"></span> No Disponible
        </div>
        <p class="explicacion">
            Segundo Paso: Elige el precio medio por noche que cuesta alojar a una mascota en tu guardería.<br>
            Este precio será el coste que pagará el usuario tras seleccionar tu guardería.
        </p>
        <div class="precio-noche">
            <label for="precio">Precio por noche:</label>
            <input type="number" id="precio" name="precio" min="0" step="0.1" required>
        </div>
        <button class="btn-guardar">Guardar Disponibilidad y Precio</button>
        <div id="mensaje" class="mensaje"></div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var botonesDia = document.querySelectorAll(".dia"); // Seleccionar todos los botones de día

            botonesDia.forEach(function(btn) {
                btn.addEventListener("click", function() {
                    var disponible = (this.getAttribute("data-disponible") === "true"); // Comprobar si el día es disponible
                    if (disponible) {
                        this.classList.remove("disponible");
                        this.classList.add("no-disponible");
                        this.setAttribute("data-disponible", "false");
                    } else {
                        this.classList.remove("no-disponible");
                        this.classList.add("disponible");
                        this.setAttribute("data-disponible", "true");
                    }
                });
            });

            document.querySelector('.btn-guardar').addEventListener('click', function() {
                var fechas = [];
                var disponibles = [];
                botonesDia.forEach(function(btn) {
                    fechas.push(btn.getAttribute("data-fecha")); // Obtener la fecha del día
                    disponibles.push(btn.getAttribute("data-disponible")); // Obtener la disponibilidad del día
                });

                // Log de datos para depuración
                console.log("Fechas:", fechas);
                console.log("Disponibles:", disponibles);

                // Enviar las fechas y su disponibilidad a procesar_disponibilidad.php
                var form = document.createElement("form");
                form.method = "POST";
                form.action = "procesar_disponibilidad.php";
                
                var inputFechas = document.createElement("input");
                inputFechas.type = "hidden";
                inputFechas.name = "fechas";
                inputFechas.value = JSON.stringify(fechas); // Convertir las fechas a JSON y añadirlas al formulario
                form.appendChild(inputFechas);

                var inputDisponibles = document.createElement("input");
                inputDisponibles.type = "hidden";
                inputDisponibles.name = "disponibles";
                inputDisponibles.value = JSON.stringify(disponibles); // Convertir las disponibilidades a JSON y añadirlas al formulario
                form.appendChild(inputDisponibles);

                var inputGuarderia = document.createElement("input");
                inputGuarderia.type = "hidden";
                inputGuarderia.name = "id_guarderia";
                inputGuarderia.value = "<?php echo $guarderia_id; ?>"; // Añadir el ID de la guardería al formulario
                form.appendChild(inputGuarderia);

                var inputPrecio = document.createElement("input");
                inputPrecio.type = "hidden";
                inputPrecio.name = "precio";
                inputPrecio.value = document.getElementById("precio").value; // Añadir el precio al formulario
                form.appendChild(inputPrecio);

                document.body.appendChild(form); // Añadir el formulario al cuerpo del documento
                form.submit(); // Enviar el formulario
            });

            // Seleccionar todo el mes
            var checkboxesMes = document.querySelectorAll('.seleccionar-mes');
            checkboxesMes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    var mes = this.getAttribute('data-mes'); // Obtener el mes del checkbox
                    botonesDia.forEach(function(btn) {
                        if (btn.getAttribute('data-fecha').substring(5, 7) === mes) { // Comprobar si el botón pertenece al mes
                            var disponible = checkbox.checked;
                            if (disponible) {
                                btn.classList.remove("no-disponible");
                                btn.classList.add("disponible");
                                btn.setAttribute("data-disponible", "true");
                            } else {
                                btn.classList.remove("disponible");
                                btn.classList.add("no-disponible");
                                btn.setAttribute("data-disponible", "false");
                            }
                        }
                    });
                });
            });

            // Seleccionar todo el año
            var checkboxAno = document.getElementById('seleccionar-todo-ano');
            checkboxAno.addEventListener('change', function() {
                var disponible = checkboxAno.checked;
                // Marcar o desmarcar todos los checkboxes de los meses
                checkboxesMes.forEach(function(checkbox) {
                    checkbox.checked = disponible;
                    checkbox.dispatchEvent(new Event('change')); // Disparar el evento 'change' para cada checkbox del mes
                });

                // Marcar o desmarcar todos los días del año
                botonesDia.forEach(function(btn) {
                    if (disponible) {
                        btn.classList.remove("no-disponible");
                        btn.classList.add("disponible");
                        btn.setAttribute("data-disponible", "true");
                    } else {
                        btn.classList.remove("disponible");
                        btn.classList.add("no-disponible");
                        btn.setAttribute("data-disponible", "false");
                    }
                });
            });
        });
    </script>
</body>
</html>
