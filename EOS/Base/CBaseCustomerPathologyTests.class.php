<?php

require_once( EOS_PATH . 'CCustomerPathologyTest.class.php' );

class CBaseCustomerPathologyTests {
	
	public static function fetchCustomerPathologyTests( $strSql, $resDataBase ) {
						
		$resQuery = mysql_query( $strSql, $resDataBase );
		
		while ( $resData = mysql_fetch_assoc( $resQuery )) {
			if( $resData ) {
				$objCustomerPathologyTest = new CCustomerPathologyTest();
			
				$objCustomerPathologyTest->setValues( $resData );		
				
				$arrobjCustomerPathologyTests[] = $objCustomerPathologyTest;				
			}
		}
		
		return $arrobjCustomerPathologyTests;
	}	
	
	public static function fetchCustomerPathologyTest( $strSql, $resDataBase ) {		
		$resQuery = mysql_query( $strSql, $resDataBase );
		
		$resData = mysql_fetch_assoc( $resQuery );
		
		if( $resData ) {
			$objCustomerPathologyTest = new CCustomerPathologyTest();
		
			$objCustomerPathologyTest->setValues( $resData );
		}else {
			$objCustomerPathologyTest = NULL;
		}
				
		return $objCustomerPathologyTest;
	}
	
	public static function fetchData( $strSql, $resDataBase ) {
		
		$resQuery = mysql_query( $strSql, $resDataBase );
		$arrstrMixData = array();
		
		while ( $resData = mysql_fetch_assoc( $resQuery )) {		
			$arrstrMixData[] = $resData;			
		}
			
		return $arrstrMixData;	
				
	}
}

?>