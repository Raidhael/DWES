<!DOCTYPE html>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
if (isset($_POST['comentar']) && $_POST['comentar'] != null){
    $nombre=$_SESSION['nombre'];
    $insertComentario=$_POST['comentario'];
    $insertComentario = str_replace("\r\n",'<br>',$insertComentario);
    $fecha = date('Y-m-d');
    $buscaAutor = 'SELECT user FROM usuario WHERE nombre like "'.$_SESSION['nombre'].'";';
    $autor = $conexion->query($buscaAutor)->fetch(PDO::FETCH_NUM)[0];
    $consulta =$conexion->prepare('INSERT INTO comentario(idEntrada,fecha,autor,texto) VALUES (:idEntrada,"'.$fecha.'",'.$autor.',:texto)');
    $consulta->bindParam(':idEntrada',$_GET['id']);
    $consulta->bindParam(':texto',$insertComentario);
    $consulta->execute();
   header('location: index.php?id='.$_GET['id']);
}


?>
    <h1 id="comentarios"> Comentar </h1>
    <form action="#" method="POST">
        <input type="text"  name="nombre" value=<?=$_SESSION['nombre']?> readonly><br>
        <textarea name="comentario" id="" cols="30" rows="10"></textarea><br>
        <input type="submit" name="comentar" value="comentar">
    </form>
<?php
    $comentarios=$conexion->prepare('SELECT * FROM comentario WHERE idEntrada = :id');
    $comentarios->bindParam(':id',$_GET['id']);
    $comentarios->execute();
    while (($muestraComentarios = $comentarios->fetch(PDO::FETCH_ASSOC)) != null) {
        $buscaAutor = 'SELECT nombre FROM usuario WHERE user like "'.$muestraComentarios['autor'].'";';
        $autor = $conexion->query($buscaAutor)->fetch(PDO::FETCH_NUM)[0];
        echo '<br><br>'.$autor.' '.$muestraComentarios['fecha'].'<br>';
        echo $muestraComentarios['texto'];
       

    }

?>
</body>
</html>