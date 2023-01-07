<?php
require('../conexion/conexion.php');

$usuario = $_POST['matricula'];
date_default_timezone_set('America/Mexico_City');
$fecha_actual= date('Y-m-d');
$hora_actual=date('H:i:s');
echo $hora_actual;

if(empty($usuario) ){
header("Location:../index.html");
exit();
}

$SQLprofe="SELECT Matricula_Profesor FROM alumnos WHERE Matricula_Alumno='" . $usuario . "'";
$result2=mysqli_query($conexion,$SQLprofe);
$maestro=mysqli_fetch_array($result2);

$result = mysqli_query($conexion, "SELECT * FROM alumnos WHERE Matricula_Alumno='" . $usuario . "'");
$resultProf = mysqli_query($conexion, "SELECT Matricula_Profesor FROM profesores WHERE Matricula_Profesor='".$usuario."'");

if($row = mysqli_fetch_array($result)){
  $resultEntrada=mysqli_query($conexion, "SELECT fkMatricula_Alumno FROM acceso_alumnos WHERE fkMatricula_Alumno='".$usuario."' and Fecha='".$fecha_actual."'");
  if(!$rowEntrada=mysqli_fetch_array($resultEntrada)){
    $sqlAccessAlum="INSERT INTO acceso_alumnos(Fecha, Hora_entrada, En_uso, fkMatricula_Alumno, fkMatricula_Profesor, idCategoria) VALUES ('$fecha_actual', '$hora_actual', '1', '$usuario', '$maestro[0]', '3')";
    if($conexion -> query($sqlAccessAlum)==true){
      echo "<script>alert('Ingreso registrado'); window.location.assign('../index.html') </script>";
      echo '</script>'; 
    }else{
      echo "<script>alert('ERROR'); window.location.assign('../index.html') </script>";
      echo '</script>'; 
}
  }else{
    $sqlExitAlum="UPDATE acceso_alumnos SET Hora_salida = '$hora_actual', En_uso = '0' WHERE fkMatricula_Alumno='".$usuario."' and Fecha='".$fecha_actual."'";
     if($conexion -> query($sqlExitAlum)==true){
      echo "<script>alert('Salida registrada'); window.location.assign('../index.html') </script>";
      echo '</script>'; 
    }else{
      echo "<script>alert('ERROR'); window.location.assign('../index.html') </script>";
      echo '</script>'; 
}
  }
}else if($rowProf = mysqli_fetch_array($resultProf)){
   $resultEntrada=mysqli_query($conexion, "SELECT fkMatricula_Profesor FROM acceso_profesores WHERE fkMatricula_Profesor='".$usuario."' and Fecha='".$fecha_actual."'");
  if(!$rowEntrada=mysqli_fetch_array($resultEntrada)){
    $sqlAccessProf="INSERT INTO acceso_profesores(Fecha, Hora_entrada, En_uso, fkMatricula_Profesor, idCategoria) VALUES ('$fecha_actual', '$hora_actual', '1', '$usuario', '2')";
    if($conexion -> query($sqlAccessProf)==true){
      echo "<script>alert('Ingreso registrado'); window.location.assign('../index.html') </script>";
      echo '</script>'; 
    }else{
      echo "<script>alert('ERROR'); window.location.assign('../index.html') </script>";
      echo '</script>'; 
}
  }else{
    $sqlExitProf="UPDATE acceso_profesores SET Hora_salida='$hora_actual',En_uso='0' WHERE fkMatricula_Profesor='".$usuario."' and Fecha='".$fecha_actual."'";
     if($conexion -> query($sqlExitProf)==true){
      echo "<script>alert('Salida registrada'); window.location.assign('../index.html') </script>";
      echo '</script>'; 
    }else{
      echo "<script>alert('ERROR'); window.location.assign('../index.html') </script>";
      echo '</script>'; 
}
  }
}
else{
  echo "<script>alert('Usuario no encontrado'); window.location.assign('../index.html') </script>";
echo '</script>'; 
}
?>