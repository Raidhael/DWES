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
	<?php

	//Conexion a la base de datos
		$opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
		try {
			$conexion = new PDO('mysql:host=localhost;dbname=blogdwes', 'userblog', 'passblog', $opc);	
		} catch (PDOException $e) {
			echo 'Falló la conexión: ' . $e->getMessage();
		}

		if ( isset($_GET['registroCompletado']) && $_GET['registroCompletado'] == 0){
			echo '<div class="logeadoOk">';
			echo '<a href="login.php">Ya te puedes logear</a>';
			echo '</div>';
		}
	//Cabecera
	require_once('includes/cabecera.inc.php');
	//Aside
	require_once('includes/aside.inc.php');
	//Si el año y el mes se han recogido por GET se muestra las entradas pertinentes
	if (isset($_GET['anno']) && isset($_GET['mes'])){
		$consulta=$conexion->prepare ('SELECT * FROM entrada WHERE id = :id');
		$consulta->bindParam(':id',$_GET['id']);
		$consulta->execute();



		// Se recibe el id por GET y se muesta la entrada pertinente
	}else if (isset($_GET['id'])) {
		//Preparacion de consulta para ver que el id no ha sido modificado 
		$consulta=$conexion->prepare('SELECT count(*) FROM entrada WHERE id = :id');
		$consulta->bindParam(':id',$_GET['id']);
		$consulta->execute();
		$existeEntrada=$consulta->fetch(PDO::FETCH_NUM)[0];
		//Si no se recibe ningun valor es decir hay 0 filas en la base de datos con ese id, se redirecciona a la pagina principal
			if ( $existeEntrada == 0) header('location: /');
		//Si no, se muestra la entrada
			else {
				$consulta=$conexion->prepare ('SELECT * FROM entrada WHERE id = :id');
				$consulta->bindParam(':id',$_GET['id']);
				$consulta->execute();
				$datosEntrada = $consulta->fetch(PDO::FETCH_ASSOC);
				if ($datosEntrada != null) {
					echo '<section class="entradas">';
						echo '<h2><a href = " index.php?id='.$datosEntrada['id'] .'">'.$datosEntrada['titulo'].'</a></h2>';
						echo '<p>'.$datosEntrada['cuerpo'].'</p>';
						$usuario = 'SELECT nombre FROM usuario WHERE user ='.$datosEntrada['usuario'].';';
						$usuario = $conexion->query($usuario)->fetch(PDO::FETCH_NUM)[0];
						
						//FORMATO DE FECHA
						$fecha = $datosEntrada['fecha'];
						$fecha = explode('-',$fecha);
						$fechaConvertida=null;
						for ($i = count($fecha)-1;$i>=0;$i--){
							if ($i>0)$fechaConvertida .=$fecha[$i].'/';
							else $fechaConvertida .=$fecha[$i];
						}
						//FIN DE FORMATEO
						//Nombre de Autor y fecha de posteo
						echo 'Posteado por: '.$usuario.' <br> Fecha: '.$fechaConvertida;
					echo '</section>';
					echo '<br><br><a href="index.php"> Atras </a>';
				}
			}
		}else{

		//Muestra entradas
		$entradasPorPagina = 5;
		$numeroEntradas = 'SELECT count(*) FROM entrada';
		$numeroEntradas = $conexion->query($numeroEntradas)->fetch(PDO::FETCH_NUM)[0];
		$cuentaEntradas = $numeroEntradas;
		if (!isset($_GET['pagina'])) $_GET['pagina']=1;
		$numeroEntrada = ($_GET['pagina'] -1) * $entradasPorPagina;
		
		$consulta = 'SELECT * FROM entrada ORDER BY id DESC LIMIT '.$numeroEntrada.',5;';
		$entradas = $conexion->query($consulta);


		echo '<span>'.$numeroEntradas .' entradas</span> <br>';
		
		echo '<section id="entradas">';
		echo '<h4> <a href="index.php#entradas">Novedades </a></h4>';
		while (($muestraEntradas = $entradas->fetch(PDO::FETCH_ASSOC)) !=null) {
			echo '<article>';
			echo '<h3><a href = " index.php?id='.$muestraEntradas['id'] .'">'.$muestraEntradas['titulo'].'</a></h3>';
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
		//Aqui acaba muestra entradas
		
		//Paginacion
		echo '<div class="paginacion">';
		$totalPaginas=$numeroEntradas/ $entradasPorPagina;
	
		if ($_GET['pagina']!= 1 ){
				echo '<br>';
				echo '<a href = "index.php"> &lt;&lt;  </a>';
				echo '<a href = "index.php?pagina='.($_GET['pagina'] - 1).'"> &lt; </a>';
			}
		for ($i = 1 ; $i<=$totalPaginas + 1 ; $i ++ ){
	
			if ( $_GET['pagina'] == $i ) echo $i;
			else echo '<a href="index.php?pagina='.$i.'">'.$i.'</a>';
		}
		//ceil para redondear hacia arriba
	
		if ($_GET['pagina'] != ceil($totalPaginas)){
			echo '<a href =" index.php?pagina='.($_GET['pagina'] + 1) .' "> &gt; </a> ';
			echo '<a href = "index.php?pagina='.ceil($totalPaginas).'"> &gt;&gt; </a>';
		}
		echo '</div>';
	}

	
	?>
	



</body>
</html>