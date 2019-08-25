<?php

class CBaseDatabase {
			
	function __construct() {
								
				
	}
	
	public static function loadPortalDb() {
		require_once( '../../defines.php' );

		$m_lnk_Portal = mysql_connect( getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASSWORD') );
		
		mysql_select_db( DB_NAME, $m_lnk_Portal );
		
		return $m_lnk_Portal;
	}		
}

?>
