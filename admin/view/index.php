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
	
	
	//POST para editar dados da conta (nome, login)
	if (isset($_POST['btnSaveEdition'])) {
		if ($objUser->qSelectLogins($_POST['login'], 2)) {
			if ($objUser->qUpdate($_POST, 2)) {
				if ($_POST['login'] != $_SESSION['loginUser']) {
					$_SESSION['logado'] = false;
					header('location: ' . BASEURL . 'admin/?m=mod');
				} else {
					header('location: ' . BASEURL . 'admin/view/');
				}
			} else {
				echo '<script type="text/javascript">alert("Erro ao salvar modificação!");</script>';
			}
		} else {
			$loginExtt = true;
		}
	}
	
	//POST para editar demais dados da conta (nome, login, senha[n ainda])
	if (isset($_POST['btnSavePasswordChange'])) {
		if ($_POST['pass2'] == $_POST['pass3']) {
			echo "senha iguais";
			if ($objUser->validaPass($_POST['pass1'], $_POST['idU'])) {
				if ($objUser->qUpdatePass($_POST)) {
					$_SESSION['logado'] = false;
					header('location: ' . BASEURL . 'admin/?m=mod');
				} else {
					echo '<script type="text/javascript">alert("Erro ao salvar modificação!");</script>';
				}
			} else {
				$senhaInv1 = true;
			}
		} else {
			$senhaInv2 = true;
		}
	}
	
	if (isset($_GET['action'])) {
		$temp = $objUser->qSelect($_GET['id']);
		switch($_GET['action']) {
			case 'edit': 
				$user = $temp;
				break;
		}
	}
	
	include(HEADER_TEMPLATE_ADM); 
?> 

		<!-- inicio quemsomos section -->
		<section id="index" class="section" style="background-color:#FFF!important;">
			<div class="container">
				<div class="row">
					<div class="col-md-6 ">
						<h5 class=" text-center">Meus dados</h5>
						<?php $result = $objUser->qSelect($objFunc->base64($_SESSION['idUser'], 1));?>
						<form class="form-horizontal" action="<?php $_SERVER["PHP_SELF"];?>" method="post">
							
							<input type="hidden" name="idU" value="<?=$objFunc->base64($result['idUser'], 1); ?>">
							
							<div class="form-group">
								<label for="inputName" class="col-sm-3 control-label">Nome</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="inputName" placeholder="Nome" 
										name="name" value="<?=$result['name']; ?>" required >
								</div>
							</div>
							<div class="form-group <?=(isset($loginExtt) ? "has-error" : "");?>">
								<label for="inputLogin" class="col-sm-3 control-label">Login</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="inputLogin" placeholder="Login" 
										name="login" value="<?=$result['login'];?>" required >
									<?=(isset($loginExtt) ? "<span class='help-block'>Login existente, insira outro.</span>" : "");?>
								</div>
							</div>
							<div class="form-group"  >
								<label for="inputDtCa" class="col-sm-3 control-label">Data Cadastro</label>
								<div class="col-sm-9">
									<input type="text" disabled class="form-control" id="inputDtCa" placeholder="Data cadastro" 
										name="" value="<?=$objFunc->fDate($result['dateCa']);?>"  >
								</div>
							</div>
							<div class="form-group"  >
								<label for="inputDtUp" class="col-sm-3 control-label">Atualizado em</label>
								<div class="col-sm-9">
									<input type="text" disabled class="form-control" id="inputDtUp" placeholder="Data atualização" 
										name="" value="<?=$objFunc->fDate($result['dateUp']);?>"  >
								</div>
							</div>
							<div class="form-group">
								<label for="inputStatus" class="col-sm-3 control-label">Status</label>
								<div class="col-sm-9">
									<input type="text" disabled class="form-control" id="inputStatus" placeholder="Status" 
										name="" value="<?=($result['activation'] == 1) ? "Ativado" : "Desativado";?>"  >
								</div>
							</div>
							<div class="form-group">
								<label for="inputPass1" class="col-sm-3 control-label">Senha</label>
								<div class="col-sm-9">
									<input type="password" disabled class="form-control" id="inputPass1" placeholder="Senha" 
										name="" value="************************************************************" >
								</div>
							</div>
							<div class="form-group">
								<label for="inputPass2" class="col-sm-3 control-label">Nova senha</label>
								<div class="col-sm-9">
									<a href="?action=edit&id=<?=$objFunc->base64($result['idUser'], 1); ?>" 
										class="btn btn-default btn-block" role="button">Mudar senha</a>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-sm-6">
									<button type="submit" class="btn btn-primary btn-block" name="btnSaveEdition" value="">Editar</button>
								</div>
								<div class="col-sm-6">
									<button type="reset" class="btn btn-default btn-block" name="" value="">Limpar</button>
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-6 ">
						<?php 
							if (isset($user)) { ?>
								<h5 class="text-center" id="">Editar senha</h5>
								<form class="form-horizontal" action="<?php $_SERVER["PHP_SELF"];?>" method="post">
									
									<input type="hidden" name="idU" value="<?=$objFunc->base64($user['idUser'], 1); ?>">
									
									<div class="form-group <?=(isset($senhaInv1) ? "has-error" : "");?>">
										<label for="inputPass1" class="col-sm-3 control-label">Senha atual</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="inputPass1" placeholder="Senha atual" 
												name="pass1" value="" required >
											<?=(isset($senhaInv1) ? "<span class='help-block'>Senha atual inválida.</span>" : "");?>
										</div>
									</div>
									
									<div class="form-group <?=(isset($senhaInv2) ? "has-error" : "");?>">
										<label for="inputPass2" class="col-sm-3 control-label">Nova senha</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="inputPass2" placeholder="Nova senha" 
												name="pass2" value="" required >
										</div>
									</div>
									
									<div class="form-group <?=(isset($senhaInv2) ? "has-error" : "");?>">
										<label for="inputPass3" class="col-sm-3 control-label">Confirma</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="inputPass3" placeholder="Confirmar senha" 
												name="pass3" value="" required >
											<?=(isset($senhaInv2) ? "<span class='help-block'>Campos vazios ou diferentes.</span>" : "");?>
										</div>
									</div>
									
									<div class="form-group">
										<div class="col-sm-6">
											<button type="submit" class="btn btn-primary btn-block" name="btnSavePasswordChange" value="">Salvar</button>
										</div>
										<div class="col-sm-6">
											<button type="reset" class="btn btn-default btn-block" name="" value="">Limpar</button>
										</div>
									</div>
								</form>
						<?php
							} ?>
					</div>
				</div>
			</div>
		</section>
		<!-- fim admins section -->
		
<?php 
	include(FOOTER_TEMPLATE_ADM); 
?>