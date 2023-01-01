<?php
$servername = "localhost";
$database = "laboratorio_dacb";
$username = "root";
$password = "ferrari0191";
// Create connection
$conexion = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}
?>