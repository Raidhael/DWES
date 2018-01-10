
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php

			require_once( 'agenda.inc.php' );

		?>
		<meta charset="UTF-8">
		<title>t3-act1.php</title>
	</head>
	<body>

		<form action="contacto_nuevo.php" method="POST">
			<label for ="nombre"> Nombre :  </label>
			<input type="text" name="nombre" placeholder="nombre"><br>
			<label for="ape1">1º apellido : </label>
			<input type="text" name="ape1" placeholder="apellido"><br>
			<label for="ape2">2nd Apellido : </label>
			<input type="text" name="ape2" placeholder="Segundo apellido"><br>
			<label for="telefono">Telefono : </label>
			<input type="text" name="telefono" placeholder="Telefono"><br>
			<input type="submit" name="registrar" value="Registrar">
			<input type="reset" value="reset">
		</form>
<?php


	$conexion = new mysqli('localhost','agenda','agenda','agenda');
	$consulta='SELECT * FROM contactos;';
	$verifi='SELECT count (*) FROM contactos;';
	$verificacion=$conexion->query($verifi);
	
	$contactos=$conexion->query($consulta);

	$datos = $contactos->fetch_assoc();
	while ($datos != NULL){

		echo 'Nombre : '. $datos['nombre'].' '. $datos['ape1'].' '. $datos['ape2'].' '. $datos['tlf'];

	echo '<a href="borraContacto.php?id='.$datos['id'] .'"><img src="/img/papelera.png" alt="eliminar contacto"></a><br>';
		$datos = $contactos->fetch_assoc();
	}


?>

	</body>
</html>