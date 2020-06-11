<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1>Pagina de Respuesta</h1>

	<?php
	switch ($_GET["action"]) {
		case 'failure':
			echo "<h2>Tu pago al parecer a fallado</h2>";
			break;
		case 'pending':
			echo "<h2>Tu pago esta pendiente.</h2>";
			break;
		case 'failure':
			echo "<h2>Tu pago fue exitoso</h2>Información:";
			echo "<pre>";
			var_dump($_GET);
			echo "</pre>";
			break;
		
		default:
			# code...
			break;
	}

	?>

</body>
</html>