<?php
require('../conexion/conexion.php');
$matricula=$_POST['matricula'];

if(empty($matricula) ){
echo "<script>alert('Matricula no ingresada'); window.location.assign('../administrador/admin_profesores.php') </script>";
echo '</script>'; 
}

$result = mysqli_query($conexion, "SELECT Matricula_Profesor FROM profesores WHERE Matricula_Profesor='".$matricula."'");
if($row = mysqli_fetch_array($result)){

  $sqlDeleteProf="DELETE FROM profesores WHERE Matricula_Profesor='".$matricula."'";
    if($conexion -> query($sqlDeleteProf)==true){
      
      echo "<script>alert('Profesor eliminado'); window.location.assign('../administrador/admin_profesores.php') </script>";
  echo '</script>'; 
    }else{
      echo "<script>alert('No se elimino al profesor'); window.location.assign('../administrador/admin_profesores.php') </script>";
  echo '</script>'; 
    }
}else{
  echo "<script>alert('Profesor no encontrado'); window.location.assign('../administrador/admin_profesores.php') </script>";
  echo '</script>'; 
}
?>