<?php 

	require ('contacto.inc.php');
class Agenda {

	private $agenda;
	
	public function aniadir( $id , $nombre , $ape1 , $ape2 , $telefono){
		//Añadir nuevo objeto a la agenda 1 linea
		$this->agenda[] = new  Contacto($id, $nombre,$ape1,$ape2, $telefono);

		//$this->agenda[] = $newContacto;

	}

	public function eliminar ($id){



		foreach ($this->agenda as $indice => $contacto) {
			 
			 if ( $id == $contacto->idContacto ) {

			 	unset($this->agenda[$indice]);

			 }

			$this->agenda = array_values($this->agenda);
		}				
	}
	public function __toString(){
		$datos = '';
		foreach ($this->agenda as $contacto) {
			$datos .= $contacto->__toString().'<br>';
		}

		return $datos;
	}
}

?>