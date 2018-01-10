<?php

    if(isset($_POST['enviar'])){
        print_r($_POST);
        $titulo = $_POST['titulo'];
        $posicion = $_POST['posicion'];
        $duracion =$_POST['duracion'];
        $generos = $_POST['generos'];
        $album = $_POST['album'];
        try{
            
            $opcion = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
            $conexion = new PDO('mysql:host=localhost;dbname=discografia;','discografia','discografia',$opcion);


        }catch (PDOException $e) {
            echo 'Fallo la conexion '. $e->getMessage();
        }
        $consulta = 'INSERT INTO cancion (titulo,album,posicion,duracion,genero) VALUES ("'.$titulo.'","'.$album.'","'.$posicion.'","'.$duracion.'","'.$generos.'");';

        $conexion->query($consulta);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cancion nueva</title>
</head>
<body>

    <form action="cancionnueva.php" method="POST">
        <label for="titulo">Titulo : </label>
        <input type="text" name="titulo" placeholder="Inserte titulo "><br>

        <label for="posicion">Posicion : </label>
        <input type="number" name="posicion"><br>

        <label for="album"> Album : </label>
        <select name="album" id="album">
        <?php

            try{
                $opcion = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
                $conexion = new PDO ('mysql:host=localhost;dbname=discografia;', 'discografia' , 'discografia', $opcion);
            }catch(PDOException $e){

                echo "Fallo de la conexion ". $e->getMessage();

            }
            $consulta = 'SELECT codigo , titulo FROM album;';
            $resultado = $conexion->query($consulta);
    
            while($campos = $resultado->fetch(PDO::FETCH_ASSOC)){

                echo '<option value="'. $campos['codigo'] .'">'. $campos['titulo'] .' </option>';
            }

        ?>
        </select>


        <label for="duracion">Duracion : </label>
        <input type="number" name="duracion"><br>
        <label for="generos">Generos :</label>

        <select name="generos">
        <?php
           
            
            $consulta = 'SELECT SUBSTRING(COLUMN_TYPE,6,CHAR_LENGTH(COLUMN_TYPE)-6) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA="discografia" AND TABLE_NAME="cancion" AND COLUMN_NAME="genero";';
           
            $resultado = $conexion->query($consulta);
            $resultado = $resultado->fetch()[0];
            $resultado = str_getcsv($resultado, ',', "'");

            foreach($resultado as $options){

                echo '<option value="'.$options.'">'.$options.'</option>';

            }
        ?>
        </select>
        <input type="submit" name="enviar" value="insertar">
        
    </form>
</body>
</html>