<?php

require_once( EOS_PATH . 'CPatient.class.php' );

class CBasePatients {
	
	public static function fetchPatients( $strSql, $resDataBase ) {
		//$strSql = 'SELECT * FROM patients';
				
		$resQuery = mysql_query( $strSql, $resDataBase );
		
		while ( $resData = mysql_fetch_assoc( $resQuery )) {
			if( $resData ) {
				$objPatient = new CPatient();
			
				$objPatient->setValues( $resData );		
				
				$arrobjPatients[] = $objPatient;				
			}
		}
		
		return $arrobjPatients;
		
	}	
	
	public static function fetchPatient( $strSql, $resDataBase ) {		
		$resQuery = mysql_query( $strSql, $resDataBase );
		
		$resData = mysql_fetch_assoc( $resQuery );
		
		if( $resData ) {
			$objPatient = new CPatient();
		
			$objPatient->setValues( $resData );
		}else {
			$objPatient = NULL;
		}
				
		return $objPatient;
	}
	
}

?>