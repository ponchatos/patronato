<!DOCTYPE html>
<html>
  <?php
  if (isset($this->session->userdata['logged_in'])) {

    header("location: ".base_url()."administracion/");
  }?>

  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
    <title>Login</title>
  </head>

  <body>
    <div id="barra"></div>

  <div class="col-md-3 center-block quitar-float text-center espacioArriba">
    <img src="css/images/PATRONATO.jpg">
  </div>

  <div class="col-md-3 center-block quitar-float text-center espacioArriba">

    <form >

      <fieldset>
          <legend>Iniciar Sesión</legend>
              <label>Usuario:</label>
                  <input id="campo1" name="userName" type="text" /><br>
              <label>Contraseña:</label>
                  <input id="campo2" name="password" type="text" />
              <input id="campo3" name="enviar" type="submit" value="Enviar" />
      </fieldset>

  </form>
  </div>
    
  
      

    

  

</body>

</html>