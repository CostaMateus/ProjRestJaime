<?php
	require_once("Connection.class.php");

	class Sql extends PDO {

		private static $conn;

		public function __construct() {
			self::$conn = new Connection();
		}

		private function setParam($stmt, $key, $value) {
			$stmt->bindParam($key, $value);
		}

		private function setParams($stmt, $parameters = array()) {
			foreach ($parameters as $key => $value) {
				$this->setParam($stmt, $key, $value);
			}
		}

		// efetua INSERT / UPDATE / DELETE 
		public function query($rawQuery, $params = array()) {
			$stmt = self::$conn->open_db()->prepare($rawQuery);
			$this->setParams($stmt, $params);
			$stmt->execute();
			return $stmt;
		}

		// efetua SELECT, chamando o QUERY internamente  
		public function select($rawQuery, $params = array()):array {
			$stmt = $this->query($rawQuery, $params);
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	}
?>



















