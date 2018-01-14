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
	
	// if(isset($_POST['btnRegister'])) {
		// if ($_POST['pass1'] == $_POST['pass2'] && (!$objUser->qSelectLogins($_POST['login'], 1))) {
			// if($objUser->qInsert($_POST)) {
				// header('location: ' . BASEURL . 'admin/view/promos.php');
			// }else{
				// echo '<script type="text/javascript">alert("Erro ao cadastrar!");</script>';
			// }
		// } else {
			// $loginExtt = true;
			// $senhaInv = true;
		// }
	// }
	
	include(HEADER_TEMPLATE_ADM); 
?>
		
		<!-- inicio admins section -->
		<section id="promos" class="section">
			<div class="container">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<form class="form-horizontal" action="<?php $_SERVER["PHP_SELF"];?>" method="post">
							<fieldset class="text-center">
								<legend>Nova promoção</legend>
							</fieldset>
							<div class="form-group">
								<label for="inputName" class="col-sm-2 control-label">Nome</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="inputName" placeholder="Nome" 
										name="name" value="" required autofocus >
								</div>
							</div>
							<div class="form-group">
								<label for="inputPass" class="col-sm-2 control-label">Imagem</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="inputPass" placeholder="Imagem" 
										name="image" required >
								</div>
							</div>
							<textarea name="description" id="editor1" class="form-control" rows="3" placeholder="Descrição"></textarea>
							<script> CKEDITOR.replace( 'editor1' );</script>
							
							<div class="form-group"></div>
							<div class="form-group">
								<div class="col-sm-6">
									<button type="submit" class="btn btn-primary btn-block" name="btnRegister" value="">Cadastrar</button>
								</div>
								<div class="col-sm-6">
									<button type="reset" class="btn btn-default btn-block" name="" value="">Limpar</button>
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-2"></div>
				</div>
			</div>
		</section>
		<!-- fim admins section -->
		
<?php 
	include(FOOTER_TEMPLATE_ADM); 
?>