<?php 
	require_once 'config.php'; 
	require_once FUNC_API; 
	require_once EMAIL_API; 
	
	$objFunc = new Functions(); 
	$objFuncE = new FunctionEmail(); 
	
	if(isset($_POST['btnSendEmail'])) {
		$objFuncE->sendEmail($_POST);
	}
	
	include(HEADER_TEMPLATE); 
?>
		<!-- inicio home section -->
		<section id="home" class="section">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
						<br><br><br><br>
						<img id="logo1" src="<?php echo BASEURL; ?>assets/imgs/logos/Logo.svg" style="width:60%;" title="Estevão Restaurante e Lanchonete" alt="Estevão Restaurante e Lanchonete" />
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
							<img id="logo1" src="<?php echo BASEURL; ?>assets/imgs/DSCN1919.jpg" class="img-responsive img-rounded" title="Estevão Restaurante e Lanchonete" alt="Estevão" />
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
						
						<!-- desnecessario - rever disposiçao das imgs 
						<div class="col-lg-4 col-lg-offset-8 col-md-2 col-sm-2 col-xs-6">
							<img id="logo2" src="<?php echo BASEURL; ?>assets/imgs/exemplo.jpg" class="img-responsive img-rounded" title="Estevão Restaurante e Lanchonete" alt="Estevão" />
						</div>
						<p class="text-right">
							Foto da Lanchonete (ex) 
						</p>
						<p class="text-justify">
							Paisis, filhis, espiritis santis. Quem manda na minha terra sou Euzis! Não sou faixa preta cumpadi, sou preto inteiris, inteiris. Casamentiss faiz malandris se pirulitá.
							Mé faiz elementum girarzis, nisi eros vermeio. Quem num gosta di mé, boa gente num é. A ordem dos tratores não altera o pão duris Si num tem leite então bota uma pinga aí cumpadi!  
							Mauris nec dolor in eros commodo tempor. Aenean aliquam molestie leo, vitae iaculis nisl. Suco de cevadiss, é um leite divinis, qui tem lupuliz, matis, aguis e fermentis. Mais vale um bebadis conhecidiss, que um alcoolatra anonimiss. Ta deprimidis, eu conheço uma cachacis que pode alegrar sua vidis.”
							
							Detraxit consequat et quo num tendi nada. Atirei o pau no gatis, per gatis num morreus. Posuere libero varius. Nullam a nisl ut ante blandit hendrerit. Aenean sit amet nisi. Si u mundo tá muito paradis? Toma um mé que o mundo vai girarzis!
						</p>-->
					</div>
				</div>
				<br><br>
			</div>
		</section>
		<!-- fim quemsomos section -->

		<!-- inicio destaques section -->
		<section id="destaque" class="section" ><!--style="background-color:#FFF!important;"-->
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
						foreach($objFunc->qSelect4Destaques() as $result1) { 
							if ($i < 3) { ?> 
								<div id="<?php echo $result1['id'];?>" class="col-md-6">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
											<a class="example-image-link" href="<?php echo BASEURL; ?>assets/imgs/destaques/<?php echo $result1['image'];?>" data-lightbox="example-set" data-title="<?php echo ($result1['name']);?>">
												<img src="<?php echo BASEURL; ?>assets/imgs/destaques/<?php echo $result1['image'];?>" 
													class="img-responsive img-rounded" 
													title="<?php echo ($result1['name']);?>" 
													alt="<?php echo ($result1['name']);?>" />
											</a>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
											<h5 class="text-left"><?php echo ($result1['name']);?></h5>
											<p class="text-left"><?php echo ($result1['description']);?></p>
										</div>
									</div>
								</div>
					<?php	} else { 
								if ($i == 3) { ?> 
				</div>
				<br>
				<div class="row">
					<?php 		} ?>
								<div id="<?php echo $result1['id'];?>" class="col-md-6">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
											<h5 class="text-right"><?php echo ($result1['name']);?></h5>
											<p class="text-right"><?php echo ($result1['description']);?></p>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
											<a class="example-image-link" href="<?php echo BASEURL; ?>assets/imgs/destaques/<?php echo $result1['image'];?>" data-lightbox="example-set" data-title="<?php echo ($result1['name']);?>">
												<img src="<?php echo BASEURL; ?>assets/imgs/destaques/<?php echo $result1['image'];?>" 
													class="img-responsive img-rounded" 
													title="<?php echo ($result1['name']);?>" 
													alt="<?php echo ($result1['name']);?>" />
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
				$result2 = $objFunc->getActivePromo();
				if ($result2 != null) { ?>
					<script>$(document).ready(function() {$('#promos').modal('show');});</script>
					<div id="promos" class="modal fade promos" tabindex="-1" role="dialog" aria-labelledby="mod_contato">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h5 class="modal-title text-center" id="mod_contato">Promoção da semana</h5>
									<h4 class="text-center"><?php echo ($result2['name']);?></h4>
								</div>
								<div class="modal-body table-responsive">
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
										<img src="<?php echo BASEURL; ?>assets/imgs/promos/<?php echo ($result2['image']);?>" 
											class="img-responsive img-rounded" 
											title="<?php echo ($result2['name']);?>" 
											alt="<?php echo ($result2['name']);?>" />
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
										<p><?php echo ($result2['description']);?></p>
										<h5><?php echo ($result2['price']);?></h5>
									</div>
								</div>
							</div>
						</div>
					</div> 
			<?php 
				} //else { ?>
						<!--
						<div id="promos" class="modal fade promos" tabindex="-1" role="dialog" aria-labelledby="mod_contato">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h5 class="modal-title text-center" id="mod_contato">Promoção da semana</h5>
									</div>
									<div class="modal-body table-responsive">
										<div class="alert alert-warning alert-block text-center" role="alert">
											<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
											<span class="sr-only"><strong>Aviso:</strong></span>
											Nenhuma promoção ativa!
										</div>
									</div>
								</div>
							</div>
						</div>
						-->
			<?php //} ?>
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
