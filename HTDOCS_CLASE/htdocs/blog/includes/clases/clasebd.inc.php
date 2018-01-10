<?php
 
require_once("claseEntrada.inc.php");
require_once ("claseUsuario.inc.php");
class BD {

	public $entradas;
	public $usuarios;


	public function insertarEntrada ($id , $titulo , $usuario, $cuerpo, $fecha){
		$this->entradas[] = new Entrada($id, $titulo , $usuario, $cuerpo, $fecha);

	}		
	

	public function insertarUsuario ( $user , $nombre , $pass , $rol) {
		
			$this->usuarios[] = new Usuario ( $user , $nombre , $pass , $rol );
		
	}

	 public function insertComment ($idComentario ,$idEnt, $autor ,$texto ){

			$date=date('d-m-Y');

			$this->comentario[] = new Comentario ( $idComentario , $idEnt , $date , $autor , $texto );

		}
}



$BD = new BD();
	$BD->insertarUsuario(1,"Admin","admin","Admin");
	$BD->insertarUsuario(2,"Usuario","usuario","User");
	
	$BD->insertarEntrada(1,"Primera Entrada","PEPE",
		"<p> Doña Uzeada de Ribera Maldonado de Bracamonte y Anaya era baja,rechoncha, abigotada. Ya no existia razon para llamar talle al suyo. Sus colores vivos, sanos, podian mas que el albayalde y el soliman del afeite, con que se blanqueaba por simular melancolias. Gastaba dos parches oscuros, adheridos a las sienes y que fingian medicamentos.</p>
		<p>Tenia los ojitos ratoniles, maliciosos. Sabia dilatarlos duramente o desmayarlos con recato o levantarlos con disimulo. Caminaba contoneando las imposibles caderas y era dificil, al verla, no asociar su estampa achaparrada con la de ciertos palmipedos domesticos. Sortijas celestes y azules le ahorcaban las falanges</p>","10-02-2017 15:23");	
	$BD->insertComment(1,1,"Sergio","Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur, nihil officia dolorum veritatis obcaecati incidunt accusantium repudiandae illum ipsam perspiciatis culpa dolor itaque, consectetur commodi amet voluptas nisi facilis, soluta.");
	$BD->insertarEntrada(2,"Segunda Entrada","Carlos",
		"<p> Doña Uzeada de Ribera Maldonado de Bracamonte y Anaya era baja,rechoncha, abigotada. Ya no existia razon para llamar talle al suyo. Sus colores vivos, sanos, podian mas que el albayalde y el soliman del afeite, con que se blanqueaba por simular melancolias. Gastaba dos parches oscuros, adheridos a las sienes y que fingian medicamentos.</p>
		<p>Tenia los ojitos ratoniles, maliciosos. Sabia dilatarlos duramente o desmayarlos con recato o levantarlos con disimulo. Caminaba contoneando las imposibles caderas y era dificil, al verla, no asociar su estampa achaparrada con la de ciertos palmipedos domesticos. Sortijas celestes y azules le ahorcaban las falanges</p>","22-03-2017 20:24");	
	$BD->insertarEntrada(3,"Tercera Entrada","Jose",
	"<p> Doña Uzeada de Ribera Maldonado de Bracamonte y Anaya era baja,rechoncha, abigotada. Ya no existia razon para llamar talle al suyo. Sus colores vivos, sanos, podian mas que el albayalde y el soliman del afeite, con que se blanqueaba por simular melancolias. Gastaba dos parches oscuros, adheridos a las sienes y que fingian medicamentos.</p>
	<p>Tenia los ojitos ratoniles, maliciosos. Sabia dilatarlos duramente o desmayarlos con recato o levantarlos con disimulo. Caminaba contoneando las imposibles caderas y era dificil, al verla, no asociar su estampa achaparrada con la de ciertos palmipedos domesticos. Sortijas celestes y azules le ahorcaban las falanges</p>","10-02-2016 22:15");



?>

