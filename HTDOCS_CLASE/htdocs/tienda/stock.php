<?php
if (isset ($_GET['cod'])){
	

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Informacion</title>
</head>
<body>
<?php

    $codigo = $_GET['cod'];
    $conexion = new mysqli ('localhost','dwes','dwes','dwes');
    $consulta ='SELECT nombre_corto, descripcion FROM producto WHERE cod LIKE "'.$codigo.'";';
    $resultado = $conexion->query($consulta);
    $producto = $resultado->fetch_row();
    $nombreProducto = $producto[0];
    $descripcion = $producto[1];

    $consulta = 'SELECT nombre, unidades FROM tienda t left JOIN   stock s ON s.tienda = t.cod AND s.producto = "'.$codigo.'";';
    $resultado = $conexion->query($consulta);
    $stock = $resultado->fetch_assoc();
	echo '<p> Nombre del producto '. $nombreProducto .'</p>' ;
	echo '<p> Descripcion : <br>'. $descripcion.'</p>';
    while ($stock != NULL ) {
    	if ($stock['unidades'] == NULL ) $unidades = 0;
    	else $unidades = $stock['unidades'];    	
    	echo '<p> Tienda : '. $stock['nombre'].' Unidades disponibles ' . $unidades . '</p>';

    	$stock = $resultado ->fetch_assoc();

    }

}
?>
</body>
</html>


