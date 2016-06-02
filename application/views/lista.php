<HTML>
<HEAD>
<style>
.tabla{
	background-color:white;
	text-align:center;
	width:800px;
}
.mayor{
	border-collapse:collapse;
	border: orange 4px solid;
	
}
.menor{
	border-collapse:collapse;
	background:red;
}
.table
	display:table;
}
.title{
	display:table-caption;
	text-aling:center;
	font-weight:bold;
	font-size:larger;
}
.heading{
	display:table-row;
	font-weight:bold;
	text-aling:center;
}
.row{
	display:table-row;
}
.cell{
	display:table-cell;
	border:solid;
	border-width:thin;
	padding-left:5px;
	padding-right:5px;
}
	.dos{display:line-block;width:800px;text-align:left;border-style:solid;border-width: 1px;}
		.datos{border-style:solid;border-width: 1px;}
			.a{display:inline-block;width:34%;text-align:left;}
		.b{display:inline-block;width:65%;text-align:center;}	 

.dia{
	width:18px;
}
</style>
<title>Lista Alumnos</title>
</HEAD>
<BODY>
	<?php if(isset($message)) echo $message; ?>
<div class="dos">
				<?php 
					$curso="";
					$grupo="";
					if(isset($lista)){
						$curso=$lista[0]['curso'];
						$grupo=$lista[0]['grupo'];
					}
				?>
				<div class="a">
				<div class="datos">Asignatura: <?php echo $curso; ?></div>
				<div class="datos">Profesor: </div>
				<div class="datos">Grupo: <?php echo $grupo; ?></div>			
				</div>
				<div class="b" id="ss">
				Asistencia
				</div>
			</div>
<table border="1" cellpadding="0" cellspacing="0" class="tabla">
	<tr>
		<th> No. </th>
		<th> Nombre del Participante </th>
		<th> Clave </th>
		<th class="dia">S</th>
		<th class="dia">L</th>
		<th class="dia">M</th>
		<th class="dia">X</th>
		<th class="dia">J</th>
		<th class="dia">V</th>
		<th class="dia">S</th>
		<th class="dia">L</th>
		<th class="dia">M</th>
		<th class="dia">X</th>
		<th class="dia">J</th>
		<th class="dia">V</th>
		<th class="dia">S</th>
		<th class="dia">L</th>
		<th class="dia">M</th>
		<th class="dia">X</th>
		<th class="dia"></th>
		<th class="dia"></th>
		<th class="dia"></th>
		<th>Calificaciones</th>
		
	</tr>
	<?php
	for($i=0;$i<40;$i++){
		$folio="";
		$nombre="";
		if(isset($lista)&&count($lista)>$i){
			$folio=$lista[$i]['folio'];
			$nombre=$lista[$i]['nombre'];
		}
		echo '<tr>
				<td>'.($i+1).'</td>
				<td>'.$nombre.'</td>
				<td>'.$folio.'</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>';
		}
	?>
</table>

	

</BODY>
</HTML>
