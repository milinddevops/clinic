<?php
require_once( '../../defines.php' );
require_once( EOS_BASE . 'CBasePatientReportTemplate.class.php' );

class CPatientReportTemplate extends CBasePatientReportTemplate {
	
	public $m_strErrorMsgs;
	public $m_strSuccessMsgs;
	public $m_arrobjPathologyTests;
	
	
	/*******************************************************************
	 ************************* Fetch Functions **********************
	 *******************************************************************/
	
	
	
	/*******************************************************************
	 ************************* Other Functions **********************
	 *******************************************************************/
	public static function createPatientReportTemplate() {

		$objPatientReportTemplate = new CPatientReportTemplate();	
		return $objPatientReportTemplate;	
	}
	
	public function addErrorMsg( $strMsg ) {
		$this->m_strErrorMsgs[] = $strMsg;
	}
	
	public function getErrorMsg() {
		return $this->m_strErrorMsgs;
	}
	
	public function addSuccessMsgs( $strMsg ) {
		$this->m_strSuccessMsgs[] = $strMsg;
	}

	/*******************************************************************
	 ************************* Validate Functions **********************
	 *******************************************************************/
	
	

	/*******************************************************************
	 ************************* Fetch Functions **********************
	 *******************************************************************/
	
	/*******************************************************************
	 ************************* Other Functions **********************
	 *******************************************************************/
	
}

?>