

<?php
while ($post = each($_POST))
{
echo $post[0] . " = " . $post[1]." ";
}
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

$hora=time();
$dia=date('w', $hora);
$numDia=date('j', $hora);

switch ($dia) {
	case '0':
		echo "Domingo, ";
		break;
	case '1':
		echo "Lunes, ";
		break;
	case '2':
		echo "Martes, ";
		break;	
	case '3':
		echo "Miercoles, ";
		break;	
	case '4':
		echo "Jueves, ";
		break;
	case '5':
		echo "Viernes, ";
		break;	
	default:
		echo "Sabado, ";
		break;
}
 	
$mes=date('n',$hora);
switch ($mes) {
	case '1':
		echo $numDia." de Enero de ";
		break;
	case '2':
		echo $numDia." de Febreo de ";
		break;	
	case '3':
		echo $numDia." de Marzo de ";
		break;	
	case '4':
		echo $numDia." de Abril de ";
		break;
	case '5':
		echo $numDia." de Mayo de ";
		break;
	case '6':
		echo $numDia." de Junio de ";
		break;
	case '7':
		echo $numDia." de Julio de ";
		break;
	case '8':
		echo $numDia." de Agosto de ";
		break;		
	case '9':
		echo $numDia." de Septiembre de ";
		break;
	case '10':
		echo $numDia." de Octubre de ";
		break;
	case '11':
		echo $numDia." de Noviembre de";
	default:
		echo $numDia." de Diciembre de ";
		break;
}

	$year=date('Y', $hora);
	echo $year; 
 ?>


 
 

</header>