//Sandoval Ramírez Marco Julian
//Vasquez Salinas Alitzel Aimee
//Practica 1 2do Parcial PW

<?php
    // Lista de alumnos (debe coincidir con Calificaciones.php)
    $alumnos = ["Jennie","Angelo","Lisa","Elio","Jisoo","Massimo","Isabel","Pierre","Rose","Riccardo"];
    
    // Recopilar calificaciones
    $calificacionesAlumnos = [];
    $alumnosNP = [];
    $calificacionesNumericas = [];
    
    foreach($alumnos as $alumno) {
        $nombreCampo = "cbo" . $alumno;
        if(isset($_POST[$nombreCampo])) {
            $calif = $_POST[$nombreCampo];
            $calificacionesAlumnos[$alumno] = $calif;
            
            if($calif == "NP") {
                $alumnosNP[] = $alumno;
            } else {
                $calificacionesNumericas[$alumno] = floatval($calif);
            }
        }
    }
    
    // Cálculos estadísticos
    $totalAlumnos = count($alumnos);
    $alumnosConNP = count($alumnosNP);
    $alumnosEvaluados = count($calificacionesNumericas);
    
    // Aprovechamiento general (promedio)
    $aprovechamientoGeneral = 0;
    if($alumnosEvaluados > 0) {
        $aprovechamientoGeneral = array_sum($calificacionesNumericas) / $alumnosEvaluados;
    }
    
    // Aprobados y Reprobados (calificación >= 6 es aprobado)
    $aprobados = 0;
    $reprobados = 0;
    foreach($calificacionesNumericas as $calif) {
        if($calif >= 6) {
            $aprobados++;
        } else {
            $reprobados++;
        }
    }
    
    // Porcentajes
    $porcentajeAprobados = 0;
    $porcentajeReprobados = 0;
    if($alumnosEvaluados > 0) {
        $porcentajeAprobados = ($aprobados / $alumnosEvaluados) * 100;
        $porcentajeReprobados = ($reprobados / $alumnosEvaluados) * 100;
    }
    
    // Mejor y peor calificación
    $mejorCalificacion = 0;
    $peorCalificacion = 0;
    $alumnoMejor = "";
    $alumnoPeor = "";
    
    if($alumnosEvaluados > 0) {
        $mejorCalificacion = max($calificacionesNumericas);
        $peorCalificacion = min($calificacionesNumericas);
        
        // Encontrar nombres de alumnos con mejor y peor calificación
        foreach($calificacionesNumericas as $nombre => $calif) {
            if($calif == $mejorCalificacion) {
                $alumnoMejor .= $nombre . " ";
            }
            if($calif == $peorCalificacion) {
                $alumnoPeor .= $nombre . " ";
            }
        }
    }
    
    // Alumnos en área de oportunidad (calificación < 6 pero >= 0)
    $alumnosAreaOportunidad = [];
    foreach($calificacionesNumericas as $nombre => $calif) {
        if($calif < 6) {
            $alumnosAreaOportunidad[$nombre] = $calif;
        }
    }
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Estadísticas de Calificaciones</title>
    </head>
    <body>
        <div class="container">
            <h1>Estadísticas de Calificaciones</h1>
            
            <h2>Resumen General</h2>
            <div class="estadistica">
                <strong>Aprovechamiento General (Promedio):</strong> <?php echo number_format($aprovechamientoGeneral, 2); ?> / 10
            </div>
            
            <div class="estadistica">
                <strong>Total de alumnos:</strong> <?php echo $totalAlumnos; ?><br>
                <strong>Alumnos evaluados:</strong> <?php echo $alumnosEvaluados; ?><br>
                <strong>Alumnos con NP:</strong> <?php echo $alumnosConNP; ?>
            </div>
            
            <h2>Aprobados y Reprobados</h2>
            <div class="estadistica">
                <strong>Aprobados:</strong> <span class="aprobado"><?php echo $aprobados; ?> (<?php echo number_format($porcentajeAprobados, 1); ?>%)</span><br>
                <strong>Reprobados:</strong> <span class="reprobado"><?php echo $reprobados; ?> (<?php echo number_format($porcentajeReprobados, 1); ?>%)</span>
            </div>
            
            <h2>Mejor y Peor Calificación</h2>
            <?php if($alumnosEvaluados > 0): ?>
            <div class="exito">
                <strong>Mejor calificación:</strong> <?php echo $mejorCalificacion; ?> / 10<br>
                <strong>Alumno(s):</strong> <?php echo $alumnoMejor; ?>
            </div>
            <div class="alerta">
                <strong>Peor calificación:</strong> <?php echo $peorCalificacion; ?> / 10<br>
                <strong>Alumno(s):</strong> <?php echo $alumnoPeor; ?>
            </div>
            <?php endif; ?>
            
            <h2>Alumnos en Área de Oportunidad</h2>
            <?php if(count($alumnosAreaOportunidad) > 0): ?>
            <div class="alerta">
                <p><strong>Los siguientes alumnos necesitan apoyo adicional (calificación menor a 6):</strong></p>
                <table border="1">
                    <tr>
                        <th>Alumno</th>
                        <th>Calificación</th>
                    </tr>
                    <?php foreach($alumnosAreaOportunidad as $nombre => $calif): ?>
                    <tr>
                        <td><?php echo $nombre; ?></td>
                        <td class="reprobado"><?php echo $calif; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <?php else: ?>
            <div class="exito">
                <p>¡Excelente! No hay alumnos en área de oportunidad. Todos los evaluados tienen calificación aprobatoria.</p>
            </div>
            <?php endif; ?>
            
            <?php if(count($alumnosNP) > 0): ?>
            <h2>Alumnos No Presentados (NP)</h2>
            <div class="alerta">
                <p><strong>Los siguientes alumnos NO presentaron evaluación:</strong></p>
                <ul>
                    <?php foreach($alumnosNP as $alumnoNP): ?>
                    <li class="np"><?php echo $alumnoNP; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
            
            <h2>Tabla Completa de Calificaciones</h2>
            <table border="1">
                <tr>
                    <th>Alumno</th>
                    <th>Calificación</th>
                    <th>Estatus</th>
                </tr>
                <?php foreach($alumnos as $alumno): ?>
                <tr>
                    <td><?php echo $alumno; ?></td>
                    <td>
                        <?php 
                        if(isset($calificacionesAlumnos[$alumno])) {
                            echo $calificacionesAlumnos[$alumno];
                        } else {
                            echo "No capturada";
                        }
                        ?>
                    </td>
                    <td>
                        <?php 
                        if(isset($calificacionesAlumnos[$alumno])) {
                            $calif = $calificacionesAlumnos[$alumno];
                            if($calif == "NP") {
                                echo "<span class='np'>No Presentado</span>";
                            } elseif($calif >= 6) {
                                echo "<span class='aprobado'>Aprobado</span>";
                            } else {
                                echo "<span class='reprobado'>Reprobado</span>";
                            }
                        } else {
                            echo "-";
                        }
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </body>
</html>