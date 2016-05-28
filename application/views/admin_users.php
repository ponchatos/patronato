<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="<?php echo base_url();?>css/styles.css" rel='stylesheet' type='text/css' />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!--webfonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text.css'/>
    <!--//webfonts-->
</head>
<body>
  <div class="main">
    <div class="header" >
      <h1>REGISTRO DE CUENTAS DE USUARIO</h1>
    </div>
    <p>Llena todos los campos en su totalidad.</p>
      <form id="form" action="<?php echo base_url().'administracion/admin_register_user';?>" method="post">
      	<?php echo validation_errors(); ?>
        <ul class="left-form">
          <?php if(isset($message)) echo "<div style='color:red;font-weight:bold;'>".$message."</div>"; ?>
          <h2>Perfil:</h2>
          <li>
            <input type="text"   name="username" placeholder="Nombre se Usuario" required/>
            <div class="clear"> </div>
          </li> 
          <li>
            <input type="password"  name="password" placeholder="Contraseña" required/>
            <div class="clear"> </div>
          </li>
          <h2>Datos Personales:</h2>
         <li>
            <input type="text"  name="nombre" placeholder="Nombres" required/>
            <div class="clear"> </div>
          </li> 
           <li>
            <input type="text"  name="apellido_paterno" placeholder="Apellido Paterno" required/>
            <div class="clear"> </div>
          </li> 
          <li>
            <input type="text"  name="apellido_materno" placeholder="Apellido Materno" required/>
            <div class="clear"> </div>
          </li> 
           <h2>Plantel del usuario: </h2>
			<select form="form" name="plantel" required>
				<option value="1">Oruga Mochicahui</option>
				<option value="2">Oruga Centenario</option>
				<option value="3">Oruga Palos Verdes</option>
			</select><br><br>
  
          <label class="checkbox"><input type="checkbox" name="privilegios"><i></i>¿Otorgar permisos de Administrador?</label>
          <br>
          <input type="submit" name="enviar" value="Crear Usuario">
            <div class="clear"> </div>
        </ul>
        <ul class="right-form">
				   <h3>Usuarios:</h3>
		
				<?php if(isset($usuarios)){
						echo "
						<table>
							<tr>
								<th>USUARIO</th>
								<th>APELLIDOS</th>
								<th>PLANTEL</th>
                <th>PRIVILEGIOS</th>
								<th>ELIMINAR</th>
							</tr>";
						foreach ($usuarios as $key ) {
							echo "<tr>";
							echo "<td>".$key['usuario']."</td>";
							echo "<td>".$key['apellido']."</td>";
							echo "<td>".$key['plantel']."</td>";
              $priv="";
              if($key['privilegios']==99){
                $priv="Administrador";
              }
              echo "<td>".$priv."</td>";
							echo "<td></td></tr>";
						}
						echo "</table>";
					}?>

          <div class="clear"> </div>
        </ul>
        <div class="clear"> </div>
          
      </form>
      
    </div>
      <!-----start-copyright---->
            <div class="copy-right">
          
          </div>
        <!-----//end-copyright---->

  
</body>
</html>