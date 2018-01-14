<?php
	require_once 'Connection.class.php';
	require_once 'Functions.class.php';
	
	//Classe de usuário 
	class User {
		
		private $conn; 
		private $objFunc; 
		
		private $id; 
		private $name; 
		private $login; 
		private $pass; 
		private $dateCa; 
		private $dateUp; 
		private $active; 
		
		//Construtor
		public function __construct () {
			$this->conn = new Connection();
			$this->objFunc = new Functions();
		}
		
		public function __set($attribute, $value) {
			$this->attribute = $value;
		}
		
		public function __get($attribute) {
			return $this->attribute;
		}
		
		// Retorna usuário se receber id ou login, senão, retorna todos
		public function qSelect($id = NULL, $login = NULL) { 
			try{ 
				if ($id) {
					$this->id = $this->objFunc->base64($id, 2);
					$stmt = $this->conn->open_db()->prepare("SELECT * FROM `user` WHERE `id` = :idU;");
					$stmt->bindParam(":idU", $this->id, PDO::PARAM_INT);
					return (($stmt->execute()) ? $stmt->fetch() : false);
					
				} elseif ($login) {
					$this->login = $login;
					$stmt = $this->conn->open_db()->prepare("SELECT * FROM `user` WHERE `login` = :login;");
					$stmt->bindParam(":login", $this->login, PDO::PARAM_STR);
					return ((($stmt->execute()) && ($stmt->rowCount() != 0)) ? $stmt->fetch() : false);

				} else {
					$stmt = $this->conn->open_db()->prepare("SELECT * FROM `user`;");
					return (($stmt->execute()) ? $stmt->fetchAll() : false);
				}
			} catch (PDOException $e) {
				return "Erro: " . $e->getMessage(); 
			}
		}
		
		// Verifica se um login ja existe no banco
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
							$r = $stmt->fetch();
							return ($r['id'] == $_SESSION['id'] ? false : true);
						}
					} catch (PDOException $e) {
						return "Erro: " . $e->getMessage(); 
					}
					break;
			}
		}
		
		// Insere um usuário novo no banco
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
		
		// Atualiza nome e login de um usuário
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
		
		// Exclui dados de um usuário do banco 
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
		
		// Valida senha antes de alteração
		public function validaPass($pass, $id) {
			$this->id = $id;
			$this->pass = $pass;
			$result = $this->qSelect($this->id, null);
			return ((($result != null) && (password_verify($this->pass, $result['pass']))) ? true : false);
		}
		
		// Valida a entrada do usuário
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
		
		// Desconecta usuário
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
	}
?> 

