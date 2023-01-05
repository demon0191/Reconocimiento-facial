<?php 
require('../conexion/conexion.php');
$matricula=$_POST['matricula'];
$apellidoP=$_POST['apellidop'];
$apellidoM=$_POST['apellidom'];
$nombre=$_POST['nombre'];
$edad=$_POST['edad'];
$email=$_POST['email'];
$categoria=2;
$nivel=$_POST['nivel'];


if(empty($matricula) || empty($apellidoP) || empty($nombre) || empty($edad) || empty($email) || empty($nivel)){
echo "<script>alert('Campos faltantes'); window.location.assign('../administrador/admin_profesores.php') </script>";
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

    /*llamar la funciones*/
    $password= generar_password();//genera contraseña
    //enviar_password($password,$email);//envia contraseña
    $SQLprof="INSERT INTO profesores(Matricula_Profesor, Email, Password, idNivel_Academico, idPersona, idCategoria) VALUES ('$matricula','$email','$password','$nivel','$idperson[0]','$categoria')";
    if($conexion -> query($SQLprof)==true){
      echo "<script>alert('Profesor registrado, no olvide agregar las imagenes de su rostro en la carpeta correspondiente'); window.location.assign('../administrador/admin_alumnos.php') </script>";
      echo '</script>'; 
    }
  }
  }else{/*Si se encuentra la persona solo se buscara su id y se agregara a la tabla profesores*/
     $SQLidperson="SELECT idPersona FROM persona WHERE Nombre='".$nombre."' and ApellidoP='".$apellidoP."' and ApellidoM='".$apellidoM."' and Edad='".$edad."'";
    $resultado=mysqli_query($conexion,$SQLidperson);
    $idperson=mysqli_fetch_array($resultado);


    /*llamar la función para generar su pass*/
   $password= generar_password();//genera contraseña
   //enviar_password($password,$email);//envia contraseña
   $SQLprof="INSERT INTO profesores(Matricula_Profesor, Email, Password, idNivel_Academico, idPersona, idCategoria) VALUES ('$matricula','$email','$password','$nivel','$idperson[0]','$categoria')";
   
    if($conexion -> query($SQLprof)==true){
      echo "<script>alert('Profesor registrado, no olvide agregar las imagenes de su rostro en la carpeta correspondiente'); window.location.assign('../administrador/admin_alumnos.php') </script>";
      echo '</script>'; 
    }
  }
}else{
echo "<script>alert(Profesor ya registrado anteriormente'); window.location.assign('../administrador/admin_alumnos.php') </script>";
      echo '</script>'; 
}

/*FUNCIÓN PARA GENERAR PASSWORD*/
function generar_password()
{
    $caracteres = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-.#!';
    for($x = 0; $x < 10; $x++){
      $aleatoria = substr(str_shuffle($caracteres), 0, 10);
      
    }
    $pass=$aleatoria;

    return $pass;
}
/*FUNCION PARA ENVIAR POR EMAIL*/

function enviar_password($password, $email){
		$subject = "Entrega de contraseña";
		$message = "Mediante este medio nos comunicamos con usted para hacerle entrega de su contraseña generada automaticamente, su contraseña es: ". $password;
		return mail($email, $subject, $message);    
	}
	
?>