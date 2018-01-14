<?php

	define('B', DIRECTORY_SEPARATOR);
	
	/** caminho absoluto para a pasta do sistema **/ 
	define('ABSPATH', dirname(__FILE__) . B); 

	
	/** caminho no server para o sistema **/ 
	define('BASEURL', ''); 
	
	/** caminho para pasta boot (css/images/js/etc) **/ 
	define('PATH_BOOT',         BASEURL . 'assets' . B . 'boot' . B);
	/** caminho para pasta library (biblioteca) **/ 
	define('PATH_LIB',          BASEURL . 'assets' . B . 'lib' . B); 
	/** caminho para pasta includes **/ 
	define('PATH_INC',          BASEURL . 'assets' . B . 'inc' . B); 
	/** caminho para pasta includes adm **/ 
	define('PATH_INC_ADM',      PATH_INC . 'adm' . B); 
	
	/** caminho do arquivo Connection.class **/ 
	define('CONN_API',          PATH_LIB . 'Connection.class.php'); 
	/** caminho do arquivo Functions.class **/ 
	define('FUNC_API',          PATH_LIB . 'Functions.class.php'); 
	/** caminho do arquivo FunctionsEmail.class **/ 
	define('EMAIL_API',         PATH_LIB . 'FunctionEmail.class.php'); 
	/** caminho do arquivo User.class **/ 
	define('USER_API',          PATH_LIB . 'User.class.php'); 
	/** caminho do arquivo class.Upload **/ 
	define('UPLOAD_API',        PATH_LIB . 'Upload.class.php'); 

	/** caminhos dos templates de header, menu, footer, social, mapa, contato, artigoN **/ 
	define('HEADER_TEMPLATE',       PATH_INC . 'header.php'); 
	define('FOOTER_TEMPLATE',       PATH_INC . 'footer.php');
	define('SOCIAL_TEMPLATE',       PATH_INC . 'social.php'); 
	define('CONTAT_TEMPLATE',       PATH_INC . 'contato.php'); 
	
	/** caminhos dos templates_adm header, menu, footer, area, off **/
	define('HEADER_TEMPLATE_ADM',   PATH_INC_ADM . 'header_adm.php');
	define('FOOTER_TEMPLATE_ADM',   PATH_INC_ADM . 'footer_adm.php');

	
	/** Autoload **/
	spl_autoload_register(function($className){
		if (file_exists(PATH_LIB . $className . ".class.php")){
			require_once(PATH_LIB . $className . ".class.php");
		}
	});
?>