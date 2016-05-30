<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<style type="text/css">
	/* The Modal (background) */
	.modal {
	    display: none; /* Hidden by default */
	    position: fixed; /* Stay in place */
	    z-index: 1; /* Sit on top */
	    left: 0;
	    top: 0;
	    width: 100%; /* Full width */
	    height: 100%; /* Full height */
	    overflow: auto; /* Enable scroll if needed */
	    background-color: rgb(0,0,0); /* Fallback color */
	    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
	}

	/* Modal Content/Box */
	.modal-content {
	    background-color: #fefefe;
	    margin: 15% auto; /* 15% from the top and centered */
	    padding: 0px;
	    border: 1px solid #888;
	    width: 80%; /* Could be more or less, depending on screen size */
	    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
	    -webkit-animation-name: animatetop;
	    -webkit-animation-duration: 0.4s;
	    animation-name: animatetop;
	    animation-duration: 0.4s
	}

	/* The Close Button */
	.close {
	    color: black;
	    float: right;
	    font-size: 28px;
	    font-weight: bold;
	}

	.close:hover,
	.close:focus {
	    color: black;
	    text-decoration: none;
	    cursor: pointer;
	}

	/* Modal Header */
	.modal-header {
	    padding: 2px 16px;
	    background-color: #5cb85c;
	    color: white;
	}

	/* Modal Body */
	.modal-body {padding: 2px 16px;}

	/* Modal Footer */
	.modal-footer {
	    padding: 2px 16px;
	    background-color: #5cb85c;
	    color: white;
	}


	/* Add Animation */
	@-webkit-keyframes animatetop {
	    from {top: -300px; opacity: 0} 
	    to {top: 0; opacity: 1}
	}

	@keyframes animatetop {
	    from {top: -300px; opacity: 0}
	    to {top: 0; opacity: 1}
	}

	/* Tooltip container */
	.toolclass {
	    background-color: red !important;
	    //border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
	}

	/* Tooltip text */
	.tooltipp .tooltiptext {
	    visibility: hidden;
	    width: 120px;
	    background-color: #555;
	    color: #fff;
	    text-align: center;
	    padding: 5px 0;
	    border-radius: 6px;

	    /* Position the tooltip text */
	    position: absolute;
	    z-index: 1;
	    bottom: 125%;
	    left: 50%;
	    margin-left: -60px;

	    /* Fade in tooltip */
	    opacity: 0;
	    transition: opacity 1s;
	}

	/* Tooltip arrow */
	.tooltipp .tooltiptext::after {
	    content: "";
	    position: absolute;
	    top: 100%;
	    left: 50%;
	    margin-left: -5px;
	    border-width: 5px;
	    border-style: solid;
	    border-color: #555 transparent transparent transparent;
	}

	/* Show the tooltip text when you mouse over the tooltip container */
	.tooltipp:hover .tooltiptext {
	    visibility: visible;
	    opacity: 1;
	}

