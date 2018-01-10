<?php
 
require_once("claseEntrada.inc.php");
require_once("claseUsuario.inc.php");
class BD {

	public $entradas;
	public $usuarios;
	public $comentarios;


	public function insertarEntrada ($id , $titulo , $usuario, $cuerpo, $fecha){
		$this->entradas[] = new Entrada($id, $titulo , $usuario, $cuerpo, $fecha);

	}		
	

	public function insertarUsuario ( $user , $nombre , $pass , $rol) {
		
			$this->usuarios[] = new Usuario ( $user , $nombre , $pass , $rol );
		
	}

	public function insertCommentBD ($idComentario ,$idEnt, $autor ,$texto ){
		
			$date=date('d-m-Y G:i:s');

		foreach($this->entradas as $entrada){

			if ($entrada->idEntrada == $idEnt){
				$entrada->insertComment($idComentario,$idEnt,$autor,$texto);
			}

		}
	}


}



$BD = new BD();
	$BD->insertarUsuario(1,"Admin","admin","Admin");
	$BD->insertarUsuario(2,"Usuario","usuario","User");
	
	$BD->insertarEntrada(1,"Primera Entrada","PEPE",
		"<p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam vitae ad impedit voluptates. Repudiandae pariatur impedit labore. Fugit vero quo quasi at error fuga vel voluptas praesentium doloribus blanditiis! Dolorem.
		Esse officiis eaque molestias dolor assumenda sint eum, voluptate hic nostrum error ipsa, tempore pariatur aliquid eius ipsam, illo est velit laboriosam vitae! Laudantium a quod, commodi perferendis quas voluptatibus?
		Rem tenetur deleniti rerum ad. Reiciendis, rem! Odit quidem beatae perspiciatis facere hic eligendi ab non totam eos quis consequuntur, iusto vel modi unde provident harum placeat nam perferendis dolor!
		Fugiat quia tempora, vitae praesentium accusantium quasi distinctio dolorum, dolore et dolorem libero veritatis sed quidem velit beatae asperiores consectetur optio nulla consequuntur? Eveniet, explicabo quis ut nihil quam molestiae.
		Iusto provident consequuntur aliquam, quas deserunt quod reiciendis vel exercitationem cumque sit adipisci? A blanditiis perspiciatis accusantium suscipit quam in nulla aliquid sequi eligendi maiores. Ad culpa perferendis distinctio vel.
		Eaque quisquam iure, quod, similique laborum voluptas eos aspernatur animi explicabo assumenda saepe odit cum aperiam molestiae magni doloremque id at quis dolorum et ipsa dicta. Magnam sunt consectetur perferendis.
		Accusantium, placeat, beatae, adipisci corporis quaerat dolorum cupiditate id non repudiandae soluta totam velit sed. Eos rerum facere illum iste, soluta necessitatibus accusantium odio, voluptatem deleniti autem, facilis magni enim.
		Ducimus doloremque cupiditate excepturi laboriosam impedit, repudiandae similique tempore, fugiat blanditiis accusamus reprehenderit suscipit nobis! Veniam aut explicabo sed non perspiciatis pariatur fugiat recusandae, tempore facilis, adipisci quia corrupti consectetur?
		Rem unde optio atque eos mollitia expedita ratione repellat exercitationem possimus! Minus facilis excepturi, in voluptatibus nobis molestias debitis distinctio molestiae cupiditate at voluptate, culpa rem atque laboriosam ab sequi.
		Quia voluptatibus tempore provident nobis, reiciendis dolorum. Tenetur culpa aliquam perspiciatis, ea odit quae minima reiciendis, quia ipsum, consequatur iste! Consectetur vero a ullam tempore eveniet earum sunt temporibus obcaecati. </p>","10-02-2017 15:23");	
	
		$BD->insertCommentBD(1,1,"Sergio","Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequunt ");
		$BD->insertCommentBD(2,1,"Pepe","Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequunt ");
		$BD->insertCommentBD(3,1,"Pepa","Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequunt ");
	
	$BD->insertarEntrada(2,"Segunda Entrada","Carlos",
	"<p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam vitae ad impedit voluptates. Repudiandae pariatur impedit labore. Fugit vero quo quasi at error fuga vel voluptas praesentium doloribus blanditiis! Dolorem.
	Esse officiis eaque molestias dolor assumenda sint eum, voluptate hic nostrum error ipsa, tempore pariatur aliquid eius ipsam, illo est velit laboriosam vitae! Laudantium a quod, commodi perferendis quas voluptatibus?
	Rem tenetur deleniti rerum ad. Reiciendis, rem! Odit quidem beatae perspiciatis facere hic eligendi ab non totam eos quis consequuntur, iusto vel modi unde provident harum placeat nam perferendis dolor!
	Fugiat quia tempora, vitae praesentium accusantium quasi distinctio dolorum, dolore et dolorem libero veritatis sed quidem velit beatae asperiores consectetur optio nulla consequuntur? Eveniet, explicabo quis ut nihil quam molestiae.
	Iusto provident consequuntur aliquam, quas deserunt quod reiciendis vel exercitationem cumque sit adipisci? A blanditiis perspiciatis accusantium suscipit quam in nulla aliquid sequi eligendi maiores. Ad culpa perferendis distinctio vel.
	Eaque quisquam iure, quod, similique laborum voluptas eos aspernatur animi explicabo assumenda saepe odit cum aperiam molestiae magni doloremque id at quis dolorum et ipsa dicta. Magnam sunt consectetur perferendis.
	Accusantium, placeat, beatae, adipisci corporis quaerat dolorum cupiditate id non repudiandae soluta totam velit sed. Eos rerum facere illum iste, soluta necessitatibus accusantium odio, voluptatem deleniti autem, facilis magni enim.
	Ducimus doloremque cupiditate excepturi laboriosam impedit, repudiandae similique tempore, fugiat blanditiis accusamus reprehenderit suscipit nobis! Veniam aut explicabo sed non perspiciatis pariatur fugiat recusandae, tempore facilis, adipisci quia corrupti consectetur?
	Rem unde optio atque eos mollitia expedita ratione repellat exercitationem possimus! Minus facilis excepturi, in voluptatibus nobis molestias debitis distinctio molestiae cupiditate at voluptate, culpa rem atque laboriosam ab sequi.
	Quia voluptatibus tempore provident nobis, reiciendis dolorum. Tenetur culpa aliquam perspiciatis, ea odit quae minima reiciendis, quia ipsum, consequatur iste! Consectetur vero a ullam tempore eveniet earum sunt temporibus obcaecati. </p>","22-03-2017 20:24");	
	
	
	
	$BD->insertarEntrada(3,"Tercera Entrada","Jose",
	"<p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam vitae ad impedit voluptates. Repudiandae pariatur impedit labore. Fugit vero quo quasi at error fuga vel voluptas praesentium doloribus blanditiis! Dolorem.
	Esse officiis eaque molestias dolor assumenda sint eum, voluptate hic nostrum error ipsa, tempore pariatur aliquid eius ipsam, illo est velit laboriosam vitae! Laudantium a quod, commodi perferendis quas voluptatibus?
	Rem tenetur deleniti rerum ad. Reiciendis, rem! Odit quidem beatae perspiciatis facere hic eligendi ab non totam eos quis consequuntur, iusto vel modi unde provident harum placeat nam perferendis dolor!
	Fugiat quia tempora, vitae praesentium accusantium quasi distinctio dolorum, dolore et dolorem libero veritatis sed quidem velit beatae asperiores consectetur optio nulla consequuntur? Eveniet, explicabo quis ut nihil quam molestiae.
	Iusto provident consequuntur aliquam, quas deserunt quod reiciendis vel exercitationem cumque sit adipisci? A blanditiis perspiciatis accusantium suscipit quam in nulla aliquid sequi eligendi maiores. Ad culpa perferendis distinctio vel.
	Eaque quisquam iure, quod, similique laborum voluptas eos aspernatur animi explicabo assumenda saepe odit cum aperiam molestiae magni doloremque id at quis dolorum et ipsa dicta. Magnam sunt consectetur perferendis.
	Accusantium, placeat, beatae, adipisci corporis quaerat dolorum cupiditate id non repudiandae soluta totam velit sed. Eos rerum facere illum iste, soluta necessitatibus accusantium odio, voluptatem deleniti autem, facilis magni enim.
	Ducimus doloremque cupiditate excepturi laboriosam impedit, repudiandae similique tempore, fugiat blanditiis accusamus reprehenderit suscipit nobis! Veniam aut explicabo sed non perspiciatis pariatur fugiat recusandae, tempore facilis, adipisci quia corrupti consectetur?
	Rem unde optio atque eos mollitia expedita ratione repellat exercitationem possimus! Minus facilis excepturi, in voluptatibus nobis molestias debitis distinctio molestiae cupiditate at voluptate, culpa rem atque laboriosam ab sequi.
	Quia voluptatibus tempore provident nobis, reiciendis dolorum. Tenetur culpa aliquam perspiciatis, ea odit quae minima reiciendis, quia ipsum, consequatur iste! Consectetur vero a ullam tempore eveniet earum sunt temporibus obcaecati. </p>","10-02-2016 22:15");

	



?>

