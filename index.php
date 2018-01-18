<?php

	require_once ("config.php");

	// $sql = new Sql();
	// $usuarios = $sql->select("SELECT * FROM featured;");
	// foreach ($usuarios as $row) {
		// foreach ($row as $key => $value) {
			// echo "<b>" . $key . ":</b> " . $value . "<br>";
		// }
		// echo "================================================<br>";
	// }
	// echo json_encode($usuarios);

	/* um usuario procurado por id*/
	// $u = new User();
	// $u->loadById(4);
	// echo $u;

	/* um usuario procurado pelo login*/
	// $u = new User();
	// $u->loadByLogin("filipe");
	// echo $u;

	/* todos usuarios */
	// $list = User::getList();
	// echo json_encode($list);

	/* usuarios q contenham determinada string no nome*/
	// $search = User::search("s");
	// echo json_encode($search);

	/* carrega usuario com login e senha */
	// $user = new User(); 
	// $user->login("mateus", "123");
	// echo $user;

	// echo User::getCurrentDate();

	/* insere um usuario novo */
	// $new = new User();
	// $new->insert("MM", "mm", "pass", 1);
	// echo $new;
	// /* inser com validação */
	// $new = new User();
	// $login = "MM";
	// if ($new->login_exists($login)) 
		// echo "Login jah em uso <br>";
	// else 
		// $new->insert("MM Name", $login, "MM Pass", 1);
	// echo $new;

	/* atualiza os dados do usuario */
	// $up = new User();
	// $up->loadById(1);
	// $up->update("Mateus Costa", null, null, null); // (Name, Login, Pass, Active)
	// echo $up;

	/* apaga um usuario */
	// $de = new User();
	// $de->loadById(11);
	// $de->delete();
	// echo $de;
?>
















