<?php
	require_once '../config.php'; 
	require_once USER_API;
	
	$objUser = new User();
	
	if(isset($_POST['btnEntrar'])) {
		$objUser->validaLogin($_POST);
	}
	
?>
<!DOCTYPE html>
<html lang="pt-BR" prefix="og: http://ogp.me/ns#">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
		<meta name="author" content="Estavão Restaurante e Lanchonete">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<meta property="og:locale" content="pt_BR" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="Estavão - Administração" />
		<meta property="og:description" content="Administração do conteúdo do site." />
		<meta property="og:url" content="" /> <!-- mudar -->
		<meta property="og:site_name" content="Estavão Lanches" />
		<meta property="og:image" content="" /> <!-- add imagem -->
		
		<title>Administração</title>

		<!-- FavIcon -->
		<link rel="shortcut icon" type="image/x-icon" href=""> 

		<!-- CSS Bootstrap e personalizado -->
		<link href="<?php echo BASEURL; ?>assets/css/bootstrap.css" type="text/css" rel="stylesheet prefetch" media="screen"/>
		<link href="<?php echo BASEURL; ?>assets/css/custom.css" type="text/css" rel="stylesheet prefetch" media="screen"/>
		
		<!-- Scripts -->
		<script src="https://code.jquery.com/jquery-3.1.0.min.js" 
			integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
		<script>
			<?php 
				//if (!empty($_GET['t']) == "time") { ?>
					// alert("Você foi desconectado por inatividade!");
					// $(document).ready(function() {$('#promos').modal('show');});
			<?php
				//} ?>
		</script>
	</head>
	
	<body> 
		<!-- inicio login section -->
		<section id="login" class="section">
			<div class="container">
				<br>
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<img id="logo1" class="img-responsive" src="<?php echo BASEURL; ?>assets/imgs/logos/Logo.svg" title="Estevão Restaurante e Lanchonete" alt="Estevão" />
					</div>
					<div class="col-md-4"></div>
				</div>
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4 well">
						<h5 class="text-center">Administração</h5>
						<?php
							if (!empty($_GET['e']) == "error") { ?>
								<div class="alert alert-danger alert-block text-center" role="alert">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
									<span class="sr-only">Erro:</span>
									Login e/ou senha estão incorretos!
								</div>
						<?php 
							} 
							if (!empty($_GET['a']) == "active") { ?>
								<div class="alert alert-info alert-block text-center" role="alert">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
									<span class="sr-only">Info:</span>
									Esta conta está desativada.<br>Peça a outro administrador para que a reative!
								</div>
						<?php 
							} 
							if (!empty($_GET['m']) == "mod") { ?>
								<div class="alert alert-info alert-block text-center" role="alert">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
									<span class="sr-only">Info:</span>
									Você foi deslogado pois alterou<br>seu login e/ou senha.
								</div>
						<?php 
							}
							if (!empty($_GET['s']) == "stt") { ?>
								<div class="alert alert-warning alert-block text-center" role="alert">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
									<span class="sr-only">Info:</span>
									Você foi deslogado pois desativou sua conta.
								</div>
						<?php 
							} 
							// if (!empty($_GET['i']) == "info") { ?>
								<!--<div class="alert alert-warning alert-block text-center" role="alert">
									<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
									<span class="sr-only">Atenção:</span>
									Essa conta está logada em outro dispositivo! 
								</div>-->
						<?php 
							// } ?>
						<form class="form-group" action="<?php $_SERVER["PHP_SELF"];?>" method="post">
							<div class="form-group">
								<input type="text" class="form-control" id="inputLogin" placeholder="Login" 
									name="login" required autofocus >
							</div>
							<div class="form-group">
								<input type="password" class="form-control" id="inputPass" placeholder="Senha" 
									name="pass" required >
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-6">
										<button type="submit" class="btn btn-primary btn-block" name="btnEntrar">Entrar</button>
									</div>
									<div class="col-md-6">
										<a class="btn btn-default btn-block" href="../" role="button">Voltar</a>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-4"></div>
				</div>
			</div>
		</section>
		<!-- fim login section -->
		
		<!-- incio section de modais -->
		<section>
			<!-- inicio modal deslog -->
			<!--<div id="promos" class="modal fade promos" tabindex="-1" role="dialog" aria-labelledby="mod_contato">
				<div class="modal-dialog modal-sm alert" role="document">
					<div class="modal-content ">
						<div class="modal-body alert-info alert-block text-center">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<div class="" role="alert">
								<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
								<span class="sr-only">Info:</span> Você foi desconectado por inatividade!
							</div>
						</div>
					</div>
				</div>
			</div> -->
			<!-- fim modal deslog -->
		</section>
		<!-- fim section de modais -->
		
		<!-- Scripts -->
		<!-- Última versão JavaScript compilada e minificada -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" 
			integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</body>
</html>










