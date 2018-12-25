<?php
require_once( '../../defines.php' );
require_once( EOS_BASE . 'CBaseCustomerPathologyTest.class.php' );

class CCustomerPathologyTest extends CBaseCustomerPathologyTest {
	
	public $m_strErrorMsgs;
	
	/*******************************************************************
	 ************************* Fetch Functions **********************
	 *******************************************************************/
	
	
	
	/*******************************************************************
	 ************************* Other Functions **********************
	 *******************************************************************/
	public static function createCustomerPathologyTest() {
		$objCustomerPathologyTest = new CCustomerPathologyTest();	
		return $objCustomerPathologyTest;	
	}
	
	public function addErrorMsg( $strMsg ) {
		$this->m_strErrorMsgs[] = $strMsg;
	}
	
	/*******************************************************************
	 ************************* Validate Functions **********************
	 *******************************************************************/
	
	function valUsername() {
		if( false == is_null( $this->m_strUsername )) {
			return true;
		}else {
			$this->addErrorMsg( 'Please enter username.' );
			return false;
		}
	}
	
	function valPassword() {
		if( false == is_null( $this->m_strPassword )) {
			return true;
		}else {
			$this->addErrorMsg( 'Please enter password.' );
			return false;
		}
	}
	
	function valType( $resDataBase = NULL ) {
		if( false == is_null( $this->m_intType )) {
			if( false == is_null( $resDataBase )) {
				return $this->valUser( $resDataBase );
			}
			return false;			
		}else {
			$this->addErrorMsg( 'Please select user type.' );
			return false;
		}
	}
	
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