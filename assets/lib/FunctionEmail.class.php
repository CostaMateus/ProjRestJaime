<?php
	// require_once 'PHPMailer-master/PHPMailerAutoload.php';
	
	//Classe de funções 
	class FunctionEmail {
		
		private $objEmail;
		
		public function __construct(){
			// $this->objEmail = new PHPMailer();		
		}
		// Trata caracteres 
		public function treatCharacter($value, $type) {
			// switch($type) {
				// case 1: 
					// $result = utf8_decode($value); 
					// break;
				// case 2: 
					// $result = htmlentities($value, ENT_QUOTES, "ISO-8859-1");
					// break;
			// }
			// return $result;
		}
		
		public function sendEmail($data){
			
			// $this->objmail->IsSMTP();
			// $this->objmail->SMTPAuth = true;
			// $this->objmail->SMTPSecure = 'tls';
			// $this->objmail->Port = 587;
			// $this->objmail->Host = 'smtpt.dominio.com.br';
			// $this->objmail->Username = 'email@dominio.com.br';
			// $this->objmail->Password = 'senha12345';
			// $this->objmail->ContentType = 'text/html; charset=utf-8';
			// $this->objmail->SetFrom('email@dominio.com.br', 'Contato');
			// $this->objmail->AddAddress('email@dominio.com.br', 'Teste de envio de e-mail');
			// $this->objmail->Subject = ''.$this->tratarCaracter($data['assunto'], 1).'';

			// $html = '<p><strong>Nome:</strong> '.$this->tratarCaracter($data['nome'], 1).'<br>';
			// $html .= '<strong>E-mail:</strong> '.$data['email'].'<br>';
			// $html .= '<strong>Assunto:</strong> '.$this->tratarCaracter($data['assunto'], 1).'<br>';
			// $html .= '<strong>Mensagem:</strong><br>';
			// $html .= $this->tratarCaracter($data['mensagem'], 1).'</p>';

			// $this->objmail->MsgHTML($html);

			// if (!$this->objmail->Send()) {
				// echo "Mailer Error: " . $this->objmail->ErrorInfo;
			// } else {
				// echo "Mensagem enviada";
			// }
		}
	}
?>