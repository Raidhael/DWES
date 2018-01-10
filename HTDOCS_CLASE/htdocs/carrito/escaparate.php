<?php
    //CREACION DE SESION
    ini_set('session.cookie_lifetime' ,600);
    ini_set('session.name','SessionDeSergio');
    session_start();
    
    $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8');
    try {
        $conexion = new PDO('mysql:host=localhost;dbname=badulaque','badulaque','badulaque', $opc);
        
    }catch(PDOException $e ){
        echo 'Fallo la conexion '.$e->getMessage();
    }

    if (isset($_GET['producto'])){

    //Variable de sesion para el tiempo de caducidad
      /*  if (!isset($_SESSION['time'])){

            $_SESSION['time'] = time()+600 ;

        }else{

            $tiempo = $_SESSION['time'];
            $tiempo = $tiempo - time();
            $minutos = $tiempo /60 % 60;
            if ($minutos < 10) $minutos = '0'.$minutos;
            $segundos = $tiempo %60;
            $tiempoExpiracion = $minutos.':'.$segundos;

            echo ' tiempo restante en la sesion = '.$minutos;
        }*/

        if (!isset($_SESSION['prod_'.$_GET['producto']]))
            $_SESSION['prod_'.$_GET['producto']] = 0;

        if ($_GET['cantidad'] == 1)
            $_SESSION['prod_'.$_GET['producto']]++;
        else if ($_GET['cantidad'] == 0)
            $_SESSION['prod_'.$_GET['producto']] = 0;
        else if ($_GET['cantidad'] == -1)
            if ($_SESSION['prod_'.$_GET['producto']]>0)
                $_SESSION['prod_'.$_GET['producto']]--;
         
    }
           
    


    
    print_r($_SESSION);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Escaparate</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <header>
        <h1><a href="/carrito/escaparate.php"> ESCAPARATE </a></h1>
        <a href="/carrito/carrito.php"> Ir al carrito </a>
    </header>
    
    <section>
        <h2>Nuestros Productos</h2>
        
<?php

    $consulta = 'SELECT codigo , nombre , precio , unidad , imagen FROM productos;';
    $resultado = $conexion->query($consulta);
    
    while (($productos = $resultado->fetch(PDO::FETCH_ASSOC)) !=null) {
        echo '<article class="producto">';
        echo ' <h3>'.$productos['nombre'].'</h3>';
        echo '<img src="'.$productos['imagen'].'" alt="'.$productos['nombre'].'"><br>';
        echo '<span> Precio : '.$productos['precio'].'€ '.$productos['unidad'].'</span> <br>';
        echo '<span>';
      
            if ( !isset ($_SESSION['prod_'.$productos['codigo']]) ) echo '0';
            else echo $_SESSION['prod_'.$productos['codigo']];
      
        echo 'Unidades </span> <br>';
        echo ' <a href="/carrito/escaparate.php?producto='.$productos['codigo'].'&cantidad=1"><img src="img/mas.png" alt="mas"></a>';
        echo ' <a href="/carrito/escaparate.php?producto='.$productos['codigo'].'&cantidad=-1"><img src="img/menos.png" alt="mas"></a>';
        echo ' <a href="/carrito/escaparate.php?producto='.$productos['codigo'].'&cantidad=0"><img src="img/papelera.png" alt="mas"></a>';
        echo '</article>';
       
       
       //.'?'.$productos['id'].'&cantidad=1"'
    }

?>
    </section>

</body>
</html>