<?php

require_once( '../../defines.php' );
require_once( EOS_BASE . 'CBasePathologyTests.class.php' );

class CPathologyTests extends CBasePathologyTests {
		
	public static function fetchPathologyTestById( $intUserId, $resDataBase ) {
		$strSql = 'SELECT * FROM pathology_tests WHERE id = ' . (int) $intUserId;
		
		return parent::fetchPathologyTest( $strSql, $resDataBase );
	}
	
	public static function fetchPahologyTestsWithRateByCustomerId( $intCustomerId, $resDataBase ) {
		$strSql = ' SELECT pt.* 
					FROM 
					`customer_pathology_tests` cpt, `pathology_tests` pt
					WHERE 
					cpt.pathologytest_id = pt.id
					 AND pt.test_type IN(1, 2, 3)					 
					AND cpt.customer_id = ' . (int) $intCustomerId;

		return parent::fetchPathologyTests( $strSql, $resDataBase );
		
	}
	
	public static function fetchPathologyTestsByIds( $arrintPathologyTestsIds, $resDataBase ) {
		$strSql = 'SELECT * FROM pathology_tests WHERE id IN ( ' . implode( ',', $arrintPathologyTestsIds ) . ')';
		
		return parent::fetchPathologyTests($strSql, $resDataBase);
	}
	
	public static function fetchTestsByText( $strText, $resDatabase ) {
		$strSql = 'SELECT * FROM pathology_tests WHERE name LIKE \'' . $strText . '%\'';
		
		return parent::fetchPathologyTests( $strSql, $resDatabase );
	}
	
	public static function fetchTestsByTypeId( $intTestTypeId, $resDatabase ) {
		$strSql = 'SELECT * FROM pathology_tests WHERE test_type = ' . (int) $intTestTypeId;
		
		return parent::fetchPathologyTests( $strSql, $resDatabase );
	}
	
	public static function fetchPathologyTestByIdTypeId( $intTestId, $intTypeId, $resDataBase ) {
		$strSql = 'SELECT * FROM pathology_tests WHERE id = ' . (int) $intTestId;
				
		return parent::fetchPathologyTest( $strSql, $resDataBase );
	}
	
	/*public static function fetchUser( $strSql, $resDataBase ) {		
		$resQuery = mysql_query( $strSql, $resDataBase );	
		$arrUser = mysql_fetch_assoc($resQuery);			
		
		return $arrUser;
	}*/
}

?>