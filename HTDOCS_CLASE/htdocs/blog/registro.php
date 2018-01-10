<?php

//FALTAN TEXTO DE ERROR && EXPRESIONES REGULARES



    if (isset($_POST['validar']) && $_POST['validar'] != 1){

        header("location : /index.php ");
        
        exit();
    }

    $nombre="";
    $pass="";
    $pass1="";
    $falloVacia='';
    $falloLong='';
    $falloPass='';

    $nombreVac=FALSE;
    $passVac=FALSE;
    $pass1Vac=FALSE;
    $passFallo=FALSE;


    if (isset($_POST['aceptar'])){ 

    $nombre=$_POST['nombre'];
    $pass=$_POST['pass'];
    $pass1=$_POST['pass1']; 

    if (empty($nombre)){

        $nombreVac=TRUE;

    }else trim($nombre);

    if (empty($pass)){

        $passVac=TRUE;
    }else trim($pass);

    if (empty($pass1)){

        $pass1Vac=TRUE;
    }else trim($pass1);  


    if ($pass != $pass1) {

        $passFallo=TRUE;
    }

    }

    if (isset($_POST['aceptar']) && $nombreVac !=TRUE && $passVac != TRUE && $pass1Vac != TRUE && $passFallo!=TRUE){

    echo "<h1> EL REGISTRO SE HA COMPLETADO CORRECTAMENTE </h1>";
    echo '<p>Nombre de usuario : '.$nombre.'</p>';
    echo '<p>Pass :';
    $long=strlen($pass);
    for($i=0;$i<$long;$i++){
        echo '*';
    }
    echo '</p>';
    echo '<a href="index.php">[ HOME ] </a>';

}else {




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
</head>
<body>
<?php
    require_once('includes/cabecera.inc.php');
    
    
?>
        <form action="#" method="post">
            <label for="nombre">Nombre</label>
                <input type="text" name="nombre" placeholder="Nombre usuario" value="<?=$nombre?>" id="nombre" >

                <br>
            <label for="pass">Password</label>
                <input type="password" name="pass" placeholder="Password"  id="pass">

                <br>

            <label for="rpass">Repite Password</label>
                <input type="password" name="pass1" placeholder="Repite password"  id="pass1">

                <br>
                <input type="hidden" name="validar" value="1" id="validar">
                <input type="submit" name="aceptar" value="aceptar">
                <input type="reset" name="reset" value="reset">
        </form>

<?php
 }
?>


</body>
</html>