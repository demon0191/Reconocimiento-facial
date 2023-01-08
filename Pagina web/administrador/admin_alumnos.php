<?php 
require("../conexion/conexion.php");
session_start();
$usuario = $_SESSION['Matricula_Administrador'];
$sqlDatosAlum = "SELECT * from alumnos, persona, nivel_academico WHERE alumnos.idPersona=persona.idPersona and alumnos.idNivel_Academico=nivel_academico.idNivel_Academico";

/*$sqlAlum="SELECT * from alumnos, persona, nivel_academico WHERE alumnos.idPersona=persona.idPersona and alumnos.idNivel_Academico=nivel_academico.idNivel_Academico and alumnos.Matricula_Alumno='".$matricula."'";*/

$sqlNivelAca="SELECT * FROM nivel_academico";
$dataNivelAca = mysqli_query($conexion, $sqlNivelAca);

?>
<html lang="es">

<head>
  <title>Administrador</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/estilo.css">
  <link rel="shortcut icon" href="../img/logo_dacb.png" />
</head>

<body>
  <div class="header">
    <a href="admin.php" class="logo">Panel administrador</a>
    <div class="header-right">
      <a class="active" href="admin.php">Administrador</a>
      <a href="admin_alumnos.php">Alumnos</a>
      <a href="admin_profesores.php">Profesores</a>
      <a href="admin_reportes.php">Reportes</a>
      <a href="../index.html">Cerrar sesión</a>
    </div>
  </div>
  <div class='swanky_wrapper'>
    <input id='Dashboard' name='radio' type='radio'>
    <label for='Dashboard'>
      <img src='../img/Agregar.png'>
      <span>Nuevos</span>
      <div class='lil_arrow'></div>
      <div class='bar'></div>
      <div class='swanky_wrapper__content'>
        <ul>

          <a><label for="btn-modal">Ingresar alumno</label></a>

        </ul>
      </div>
    </label>
    <input id='Sales' name='radio' type='radio'>
    <label for='Sales'>
      <img src='../img/Editar.png'>
      <span>Editar</span>
      <div class='lil_arrow'></div>
      <div class='bar'></div>
      <div class='swanky_wrapper__content'>
        <ul>
          <label for="btn-modal2">Editar alumno</label>
        </ul>
      </div>
    </label>
    <input id='Messages' name='radio' type='radio'>
    <label for='Messages'>
      <img src='../img/Eliminar.png'>
      <span>Eliminar</span>
      <div class='lil_arrow'></div>
      <div class='bar'></div>
      <div class='swanky_wrapper__content'>
        <ul>
          <label for="btn-modal3">Eliminar alumno</label>
        </ul>
      </div>
    </label>


  </div>
  <main>
    <center>

      <div class="container">
        <h2>Alumnos </h2>
        <ul class="responsive-table">
          <li class="table-header">
            <div class="col col-1">Matricula</div>
            <div class="col col-2">Nombre</div>
            <div class="col col-3">Carrera</div>
            <div class="col col-4">Semestre</div>
            <div class="col col-5">Nivel Académico</div>
            <div class="col col-6">Profesor</div>

          </li>
          <?php $resultadoDatos = mysqli_query($conexion, $sqlDatosAlum);
        while ($row = mysqli_fetch_assoc($resultadoDatos)) { ?>
          <li class="table-row">
            <div class="col col-1" data-label="Matricula"><?php echo $row["Matricula_Alumno"]; ?></div>
            <div class="col col-2" data-label="Nombre"><?php echo $row["ApellidoP"];?> <?php echo $row["ApellidoM"];?>
              <?php echo $row["Nombre"]; ?></div>
            <div class="col col-3" data-label="Carrera"><?php echo $row["Carrera"]; ?></div>
            <div class="col col-4" data-label="Semestre"><?php echo $row["Semestre"]; ?></div>
            <div class="col col-5" data-label="Nivel Académico"><?php echo $row["Nombre_nivel"]; ?></div>
            <div class="col col-6" data-label="Profesor"><?php echo $row["Matricula_Profesor"]; ?></div>
          </li>



          <?php }

        ?>

        </ul>
      </div>

    </center>
  </main>

  <input type="checkbox" id="btn-modal">
  <div class="container-modal">
    <div class="content-modal">
      <div class="agregar">
        <form action="../opciones/agregar_alum.php" method="post" class="formulario">
          <h1>Agregar alumnos</h1>
          <h4>Matricula:</h4>
          <input type="text" placeholder="Matricula" name="matricula">
          <h4>Apellido paterno:</h4>
          <input type="text" placeholder="Arias" name="apellidop">
          <h4>Apellido materno:</h4>
          <input type="text" placeholder="Morales" name="apellidom">
          <h4>Nombre completo:</h4>
          <input type="text" placeholder="Adry Moisés" name="nombre">
          <h4>Edad:</h4>
          <input type="text" placeholder="21" name="edad">
          <h4>Carrera:</h4>
          <input type="text" placeholder="Ing. en Sistemas Computacionales" name="carrera">
          <h4>Semestre:</h4>
          <input type="text" placeholder="7" name="semestre">
          <h4>Nivel académico:</h4>
          <select id="nivel-Aca" name="selectNivelAca" class="form-control form-control-sm">
            <option selected>Seleccione el nivel</option>
            <?php
                      while ($dataSelectNivel = mysqli_fetch_array($dataNivelAca)) { ?>
            <option>
              <?php 
                          echo utf8_encode($dataSelectNivel["Nombre_nivel"]); 
                          
                          ?>
            </option>
            <?php 

                  } ?>
            <input type="text" placeholder="Licenciatura" name="nivel">

          </select>

          <!--categoria se pondra en el action-->
          <h4>Profesor:</h4>
          <input type="text" placeholder="PROF_1" name="matriculap"><br>
          <input type="submit" value="Ingresar" class="button" onclick="passRowToForm()">
        </form>
      </div>
      <div class="btn-cerrar">
        <label for="btn-modal">Cerrar</label>
      </div>
    </div>
    <label for="btn-modal" class="cerrar-modal"></label>
  </div>

  <input type="checkbox" id="btn-modal2">
  <div class="container-modal2">
    <div class="content-modal2">
      <form action="../opciones/editar_alum.php" method="post" class="formulario">
        <h1>Editar alumnos</h1>
        <h4>Matricula:</h4>
        <input type="text" placeholder="Matricula" name="matricula">
        <h4>Apellido paterno:</h4>
        <input type="text" placeholder="Arias" name="apellidop">
        <h4>Apellido materno:</h4>
        <input type="text" placeholder="Morales" name="apellidom">
        <h4>Nombre completo:</h4>
        <input type="text" placeholder="Adry Moisés" name="nombre">
        <h4>Edad:</h4>
        <input type="text" placeholder="21" name="edad">
        <h4>Carrera:</h4>
        <input type="text" placeholder="Ing. en Sistemas Computacionales" name="carrera">
        <h4>Semestre:</h4>
        <input type="text" placeholder="7" name="semestre">
        <h4>Nivel académico:</h4>
        <input type="text" placeholder="Licenciatura" name="nivel">
        <!--categoria se pondra en el action-->
        <h4>Profesor:</h4>
        <input type="text" placeholder="PROF_1" name="matriculap"><br>
        <input type="submit" value="Ingresar" class="button">
      </form>
      <div class="btn-cerrar2">
        <label for="btn-modal2">Cerrar</label>
      </div>
    </div>
    <label for="btn-modal2" class="cerrar-modal2"></label>
  </div>

  <input type="checkbox" id="btn-modal3">
  <div class="container-modal3">
    <div class="content-modal3">
      <form action="../opciones/eliminar_alum.php" method="post" class="formulario">
        <h1>Eliminar alumnos</h1>
        <h4>Matricula:</h4>
        <input type="text" placeholder="Matricula" name="matricula"><br>




        <input type="submit" value="Ingresar" class="button">
      </form>
      <div class="btn-cerrar3">
        <label for="btn-modal3">Cerrar</label>
      </div>
    </div>
    <label for="btn-modal3" class="cerrar-modal3"></label>
  </div>

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
                  <div class="thumb-content"><a href="../index.html">Inicio</a></div>
                </li>
                <li>
                  <div class="thumb-content"><a href="../ayuda/ayuda.php">Ayuda</a></div>
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
              <ul class="thumbnail-widget">
                <li>
                  <div class="thumb-content"><a href="../fallos/fallos.php">Fallo</a></div>
                </li>
              </ul>
              <p><a href="mailto:adrymoises.arias.morales@gmail.com"
                  title="glorythemes">adrymoises.arias.morales@gmail.com</a></p>
  </footer>

</body>

</html>