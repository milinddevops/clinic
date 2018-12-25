<?php
require_once( APP_ADMIN_PORTAL . 'CAdminApp.class.php' );

class CPatientsModule extends CAdminApp {
		
	protected $m_arrobjPatients;
	protected $m_objPatient;
	protected $m_intPatientsCount;
	protected $m_arrobjSonographyTests;
	protected $m_arrobjXrayTests;
		
	function __construct() {
		
	}

	/*******************************************************************
	 ************************* Framework Function **********************
	 *******************************************************************/
	function initialize() {
		parent::initialize();

		require_once( EOS_PATH . 'CDoctors.class.php' );
		
		$this->m_arrobjDoctors 	= CDoctors::fetchDoctors( $this->m_resPortalDatabase );
		$this->m_arrobjDoctors 	= rekeyObjects( 'Id', $this->m_arrobjDoctors );		
		$this->m_strSelectedTab = 'patients';
			
	}
	function execute() {
		parent::execute();
		
		switch ( $this->getRequestAction() ) {		
					
			case NULL:
			case 'view_patients':
				$this->handleViewPatients();
				break;
			case 'review_patients':
				$this->handleReviewPatients();
				break;
			case 'view_current_day_patients':
				$this->handleViewCurrentDayPatients();
				break;
			case 'add_patient':
				$this->handleAddPatient();
				break;
			case 'edit_patient':
				$this->handleEditPatient();
				break;			
			case 'insert_patient':
				$this->handleInsertPatient();
				break;
			case 'update_patient':
				$this->handleUpadtePatient();
				break;
			case 'edit_payment':
				$this->handleEditPayment();
				break;
			case 'delete_patient':
				$this->handleDeletePatient();
				break;
			case 'update_billing_info':
				$this->handleUpdateBillingInfo();
				break;
			case 'search_patients':
				$this->handleSearchPatients();
				break;				
		}
	}
	
	/*******************************************************************
	 ************************* Handle Function **********************
	 *******************************************************************/
	
	function handleViewPatients() {
		
		require_once( EOS_PATH . 'CPatients.class.php' );
		require_once( EOS_PATH . 'CUser.class.php');
						
		$intPageNo 		= 1;
		$intPageLimit 	= 10;
		
		if( false == is_null( $this->getRequestData( array( 'page' ) ) ) ) {
			$intPageNo = $this->getRequestData( array( 'page' ) );
		}
		$intOffset = ( $intPageNo - 1 ) * $intPageLimit;
		
		$this->m_intPatientsCount 	= CPatients::fetchPatientCount( $this->m_resPortalDatabase );				
		$this->m_arrobjPatients 	= CPatients::fetchPaginatedPatients( $intOffset, $intPageLimit, $this->m_resPortalDatabase );
				
		$this->displayViewPatients();
	}
	
	function handleReviewPatients() {
		require_once( EOS_PATH . 'CPatients.class.php' );
		require_once( EOS_PATH . 'CUser.class.php');
								
		//$this->m_arrobjPatients = CPatients::fetchPatientsByDateRange(  , $this->m_resPortalDatabase );
				
		$this->displayViewPatients();
	}
	
	function handleSearchPatients() {
		require_once( EOS_PATH . 'CPatients.class.php' );
		require_once( EOS_PATH . 'CUser.class.php');
			
		$intPageNo 		= 1;
		$intPageLimit 	= 10;
		
		if( false == is_null( $this->getRequestData( array( 'page' ) ) ) ) {
			$intPageNo = $this->getRequestData( array( 'page' ) );
		}
		$intOffset = ( $intPageNo - 1 ) * $intPageLimit;
				
		$this->m_arrobjPatients = CPatients::fetchCurrentDatePaginatedPatientsBySearchText( $this->getRequestData( array( 'patients', 'search_text' ) ), '', $intOffset, $intPageLimit, $this->m_resPortalDatabase );
		
		$this->m_objUser 		= $this->getSessionData( 'objUser' );
				
		$this->displayViewPatients();
	}
	
	function handleViewCurrentDayPatients() {
		require_once( EOS_PATH . 'CPatients.class.php' );
		require_once( EOS_PATH . 'CUser.class.php');
		
		$this->m_arrobjPatients = CPatients::fetchAllCurrentDatePatients( $this->m_resPortalDatabase );
				
		$this->displayViewCurrentDayPatients();
	}
		
