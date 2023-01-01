<?php
require('../conexion/conexion.php');

$usuario = $_POST['matricula'];
$pass = $_POST['pass'];
if(empty($usuario) || empty($pass)){
header("Location:../profesores/login_profesores.php");
exit();
}

$result = mysqli_query($conexion, "SELECT * from profesores where Matricula_Profesor='" . $usuario . "'");
if($row = mysqli_fetch_array($result)){
if($row['Password'] == $pass){
session_start();
$_SESSION['Matricula_administrador'] = $usuario;
header("Location:../profesores/profesor.php");
}else{
echo "<script>alert('Usuario o contraseña incorrectos'); window.location.assign('../profesores/login_profesores.php') </script>";
echo '</script>';  
}
}else{
  echo "<script>alert('Usuario no encontrado'); window.location.assign('../profesores/login_profesores.php') </script>";
echo '</script>'; 
}
?>