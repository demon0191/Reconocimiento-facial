<?php 
require("../conexion/conexion.php");
session_start();
$usuario = $_SESSION['Matricula_Administrador'];
$sqlDatosProf = "SELECT * FROM profesores, persona WHERE profesores.idPersona=persona.idPersona";

$dataProf = mysqli_query($conexion, "SELECT Matricula_Profesor, Email, persona.ApellidoP, persona.ApellidoM, persona.Nombre, persona.Edad FROM profesores, persona WHERE profesores.idPersona=persona.idPersona");
$dataProf2=mysqli_query($conexion, "SELECT Matricula_Profesor FROM profesores WHERE 1");
$dataNivelAca = mysqli_query($conexion, "SELECT idNivel_Academico, Nombre_nivel FROM nivel_academico WHERE 1");
$dataNivelAca2 = mysqli_query($conexion, "SELECT idNivel_Academico, Nombre_nivel FROM nivel_academico WHERE 1");
?>
<html lang="es">

<head>
  <title>Administrador</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/estilo.css">
  <link rel="stylesheet" href="../css/botones.css">
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
          <label for="btn-modal">Ingresar profesor</label>
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
          <label for="btn-modal2">Editar profesor</label>
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
          <label for="btn-modal3">Eliminar profesor</label>
        </ul>
      </div>
    </label>


  </div>

  <main>
    <center>

      <div class="container">
        <h2>Profesores</h2>
        <ul class="responsive-table">
          <li class="table-header">
            <div class="col col-1">Matricula</div>
            <div class="col col-2">Nombre</div>
            <div class="col col-3">Email</div>
            <div class="col col-5">Nivel Académico</div>
          </li>
          <?php $resultadoDatos = mysqli_query($conexion, $sqlDatosProf);
        while ($row = mysqli_fetch_assoc($resultadoDatos)) { ?>
          <li class="table-row">
            <div class="col col-1" data-label="Matricula"><?php echo $row["Matricula_Profesor"]; ?></div>
            <div class="col col-2" data-label="Nombre"><?php echo $row["ApellidoP"];?> <?php echo $row["ApellidoM"];?>
              <?php echo $row["Nombre"]; ?></div>
            <div class="col col-3" data-label="Email"><?php echo $row["Email"]; ?></div>
            <div class="col col-5" data-label="Nivel Académico"><?php echo $row["Nombre_nivel"]; ?></div>
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
        <form action="../opciones/agregar_prof.php" method="post" class="formulario">
          <h1>Agregar profesor</h1>
          <h4>Matricula:</h4>
          <input type="text" placeholder="Matricula" name="matricula" class="campo-llenar">
          <h4>Apellido paterno:</h4>
          <input type="text" placeholder="Arias" name="apellidop" class="campo-llenar">
          <h4>Apellido materno:</h4>
          <input type="text" placeholder="Morales" name="apellidom" class="campo-llenar">
          <h4>Nombre completo:</h4>
          <input type="text" placeholder="Adry Moisés" name="nombre" class="campo-llenar">
          <h4>Edad:</h4>
          <input type="text" placeholder="21" name="edad" class="campo-llenar">
          <h4>Email:</h4>
          <input type="text" placeholder="ejemplo@email.com" name="email" class="campo-llenar">
          <h4>Nivel académico:</h4>
          <select id="nivel" name="nivel" class="campo-llenar">
            <option value="">Seleccione el nivel</option>
            <?php
                      while ($dataSelectNivel = mysqli_fetch_array($dataNivelAca)) { 
                        $idn=$dataSelectNivel["idNivel_Academico"];
                        ?>
            <option value="<?php echo $idn?>">
              <?php 
                          echo $dataSelectNivel["Nombre_nivel"];
                          ?>
            </option>
            <?php 
                  } ?>
          </select>
          <!--categoria se pondra en el action-->
          <br>
          <input type="submit" value="Ingresar" class="descarga">
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
      <form action="../opciones/editar_prof.php" method="post" class="formulario">
        <h1>Editar profesor</h1>
        <h4>Matricula:</h4>
        <select id="matricula" name="matricula" class="campo-llenar" onchange="updateInputValue()">
          <option value="">Seleccione la matricula</option>
          <?php
                      while ($dataSelectProf = mysqli_fetch_array($dataProf)) { 
                        $ida=$dataSelectProf["Matricula_Profesor"];
                        ?>
          <option value="<?php echo $ida?>">
            <?php 
                          echo $dataSelectProf["Matricula_Profesor"];
                          ?>
          </option>
          <?php 
                  } ?>
        </select>
        <h4>Apellido paterno:</h4>
        <input type="text" placeholder="Arias" name="apellidop" class="campo-llenar" id="ApellidoPaterno">
        <h4>Apellido materno:</h4>
        <input type="text" placeholder="Morales" name="apellidom" class="campo-llenar" id="ApellidoMaterno">
        <h4>Nombre completo:</h4>
        <input type="text" placeholder="Adry Moisés" name="nombre" class="campo-llenar" id="NombreCompleto">
        <h4>Edad:</h4>
        <input type=" text" placeholder="21" name="edad" class="campo-llenar" id="Edad">
        <h4>Email:</h4>
        <input type="text" placeholder="ejemplo@email.com" name="email" class="campo-llenar" id="Email">
        <h4>Nivel académico:</h4>
        <select id="nivel" name="nivel" class="campo-llenar">
          <option value="">Seleccione el nivel</option>
          <?php
                      while ($dataSelectNivel2 = mysqli_fetch_array($dataNivelAca2)) { 
                        $idn=$dataSelectNivel2["idNivel_Academico"];
                        ?>
          <option value="<?php echo $idn?>">
            <?php 
                          echo $dataSelectNivel2["Nombre_nivel"];
                          ?>
          </option>
          <?php 
                  } ?>
        </select>
        <!--categoria se pondra en el action-->
        <br>
        <input type="submit" value="Editar" class="descarga">
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
      <form action="../opciones/eliminar_prof.php" method="post" class="formulario">
        <h1>Eliminar profesores</h1>
        <h4>Matricula:</h4>
        <select id="matricula" name="matricula" class="campo-llenar">
          <option value="">Seleccione la matricula</option>
          <?php
                      while ($dataSelectProf = mysqli_fetch_array($dataProf2)) { 
                        $ida=$dataSelectProf["Matricula_Profesor"];
                        ?>
          <option value="<?php echo $ida?>">
            <?php 
                          echo $dataSelectProf["Matricula_Profesor"];
                          ?>
          </option>
          <?php 
                  } ?>
        </select>

        <br>
        <input type="submit" value="Eliminar" class="descarga">
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

  <script>
  function updateInputValue() {
    let matricula = document.getElementById("matricula");
    let selectedOption = matricula.options[matricula.selectedIndex];
    let matriculaValue = selectedOption.value;

    <?php 
      mysqli_data_seek($dataProf, 0);
      while ($dataSelectProf= mysqli_fetch_array($dataProf)) { 
    ?>
    if (matriculaValue === "<?php echo $dataSelectProf["Matricula_Profesor"]; ?>") {
      document.getElementById("ApellidoPaterno").value = "<?php echo $dataSelectProf["ApellidoP"]; ?>";
      document.getElementById("ApellidoMaterno").value = "<?php echo $dataSelectProf["ApellidoM"]; ?>";
      document.getElementById("NombreCompleto").value = "<?php echo $dataSelectProf["Nombre"]; ?>";
      document.getElementById("Edad").value = "<?php echo $dataSelectProf["Edad"]; ?>";
      document.getElementById("Email").value = "<?php echo $dataSelectProf["Email"]; ?>";
    }
    <?php
      }
    ?>
  }
  </script>
</body>

</html>