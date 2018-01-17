<?php 
	//Classe de conexao
	class Connection {
		
		//Atributos privados da conexao
		private static $DB_HOST = "127.0.0.1:3306";
		private static $DB_USER = "root";
		private static $DB_PASS = "";
		private static $DB_NAME = "rlanches";
		private static $pdo;
		
		//Construtor 
		public function __construct() {}
		
		//Metodo para conectar
		public function open_db(){
			try {
				if (is_null(self::$pdo)) {
					self::$pdo = new PDO("mysql:host=" . self::$DB_HOST . ";dbname=" . self::$DB_NAME, self::$DB_USER, self::$DB_PASS);
				}
				return self::$pdo;
			} catch(PDOException $e) {
				echo "Falha na conexão com o banco: " . $e->getMessage();
				return null;
			}
		}
	}
?>