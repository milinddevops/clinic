<?php

require_once( EOS_PATH . 'CPatientPayment.class.php' );

class CBasePatientPayments {
	
	public function fetchPatientPayments( $strSql, $resDataBase ) {		
		$resQuery = mysql_query( $strSql, $resDataBase );
		
		while ( $resData = mysql_fetch_assoc( $resQuery )) {
			if( $resData ) {
				$objPatientPayment = new CPatientPayment();
			
				$objPatientPayment->setValues( $resData );		
				
				$arrobjPatientPaymwents[] = $objPatientPayment;				
			}
		}
				
		return $arrobjPatientPaymwents;
	}	
	
	public static function fetchPatientPayment( $strSql, $resDataBase ) {		
		$resQuery = mysql_query( $strSql, $resDataBase );
		
		$resData = mysql_fetch_assoc( $resQuery );
		
		if( $resData ) {
			$objPatientPayment = new CPatientPayment();
		
			$objPatientPayment->setValues( $resData );
		}else {
			$objPatientPayment = NULL;
		}
				
		return $objPatientPayment;
	}
}

?>