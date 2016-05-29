	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#tabla_busqueda').DataTable({
				"destroy":true,
			    "pageLength": 50
			});
		});
	</script>
	<link rel="stylesheet" href="<?php echo base_url();?>css/w3.css">
	<br><br><br>
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
						echo '<tr>';
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
	<script src="<?php echo base_url();?>js/jquery-2.2.3.min.js"></script>
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
</body>
</html>