<?php

require_once( EOS_PATH . 'CExpence.class.php' );

class CBaseExpences {
	
	public function fetchExpences( $strSql, $resDataBase ) {		
		$resQuery = mysql_query( $strSql, $resDataBase );
		
		while ( $resData = mysql_fetch_assoc( $resQuery )) {
			if( $resData ) {
				$objExpence = new CExpence();
			
				$objExpence->setValues( $resData );		
				
				$arrobjExpences[] = $objExpence;				
			}
		}
		
		return $arrobjExpences;
	}	
	
	public static function fetchExpence( $strSql, $resDataBase ) {		
		$resQuery = mysql_query( $strSql, $resDataBase );
		
		$resData = mysql_fetch_assoc( $resQuery );
		
		if( $resData ) {
			$objExpence = new CExpence();
		
			$objExpence->setValues( $resData );
		}else {
			$objExpence = NULL;
		}
				
		return $objExpence;
	}
}

?>