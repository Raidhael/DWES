<!-- LISTA DE LOS AÑOS Y LOS MESES -->

<aside class="filtroAnyo">
	<?php
	//Array para mostrar en letra el mes
		$mesesEntrada=['Enero','Febrero','Marzo','Abril','Mayo','Junio',
		'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre',];
		$consulta ='SELECT fecha FROM entrada ORDER BY fecha DESC;';
		$entradasPorFecha =$conexion->query($consulta);
	//Lista de años y meses donde se encuentran las entradas
		echo '<a href="/backend/listar.php">Todas las entradas </a>';
		echo '<ul>';
		$fechas = $entradasPorFecha->fetch(PDO::FETCH_ASSOC);
		$anyoIteracion = -1;//Controlador de año
	//Se comprueba de que la consulta no ha dado nulo
		while ($fechas != null){
			//Se extrae el año
			$anyo = explode('-',$fechas['fecha'])[0];
			$mesIteracion= -1;//Controlador de mes
			//Si el año no es el mismo que el controlador se imprime el año
			if ($anyo != $anyoIteracion){ 
				echo '<li> <a href="/backend/listar.php?anno='.$anyo.'">'.$anyo.'</a>';
			//Se le añade el valor al controlador del año que actualmente esta en la iteracion para que no imprima varias veces el mismo año
				$anyoIteracion = $anyo;
			}
			// Se imprime el segundo nivel de la lista con los meses
				echo '<ul>';
			//Mientras el año sea el mismo se imprimiran todos los meses donde se encuentren entradas
					while ($anyo == $anyoIteracion && $fechas != null) {

						$anyo = explode('-',$fechas['fecha'])[0];//Se añade el valor del año en la iteracion actual
						$mes = explode('-',$fechas['fecha'])[1];//Se añade el valor del mes en la iteracion actual	
						//Mientras el mes no sea el mismo que el de la iteracion actual y el año siga siendo el mismo, se imprimiran los meses donde se encuentren entradas
						if ($mes != $mesIteracion && $anyo == $anyoIteracion) {
							echo '<li> <a href="/backend/listar.php?anno='.$anyo.'&mes='.$mes.'">'.$mesesEntrada[$mes-1].'</a></li>';
							$mesIteracion=$mes;//Se le añade el valor del mes actual que esta iterando para que no hayan meses duplicados en la lista
						}
						$fechas = $entradasPorFecha->fetch(PDO::FETCH_ASSOC);//Se pasa a la siguiente fila obtenida de la consulta
					}
				echo '</ul>';
			echo '</li>';
		}
		echo '</ul>';
	?>
</aside>