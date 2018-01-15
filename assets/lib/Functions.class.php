<?php
	require_once 'Connection.class.php';
	require_once 'Upload.class.php';
	
	//Classe de funções 
	class Functions {
		
		private $conn; 
		
		//Construtor
		public function __construct () {
			$this->conn = new Connection();
		}
		
/****** Funções especiais ************************************************************************************************************/
		// Converte string ut8 <---> html 
		public function treatCharacter($value, $type) {
			switch($type) {
				case 1: 
					$result = utf8_decode($value); 
					break;
				case 2: 
					$result = htmlentities($value, ENT_QUOTES, "ISO-8859-1");
					break;
			}
			return $result;
		}
		
		// Retorna data atual formatada de acordo com a opc escolhida 
		public function currentDate($type) {
			switch($type) {
				case 1: 
					$result = ((new DateTime())->setTimeZone(new DateTimeZone("America/Sao_Paulo")))->format("Y-m-d");; 
					break;
				case 2: 
					$result = ((new DateTime())->setTimeZone(new DateTimeZone("America/Sao_Paulo")))->format("Y-m-d H:i:s");;
					break;
				case 3: 
					$result = ((new DateTime())->setTimeZone(new DateTimeZone("America/Sao_Paulo")))->format("d/m/Y");;
					break;
			}
			return $result;
		}
		
		// Retorna data formatada, recebida por parâmetro
		public function fDate($date) {
			return (new DateTime($date))->format("H:m d/m/y");
		}
		
		// (De)Codificação de id para manipulação no navegador
		public function base64($value, $type) {
			switch($type) {
				case 1: 
					$result = base64_encode($value); 
					break;
				case 2: 
					$result = base64_decode($value);
					break;
			}
			return $result;
		}
		
		// Nome autoexplicativo
		function echoActiveClassIfRequestMatches($value) {
			$current_file_name = basename($_SERVER['REQUEST_URI'], ".php");
			if (strpos($current_file_name, $value) !== false) {
				echo 'active';
			}
		}
		
		// Processa imagem da featured ou promotion
		function processImage($image, $category, $urlLocal) {
			$handle = new upload($image);			
			if ($handle->uploaded) {
				// $handle->image_resize       = true;
				// $handle->image_x            = 400;
				// $handle->image_y        	= 200;
				$handle->process($urlLocal);
				if ($handle->processed) {
					$tmp = $handle->file_dst_name;
					$handle->clean();
					return $tmp;
				} else {
					echo "Erro: " . $handle->error;
				}
			}
		}
		
/****** Funções compartilhadas *******************************************************************************************************/
		
		// Funções descontinuadas: 
		// 		function qDeleteDestaque($data) {}
		
		// Retorna todo a tabela featured (destaque) ou toda a tabela promotion (promoção) 
		// Substitui: function qSelectAllPromos() {} 
		// 			  function qSelectAllDestaques() {}
		function getAll($table) {
			try {
				$stmt = $this->conn->open_db()->prepare("SELECT * FROM :table;");
				$stmt->bindParam(":table", $table, PDO::PARAM_STR);
				return (($stmt->execute()) ? $stmt->fetchAll(PDO::FETCH_ASSOC) : false);
			} catch (PDOException $e) {
				return "Erro: " . $e->getMessage();
			}
		}
		
		// Retorna um featured ou promotion 
		// Busca por id
		// Substitui: function qSelectPromo($data) {} 
		// 			  function qSelectDestaque($data) {}
		function getById($id, $table) {
			$id = $this->base64($id, 2);
			try {
				$stmt = $this->conn->open_db()->prepare("SELECT * FROM :table WHERE `id` = :id;");
				$stmt->bindParam(":table", $table, PDO::PARAM_STR);
				$stmt->bindParam(":id", $id, PDO::PARAM_INT);
				return (($stmt->execute()) ? $stmt->fetch(PDO::FETCH_ASSOC) : false);
			} catch (Exception $e) {
				return "Erro: " . $e->getMessage();
			}
		}
		
		// Altera o valor do status de um featured ou promotion
		// Atualização por id
		// Substitui: function qUpdatePromoStatus($data) {}
		// 			  function qUpdateDestaqueStatus($data) {}
		function setStatus ($data) {
			$id =     $this->base64($data['id'], 2);
			$active = $data['status'];
			$table =  $data['table'];
			try {
				$stmt = $this->conn-open_db()->prepare("UPDATE :table SET `active` = :active WHERE `id` = :id;");
				$stmt->bindParam(":active", $active, PDO::PARAM_INT);
				$stmt->bindParam(":id", $id, PDO::PARAM_INT);
				return (($stmt->execute()) ? true : false);
			} catch (PDOException $e) {
				return "Erro: " . $e->getMessage();
			}
		}
		
		// Adiciona novo registro em featured ou promotion
		// Substitui: public function qInsertPromo($data) {}
		// 			  public function qInsertDestaque($data) {}
		function addToTable ($data) {
			$name =        $data['name'];
			$description = $data['description'];
			$image =       $data['image'];
			$active =      $data['status'];
			$table =       $data['table'];
			
			try {
				if (isset($data['price'])) {
					$price = $data['price'];
					$stmt = $this->conn->open_db()->prepare("INSERT INTO :table (`name`, `description`, `price`, `image`, `active`) VALUES (:name, :description, :price, :image, :active);");
					$stmt->bindParam(":price",   $price,       PDO::PARAM_STR);
				} else {
					$stmt = $this->conn->open_db()->prepare("INSERT INTO :table (`name`, `description`, `image`, `active`) VALUES (:name, :description, :image, :active);");
				}
				$stmt->bindParam(":name",        $name,        PDO::PARAM_STR);
				$stmt->bindParam(":description", $description, PDO::PARAM_STR);
				$stmt->bindParam(":image",       $image,       PDO::PARAM_STR);
				$stmt->bindParam(":active",      $active,      PDO::PARAM_INT);
				return (($stmt->execute()) ? true : false);
			} catch (PDOException $e) {
				return "Erro: " . $e->getMessage();
			}
		}
/*************************************************************************************************************************************/

/****** Funções unicas de promotion **************************************************************************************************/
		// Busca promoção ativa
		function getActivePromotion() {
			//$active = 1;
			try {
				$stmt = $this->conn->open_db()->prepare("SELECT * FROM `promotion` WHERE `active` = 1 ORDER BY id DESC;");
				//$stmt->bindParam(":active", $active, PDO::PARAM_INT);
				return (($stmt->execute()) ? $stmt->fetch(PDO::FETCH_ASSOC) : false);
			} catch (PDOException $e) {
				return "Erro: " . $e->getMessage();
			}
		}
/*************************************************************************************************************************************/

/****** Funções unicas de featured ***************************************************************************************************/
		// Busca todos os destaques cadastrados
		function getLastFourFeatured () {
			$active = 1; 
			try {
				$stmt = $this->conn->open_db()->prepare("SELECT * FROM `featured` WHERE `active` = :active ORDER BY id DESC LIMIT 4;");
				$stmt->bindParam(":active", $active, PDO::PARAM_INT);
				return (($stmt->execute()) ? $stmt->fetchAll(PDO::FETCH_ASSOC) : false);
			} catch (PDOException $e) {
				return "Erro: " . $e->getMessage();
			}
		}
/*************************************************************************************************************************************/
	}
?>