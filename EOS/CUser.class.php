<?php
require_once( '../../defines.php' );
require_once( EOS_BASE . 'CBaseUser.class.php' );

class CUser extends CBaseUser {
	
	public $m_strErrorMsgs;
	
	protected $m_arrobjUserPermissions;
	
	/*******************************************************************
	 ************************* Set Functions **********************
	 *******************************************************************/
	
	public function setUserPermissions( $arrobjUserPermissions ) {
		$this->m_arrobjUserPermissions = $arrobjUserPermissions;
	}
	
	/*******************************************************************
	 ************************* Get Functions **********************
	 *******************************************************************/
	
	public function getUserPermissions() {
		return $this->m_arrobjUserPermissions;
	}
	
	/*******************************************************************
	 ************************* Fetch Functions **********************
	 *******************************************************************/
	
	public function valUser( $resDataBase ) {
		require_once( EOS_PATH . 'CUsers.class.php' );
		
		$strSql = "SELECT
						*
					FROM 
						users
					WHERE 
						 username = '" . (string) $this->getUsername()  . "'
						 AND password = '" . (string) $this->getPassword() . "'";
				
		$arrUser = CUsers::fetchUser( $strSql, $resDataBase );

		if( true == is_array( $arrUser ) && 0 < sizeof( $arrUser )) {
			
			$this->setValues( $arrUser );
			return true;
		}
		
		$this->addErrorMsg( 'Invalid user credentials.' );
		return false;
	}
	
	/*******************************************************************
	 ************************* Other Functions **********************
	 *******************************************************************/
	public static function createUser() {
		$objUser = new CUser();	
		return $objUser;	
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
				$boolIsValid &= $this->valUsername();
				$boolIsValid &= $this->valPassword();				
				break;
			case 'CHECK':
				$boolIsValid &= $this->valUsername();
				$boolIsValid &= $this->valPassword();
				$boolIsValid &= $this->valType( $resDataBase );				
				break;
		}
		
		return $boolIsValid;
	}

	
	/*******************************************************************
	 ************************* Other Functions **********************
	 *******************************************************************/
	
	public function login( $resDataBase ) {
		require_once( EOS_PATH . 'CUsers.class.php' );
		
		$objUser = CUsers::fetchUserByUsernameByPasswordByTypeId( $this->getUsername(), $this->getPassword(), $resDataBase );

		if( false == is_null( $objUser ) && true == ( $objUser instanceof CUser )) {			
			return $objUser;
		}
		
		$this->addErrorMsg( 'Invalid user credentials.' );
		return false;		
	}
	
}

?>