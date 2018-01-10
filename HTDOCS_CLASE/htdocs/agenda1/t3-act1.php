
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php

			require_once( 'php/agenda.inc.php' );

		?>
		<meta charset="UTF-8">
		<title>t3-act1.php</title>
	</head>
	<body>
		<?php

			$agenda = new Agenda();
			$agenda ->aniadir(20,"Sergio","SALT","MOYA",666318028);
			echo $agenda;

		?>
	</body>
</html>