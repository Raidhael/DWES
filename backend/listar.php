<?php
require_once('../includes/clases/clasebd.inc.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listar</title>
</head>
<body>
    <?php
require_once('includes/cabecera_backend.inc.php');


//En caso de recibir las variables get de mes y año se muestran unicamente  las entradas que esten dentro de esas fechas.
    if (isset($_GET['anno']) && (isset($_GET['mes']))) {
        echo '<h3><a href="editar.php"> Crear nueva entrada</a> </h3>';
        $expresionAnno = '/^[0-9]{4}$/';
        if(preg_match($expresionAnno, $_GET['anno'])) $annoCorrecto=TRUE;
            
            foreach ($BD->entradas as $indice => $entrada ){
//Se saca el mes y el año de la fecha de creacion de la entrada para luego comparar si esta dentro de los parametros de filtrado
                    $anno=$_GET ['anno'];
                    $mes_r=$_GET['mes'];
                    $year=explode('-',$entrada->fechaHora);
                
                    $year2=explode(' ',$year[2]);
                    $finalYear=$year2[0];
                    $mes=$year[1];
//Compara si esta dentro de los parametros
                    if ( strcmp($anno,$finalYear) == 0 && strcmp($mes_r, $mes) == 0 ){
                        echo "<section>";
                            echo "<article>";
                                echo '<h2><a href="/backend/listar.php?id='.$indice.'">'.$entrada->titulo.'</a><a href="/backend/editar.php?id='.$indice.'"><img src="ico/editar.jpg" alt="editar" height="30" width="30"></a>
                                    <a href="/backend/editar.php?id='.$indice.'"><img src="ico/eliminar.jpg" alt="editar" height="30" width="30"></a></h2>';
                                echo '<p>'.$entrada->cuerpo.'</p>';
                                echo '<p>'.$entrada->usuario." 	".$entrada->fechaHora.'</p>';
                                echo '<p><a href="/backend/listar.php?id='.$indice.'"> Numero de Comentarios:'.count($entrada->comentarios).'</a></p>';
                            echo "</article>";
                        echo "</section>";	
                    
                    }
                }
        
//Filtro de solo año
    }else if ( isset($_GET['anno']) ){
//Extrae el año de la entrada y lo compara con el año recogido en la variable get  
        foreach ($BD->entradas as $indice => $entrada ){
                $anno=$_GET ['anno'];
                $year=explode('-',$entrada->fechaHora);
                $year2=explode(' ',$year[2]);
                $finalYear=$year2[0];
                
                if ( strcmp($anno,$finalYear) == 0 ) {
                    echo "<section>";
                        echo "<article>";
                            echo '<h2><a href="/backend/listar.php?id='.$indice.'">'.$entrada->titulo.'</a><a href="/backend/editar.php?id='.$indice.'"><img src="ico/editar.jpg" alt="editar" height="30" width="30"></a>
                                    <a href="/backend/editar.php?id='.$indice.'&eliminar=1"><img src="ico/eliminar.jpg" alt="editar" height="30" width="30"></a></h2>';
                            echo '<p>'.$entrada->cuerpo.'</p>';
                            echo '<p>'.$entrada->usuario." 	".$entrada->fechaHora.'</p>';
                            echo '<p><a href="/backend/listar.php?id='.$indice.'"> Numero de Comentarios:'.count($entrada->comentarios).'</a></p>';
                        echo "</article>";
                    echo "</section>";	
                
                }
        }
//En caso de recibir la variable id mediante get se muestra la entrada coincidente con ese id
    }else if(isset($_GET['id'])) {
        echo '<h3><a href="editar.php"> Crear nueva entrada</a> </h3>';
			$id=$_GET['id'];
			

				echo "<section>";
					echo "<article>";
						echo '<h2>'.$BD->entradas[$id]->titulo.'<a href="/backend/editar.php?id='.$id.'"><img src="ico/editar.jpg" alt="editar" height="30" width="30"></a>
                                <a href="/backend/editar.php?id='.$id.'&eliminar=1"><img src="ico/eliminar.jpg" alt="editar" height="30" width="30"></a></h2>';
						
						echo '<p>'.$BD->entradas[$id]->cuerpo.'</p>';
						echo '<p>'.$BD->entradas[$id]->usuario." 	".$BD->entradas[$id]->fechaHora.'</p>';
						echo '<p> Numero de Comentarios:'.count($BD->entradas[$id]->comentarios).'</p>';
					echo "</article>";
				echo "</section>";	
			require_once('../includes/comentarios.inc.php');

// En caso de no recibir ninguna variable se muestran todas las entradas.
		}else{
        echo '<h3><a href="editar.php"> Crear nueva entrada</a> </h3>';
        foreach ($BD->entradas as $indice => $entrada ){

                echo "<section>";
                    echo "<article>";
                        echo '<h2><a href="/backend/listar.php?id='.$indice.'">'.$entrada->titulo.'</a><a href="/backend/editar.php?id='.$indice.'"><img src="ico/editar.jpg" alt="editar" height="30" width="30"></a>
                                    <a href="/backend/editar.php?id='.$indice.'&eliminar=1"><img src="ico/eliminar.jpg" alt="editar" height="30" width="30"></a></h2>';
                        
                        echo '<p>'.$entrada->cuerpo.'</p>';
                        echo '<p>'.$entrada->usuario." 	".$entrada->fechaHora.'</p>';
                        echo '<p><a href="/backend/listar.php?id='.$indice.'"> Numero de Comentarios:'.count($entrada->comentarios).'</a></p>';
                    echo "</article>";
                echo "</section>";	
        }
    }
    ?>

    
</body>
</html>