<?php
 require_once ("claseComentario.inc.php");

	class Entrada {
		private $idEntrada;
		private $fechaHora;
		private $titulo;
		private $cuerpo;
		private $usuario;
		private $comentarios;


		function __construct($id ,  $titulo , $usuario, $cuerpo,$fecha){
	
			$this->idEntrada=$id;
			$this->titulo=$titulo;
			$this->usuario=$usuario;
			$this->cuerpo=$cuerpo;
			$this->fechaHora=$fecha;
		}


		function __get( $valor ){
			return  $this->$valor;
		}

		function __set( $var ,$valor ) {
			$this->$var = $valor;
		}	
			
		public function insertComment ($idComentario ,$idEnt, $autor ,$texto ){
		
			$date=date('d-m-Y G:i:s');

			$this->comentarios[] = new Comentario ( $idComentario , $idEnt , $date , $autor , $texto );
	
		}

		
		

	}

	






?>