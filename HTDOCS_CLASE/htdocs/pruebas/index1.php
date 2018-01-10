<?php

$conexion = new mysqli('localhost','prueba','prueba','prueba');

//echo $conexion->connect_errno;
//echo $conexion->connect_error;
/**/

$consulta = 'SELECT * FROM usuarios ;';

$resultado=$conexion->query($consulta);

print_r($resultado);


echo $conexion->affected_rows;



//$consulta = 'SELECT * FROM familias;';

/*$conexion->query($consulta);

echo '<br>';

echo $conexion->affected_rows;*/

?>