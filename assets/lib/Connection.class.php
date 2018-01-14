<?php 
	//Classe de conexao
	class Connection {
		
		//Atributos privados da conexao
		private $DB_HOST;
		private $DB_USER;
		private $DB_PASS;
		private $DB_NAME;
		private static $pdo;
		
		//Construtor 
		public function __construct() {
			$this->DB_HOST = "127.0.0.1:3306";
			$this->DB_USER = "root";
			$this->DB_PASS = "";
			$this->DB_NAME = "rlanches";
			
			// $this->DB_HOST = "mysql.hostinger.com.br";
			// $this->DB_USER = "u518220322_jaime";
			// $this->DB_PASS = "cPA32nHebJ9S";
			// $this->DB_NAME = "u518220322_site";
		}
		
		//Metodo para conectar
		public function open_db(){
			try {
				if (is_null(self::$pdo)) {
					self::$pdo = new PDO("mysql:host=".$this->DB_HOST.";dbname=".$this->DB_NAME, $this->DB_USER, $this->DB_PASS);
				}
				return self::$pdo;
			} catch(PDOException $e) {
				echo "Falha na conexão com o banco: " . $e->getMessage();
				return null;
			}
		}
	}
	
?>