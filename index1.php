


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Principal</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>

	<?php

		$opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
		try {

			$dwes = new PDO('mysql:host=localhost;dbname=blogdwes', 'userblog', 'passblog', $opc);
			
		} catch (PDOException $e) {
			echo 'Falló la conexión: ' . $e->getMessage();
		}
	

		

	?>
	



</body>
</html>