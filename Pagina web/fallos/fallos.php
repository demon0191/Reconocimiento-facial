<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Fallos</title>

  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="../css/estilo_fallos.css" rel="stylesheet" />
  <link href="../css/estilo.css" rel="stylesheet" />
  <link rel="shortcut icon" href="../img/logo_dacb.png" />
</head>

<body>
  <div class="header">

    <a href="../index.html" class="logo">Laboratorio DACB</a>
    <div class="header-right">
      <a class="active" href="../administrador/login_admin.php">Administrador</a>
      <a href="../profesores/login_profesores.php">Profesores</a>
      <a href="../ayuda/ayuda.php">Ayuda</a>
      <a href="../ayuda/acerca_de.php">Acerca de</a>
    </div>
  </div>
  <!-- Comentario section-->
  <form method="POST" action="enviar_comentario.php">
    <section id="contact">
      <div class="container px-4">
        <div class="row gx-4 justify-content-center">
          <div class="col-lg-8">
            <h2>Quejas y sugerencias</h2>
            <br>
            <br>

            <div class="col-xs-12">
              <h3>¡Reporta un fallo!</h3>

              <br>
              <div class="form-group">
                <label for="nombre" class="form-label">Asunto</label>
                <input class="form-control" name="Asunto" type="text" id="nombre" placeholder="Escribe el asunto"
                  required>
              </div>


              <br>
              <div class="form-group">
                <label for="comentario" class="form-label">Fallo:</label>
                <textarea class="form-control" name="descripcion" cols="30" rows="5" type="text" id="comentario"
                  placeholder="Escribe tu queja o sugerencia"></textarea>
              </div>
              <br>
              <center><input class="btn btn-primary" type="submit" value="Reportar fallo"></center>
              <br>
              <br>
              <br>


  </form>

  </div>

  </section>

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
                  <div class="thumb-content"><a href="fallos.php">Fallo</a></div>
                </li>
              </ul>
              <p><a href="mailto:adrymoises.arias.morales@gmail.com"
                  title="glorythemes">adrymoises.arias.morales@gmail.com</a></p>
  </footer>


</body>

</html>