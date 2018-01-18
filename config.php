<?php
	
	/** Soh pra encurtar a constante 			 **/
	define('DS', DIRECTORY_SEPARATOR);
	
	/** caminho absoluto para a pasta do sistema **/ 
	define('ABSPATH', dirname(__FILE__) . DS); 

	/** caminho no server para o sistema 		 **/ 
	define('BASEURL', ''); 
	
	
	/**********************************************************************************/
	/** 																			 **/
	/** NOVO: PATH_BOOT - subtitui o cod no html, ex:"<?php echo BASEURL; ?>assets/" **/
	/** 	  PATH_LIB, PATH_INC, PATH_INC_ADM - uso interno apenas                  **/
	/** 																			 **/
	/**********************************************************************************/
	/** caminho para pasta boot (css/images/js/etc) 								 **/ 
	define('PATH_BOOT',         BASEURL . 'assets' . DS . 'boot' . DS);
	/** caminho para pasta library (biblioteca) 									 **/ 
	define('PATH_LIB',          BASEURL . 'assets' . DS . 'lib' . DS); 
	/** caminho para pasta includes 												 **/ 
	define('PATH_INC',          BASEURL . 'assets' . DS . 'inc' . DS); 
	/** caminho para pasta includes adm 											 **/ 
	define('PATH_INC_ADM',      PATH_INC . 'adm' . DS); 
	
	
	/******************************************************/
	/** 												 **/
	/** Constantes de classes não usadas mais.           **/
	/** Substituidas pela função spl_autoload_register() **/
	/** Retirar redundâncias no php/html. 				 **/
	/** 												 **/
	/******************************************************/
	/** caminho do arquivo Connection.class 			 **/ 
	define('CONN_API',          PATH_LIB . 'Connection.class.php'); 
	/** caminho do arquivo Functions.class 				 **/ 
	define('FUNC_API',          PATH_LIB . 'Functions.class.php'); 
	/** caminho do arquivo FunctionsEmail.class 		 **/ 
	define('EMAIL_API',         PATH_LIB . 'FunctionEmail.class.php'); 
	/** caminho do arquivo User.class 					 **/ 
	define('USER_API',          PATH_LIB . 'User.class.php'); 
	/** caminho do arquivo class.Upload 				 **/ 
	define('UPLOAD_API',        PATH_LIB . 'Upload.class.php'); 

	
	/** caminhos dos templates de header, menu, footer, social, mapa, contato, artigoN **/ 
	define('HEADER_TEMPLATE',       PATH_INC . 'header.php'); 
	define('FOOTER_TEMPLATE',       PATH_INC . 'footer.php');
	define('SOCIAL_TEMPLATE',       PATH_INC . 'social.php'); 
	define('CONTAT_TEMPLATE',       PATH_INC . 'contato.php'); 
	
	/** caminhos dos templates_adm header, menu, footer, area, off **/
	define('HEADER_TEMPLATE_ADM',   PATH_INC_ADM . 'header_adm.php');
	define('FOOTER_TEMPLATE_ADM',   PATH_INC_ADM . 'footer_adm.php');

	
	/*****************************************************/
	/** 												**/
	/** NOVO: spl_autoload_register()                   **/ 
	/**       subtitui tds includes de CLASSES nas pags **/
	/** 												**/
	/*****************************************************/
	/** Autoload 										**/
	spl_autoload_register(function($className){
		if (file_exists(PATH_LIB . $className . ".class.php")){
			require_once(PATH_LIB . $className . ".class.php");
			// echo PATH_LIB . $className . ".class.php <br>";
		}
	});
?>