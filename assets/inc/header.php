<!DOCTYPE html>
<html lang="pt-BR" prefix="og: http://ogp.me/ns#">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
		<meta name="author" content="Estavão Restaurante e Lanchonete">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<meta property="og:locale" content="pt_BR" />
		<meta property="og:type" content="website" />
		<meta property="og:title" content="Estevão Restaurante e Lanchonete" />
		<meta property="og:description" content="Descrever o site!!!" />
		<meta property="og:url" content="http://lolzimhj.pe.hu/" /> <!-- mudar -->
		<meta property="og:site_name" content="Estevão Restaurante e Lanchonete" />
		<meta property="og:image" content="http://lolzimhj.pe.hu/assets/imgs/logos/LogoMini.png" /> <!-- mudar / add imagem -->
		
		<title>Estavão Restaurante e Lanchonete</title>

		<!-- FavIcon -->
		<link rel="shortcut icon" type="image/x-icon" href="<?=BASEURL?>assest<?=B?>boot<?=B?>images<?=B?>logos<?=B?>icone.svg"> 

		<!-- CSS Bootstrap e personalizado -->
		<link href="<?=PATH_BOOT?>css/normalize.css"    rel="stylesheet" type="text/css" />
		<link href="<?=PATH_BOOT?>css/bootstrap.css"    rel="stylesheet" type="text/css" />
		<link href="<?=PATH_BOOT?>css/custom.css"       rel="stylesheet" type="text/css" />
		<link href="<?=PATH_BOOT?>css/lightbox.min.css" rel="stylesheet" type="text/css" />

		<!-- Scripts -->
		<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
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
		
		<style>
			/* 
				letra S e O  : #F47B25 laranja
				demais letras: #692603 marrom
			*/
			#somos #logo1 {
				float:left !important;
				margin:0 15px 5px 0 !important;
			}
			#somos #logo2 {
				float:right !important;
				margin:5px 0 5px 15px !important;
			}
			#destaque, #contato {background-color:#F5F5F5!important;}
		</style>
	</head>

	<body data-spy="scroll" data-offset="100" data-target="#navbar-main">
		<!-- inicio navbar section -->
		<nav id="navbar-main" class="navbar navbar-inverse navbar-fixed-top" style="background-color:#F47B25!important;">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navmain" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="" rel="next" target="_top" class="brand-logo default-hidden">
						<img class="" height="40" alt="Estevão Lanches" src="<?php echo BASEURL; ?>assets/boot/images/logos/LogoBranco.svg">
					</a>
				</div>
				<div id="navmain" class="collapse navbar-collapse" aria-expanded="false" role="navigation">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#home" >Home</a></li>
						<li><a href="#quem" >Quem somos</a></li>
						<li><a href="#destaque" >Destaques</a></li>
						<li><a href="#contato" >Contato</a></li>
						<li><a href="<?=PATH_BOOT?>card/cardapio.pdf" target="_blank">Cardápio</a></li>
						<li><a href="" data-toggle="modal" data-target="#conhecer" >Venha conhecer</a></li>
					</ul>
				</div>
			</div>
		</nav>
