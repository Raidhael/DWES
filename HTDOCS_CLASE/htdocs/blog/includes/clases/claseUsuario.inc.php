<?php

	class Usuario {
		private $user;
		private $nombre;
		private $pass;
		private $rol;


		function __construct( $user , $nombre , $pass , $rol ) {

			$this->user = $user;
			$this->nombre = $nombre;
			$this->pass = $pass;
			$this->rol = $rol;//Solo Admin o Blogger
		}


		function __get( $valor ){

			return  $this->$valor;

		}

		function __set( $var ,$valor ){

			$this->$var = $valor;

		}	


	}
	

?>