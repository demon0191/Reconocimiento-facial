<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=Asistencia diaria de los profesores.xls");

require("../conexion/conexion.php");
date_default_timezone_set('America/Mexico_City');
$fecha_actual= date('Y-m-d');
$sqlDatosProf = "SELECT * FROM persona, profesores, acceso_profesores WHERE profesores.idPersona=persona.idPersona and profesores.Matricula_Profesor=acceso_profesores.fkMatricula_Profesor and acceso_profesores.Fecha='".$fecha_actual."'";
?>
<table>
  <h1>Asistencia de profesores</h1>
  <tr>
    <th>Matricula</th>
    <th>Nombre</th>
    <th>Fecha</th>
    <th>Entrada</th>
    <th>Salida</th>
  </tr>
  <?php $resultadoDatos = mysqli_query($conexion, $sqlDatosProf);
        while ($row = mysqli_fetch_assoc($resultadoDatos)) { ?>
  <tr>
    <th><?php echo $row["Matricula_Profesor"]; ?></th>
    <th><?php echo $row["ApellidoP"];?> <?php echo $row["ApellidoM"];?><?php echo $row["Nombre"]; ?></th>
    <th><?php echo $row["Fecha"];?></th>
    <th><?php echo $row["Hora_entrada"]; ?></th>
    <th><?php echo $row["Hora_salida"]; ?></th>
  </tr>



  <?php }

        ?>
</table>