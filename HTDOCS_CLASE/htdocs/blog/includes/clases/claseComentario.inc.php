<?php
 
	class Comentario {
		private $idComentario;
		private $idEntrada;
		private $fechaHora;
		private $autor;
		private $texto;

		function __construct ( $id, $idEntrada, $fecha , $autor ,$texto ){

			$this->idComentario = $id;
			$this->idEntrada = $idEntrada;
			$this->fehcaHora = $fecha;
			$this->autor = $autor;
			$this->texto = $texto;
		}

		function __get( $valor ){
			return  $this->valor;
		}

		function __set( $var ,$valor ) {
			$this->$var = $valor;
		}	

	}


	


?>