</style>
<form id="form" method="post" action="<?php echo base_url(); ?>administracion/registrar_alumno">
	<?php echo validation_errors(); ?>
	<?php if(isset($message)) echo $message."<br>"; ?>
	<?php if($this->session->flashdata("success") != FALSE) echo $this->session->flashdata("success")['message']; ?>
	<div id="inputs">
		<select form="form" id="id_plantel" name="id_plantel" required>
			<option disabled selected value>Seleccione un plantel</option>
			<?php
				if(isset($planteles))
					foreach ($planteles as $row) {
						echo '<option value="'.$row['id_plantel'].'">'.$row['nombre'].'</option>';
					}
			?>
		</select><br><br><br>
		
		<input title="Ingrese el nombre del niño" type="text" name="nombre" placeholder="Nombre del niño" required/><br>
		<input title="Ingrese el apellido paterno del niño" type="text" name="apellido_paterno" placeholder="Apellido Paterno" required/><br>
		<input title="Ingrese el apellido materno del niño" type="text" name="apellido_materno" placeholder="Apellido Materno" required/><br>
		<input type="date" name="fecha_nac" required/><br>
		<input type="text" name="escuela" placeholder="Escuela donde estudia" required/><br>
		<input type="text" name="pad_nombre" placeholder="Nombre del Padre" required/><br>
		<input type="text" name="pad_apellido_p" placeholder="Apellido Paterno del Padre" required/><br>
		<input type="text" name="pad_apellido_m" placeholder="Apellido Materno de la Madre" required/><br>
		<input type="text" name="domicilio" placeholder="Domicilio" required/><br>
		<input type="email" name="correo" placeholder="Correo electrónico" required/><br>
		<input type="number" name="telefono" placeholder="Número de Teléfono" required/>
		<input type="number" name="telefonocel" placeholder="Número Celular" required/>
		<input type="number" name="telefonotrabajo" placeholder="Número Teléfono de Trabajo" required/>
		<select form="form" id="id_nivel" name="id_nivel" required>
			<option disabled selected value>Seleccione el grado</option>
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
		<input id="hddn_id_nivel" type="hidden" name="id_nivel" disabled/>
		<br>
		//Aqui tenemos que mostrar solamente del 1 al 11 si selecciona cualquiera menos 6to o mate basico<br>
		//si selecciona 6to mostramos del 13 al 15<br>
		//y si selecciona mates basicas automaticamente se selecciona mate basico y no deja cambiar<br>
		<select form="form" id="id_programa" name="id_programa" required>
			<option disabled selected value>Seleccione el programa</option>
			<?php
				if(isset($programas))
					foreach ($programas as $row) {
						echo '<option value="'.$row['id_programa'].'">'.$row['nombre'].'</option>';
					}
			?>
		</select>
		<input id="hddn_id_programa" type="hidden" name="id_programa" disabled/>
		<br>
		//esto solo se mostrara en caso de seleccionar 6to<br>
		<input type="text" id="input_secundaria" name="secundaria" placeholder="Secundaria a ingresar" /><br>
		//aqui falta meter realmente los id de los grupos y los registrados que hay actualmente en cada uno dependiendo el taller<br>
		//tambien mostraremos unicamente los grupos dependiendo el plantel y o si son de 6to o mate basica
		<select form="form" id="id_grupo" name="id_grupo" required>
			<option disabled selected value>Seleccione un Grupo</option>
			<option disabled value>Seleccione Plantel primeramente</option>
		</select>
		<button id="myBtn">Agregar Grupo</button>
		<br>
		//aqui ira un boton para agregar grupo el cual funcionara con ajax, para no recargar la pagina
		<select form="form" name="id_talla" required>
			<?php
				if(isset($tallas))
					foreach ($tallas as $row) {
						echo '<option value="'.$row['id_talla'].'">'.$row['talla'].'</option>';
					}
			?>
		</select>
		<select form="form" id="id_entero" name="id_entero" required>
			<?php
				if(isset($como_entero))
					foreach ($como_entero as $row) {
						echo '<option value="'.$row['id_entero'].'">'.$row['nombre'].'</option>';
					}
			?>
		</select><br>
		<input type="text" id="input_entero" name="entero" placeholder="Otros"/>
		<br><br>
		<input type="number" name="costo" placeholder="Costo $$"/>
		<br><br>
		<input type="submit" name="enviar" value="Registrar">
	</div>
</form>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
    <span class="close">×</span>
    <h2>Agregar Grupo</h2>
  </div>
  <div class="modal-body">
  	<div id="modal_message" style="color:red;font-weight:bold;"></div>
  	<select id="modal_plantel">
	  	<option disabled selected value>Seleccione el plantel</option>
	  	<?php
			if(isset($planteles))
				foreach ($planteles as $row) {
					echo '<option value="'.$row['id_plantel'].'">'.$row['nombre'].'</option>';
				}
		?>
	</select>
	<input type="text" id="nombre_grupo" name="nombre_grupo" placeholder="Nombre"/>
	<button id="add_grupo">Agregar Grupo</button>
  </div>
  <!--<div class="modal-footer">
    <h3>Modal Footer</h3>
  </div>-->
  </div>
  <?php 
  	if($this->session->flashdata("success") != FALSE){
  		echo '<form id="folio_form" action="'.base_url().'pdf_creator/recibo_pdf" method="post" target="_blank">
  			<input type="hidden" name="folio" value="'.$this->session->flashdata("success")['folio'].'"/>
  		</form>';
  	}
  ?>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">
 $(function() {
  
    // Call the documents tooltip function
    // This will find all the input elements and
    // add their titles to the Tooltip
    $( document ).tooltip();
    
  });
