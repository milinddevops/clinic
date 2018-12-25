<?php
require_once( '../../defines.php' );
require_once( EOS_BASE . 'CBasePatient.class.php' );

class CPatient extends CBasePatient {
	
	public $m_strErrorMsgs;
	public $m_strSuccessMsgs;
	public $m_arrobjPathologyTests;
	
	function __construct() {
		$this->m_arrobjPathologyTests = array();
	}
	
	/*******************************************************************
	 ************************* Fetch Functions **********************
	 *******************************************************************/
	
	
	
	/*******************************************************************
	 ************************* Other Functions **********************
	 *******************************************************************/
	public static function createPatient() {
		$objPatient = new CPatient();	
		return $objPatient;	
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

	public function getPathologyTests() {
		return $this->m_arrobjPathologyTests;
	}
	
	public function setPathologyTests( $arrPathologyTests ) {
		$this->m_arrobjPathologyTests = $arrPathologyTests;
	}
	/*******************************************************************
	 ************************* Validate Functions **********************
	 *******************************************************************/
	
	function valFirstName() {
		if( false == is_null( $this->m_strFirstName )) {
			return true;
		}else {
			$this->addErrorMsg( 'Please enter first name.' );
			return false;
		}
	}
	
	function valLastName() {
		if( false == is_null( $this->m_strLastName )) {
			return true;
		}else {
			$this->addErrorMsg( 'Please enter last name.' );
			return false;
		}
	}
	
	function valPhone() {
		if( false == is_null( $this->m_strPhone )) {
			return true;
		}else {
			$this->addErrorMsg( 'Please enter phone number.' );
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
				$boolIsValid &= $this->valFirstName();
				$boolIsValid &= $this->valLastName();
				$boolIsValid &= $this->valPhone();
				
				break;			
		}
		
		return $boolIsValid;
	}

	/*******************************************************************
	 ************************* Fetch Functions **********************
	 *******************************************************************/
	
	public function fetchPathologyTests( $resDatabase ) {
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		
		return CPathologyTests::fetchPahologyTestsWithRateByCustomerId( $this->getId(), $resDatabase);
	}
	
	/*******************************************************************
	 ************************* Other Functions **********************
	 *******************************************************************/
	
}

?>