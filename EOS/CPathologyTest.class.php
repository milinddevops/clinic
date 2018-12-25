<?php
require_once( '../../defines.php' );
require_once( EOS_BASE . 'CBasePathologyTest.class.php' );

class CPathologyTest extends CBasePathologyTest {
	
	public $m_strErrorMsgs;
	
	/*******************************************************************
	 ************************* Fetch Functions **********************
	 *******************************************************************/
	
	
	
	/*******************************************************************
	 ************************* Other Functions **********************
	 *******************************************************************/
	public static function createPathologyTest() {
		$objPathologyTest = new CPathologyTest();	
		return $objPathologyTest;	
	}
	
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