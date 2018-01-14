<?php
	require_once '../../config.php'; 
	require_once USER_API;
	require_once FUNC_API;
	
	$objUser = new User();
	$objFunc = new Functions();
		
	session_start();
	// session_cache_expire($_SESSION['loginTime'] - time());
	
	if (!$_SESSION['logado']) {
		header('location: ' . BASEURL . 'admin/');
	} // elseif (time() > $_SESSION['loginTime']) {
		// $objUser->userDisconnect($_SESSION['idUser'], 1);
	// }
	if (!empty($_GET['logout']) == 'y') { 
		$objUser->userDisconnect($_SESSION['idUser'], 2);
	}
	
	
	//POST para apenas alterar o status da conta (on/off)
	if (isset($_POST['btnSaveStatus'])) {
		if ($objUser->qUpdateStatus($_POST)) {
			if ($objFunc->base64($_SESSION['idUser'], 1) == $_POST['idU']) {
				$_SESSION['logado'] = false;
				header('location: ' . BASEURL . 'admin/?s=stt');
			} else {
				header('location: ' . BASEURL . 'admin/view/admins.php');
			}
		} else {
			echo '<script type="text/javascript">alert("Erro ao salvar modificação!");</script>';
		}
	}
	
	//POST para editar demais dados da conta (nome, login, senha[n ainda])
	if (isset($_POST['btnSaveEdition'])) {
		if ($objUser->qUpdate($_POST, 1)) {
			header('location: ' . BASEURL . 'admin/view/admins.php');
		} else {
			echo '<script type="text/javascript">alert("Erro ao salvar modificação!");</script>';
		}
	}
	
	//POST para apagar a conta
	if (isset($_POST['btnDelete'])) {
		if ($_POST['delet'] == 0) {
			if ($objUser->qUpdateStatus($_POST)) {
				header('location: ' . BASEURL . 'admin/view/admins.php');
			} else {
				echo '<script type="text/javascript">alert("Erro ao excluir dado!");</script>';
			}
		} elseif ($_POST['delet'] == 1) {
			if ($objUser->qDelete($_POST)) {
				header('location: ' . BASEURL . 'admin/view/admins.php');
			} else {
				echo '<script type="text/javascript">alert("Erro ao excluir dado!");</script>';
			}	
		}
	}
	
	if (isset($_GET['action'])) {
		$temp = $objUser->qSelect($_GET['id']);
		switch($_GET['action']) {
			case 'status': 
				$status = $temp;
				break;
			case 'edit': 
				$user = $temp;
				break;
			case 'delet':
				$delet = $temp;
				break;
		}
	}
	
	include(HEADER_TEMPLATE_ADM); 
