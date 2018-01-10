<?php


	//Primero codigo html dentro de body


?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Listin </title>
</head>
<body>
	<?php

	$conexion = new mysqli('localhost','agenda','agenda','agenda');
	$contacxpag=3;


	$contar= 'SELECT count(*) FROM contactos; ';
	$contador=$conexion->query($contar);

	$numContactos=$contador->fetch_row();




	if (!isset($_GET['pagina'])) $_GET['pagina'] = 1;

	$primerContacto = ($_GET['pagina'] - 1) * $contacxpag;

	$consulta = 'SELECT * FROM contactos ORDER BY nombre ASC LIMIT '.$primerContacto.',3;';
	echo $consulta;
	$resultado=$conexion->query($consulta);

	$datos = $resultado->fetch_assoc();
	echo "Hay " . $numContactos[0] . " contactos : <br> <br> ";
	
	while ($datos != NULL){

		echo 'Nombre : '. $datos['nombre'].' '. $datos['ape1'].' '. $datos['ape2'].' '. $datos['tlf'].'<br>';	
		$datos = $resultado->fetch_assoc();
	}

	$totalPaginas=$numContactos[0] / $contacxpag;
	
	if ($_GET['pagina']!= 1 ){
			echo '<a href = "/listin/1"> Primero </a>';
			echo '<a href = "/listin/'.($_GET['pagina'] - 1).'"> < </a>';
		}
	for ($i = 1 ; $i<=$totalPaginas + 1 ; $i ++ ){

		if ( $_GET['pagina'] == $i ) echo $i;
		else echo '<a href="/listin/'.$i.'">'.$i.'</a>';
	}
	//ceil para redondear hacia arriba

	if ($_GET['pagina'] != ceil($totalPaginas)){
		echo '<a href =" /listin/'.($_GET['pagina'] + 1) .' "> > </a> ';
		echo '<a href = "/listin/'.ceil($totalPaginas).'"> Ultimo </a>';
	}

	?>

</body>
</html>