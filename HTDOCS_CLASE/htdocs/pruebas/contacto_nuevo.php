<?php

$nombre=$_POST['nombre'];
$ape1=$_POST['ape1'];
$ape2=$_POST['ape2'];
$tlf=$_POST['telefono'];
//Conexion al servidor , usuario , pass , base de datos
	$conexion = new mysqli('localhost','agenda','agenda','agenda');
//MUESTRA ERRORES
	echo $conexion->connect_errno;
	echo $conexion->connect_error;

//Consulta
	$consulta= 'INSERT INTO contactos (nombre, ape1 , ape2 ,tlf)
		VALUES ("'. $nombre .'","'. $ape1 . '","'. $ape2 . '","'. $tlf.'");';

//Lanza la consulta 
	$resultado=$conexion->query($consulta);


//Si es erronea muestra error sino es todo correcto 
	if (!$resultado) {
		echo '<h1> Se ha producido un error </h1>';
	} else {
		echo '<h1> El contacto se ha guardado correctamente </h1>';
	}



	$consulta='SELECT * FROM contactos';
	$contactos=$conexion->query($consulta);

	$datos = $contactos->fetch_assoc();
	while ($datos != NULL){
		echo 'Nombre : '. $datos['nombre'].'<br>';
		echo '1ºApellido : '. $datos['ape1'].'<br>';
		echo '2nd Apellido : '. $datos['ape2'].'<br>';
		echo 'Telefono : '. $datos['tlf'].'<br>';
		$datos = $contactos->fetch_assoc();
	}

	

?>