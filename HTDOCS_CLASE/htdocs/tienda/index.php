<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Principal</title>
</head>
<body>
    <h1> Lista de productos </h1>
    <?php
        $conexion = new mysqli ('localhost','dwes','dwes','dwes');
        $consulta = "SELECT  cod , nombre_corto FROM producto ;";
        $result  = $conexion->query($consulta);

        $stock = $result->fetch_assoc();

        while ($stock !=null ) {
            echo '<a href="stock.php?cod='.$stock['cod'].'">Codigo : '.$stock['cod'].'<br>Nombre : '.$stock['nombre_corto'].'<br><br>';
            $stock = $result->fetch_assoc();
        }

    ?>
</body>
</html>