<?php
require_once( 'Smarty.class.php' );
require_once( '../../defines.php' );

class CSmarty extends Smarty {
	
	function __construct( $strTemplatePath ) {
		$this->template_dir = $strTemplatePath;
		$this->compile_dir 	= INTERFACES . 'templates_c';

		$this->compile_check = true;
		//$this->debugging = true;
	}
}

?>