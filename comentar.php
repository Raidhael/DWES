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
if (isset($_POST['comentar'])){
    $nombre=$_POST['nombre'];
    $comentario=$_POST['comentario'];

    echo '<h3>'.$nombre.'</h3>';
    echo '<p>'.$comentario.'</p>';

    echo' <a href="/">[HOME]</a>';

}else{

?>
    <h1> Comentar </h1>
    <form action="#" method="POST">
        <input type="text"  name="nombre" placeholder="nombre usuario"><br>
        <textarea name="comentario" id="" cols="30" rows="10"></textarea>
        <input type="submit" name="comentar" value="comentar">
        <a href="/">[HOME]</a>
    
    </form>

<?php
}
?>
</body>
</html>