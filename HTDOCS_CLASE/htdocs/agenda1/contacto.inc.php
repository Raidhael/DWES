 <?php
	class Contacto {
		private $idContacto;
		private $nombre;
		private $apellido1;
		private $apellido2;
		private $telefono;
		
		public function __construct($id,$nom,$ape1,$ape2,$tlf){
			$this->idContacto=$id;
			$this->nombre=$nom;
			$this->apellido1=$ape1;
			$this->apellido2=$ape2;
			$this->telefono=$tlf;

		}

		public function __set($var, $valor){

				$this->$var = $valor;
				
			}
		public function __get ($var){

			return $this->var;
		}


		public function __toString(){

			return  'ID = ' . $this->idContacto . '<br>' . 'Nombre = ' . $this->nombre . '<br>' . '1er Apellido = ' . $this->apellido1 . '<br>' . '2o Apellido = ' . $this->apellido2 . '<br>' . 'Telefono = ' . $this->telefono;
		}
	
	}

?>




