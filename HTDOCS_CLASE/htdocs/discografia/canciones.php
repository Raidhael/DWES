CO<?php
    print_r($_POST);
    try{
        $opcion = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        $conexion = new PDO ('mysql:host=localhost;dbname=discografia;', 'discografia' , 'discografia', $opcion);
    }catch(PDOException $e){

        echo "Fallo de la conexion ". $e->getMessage();
    }
    if (isset($_POST['enviar'])) {

        $textoBuscado = $_POST['buscador'];
        $tipoBusqueda = $_POST['tipoBusqueda'];
        $generos = $_POST['generos'];
        //TRES TIPOS DE BUSQUEDA

        $consulta = 'SELECT * FROM canciones WHERE ';

        if ( strcmp($tipoBusqueda,'titulos') == 0 ){
            $consulta .=' titulo LIKE "'.$textoBuscado.'" AND genero LIKE "'.$generos.'"';
        }else if(strcmp($tipoBuscado,'nombreAlbum') == 0 ){
            $sacaID = 'SELECT codigo FROM album WHERE titulo LIKE '".$textoBuscado."';';
            $resultado = $conexion->query($sacaID);
            $id = $resultado->fetch()[0];
            $consulta. =' album ='. $id .'';
        }

    }


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Busca canciones</title>
</head>
<body>
    <fieldset>
        <legend><h2>Buscador</h2></legend>
        <form action="/canciones.php" method ="POST">
            <label for="buscador"> Texto a buscar </label><input type="text" name="buscador" id="buscador"><br>
            <label for="tipoBusqueda">Buscar en :</label>
            <input type="radio" name="tipoBusqueda" id="tipoBusqueda" value="titulos"> Titulos de Cancion
            <input type="radio" name="tipoBusqueda" id="tipoBusqueda" value="nombreAlbum">Nombres de albun
            <input type="radio" name="tipoBusqueda" id="tipoBusqueda" value="ambosCampos">Ambos Campos <br>
            <label for="generos"> Genero musical</label>
            <select name="generos" id="generos">
            <?php

               
                $consulta = 'SELECT SUBSTRING(COLUMN_TYPE,6,CHAR_LENGTH(COLUMN_TYPE)-6) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA="discografia" AND TABLE_NAME="cancion" AND COLUMN_NAME="genero";';
                $resultado = $conexion->query($consulta);
                $resultado = $resultado->fetch()[0];
                $resultado = str_getcsv($resultado, ',',"'");
                foreach($resultado as $generos){
                    echo '<option value="'.$generos.'">'.$generos.'</option>';
                }

            ?>
            </select>
            <br><input type="submit" name="enviar" value ="Buscar"> 
        </form>
        
        

    </fieldset>

</body>
</html>