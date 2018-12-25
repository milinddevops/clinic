<?php

require_once( APP_ADMIN_PORTAL . 'CAdminApp.class.php' );

class CPathologyTestsModule extends CAdminApp {

	protected $m_objPathologyTest;
	protected $m_objDoctorPercentage;
	
	function __construct() {
		
	}

	/*******************************************************************
	 ************************* Framework Function **********************
	 *******************************************************************/
		
	function execute() {
		parent::execute();
		
		switch ( $this->getRequestAction() ) {		
					
			case NULL:
			case 'view_pathology_tests':
				$this->handleViewPathologyTests();
				break;
				
			case 'get_tests':
				$this->handleGetTests();
				break;			
				
			case 'get_test':
				$this->handleGetTest();
				break;
				
			case 'get_lab_amt':
				$this->handleGetTestLabAmt();
				break;
				
			case 'get_ref_amt':
				$this->handleGetTestRefAmt();
				break;
			
			case 'remove_test':
				$this->handleRemoveTest();
				break;
			
			case 'remove_lab_amt':
				$this->handleRemoveLabAmt();
				break;
			
			case 'remove_ref_amt':
				$this->handleRemoveRefAmt();
				break;
		}
	}
	
	/*******************************************************************
	 ************************* Handle Function **********************
	 *******************************************************************/
	
	function handleViewPathologyTests() {		
		
		require_once( EOS_PATH . 'CUser.class.php' );
		
		$this->m_objUser = $this->getSessionData( 'objUser' );
		
		$this->displayViewPathologyTests();
	}
	
	function handleGetTests() {
		
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		
		$strText = $this->getRequestData( array( 'query' ) );
		$arrobjPathologyTests = CPathologyTests::fetchTestsByText( $strText, $this->m_resPortalDatabase );
		
		$arrTestNames 	= array();
		$arrTestIds 	= array();
		$arrBillAmt     = array();
		$arrRefAmt		= array();
		
		foreach ( $arrobjPathologyTests as $objPathologyTests ) {
			array_push( $arrTestNames, $objPathologyTests->getName() );
			array_push( $arrTestIds, $objPathologyTests->getId() );
			array_push( $arrBillAmt, $objPathologyTests->getLabRate() + $objPathologyTests->getDocRate() );
			array_push( $arrRefAmt, $objPathologyTests->getDocRate() );		
		}
		
		$arrData = array(
							 'query' 		=> $strText,
							 'suggestions'  => $arrTestNames,
							 'data' 		=> $arrTestIds,
							 'billAmt'		=> $arrBillAmt
						);
		
		echo json_encode( $arrData );
		
	}
	
	function handleGetTest() {
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		
		$intTestId = $this->getRequestData( array( 'test', 'id' ) );
		$intTypeId = $this->getRequestData( array( 'type', 'id' ) );
		
		$this->m_objPathologyTest = CPathologyTests::fetchPathologyTestByIdTypeId( $intTestId, $intTypeId, $this->m_resPortalDatabase );
		
		echo $this->getRequestData( array( 'amt' ) ) + $this->m_objPathologyTest->getLabRate() + $this->m_objPathologyTest->getDocRate();  
	}
	
	function handleGetTestLabAmt() {
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		
		$intTestId = $this->getRequestData( array( 'test', 'id' ) );
		$intTypeId = $this->getRequestData( array( 'type', 'id' ) );
		
		$this->m_objPathologyTest = CPathologyTests::fetchPathologyTestByIdTypeId( $intTestId, $intTypeId, $this->m_resPortalDatabase );
		
		echo $this->getRequestData( array( 'amt' ) ) + $this->m_objPathologyTest->getLabRate();  
	}
	
	function handleGetTestRefAmt() {
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		
		$intTestId = $this->getRequestData( array( 'test', 'id' ) );
		$intTypeId = $this->getRequestData( array( 'type', 'id' ) );
		
		$this->m_objPathologyTest = CPathologyTests::fetchPathologyTestByIdTypeId( $intTestId, $intTypeId, $this->m_resPortalDatabase );
		
		echo $this->getRequestData( array( 'amt' ) ) + $this->m_objPathologyTest->getDocRate();  
	}
	
