<?php

	$id = $_GET ['id'];

	$conexion = new mysqli('localhost','agenda','agenda','agenda');
	$existe='SELECT count(*) FROM contactos WHERE id="'.$id.'";';
	$resultado=$conexion->query($existe);


	if ($resultado != 0 ) {
		$consulta = 'DELETE FROM contactos WHERE id ="'.$id. '";';
		$borrado = $conexion->query($consulta);
	}
	if (!$borrado || $conexion->affected_rows <= 0 ){
		echo "<h1> No se ha podido borrar el id seleccionado </h1>";
	}else {
	$resultado=mysqli_free();
	$borrado=mysqli_free();
	$conexion=mysqli_close();

		header("location : .pruebas/");
	}

?>