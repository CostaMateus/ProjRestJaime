<?php

	class Featured {
		
		private id;
		private name;
		private description;
		private image;
		private active;
		
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
	}


?>