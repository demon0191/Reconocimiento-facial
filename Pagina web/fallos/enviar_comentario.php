<?php  
require('../conexion/conexion.php');
// Llamando a los campos
$asunto = $_POST['asunto'];
$des= $_POST['descripcion'];
$fecha_actual= date('Y-m-d');
session_start();
$usuario = $_SESSION['Matricula_Profesor'];
$resultado=mysqli_query($conexion,"INSERT INTO fallos (Asunto, Descripcion, Fecha, fkMatricula_Profesor) VALUES ('$asunto','$des','$fecha_actual','$usuario')");
header('Location: ../index.html');




?>