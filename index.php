<?php
ini_set('session.name','SessionDelBlog');
session_start();
?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Principal</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<a href=""></a>
	<?php

		$opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
		try {
			$conexion = new PDO('mysql:host=localhost;dbname=blogdwes', 'userblog', 'passblog', $opc);	
		} catch (PDOException $e) {
			echo 'Falló la conexión: ' . $e->getMessage();
		}
		
		$entradasPorPagina = 5;
		$numeroEntradas = 'SELECT count(*) FROM entrada';
		$numeroEntradas = $conexion->query($numeroEntradas)->fetch(PDO::FETCH_NUM)[0];
		
		if (!isset($_GET['pagina'])) $_GET['pagina']=1;
		$numeroEntrada = ($_GET['pagina'] -1) * $entradasPorPagina;
		
		$consulta = 'SELECT * FROM entrada ORDER BY fecha ASC LIMIT '.$numeroEntrada.',5;';
		$entradas = $conexion->query($consulta);

		echo $numeroEntradas .' entradas <br>';
		echo '<section class ="entradas">';
		while (($muestraEntradas = $entradas->fetch(PDO::FETCH_ASSOC)) !=null) {
			echo '<article>';
			echo '<h2><a href = " index.php?id='.$muestraEntradas['id'] .'">'.$muestraEntradas['titulo'].'</a></h2>';
			echo '<p>'.$muestraEntradas['cuerpo'].'</p>';
			$usuario = 'SELECT nombre FROM usuario WHERE user ='.$muestraEntradas['usuario'].';';
			$usuario = $conexion->query($usuario)->fetch(PDO::FETCH_NUM)[0];
			
			//FORMATO DE FECHA
			$fecha = $muestraEntradas['fecha'];
			$fecha = explode('-',$fecha);
			$fechaConvertida=null;
			for ($i = count($fecha)-1;$i>=0;$i--){
				if ($i>0)$fechaConvertida .=$fecha[$i].'/';
				else $fechaConvertida .=$fecha[$i];
			}
			//FIN DE FORMATEO

			echo 'Posteado por : '.$usuario.' el dia  '.$fechaConvertida;
			$numComentarios = 'SELECT count (*) FROM comentario WHERE idEntrada = '.$muestraEntradas['id'].';';
			$numComentarios = $conexion->query($numComentarios)->fetch(PDO::FETCH_NUM)[0];
			echo '<br><a href = " index.php?id='.$muestraEntradas['id'] .'">'.$numComentarios.'</a>';
			echo '</article>';
		}
		echo "</section>"; 
	?>
	



</body>
</html>