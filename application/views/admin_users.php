<html>
<body>
<div>
	<?php if(isset($message)) echo $message; ?>
</div>
<form id="form" action="<?php echo base_url().'administracion/admin_register_user';?>" method="post"/>
	<?php echo validation_errors(); ?>
Usuario:<br>
<input type="text" name="username" placeholder="Usuario" required/><br>
Contraseña:<br>
<input type="password" name="password" placeholder="Contraseña" required/><br>
Nombre:<br>
<input type="text" name="nombre" placeholder="nombre" required/><br>
Apellido Paterno:<br>
<input type="text" name="apellido_paterno" placeholder="apellido_paterno" required/><br>
Apellido Materno:<br>
<input type="text" name="apellido_materno" placeholder="apellido_materno" required/><br>
Plantel del usuario: <br>
<select form="form" name="plantel" required>
	<option value="1">Oruga Mochicahui</option>
	<option value="2">Oruga Centenario</option>
	<option value="3">Oruga Palos Verdes</option>
</select><br><br>
Privilegios de Administrador: 
<input type="checkbox" name="privilegios"/><br><br>
<input type="submit" name="enviar" value="Registrar"/>
</form>
</body>
</html>