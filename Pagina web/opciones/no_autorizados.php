<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=Reporte de accesos no autorizados.xls");

require("../conexion/conexion.php");

$sqlReportNoAuto="SELECT * FROM no_autorizados ";

?>
<table>
  <h1>Accesos no autorizados</h1>
  <tr>
    <th>Fecha</th>
    <th>Hora</th>
  </tr>
  <?php $resultadoDatos = mysqli_query($conexion, $sqlReportNoAuto);
        while ($row = mysqli_fetch_assoc($resultadoDatos)) { ?>
  <tr>
    <th><?php echo $row["Fecha"]; ?></th>

    <th><?php echo $row["Hora"];?></th>

  </tr>



  <?php }

        ?>
</table>