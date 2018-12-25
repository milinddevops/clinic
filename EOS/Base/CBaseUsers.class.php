<?php

require_once( EOS_PATH . 'CUser.class.php' );

class CBaseUsers {
	
	public function fetchUsers( $strSql, $resDataBase ) {		
		$resQuery = mysql_query( $strSql, $resDataBase );
		
		while ( $resData = mysql_fetch_assoc( $resQuery )) {
			if( $resData ) {
				$objUser = new CUser();
			
				$objUser->setValues( $resData );		
				
				$arrobjUsers[] = $objUser;				
			}
		}
		
		return $arrobjUsers;
	}	
	
	public static function fetchUser( $strSql, $resDataBase ) {		
		$resQuery = mysql_query( $strSql, $resDataBase );
		
		$resData = mysql_fetch_assoc( $resQuery );
		
		if( $resData ) {
			$objUser = new CUser();
		
			$objUser->setValues( $resData );
		}else {
			$objUser = NULL;
		}
				
		return $objUser;
	}
}

?>