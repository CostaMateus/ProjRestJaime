<?php

	require_once ("config.php");
	
	$sql = new Sql();
	$usuarios = $sql->select("SELECT * FROM featured;");
	
	
	foreach ($usuarios as $row) {
		foreach ($row as $key => $value) {
			echo "<b>" . $key . ":</b> " . $value . "<br>";
		}
		echo "================================================<br>";
	}
	// echo json_encode($usuarios);
	
	/* um usuario procurado por id*/
	// $u = new Usuario();
	// $u->loadById(1);
	// echo $u;
	
	/* todos usuarios */
	// $list = Usuario::getList();
	// echo json_encode($list);
	
	/* usuarios q contenham determinada string*/
	// $search = Usuario::search("a");
	// echo json_encode($search);
	
	/* carrega usuario com login e senha */
	// $user = new Usuario(); 
	// $user->login("mateus", "123");
	// echo $user;
	
	/* insere um usuario novo */
	// $new = new Usuario("testLogin", "testPass");
	// $new->insert();
	// echo $new;
	
	/* atualiza os dados do usuario */
	// $up = new Usuario();
	// $up->loadById(1);
	// $up->update("mateus", "123321");
	// echo $up;
	
	/* apaga um usuario */
	// $de = new Usuario();
	// $de->loadById(3);
	// $de->delete();
	// echo $de;
	
	
?>