<html>
<?php
if (isset($this->session->userdata['logged_in'])) {

  header("location: ".base_url()."/administracion/");
}
?>
<head>
  <title>Login Form</title>
  <base href="/"/>
  <link rel="stylesheet" type="text/css" href="<?php echo '/LostCitiesSite/assets/css/bootstrap.min.css'?>" >
  <link rel="stylesheet" type="text/css" href="<?php echo '/LostCitiesSite/assets/css/css.css'?>" >
  <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
  <script src="<?php echo '/LostCitiesSite/assets/js/jquery.js'?>"></script>
  <script src="<?php echo '/LostCitiesSite/assets/js/bootstrap.min.js'?>"></script>
  <!--<script src="<?php //echo '/LostCitiesSite/assets/js/js.js'?>"></script>-->

</head>
<body>  
 <div class="container">
  
  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    
    <div class="col-md-4">
      <section class="login-form">
  <?php 
  $attr = array('role' => 'login');
    echo form_open('user_authentication/user_login_process',$attr); 
  if (isset($logout_message)) {
    echo "<div class='message'>";
    echo $logout_message;
    echo "</div>";
  }
  if (isset($x)) {
    echo "<div class='message'>";
    echo $message_display;
    echo "</div>";
  }
    
  ?>
  <?php
    echo "<div class='error_msg'>";
    if (isset($error_message)) {
      echo $error_message;
    }
    echo validation_errors();
    echo "</div>";
  ?>
  <!--Se crea un form donde se introduzca el username y la contraseña, se envía a la funcion user_login_process-->
  <img src="/LostCitiesSite/assets/img/LostCitiesLogo.png" class="img-responsive" alt="" />
  <input type="text" name="username" placeholder="Usuario" required class="form-control input-lg" />
  <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Password" required="" minlength="6"/>
  <button type="submit" name="submit" class="btn btn-lg btn-success btn-block">Ingresar</button>
  <div>
    <a href="/LostCitiesSite/user_authentication/user_registration_show">Crear Cuenta</a>
  </div>
  <?php echo form_close(); ?>
  <div class="form-links">
          <a href="<?php echo base_url()?>"><?php echo base_url() ?></a>
  </div>
  </section>
  </div>
  <div class="col-md-4"></div>
  </div>
  </div>

</body>
</html>