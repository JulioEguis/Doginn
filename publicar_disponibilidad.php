<?php
include('includes/conexion.php');

// Iniciar sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_guarderia'])) {
    header("Location: login_guarderia.php");
    exit();
}

$guarderia_id = $_SESSION['id_guarderia'];

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
    <style>
        .titulo {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .btn-guardar {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .calendario td {
            padding: 5px;
        }
        .calendario .disponible {
            background-color: #4caf50;
            color: white;
        }
        .calendario .no-disponible {
            background-color: #f44336;
            color: white;
        }

        .btn-volver-apanel {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #4c6fb1;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<a href="dashboard1.php" class="btn-volver-apanel">Volver al panel</a>
    <div class="titulo">Calendario de Disponibilidad 2024</div>
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
                for ($i = 1; $i <= 31; $i++) {
                    echo "<tr>";
                    for ($j = 1; $j <= 12; $j++) {
                        $mes = str_pad($j, 2, '0', STR_PAD_LEFT);
                        $dia = str_pad($i, 2, '0', STR_PAD_LEFT);
                        $fecha = "2024-$mes-$dia";
                        $clase_disponible = in_array($fecha, $fechas_disponibles) ? 'disponible' : 'no-disponible';
                        $data_disponible = in_array($fecha, $fechas_disponibles) ? 'true' : 'false';
                        echo "<td>";
                        echo "<button type='button' class='dia $clase_disponible' data-fecha='$fecha' data-disponible='$data_disponible'>$i</button>";
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="leyenda">
            <span class="leyenda-disponible"></span> Disponible
            <span class="leyenda-no-disponible"></span> No Disponible
        </div>
        <button class="btn-guardar">Guardar Disponibilidad</button>
        <div id="mensaje" class="mensaje"></div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var botonesDia = document.querySelectorAll(".dia");

            botonesDia.forEach(function(btn) {
                btn.addEventListener("click", function() {
                    var disponible = (this.getAttribute("data-disponible") === "true");
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
                    fechas.push(btn.getAttribute("data-fecha"));
                    disponibles.push(btn.getAttribute("data-disponible"));
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
                inputFechas.value = JSON.stringify(fechas);
                form.appendChild(inputFechas);

                var inputDisponibles = document.createElement("input");
                inputDisponibles.type = "hidden";
                inputDisponibles.name = "disponibles";
                inputDisponibles.value = JSON.stringify(disponibles);
                form.appendChild(inputDisponibles);

                var inputGuarderia = document.createElement("input");
                inputGuarderia.type = "hidden";
                inputGuarderia.name = "id_guarderia";
                inputGuarderia.value = "<?php echo $guarderia_id; ?>";
                form.appendChild(inputGuarderia);

                document.body.appendChild(form);
                form.submit();
            });
        });
    </script>
</body>
</html>
