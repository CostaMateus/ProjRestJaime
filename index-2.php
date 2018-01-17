<?php 
	require_once 'config.php'; 
	
	$objFunc = new Functions(); 
	
	include(HEADER_TEMPLATE); 
?>
		<!-- inicio home section -->
		<section id="home" class="section">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
						<br><br><br><br>
						<img id="logo1" src="<?=PATH_BOOT?>images/logos/Logo.svg" style="width:60%;" title="Estevão Restaurante e Lanchonete" alt="Estevão Restaurante e Lanchonete" />
						<br><br><br><br>
						<br><br><br><br>
						<h5 style="color:#FFF!important;">Segunda a sexta: 06h às 23h</h5>
						<h5 style="color:#FFF!important;">Sábado: 10h às 18h</h5>
					</div>
				</div>
			</div>
		</section>
		<!-- fim home section -->

		<!-- inicio quemsomos section -->
		<section id="quem" class="section" style="background-color:#FFF!important;">
			<div class="container">
				<br><br>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 text-center">
						<h4>Breve historia do estabelecimento</h4>
					</div>
					<div id="somos" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<br>
						<!-- rever disposiçao das imgs -->
						<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
							<img id="logo1" src="<?=PATH_BOOT?>images/DSCN1919.jpg" class="img-responsive img-rounded" title="Estevão Restaurante e Lanchonete" alt="Estevão" />
						</div>
						<p class="text-justify">
							<--- Foto do Self-Service 
							<br> 
							Mussum Ipsum, cacilds vidis litro abertis. Manduma pindureta quium dia nois paga. Suco de cevadiss deixa as pessoas mais interessantiss. Nullam volutpat risus nec leo commodo, ut interdum diam laoreet. Sed non consequat odio. Cevadis im ampola pa arma uma pindureta.
							Copo furadis é disculpa de bebadis, arcu quam euismod magna. Per aumento de cachacis, eu reclamis. Viva Forevis aptent taciti sociosqu ad litora torquent Delegadis gente finis, bibendum egestas augue arcu ut est.
							<br>
							Detraxit consequat et quo num tendi nada. Atirei o pau no gatis, per gatis num morreus. Posuere libero varius. Nullam a nisl ut ante blandit hendrerit. Aenean sit amet nisi. Si u mundo tá muito paradis? Toma um mé que o mundo vai girarzis!
							Praesent malesuada urna nisi, quis volutpat erat hendrerit non. Nam vulputate dapibus. in elementis mé pra quem é amistosis quis leo. Praesent vel viverra nisi. Mauris aliquet nunc non turpis scelerisque, eget. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.
						</p>
					</div>
				</div>
				<br><br>
			</div>
		</section>
		<!-- fim quemsomos section -->

		<!-- inicio destaques section -->
		<section id="destaque" class="section" >
			<div class="container">
				<br><br>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 text-center">
						<h3>Destaques</h3>
					</div>
				</div>
				<div class="row">
					<?php 
						$i = 1;
						foreach($objFunc->getLastFourFeatured() as $r1) { 
							if ($i < 3) { ?> 
								<div id="<?=$objFunc->base64_encode($r1['id']);?>" class="col-md-6">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
											<a class="example-image-link" href="<?=PATH_BOOT?>images/featured/<?=$r1['image']?>" data-lightbox="example-set" data-title="<?=$r1['name']?>">
												<img src="<?=PATH_BOOT?>images/featured/<?=$r1['image']?>" 
													class="img-responsive img-rounded" 
													title="<?=$r1['name']?>" 
													alt="<?=$r1['name']?>" />
											</a>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
											<h5 class="text-left"><?=$objFunc->treatCharacter($r1['name'],2)?></h5>
											<p class="text-left"><?=$objFunc->treatCharacter($r1['description'],2)?></p>
										</div>
									</div>
								</div>
					<?php	} else { 
								if ($i == 3) { ?> 
				</div>
				<br>
				<div class="row">
					<?php 		} ?>
								<div id="<?=$objFunc->base64_encode($r1['id']);?>" class="col-md-6">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
											<h5 class="text-left"><?=$objFunc->treatCharacter($r1['name'],2)?></h5>
											<p class="text-left"><?=$objFunc->treatCharacter($r1['description'],2)?></p>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
											<a class="example-image-link" href="<?=PATH_BOOT?>images/featured/<?=$r1['image']?>" data-lightbox="example-set" data-title="<?=$r1['name']?>">
												<img src="<?=PATH_BOOT?>images/featured/<?=$r1['image']?>" 
													class="img-responsive img-rounded" 
													title="<?=$r1['name']?>" 
													alt="<?=$r1['name']?>" />
											</a>
										</div>
									</div>
								</div>
					<?php 	}
							$i++;
						} ?>
				</div>
				<br><br>
			</div>
		</section>
		<!-- fim destaques section -->

		<!-- -->

		<!-- incio section de modais -->
		<section>
			<!-- inicio modal promos -->
			<?php 
				$r2 = $objFunc->getActivePromotion();
				if ($r2 != null) { ?>
					<script>$(document).ready(function() {$('#promos').modal('show');});</script>
					<div id="promos" class="modal fade promos" tabindex="-1" role="dialog" aria-labelledby="mod_contato">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h5 class="modal-title text-center" id="mod_contato">Promoção da semana</h5>
									<h4 class="text-center"><?=$r2['name']?></h4>
								</div>
								<div class="modal-body table-responsive">
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
										<img src="<?=PATH_BOOT?>images/promotion/<?=$r2['image']?>" 
											class="img-responsive img-rounded" 
											title="<?=$r2['name']?>" 
											alt="<?=$r2['name']?>" />
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
										<p><?=$r2['description']?></p>
										<h5><?=$r2['price']?></h5>
									</div>
								</div>
							</div>
						</div>
					</div> 
			<?php 
				} ?>
			<!-- fim modal promos -->
			
			<!-- inicio modal conhecer -->
			<div id="conhecer" class="modal fade conhecer" tabindex="-1" role="dialog" aria-labelledby="mod_conhecer">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title text-center" id="mod_conhecer">Venha conhecer</h4>
						</div>
						<div class="modal-body table-responsive">
							<div class="row  text-center">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1828.8600369188148!2d-46.65215807222503!3d-23.54256847258239!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xce50f49eea22244d!2sResturante+Estev%C3%A3o!5e0!3m2!1spt-BR!2sbr!4v1507558214782" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
								</div>
								<div class="col-lg-6 col-md-3 col-sm-12 col-xs-12">
									<h5>Endereço</h5>
									<p>Rua Dona Veridiana, 384 - Higienópolis, São Paulo - SP</p>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
									<h5>E-mail</h5>
									<p>restaurante.estevao@gmail.com</p>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
									<h5>Telefone</h5>
									<p>(11) 3338-1305</p>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div> 
			<!-- fim modal conhecer -->
		</section>
		<!-- fim section de modais -->

<?php 
	include(SOCIAL_TEMPLATE); 
	include(CONTAT_TEMPLATE); 
	include(FOOTER_TEMPLATE); 
?>
