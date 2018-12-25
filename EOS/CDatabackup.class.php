<?php
require_once( '../../defines.php' );
require_once( EOS_BASE . 'CBaseDatabackup.class.php' );

class CDatabackup extends CBaseDatabackup {
		
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