<?php
	/***************************************/
	/** 								  **/
	/** Classe refatorada - FALTA REVISÃO **/
	/** 								  **/
	/***************************************/
	// Classe Promoção
	class Promotion {
		
		private id;
		private name;
		private description;
		private price;
		private image;
		private active;
		private idUser;
		
		/** inicio Getter e Setters **/
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
		
		public function getDescription() {
			return $this->description;
		}
		
		public function setDescription($value) {
			$this->description = $value;
		}
		
		public function getPrice() {
			return $this->price;
		}
		
		public function setPrice($value) {
			$this->price = $value;
		}
		
		public function getImage() {
			return $this->image;
		}
		
		public function setImage($value) {
			$this->image = $value;
		}
		
		public function getActive() {
			return $this->active;
		}
		
		public function setActive($value) {
			$this->active = $value;
		}
		
		public function getIdUser() {
			return $this->idUser;
		}
		
		public function setIdUser($value) {
			$this->idUser = $value;
		}
		/** inicio Getter e Setters **/
		
		// Procura um Promoção por ID 
		public function loadById($id) {
			$sql = new Sql(); 
			$r = $sql->select("SELECT * FROM promotion WHERE id = :id ", 
				array(":id"=>base64_decode($id))
			);
			
			if (count($r) > 0) {
				$this->setAttributes($r[0]);
			}
		}
		
		// Busca todas as Promoções cadastrados 
		public static function getList() {
			$sql = new Sql();
			return $sql->select("SELECT * FROM promotion ORDER BY id;");
		}
		
		// Busca todas Promoções que contenham a string passada
		public static function search($name) {
			$sql = new Sql();
			return $sql->select("SELECT * FROM promotion WHERE name LIKE :search ORDER BY name;",
				array(":search"=>"%" . $name . "%")
			);
		}
		
		// Insere um novo usuário
		public function insert($name, $description, $price, $image, $active, $iduser) {
			/*
				Tratar dados antes de invocar a função
				De preferência no formulário 
				strtolower(login)
			*/
			// $this->setDateCa(self::getCurrentDate());
			$sql = new Sql();
			$sql->query("INSERT INTO promotion (name, description, price, image, active, iduser) 
							VALUES (:name, :description, :price, :image, :active, :iduser);", 
				array(
					":name"=>$name,
					":description"=>$description,
					":price"=>$price,
					":image"=>$image,
					":active"=>$active,
					":iduser"=>$iduser
				)
			);
			$r = $sql->select("SELECT * FROM promotion WHERE id = LAST_INSERT_ID();");
			if (count($r) > 0) {
				$this->setAttributes($r[0]);
			}
		}
		
		// Atualiza dados de um usuário 
		public function update($name, $description, $price, $image, $active) {
			/*
				Tratar dados antes de invocar a função
				De preferência no formulário 
			*/
			if ($name != null || $name != "") 
				$this->setName($name);
			if ($description != null || $description != "") 
				$this->setDescription($description);
			if ($price != null || $price != "") 
				$this->setPrice($price);
			if ($image != null || $image != "") 
				$this->setImage($image);
			if ($active != null || $active != "") 
				$this->setActive($active);
			$sql = new Sql();
			$sql->query("UPDATE promotion SET name = :name, description = :description, price = :price, image = :image, active = :active 
							WHERE id = :id;", 
				array(
					":name"=>$this->getName(),
					":description"=>$this->getDescription(),
					":price"=>$this->getPrice(),
					":image"=>$this->getImage(),
					":active"=>$this->getActive(),
					":id"=>$this->getId()
				)
			);
		}
		
		// Apaga um usuário 
		public function delete() {
			$sql = new Sql();
			$sql->query("DELETE FROM promotion WHERE id = :id", 
				array(":id"=>$this->getId())
			);
			$this->setId(null);
			$this->setName(null);
			$this->setDescription(null);
			$this->setPrice(null);
			$this->setImage(null);
			$this->setActive(null);
			$this->setIdUser(null);
		}
		
		// Setando o atributos do usuário
		private function setAttributes($data) {
			$this->setId($data['id']);
			$this->setName($data['name']);
			$this->setDescription($data['description']);
			$this->setPrice($data['price']);
			$this->setImage($data['image']);
			$this->setActive($data['active']);
			$this->setIdUser($data['iduser']);
		}
		
		// Cria um timestamp com fuso de Brasília/SãoPaulo
		public static function getCurrentDate() {
			return ((new DateTime())->setTimeZone(new DateTimeZone("America/Sao_Paulo")))->format("Y-m-d H:i:s");
		}
	}


?>