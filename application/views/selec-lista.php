<table>
	<thead>
		<tr>
			<th>Plantel</th>
			<th>Grupo</th>
			<th>Listas</th>
		</tr>
	</thead>
	<tbody>
		<?php
			if(isset($grupos)){
				foreach ($grupos as $row) {
					echo '<tr>
					<td>'.$row["plantel"].'</td>
					<td>'.$row["nombre"].'</td>
					<td><button class="btn_lista" value="'.$row["id_grupo"].'">Lista</button></td>
					</tr>';
				}
			}
		?>
	</tbody>
</table>
<form id="form" action="<?php echo base_url().'administracion/imp_lista';?>" method="post" target="_blank">
	<input type="hidden" id="hddn_id_grupo" name="id_grupo" value=""/>
</form>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".btn_lista").click(function(event) {
			event.preventDefault();
			var val=$(this).val();
			$("#hddn_id_grupo").val($(this).val());
			$("#form").submit();
		});
	});
</script>