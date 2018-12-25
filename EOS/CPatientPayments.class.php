<?php

require_once( '../../defines.php' );
require_once( EOS_BASE . 'CBasePatientPayments.class.php' );

class CPatientPayments extends CBasePatientPayments {

	public static function fetchPatientPaymentById( $intId, $resDataBase ) {
		$strSql = 'SELECT * FROM patient_payments WHERE id = ' . (int) $intId;
		
		return parent::fetchPatientPayment( $strSql, $resDataBase );
	}
	
	public static function fetchPatientPaymentsByPatientId( $intPatientId, $resDataBase ) {
		$strSql = 'SELECT * FROM patient_payments WHERE patient_id = ' . (int) $intPatientId;
		
		return parent::fetchPatientPayments( $strSql, $resDataBase );
	}
	
	public static function fetchTotalCurrentDayPatientPaymentsByCreatedOn( $strCreatedOn, $resDataBase ) {
		$strSql = 'SELECT SUM(amount) as amt FROM patient_payments WHERE is_previous_balance = 0 AND created_on = "' . $strCreatedOn . '"';
		
		return fetchData( $strSql, $resDataBase );
	}
	
	public static function fetchTotalPreviousDayPatientPaymentsByCreatedOn( $strCreatedOn, $resDataBase ) {
		$strSql = 'SELECT SUM(amount) as amt FROM patient_payments WHERE is_previous_balance = 1 AND created_on = "' . $strCreatedOn . '"';
		
		return fetchData( $strSql, $resDataBase );
	}
}

?>