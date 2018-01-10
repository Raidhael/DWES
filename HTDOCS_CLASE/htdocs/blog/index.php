<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Principal</title>
	<style>
		section{
			width:51%;
			padding:1em;
		}
		aside{
			width:30%;
			float:right;
		}

		section , aside{
			vertical-align:top;
			display:inline-block;
		}

	</style>
</head>
<body>

	<?php
	
		require_once('includes/cabecera.inc.php');
		require_once('includes/archivo.inc.php');
		require_once('includes/clases/clasebd.inc.php');

		if (isset($_GET['anno']) && (isset($_GET['mes']))) {

			$expresionAnno = '/^[0-9]{4}$/';
			if(preg_match($expresionAnno, $_GET['anno'])) $annoCorrecto=TRUE;

				foreach ($BD->entradas as $indice => $entrada ){
						$anno=$_GET ['anno'];
						$mes_r=$_GET['mes'];
						$year=explode('-',$entrada->fechaHora);
					
						$year2=explode(' ',$year[2]);
						$finalYear=$year2[0];
						$mes=$year[1];
						if ( strcmp($anno,$finalYear) == 0 && strcmp($mes_r, $mes) == 0 ){
							echo "<section>";
								echo "<article>";
									echo '<h2><a href="index.php?id='.$indice.'">'.$entrada->titulo.'</a></h2>';
									echo '<p>'.$entrada->cuerpo.'</p>';
									echo '<p>'.$entrada->usuario." 	".$entrada->fechaHora.'</p>';
									echo '<p><a href="/?id='.$indice.'"> Numero de Comentarios:'.count($entrada->comentario).'</a></p>';
								echo "</article>";
							echo "</section>";	
						
						}
					}


		}elseif ( isset($_GET['anno']) ){

				foreach ($BD->entradas as $indice => $entrada ){
						$anno=$_GET ['anno'];
						$year=explode('-',$entrada->fechaHora);
						$year2=explode(' ',$year[2]);
						$finalYear=$year2[0];
						
						if ( strcmp($anno,$finalYear) == 0 ) {
							echo "<section>";
								echo "<article>";
									echo '<h2><a href="/index.php?id='.$indice.'">'.$entrada->titulo.'</a></h2>';
									echo '<p>'.$entrada->cuerpo.'</p>';
									echo '<p>'.$entrada->usuario." 	".$entrada->fechaHora.'</p>';
									echo '<p><a href="/?id='.$indice.'"> Numero de Comentarios:'.count($entrada->comentario).'</a></p>';
								echo "</article>";
							echo "</section>";	
						
						}
					}

	

		}else if(isset($_GET['id'])) {
		
			$id=$_GET['id'];
			

				echo "<section>";
					echo "<article>";
						echo '<h2>'.$BD->entradas[$id]->titulo.'</h2>';
						
						echo '<p>'.$BD->entradas[$id]->cuerpo.'</p>';
						echo '<p>'.$BD->entradas[$id]->usuario." 	".$BD->entradas[$id]->fechaHora.'</p>';
						echo '<p> Numero de Comentarios:'.count($BD->entradas[$id]->comentario).'</p>';
					echo "</article>";
				echo "</section>";	
	


		}else{
	

		foreach ($BD->entradas as $indice => $entrada ){
				echo "<section>";
					echo "<article>";
						echo '<h2><a href="/index.php?id='.$indice.'">'.$entrada->titulo.'</a></h2>';
						
						echo '<p>'.$entrada->cuerpo.'</p>';
						echo '<p>'.$entrada->usuario." 	".$entrada->fechaHora.'</p>';
						echo '<p><a href="/?id='.$indice.'"> Numero de Comentarios:'.count($entrada->comentario).'</a></p>';
					echo "</article>";
				echo "</section>";	
			}


			}

		

	?>
	



</body>
</html>