	function handleAddPatient() {
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		require_once( EOS_PATH . 'CDoctors.class.php' );
		require_once( EOS_PATH . 'CUser.class.php');
		require_once( EOS_PATH . 'CPatients.class.php' );
		
		$this->m_arrobjSonographyTests  = CPathologyTests::fetchTestsByTypeId( $intTestTypeId = 2, $this->m_resPortalDatabase );
		$this->m_arrobjXrayTests  		= CPathologyTests::fetchTestsByTypeId( $intTestTypeId = 3, $this->m_resPortalDatabase );
		$this->m_arrobjPathologyTests 	= CPathologyTests::fetchAllPathologyTests( $this->m_resPortalDatabase );
		$this->m_arrobjDoctors			= CDoctors::fetchDoctors( $this->m_resPortalDatabase );
		$this->m_objPatient 			= new CPatient();
		$objLastPatient					= CPatients::fetchLastPatient( $this->m_resPortalDatabase );
		
		if( true == is_object( $objLastPatient ) ) {
			$this->m_objPatient->setRecivedDate( $objLastPatient->getReceivedDate() );
		}	
		
		$this->displayAddPatient();
	}
	
	function handleInsertPatient() {
		
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		require_once( EOS_PATH . 'CDoctors.class.php' );
		require_once( EOS_PATH . 'CPatient.class.php' );
		require_once( EOS_PATH . 'CCustomerPathologyTest.class.php' );
		
		//$this->m_arrobjPathologyTests 	= CPathologyTests::fetchPathologyTests( $this->m_resPortalDatabase );
		$this->m_arrobjDoctors			= CDoctors::fetchDoctors( $this->m_resPortalDatabase );
		$this->m_objPatient				= new CPatient();
		
		$this->m_objPatient->applyRequestForm( $this->getRequestData( array( 'patients' )));
		
		switch( NULL ) {
			default:				
				$boolIsValid = true;
				
				$boolIsValid &= $this->m_objPatient->validate( 'INSERT', $this->m_resPortalDatabase );
				
				if( false == $boolIsValid ) {
					break;
				}
				
				if( true == $this->m_objPatient->insert( $this->m_resPortalDatabase )) {
					//display($this->getRequestData( array( 'path_tests' )));exit;
					if( true == is_array( $this->getRequestData( array( 'path_tests' ))) && 0 < sizeof( $this->getRequestData( array( 'path_tests' )))) {
						foreach( $this->getRequestData( array( 'path_tests' )) as $intTest ) {
							$objPathologyTest = new CCustomerPathologyTest();
							$objPathologyTest->setCustomerId( $this->m_objPatient->getId() );
							$objPathologyTest->setPathologyTestId( $intTest );
							$objPathologyTest->setCreatedOn( $this->m_objPatient->getReceivedDate() );
							
							if( false == $objPathologyTest->insert( $this->m_resPortalDatabase )) {
								break;
							}
						}
					}				
				}
				
				$_SESSION['patient']['current_patient'] =  serialize( $this->m_objPatient );
				
				$this->m_objPatient->addSuccessMsgs( 'Patient added successfully...' );
				
				if( 'home' == $this->getRequestData( array( 'return' ) ) ) {
					header( 'Location:' . $this->m_strBaseName . '?module=home' );
					exit;
				}				
				header( 'Location:' . $this->m_strBaseName . '?module=patients' );
				exit;
		}
		
		$this->displayAddPatient();
	}
	
	function handleEditPatient() {
		
		require_once( EOS_PATH . 'CPatients.class.php' );
		require_once( EOS_PATH . 'CUser.class.php');
		require_once( EOS_PATH . 'CDoctors.class.php' );
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		
		$this->m_arrobjPathologyTests 	= CPathologyTests::fetchTestsByTypeId( $intTestTypeId = 1, $this->m_resPortalDatabase );
		$this->m_arrobjSonographyTests  = CPathologyTests::fetchTestsByTypeId( $intTestTypeId = 2, $this->m_resPortalDatabase );
		$this->m_arrobjXrayTests  		= CPathologyTests::fetchTestsByTypeId( $intTestTypeId = 3, $this->m_resPortalDatabase );
		$this->m_arrobjDoctors 			= CDoctors::fetchDoctors( $this->m_resPortalDatabase );
		// set current patient details
		$this->m_objPatient = CPatients::fetchPatientById( $this->getRequestData( array( 'patient_id' )), $this->m_resPortalDatabase );	
		$arrobjPathTest 	= $this->m_objPatient->fetchPathologyTests( $this->m_resPortalDatabase );		
		$arrobjPathTests 	= rekeyObjects('Id', $arrobjPathTest);
		
		$this->m_objPatient->setPathologyTests( $arrobjPathTests );
		
		$this->displayEditPatient();
	}
	
