<?php

require_once( EOS_PATH . 'CReminder.class.php' );

class CBaseReminders {
	
	public function fetchReminders( $strSql, $resDataBase ) {		
		$resQuery = mysql_query( $strSql, $resDataBase );
		
		while ( $resData = mysql_fetch_assoc( $resQuery )) {
			if( $resData ) {
				$objReminder = new CReminder();
			
				$objReminder->setValues( $resData );		
				
				$arrobjReminders[] = $objReminder;				
			}
		}
		
		return $arrobjReminders;
	}	
	
	public static function fetchReminder( $strSql, $resDataBase ) {		
		$resQuery = mysql_query( $strSql, $resDataBase );
		
		$resData = mysql_fetch_assoc( $resQuery );
		
		if( $resData ) {
			$objReminder = new CReminder();
		
			$objReminder->setValues( $resData );
		}else {
			$objReminder = NULL;
		}
				
		return $objReminder;
	}
}

?>