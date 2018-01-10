<?php


	$conexion = new mysqli('localhost','agenda','agenda','agenda');
	$consulta='SELECT * FROM contactos;';
	$contactos=$conexion->query($consulta);

	$datos = $contactos->fetch_assoc();
	while ($datos != NULL){

		echo 'Nombre : '. $datos['nombre'].' '. $datos['ape1'].' '. $datos['ape2'].' '. $datos['tlf'];

	echo '<a href="borraContacto.php?id='.$datos['id'] .'"><img src="/img/papelera.png" alt="eliminar contacto"></a><br>';
		$datos = $contactos->fetch_assoc();
	}


?>