</script>
<script type="text/javascript">
		// Ajax post
		$(document).ready(function() {

			var nivel_changed = false;
			$("#input_secundaria").hide();
			$("#input_entero").hide();


			<?php
				if($this->session->flashdata("success") != FALSE)
					echo '$( "#folio_form" ).submit();';
			?>
			$("#id_entero").change(function() {
				if($("#id_entero option:selected").text().search('Otros')>=0){
					$("#input_entero").show();
				}else{
					$("#input_entero").hide();
				}
			});


			$("#id_plantel").change(function() {
				event.preventDefault();
				var plantel_selected = $("select#id_plantel").val();
				var nombre_plantel_selected = $("#id_plantel option:selected").text();
				if(nombre_plantel_selected.search("Mate Básico")>=0){
					$('select#id_programa').find('option').each(function() {
					    if($(this).text()=="Mate Básico"){
					    	$("#id_programa").val($(this).val());
					    	$("#id_programa").prop('disabled', true);
					    	$("#hddn_id_programa").val($(this).val());
					    	$("#hddn_id_programa").prop('disabled', false);
					    }
					});
				}else{
					$("#id_programa").val('');
					$("#id_programa").prop('disabled', false);
					$("#hddn_id_programa").val('');
					$("#hddn_id_programa").prop('disabled', true);
				}
				if(nombre_plantel_selected.search('Inducción')>=0){
					$("#id_programa").html('<option disabled selected value>Seleccione el programa</option>');
					var str = '<?php if(isset($programas))
						foreach ($programas as $row) {
							if($row['tipo']==2)
								echo '<option value="'.$row['id_programa'].'">'.$row['nombre'].'</option>';
						}
						?>';
					$("#id_programa").append(str);
					nivel_changed=true;
					$("select#id_nivel").val(9);
					$("select#id_nivel").prop('disabled', true);
					$("#hddn_id_nivel").val(9);
					$("#hddn_id_nivel").prop('disabled', false);
					$("#input_secundaria").show();
				}else if(nivel_changed){
					$("#id_programa").html('<option disabled selected value>Seleccione el programa</option>');
					var str = '<?php if(isset($programas))
					foreach ($programas as $row) {
							echo '<option value="'.$row['id_programa'].'">'.$row['nombre'].'</option>';
					}
					?>';
					$("#id_programa").append(str);
					nivel_changed=false;
					$("select#id_nivel").val('');
					$("select#id_nivel").prop('disabled', false);
					$("#hddn_id_nivel").val('');
					$("#hddn_id_nivel").prop('disabled', true);
					$("#input_secundaria").hide();
				}
				
				jQuery.ajax({
					type: "POST",
					url: "http://<?php echo $_SERVER['SERVER_NAME']; ?>/patronato/administracion/get_grupos",
					dataType: 'json',
					data: {id_plantel:plantel_selected},
					success: function(res) {
					if (res)
					{
						if(res[0]['success']==1){
							$("#id_grupo").html('<option disabled selected value>Seleccione un Grupo</option>');
							for(var i=1;i<res.length;i++){
								$("#id_grupo").append($('<option>',{
									value:res[i]['id_grupo'],
									text: res[i]['nombre']+" - "+nombre_plantel_selected+" "+res[i]['cantidad']+" alumnos"
								}));
							}
						}else{
							$("#id_grupo").html('<option disabled selected value>Seleccione un Grupo</option><option disabled value>Agrege un grupo</option>');
						}
					}
					}
				});
			});
			$("#myBtn").click(function(event) {
				event.preventDefault();
				var plantel_selected = $("select#id_plantel").val();
				$("select#modal_plantel").val(plantel_selected);
			});
			$("#add_grupo").click(function(event){
				event.preventDefault();
				var plantel_selected = $("select#modal_plantel").val();
				var nombre_plantel_selected = $("#modal_plantel option:selected").text();
				var nombre_grupo = $("#nombre_grupo").val();
				var validacion=true;
				$('#modal_message').html("");
				if(plantel_selected==""){
					$('#modal_message').append("<p>Debes seleccionar un plantel</p>");
					validacion=false;
					$("#modal_plantel").focus();
				}
				if(nombre_grupo.trim()==""){
					$('#modal_message').append("<p>El campo nombre no puede estar vacio</p>");
					validacion=false;
					$("#nombre_grupo").focus();
				}
				if(validacion){
					jQuery.ajax({
						type: "POST",
						url: "http://<?php echo $_SERVER['SERVER_NAME']; ?>/patronato/administracion/add_grupo",
						dataType: 'json',
						data: {id_plantel:plantel_selected,nombre:nombre_grupo},
						success: function(res) {
						if (res)
						{
							if(res[0]['success']==1){
								$("#id_grupo").append($('<option>',{
								 value:res[1]['id_grupo'],
								 text: nombre_grupo+" - "+nombre_plantel_selected
								}));
								$("#myModal").hide();
								$("#id_grupo").val(res[1]['id_grupo']);
							}else{
								$('#modal_message').append("<p>"+res[0]['message']+"</p>");
							}
						}
						}
					});
				}
			});
		});
</script>
<script type="text/javascript">
	// Get the modal
	var modal = document.getElementById('myModal');

	// Get the button that opens the modal
	var btn = document.getElementById("myBtn");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks on the button, open the modal 
	btn.onclick = function() {
	    modal.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	    modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	    if (event.target == modal) {
	        modal.style.display = "none";
	    }
	}
</script>