	function handleUpadtePatient() {
		
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		require_once( EOS_PATH . 'CDoctors.class.php' );
		require_once( EOS_PATH . 'CPatients.class.php' );
		require_once( EOS_PATH . 'CCustomerPathologyTest.class.php' );
		
		//$this->m_arrobjPathologyTests 	= CPathologyTests::fetchPathologyTests( $this->m_resPortalDatabase );
		$this->m_arrobjDoctors			= CDoctors::fetchDoctors( $this->m_resPortalDatabase );
		$this->m_objPatient 			= CPatients::fetchPatientById( $this->getRequestData( array( 'patients', 'id' )), $this->m_resPortalDatabase );
		
		$this->m_objPatient->applyRequestForm( $this->getRequestData( array( 'patients' )));
		
		switch( NULL ) {
			default:				
				$boolIsValid = true;
				
				$boolIsValid &= $this->m_objPatient->validate( 'UPDATE', $this->m_resPortalDatabase );
				
				if( false == $boolIsValid ) {
					break;
				}
				
				if( true == $this->m_objPatient->update( $this->m_resPortalDatabase )) {
					$arrobjPathologyTests = $this->m_objPatient->getPathologyTests();
					// delete exsisting customer test and inser new path test records
					$this->m_objPatient->deleteCustomerTests( $this->m_resPortalDatabase );					
					
					if( true == is_array( $this->getRequestData( array( 'path_tests' ))) && 0 < sizeof( $this->getRequestData( array( 'path_tests' )))) {
						foreach( $this->getRequestData( array( 'path_tests' )) as $intTest ) {
							$objPathologyTest = new CCustomerPathologyTest();
							$objPathologyTest->setCustomerId( $this->m_objPatient->getId() );
							$objPathologyTest->setPathologyTestId( $intTest );
							$objPathologyTest->setCreatedOn( $this->m_objPatient->getReceivedDate() );
							
							if( false == $objPathologyTest->insert( $this->m_resPortalDatabase )) {
								break;
							}
						}
					}				
				}
								
				$_SESSION['patient']['current_patient'] =  serialize( $this->m_objPatient );
				
				$this->m_objPatient->addSuccessMsgs( 'Patient added successfully...' );
				
				if( 'home' == $this->getRequestData( array( 'return' ) ) ) {
					header( 'Location:' . $this->m_strBaseName . '?module=home' );
					exit;
				}
				header( 'Location:' . $this->m_strBaseName . '?module=patients&action=view_patients' );
		}
		
		$this->displayAddPatient();
	}
	
	function handleDeletePatient() {
		
		require_once( EOS_PATH . "CPatients.class.php" );
		
		$this->m_objPatient = CPatients::fetchPatientById( $this->getRequestData( array( 'patients', 'id' )), $this->m_resPortalDatabase );
		$this->m_objPatient->delete( $this->m_resPortalDatabase );		
		$this->m_objPatient->addSuccessMsgs( 'Patient deleted successfully...' );
	
		if( 'home' == $this->getRequestData( array( 'return' ) ) ) {
			header( 'Location:' . $this->m_strBaseName . '?module=home' );
			exit;
		}
		
		header( 'Location:' . $this->m_strBaseName . '?module=patients&action=view_patients' );
	}
	
