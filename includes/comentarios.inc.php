<?php

//Muestra los comentarios de la entrada con el id coincidente

echo '<h2 name="comentarios"> Comentarios  </h2>';

$id=$_GET['id'];
if ( count($BD->entradas[$id]->comentarios) !=0 ){
    echo '<section>';
    foreach ($BD->entradas[$id]->comentarios as $comentario){

            echo '<article>';
                echo '<p>'.$comentario->autor.'  '.$comentario->fechaHora.'</p>';
                echo '<p>'.$comentario->texto.'</p>';
            echo '</article>';  
    }
    echo '</section>';
}

echo '<p><a href="/comentar.php?id='.$id.'"> Comentar </a></p>';
?> 