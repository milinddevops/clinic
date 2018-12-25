<?php

require_once( EOS_PATH . 'CPatientReportTemplate.class.php' );

class CBasePatientReportTemplates {
	
	public static function fetchPatientReportTemplates( $strSql, $resDataBase ) {
		//$strSql = 'SELECT * FROM patients';
				
		$resQuery = mysql_query( $strSql, $resDataBase );
		
		while ( $resData = mysql_fetch_assoc( $resQuery )) {
			if( $resData ) {
				$objPatientReportTemplate = new CPatientReportTemplate();
			
				$objPatientReportTemplate->setValues( $resData );		
				
				$arrobjPatientReportTemplates[] = $objPatientReportTemplate;				
			}
		}
		
		return $arrobjPatientReportTemplates;
		
	}	
	
	public static function fetchPatientReportTemplate( $strSql, $resDataBase ) {		
		$resQuery = mysql_query( $strSql, $resDataBase );
		
		$resData = mysql_fetch_assoc( $resQuery );
		
		if( $resData ) {
			$objPatientReportTemplate = new CPatientReportTemplate();
		
			$objPatientReportTemplate->setValues( $resData );
		}else {
			$objPatientReportTemplate = NULL;
		}
				
		return $objPatientReportTemplate;
	}
	
}

?>