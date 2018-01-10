<?php
require_once('includes/clases/clasebd.inc.php');
$error_hola='';

	if (isset($_POST['entrar'])){

		$existUsuario=FALSE;
		$usr=$_POST['usuario'];
		$pass=$_POST['pass'];

		

		foreach ($BD->usuarios as $usuario) {			

			if(	strcmp($_POST['usuario'],$usuario->nombre)== 0){

				$existUsuario=TRUE;


				if ( strcmp($_POST['pass'], $usuario->pass)==0 ){
					
					
					$existUsuario=TRUE;

				}else{
				

					$error_hola="El usuario o contraseña no coinciden";
					$existUsuario=FALSE;

				}

				if ($existUsuario==TRUE){			

						if ( strcmp($usuario->rol,"Admin") == 0 ){
											
						header('location: /backend/listar.php');

						}else {
										
						header('location: / ');
				}
			}
		}	
	

		

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
	<form action="#" method="POST">
		<input type="text" name="usuario" placeholder="Introduce nombre de usuario">
		<p>
			<?php
				echo $error_hola;

			?>
			
		</p>
		<input type="password" name="pass" placeholder="Contraseña"><br>
		<input type="submit" name="entrar" value="entrar">
	
	</form>

</body>
</html>