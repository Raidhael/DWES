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
	<style>
		.logeadoOk{
			width: 100%;
			background-color: blue;
			text-align: center;
		}
		.logeadoOk>a{
			color:white;
			font-size: 1.5em;
		}
	</style>
</head>
<body>

	
	<?php
		if ( isset($_GET['registroCompletado']) && $_GET['registroCompletado'] == 0){
			echo '<div class="logeadoOk">';
			echo '<a href="login.php">Ya te puedes logear</a>';
			echo '</div>';
		}
	//Cabecera
	require_once('includes/cabecera.inc.php');
	//Alerta de registro completado

		$opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
		try {
			$conexion = new PDO('mysql:host=localhost;dbname=blogdwes', 'userblog', 'passblog', $opc);	
		} catch (PDOException $e) {
			echo 'Falló la conexión: ' . $e->getMessage();
		}
		

		//MUESTRA ENTRADAS
		$entradasPorPagina = 5;
		$numeroEntradas = 'SELECT count(*) FROM entrada';
		$numeroEntradas = $conexion->query($numeroEntradas)->fetch(PDO::FETCH_NUM)[0];
		
		if (!isset($_GET['pagina'])) $_GET['pagina']=1;
		$numeroEntrada = ($_GET['pagina'] -1) * $entradasPorPagina;
		
		$consulta = 'SELECT * FROM entrada ORDER BY fecha ASC LIMIT '.$numeroEntrada.',5;';
		$entradas = $conexion->query($consulta);

		
		echo '<section class ="entradas">';
		echo $numeroEntradas .' entradas <br>';
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
			//Nombre de Autor y fecha de posteo
			echo 'Posteado por: '.$usuario.' <br> Fecha: '.$fechaConvertida;
			
			//Enlace a comentarios y numero de comentarios pertenecientes a esa entrada
			$numComentarios = 'SELECT count(*) FROM comentario WHERE idEntrada ='.$muestraEntradas['id'].';';
			$numComentarios = $conexion->query($numComentarios)->fetch(PDO::FETCH_NUM)[0];
			
			echo '<br><a href = " index.php?id='.$muestraEntradas['id'] .'#comentarios">Comentarios: '.$numComentarios.'</a>';
			echo '</article>';
		}
		echo "</section>"; 
		//AQUI ACABA LA MUESTRA DE ENTRADAS 
	?>
	



</body>
</html>