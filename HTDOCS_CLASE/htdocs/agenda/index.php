<!DOCTYPE html>


<?php
$contactoBorrado ='';
$nombre='';
$ape1='';
$ape2='';
$tlf='';
$idContacto='';
//Preparas la conexion para hacer consultas preparadas
$conexion = new mysqli('localhost','agenda','agenda','agenda');
$consulta = $conexion->stmt_init();

if (isset($_GET['id'])){

$id = $_GET ['id'];
	$consulta->prepare('SELECT count(*) FROM contactos WHERE id = ?');
	$consulta->bind_param('i',$id);
	$consulta->execute();
	$consulta->bind_result($existe);
	$consulta->fetch();
	
	
	if ($existe != 0 ) {

		$consulta->prepare('DELETE FROM contactos WHERE id =?;');
		$consulta->bind_param('i', $id);
		$consulta->execute();
		
		$contactoBorrado = " El contacto ha sido borrado";
	}

	$consulta->close();
		
}else if (isset($_POST['id'])){
	
	if ($_POST['id'] == NULL){	
	
		$nombre=$_POST['nombre'];
		$ape1=$_POST['ape1'];
		$ape2=$_POST['ape2'];
		$tlf=$_POST['telefono'];

		//Consulta
		$consulta->prepare('INSERT INTO contactos (nombre,ape1,ape2,tlf) VALUES (?,?,?,?);');
		$consulta->bind_param('ssss', $nombre, $ape1, $ape2, $tlf);
		$consulta->execute();
		header('location: / ');
		
	}else {
	
	$consulta->prepare('SELECT count(*) FROM contactos WHERE id = ?');
	$consulta->bind_param('i',$id);
	$consulta->execute();
	$consulta->bind_result($existe);
	$consulta->fetch();

	$nombre = $_POST ['nombre'];
	$ape1 = $_POST['ape1'];
	$ape2 = $_POST['ape2'];
	$tlf = $_POST['telefono'];

		print_r($_POST);

		echo $existe;
	if ($existe == 1 ){
		$consulta->prepare('UPDATE contactos SET nombre = ?, ape1 = ? , ape2 = ? , tlf= ? WHERE id = ?');
		$consulta->bind_param('ssssi', $nombre, $ape1,$ape2,$tlf,$_POST['id']);
		$consulta->execute();
		header('location: /');
}
}
	$consulta->close();
}else if ( isset($_GET['mod'])){
	$id = $_GET['mod'];
	
	$consulta->prepare('SELECT count(*) FROM contactos WHERE id = ?');
	$consulta->bind_param('i',$id);
	$consulta->execute();
	$consulta->bind_result($existe);
	$consulta->fetch();

	if ($existe != 0 ) {
		$consulta->prepare('SELECT * FROM contactos WHERE id = ?');
		$consulta->bind_param('i',$id);
		$consulta->execute();
		$consulta->bind_result($idContacto,$nombre,$ape1,$ape2,$tlf);
		$consulta->fetch();
		
		
	}
	
}



?>
<html lang="es">
	<head>
		<?php

			require_once( 'agenda.inc.php' );

		?>
		<meta charset="UTF-8">
		<title>t3-act1.php</title>
	</head>
	<body>
	<?php

	?>
		<form action="/" method="POST">
			<label for="id"> ID : </label>
			<input type="text" name ="id"  placeholder= "ID " value="<?=$idContacto?>" readonly> <br>
			<label for ="nombre"> Nombre :  </label>
			<input type="text" name="nombre" placeholder="nombre" value ="<?=$nombre?>"><br>
			<label for="ape1">1º apellido : </label>
			<input type="text" name="ape1" placeholder="apellido" value ="<?=$ape1?>"><br>
			<label for="ape2">2nd Apellido : </label>
			<input type="text" name="ape2" placeholder="Segundo apellido" value ="<?=$ape2?>"><br>
			<label for="telefono">Telefono : </label>
			<input type="text" name="telefono" placeholder="Telefono" value ="<?=$tlf?>"><br>
			<input type="submit" name="registrar" value="Registrar">
			<input type="reset" value="reset">
		</form>
<?php


	 
	$consulta='SELECT * FROM contactos;';
	$verifi='SELECT count (*) FROM contactos;';
	$verificacion=$conexion->query($verifi);
	
	$contactos=$conexion->query($consulta);
	echo $contactoBorrado.'<br>';
	$datos = $contactos->fetch_assoc();
	
	while ($datos != NULL){

		echo 'Nombre : '. $datos['nombre'].' '. $datos['ape1'].' '. $datos['ape2'].' '. $datos['tlf'];

	echo '<a href="index.php?mod='.$datos['id'] .'"><img src="/img/edit.jpg" alt="modificar contacto" width = 20px height=20px></a><a href="index.php?id='.$datos['id'] .'"><img src="/img/papelera.png" alt="eliminar contacto" width =20px height=20px></a><br>';
		$datos = $contactos->fetch_assoc();
	}


?>

	</body>
</html>