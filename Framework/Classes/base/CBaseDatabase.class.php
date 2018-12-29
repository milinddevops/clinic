<?php

class CBaseDatabase {
			
	function __construct() {
								
				
	}
	
	public static function loadPortalDb() {
		require_once( '../../defines.php' );

		$m_lnk_Portal = mysql_connect( DB_HOST, DB_USER, DB_PASSWORD );
		
		mysql_select_db( DB_NAME, $m_lnk_Portal );
		
		return $m_lnk_Portal;
	}		
}
?>