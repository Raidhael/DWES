

<?php

	if (isset($_POST['enviar'])){

		if (!empty($_POST ['busqueda'])){
			
			$busqueda=$_POST['busqueda'];
			$busqueda=trim($busqueda);

			header('Location: /busqueda.php?busqueda='.$busqueda.'&tipo='.$_POST['tipo']);
		}
	}

?>

<header>
	
	<a href="index.php"><img src="" alt="logo-blog">
	<h1> MI BLOG</h1></a>
	<a href="/index.php"> HOME </a>
	<a href="../login.php">LOGIN</a>
	<a href="../registro.php">REGISTRO</a> 

	<form action="#" method="POST">
		Buscar <input type="text" name="busqueda">
		<input type="radio" name="tipo" value="1" checked >Todas las palabras
		<input type="radio" name="tipo"  value="2"> Algunas de las palabras
		<input type="submit" name="enviar" value="Buscar">
	</form>
	

<?php	
	$meses=[' de Enero de ',' de Febrero de ',' de Marzo de ',' de Abril de ',' de Mayo de ',' de Junio de ',
	' de Julio de ',' de Agosto de ',' de Septiembre de ',' de Octubre de ',' de Noviembre de ',' de Diciembre de ',];
	$fecha=date('d-m-Y');
	$fecha=explode('-',$fecha);
	foreach ($fecha as $indice => $valor){

		if ($indice == 1){
			echo $meses[$valor-1];
		}else{
			echo $valor;
		}
	}



 ?>


 
 

</header>