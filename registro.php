<?php
$nombre='';
$alertNombreCogido ='';
$alertPass='';
//CONEXION A LA BASE DE DATOS
if (isset($_POST['aceptar']) && $_POST['validar'] == 1) {
    try{
                            
        $opcion = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        $conexion = new PDO('mysql:host=localhost;dbname=blogdwes;','userblog','passblog',$opcion);


    }catch (PDOException $e) {
        echo 'Fallo la conexion '. $e->getMessage();
    }
    $nombre = $_POST['nombre'];
    $pass = $_POST['pass'];
    $pass1 = $_POST['pass1'];
    $rol = $_POST['rol'];
    $consulta = $conexion->prepare('SELECT count(*) FROM usuario WHERE nombre like :nombre');
    $consulta->bindParam(':nombre',$nombre);
    $consulta->execute();
    $validaNombre = $consulta->fetch(PDO::FETCH_NUM)[0];
    
    if ($validaNombre != null && $validaNombre > 0) $alertNombreCogido='<span class=alert> *El nombre introducido  ya esta en uso, por favor seleccione otro</span>';
    else{

        //Expresion regular para validar nombre
        $patronNombre ='/^[A-Za-záéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäÄëËïÏöÖüÜñÑçÇ]{1}[\dA-Za-záéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäÄëËïÏöÖüÜñÑçÇ]{4,24}$/';
        $patronClave = '/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/';//REGLA: Longitud de 8 ademas de al menos un caracter en mayuscula en minuscula y numero, acepta simbolos especiales
            
    //VALIDACION DE DATOS
        //VALIDACION DE NOMBRE
        if (preg_match($patronNombre,$nombre)) {
            
        //VALIDACION DE CLAVE    
            if (strcmp($pass,$pass1) == 0 && preg_match($patronClave, $pass)) {
                //ENCRIPTACION DE LA CLAVE 
                    $pass = password_hash($pass,PASSWORD_DEFAULT);
                    
        //VALIDACION DE ROL
                if (!empty($rol)){
                    
                    $rolOk=false;
                
                    $consulta = 'SELECT SUBSTRING(COLUMN_TYPE,6,CHAR_LENGTH(COLUMN_TYPE)-6) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA="blogdwes" AND TABLE_NAME="usuario" AND COLUMN_NAME="rol";';
                    $resultado = $conexion->query($consulta);
                    $resultado = $resultado->fetch()[0];
                    $resultado = str_getcsv($resultado, ',',"'");
                    
                    foreach($resultado as $campos){
                    if (strcmp($campos,$rol)==0) $rolOk=true;
                    }
                }
        //SI $rolOk da false sera redireccionado a la raiz
                if ($rolOk){
                    
                    $consulta = $conexion->prepare('INSERT INTO usuario (nombre,clave,rol) VALUES (:nombre,:clave,:rol);');
                    $consulta->bindParam(':nombre',$nombre);
                    $consulta->bindParam(':clave',$pass);
                    $consulta->bindParam(':rol',$rol);
                    $consulta->execute();
                    heder('location/index.php?registroCompletado=0');
                }else{
                    header('location: /');
                }
            }else {
                $alertPass=' <span class=alert> * La clave debe contener al menos una mayuscula, una minuscula y un numero</span>';
            }        
        }
    }
}
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
                <input type="text" name="nombre" placeholder="Nombre usuario" value="<?=$nombre?>" id="nombre" ><?=$alertNombreCogido?>

                <br>
            <label for="pass">Password</label>
                <input type="password" name="pass" placeholder="Password"  id="pass"> <?=$alertPass?>

                <br>

            <label for="pass1">Repite Password</label>
                <input type="password" name="pass1" placeholder="Repite password"  id="pass1">
                <br>
            <label for="rol">Rol:</label>
            <select name="rol" id="rol">
            <?php
//SE MUESTRA LOS VALORES ENUM DEL CAMPO ROL DE LA TABLA USUARIO EN LA BASE DE DATOS BLOGDWES 
                try{
                            
                    $opcion = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
                    $conexion = new PDO('mysql:host=localhost;dbname=blogdwes;','userblog','passblog',$opcion);


                }catch (PDOException $e) {
                    echo 'Fallo la conexion '. $e->getMessage();
                }
                 $consulta = 'SELECT SUBSTRING(COLUMN_TYPE,6,CHAR_LENGTH(COLUMN_TYPE)-6) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA="blogdwes" AND TABLE_NAME="usuario" AND COLUMN_NAME="rol";';
                 $resultado = $conexion->query($consulta);
                 $resultado = $resultado->fetch()[0];
                 $resultado = str_getcsv($resultado, ',',"'");
                
                 foreach($resultado as $rol){
                    echo '<option value="'.$rol.'">'.$rol.'</option>';
                }
            ?>
            </select> <br>

                <input type="hidden" name="validar" value="1" id="validar">
                <input type="submit" name="aceptar" value="aceptar">
                <input type="reset" name="reset" value="reset">
        </form>



</body>
</html>