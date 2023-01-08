<?php 
require('../conexion/conexion.php');
$matricula=$_POST['matricula'];
$apellidoP=$_POST['apellidop'];
$apellidoM=$_POST['apellidom'];
$nombre=$_POST['nombre'];
$edad=$_POST['edad'];
$carrera=$_POST['carrera'];
$semestre=$_POST['semestre'];
$nivel=$_POST['nivelAca'];
$categoria="3";
$profesor=$_POST['matriculap'];

if(empty($matricula) || empty($apellidoP) || empty($nombre) || empty($edad) || empty($carrera) || empty($semestre) || empty($nivel) || empty($categoria) || empty($profesor)){
echo "<script>alert('Campos faltantes'); window.location.assign('../administrador/admin_alumnos.php') </script>";
echo '</script>'; 

}

$result = mysqli_query($conexion, "SELECT Matricula_Alumno FROM alumnos WHERE Matricula_Alumno='".$matricula."'");
if(!$row = mysqli_fetch_array($result)){
  $resultPerson = mysqli_query($conexion, "SELECT * FROM persona WHERE Nombre='".$nombre."' and ApellidoP='".$apellidoP."' and ApellidoM='".$apellidoM."' and Edad='".$edad."'");
  if(!$row2=mysqli_fetch_array($resultPerson)){/*Si no se encuentra la persona se ingresa*/
    $SQLpersona="INSERT INTO persona(Nombre, ApellidoP, ApellidoM, Edad) VALUES ('$nombre','$apellidoP','$apellidoM','$edad')";
  if($conexion -> query($SQLpersona)==true){
    $SQLidperson="SELECT idPersona FROM persona WHERE Nombre='".$nombre."' and ApellidoP='".$apellidoP."' and ApellidoM='".$apellidoM."' and Edad='".$edad."'";
    $resultado=mysqli_query($conexion,$SQLidperson);
    $idperson=mysqli_fetch_array($resultado);

    $SQLalum="INSERT INTO alumnos(Matricula_Alumno, Carrera, Semestre, idPersona, idNivel_Academico, idCategoria, Matricula_Profesor) VALUES ('$matricula','$carrera','$semestre','$idperson[0]','$nivel','$categoria','$profesor')";
    if($conexion -> query($SQLalum)==true){
      echo "<script>alert('Alumno registrado no olvide agregar las imagenes de su rostro en la carpeta correspondiente'); window.location.assign('../administrador/admin_alumnos.php') </script>";
      echo '</script>'; 
    }
  }
  }else{/*Si se encuentra la persona solo se buscara su id y se agregara a la tabla alumnos*/
     $SQLidperson="SELECT idPersona FROM persona WHERE Nombre='".$nombre."' and ApellidoP='".$apellidoP."' and ApellidoM='".$apellidoM."' and Edad='".$edad."'";
    $resultado=mysqli_query($conexion,$SQLidperson);
    $idperson=mysqli_fetch_array($resultado);

    $SQLalum="INSERT INTO alumnos(Matricula_Alumno, Carrera, Semestre, idPersona, idNivel_Academico, idCategoria, Matricula_Profesor) VALUES ('$matricula','$carrera','$semestre','$idperson[0]','$nivel','$categoria','$profesor')";
    if($conexion -> query($SQLalum)==true){
      echo "<script>alert('Alumno registrado no olvide agregar las imagenes de su rostro en la carpeta correspondiente'); window.location.assign('../administrador/admin_alumnos.php') </script>";
      echo '</script>'; 
    }
  }
}else{
  echo "<script>alert('Alumno ya registrado'); window.location.assign('../administrador/admin_alumnos.php') </script>";
echo '</script>'; 
}

?>