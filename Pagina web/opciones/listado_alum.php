<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=Lista de alumnos.xls");
session_start();
$usuario = $_SESSION['Matricula_Profesor'];
require("../conexion/conexion.php");

$sqlListaAlum = "SELECT * FROM alumnos, persona, nivel_academico WHERE alumnos.idPersona=persona.idPersona and alumnos.idNivel_Academico=nivel_academico.idNivel_Academico and alumnos.Matricula_Profesor='".$usuario."'";
?>
<table>
  <h1>Alumnos</h1>
  <tr>
    <th>Matricula</th>
    <th>Nombre</th>
    <th>Carrera</th>
    <th>Semestre</th>
    <th>Nivel acádemico</th>
  </tr>
  <?php $resultadoDatos = mysqli_query($conexion, $sqlListaAlum);
        while ($row = mysqli_fetch_assoc($resultadoDatos)) { ?>
  <tr>
    <th><?php echo $row["Matricula_Alumno"]; ?></th>
    <th><?php echo $row["ApellidoP"];?> <?php echo $row["ApellidoM"];?><?php echo $row["Nombre"]; ?></th>
    <th><?php echo $row["Carrera"];?></th>
    <th><?php echo $row["Semestre"]; ?></th>
    <th><?php echo $row["Nombre_nivel"]; ?></th>
  </tr>



  <?php }

        ?>
</table>