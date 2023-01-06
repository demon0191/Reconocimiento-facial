<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=Fallos.xls");

require("../conexion/conexion.php");

$sqlReportFallos="SELECT * FROM fallos";

?>
<table>
  <h1>Reporte de fallos</h1>
  <tr>
    <th>Asunto</th>
    <th>Descripcion</th>
    <th>Fecha</th>
    <th>Profesor</th>
  </tr>
  <?php $resultadoDatos = mysqli_query($conexion, $sqlReportFallos);
        while ($row = mysqli_fetch_assoc($resultadoDatos)) { ?>
  <tr>
    <th><?php echo $row["Asunto"]; ?></th>
    <th><?php echo $row["Descripcion"];?></th>
    <th><?php echo $row["Fecha"];?></th>
    <th><?php echo $row["fkMatricula_Profesor"];?></th>
  </tr>



  <?php }

        ?>
</table>