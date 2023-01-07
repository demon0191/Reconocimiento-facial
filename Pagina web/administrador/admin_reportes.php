<?php 
require("../conexion/conexion.php");
session_start();
$usuario = $_SESSION['Matricula_Administrador'];
date_default_timezone_set('America/Mexico_City');
$fecha_actual= date('Y-m-d');
$sqlDatosProf = "SELECT * FROM persona, profesores, acceso_profesores WHERE profesores.idPersona=persona.idPersona and profesores.Matricula_Profesor=acceso_profesores.fkMatricula_Profesor and acceso_profesores.Fecha='".$fecha_actual.
"'";

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
      <a href="admin_reportes.php">Reportes</a>
      <a href="../index.html">Cerrar sesión</a>
    </div>
  </div>
  <div class='swanky_wrapper'>
    <input id='Dashboard' name='radio' type='radio'>
    <label for='Dashboard'>
      <img src='../img/Asistencia.png'>
      <span>Asistencia</span>
      <div class='lil_arrow'></div>
      <div class='bar'></div>
      <div class='swanky_wrapper__content'>
        <ul>
          <label for="btn-modal">Asistencia de profesores</label>
          <label for="btn-modal2">Acceso total del mes</label>
        </ul>
      </div>
    </label>
    <input id='Sales' name='radio' type='radio'>
    <label for='Sales'>
      <img src='../img/No_autorizados.png'>
      <span>No autorizados</span>
      <div class='lil_arrow'></div>
      <div class='bar'></div>
      <div class='swanky_wrapper__content'>
        <ul>
          <label for="btn-modal3">Listado del mes</label>
          <label for="btn-modal4">Listado total</label>
        </ul>
      </div>
    </label>
    <input id='Messages' name='radio' type='radio'>
    <label for='Messages'>
      <img src='../img/Quejas.png'>
      <span>Quejas</span>
      <div class='lil_arrow'></div>
      <div class='bar'></div>
      <div class='swanky_wrapper__content'>
        <ul>
          <label for="btn-modal5">Reporte de fallos</label>
        </ul>
      </div>
    </label>


  </div>

  <main>
    <center>

      <div class="container">
        <h2>Acceso de profesores</h2>
        <ul class="responsive-table">
          <li class="table-header">
            <div class="col col-1">Matricula</div>
            <div class="col col-2">Nombre</div>
            <div class="col col-3">Entrada</div>
            <div class="col col-5">Salida</div>
            <div class="col col-6">Presente</div>
          </li>
          <?php $resultadoDatos = mysqli_query($conexion, $sqlDatosProf);
        while ($row = mysqli_fetch_assoc($resultadoDatos)) { ?>
          <li class="table-row">
            <div class="col col-1" data-label="Matricula"><?php echo $row["Matricula_Profesor"]; ?></div>
            <div class="col col-2" data-label="Nombre"><?php echo $row["ApellidoP"];?> <?php echo $row["ApellidoM"];?>
              <?php echo $row["Nombre"]; ?></div>
            <div class="col col-3" data-label="Entrada"><?php echo $row["Hora_entrada"]; ?></div>
            <div class="col col-5" data-label="Salida"><?php echo $row["Hora_salida"]; ?></div>
            <div class="col col-6" data-label="Presente"><?php $aux=$row["En_uso"];  echo div_en_uso($aux);?></div>
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
        <h2>Asistencia diaria de profesores</h2>
        <p class="text-report">Dar clic en el botón de descarga para descargar la asistencia semanal de los profesores
        </p>
        <center><a href="../opciones/asistencia_diaria_prof.php" class="descarga">Descargar</a></center>
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
      <h2>Acceso total del mes</h2>
      <p class="text-report">Dar clic en el botón de descarga para descargar el registro de acceso total en el mes</p>
      <center><a href="../opciones/acceso_total_mes.php" class="descarga">Descargar</a></center>
      <div class="btn-cerrar2">
        <label for="btn-modal2">Cerrar</label>
      </div>
    </div>
    <label for="btn-modal2" class="cerrar-modal2"></label>
  </div>

  <input type="checkbox" id="btn-modal3">
  <div class="container-modal3">
    <div class="content-modal3">
      <h2>Reporte mensual de ingresos no autorizados</h2>
      <p class="text-report">Dar clic en el botón de descarga para descargar el reporte mensual de los ingresos no
        autorizados</p>
      <center><a href="../opciones/no_autorizados_mes.php" class="descarga">Descargar</a></center>
      <div class="btn-cerrar3">
        <label for="btn-modal3">Cerrar</label>
      </div>
    </div>
    <label for="btn-modal3" class="cerrar-modal3"></label>
  </div>

  <input type="checkbox" id="btn-modal4">
  <div class="container-modal4">
    <div class="content-modal4">
      <h2>Reporte de ingresos no autorizados</h2>
      <p class="text-report">Dar clic en el botón de descarga para descargar el reporte de todos los ingresos no
        autorizados que se han registrado en el sistema</p>
      <center><a href="../opciones/no_autorizados.php" class="descarga">Descargar</a></center>
      <div class="btn-cerrar4">
        <label for="btn-modal4">Cerrar</label>
      </div>
    </div>
    <label for="btn-modal4" class="cerrar-modal4"></label>
  </div>

  <input type="checkbox" id="btn-modal5">
  <div class="container-modal5">
    <div class="content-modal5">
      <h2>Reporte de fallos</h2>
      <p class="text-report">Dar clic en el botón de descarga para descargar el reporte de fallos</p>
      <center><a href="../opciones/fallos.php" class="descarga">Descargar</a></center>
      <div class="btn-cerrar5">
        <label for="btn-modal5">Cerrar</label>
      </div>
    </div>
    <label for="btn-modal5" class="cerrar-modal5"></label>
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
<?php
function div_en_uso($num)
{
  $res="";
    if($num=='0'){
      $res="NO";
    }else if($num=='1'){
      $res="SI";
    }
    return $res;
}
?>

</html>