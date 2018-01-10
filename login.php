<?php

ini_set('session.name','SessionDelBlog');
session_start();
require_once('includes/clases/clasebd.inc.php');
$errorAcceso='';

	if (isset($_POST['entrar'])){
		$nombre = $_POST['usuario'];
		$pass = $_POST['pass'];

		try{
                            
			$opcion = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
			$conexion = new PDO('mysql:host=localhost;dbname=blogdwes;','userblog','passblog',$opcion);
		}catch (PDOException $e) {
			echo 'Fallo la conexion '. $e->getMessage();
		}
		$consulta = $conexion->prepare('SELECT count(*) FROM usuario WHERE nombre like :nombre');
		$consulta->bindParam(':nombre',$nombre);
		$consulta->execute();
		$existeNombre = $consulta->fetch(PDO::FETCH_NUM)[0];
	
		if ($existeNombre != null && $existeNombre == 1){
			$consulta = $conexion->prepare('SELECT nombre, clave, rol FROM usuario WHERE nombre like :nombre');
			$consulta->bindParam(':nombre',$nombre);
			$consulta->execute();
			$existeNombre = $consulta->fetch(PDO::FETCH_ASSOC);

			$hash = $existeNombre['clave'];
			
			if (password_verify($pass,$hash)){

				$rol = $existeNombre['rol'];

				$consulta = 'SELECT SUBSTRING(COLUMN_TYPE,6,CHAR_LENGTH(COLUMN_TYPE)-6) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA="blogdwes" AND TABLE_NAME="usuario" AND COLUMN_NAME="rol";';
				$resultado = $conexion->query($consulta);
				$resultado = $resultado->fetch()[0];
				$resultado = str_getcsv($resultado, ',',"'");
				
				foreach($resultado as $tipoDeUsuario){
					if (strcmp($tipoDeUsuario,$rol)== 0){
						$_SESSION['tipoUsuario'] = $rol;
						header('location: /index.php');
					}
				}
			}else{
				
				$errorAcceso = '<div class="alertaError"> El nombre o la contraseña no coinciden </div>';
			}
		}else{
			
			$errorAcceso = '<div class="alertaError"> El nombre o la contraseña no coinciden </div>';
		}
		}
	


?>




<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>
	<?php
	require_once('includes/cabecera.inc.php');	
	?>
	<h2> Login</h2>
	<?=$errorAcceso?>
	<form action="#" method="POST">
		<input type="text" name="usuario" placeholder="Introduce nombre de usuario"><br>
		<input type="password" name="pass" placeholder="Contraseña"><br>
		<input type="submit" name="entrar" value="entrar">
	
	</form>

</body>
</html>