<?php 
require("../conexion/conexion.php");
session_start();
$usuario = $_SESSION['Matricula_Profesor'];
$fecha_actual= date('Y-m-d');
$sqlDatosAlum = "SELECT * FROM persona, alumnos,acceso_alumnos WHERE alumnos.idPersona=persona.idPersona and acceso_alumnos.fkMatricula_Profesor='".$usuario."' AND acceso_alumnos.fkMatricula_Alumno=alumnos.Matricula_Alumno and acceso_alumnos.Fecha='".$fecha_actual."'";

/*$sqlAlum="SELECT * from alumnos, persona, nivel_academico WHERE alumnos.idPersona=persona.idPersona and alumnos.idNivel_Academico=nivel_academico.idNivel_Academico and alumnos.Matricula_Alumno='".$matricula."'";*/

$sqlNivelAca="SELECT * FROM nivel_academico";
$dataNivelAca = mysqli_query($conexion, $sqlNivelAca);

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
    <a href="profesor.php" class="logo">Panel profesor</a>
    <div class="header-right">
      <a class="active" href="profesor.php">Profesor</a>
      <a href="prof_alumnos.php">Alumnos</a>
      <a href="../index.html">Cerrar sesión</a>
    </div>
  </div>
  <div class='swanky_wrapper'>
    <input id='Dashboard' name='radio' type='radio'>
    <label for='Dashboard'>
      <img src='../img/asistencia.png'>
      <span>Asistencia</span>
      <div class='lil_arrow'></div>
      <div class='bar'></div>
      <div class='swanky_wrapper__content'>
        <ul>

          <a><label for="btn-modal">Asistencia diaria</label></a>
          <a><label for="btn-modal2">Asistencia mensual</label></a>

        </ul>
      </div>
    </label>
    <input id='Sales' name='radio' type='radio'>
    <label for='Sales'>
      <img src='../img/Lista.png'>
      <span>Lista</span>
      <div class='lil_arrow'></div>
      <div class='bar'></div>
      <div class='swanky_wrapper__content'>
        <ul>
          <label for="btn-modal3">Listado de alumnos</label>
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
            <div class="col col-3">Entrada</div>
            <div class="col col-4">Salida</div>
            <div class="col col-5">Presente</div>

          </li>
          <?php $resultadoDatos = mysqli_query($conexion, $sqlDatosAlum);
        while ($row = mysqli_fetch_assoc($resultadoDatos)) { ?>
          <li class="table-row">
            <div class="col col-1" data-label="Matricula"><?php echo $row["Matricula_Alumno"]; ?></div>
            <div class="col col-2" data-label="Nombre"><?php echo $row["ApellidoP"];?> <?php echo $row["ApellidoM"];?>
              <?php echo $row["Nombre"]; ?></div>
            <div class="col col-3" data-label="Entrada"><?php echo $row["Hora_entrada"]; ?></div>
            <div class="col col-4" data-label="Salida"><?php echo $row["Hora_salida"]; ?></div>
            <div class="col col-5" data-label="Presente"><?php echo $row["En_uso"]; ?></div>

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
        <h2>Asistencia diaria de alumnos</h2>
        <p class="text-report">Dar clic en el botón de descarga para descargar la asistencia diaria de sus alumnos</p>
        <center><a href="../opciones/asistencia_diaria_alum.php" class="descarga">Descargar</a></center>
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
      <div class="agregar">
        <h2>Asistencia mensual de alumnos</h2>
        <p class="text-report">Dar clic en el botón de descarga para descargar la asistencia mensual de sus alumnos</p>
        <center><a href="../opciones/asistencia_mensual_alum.php" class="descarga">Descargar</a></center>
      </div>
      <div class="btn-cerrar2">
        <label for="btn-modal2">Cerrar</label>
      </div>
    </div>
    <label for="btn-modal2" class="cerrar-modal2"></label>
  </div>


  <input type="checkbox" id="btn-modal3">
  <div class="container-modal3">
    <div class="content-modal3">
      <div class="agregar">
        <h2>Lista de alumnos</h2>
        <p class="text-report">Dar clic en el botón de descarga para descargar la lista de sus alumnos</p>
        <center><a href="../opciones/listado_alum.php" class="descarga">Descargar</a></center>
      </div>
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