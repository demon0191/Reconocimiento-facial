<?php
require('../conexion/conexion.php');
$matricula=$_POST['matricula'];
$apellidoP=$_POST['apellidop'];
$apellidoM=$_POST['apellidom'];
$nombre=$_POST['nombre'];
$edad=$_POST['edad'];
$email=$_POST['email'];

$nivel=$_POST['nivel'];
$categoria="2";


/*editar la tabla alumno y desde  el campo id persona editar los datos  personales*/
if(empty($matricula) || empty($apellidoP) || empty($nombre) || empty($edad) || empty($nivel)){
echo "<script>alert('Campos faltantes'); window.location.assign('../administrador/admin_profesores.php') </script>";
echo '</script>'; 
}

$result = mysqli_query($conexion, "SELECT Matricula_Profesor FROM profesores WHERE Matricula_Profesor='".$matricula."'");
if($row = mysqli_fetch_array($result)){
  $editProf="UPDATE profesores SET Email='$email', idNivel_Academico= '$nivel' WHERE Matricula_Profesor='".$matricula."'";

  if($conexion -> query($editProf)==true){
    $SQLidperson="SELECT profesores.idPersona FROM profesores WHERE profesores.Matricula_Profesor='".$matricula."'";
    $resultado=mysqli_query($conexion,$SQLidperson);
    if($idPerson=mysqli_fetch_array($resultado)){
$editPerson="UPDATE persona SET Nombre = '$nombre', ApellidoP = '$apellidoP', ApellidoM= '$apellidoM', Edad='$edad' WHERE idPersona='".$idPerson[0]."'";
    if($conexion -> query($editPerson)==true){
echo "<script>alert('Datos editados correctamente'); window.location.assign('../administrador/admin_profesores.php') </script>";
echo '</script>'; 
  }
    }else{
echo "<script>alert('Datos de profesor editados pero no datos personales'); window.location.assign('../administrador/admin_profesores.php') </script>";
echo '</script>'; 
  }
      
    
  }else{
echo "<script>alert('Datos no actualizados'); window.location.assign('../administrador/admin_profesores.php') </script>";
echo '</script>'; 
  }
    

}else{
  echo "<script>alert('Profesor no encontrado'); window.location.assign('../administrador/admin_profesores.php') </script>";
echo '</script>'; 
}

?>