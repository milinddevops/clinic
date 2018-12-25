<?php

require_once( '../../defines.php' );
require_once( EOS_BASE . 'CBaseDoctors.class.php' );

class CDoctors extends CBaseDoctors {
		
	public static function fetchDoctorById( $intUserId, $resDataBase ) {
		$strSql = 'SELECT * FROM doctors WHERE id = ' . (int) $intUserId;
		
		return parent::fetchDoctor( $strSql, $resDataBase );
	}
	
	public static function fetchDoctorsByText( $strText, $resDataBase ) {
		$strSql = 'SELECT * FROM doctors WHERE first_name LIKE \'%' . $strText . '%\' OR last_name LIKE \'%' . $strText . '%\'';

		return parent::fetchDoctors( $strSql, $resDataBase );
	}
	
	public static function fetchDoctors( $resDataBase ) {
		$strSql = 'SELECT * FROM doctors ORDER BY last_name';
		
		return parent::fetchDoctors( $strSql, $resDataBase );
	}
	
	public static function fetchReferingDoctors( $resDataBase ) {
		$strSql = 'SELECT * FROM doctors WHERE is_ref_fee = 1 ORDER BY last_name';
		
		return parent::fetchDoctors( $strSql, $resDataBase );
	}
	
	/*public static function fetchUser( $strSql, $resDataBase ) {		
		$resQuery = mysql_query( $strSql, $resDataBase );	
		$arrUser = mysql_fetch_assoc($resQuery);			
		
		return $arrUser;
	}*/
}

?>