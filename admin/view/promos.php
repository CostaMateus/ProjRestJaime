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
	
	// if(isset($_POST['btnCadastrar'])) {
		// if($objUser->qInsert($_POST)) {
			// header('location: ' . BASEURL . 'admin/view/admins.php');
		// }else{
			// echo '<script type="text/javascript">alert("Erro em cadastrar");</script>';
		// }
	// }
	// if(isset($_POST['btnAlterar'])) {
		// if($objUser->qUpdate($_POST)) {
			// header('location: ?acao=edit&idU=' . $_POST['idUser']);
		// }else{
			// echo '<script type="text/javascript">alert("Erro em alterar");</script>';
		// }
	// }
	

	if(isset($_POST['btnSaveStatus'])) {
		if($objFunc->qUpdatePromoStatus($_POST)) {
			header('location: promos.php');
		}else{
			echo '<script type="text/javascript">alert("Erro ao salvar modificação!");</script>';
		}
	}

	if(isset($_GET['action'])) {
		switch($_GET['action']) {
			case 'status': 
				$status = $objFunc->qSelectPromo($_GET['id']); 
				break;
			case 'edit': 
				$promo = $objFunc->qSelectPromo($_GET['id']); 
				break;
			case 'delet':
				if($objUser->qDelete($_GET['idU'])) {
					header('location: ' . BASEURL . 'admin/view');
				} else {
					echo '<script type="text/javascript">alert("Erro ao excluir dado!");</script>';
				}
				break;
		}
	}
	
	include(HEADER_TEMPLATE_ADM); 
?>
		
		<!-- inicio lista promos section -->
		<section id="promos" class="section">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Nome</th>
									<th>Descrição</th>
									<th>Preço</th>
									<th>Imagem</th>
									<th>Status</th>
									<th>Editar</th>
									<th>Excluir</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$i = 1;
									foreach($objFunc->qSelectAllPromos() as $result) { ?>
										<tr>
											<th scope="row"><?=$i;?></th>
											<td><?=($result['name']); ?></td>
											<td><?=($result['description']); ?></td>
											<td><?=$result['price']; ?></td>
											<td><?=$result['image']; ?></td>
											<td>
												<a href="?action=status&id=<?=$objFunc->base64($result['id'], 1); ?>" title="Status">
													<img class="img-responsive" src="<?=BASEURL; ?>assets/imgs/ctrl/<?=($result['activation'] == 1 ? "on" : "off");?>.png" alt="Status">
												</a>
											</td>
											<td>
												<a href="?action=edit&id=<?=$objFunc->base64($result['id'], 1); ?>" title="Editar">
													<img class="img-responsive" src="<?=BASEURL; ?>assets/imgs/ctrl/editar.png" alt="Editar">
												</a>
											</td>
											<td>
												<a href="?action=delet&id=<?=$objFunc->base64($result['id'], 1); ?>" title="Excluir">
													<img class="img-responsive" src="<?=BASEURL; ?>assets/imgs/ctrl/excluir.png" alt="Excluir">
												</a>
											</td>
										</tr>
								<?php 
										$i++;
									}?>
							</tbody>
						</table>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</section>
		<!-- fim lista promos section -->
		
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
									<h5 class="modal-title text-center" id="mod_contato">Alterar status da promoção</h5>
								</div>
								<div class="modal-body table-responsive">
									<div class="col-md-12">
										<form class="form-horizontal" action="<?php $_SERVER["PHP_SELF"];?>" method="post">
											<?php 
												if ($status['activation'] == 1 ? $st = "ativada" : $st = "desativada");
												if ($status['activation'] == 1 ? $st_c = "desativar" : $st_c = "ativar"); 
											?>
											<p>A promoção "<i><?=($status['name']);?></i>" está atualmente <code><?=$st;?></code>.</p>
											<p>Deseja <u><?=$st_c;?></u>?</p>
											<div class="form-group">
												<input type="hidden" name="id" value="<?=$objFunc->base64($status['id'], 1); ?>" >
												<div class="col-sm-12">
													<select name="status" class="form-control" id="inputStatus" autofocus>
														<option value="1" <?=($status['activation'] == 0) ? "selected" : "";?>>Ativar</option>
														<option value="0" <?=($status['activation'] == 1) ? "selected" : "";?>>Desativar</option>
													</select>
												</div>
											</div>
											
											<div class="form-group">
												<div class="col-sm-6">
													<button type="submit" class="btn btn-primary btn-block" name="btnSaveStatus" value="">Salvar</button>
												</div>
												<div class="col-sm-6">
													<a class="btn btn-default btn-block" href="promos.php" role="button">Cancelar</a>
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
				if (isset($promo)) { ?>
					<script>$(document).ready(function() {$('#edit').modal('show');});</script>
					<div id="edit" class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="mod_contato">
						<div class="modal-dialog modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h5 class="modal-title text-center" id="mod_contato">Editar promoção</h5>
								</div>
								<div class="modal-body table-responsive">
									<div class="col-md-12">
										<form class="form-horizontal" action="<?php $_SERVER["PHP_SELF"];?>" method="post">
											<div class="form-group">
												<label for="inputName" class="col-sm-2 control-label">Nome</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="inputName" placeholder="Nome" 
														name="name" value="<?=($promo['name']); ?>" required >
												</div>
											</div>
											<div class="form-group" >
												<label for="inputDescription" class="col-sm-2 control-label">Descrição</label>
												<div class="col-sm-10">
													<textarea class="form-control inputDesc" type="text" id="inputDescription" rows="3" placeholder="Descrição"
														name="description" value="" ><?=($promo['description']); ?></textarea>
													<span class="help-block">Insira <code>&lt;br&gt;</code> para quebrar linhas da descrição.</span>
												</div>
											</div>
											<div class="form-group">
												<label for="inputPrice" class="col-sm-2 control-label">Preço</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="inputPrice" placeholder="Preço" 
														name="price" value="<?=($promo['price']); ?>" required >
												</div>
											</div>
											<div class="form-group">
												<label for="inputImg" class="col-sm-2 control-label">Imagem</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="inputImg" placeholder="Imagem" 
														name="image" value="<?=($promo['image']); ?>" required >
												</div>
											</div>
											<!--<div class="form-group">
												<label for="inputStatus" class="col-sm-2 control-label">Status</label>
												<div class="col-sm-10">
													<input type="text" class="form-control" id="inputStatus" placeholder="Status" 
														name="activation" value="<?//=$promo['activation']; ?>" required >
												</div>
											</div>-->
											
											<div class="form-group">
												<div class="col-sm-6">
													<button type="submit" class="btn btn-primary btn-block" name="btnSaveEdition" value="">Salvar</button>
												</div>
												<div class="col-sm-6">
													<a class="btn btn-default btn-block" href="promos.php" role="button">Cancelar</a>
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
		</section>
		<!-- fim modais section -->
		
<?php 
	include(FOOTER_TEMPLATE_ADM); 
?>