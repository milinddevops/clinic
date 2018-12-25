<?php
require_once( '../../defines.php' );
require_once( EOS_BASE . 'CBaseExpence.class.php' );

class CExpence extends CBaseExpence {
	
	public $m_strErrorMsgs;
	
	function __construct() {
		
	}
	/*******************************************************************
	 ************************* Validate Functions **********************
	 *******************************************************************/
	
	function valReason() {
		if( true == is_null( $this->getReason() ) ) {
			$this->addErrorMsg( 'Please enter expense reason.' );
			return false;
			
		} else {
			return true;
		}
	}
	
	function valAmount() {
		if( true == is_null( $this->getAmount() ) ) {
			$this->addErrorMsg( 'Please enter expense amount.' );
			return false;
				
		} else {			
			if( 0 > $this->getAmount() || 0 == $this->getAmount() ) {
				$this->addErrorMsg( 'Please enter valid amount.' );
				return false;
				
			} else {
				return true;
			}
		}
		
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
	
	public function getErrorMsg() {
		return $this->m_strErrorMsgs;
	}
		
	/*******************************************************************
	 ************************* Validate Functions **********************
	 *******************************************************************/
		
	public function validate( $action, $resDataBase ) {
		$boolIsValid = true;
		
		switch( $action ) {
			case 'INSERT':
			case 'UPDATE':
				$boolIsValid &= $this->valReason();
				$boolIsValid &= $this->valAmount();					
				break;			
		}
		
		return $boolIsValid;
	}

	
	/*******************************************************************
	 ************************* Other Functions **********************
	 *******************************************************************/
	
}

?>