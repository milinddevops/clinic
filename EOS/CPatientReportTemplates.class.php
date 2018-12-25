<?php

require_once( '../../defines.php' );
require_once( EOS_BASE . 'CBasePatientReportTemplates.class.php' );

class CPatientReportTemplates extends CBasePatientReportTemplates {
		
	public static function fetchPatientReportTemplateById( $intId, $resDataBase ) {
		$strSql = 'SELECT * FROM patient_report_templates WHERE id = ' . (int) $intId;
		
		return parent::fetchPatientReportTemplate( $strSql, $resDataBase );
	}
	
	public static function fetchPatientReportTemplateByPatientId( $intPatientId, $resDataBase ) {
		$strSql = 'SELECT * FROM patient_report_templates WHERE patient_id = ' . (int) $intPatientId;
		
		return parent::fetchPatientReportTemplate( $strSql, $resDataBase );
	}
		
	public static function fetchAllPatientReportTemplates( $resDataBase ) {
		$strSql = 'SELECT * FROM patient_report_templates';		
		$arrobjPatientReportTemplates = parent::fetchPatientReportTemplates( $strSql, $resDataBase );
			
		return $arrobjPatientReportTemplates;
	}	
}

?>