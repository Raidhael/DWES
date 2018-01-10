<?php

//Se añade la clase
require_once('../includes/clases/clasebd.inc.php');
//Se inician las variables.
$texto='';
$titulo='';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <?php
    //Se añade la cabecera
        require_once('includes/cabecera_backend.inc.php');
    

    //En caso de que se reciba la variable mediante POST hacer validacion de campos.
        if (isset($_POST['guardar'])){
            $titulo=$_POST['titulo'];
            $texto=$_POST['texto'];
            $etiquetas=$_POST['etiquetas'];
            $imagen=$_POST['imagen'];
            header("location: /backend/listar.php");
         }else{     
   //Eliminar entrada           
           if (isset($_GET['eliminar']) && isset($_GET['id'])){
                $id=$_GET['id'];
                if ($_GET['eliminar'] == 1 ) {
                echo '<h1> La entrada '.$BD->entradas[$id]->titulo.' ha sido eliminada </h1>';
                }

                exit();
    //Se recoge id de entrada y se muestra para su edicion
            }else if (isset($_GET['id'])){
        
            $id=$_GET['id'];

            $texto=$BD->entradas[$id]->cuerpo;
            $titulo=$BD->entradas[$id]->titulo;   
    //Titulo en caso de editar una nueva entrada
            echo '<h1>Editar Entrada -> '.$titulo.'</h1>';
            
        }
        
        if (!isset($_GET['id'])){
    //Titulo en caso de creacion de una nueva entrada
            echo '<h1> Crear una entrada nueva </h1>';
        }

    ?>
    <!-- Formulario donde se almacenan / insertan los datos -->
    <form action="#" method="POST">
    <label for="titulo">Titulo</label>
        <input type="text" name="titulo" value="<?=$titulo?>" placeholder="titulo entrada"><br>
        <textarea name="texto"  cols="90" rows="40" value="hola"><?=$texto?></textarea><br>
    <label for="etiquetas">Etiquetas</label>
        <input type="text" name="etiquetas" placeholder="introduce etiquetas"><br>
    <label for="imagen">Imagen</label>
    <input type="file" name="imagen"> <br>
    <input type="submit" name="guardar" value="guardar">
    
    
    </form>

<?php
}

?>
</body>
</html>