	/*function handleGetTestLabAmt() {
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		require_once( EOS_PATH . 'CDoctorPercentages.class.php' );
		
		$intTestId 		= $this->getRequestData( array( 'test', 'id' ) );
		$intDoctorId 	= $this->getRequestData( array( 'doctor', 'id' ) );
		
		$this->m_objPathologyTest 		= CPathologyTests::fetchPathologyTestByIdTypeId( $intTestId, $intTypeId, $this->m_resPortalDatabase );
		$this->m_objDoctorPercentage 	= CDoctorPercentages::fetchDoctorPercentageByDoctorIdByTestTypeId(  $intDoctorId, $this->m_objPathologyTest->getTestType(), $this->m_resPortalDatabase );
		$fltLabPercentage 				= (100 - $this->m_objDoctorPercentage->getPercentage());
				
		$fltLabAmt = ( $this->m_objPathologyTest->getTotal() * $fltLabPercentage ) / 100;
		 
		echo $this->getRequestData( array( 'amt' ) ) + $fltLabAmt;  
	}
	
	function handleGetTestRefAmt() {
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		require_once( EOS_PATH . 'CDoctorPercentages.class.php' );
		
		$intTestId 		= $this->getRequestData( array( 'test', 'id' ) );
		$intDoctorId 	= $this->getRequestData( array( 'doctor', 'id' ) );
		
		$this->m_objPathologyTest 		= CPathologyTests::fetchPathologyTestByIdTypeId( $intTestId, $intTypeId, $this->m_resPortalDatabase );
		$this->m_objDoctorPercentage 	= CDoctorPercentages::fetchDoctorPercentageByDoctorIdByTestTypeId(  $intDoctorId, $this->m_objPathologyTest->getTestType(), $this->m_resPortalDatabase );				
		$fltRefAmt 						= ( $this->m_objPathologyTest->getTotal() * $this->m_objDoctorPercentage->getPercentage() ) / 100;
		
		echo $this->getRequestData( array( 'amt' ) ) + $fltRefAmt;  
	}*/
	
	function handleRemoveTest() {
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
				
		$intTestId = $this->getRequestData( array( 'test', 'id' ) );
				
		$this->m_objPathologyTest 		= CPathologyTests::fetchPathologyTestByIdTypeId( $intTestId, $intTypeId, $this->m_resPortalDatabase );
						
		echo $this->getRequestData( array( 'amt' ) ) - $this->m_objPathologyTest->getTotal();
	}
	
	function handleRemoveLabAmt() {
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		
		$intTestId = $this->getRequestData( array( 'test', 'id' ) );
				 
		$this->m_objPathologyTest = CPathologyTests::fetchPathologyTestByIdTypeId( $intTestId, $intTypeId, $this->m_resPortalDatabase );
		
		echo ( $this->getRequestData( array( 'amt' ) ) - $this->m_objPathologyTest->getLabRate() );
	}
	
	function handleRemoveRefAmt() {
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		
		$intTestId = $this->getRequestData( array( 'test', 'id' ) );
				 
		$this->m_objPathologyTest = CPathologyTests::fetchPathologyTestByIdTypeId( $intTestId, $intTypeId, $this->m_resPortalDatabase );
		
		echo ( $this->getRequestData( array( 'amt' ) ) - $this->m_objPathologyTest->getDocRate() );
	}
	
	/*******************************************************************
	 ************************* Other Functions **********************
	 *******************************************************************/
	
	function loadExitTags() {
		parent::loadExitTags();		
	}
	
	
	/*******************************************************************
	 ************************* Display Function **********************
	 *******************************************************************/
	
	function displayViewPathologyTests() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );

		$this->loadExitTags();
		
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
		
		$content = $objSmarty->fetch( 'pathologytests/view_pathology_tests.tpl' );		
		
		$objSmarty->assign( 'content', $content );
		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));		
		
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}

		$objSmarty->display( 'common/layout.tpl' );
	} 
	
	function displayEditPathologyTest() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );

		$this->loadExitTags();
		
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
		$objSmarty->assign( 'pathology_test', $this->m_objPathologyTest );
		
		$content = $objSmarty->fetch( 'pathologytests/edit_pathology_test.tpl' );		
		
		$objSmarty->assign( 'content', $content );
		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));		
		
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}

		$objSmarty->display( 'common/layout.tpl' );
	}
}
?>