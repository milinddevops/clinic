<?php

require_once( EOS_PATH . 'CUserPermission.class.php' );

class CBaseUserPermissions {
	
	public function fetchUserPermission( $strSql, $resDataBase ) {		
		$resQuery = mysql_query( $strSql, $resDataBase );
		return mysql_fetch_object( $resQuery );
	}	
	
	public static function fetchUserPermissions( $strSql, $resDataBase ) {		
		$resQuery = mysql_query( $strSql, $resDataBase );
		
		while ( $resData = mysql_fetch_assoc( $resQuery )) {
			if( $resData ) {
				$objUserPermission = new CUserPermission();
			
				$objUserPermission->setValues( $resData );		
				
				$arrobjUsersPermissions[] = $objUserPermission;				
			}
		}
		
		return $arrobjUsersPermissions;
	}
}

?>