?>
		
		<!-- inicio lista admins section -->
		<section id="admins" class="section">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Nome</th>
									<th>Login</th>
									<th>Atualizado em</th>
									<th>Status</th>
									<th>Editar</th>
									<th>Excluir</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i = 1;
									foreach($objUser->qSelect() as $result) { ?>
										<tr>
											<th scope="row"><?=$i;?></th>
											<td><?=$result['name']; ?></td>
											<td><?=$result['login']; ?></td>
											<td><?=$objFunc->fDate($result['dateUp']); ?></td>
											<td>
												<a href="?action=status&id=<?=$objFunc->base64($result['idUser'], 1); ?>" title="Status">
													<img class="img-responsive" src="<?=BASEURL; ?>assets/imgs/ctrl/<?=($result['activation'] == 1 ? "on" : "off");?>.png" alt="Status">
												</a>
											</td>
								<?php 	if ($_SESSION['idUser'] != $result['idUser']) {?>
											<td>
												<a href="?action=edit&id=<?=$objFunc->base64($result['idUser'], 1); ?>" title="Editar">
													<img class="img-responsive" src="<?=BASEURL; ?>assets/imgs/ctrl/editar.png" alt="Editar">
												</a>
											</td>
											<td>
												<a href="?action=delet&id=<?=$objFunc->base64($result['idUser'], 1); ?>" title="Excluir">
													<img class="img-responsive" src="<?=BASEURL; ?>assets/imgs/ctrl/excluir.png" alt="Excluir">
												</a>
											</td>
								<?php 	} else { ?>
											<td></td>
											<td></td>
								<?php	} ?>
										</tr>
								<?php	$i++;
									} ?>
							</tbody>
						</table>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</section>
		<!-- fim lista admins section -->
		
		<!-- inicio modais section -->
		<section id="modais" class="section">
			
			<!-- inicio status modal -->
			<?php 
				if (isset($status)) { ?>
					<script>$(document).ready(function() {$('#status').modal('show');});</script>
					<div id="status" class="modal fade status" tabindex="-1" role="dialog" aria-labelledby="mod_contato">
						<div class="modal-dialog modal-md" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h5 class="modal-title text-center" id="mod_contato">Alterar status</h5>
								</div>
								<div class="modal-body table-responsive">
									<div class="col-md-12">
										<form class="form-horizontal text-center" action="<?php $_SERVER["PHP_SELF"];?>" method="post">
											<?php 
												if ($status['activation'] == 1 ? $st = "ativa" : $st = "desativada");
												if ($status['activation'] == 1 ? $st_c = "desativar" : $st_c = "ativar"); 
												
												if ($_SESSION['idUser'] == $status['idUser']) { 
													$btnConf = "Confirmar";
													$classSave = "danger";
													$input = "has-error";
											?>
													<p class="alert alert-danger" role="alert">Deseja <u><?=$st_c;?></u> seu próprio perfil?</p>
													<p class="alert alert-info" role="alert">
														Se confirmar, não consiguirá acessar mais essa área.<br>
														Outro administrador deverá reativar seu perfil!<br>
														Você será deslogado de imediato!
													</p>
											<?php
												} else {
													$classSave = "primary";
													$input = "";
											?>
													<p>A conta do admin "<i><?=$status['name'];?></i>" está atualmente <code><?=$st;?></code>.</p>
													<p>Deseja <u><?=$st_c;?></u>?</p>
											<?php
												} ?>
											<div class="form-group <?=$input;?>">
												<input type="hidden" name="idU" value="<?=$objFunc->base64($status['idUser'], 1); ?>" >
												<div class="col-sm-12">
													<select name="status" class="form-control" id="inputStatus" autofocus>
														<option value="1" <?=($status['activation'] == 0) ? "selected" : "";?> >Ativar</option>
														<option value="0" <?=($status['activation'] == 1) ? "selected" : "";?>>Desativar</option>
													</select>
												</div>
											</div>
											
											<div class="form-group">
												<div class="col-sm-6">
													<button type="submit" class="btn btn-<?=$classSave;?> btn-block" name="btnSaveStatus" value="">
														<?=(isset($btnConf) ? "Confirmar" : "Salvar");?></button>
												</div>
												<div class="col-sm-6">
													<a class="btn btn-default btn-block" href="admins.php" role="button">Cancelar</a>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div> 
			<?php 
				} ?>
			<!-- fim status modal -->
			
			<!-- inicio edit modal -->
			<?php 
				if (isset($user)) { ?>
					<script>$(document).ready(function() {$('#edit').modal('show');});</script>
					<div id="edit" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mod_contato">
						<div class="modal-dialog modal-md" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h5 class="modal-title text-center" id="mod_contato">Editar conta</h5>
								</div>
								<div class="modal-body table-responsive">
									<div class="col-md-12">
										<form class="form-horizontal" action="<?php $_SERVER["PHP_SELF"];?>" method="post">
											
											<input type="hidden" name="idU" value="<?=$objFunc->base64($user['idUser'], 1); ?>">
											
											<div class="form-group">
												<label for="inputName" class="col-sm-3 control-label">Nome</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="inputName" placeholder="Nome" 
														name="name" value="<?=$user['name']; ?>" required >
												</div>
											</div>
											
											<div class="form-group">
												<label for="inputLogin" class="col-sm-3 control-label">Login</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="inputLogin" placeholder="Login" 
														name="login" value="<?=$user['login'];?>" required 
														<?=($_SESSION['idUser'] == $user['idUser']) ? "" : "disabled";?>>
												</div>
											</div>
											
											<div class="form-group"  >
												<label for="inputDtCa" class="col-sm-3 control-label">Data Cadastro</label>
												<div class="col-sm-9">
													<input type="text" disabled class="form-control" id="inputDtCa" placeholder="Imagem" 
														name="dateCa" value="<?=$objFunc->fDate($user['dateCa']);?>" required >
												</div>
											</div>
											<div class="form-group"  >
												<label for="inputDtUp" class="col-sm-3 control-label">Atualizado em</label>
												<div class="col-sm-9">
													<input type="text" disabled class="form-control" id="inputDtUp" placeholder="Imagem" 
														name="dateUp" value="<?=$objFunc->fDate($user['dateUp']);?>" required >
												</div>
											</div>
											
											<div class="form-group">
												<label for="inputStatus" class="col-sm-3 control-label">Status</label>
												<div class="col-sm-9">
													<input type="text" disabled class="form-control" id="inputStatus" placeholder="Status" 
														name="activation" value="<?=($user['activation'] == 1) ? "Ativado" : "Desativado";?>" required >
												</div>
											</div>
											
											<div class="form-group">
												<div class="col-sm-6">
													<button type="submit" class="btn btn-primary btn-block" name="btnSaveEdition" value="">Salvar</button>
												</div>
												<div class="col-sm-6">
													<a class="btn btn-default btn-block" href="admins.php" role="button">Cancelar</a>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div> 
			<?php 
				} ?>
			<!-- fim edit modal -->
			
			<!-- inicio delete modal -->
			<?php 
				if (isset($delet)) { ?>
					<script>$(document).ready(function() {$('#delet').modal('show');});</script>
					<div id="delet" class="modal fade delet" tabindex="-1" role="dialog" aria-labelledby="mod_contato">
						<div class="modal-dialog modal-md" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h5 class="modal-title text-center" id="mod_contato">Excluir conta do admin</h5>
								</div>
								<div class="modal-body table-responsive">
									<div class="col-md-12">
										<form class="form-horizontal text-center" action="<?php $_SERVER["PHP_SELF"];?>" method="post">
											<p class="alert alert-warning" role="alert">Deseja <u>excluir</u> a conta de "<i><?=$delet['name'];?></i>"?</p>
											<p class="alert alert-info" role="alert">Se confirmar, todos os dados serão apagados do banco.
												<br>Recomenda-se que apenas <u>desative</u> a conta.</p>
											
											<div class="form-group">
												<input type="hidden" name="idU" value="<?=$objFunc->base64($delet['idUser'], 1); ?>" >
												<div class="col-sm-12">
													<select name="delet" class="form-control" id="inputStatus" autofocus>
														<option value="0" selected >Desativar</option>
														<option value="1" >Excluir</option>
													</select>
												</div>
											</div>
											
											<div class="form-group">
												<div class="col-sm-6">
													<button type="submit" class="btn btn-primary btn-block" name="btnDelete" value="">Apagar</button>
												</div>
												<div class="col-sm-6">
													<a class="btn btn-default btn-block" href="admins.php" role="button">Cancelar</a>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div> 
			<?php 
				} ?>
			<!-- fim delete modal -->
			
		</section>
		<!-- fim modais section -->
		
<?php 
	include(FOOTER_TEMPLATE_ADM); 
?>