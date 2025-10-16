//Sandoval Ramírez Marco Julian
//Vasquez Salinas Alitzel Aimee
//Practica 1 2do Parcial PW
<?php
    $alumnos = ["Jennie","Angelo","Lisa","Elio","Jisoo","Massimo","Isabel","Pierre","Rose","Riccardo"];
    $calificaciones = ["0","1","2","3","4","5","6","7","8","9","10","NP"];
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Captura de Calificaciones</title>
    </head>
    <body>
        <h1>Mis alumnos</h1>
        <form method="post" action="MedicionGrupal.php">
            <table border="1">
                <tr>
                    <th>Nombre</th>
                    <th>Calificación</th>
                </tr>
                <?php foreach($alumnos as $alumno): ?>
                <tr>
                    <td>
                        <label><?php echo $alumno; ?></label>
                    </td>
                    <td>
                        <select name="cbo<?php echo $alumno; ?>">
                            <?php foreach($calificaciones as $calif): ?>
                            <option value="<?php echo $calif; ?>"><?php echo $calif; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <?php endforeach; ?> 
            </table>
            <br>
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>