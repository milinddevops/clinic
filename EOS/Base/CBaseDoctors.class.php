<?php

require_once( EOS_PATH . 'CDoctor.class.php' );

class CBaseDoctors {
	
	public static function fetchDoctors( $strSql, $resDataBase ) {
					
		$resQuery = mysql_query( $strSql, $resDataBase );
		
		while ( $resData = mysql_fetch_assoc( $resQuery )) {
			if( $resData ) {
				$objDoctor = new CDoctor();
			
				$objDoctor->setValues( $resData );		
				
				$arrobjDoctors[] = $objDoctor;				
			}
		}
		
		return $arrobjDoctors;
	}	
	
	public static function fetchDoctor( $strSql, $resDataBase ) {		
		$resQuery = mysql_query( $strSql, $resDataBase );
		
		$resData = mysql_fetch_assoc( $resQuery );
		
		if( $resData ) {
			$objDoctor = new CDoctor();
		
			$objDoctor->setValues( $resData );
		}else {
			$objDoctor = NULL;
		}
				
		return $objDoctor;
	}
}

?>