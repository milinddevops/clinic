<?php
require_once( '../../defines.php' );
require_once( EOS_BASE . 'CBaseDoctor.class.php' );

class CDoctor extends CBaseDoctor {
	
	public $m_strErrorMsgs;
	public $m_arrobjPatients;
	
	
	function __construct() {
		$this->m_arrobjPatients = array();
	}
	
	/*******************************************************************
	 ************************* Fetch Functions **********************
	 *******************************************************************/
	 function fetchPatientsByStartAndEndDate( $strStartDate, $strEndDate, $resDataBase ) {
	 	require_once( EOS_PATH . 'CPatients.class.php' );
	 	
	 	return CPatients::fetchPatientsByDoctorIdByStartAnEndDate( $this->getId(), $strStartDate, $strEndDate, $resDataBase );
	 }
	
	
	/*******************************************************************
	 ************************* Other Functions **********************
	 *******************************************************************/
	public static function createDoctor() {
		$objDoctor = new CDoctor();	
		return $objDoctor;	
	}
	
	public function addErrorMsg( $strMsg ) {
		$this->m_strErrorMsgs[] = $strMsg;
	}
	
	public function setPatients( $arrPatients ) {
		$this->m_arrobjPatients = $arrPatients;
	}
	
	public function getPatients() {
		return $this->m_arrobjPatients;
	}
	
	/*******************************************************************
	 ************************* Validate Functions **********************
	 *******************************************************************/
		
	public function validate( $action, $resDataBase ) {
		$boolIsValid = true;
		
		switch( $action ) {
			case 'INSERT':
			case 'UPDATE':
				//$boolIsValid &= $this->valUsername();
				
				break;			
		}
		
		return $boolIsValid;
	}

	
	/*******************************************************************
	 ************************* Other Functions **********************
	 *******************************************************************/
	
}

?>