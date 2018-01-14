
		<!-- inicio contato section -->
		<section id="contato" class="section"> 
			<div class="container">
				<br><br>
				<h4 class="text-center" >Contato</h4>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="row text-left">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<h5>Endereço</h5>
								<p>Rua Dona Veridiana, 384 - Higienópolis, São Paulo - SP, 01238-010</p>
								<h5>E-mail</h5>
								<p>restaurante.estevao@gmail.com</p>
								<h5>Telefone</h5>
								<p>(11) 3338-1305</p>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="col-md-3"></div>
						<div class="col-md-9">
							<form class="form-horizontal" method="POST" action="<?=$_SERVER['PHP_SELF'];?>">
								<fieldset>
									<div class="form-group">
										<input type="text" class="form-control" id="inputName" name="nome" placeholder="Seu nome" required >
										<!-- pattern="[a-zA-Z0-9]+ -->
									</div>
									<div class="form-group">
										<input type="email" class="form-control" id="inputEmail_c2" name="email" placeholder="Seu e-mail" required >
										
									</div>
									<div class="form-group">
										<input type="text" class="form-control" id="inputAss" name="ass" placeholder="Assunto" required >
										
									</div>
									<div class="form-group">
										<textarea class="form-control" rows="3" id="inputTextArea_c2" name="msg" placeholder="Mensagem que deseja nos enviar." required ></textarea>
										<!--<span class="help-block" style="color:#FFF;">Escreva acima a mensagem que deseja nos enviar.</span>-->
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
												<button type="submit" class="btn btn-primary btn-block" name="btnSendEmail" >Enviar</button>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
												<button type="reset" class="btn btn-default btn-block" name="" value="" >Limpar</button>
											</div>
										</div>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- fim contato section -->
