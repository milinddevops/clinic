<?php
require_once( APP_ADMIN_PORTAL . 'CAdminApp.class.php' );

class CClinicalTestsModule extends CAdminApp {

	protected $m_arrPathologicalTests;
	protected $m_objClinicalTest;
	
	function __construct() {
		
	}

	/*******************************************************************
	 ************************* Framework Function **********************
	 *******************************************************************/
	
	function initialize() {
		parent::initialize();

		require_once( EOS_PATH . 'CUser.class.php');
		
		$this->m_strSelectedTab = 'clinicaltests';		
	}
	function execute() {
		parent::execute();
		
		switch ( $this->getRequestAction() ) {		
					
			case NULL:
			case 'view_clinical_tests':
				$this->handleViewClinicalTests();
				break;
			
			case 'add_test':
				$this->handleAddTest();
				break;
					
			case 'insert_test':
				$this->handleInsertPathologyTest();
				break;
				
			case 'edit_clinical_test':
				$this->handleEditClinicalTest();
				break;
				
			case 'update_test':
				$this->handleUpdateClinicTest();
				break;

			case 'search_tests':
				$this->handleSearchClinicTest();
				break;
				
			case 'delete_test':
				$this->handleDeleteClinicalTest();
				break;
		}
	}
	
	
	/*******************************************************************
	 ************************* Handle Function **********************
	 *******************************************************************/
		
	function handleViewClinicalTests() {
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		require_once( EOS_PATH . 'CUser.class.php');
		
		$this->m_arrobjPathologyTests = CPathologyTests::fetchAllPathologyTests( $this->m_resPortalDatabase );
		
		$this->displayViewClinicalTests();	
	}
	
	function handleAddTest() {
		require_once( EOS_PATH . 'CUser.class.php');
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		
		$this->m_objClinicalTest = new CPathologyTest();
		
		if( false == is_null( $this->getRequestData( array( 'test_type', 'id' ) ) ) ) {
			$this->m_objClinicalTest->setTestType( $this->getRequestData( array( 'test_type', 'id' ) ) );
		}
		
		$this->displayAddTest();		
	}
	
	function handleInsertPathologyTest() {
		require_once( EOS_PATH . 'CPathologyTests.class.php' );		
		
		$this->m_objClinicalTest	= new CPathologyTest();
				
		$this->m_objClinicalTest->applyRequestForm( $this->getRequestData( array( 'pathology_test' )));
		
		switch( NULL ) {
			default:				
				$boolIsValid = true;
				
				$boolIsValid &= $this->m_objClinicalTest->validate( 'INSERT', $this->m_resPortalDatabase );
				
				if( false == $boolIsValid ) {
					break;
				}
				
				if( false == $this->m_objClinicalTest->insert( $this->m_resPortalDatabase )) {					
					break;
				}
				
				header( 'Location:' . $this->m_strBaseName . '?module=clinical_tests&action=view_clinical_tests' );
		}
		
		$this->displayViewClinicalTests();
	}
	
	function handleEditClinicalTest() {
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		require_once( EOS_PATH . 'CUser.class.php');
		
		$this->m_objClinicalTest = CPathologyTests::fetchPathologyTestById( $this->getRequestData( array( 'clinical_test', 'id' ) ), $this->m_resPortalDatabase );
		
		$this->displayEditClinicalTest();
	}
	
	function handleUpdateClinicTest() {
		require_once( EOS_PATH . 'CPathologyTests.class.php' );		
		
		$this->m_objClinicalTest = CPathologyTests::fetchPathologyTestById( $this->getRequestData( array( 'pathology_test', 'id' ) ), $this->m_resPortalDatabase );
				
		$this->m_objClinicalTest->applyRequestForm( $this->getRequestData( array( 'pathology_test' ) ) );

		switch( NULL ) {
			default:				
				$boolIsValid = true;
				
				$boolIsValid &= $this->m_objClinicalTest->validate( 'UPDATE', $this->m_resPortalDatabase );
				
				if( false == $boolIsValid ) {
					break;
				}
				
				if( false == $this->m_objClinicalTest->update( $this->m_resPortalDatabase )) {					
					break;
				}
				
				header( 'Location:' . $this->m_strBaseName . '?module=clinical_tests&action=view_clinical_tests' );
		}
		
		$this->displayViewClinicalTests();
	}
	
	function handleSearchClinicTest() {
		
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		require_once( EOS_PATH . 'CUser.class.php');
						
		$this->m_arrobjPathologyTests = CPathologyTests::fetchTestsByText( $this->getRequestData( array( 'tests', 'search_text' ) ), $this->m_resPortalDatabase );
		
		$this->m_objUser 		= $this->getSessionData( 'objUser' );
				
		$this->displayViewClinicalTests();
	}
	
	function handleDeleteClinicalTest() {
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		
		$this->m_objClinicalTest = CPathologyTests::fetchPathologyTestById( $this->getRequestData( array( 'pathology_test', 'id' ) ), $this->m_resPortalDatabase );
		$this->m_objClinicalTest->delete( $this->m_resPortalDatabase );		
		
		header( 'Location:' . $this->m_strBaseName . '?module=clinical_tests&action=view_clinical_tests' );
		exit;
		
	}
	
	/*******************************************************************
	 ************************* Display Function **********************
	 *******************************************************************/
	
	function displayViewClinicalTests() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
	
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
				
		$objSmarty->assign_by_ref( 'clinical_tests', $this->m_arrobjPathologyTests );
		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
		
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}
		
		$content = $objSmarty->fetch( 'clinical_tests/view_clinical_tests.tpl' );
		
		$objSmarty->assign_by_ref( 'content', $content );
		$objSmarty->display( 'common/layout.tpl' );
	}
	
	function displayEditClinicalTest() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );
		
		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
	
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
				
		$objSmarty->assign_by_ref( 'clinical_test', $this->m_objClinicalTest);
		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
		
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}
		
		$content = $objSmarty->fetch( 'clinical_tests/edit_clinical_test.tpl' );
		
		$objSmarty->assign_by_ref( 'content', $content );
		$objSmarty->display( 'common/layout.tpl' );
	}
	
	function displayAddTest() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );
		
		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
	
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
				
		$objSmarty->assign_by_ref( 'clinical_test', $this->m_objClinicalTest );
		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
		
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}
		
		$content = $objSmarty->fetch( 'clinical_tests/edit_clinical_test.tpl' );
		
		$objSmarty->assign_by_ref( 'content', $content );
		$objSmarty->display( 'common/layout.tpl' );
	}
}