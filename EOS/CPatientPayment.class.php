<?php
require_once( '../../defines.php' );
require_once( EOS_BASE . 'CBasePatientPayment.class.php' );

class CPatientPayment extends CBasePatientPayment {
	
	public $m_strErrorMsgs;
	
	function __construct() {
		
	}
	
	/*******************************************************************
	 ************************* Fetch Functions **********************
	 *******************************************************************/
	 
	
	/*******************************************************************
	 ************************* Other Functions **********************
	 *******************************************************************/
	
	public function addErrorMsg( $strMsg ) {
		$this->m_strErrorMsgs[] = $strMsg;
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