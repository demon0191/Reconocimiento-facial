<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=Asistencia mensual de alumnos.xls");
session_start();
$usuario = $_SESSION['Matricula_Profesor'];
require("../conexion/conexion.php");
$mes=date('m');
$sqlAsistAlum = "SELECT * FROM alumnos, persona, acceso_alumnos WHERE alumnos.idPersona=persona.idPersona and alumnos.Matricula_Alumno=acceso_alumnos.fkMatricula_Alumno AND MONTH(Fecha)='".$mes."' and alumnos.Matricula_Profesor='".$usuario."'";
?>
<table>
  <h1>Alumnos</h1>
  <tr>
    <th>Matricula</th>
    <th>Nombre</th>
    <th>Fecha</th>
    <th>Entrada</th>
    <th>Salida</th>
  </tr>
  <?php $resultadoDatos = mysqli_query($conexion, $sqlAsistAlum);
        while ($row = mysqli_fetch_assoc($resultadoDatos)) { ?>
  <tr>
    <th><?php echo $row["Matricula_Alumno"]; ?></th>
    <th><?php echo $row["ApellidoP"];?> <?php echo $row["ApellidoM"];?><?php echo $row["Nombre"]; ?></th>
    <th><?php echo $row["Fecha"];?></th>
    <th><?php echo $row["Hora_entrada"]; ?></th>
    <th><?php echo $row["Hora_salida"]; ?></th>
  </tr>



  <?php }

        ?>
</table>