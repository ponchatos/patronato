<html>
<body>
	<form action="<?php echo base_url().'administracion/get_grupos';?>" method="POST">
		<input type="text" name="id_plantel" placeholder="id plantel"/>
		<input type="text" name="nombre" placeholder="nombre"/>
		<input type="submit" value="Enviar"/>
	</from>
</body>
</html>