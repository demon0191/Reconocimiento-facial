<?php
require('../conexion/conexion.php');

$usuario = $_POST['matricula'];
$pass = $_POST['pass'];
if(empty($usuario) || empty($pass)){
header("Location:../administrador/login_admin.php");
exit();
}

$result = mysqli_query($conexion, "SELECT * from administrador where Matricula_Administrador='" . $usuario . "'");
if($row = mysqli_fetch_array($result)){
if($row['Password'] == $pass){
session_start();
$_SESSION['Matricula_Administrador'] = $usuario;
header("Location:../administrador/admin.php");
}else{
echo "<script>alert('Usuario o contraseña incorrectos'); window.location.assign('../administrador/login_admin.php') </script>";
echo '</script>';  
}
}else{
  echo "<script>alert('Usuario no encontrado'); window.location.assign('../administrador/login_admin.php') </script>";
echo '</script>'; 
}
?>