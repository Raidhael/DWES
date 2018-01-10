<?php
ini_set('session.name','SessionDeSergio');
session_start();
    var_dump($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
</head>
<body>
<?php
    $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8');
    try {
        $conexion = new PDO('mysql:host=localhost;dbname=badulaque','badulaque','badulaque', $opc);
        
    }catch(PDOException $e ){
        echo 'Fallo la conexion '.$e->getMessage();
    }

?>
    
</body>
</html>