<html>
<body>
	<form action="<?php echo base_url().'pdf_creator/recibo_pdf';?>" target="_blank" method="POST">
		<input type="text" name="folio" placeholder="folio"/>
		<input type="text" name="nombre" placeholder="nombre"/>
		<input type="submit" value="Enviar"/>
	</from>
</body>
</html>