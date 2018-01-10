<?php
/*
PENDIENTES:

CAMBIAR NOMBRE ARRAYS, COMPROBAR COMPROBACIONES

*/



//ARRAYS

$options=['Selecciona el aula','Info01','Info02','Info03','Info04','Info05','Info06'];
$aulas=['Selecciona el curso','1DAW', '1ASIR', '2DAW', '2ASIR', '1DAM', '2DAM', '1SMX', '2SMX', '1ESO', '2ESO', '3ESO', '4ESO', '1BATX'];
$grupos=['Selecciona la letra','A','B','C','D','Sin grupo'];

//VARIABLES

$nombre='';

$primerApe='';

$segundoApe='';

$pass='';


$valorAula='';

$valorGrupo='';

$cifraPass='';

$puesto='';

$problema='';

$control='';


$flag=TRUE;

print_r($_POST);

//Asignacion de valor cuando el formulario es enviado

if (isset($_POST['enviar'])){

	$nombre=$_POST['nombre'];
	$primerApe=$_POST['apellido'];
	$segundoApe=$_POST['apellido2'];
	$pass=$_POST['pass'];
	$valorAula=$_POST['aula'];
	$valorGrupo=$_POST['grupo'];
	$valorLetra=$_POST['letra'];
	$puesto=$_POST['puesto'];
	$estado=$_POST['estado'];
	$problema=$_POST['problema'];
	$control=$_POST['stp'];



	//VALIDACION NOMBRE
	
	
	if (empty($nombre)){

		$nombreVacio=TRUE;

		$falloNombreVacio="* Debes rellenar este campo ";

		
	}else{
		trim($nombre);
	for ($i=0;$i< strlen($nombre);$i++){

		if (is_numeric($nombre[$i])) $falloNombre=TRUE;

		$falloNombreNum="* No se admiten numeros en el nombre";
	}
	}
	//VALIDACION APELLIDO
	$falloaApePrimero=''; 
	$falloApeSegundo='';
	$falloApeVacia='';

	trim($primerApe,$segundoApe);
	for ($i=0;$i< strlen($primerApe);$i++){

		if (is_numeric($primerApe[$i])){
			 $falloPrimerApellido=TRUE;
			 $falloaApePrimero="* No se admiten numeros en el apellido";
		}
		
	}
	for ($i=0;$i< strlen($segundoApe);$i++){

		if (is_numeric($segundoApe[$i])) {
			$falloSegundoApellido=TRUE;
			$falloApeSegundo="* No se admiten numeros en el apellido";
		}

	}


	//VALIDACION PASS
		$j=0;
		$falloLong='';
		$falloPass='';
		$falloVacia='';
	if(empty($pass)){

		$falloVacia="* Debes rellenar este campo";

	}else if(srtlen($pass)>64 || srtlen($pass)<8){

		$falloLongPass=TRUE;
		$falloLong="* Por favor inserte una longitud entre 8 y 64 caracteres"; 

	}else{
			
		for ($i=0;$i< strlen($pass);$i++){
	
			if (strcmp($pass[$i]," ") == 0){

				$falloPass=TRUE;
				$falloPass="No se aceptan espacios lo sentimos";
			}
		}
	}

	//VALIDACION AULA,GRUPO Y LETRA

		if (empty($valorAula)  || in_array($valorAula, $options) == False ) $falloAula=TRUE;
		if (empty($valorGrupo) || in_array($valorGrupo, $aulas) == False) $falloGrupo=TRUE;
		if (empty($valorLetra) || in_array($valorLetra, $grupo) == False) $falloLetra=TRUE;


	//








}

?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>GESTION</title>
</head>




<body>


<?php
	require_once('php/cabecera.inc.php');
	
?>
			<!-- strlength para longitud de la variable-->
			<form action="#" method="POST">
				<fieldset>
					<legend> Formulario </legend>
						<label for="nombre">Nombre</label>
							<input type="text" name="nombre" placeholder="Nombre" value="<?=$nombre?>" id="nombre" ><br>
						<label for ="P_apellido"> 1º Apellido </label>
							<input type="text" name="apellido" placeholder="Primer apellido" value="<?=$primerApe?>" id="P_apellido" ><br>
						<label for="S_apellido">2º Apellido</label>
							<input type="text" name="apellido2" placeholder="Segundo apellido" value="<?=$segundoApe?>" id="S_apellido" ><br>
						<label for="password">Clave</label>
							<input type="password" name="pass" placeholder="Contraseña" value="<?=$cifraPass?>" id="password"  ><br>
						<label for="aula">Aula</label>
							<select name="aula" id="aula">

								<?php
									foreach ($options as $aula) {
										echo '<option value="'. $aula .'">'. $aula .'</option>';
									}
								?>	

							</select>
						<label for="grupos">Grupo</label>
							<select name="grupo" id="grupo">
								<?php

									foreach ($aulas as $grupo) {
										echo '<option value="'. $grupo .'">'. $grupo .'</option>';
									}
								?>		


							</select>
							<select name="letra" >
								<?php									
									foreach ($grupos as $letra) {
										echo '<option value="'. $letra .'">'. $letra .'</option>';
									}

								?>		


							</select>
						<br>
						<label for="puesto">Puesto</label>
							<input type="number" name="puesto"  value="<?=$puesto?>" placeholder="030" id="puesto" min=001 max=100 >
						<br>
						<label for="estado">Estado</label>
						<input type="radio" name="estado" value="0" > Correcto<br>
						<input type="radio" name="estado" value="1"> Presenta algún problema : <br>
						<input type="text" name="problema" value="<?=$problema?>" placeholder="Explica el problema">
						<br>
						<input type="submit" name="enviar" value="enviar">
						<input type="reset" name="reset" value="borrar" >
						<input type="hidden" name="stp" value=0>
				</fieldset>

			</form>

		
	</body>
</html>
