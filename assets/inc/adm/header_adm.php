<!DOCTYPE html>
<html lang="pt-BR" prefix="og: http://ogp.me/ns#">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
		<meta name="author" content="Estavão Restaurante e Lanchonete">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<meta property="og:locale" content="pt_BR" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="Estevão - Administração" />
		<meta property="og:description" content="Administração." />
		<meta property="og:url" content="http://lolzimhj.pe.hu/" /> <!-- mudar -->
		<meta property="og:site_name" content="Estevão Restaurante e Lanchonete" />
		<meta property="og:image" content="http://lolzimhj.pe.hu/assets/imgs/logos/LogoMini.png" /> <!-- add imagem -->
		
		<title>Administração</title>

		<!-- FavIcon -->
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo BASEURL; ?>assest/boot/images/logos/icone.svg"> 

		<!-- CSS Bootstrap e personalizado -->
		<link href="<?php echo BASEURL; ?>assets/boot/css/normalize.css" type="text/css" media="screen"/>
		<link href="<?php echo BASEURL; ?>assets/boot/css/bootstrap.css" type="text/css" media="screen"/>
		<link href="<?php echo BASEURL; ?>assets/boot/css/custom.css"    type="text/css" media="screen"/>
		
		<!-- Scripts -->
		<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
		<script>
			$(function() {
				$('a[href*="#"]:not([href="#"])').click(function() {
					if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
						var target = $(this.hash);
						target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
						if (target.length) {
							$('html, body').animate({scrollTop: target.offset().top - 49}, 1000);
							return false;
						}
					}
				});
			}); 
		</script>
	</head>

	<body data-spy="scroll" data-offset="100" data-target="#navbar-main" >
		<!-- inicio navbar section -->
		<nav id="navbar-main" class="navbar navbar-inverse" style="background-color:#F47B25!important;">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navmain" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!--<a href="" rel="next" target="_top" class="brand-logo default-hidden">
						<img class="" height="40" alt="Estevão Lanches" src="<?php //echo BASEURL; ?>assets/boot/images/logos/LogoBranco.svg">
					</a>-->
				</div>
				<div id="navmain" class="collapse navbar-collapse" aria-expanded="false" role="navigation">
					<ul class="nav navbar-nav navbar-left"> 
						<li class="dropdown <?php $objFunc->echoActiveClassIfRequestMatches("promos")?>">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Promoções <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="promos.php" >Lista</a></li>
								<li><a href="promos_cad.php" >Nova promoção</a></li>
							</ul>
						</li>
						<li class="dropdown <?php $objFunc->echoActiveClassIfRequestMatches("destaques")?>">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Destaques <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="destaques.php" >Lista</a></li>
								<li><a href="destaques_cad.php" >Novo destaque</a></li>
							</ul>
						</li>
						<li class="dropdown <?php $objFunc->echoActiveClassIfRequestMatches("admins")?>">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admins <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="admins.php" >Lista</a></li>
								<li><a href="admins_cad.php" >Novo admin</a></li>
							</ul>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li <?php $objFunc->echoActiveClassIfRequestMatches("index")?>><a href="index.php" ><strong><?php echo $_SESSION['nameUser'] . "<br>";?></strong></a></li>
						<li><a class="" href="?logout=y" ><u>Sair</u></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- fim navbar section -->
