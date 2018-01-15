<?php
ini_set('session.name','SessionDelBlog');
session_start();

if (isset($_SESSION['nombre']) && strcmp($_SESSION['tipoUsuario'],'administrador') != 0){
	header('location: /');
	exit();
}else if (!isset($_SESSION['nombre'])){
	header('location: /');
	exit();
}else{



?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Principal</title>
	<link rel="stylesheet" href="/css/estilo.css">
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
		echo '<div class="backEnd"> BACKEND </div>';
		//Cabecera
		require_once('../includes/cabecera.inc.php');
		//Aside
		require_once('includes/asidebackend.inc.php');
	//Si el año y el mes se han recogido por GET se muestra las entradas pertinentes
	if (isset($_GET['anno']) && isset($_GET['mes'])){
		//Se comprueba si el valor get no ha sido modificado
		$consulta=$conexion->prepare ('SELECT count(*) FROM `entrada` WHERE YEAR(fecha)=:anno AND MONTH(fecha)=:mes;');
		$consulta->bindParam(':anno',$_GET['anno']);
		$consulta->bindParam(':mes',$_GET['mes']);
		$consulta->execute();
		$numeroDeEntradas=$consulta->fetch(PDO::FETCH_NUM)[0];
		$cuentaEntradas=$numeroDeEntradas;

		//Si no se recibe ningun valor es decir hay 0 filas en la base de datos con ese id, se redirecciona a la pagina principal
		if ( $numeroDeEntradas == 0){
			header('location: /backend/listar.php');
			exit();
		}else {
		//Si no, se muestra la entrada
			$entradasPorPagina = 5;
			if (!isset($_GET['pagina'])) $_GET['pagina']=1;
			$numeroDeEntradas = ($_GET['pagina'] -1) * $entradasPorPagina;
			
			$consulta=$conexion->prepare ('SELECT * FROM `entrada` WHERE YEAR(fecha)=:anno AND MONTH(fecha)=:mes ORDER BY id DESC LIMIT '.$numeroDeEntradas.',5;');
			$consulta->bindParam(':anno',$_GET['anno']);
			$consulta->bindParam(':mes',$_GET['mes']);
			$consulta->execute();
			$entradas = $consulta;

			
			echo '<section id="entradas">';
			echo '<span>'.$cuentaEntradas .' entradas</span> <br>';
			while (($muestraEntradas = $entradas->fetch(PDO::FETCH_ASSOC)) !=null) {
				echo '<article>';
				echo '<h3><a href = " listar.php?id='.$muestraEntradas['id'] .'">'.$muestraEntradas['titulo'].'</a>	<a href="editar.php?editar=0&id='.$muestraEntradas['id'].'"><img src="ico/editar.jpg" alt="editar" width="20" height="20"></a>
				<a href="editar.php?eliminar=0&id='.$muestraEntradas['id'].'"><img src="ico/eliminar.jpg" alt="eliminar" width="20" height="20"></a></h3>';
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
				
				echo '<br><a href = " listar.php?id='.$muestraEntradas['id'] .'#comentarios">Comentarios: '.$numComentarios.'</a>';
				echo '</article>';
			}
			echo "</section>"; 
			//Aqui acaba muestra entradas
			echo '<div class="paginacion">';
			$totalPaginas=$numeroDeEntradas / $entradasPorPagina;

			if ($_GET['pagina']!= 1 ){
					echo '<br>';
					echo '<a href = "listar.php?anno='.$_GET['anno'].'&mes='.$_GET['mes'].'"> &lt;&lt;  </a>';
					echo '<a href = "listar.php?anno='.$_GET['anno'].'&mes='.$_GET['mes'].'&pagina='.($_GET['pagina'] - 1).'"> &lt; </a>';
				}
			for ($i = 1 ; $i<=$totalPaginas + 1 ; $i ++ ){
		
				if ( $_GET['pagina'] == $i ) echo $i;
				else echo '<a href="listar.php?anno='.$_GET['anno'].'&mes='.$_GET['mes'].'&pagina='.$i.'">'.$i.'</a>';
			}
			//ceil para redondear hacia arriba
		
			if ($_GET['pagina'] != ceil($totalPaginas) && ceil($totalPaginas) != 0){
				
				echo '<a href =" listar.php?anno='.$_GET['anno'].'&mes='.$_GET['mes'].'&pagina='.($_GET['pagina'] + 1) .' "> &gt; </a> ';
				echo '<a href = "listar.php?anno='.$_GET['anno'].'&mes='.$_GET['mes'].'&pagina='.ceil($totalPaginas).'"> &gt;&gt; </a>';
			}

			echo '</div>';
			//Paginacion
				}
	}else if (isset($_GET['anno'])){
			//Se comprueba si el valor get no ha sido modificado
			$consulta=$conexion->prepare ('SELECT count(*) FROM `entrada` WHERE YEAR(fecha)=:anno;');
			$consulta->bindParam(':anno',$_GET['anno']);
			$consulta->execute();
			$numeroDeEntradas=$consulta->fetch(PDO::FETCH_NUM)[0];
			$cuentaEntradas=$numeroDeEntradas;
	
			//Si no se recibe ningun valor es decir hay 0 filas en la base de datos con ese id, se redirecciona a la pagina principal
			if ( $numeroDeEntradas == 0){
				header('location: /backend/listar.php');
				exit();
			}else {
			//Si no, se muestra la entrada
				$entradasPorPagina = 5;
				if (!isset($_GET['pagina'])) $_GET['pagina']=1;
				$numeroDeEntradas = ($_GET['pagina'] -1) * $entradasPorPagina;
				
				$consulta=$conexion->prepare ('SELECT * FROM `entrada` WHERE YEAR(fecha)=:anno ORDER BY id DESC LIMIT '.$numeroDeEntradas.',5;');
				$consulta->bindParam(':anno',$_GET['anno']);
				$consulta->execute();
				$entradas = $consulta;

				echo '<span>'.$cuentaEntradas .' entradas</span> <br>';
				echo '<section id="entradas">';
				while (($muestraEntradas = $entradas->fetch(PDO::FETCH_ASSOC)) !=null) {
					echo '<article>';
					echo '<h3><a href = " listar.php?id='.$muestraEntradas['id'] .'">'.$muestraEntradas['titulo'].'</a>	<a href="editar.php?editar=0&id='.$muestraEntradas['id'].'"><img src="ico/editar.jpg" alt="editar" width="20" height="20"></a>
					<a href="editar.php?eliminar=0&id='.$muestraEntradas['id'].'"><img src="ico/eliminar.jpg" alt="eliminar" width="20" height="20"></a></h3>';
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
					
					echo '<br><a href = " listar.php?id='.$muestraEntradas['id'] .'#comentarios">Comentarios: '.$numComentarios.'</a>';
					echo '</article>';
				}
				echo "</section>"; 
				//Aqui acaba muestra entradas
				echo '<div class="paginacion">';
				$totalPaginas=$numeroDeEntradas / $entradasPorPagina;
	
				if ($_GET['pagina']!= 1 ){
						echo '<br>';
						echo '<a href = "listar.php?anno='.$_GET['anno'].'"> &lt;&lt;  </a>';
						echo '<a href = "listar.php?anno='.$_GET['anno'].'&pagina='.($_GET['pagina'] - 1).'"> &lt; </a>';
					}
				for ($i = 1 ; $i<=$totalPaginas + 1 ; $i ++ ){
			
					if ( $_GET['pagina'] == $i ) echo $i;
					else echo '<a href="listar.php?anno='.$_GET['anno'].'&pagina='.$i.'">'.$i.'</a>';
				}
				//ceil para redondear hacia arriba
			
				if ($_GET['pagina'] != ceil($totalPaginas) && ceil($totalPaginas) != 0){
					
					echo '<a href =" listar.php?anno='.$_GET['anno'].'&pagina='.($_GET['pagina'] + 1) .' "> &gt; </a> ';
					echo '<a href = "listar.php?anno='.$_GET['anno'].'&pagina='.ceil($totalPaginas).'"> &gt;&gt; </a>';
				}
	
				echo '</div>';
				//Paginacion
			}
		// Se recibe el id por GET y se muesta la entrada pertinente
	}else if (isset($_GET['id'])) {
		//Preparacion de consulta para ver que el id no ha sido modificado 
		$consulta=$conexion->prepare('SELECT count(*) FROM entrada WHERE id = :id');
		$consulta->bindParam(':id',$_GET['id']);
		$consulta->execute();
		$existeEntrada=$consulta->fetch(PDO::FETCH_NUM)[0];
		//Si no se recibe ningun valor es decir hay 0 filas en la base de datos con ese id, se redirecciona a la pagina principal
			if ( $existeEntrada == 0) header('location: /backend/listar.php');
		//Si no, se muestra la entrada
		else {
			$consulta=$conexion->prepare ('SELECT * FROM entrada WHERE id = :id');
			$consulta->bindParam(':id',$_GET['id']);
			$consulta->execute();
			$datosEntrada = $consulta->fetch(PDO::FETCH_ASSOC);
			if ($datosEntrada != null) {
				echo '<section class="entradas">';
					echo '<article>';
						echo '<h3><a href = " listar.php?id='.$datosEntrada['id'] .'">'.$datosEntrada['titulo'].'</a>	<a href="editar.php?editar=0&id='.$datosEntrada['id'].'"><img src="ico/editar.jpg" alt="editar" width="20" height="20"></a>
						<a href="editar.php?eliminar=0&id='.$datosEntrada['id'].'"><img src="ico/eliminar.jpg" alt="eliminar" width="20" height="20"></a></h3>';
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
					echo '</article>';
				echo '</section>';
				
				echo '<br><br><a href="listar.php"> Atras </a>';
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

		//Numero de entradas actuales
		echo '<span>'.$cuentaEntradas .' entradas</span> <br>';
		//Datos de las entradas
		echo '<section id="entradas">';
		echo '<h4> <a href="listar.php#entradas">Novedades </a></h4>';
		while (($muestraEntradas = $entradas->fetch(PDO::FETCH_ASSOC)) !=null) {
			echo '<article>';
			echo '<h3><a href = " listar.php?id='.$muestraEntradas['id'].'">'.$muestraEntradas['titulo'].'</a>	<a href="editar.php?editar=0&id='.$muestraEntradas['id'].'"><img src="ico/editar.jpg" alt="editar" width="20" height="20"></a>
			<a href="editar.php?eliminar=0&id='.$muestraEntradas['id'].'"><img src="ico/eliminar.jpg" alt="eliminar" width="20" height="20"></a></h3>';
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
			
			echo '<br><a href = " listar.php?id='.$muestraEntradas['id'] .'#comentarios">Comentarios: '.$numComentarios.'</a>';
			echo '</article>';
		}
		echo "</section>"; 
		//Aqui acaba muestra entradas
		
		//Paginacion
		echo '<div class="paginacion">';
		$totalPaginas=$numeroEntradas/ $entradasPorPagina;
	
		if ($_GET['pagina']!= 1 ){
				echo '<br>';
				echo '<a href = "listar.php"> &lt;&lt;  </a>';
				echo '<a href = "listar.php?pagina='.($_GET['pagina'] - 1).'"> &lt; </a>';
			}
		for ($i = 1 ; $i<=$totalPaginas + 1 ; $i ++ ){
	
			if ( $_GET['pagina'] == $i ) echo $i;
			else echo '<a href="listar.php?pagina='.$i.'">'.$i.'</a>';
		}
		//ceil para redondear hacia arriba
	
		if ($_GET['pagina'] != ceil($totalPaginas) && ceil($totalPaginas) != 0){
			echo '<a href =" listar.php?pagina='.($_GET['pagina'] + 1) .' "> &gt; </a> ';
			echo '<a href = "listar.php?pagina='.ceil($totalPaginas).'"> &gt;&gt; </a>';
		}
		echo '</div>';
	}
}
	?>

</body>
</html>