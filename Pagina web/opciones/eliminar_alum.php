<?php
require('../conexion/conexion.php');
$matricula=$_POST['matricula'];

if(empty($matricula) ){
echo "<script>alert('Matricula no ingresada'); window.location.assign('../administrador/admin_alumnos.php') </script>";
echo '</script>'; 
}

$result = mysqli_query($conexion, "SELECT Matricula_Alumno FROM alumnos WHERE Matricula_Alumno='".$matricula."'");
if($row = mysqli_fetch_array($result)){

  echo "1";
  $sqlDeleteAlum="DELETE FROM alumnos WHERE Matricula_Alumno='".$matricula."'";
    if($conexion -> query($sqlDeleteAlum)==true){
      echo "2";
      echo "<script>alert('Alumno eliminado'); window.location.assign('../administrador/admin_alumnos.php') </script>";
  echo '</script>'; 
    }else{
      echo "error";
    }
}else{
  echo "<script>alert('Alumno no encontrado'); window.location.assign('../administrador/admin_alumnos.php') </script>";
  echo '</script>'; 
}
?>