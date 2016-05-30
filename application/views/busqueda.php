	<style>
		tr.folio.odd:hover,tr.folio.even:hover {
		    background-color: #FF9696;
		    cursor: pointer;
		}
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
	</style>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			var table=$('#tabla_busqueda').DataTable({
				"destroy":true,
			    "pageLength": 50,
			    "autoWidth": false
			});
			for(var i=9;i<=17;i++){
				// Get the column API object
		        var column = table.column(i);
		 
		        // Toggle the visibility
		        column.visible(false);
			}
			$("#boton").click(function(event) {
				event.preventDefault();
				$(".fr").hide();
			});
			$('a.toggle-vis').on( 'click', function (e) {
		        e.preventDefault();
		 		if($(this).attr('data-column')=="0"){
		 			var column;
		 			for(var i=1;i<=8;i++){
		 				//alert(i);
		 				// Get the column API object
				        column = table.column(i);
				 
				        // Toggle the visibility
				        column.visible(!column.visible() );
		 			}
		 			if(column.visible())
		 				$(this).text("Ocultar Datos de Alumno");
		 			else
		 				$(this).text("Mostrar Datos de Alumno");
		 		}else if($(this).attr('data-column')=="1"){
		 			var column;
		 			for(var i=9;i<=17;i++){
		 				//alert(i);
		 				// Get the column API object
				        column = table.column(i);
				 
				        // Toggle the visibility
				        column.visible(!column.visible() );
		 			}
		 			if(column.visible())
		 				$(this).text("Ocultar Datos de Inscripción");
		 			else
		 				$(this).text("Mostrar Datos de Inscripción");
		 		}
		    } );

		    $('.folio').on( 'click',function (e) {
		    	var folio=$(this).children('td:nth-child(1)').text();
		    	$('#hddn_recibo').val(folio);
		    	$('#hddn_credencial').val(folio);
		    	$('#myModal').show();
		    });
		    $('.close').on('click',function(e){
		    	$('#myModal').hide();
		    });
		    var modal = document.getElementById('myModal');
			window.onclick = function(event) {
				    if (event.target == modal) {
				        modal.style.display = "none";
				    }
				}
		});
	</script>
	<link rel="stylesheet" href="<?php echo base_url();?>css/w3.css">
	<br><br><br>
	<a class="toggle-vis" data-column="0">Ocultar Datos del Alumno</a><br>
	<a class="toggle-vis" data-column="1">Mostrar Datos de Inscripción</a>
	<div class="w3-responsive" id="busqueda">
		<table class="w3-table w3-striped w3-bordered w3-border w3-animate-left" id="tabla_busqueda">
			<thead>
				<tr class="w3-orange">
					<th>Folio</th>
					<th>Nombre</th>
					<th>Nombre del Tutor</th>
					<th>Domicilio</th>
					<th>Teléfono</th>
					<th>Celular</th>
					<th>T. Trabajo</th>
					<th>Escuela</th>
					<th>Grado</th>
					<th>Plantel</th>
					<th>Curso</th>
					<th>Taller</th>
					<th>Grupo</th>
					<th>Turno</th>
					<th>¿Cómo se entero?</th>
					<th>Inscrito Por</th>
					<th>Precio</th>
					<th>Fecha Registro</th>
				</tr>
			</thead>
			<?php
				if(isset($datos_tabla)){
					foreach ($datos_tabla as $row) {
						echo '<tr class="folio">';
						echo '<td>'.$row['folio'].'</td>';
						echo '<td>'.$row['nombre'].'</td>';
						echo '<td>'.$row['nombre_tutor'].'</td>';
						echo '<td>'.$row['domicilio'].'</td>';
						echo '<td>'.$row['telefono'].'</td>';
						echo '<td>'.$row['celular'].'</td>';
						echo '<td>'.$row['t_trabajo'].'</td>';
						echo '<td>'.$row['escuela'].'</td>';
						echo '<td>'.$row['grado'].'</td>';
						echo '<td>'.$row['plantel'].'</td>';
						echo '<td>'.$row['curso'].'</td>';
						echo '<td>'.$row['taller'].'</td>';
						echo '<td>'.$row['grupo'].'</td>';
						echo '<td>'.$row['turno'].'</td>';
						echo '<td>'.$row['entero'].'</td>';
						echo '<td>'.$row['q_registro'].'</td>';
						echo '<td>'.$row['costo'].'</td>';
						echo '<td>'.$row['f_registro'].'</td>';
						echo '</tr>';
					}
				}
			?>
		</table>	
	</div>
	<div id="myModal" class="modal">

	  <!-- Modal content -->
	<div class="modal-content">
	    <div class="modal-header">
		    <span class="close">×</span>
		    <h2>Agregar Grupo</h2>
		</div>
	  	<div class="modal-body">
		  	<div id="modal_message" style="color:red;font-weight:bold;"></div>
		  	<div id="moda_text"></div>
		  	<form method="post" target="_blank" action="<?php echo base_url(); ?>pdf_creator/recibo_pdf">
		  		<input id="hddn_recibo" name="folio" type="hidden"/>
		  		<input id="submit_recibo" type="submit" value="Reimprimir Recibo"/>
		  	</form>
		  	<form method="post" target="_blank" action="<?php echo base_url(); ?>pdf_creator/credencial_pdf">
		  		<input id="hddn_credencial" name="folio" type="hidden"/>
		  		<input id="submit_credencial" type="submit" value="Reimprimir Credencial"/>
		  	</form>
		</div>
	</div>
	</div>
	<script src="<?php echo base_url();?>js/jquery-2.2.3.min.js"></script>
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
</body>
</html>