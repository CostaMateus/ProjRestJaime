
		<!-- inicio copyright section -->
		<footer id="copyright" class="section" ><!--style="color:#FFF!important;background-color:#C83539!important;"-->
			<div class="container text-center" ><!--style="width:100%;background-color: rgba(51, 51, 51, 0.08)!important;"-->
				<h6>
					&copy; Copyright 2017 - Estavão Restaurante e Lanchonete 
					<br><br>
					Desenvolvido por: 
					<a style="text-decoration:none;" href="https://www.linkedin.com/in/costamateus/" target="_blank" >
						<u>Mateus Lopes Costa</u>
					</a>
				</h6>
			</div>
		</footer>
		<!-- fim copyright section -->
		
		<!-- Scripts -->
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script>
			$(function() {
				url = document.location.pathname.substr(document.location.pathname.lastIndexOf("/") + 1); // obter nome da página atual ex: teste.html
				el = document.querySelector("[href*='/" + url + "']"); // procura o link que contenha a url
				li = el.parentElement.classList.add("active"); // adicionado a classe no li
			});
		</script>

		<script src="<?=PATH_BOOT?>js/lightbox-plus-jquery.min.js"></script>
	</body>
</html>