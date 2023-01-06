<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=Acceso total del mes.xls");
require("../conexion/conexion.php");
$mes=date('m');

$sqlAsistProf="SELECT * FROM persona, profesores, acceso_profesores, categoria WHERE profesores.idPersona=persona.idPersona and profesores.Matricula_Profesor=acceso_profesores.fkMatricula_Profesor and profesores.idCategoria=categoria.idCategoria and MONTH(Fecha)='".$mes."'";
$sqlAsistAlum="SELECT * FROM persona, alumnos, acceso_alumnos, categoria WHERE alumnos.idPersona=persona.idPersona and alumnos.Matricula_Alumno=acceso_alumnos.fkMatricula_Alumno and alumnos.idCategoria=categoria.idCategoria and MONTH(Fecha)='".$mes."'";
?>
<table>
  <h1>Acceso total del mes</h1>

  <h4>Profesores</h4>
  <tr>
    <th>Matricula</th>
    <th>Nombre</th>
    <th>Fecha</th>
    <th>Entrada</th>
    <th>Salida</th>
    <th>Categoria</th>
  </tr>
  <?php $resultadoDatos = mysqli_query($conexion, $sqlAsistProf);
        while ($row = mysqli_fetch_assoc($resultadoDatos)) { ?>
  <tr>
    <th><?php echo $row["Matricula_Profesor"]; ?></th>
    <th><?php echo $row["ApellidoP"];?> <?php echo $row["ApellidoM"];?><?php echo $row["Nombre"]; ?></th>
    <th><?php echo $row["Fecha"];?></th>
    <th><?php echo $row["Hora_entrada"]; ?></th>
    <th><?php echo $row["Hora_salida"]; ?></th>
    <th><?php echo $row["Nombre_categoria"]; ?></th>
  </tr>



  <?php }

        ?>


</table>
<table>
  <h4>Alumnos</h4>
  <tr>
    <th>Matricula</th>
    <th>Nombre</th>
    <th>Fecha</th>
    <th>Entrada</th>
    <th>Salida</th>
    <th>Categoria</th>
  </tr>
  <?php $resultadoDatos = mysqli_query($conexion, $sqlAsistAlum);
        while ($row = mysqli_fetch_assoc($resultadoDatos)) { ?>
  <tr>
    <th><?php echo $row["Matricula_Alumno"]; ?></th>
    <th><?php echo $row["ApellidoP"];?> <?php echo $row["ApellidoM"];?><?php echo $row["Nombre"]; ?></th>
    <th><?php echo $row["Fecha"];?></th>
    <th><?php echo $row["Hora_entrada"]; ?></th>
    <th><?php echo $row["Hora_salida"]; ?></th>
    <th><?php echo $row["Nombre_categoria"]; ?></th>
  </tr>



  <?php }

        ?>
</table>