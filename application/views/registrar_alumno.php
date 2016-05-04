<form id="form" method="post" action="<?php echo base_url(); ?>administracion/registrar_alumno">
	<?php echo validation_errors(); ?>
	<?php if(isset($message)) echo $message."<br>"; ?>
	<select form="form" name="id_plantel" required>
		<option value="1">Oruga Mochicahui</option>
		<option value="2">Oruga Centenario</option>
		<option value="3">Oruga Palos Verdes</option>
		<option value="4">Induccion Secundaria Mochis</option>
		<option value="5">Induccion Secundaria Higuera</option>
		<option value="6">Mate Básico</option>
	</select><br>
	<input type="text" name="nombre" placeholder="Nombre del niño" required/><br>
	<input type="text" name="apellido_paterno" placeholder="Apellido Paterno" required/><br>
	<input type="text" name="apellido_materno" placeholder="Apellido Materno" required/><br>
	<input type="date" name="fecha_nac" required/><br>
	<input type="text" name="escuela" placeholder="Escuela donde estudia" required/><br>
	<input type="text" name="pad_nombre" placeholder="Nombre del Padre" required/><br>
	<input type="text" name="pad_apellido_p" placeholder="Apellido Paterno del Padre" required/><br>
	<input type="text" name="pad_apellido_m" placeholder="Apellido Materno de la Madre" required/><br>
	<input type="text" name="domicilio" placeholder="Domicilio" required/>
	<input type="email" name="correo" placeholder="Correo electronico" required/>
	<input type="number" name="telefono" placeholder="Numero de telefono" required/>
	<select form="form" name="id_nivel" required>
		<option disabled>Preescolar</option>
		<option value="1">1ro</option>
		<option value="2">2do</option>
		<option value="3">3ro</option>
		<option disabled>Primaria</option>
		<option value="4">1ro</option>
		<option value="5">2do</option>
		<option value="6">3ro</option>
		<option value="7">4to</option>
		<option value="8">5to</option>
		<option value="9">6to</option>
		<option disabled>Secundaria</option>
		<option value="10">1ro</option>
		<option value="11">2do</option>
		<option value="12">3ro</option>
	</select>
	<br>
	//Aqui tenemos que mostrar solamente del 1 al 11 si selecciona cualquiera menos 6to o mate basico<br>
	//si selecciona 6to mostramos del 13 al 15<br>
	//y si selecciona mates basicas automaticamente se selecciona mate basico y no deja cambiar<br>
	<select form="form" name="id_programa" required>
		<option value="1">Artes Plasticas 4-7 años</option>
		<option value="2">Pintura 4-7 años</option>
		<option value="3">Ajedrez</option>
		<option value="4">Regularizacion Escolar</option>
		<option value="5">Baile 4-7 años</option>
		<option value="6">Karate Lima-Lama 6-12 años</option>
		<option value="7">Artes Plasticas 8-13 años</option>
		<option value="8">Pintura 8-13 años</option>
		<option value="9">Lecto-Escritura</option>
		<option value="10">Música 6-13 años</option>
		<option value="11">Baile 8-13 años</option>
		<option value="12">Danza Induccion</option>
		<option value="13">Artes Plásticas Inducción</option>
		<option value="14">Artes Marciales Induccion</option>
		<option value="15">Urgencias Médicas Induccion</option>
		<option value="16">Mate Básico</option>
	</select>
	<br>
	//esto solo se mostrara en caso de seleccionar 6to<br>
	<input type="text" name="secundaria" placeholder="Secundaria a ingresar" /><br>
	//aqui falta meter realmente los id de los grupos y los registrados que hay actualmente en cada uno dependiendo el taller<br>
	//tambien mostraremos unicamente los grupos dependiendo el plantel y o si son de 6to o mate basica
	<select form="form" name="id_grupo" required>
		<option value="1">Grupo 1</option>
		<option value="2">Grupo 2</option>
		<option value="3">Grupo 3</option>
	</select>
	<br>
	//aqui ira un boton para agregar grupo el cual funcionara con ajax, para no recargar la pagina
	<select form="form" name="id_talla" required>
		<option value="1">Chica Niño</option>
		<option value="2">Mediana Niño</option>
		<option value="3">Grande Niño</option>
		<option value="4">Chica</option>
		<option value="5">Mediana</option>
		<option value="6">Grande</option>
		<option value="7">Extra Grande</option>
	</select>
	<select form="form" name="id_entero" required>
		<option value="1">Escuela</option>
		<option value="2">Medios de Comunicacion</option>
		<option value="3">Patronato Pro-Educacion</option>
		<option value="4">Otros</option>
	</select><br>
	<input type="text" name="entero" placeholder="Otros"/><br><br>
	<input type="submit" name="enviar" value="Registrar"/>
</form>