<?php 
require("../conexion/conexion.php");
session_start();
$usuario = $_SESSION['Matricula_Profesor'];
$sqlDatosProf = "SELECT * FROM profesores, persona, categoria, nivel_academico WHERE profesores.idPersona=persona.idPersona and profesores.idNivel_Academico=nivel_academico.idNivel_Academico and profesores.idCategoria=categoria.idCategoria and profesores.Matricula_Profesor='".$usuario."'";
?>

<html lang="es">

<head>
  <title>Profesor</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/estilo.css">
</head>

<body>
  <div class="header">
    <a href="admin.php" class="logo">Panel profesor</a>
    <div class="header-right">
      <a class="active" href="profesor.php">Profesor</a>
      <a href="prof_alumnos.php">Alumnos</a>
      <a href="../index.html">Cerrar sesión</a>
    </div>
  </div>

  <center>
    <div class="content-body">
      <?php $resultadoDatos = mysqli_query($conexion, $sqlDatosProf);
        while ($row = mysqli_fetch_assoc($resultadoDatos)) { ?>
      <h1 class="saludo-admin">Bienvenido profesor <?php echo $row["Nombre"]; ?></h1>
      <?php }

        ?>
      <div class="datos-admin1">
        <?php $resultadoDatos = mysqli_query($conexion, $sqlDatosProf);
        while ($row = mysqli_fetch_assoc($resultadoDatos)) { ?>
        <h4 class="titulo-datos">Nombre: </h4>
        <p class="datos-datos">
          <?php echo $row["ApellidoP"];?> <?php echo $row["ApellidoM"]; ?> <?php echo $row["Nombre"]; ?></p>

        <h4 class="titulo-datos">Categoria: </h4>
        <p class="datos-datos"><?php echo $row["Nombre_categoria"]; ?></p>

        <h4 class="titulo-datos">Descripción: </h4>
        <p class="datos-datos"><?php echo $row["Descripcion_categoria"]; ?></p>

        <h4 class="titulo-datos">Nivel acádemico: </h4>
        <p class="datos-datos"><?php echo $row["Nombre_nivel"]; ?></p>

        <h4 class="titulo-datos">Descripción: </h4>
        <p class="datos-datos"><?php echo $row["Descripcion_nivel"]; ?></p>
        <br>

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