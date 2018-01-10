<?php
//Se recoge la variable mediante post buscar para iniciar la busqueda
	if (isset($_POST['buscar'])){	
//Se verifica que las varibale recogidas del formulario no esten vacias
		if (!empty($_POST ['anyo'])){
			if(is_numeric($_POST['anyo'] ) ){
//Se redirecciona a la pagina con las variables de busqueda
				header('Location: /backend/listar.php?anno='.$_POST['anyo']);
			}else {
//En caso de no ser correcto los parametros de busqueda se recarga la pagina
				header('Location : #');
			}
		}
//Se añade un 0 en la variable "mes" si es un numero de mes menor que 10 para que tenga el formato correcto de busqueda
        if (!empty($_POST['mes']) && !empty($_POST['anyo'])){
			$mes=$_POST['mes'];
			if ($mes < 10){
				$mes = '0'.$mes;
			}
//Se redirecciona
			header('Location: /backend/listar.php?anno='.$_POST['anyo'].'&mes='.$mes);			
    	}
	}

?>

<header>
<!-- Formulario y Enlaces para navegar por el backend-->	
	<a href="/backend/listar.php"><img src="" alt="logo-blog">
	<h1> BACK END</h1></a>
	<a href="/backend/listar.php"> LISTA </a>
	<a href="/login.php">LOGIN</a>
	

	<form action="#" method="POST">
		Buscar por año y mes: 
    <label for="anyo">Año</label>
		<input type="number" name="anyo" placeholder="YYYY">
    <label for="mes">Mes</label>
        <input type="number" name="mes" placeholder="MM">
		<input type="submit" name="buscar" value="Buscar">
	</form>
	

<?php	
//Array para cambiar el mes recibido en numero  a texto en castellano
	$meses=[' de Enero de ',' de Febrero de ',' de Marzo de ',' de Abril de ',' de Mayo de ',' de Junio de ',
	' de Julio de ',' de Agosto de ',' de Septiembre de ',' de Octubre de ',' de Noviembre de ',' de Diciembre de ',];
	
//MOSTRAR FECHA ACTUAL
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