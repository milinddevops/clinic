<?php
require_once( EOS_PATH . 'CPathologyTest.class.php' );

class CBasePathologyTests {
	
	public static function fetchAllPathologyTests( $resDataBase ) {
		$strSql = 'SELECT * FROM pathology_tests ORDER BY name LIMIT 20';		
		$resQuery = mysql_query( $strSql, $resDataBase );
		
		while ( $resData = mysql_fetch_assoc( $resQuery )) {
			if( $resData ) {
				$objPathologyTest = new CPathologyTest();
			
				$objPathologyTest->setValues( $resData );		
				
				$arrobjPathologyTests[] = $objPathologyTest;				
			}
		}
		
		return $arrobjPathologyTests;
	}	
	
	public static function fetchPathologyTests( $strSql, $resDataBase ) {

		$resQuery = mysql_query( $strSql, $resDataBase );
		
		while ( $resData = mysql_fetch_assoc( $resQuery )) {
			if( $resData ) {
				$objPathologyTest = new CPathologyTest();
			
				$objPathologyTest->setValues( $resData );		
				
				$arrobjPathologyTests[] = $objPathologyTest;				
			}
		}
		
		return $arrobjPathologyTests;
	}
	
	public static function fetchPathologyTest( $strSql, $resDataBase ) {		
		$resQuery = mysql_query( $strSql, $resDataBase );
		
		$resData = mysql_fetch_assoc( $resQuery );
		
		if( $resData ) {
			$objPathologyTest = new CPathologyTest();
		
			$objPathologyTest->setValues( $resData );
		}else {
			$objPathologyTest = NULL;
		}
				
		return $objPathologyTest;
	}
}

?>