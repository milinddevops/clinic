<?php

require_once( '../../defines.php' );
require_once( EOS_BASE . 'CBaseCustomerPathologyTests.class.php' );

class CCustomerPathologyTests extends CBaseCustomerPathologyTests {
		
	public static function fetchCustomerPathologyTestById( $intId, $resDataBase ) {
		$strSql = 'SELECT * FROM customer_pathology_tests WHERE id = ' . (int) $intId;
		
		return parent::fetchCustomerPathologyTest( $strSql, $resDataBase );
	}
	
	public static function fetchCustomerPathologyTestsByStartAndEndDate( $strStartDate, $strEndDate, $resDataBase ) {
		$strSql = 'SELECT * FROM customer_pathology_tests WHERE created_on BETWEEN "' . $strStartDate . '" AND "' . $strEndDate . '"';
		
		return parent::fetchCustomerPathologyTests( $strSql, $resDataBase );
	}
	
	public static function fetchPahologyTestsByCustomerId( $intCustomerId, $resDataBase ) {
		$strSql = 'SELECT * FROM customer_pathology_tests WHERE customer_id = ' . (int) $intCustomerId;
		
		return parent::fetchCustomerPathologyTests( $strSql, $resDataBase );
	}
	
	public static function fetchCustomerCountsByDateRangeByTestTypeId( $strFromDate, $strToDate, $intTestTypeId, $resDataBase ) {
		$strSql = ' SELECT count( DISTINCT p.id ) as \'customers\'
					FROM customer_pathology_tests cpt
					JOIN patients p
					WHERE p.id = cpt.customer_id
					AND pathologytest_id
					IN (					
						SELECT id
						FROM pathology_tests
						WHERE test_type = ' . (int)$intTestTypeId . '
					   )
					AND created_on
					BETWEEN \'' . $strFromDate . '\'
					AND \'' . $strToDate . '\'';

		return parent::fetchData( $strSql, $resDataBase );
	}
	
	public static function fetchCustomerCountsByDateRangeGroupByDoctor( $strFromDate, $strToDate, $resDataBase ) {
		$strSql = ' SELECT doctor_id, count( DISTINCT p.id ) as \'customers\'
					FROM customer_pathology_tests cpt
					JOIN patients p
					WHERE p.id = cpt.customer_id
					AND created_on
					BETWEEN \'' . $strFromDate . '\'
					AND \'' . $strToDate . '\'
					GROUP BY doctor_id';

		return parent::fetchData( $strSql, $resDataBase );

		/*$strSql = ' SELECT doctor_id, count( DISTINCT id ) as \'patients\'
					FROM `patients`
					WHERE recieved_on
					BETWEEN \'' . $strFromDate . '\'
					AND \'' . $strToDate . '\'
					GROUP BY doctor_id';
		
		$arrstrData = parent::fetchData( $strSql, $resDataBase );
		
		if( true == is_array( $arrstrData ) ) {
			$arrstrDoctorsData = array();
			
			foreach ( $arrstrData as $key => $data ) {				
				$arrstrDoctorsData[$data['doctor_id']] = $data['patients'];								
			}
			
			return $arrstrDoctorsData;
		} else {
			return NULL;
		}*/
	}
	
	public static function fetchCustomerCountsByRecentQuaterGroupByDoctor( $strFirstDate, $strLastDate, $resDataBase ) {
		$strSql = ' SELECT datepart(recieved_on, \'month\'), count( DISTINCT id ) as \'patients\'
					FROM `patients`
					WHERE recieved_on
					BETWEEN \'' . $strFirstDate . '\'
					AND \'' . $strLastDate . '\'
					GROUP BY datepart(recieved_on, \'month\')';
		
		display($strSql);
	}
	
}

?>