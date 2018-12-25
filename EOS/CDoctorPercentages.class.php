<?php

require_once( '../../defines.php' );
require_once( EOS_BASE . 'CBaseDoctorPercentages.class.php' );

class CDoctorPercentages extends CBaseDoctorPercentages {

	public static function fetchDoctorPercentageById( $intId, $resDataBase ) {
		$strSql = 'SELECT * FROM doctor_percentage WHERE id = ' . (int) $intId;
		
		return parent::fetchDoctorPercentage( $strSql, $resDataBase );
	}
	
	public static function fetchDoctorPercentagesByDoctorId( $intDoctorId, $resDataBase ) {
		$strSql = 'SELECT * FROM doctor_percentage WHERE doctor_id = ' . (int) $intDoctorId;
		
		return parent::fetchDoctorPercentages( $strSql, $resDataBase );
	}
	
	public static function fetchDoctorPercentageByDoctorIdByTestTypeId( $intDoctorId, $intTestTypeId, $resDataBase ) {
		$strSql = 'SELECT * FROM doctor_percentage WHERE doctor_id = ' . (int) $intDoctorId . ' AND test_type_id = ' . (int) $intTestTypeId;

		return parent::fetchDoctorPercentage( $strSql, $resDataBase );
	}
}

?>