<?php

if (isset($_POST['enviar'])) {
    $titulo=$_POST['titulo'];
    $discografia=$_POST['discografia'];
    $fechaLac=$_POST['fechaLac'];
    $fechaCompra=$_POST['fechaCompra'];
    $precio=$_POST['precio'];
    $formato= $_POST['formato'];
    try{
        
        $conexion = new PDO('mysql:host=localhost;dbname=discografia','discografia','discografia');

    }catch(PDOException $e){
        echo 'Fallo la conexion '.$e->getMessage();
    }
    $consulta = 'INSERT INTO album (titulo,discografia,formato,fechaLanzamiento,fechaCompra,precio) VALUES ("'.$titulo.'","'.$discografia.'","'.$formato.'","'.$fechaLac.'","'.$fechaCompra.'","'.$precio.'");';
    //echo $consulta;
    $conexion->exec($consulta);
    unset($conexion);
    
    header('location:disconuevo.php');
  
     
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Disco Nuevo php</title>
</head>
<body>
    <form action="disconuevo.php" method="POST">
        <label for="titulo">Titulo</label>
            <input type="text" name= "titulo" placeholder="Inserte titulo" ><br>
        <label for="discografia">Discografia</label>
            <input type="text" name="discografia" placeholder="Inserte Discografia"><br>
        <label for="formato">Formato : </label>
        <select name="formato" id="formato">
        <?php
            try{
        
                        $conexion = new PDO('mysql:host=localhost;dbname=discografia','discografia','discografia');
        
            }catch(PDOException $e) {
        
                        echo "Fallo la conexion ". $e->getMessage();
        
            }
            /*
        SELECT SUBSTRING(COLUMN_TYPE,6,CHAR_LENGTH(COLUMN_TYPE)-6)
        FROM information_schema.COLUMNS
        WHERE TABLE_SCHEMA='discografia' 
            AND TABLE_NAME='album'
            AND COLUMN_NAME='formato';


        $resultado = str_getcsv($resultado, ',', "'");
        print_r($resultado);
            */

            $consulta = 'SELECT SUBSTRING(COLUMN_TYPE,6,CHAR_LENGTH(COLUMN_TYPE)-6) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA="discografia" AND TABLE_NAME="album" AND COLUMN_NAME="formato";';
            $resultado = $conexion->query($consulta);
            $resultado = $resultado->fetch()[0];
            $resultado = str_getcsv($resultado, ',', "'");
           foreach($resultado as $options){
               echo '<option value="'.$options.'">'.$options.'</option>';
           }
            
            /*$consulta = 'SHOW COLUMNS FROM album like "formato";';
            $resultado = $conexion->query($consulta);
            $info = $resultado->fetch()[1];
            $info = explode ("('",$info);
            $info = substr($info[1],0,-2);
            $info = str_replace(array("'",","), array(""," "), $info);
            $info=explode(" ", $info);
         
            foreach($info as $opcion) {
                echo '<option value='.$opcion.'>'.$opcion.'</option>';
            }*/
                ?>

           <!--<option value="vinilo"> vinilo </option>
           <option value ="cd">cd</option>
           <option value="dvd">dvd</option>
           <option value="mp3">mp3</option>-->

        </select><br>
       
        <label for="fechaLac">Fecha de lanzamiento</label>    
            <input type="date" name="fechaLac"  value="<?=$fechaLac?>"><br>
        <label for="fechaCompra">Fecha de compra : </label>
            <input type="date" name="fechaCompra"  value="<?=$fechaCompra?>"><br>
        <label for="Precio">Precio : </label>
            <input type="number" name="precio" value="<?=$precio?>" steps=2><br>

            <input type="submit" name="enviar" value ="Enviar">
    </form>
<?php

?>
</body>
</html>