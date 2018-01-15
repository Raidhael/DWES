<?php
    ini_set('session.name','SessionDelBlog');
    session_start();

    if (!isset($_SESSION['nombre']))
        header('location: /');
    

    if (isset($_SESSION['tipoUsuario']) &&  strcmp($_SESSION['tipoUsuario'],'administrador') != 0)
        header('location: /');
    //variables de manejo.
    $titulo ="";
    $usuario =$_SESSION['nombre'];
    $cuerpo ="";
    $fechaEditar = date('Y-d-m');
    $manejo="insertar";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edicion</title>
    <link rel="stylesheet" href="/css/estilo.css">
    
</head>
<body>
    <?php
    
    //TODO : 3 funcionamientos , editar, insertar y eliminar
	//Conexion a la base de datos
    $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    try {
        $conexion = new PDO('mysql:host=localhost;dbname=blogdwes', 'userblog', 'passblog', $opc);	
    } catch (PDOException $e) {
        echo 'Falló la conexión: ' . $e->getMessage();
    }
    require_once('../includes/cabecera.inc.php');
 
    //variables para el formulario

    //EDITAR
    if (isset($_GET['id']) && isset($_GET['editar']) && $_GET['editar'] == 0) {
		//Preparacion de consulta para ver que el id no ha sido modificado 
		$consulta=$conexion->prepare('SELECT count(*) FROM entrada WHERE id = :id');
		$consulta->bindParam(':id',$_GET['id']);
		$consulta->execute();
		$existeEntrada=$consulta->fetch(PDO::FETCH_NUM)[0];        
        if ( $existeEntrada == 0) header('location: /backend/listar.php');
		//Si no, se muestra la entrada
		else {
            $consulta=$conexion->prepare('SELECT * FROM entrada WHERE id = :id');
            $consulta->bindParam(':id',$_GET['id']);
            $consulta->execute();
            $datosEntrada = $consulta->fetch(PDO::FETCH_ASSOC);
            if ($datosEntrada != null) {
                $titulo = $datosEntrada['titulo'];
                $usuario = $conexion->query('SELECT nombre FROM usuario WHERE user ='.$datosEntrada['usuario'].';')->fetch(PDO::FETCH_NUM)[0];
                $cuerpo = str_replace('<br>',"\r\n",$datosEntrada['cuerpo']);
                $fechaEditar = $datosEntrada['fecha'];
                $manejo = 'editar';
            }
        }
    //ELIMINAR
    }
    if (isset($_GET['id']) && isset($_GET['eliminar']) && $_GET['eliminar'] == 0) {
		//Preparacion de consulta para ver que el id no ha sido modificado 
		$consulta=$conexion->prepare('SELECT count(*) FROM entrada WHERE id = :id');
		$consulta->bindParam(':id',$_GET['id']);
		$consulta->execute();
		$existeEntrada=$consulta->fetch(PDO::FETCH_NUM)[0];        
        if ( $existeEntrada == 0) header('location: /backend/listar.php');
		//Si no, se elimina la entrada
		else {
            $consulta=$conexion->prepare('DELETE FROM entrada WHERE id = :id');
            $consulta->bindParam(':id',$_GET['id']);
            $consulta->execute();
            header('location: /backend/listar.php');
            exit();
            }
        }
    
    if (isset($_POST['manejo'])){        
        //funcion insertar
        if (strcmp($_POST['manejo'],'insertar') == 0 ){
            //Se saca el id del usuario
            $user=$conexion->query('SELECT user FROM usuario WHERE nombre like "'.$_SESSION['nombre'].'";')->fetch(PDO::FETCH_NUM)[0];
            $consulta=$conexion->prepare('INSERT INTO entrada (titulo, usuario, cuerpo, fecha) VALUES (:titulo, :usuario, :cuerpo, :fecha);');
            $consulta->bindParam(':titulo',$_POST['titulo']);
            //Cambio en el retorno de carro
            $cuerpo = str_replace("\r\n",'<br>',$_POST['cuerpo']);
            $consulta->bindParam(':cuerpo',$cuerpo);  
            $consulta->bindParam(':usuario', $user);
            $fechaEditar=date('Y-m-d');
            $consulta->bindParam(':fecha',$fechaEditar);   
            
            $consulta->execute();
            header('location: /backend/listar.php');
            exit();

        }
        //funcion editar
        if (strcmp($_POST['manejo'],'editar') == 0 ){

            //Preparacion de consulta
            $consulta=$conexion->prepare('UPDATE entrada SET titulo = :titulo , cuerpo = :cuerpo WHERE id = :id;');
            $consulta->bindParam(':titulo',$_POST['titulo']);

            //Cambio en el retorno de carro
            $cuerpo = str_replace("\r\n",'<br>',$_POST['cuerpo']);
            $consulta->bindParam(':cuerpo',$cuerpo);
            $consulta->bindParam(':id',$_GET['id']);
            $consulta->execute();
            //Linea para que se actualice el formulario con la nueva informacion editada
            header('location: /backend/editar.php?editar=0&id='.$_GET['id']);
        }

    }
    



    



    ?>
    <form action="#" method="POST">
        <label for="titulo">Titulo:</label><br>
        <textarea id="titulo" name="titulo" cols="5" rows="3"><?=$titulo?></textarea><br>
        <label for="cuerpo">Cuerpo:</label><br>
        <textarea id="cuerpo" name="cuerpo" cols="50" rows="30"><?=$cuerpo?></textarea><br>
        <input type="text" name="fecha" value=<?=$fechaEditar?> readonly><br>
        <input type="text" name="usuario" value=<?=$usuario?> readonly><br>
        <input type="submit" value="guardar" name="guardar">
        <input type="hidden" name="manejo" value=<?=$manejo?>>
    
    </form>
    <br> <br>
    <a href="/backend/listar.php">Ir a la lista</a>
</body>
</html>

