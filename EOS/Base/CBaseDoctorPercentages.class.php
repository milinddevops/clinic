<?php

require_once( EOS_PATH . 'CDoctorPercentage.class.php' );

class CBaseDoctorPercentages {
	
	public function fetchDoctorPercentages( $strSql, $resDataBase ) {		
		$resQuery = mysql_query( $strSql, $resDataBase );
		
		while ( $resData = mysql_fetch_assoc( $resQuery )) {
			if( $resData ) {
				$objDoctorPercentage = new CDoctorPercentage();
			
				$objDoctorPercentage->setValues( $resData );		
				
				$arrobjDoctorPercentages[] = $objDoctorPercentage;				
			}
		}
				
		return $arrobjDoctorPercentages;
	}	
	
	public static function fetchDoctorPercentage( $strSql, $resDataBase ) {		
		$resQuery = mysql_query( $strSql, $resDataBase );
		
		$resData = mysql_fetch_assoc( $resQuery );
		
		if( $resData ) {
			$objDoctorPercentage = new CDoctorPercentage();
		
			$objDoctorPercentage->setValues( $resData );
		}else {
			$objDoctorPercentage = NULL;
		}
				
		return $objDoctorPercentage;
	}
}

?>