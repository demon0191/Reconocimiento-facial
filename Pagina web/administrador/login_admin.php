<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Administrador</title>
  <meta name="viewport"
    content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">

  <link rel="stylesheet" href="../css/estilo_login.css" media="screen">
  <link rel="shortcut icon" href="../img/logo_dacb.png" />


</head>

<body>
  <div class="primero">
    <div class="segundo">
      <form action="../validaciones/validar_admin.php" method="post" class="formulario">
        <div class="barra"></div>
        <div class="logo">
          <center><img src="../img/logo_dacb.png" width="100px;" height="150px"></img></center>
        </div>
        <h1>Inicio de sesión</h1>
        <div class="contenedor">

          <div class="input-contenedor">

            <input type="text" placeholder="Matricula" name="matricula">

          </div>

          <div class="input-contenedor">

            <input type="password" placeholder="Contraseña" name="pass">

          </div>
          </br>
          <center>
            <a type="submit" value="Cancelar" class="button" href="../index.html">Cancelar</a>
            <input type="submit" value="Ingresar" class="button">
          </center>
        </div>
        <div class="barra"></div>
      </form>
    </div>
  </div>
</body>

</html>