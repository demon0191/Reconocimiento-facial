<?php 
require("../conexion/conexion.php");
session_start();
$usuario = $_SESSION['Matricula_Administrador'];
$sqlDatosAdmin1 = "SELECT * FROM administrador, persona WHERE administrador.idPersona=persona.idPersona and administrador.Matricula_Administrador='".$usuario."'";
$sqlDatosAdmin2 = "SELECT * FROM administrador, categoria WHERE administrador.idCategoria=categoria.idCategoria and administrador.Matricula_Administrador='".$usuario."'";
$sqlDatosAdmin3 = "SELECT * FROM administrador, nivel_academico WHERE administrador.idNivel_Academico=nivel_academico.idNivel_Academico and administrador.Matricula_Administrador='".$usuario."'";
?>

<html lang="es">

<head>
  <title>Administrador</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/estilo.css">
</head>

<body>
  <div class="header">
    <a href="admin.php" class="logo">Panel administrador</a>
    <div class="header-right">
      <a class="active" href="admin.php">Administrador</a>
      <a href="admin_alumnos.php">Alumnos</a>
      <a href="admin_profesores.php">Profesores</a>
      <a href="admin_no_autorizados.php">No autorizados</a>
      <a href="../index.html">Cerrar sesión</a>
    </div>
  </div>

  <center>
    <div class="content-body">
      <?php $resultadoDatos = mysqli_query($conexion, $sqlDatosAdmin1);
        while ($row = mysqli_fetch_assoc($resultadoDatos)) { ?>
      <h1 class="saludo-admin">Bienvenido administrador <?php echo $row["Nombre"]; ?></h1>
      <?php }

        ?>
      <div class="datos-admin1">
        <?php $resultadoDatos = mysqli_query($conexion, $sqlDatosAdmin1);
        while ($row = mysqli_fetch_assoc($resultadoDatos)) { ?>


        <h4 class="titulo-datos">Nombre: </h4>
        <p class="datos-datos">
          <?php echo $row["ApellidoP"];?> <?php echo $row["ApellidoM"]; ?> <?php echo $row["Nombre"]; ?></p>
        <br>
        <h4 class="titulo-datos">Matricula: </h4>
        <p class="datos-datos"><?php echo $row["Matricula_Administrador"]; ?></p><br>

        <?php }

        ?>
      </div>
      <div class="datos-admin2">
        <?php $resultadoDatos2 = mysqli_query($conexion, $sqlDatosAdmin2);
        while ($row2 = mysqli_fetch_assoc($resultadoDatos2)) { ?>
        <h4 class="titulo-datos">Categoria: </h4>
        <p class="datos-datos"><?php echo $row2["Nombre"]; ?></p>
        <h4 class="titulo-datos">Descripción: </h4>
        <p class="datos-datos"><?php echo $row2["Descripcion"]; ?></p>

        <?php }

        ?>
      </div>
      <div class="datos-admin3">
        <?php $resultadoDatos3 = mysqli_query($conexion, $sqlDatosAdmin3);
        while ($row3 = mysqli_fetch_assoc($resultadoDatos3)) { ?>
        <h4 class="titulo-datos">Nivel Académico: </h4>
        <p class="datos-datos"><?php echo $row3["Nombre_nivel"]; ?></p>
        <h4 class="titulo-datos">Descripción: </h4>
        <p class="datos-datos"><?php echo $row3["Descripcion"]; ?></p>

        <?php }

        ?>
      </div>
    </div>
  </center>

  <main>
    <div class="body-content">
    </div>
  </main>

  <footer id="footer" class="footer-1">
    <div class="main-footer widgets-dark typo-light">
      <div class="container">
        <div class="row">

          <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="widget subscribe no-box">
              <h5 class="widget-title">LABORATORIO DACB<span></span></h5>
              <p>Acerca de la compañía, una pequeña descripción irá aquí.</p>
            </div>
          </div>

          <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="widget no-box">
              <h5 class="widget-title">Enlaces rápidos<span></span></h5>
              <ul class="thumbnail-widget">
                <li>
                  <div class="thumb-content"><a href="#.">Inicio</a></div>
                </li>
                <li>
                  <div class="thumb-content"><a href="#.">Ayuda</a></div>
                </li>
                <li>
                  <div class="thumb-content"><a href="../ayuda/acerca_de.php">Acerca de</a></div>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-3">

            <div class="widget no-box">
              <h5 class="widget-title">Reportar fallas<span></span></h5>

              <p><a href="mailto:info@domain.com" title="glorythemes">info@</a></p>
  </footer>

</body>

</html>