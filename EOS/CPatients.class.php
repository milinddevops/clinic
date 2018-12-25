<?php

require_once( '../../defines.php' );
require_once( EOS_BASE . 'CBasePatients.class.php' );

class CPatients extends CBasePatients {
		
	public static function fetchPatientById( $intUserId, $resDataBase ) {
		$strSql = 'SELECT * FROM patients WHERE id = ' . (int) $intUserId;
		
		return parent::fetchPatient( $strSql, $resDataBase );
	}
	
	public static function fetchPatientsByDoctorIdByStartAnEndDate( $intDoctorId, $strStartDate, $strEndDate, $resDataBase ) {
		require_once( EOS_PATH . 'CPathologyTests.class.php' );								  
		
		$strSql = ' SELECT *
					FROM 
						patients p
					WHERE 
						p.doctor_id = ' . (int) $intDoctorId .'
						AND p.recieved_on BETWEEN "' . $strStartDate . '" AND "' . $strEndDate . '"';

		$arrobjPatients = parent::fetchPatients( $strSql, $resDataBase );

		if( true == is_array( $arrobjPatients ) ) {
			foreach( $arrobjPatients as $objPatient ) {
				$objCustomerPathologyTest = CPathologyTests::fetchPahologyTestsWithRateByCustomerId( $objPatient->getId(), $resDataBase );
				
				$objPatient->m_arrobjPathologyTests = $objCustomerPathologyTest;
			}	
		}		
		
		return $arrobjPatients;
	}
	
	
	public static function fetchAllPatients( $resDataBase ) {
		$strSql = 'SELECT * FROM patients ORDER BY recieved_on DESC';		
		$arrobjPatients = parent::fetchPatients( $strSql, $resDataBase );
		
		/*$resQuery = mysql_query( $strSql, $resDataBase );	
		$arrUser = mysql_fetch_assoc($resQuery);*/			
		
		return $arrobjPatients;
	}
	
	public static function fetchAllCurrentDatePatients( $strDate, $resDataBase ) {
		$strSql = 'SELECT * FROM patients WHERE recieved_on = \'' . $strDate . '\'';

		$arrobjPatients = parent::fetchPatients( $strSql, $resDataBase );
		
		return $arrobjPatients;
	}
	
	public static function fetchCurrentDatePatientsCount( $strDate, $resDatabase ) {
		$strSql = 'SELECT count(*) patients_count FROM patients WHERE recieved_on = \'' . $strDate . '\'';
		
		return fetchData( $strSql, $resDatabase );
	}
	
	public static function fetchLastPatient( $resDataBase ) {
		$strSql = 'SELECT * FROM patients ORDER BY id DESC LIMIT 1';
		$objPatient = parent::fetchPatient( $strSql, $resDataBase );
				
		return $objPatient;
	}
	
	public static function fetchRecentLastPatientByDate( $strDate, $resDataBase ) {
		$strSql = 'SELECT * FROM patients WHERE recieved_on = \'' . $strDate . '\' OR updated_on = \'' . $strDate . '\' ORDER BY id DESC LIMIT 1';	
		
		$objPatient = parent::fetchPatient( $strSql, $resDataBase );
				
		return $objPatient;
	}
	
	public static function fetchPaginatedPatients( $intPageNo, $intPageLimit, $resDatabase ) {
		$strSql = 'SELECT * FROM patients ORDER BY id DESC LIMIT ' . $intPageNo . ', ' . $intPageLimit;
		
		return parent::fetchPatients( $strSql, $resDatabase );
	}
	
	public static function fetchPatientCount( $resDatabase ) {
		$strSql = 'SELECT count(*) as patients_count FROM patients';
		
		return fetchData( $strSql, $resDatabase );
	}
	
	public static function fetchCurrentDatePaginatedPatientsBySearchText( $objSearchFilter, $strDate, $intPageNo, $intPageLimit, $resDatabase ) {
		
		$strDateCriteria = '';
		
		if( false == is_null( $objSearchFilter->getOnDate() ) && 0 < strlen( $objSearchFilter->getOnDate() ) ) {
			$strDateCriteria = 'AND recieved_on = "' . $objSearchFilter->getOnDate() . '"';
			
		} elseif ( false == is_null( $objSearchFilter->getFromDate() ) && false == is_null( $objSearchFilter->getToDate() ) ) {
			$strDateCriteria = ' AND recieved_on BETWEEN "' . $objSearchFilter->getFromDate() . '" AND "' . $objSearchFilter->getToDate() . '"';	
		}
		
		if( false == is_null( $objSearchFilter->getSearchText() ) && 0 < strlen( $objSearchFilter->getSearchText() ) ) {
			$strDateCriteria .= ' AND ( first_name LIKE \'' . $objSearchFilter->getSearchText() . '%\' OR last_name LIKE \'' . $objSearchFilter->getSearchText() . '%\')';
		}
		
		$strSql = 'SELECT * FROM patients WHERE 1=1 ' . $strDateCriteria . ' LIMIT ' . $intPageNo . ', ' . $intPageLimit;

		return parent::fetchPatients( $strSql, $resDatabase );
	}
	
	public static function fetchPatientsByDateRange( $strStartDate, $strEndDate, $resDatabase ) {
		$strSql = 'SELECT * FROM patients WHERE recieved_on BETWEEN \'' . $strStartDate . '\' AND \'' . $strEndDate . '\'';
		
		return parent::fetchPatients( $strSql, $resDatabase );
	}
	
	public static function fetchCurrentDateTotalReceivedPreviousBalanceAmount( $strDate, $resDatabase ) {
		$strSql = ' SELECT SUM( balance_amt ) as total_balance
					FROM patients
					WHERE updated_on = \'' . $strDate . '\'
					AND recieved_on <> \'' . $strDate . '\'
					AND balance_status_type_id = 2';

		return fetchData( $strSql, $resDatabase );
	}
	
	public static function fetchPatientsByIds( $arrintPatnetIds, $resDatabase ) {
		$strSql = 'SELECT * FROM patients WHERE id IN ( ' . implode( ',', $arrintPatnetIds ) . ' )';
		
		return parent::fetchPatients( $strSql, $resDatabase );
	}
	
	public static function fetchMaxPatientSrNoByCurrentDate( $strCurrDate, $resDatabase ) {
		$strSql = 'SELECT MAX(sr_no) as srno FROM patients WHERE recieved_on = "' . $strCurrDate . '"';
		
		return fetchData( $strSql, $resDatabase );
	}
	
}

?>