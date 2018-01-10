<footer>
<h3> Sergio Salt Moya </h3> 


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

</footer>