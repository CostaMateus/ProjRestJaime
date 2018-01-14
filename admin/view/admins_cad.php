<?php
	require_once '../../config.php'; 
	require_once USER_API;
	require_once FUNC_API;
	
	$objUser = new User();
	$objFunc = new Functions();
		
	session_start();
	
	if (!$_SESSION['logado']) {
		header('location: ' . BASEURL . 'admin/');
	} 
	
	if (!empty($_GET['logout']) == 'y') { 
		$objUser->userDisconnect($_SESSION['idUser'], 2);
	}
	
	if(isset($_POST['btnRegister'])) {
		if ($_POST['pass1'] == $_POST['pass2'] && (!$objUser->qSelectLogins($_POST['login'], 1))) {
			if($objUser->qInsert($_POST)) {
				header('location: ' . BASEURL . 'admin/view/admins.php');
			}else{
				echo '<script type="text/javascript">alert("Erro ao cadastrar!");</script>';
			}
		} else {
			$loginExtt = true;
			$senhaInv = true;
		}
	}
	
	include(HEADER_TEMPLATE_ADM); 
?>
		
		<!-- inicio admins section -->
		<section id="admins" class="section">
			<div class="container">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<form class="form-horizontal" action="<?php $_SERVER["PHP_SELF"];?>" method="post">
							<fieldset class="text-center">
								<legend>Novo administrador</legend>
							</fieldset>
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nome</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="inputName" placeholder="Nome" 
										name="name" value="" required autofocus >
								</div>
							</div>
							
							<div class="form-group <?=(isset($loginExtt) ? "has-error" : "");?>">
								<label for="inputLogin" class="col-sm-3 control-label">Login</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="inputLogin" placeholder="Login" 
										name="login" value="" required >
									<?=(isset($loginExtt) ? "<span class='help-block'>Login existente, insira outro.</span>" : "");?>
								</div>
							</div>
							
							<div class="form-group"  >
								<label for="inputDtCa" class="col-sm-3 control-label">Data Cadastro</label>
								<div class="col-sm-9">
									<input type="text" disabled class="form-control" id="inputDtCa" placeholder="" 
										name="dateCa" value="" >
								</div>
							</div>
							
							<div class="form-group"  >
								<label for="inputDtUp" class="col-sm-3 control-label">Atualizado em</label>
								<div class="col-sm-9">
									<input type="text" disabled class="form-control" id="inputDtUp" placeholder="" 
										name="dateUp" value="" >
								</div>
							</div>
							
							<div class="form-group">
								<label for="inputStatus" class="col-sm-3 control-label">Status</label>
								<div class="col-sm-9">
									<input type="text" disabled class="form-control" id="inputStatus" placeholder="Status" 
										name="activation" value="Desativado" >
								</div>
							</div>
							
							<div class="form-group <?=(isset($senhaInv) ? "has-error" : "");?>">
								<label for="inputPass1" class="col-sm-3 control-label">Senha</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" id="inputPass1" placeholder="Senha" 
										name="pass1" required >
								</div>
							</div>
							
							<div class="form-group <?=(isset($senhaInv) ? "has-error" : "");?>">
								<label for="inputPass2" class="col-sm-3 control-label">Confirmar</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" id="inputPass2" placeholder="Confirmar senha" 
										name="pass2" required >
									<?=(isset($senhaInv) ? "<span class='help-block'>Campos vazios ou diferentes.</span>" : "");?>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-sm-2"></div>
								<div class="col-sm-5">
									<button type="submit" class="btn btn-primary btn-block" name="btnRegister" value="">Cadastrar</button>
								</div>
								<div class="col-sm-5">
									<button type="reset" class="btn btn-default btn-block" name="" value="">Limpar</button>
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-3"></div>
				</div>
			</div>
		</section>
		<!-- fim admins section -->
		
<?php 
	include(FOOTER_TEMPLATE_ADM); 
?>