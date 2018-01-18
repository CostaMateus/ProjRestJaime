<?php
	/***************************************/
	/** 								  **/
	/** Classe refatorada - FALTA REVISÃO **/
	/** 								  **/
	/***************************************/
	//Classe de usuário 
	class User {
		
		private $id; 
		private $name; 
		private $login; 
		private $pass; 
		private $dateCa; 
		private $dateUp; 
		private $active; 

		/** inicio funcoes novas - usando DAO **/
		// Construtor - vazio mesmo
		public function __construct() {}
		
		/** inicio Getters e Setters **/
		public function getId() {
			return $this->id;
		}
		
		public function setId($value) {
			$this->id = $value;
		}
		
		public function getName() {
			return $this->name;
		}
		
		public function setName($value) {
			$this->name = $value;
		}
		
		public function getLogin() {
			return $this->login;
		}
		
		public function setLogin($value) {
			$this->login = $value;
		}
		
		public function getPass() {
			return $this->pass;
		}
		
		public function setPass($value) {
			$this->pass = $value;
		}
		
		public function getDateCa() {
			return $this->dateCa;
		}
		
		public function setDateCa($value) {
			$this->dateCa = $value;
		}
		
		public function getDateUp() {
			return $this->dateUp;
		}
		
		public function setDateUp($value) {
			$this->dateUp = $value;
		}
		
		public function getActive() {
			return $this->active;
		}
		
		public function setActive($value) {
			$this->active = $value;
		}
		/** fim Getters e Setters **/
		
		// Procura um usuário por ID 
		// *substitui o IF da função qSelect()
		public function loadById($id) {
			$sql = new Sql(); 
			$r = $sql->select("SELECT * FROM user WHERE id = :id ", 
				array(":id"=>base64_decode($id))
			);
			
			if (count($r) > 0) {
				$this->setAttributes($r[0]);
			}
		}
		
		// Procura um usuário pelo Login 
		// *substitui o ELSEIF da função qSelect()
		public function loadByLogin($login) {
			$sql = new Sql(); 
			$r = $sql->select("SELECT * FROM user WHERE login = :login ", 
				array(":login"=>$login)
			);
			
			if (count($r) > 0) {
				$this->setAttributes($r[0]);
			}
		}
		
		// Busca todos os usuarios cadastrados 
		// *substitui o ELSE da função qSelect()
		public static function getList() {
			$sql = new Sql();
			return $sql->select("SELECT * FROM user ORDER BY name;");
		}
		
		// Busca todos usuários que contenham a string passada no nome
		public static function search($name) {
			$sql = new Sql();
			return $sql->select("SELECT * FROM user WHERE name LIKE :search ORDER BY name;",
				array(":search"=>"%" . $name . "%")
			);
		}
		
		// Verifica se o login passado já existe 
		// *substitui a função qSelectLogins()
		public static function login_exists($login) {
			$sql = new Sql();
			$r = $sql->select("SELECT * FROM user WHERE login = :login;",
				array(":login"=>$login)
			);
			// Maior que zero, login existe
			return ((count($r) > 0) ? true : false);
		}
		
		// Insere um novo usuário
		// *substitui a função qInsert()
		public function insert($name, $login, $pass, $active) {
			/*
				Tratar dados antes de invocar a função
				De preferência no formulário 
				atrtolower(login)
			*/
			$this->setDateCa(self::getCurrentDate());
			$this->setDateUp($this->getDateCa());
			$sql = new Sql();
			$sql->query("INSERT INTO user (name, login, pass, dateCa, dateUp, active) 
							VALUES (:name, :login, :pass, :dateCa, :dateUp, :active);", 
				array(
					":name"=>$name,
					":login"=>$login,
					":pass"=>$pass,
					":dateCa"=>$this->getDateCa(),
					":dateUp"=>$this->getDateUp(),
					":active"=>$active
				)
			);
			$r = $sql->select("SELECT * FROM user WHERE id = LAST_INSERT_ID();");
			if (count($r) > 0) {
				$this->setAttributes($r[0]);
			}
		}
		
		// Atualiza dados de um usuário 
		// *substitui a funções:
		//		qUpdateNameLogin()
		//		qUpdateStatus()
		//		qUpdatePass()
		public function update($name, $login, $pass, $active) {
			/*
				Tratar dados antes de invocar a função
				De preferência no formulário 
			*/
			if ($name != null || $name != "") 
				$this->setName($name);
			if ($login != null || $login != "") 
				$this->setLogin($login);
			if ($pass != null || $pass != "") 
				$this->setPass($pass);
			if ($active != null || $active != "") 
				$this->setActive($active);
			$sql = new Sql();
			$sql->query("UPDATE user SET name = :name, login = :login, pass = :pass, dateUp = :dateUp, active = :active 
							WHERE id = :id;", 
				array(
					":name"=>$this->getName(),
					":login"=>$this->getLogin(),
					":pass"=>$this->getPass(),
					":dateUp"=>self::getCurrentDate(),
					":active"=>$this->getActive(),
					":id"=>base64_decode($this->getId())
				)
			);
		}
		
		// Apaga um usuário 
		// *substitui a função qDelete()
		public function delete() {
			$sql = new Sql();
			$sql->query("DELETE FROM user WHERE id = :id", 
				array(":id"=>base64_decode($this->getId()))
			);
			$this->setId(null);
			$this->setName(null);
			$this->setLogin(null);
			$this->setPass(null);
			$this->setDateCa(null);
			$this->setDateUp(null);
			$this->setActive(null);
		}
		
		// Verifica validade a senha
		// *substitui a função validaPass()
		public function checkPassword($pass) {			
			return ((password_verify($pass, $this->pass)) ? true : false);
		}
		
		// Valida a entrada do usuário 
		// *substitui a função validaLogin()
		public function logIn($login, $pass) {
			/*
				Tratar login antes de invocar a função
				De preferência no formulário 
				atrtolower(login)
			*/
			$sql = new Sql();
			$r = $sql->select("SELECT * FROM user WHERE login = :login ", 
				array(":login"=>$login)
			);
			if ((count($r) > 0) && (password_verify($pass, $r['pass']))) {
				if($r['active'] == 1) {
					session_start();
					$_SESSION['logado'] = true;
					$_SESSION['id'] = base64_encode($r['id']);
					$_SESSION['name'] = $r['name'];
					$_SESSION['login'] = $r['login'];
					header('location: ' . BASEURL . 'admin/view/');
				} else {
					header('location: ' . BASEURL . 'admin/?a=active');
					exit();
				}
			} else {
				header('location: ' . BASEURL . 'admin/?e=error');
				exit();
			}
		}
		
		// Valida a saída do usuário
		// *substitui a função userDisconnect()
		public static function getOut() {
			$_SESSION['logado'] = false;
			unset($_SESSION['id']);
			unset($_SESSION['nameUser']);
			unset($_SESSION['loginUser']);
			session_destroy();
			header('location: ' . BASEURL . 'admin/');
			exit(); // repetir essa função após todas as ocorrências da função header('location')
		}
		
		// Setando o atributos do usuário
		private function setAttributes($data) {
			$this->setId(base64_encode($data['id']));
			$this->setName($data['name']);
			$this->setLogin($data['login']);
			$this->setPass($data['pass']);
			$this->setDateCa($data['dateCa']);
			$this->setDateUp($data['dateUp']);
			$this->setActive($data['active']);
		}
		
		// Cria um timestamp com fuso de Brasília/SãoPaulo
		public static function getCurrentDate() {
			// $dt = new DateTime(); // Cria dataHora
			// $dtz = new DateTimeZone("America/Sao_Paulo"); // Cria zona horaria 
			// $dt->setTimeZone($dtz); // Seta zona horaria na dataHora
			// $dt = $dt->format("Y-m-d H:i:s"); // Seta formato da dataHora
			return ((new DateTime())->setTimeZone(new DateTimeZone("America/Sao_Paulo")))->format("Y-m-d H:i:s");
		}
		
		// Definindo o metodo toString
		public function __toString() {
			return json_encode(
				array(
					"IdUser"=>$this->getId(),
					"Name"=>$this->getName(),
					"Login"=>$this->getLogin(),
					"Pass"=>$this->getPass(),
					"DateCa"=>$this->getDateCa(),
					"DateUp"=>$this->getDateUp(),
					"Active"=>$this->getActive()
				)
			);
		}
		/** fim funcoes novas - usando DAO **/

		// Retorna usuário se receber id ou login, senão, retorna todos
		/*
		public function qSelect($id = NULL, $login = NULL) { 
			try{ 
				if ($id) {
					$this->id = $this->objFunc->base64($id, 2);
					$stmt = $this->conn->open_db()->prepare("SELECT * FROM `user` WHERE `id` = :idU;");
					$stmt->bindParam(":idU", $this->id, PDO::PARAM_INT);
					return (($stmt->execute()) ? $stmt->fetch(PDO::FETCH_ASSOC) : false);
				} elseif ($login) {
					$this->login = $login;
					$stmt = $this->conn->open_db()->prepare("SELECT * FROM `user` WHERE `login` = :login;");
					$stmt->bindParam(":login", $this->login, PDO::PARAM_STR);
					return ((($stmt->execute()) && ($stmt->rowCount() != 0)) ? $stmt->fetch(PDO::FETCH_ASSOC) : false);
				} else {
					$stmt = $this->conn->open_db()->prepare("SELECT * FROM `user`;");
					return (($stmt->execute()) ? $stmt->fetchAll(PDO::FETCH_ASSOC) : false);
				}
			} catch (PDOException $e) {
				return "Erro: " . $e->getMessage(); 
			}
		}
		*/
		// Verifica se um login ja existe no banco
		/*
		public function qSelectLogins($login, $type) { 
			switch($type) {
				case 1: 
					try{
						$this->login = $login;
						$stmt = $this->conn->open_db()->prepare("SELECT * FROM `user` WHERE `login` = :login;");
						$stmt->bindParam(":login", $this->login, PDO::PARAM_STR);
						return (($stmt->execute() && $stmt->rowCount() > 0) ? true : false);
					} catch (PDOException $e) {
						return "Erro: " . $e->getMessage(); 
					}
					break;
				case 2:
					try{
						$this->login = $login;
						$stmt = $this->conn->open_db()->prepare("SELECT * FROM `user` WHERE `login` = :login;");
						$stmt->bindParam(":login", $this->login, PDO::PARAM_STR);
						if ($stmt->execute() && $stmt->rowCount() > 0) {
							$r = $stmt->fetch(PDO::FETCH_ASSOC);
							return ($r['id'] == $_SESSION['id'] ? true : false);
						}
					} catch (PDOException $e) {
						return "Erro: " . $e->getMessage(); 
					}
					break;
			}
		}
		*/
		// Insere um usuário novo no banco
		/*
		public function qInsert($data) {
			try {
				$this->name = $this->objFunc->treatCharacter($data['name'],1);
				$this->login = $this->objFunc->treatCharacter(strtolower($data['login']),1);
				$this->pass = password_hash($data['pass2'], PASSWORD_BCRYPT);
				$this->dateCa = $this->objFunc->currentDate(2);
				$this->dateUp = $this->dateCa;
				$this->active = 1;
				$stmt = $this->conn->open_db()->prepare("INSERT INTO `user` (`name`, `login`, `pass`, `dateCa`, `dateUp`, `active`) VALUES (:name, :login, :pass, :dateCa, :dateUp, :active);");
				$stmt->bindParam(":name", $this->name, PDO::PARAM_STR);
				$stmt->bindParam(":login", $this->login, PDO::PARAM_STR);
				$stmt->bindParam(":pass", $this->pass, PDO::PARAM_STR);
				$stmt->bindParam(":dateCa", $this->dateCa, PDO::PARAM_STR);
				$stmt->bindParam(":dateUp", $this->dateUp, PDO::PARAM_STR);
				$stmt->bindParam(":active", $this->active, PDO::PARAM_INT);
				
				return (($stmt->execute()) ? true : false);
			} catch (PDOException $e) {
				return "Erro: " . $e->getMessage();
			}
		}
		*/
		// Atualiza nome e login de um usuário
		/*
		public function qUpdateNameLogin($data, $type) {
			switch($type) {
				case 1: 
					try {
						$this->id = $this->objFunc->base64($data['idU'], 2);
						$this->name = $data['name'];
						$this->dateUp = $this->objFunc->currentDate(2);
						$stmt = $this->conn->open_db()->prepare("UPDATE `user` SET `name` = :name, `dateUp` = :dateUp WHERE `id` = :id;");
						$stmt->bindParam(":name", $this->name, PDO::PARAM_STR);
						$stmt->bindParam(":dateUp", $this->dateUp, PDO::PARAM_STR);
						$stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
						return (($stmt->execute()) ? true : false);
					} catch (PDOException $e) {
						return "Erro: " . $e->getMessage();
					}
					break;
				case 2:
					try {
						$this->id = $this->objFunc->base64($data['idU'], 2);
						$this->name = $data['name'];
						$this->login = $data['login'];
						$this->dateUp = $this->objFunc->currentDate(2);
						$stmt = $this->conn->open_db()->prepare("UPDATE `user` SET `name` = :name, `login` = :login, `dateUp` = :dateUp WHERE `id` = :id;");
						$stmt->bindParam(":name", $this->name, PDO::PARAM_STR);
						$stmt->bindParam(":login", $this->login, PDO::PARAM_STR);
						$stmt->bindParam(":dateUp", $this->dateUp, PDO::PARAM_STR);
						$stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
						return (($stmt->execute()) ? true : false);
					} catch (PDOException $e) {
						return "Erro: " . $e->getMessage();
					}
					break;
			}
		}
		// Atualiza status de um usuário
		public function qUpdateStatus($data) {
			try {
				$this->id = $this->objFunc->base64($data['idU'], 2);
				$this->active = $data['status'];
				$this->dateUp = $this->objFunc->currentDate(2);
				$stmt = $this->conn->open_db()->prepare("UPDATE `user` SET `dateUp` = :dateUp, `active` = :active WHERE `id` = :id;");
				$stmt->bindParam(":dateUp", $this->dateUp, PDO::PARAM_STR);
				$stmt->bindParam(":active", $this->active, PDO::PARAM_INT);
				$stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
				return (($stmt->execute()) ? true : false);
			} catch (PDOException $e) {
				return "Erro: " . $e->getMessage();
			}
		}
		// Atualiza senha de um usuário
		public function qUpdatePass($data) {
			try {
				$this->id = $this->objFunc->base64($data['idU'], 2);
				$this->pass = password_hash($data['pass2'], PASSWORD_BCRYPT);
				$this->dateUp = $this->objFunc->currentDate(2);
				$stmt = $this->conn->open_db()->prepare("UPDATE `user` SET `pass` = :pass, `dateUp` = :dateUp WHERE `id` = :id;");
				$stmt->bindParam(":pass", $this->pass, PDO::PARAM_STR);
				$stmt->bindParam(":dateUp", $this->dateUp, PDO::PARAM_STR);
				$stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
				return (($stmt->execute()) ? true : false);
			} catch (PDOException $e) {
				return "Erro: " . $e->getMessage();
			}
		}
		*/
		// Exclui dados de um usuário do banco 
		/*
		public function qDelete($data) {
			try {
				$this->id = $this->objFunc->base64($data['idU'], 2);
				$stmt = $this->conn->open_db()->prepare("DELETE FROM `user` WHERE `id` = :id;");
				$stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
				return (($stmt->execute()) ? true : false);
			} catch (PDOException $e) {
				return "Erro: " . $e->getMessage();
			}
		}
		*/
		// Valida a entrada do usuário
		/*
		public function validaLogin($data) {
			$this->login = strtolower($data['login']);
			$this->pass = $data['pass'];
			try {
				$result = $this->qSelect(null, $this->login);
				if (($result != null) && (password_verify($this->pass, $result['pass']))) {
					if($result['active'] == 1) {
						session_start();
						$_SESSION['logado'] = true;
						$_SESSION['id'] = $result['id'];
						$_SESSION['name'] = $result['name'];
						$_SESSION['login'] = $result['login'];
						
						header('location: ' . BASEURL . 'admin/view/');
					} else {
						header('location: ' . BASEURL . 'admin/?a=active');
					}
				} else {
					header('location: ' . BASEURL . 'admin/?e=error');
				}
			} catch (PDOException $e) {
				return "Erro: " . $e->getMessage();
			}
		}
		*/
		// Valida senha antes de alteração
		/*
		public function validaPass($pass, $id) {
			$this->id = $id;
			$this->pass = $pass;
			$result = $this->qSelect($this->id, null);
			return ((($result != null) && (password_verify($this->pass, $result['pass']))) ? true : false);
		}
		*/
		// Desconecta usuário
		/*
		public function userDisconnect($data) {
			try {
				$this->id = $data;
				$online = 0;
				$stmt = $this->conn->open_db()->prepare("UPDATE `user` SET `online` = :online WHERE `id` = :id;");
				$stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
				$stmt->bindParam(":online", $online, PDO::PARAM_INT);
				$stmt->execute();
				$_SESSION['logado'] = false;
				unset($_SESSION['id']);
				unset($_SESSION['nameUser']);
				unset($_SESSION['loginUser']);
				session_destroy();
				header('location: ' . BASEURL . 'admin/');
				
			} catch (PDOException $e) {
				return "Erro: " . $e->getMessage();
			}
		}
		*/
	}
?> 