	function handleUpdateBillingInfo() {
		require_once( EOS_PATH . 'CPatients.class.php' );
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		
		if( 0 < strlen($this->getRequestData( array( 'patients', 'id' ))) && false == is_null( $this->getRequestData( array( 'patients', 'id' ))) ){			
			$this->m_objPatient = CPatients::fetchPatientById( $this->getRequestData( array( 'patient_id' )), $this->m_resPortalDatabase );
		} else {			
			$this->m_objPatient = new CPatient();
			$this->m_objPatient->applyRequestForm( $this->getRequestData( array( 'patients' )));			
		}
				
		$arrobjpathologyTests = CPathologyTests::fetchPathologyTestsByIds( $this->getRequestData( array( 'path_tests' )), $this->m_resPortalDatabase );
		
		$fltTotalAmt 		= 0.00;
		$fltLabChargesAmt 	= 0.00;
		$fltDocAmt 			= 0.00;
		
		foreach ( $arrobjpathologyTests as $objpathologyTest ) {
			$fltTotal += $objpathologyTest->getLabRate() + $objpathologyTest->getDocRate();
			$fltLabChargesAmt += $objpathologyTest->getLabRate();
			$fltDocAmt += $objpathologyTest->getDocRate();
		}
		$this->m_objPatient->setTotalBillAmt( $fltTotal );
		$this->m_objPatient->setIpdAmt( $fltLabChargesAmt );
		$this->m_objPatient->setOpdAmt( $fltDocAmt );
		
		$this->displayBillingInfo();
	}
	
	/*******************************************************************
	 ************************* Display Function **********************
	 *******************************************************************/
	
	function displayViewPatients() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );
		

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
	
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
		
		$objSmarty->assign_by_ref( 'success_msgs', $this->m_objPatient->m_strSuccessMsgs );
		
		$objSmarty->assign_by_ref( 'patients', $this->m_arrobjPatients );
		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
		$objSmarty->assign_by_ref( 'doctors' , $this->m_arrobjDoctors );
		$objSmarty->assign_by_ref( 'page', $this->getRequestData( array( 'page' ) ) );
		$objSmarty->assign_by_ref( 'patient_count' , $this->m_intPatientsCount );
		
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}
		
		$content = $objSmarty->fetch( 'patients/view_patients.tpl' );
		
		$objSmarty->assign_by_ref( 'content', $content );
		$objSmarty->display( 'common/layout.tpl' );
	}
	
	function displayViewCurrentDayPatients() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
	
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
		
		$objSmarty->assign_by_ref( 'success_msgs', $this->m_objPatient->m_strSuccessMsgs );
		
		$objSmarty->assign_by_ref( 'patients', $this->m_arrobjPatients );
		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
		
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}
		
		$content = $objSmarty->fetch( 'patients/view_patients.tpl' );
		
		$objSmarty->assign_by_ref( 'content', $content );
		$objSmarty->display( 'common/layout.tpl' );
	}
	
	function displayAddPatient() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
		
		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
		
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}
		
		
		$objSmarty->assign( 'return', $this->getRequestData( array( 'return' ) ) );
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
		$objSmarty->assign_by_ref( 'sonography_tests', $this->m_arrobjSonographyTests );
		$objSmarty->assign_by_ref( 'xray_tests', $this->m_arrobjXrayTests );
		$objSmarty->assign_by_ref( 'pathology_tests', $this->m_arrobjPathologyTests );
		$objSmarty->assign_by_ref( 'doctors', $this->m_arrobjDoctors );
		$objSmarty->assign_by_ref( 'patient', $this->m_objPatient );
		
		
		$content = $objSmarty->fetch( 'patients/add_patient.tpl' );
		
		$objSmarty->assign_by_ref( 'content', $content);
		$objSmarty->display( 'common/layout.tpl' );
	}
	
	function displayEditPatient() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
		
		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
		
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}

		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
		$objSmarty->assign( 'return', $this->getRequestData( array( 'return' ) ) );
		
		$objSmarty->assign_by_ref( 'sonography_tests', $this->m_arrobjSonographyTests );
		$objSmarty->assign_by_ref( 'xray_tests', $this->m_arrobjXrayTests );
		$objSmarty->assign_by_ref( 'pathology_tests', $this->m_arrobjPathologyTests );		
		$objSmarty->assign_by_ref( 'customer_pathology_tests', $this->m_objPatient->getPathologyTests() );
		$objSmarty->assign_by_ref( 'patient', $this->m_objPatient );
		$objSmarty->assign_by_ref( 'doctors', $this->m_arrobjDoctors );
		
		$objSmarty->assign( 'url', 'update_patient' );
		
		$content = $objSmarty->fetch( 'patients/add_patient.tpl' );
		
		$objSmarty->assign_by_ref( 'content' , $content );

		
		$objSmarty->display( 'common/layout.tpl' );
	}
	
	function displayBillingInfo() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );

		$objSmarty->assign_by_ref( 'patient', $this->m_objPatient );
		
		$objSmarty->display( 'patients/billing_info.tpl' );
	}
}