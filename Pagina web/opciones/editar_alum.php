<?php
require('../conexion/conexion.php');
$matricula=$_POST['matricula'];
$apellidoP=$_POST['apellidop'];
$apellidoM=$_POST['apellidom'];
$nombre=$_POST['nombreAlum'];
$edad=$_POST['edad'];
$carrera=$_POST['carrera'];
$semestre=$_POST['semestre'];
$nivel=$_POST['nivelAca'];
$categoria=3;
$profesor=$_POST['matriculap'];

/*editar la tabla alumno y desde  el campo id persona editar los datos  personales*/
if(empty($matricula) || empty($apellidoP) || empty($nombre) || empty($edad) || empty($carrera) || empty($semestre) || empty($nivel) || empty($categoria) || empty($profesor)){
echo "<script>alert('Campos faltantes'); window.location.assign('../administrador/admin_alumnos.php') </script>";
echo '</script>'; 
}

$result = mysqli_query($conexion, "SELECT Matricula_Alumno FROM alumnos WHERE Matricula_Alumno='".$matricula."'");
if($row = mysqli_fetch_array($result)){
  $editAlum="UPDATE alumnos SET Carrera = '$carrera', Semestre = '$semestre', idNivel_Academico= '$nivel', Matricula_Profesor='$profesor' WHERE Matricula_Alumno='".$matricula."'";

  if($conexion -> query($editAlum)==true){
    $SQLidperson="SELECT alumnos.idPersona FROM alumnos WHERE alumnos.Matricula_Alumno='".$matricula."'";
    $resultado=mysqli_query($conexion,$SQLidperson);
    if($idPerson=mysqli_fetch_array($resultado)){
$editPerson="UPDATE persona SET Nombre = '$nombre', ApellidoP = '$apellidoP', ApellidoM= '$apellidoM', Edad='$edad' WHERE idPersona='".$idPerson[0]."'";
    if($conexion -> query($editPerson)==true){
echo "<script>alert('Datos editados correctamente'); window.location.assign('../administrador/admin_alumnos.php') </script>";
echo '</script>'; 
  }
    }
    
    
  }else{
echo "<script>alert('Datos de alumno editados pero no datos personales'); window.location.assign('../administrador/admin_alumnos.php') </script>";
echo '</script>'; 
  }
    

}else{
  echo "<script>alert('Alumno no encontrado'); window.location.assign('../administrador/admin_alumnos.php') </script>";
echo '</script>'; 
}

?>