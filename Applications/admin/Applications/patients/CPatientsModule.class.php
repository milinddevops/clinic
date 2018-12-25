<?php
require_once( APP_ADMIN_PORTAL . 'CAdminApp.class.php' );

class CPatientsModule extends CAdminApp {
		
	
	protected $m_objPatient;
	protected $m_objSearchFilter;
	protected $m_objDoctor;
	protected $m_objPatientReportTemplate;
	
	protected $m_intPatientsCount;
	
	protected $m_arrobjPatients;
	protected $m_arrobjSonographyTests;
	protected $m_arrobjXrayTests;
	protected $m_arrobjPatientPayments;
		
	function __construct() {
		
	}

	/*******************************************************************
	 ************************* Framework Function **********************
	 *******************************************************************/
	function initialize() {
		parent::initialize();

		require_once( EOS_PATH . 'CDoctors.class.php' );
		require_once( LIBRARIES . 'searchFilters/CSearchFilter.class.php' );
		
		$this->m_arrobjDoctors 	= CDoctors::fetchDoctors( $this->m_resPortalDatabase );
		$this->m_arrobjDoctors 	= rekeyObjects( 'Id', $this->m_arrobjDoctors );		
		$this->m_strSelectedTab = 'patients';
		
		if( true == $this->getSessionData( 'search_filter' ) ) {
			$this->m_objSearchFilter = unserialize( $this->getSessionData( 'search_filter' ) );
		} else {
			$this->m_objSearchFilter = new CSearchFilter();
		}
			
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
			case 'view_patient_payments':
				$this->handleViewPatientPayments();
				break;
			case 'insert_payment':
				$this->handleInsertPayment();
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
			case 'make_finalized':
				$this->handleMakeFinalized();
				break;
			case 'update_patient_payments':
				$this->handleUpdatePatientPayments();
				break;
			case 'create_formf':
				$this->handleCreateFormf();
				break;			
			case 'update_formf':
				$this->handleUpdateFormf();
				break;
			case 'show_bill':
				$this->handleShowBill();
				break; 
            case 'print_bill':
				$this->handlePrintBill();
				break;
			case 'add_patient_report':
				$this->handleAddPatientReport();
				break;
			case 'insert_patient_report_template':
				$this->handleInsertPatientReport();
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
		$intOffset		= 0;
		$intPageGet		= $this->getRequestData( array( 'page' ) );
		
		if( false == empty($intPageGet) ) {			
			$intPageNo = $this->getRequestData( array( 'page' ) );
			$intOffset = ( $intPageNo - 1 ) * $intPageLimit;
		}

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
		require_once( EOS_PATH 	. 'CPatients.class.php' );
		require_once( EOS_PATH 	. 'CUser.class.php');
					
		$intPageNo 		= 1;
		$intPageLimit 	= 10;
		
		if( false == is_null( $this->getRequestData( array( 'page' ) ) ) ) {
			$intPageNo = $this->getRequestData( array( 'page' ) );
		}
		$intOffset = ( $intPageNo - 1 ) * $intPageLimit;
		

		if( false == is_null( $this->getRequestData( array( 'patients', 'search_text' ) ) ) ) {
			$this->m_objSearchFilter->setSearchText( $this->getRequestData( array( 'patients', 'search_text' ) ) );
		}
		
		if( false == is_null( $this->getRequestData( array( 'patients', 'on_date' ) ) ) ) {
			$this->m_objSearchFilter->setOnDate( $this->getRequestData( array( 'patients', 'on_date' ) ) );
		}
		
		if( false == is_null( $this->getRequestData( array( 'patients', 'from_date' ) ) ) && false == is_null( $this->getRequestData( array( 'patients', 'to_date' ) ) ) ) {
			$this->m_objSearchFilter->setFromDate( $this->getRequestData( array( 'patients', 'from_date' ) ) );
			$this->m_objSearchFilter->setToDate( $this->getRequestData( array( 'patients', 'to_date' ) ) );
		}
		

		$this->m_arrobjPatients = CPatients::fetchCurrentDatePaginatedPatientsBySearchText( $this->m_objSearchFilter, '', $intOffset, $intPageLimit, $this->m_resPortalDatabase );
		
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

	function handleAddPatientReport() {
		require_once( EOS_PATH . 'CPatients.class.php' );
		require_once( EOS_PATH . 'CUser.class.php');
		require_once( EOS_PATH . 'CDoctors.class.php' );
		require_once( EOS_PATH . 'CPatientReportTemplates.class.php' );
				
		// set current patient details
		$this->m_objPatient = CPatients::fetchPatientById( $this->getRequestData( array( 'patient_id' )), $this->m_resPortalDatabase );	
		$this->m_objDoctor 	= CDoctors::fetchDoctorById( $this->m_objPatient->getDoctorId(), $this->m_resPortalDatabase );
		$arrobjTests 		= $this->m_objPatient->fetchPathologyTests( $this->m_resPortalDatabase );

		$this->m_objPatientReportTemplate = CPatientReportTemplates::fetchPatientReportTemplateByPatientId( $this->m_objPatient->getId(), $this->m_resPortalDatabase );

		if( true == is_array( $arrobjTests ) && 0 < sizeof( $arrobjTests ) ) {
			$arrobjPathTests 	= rekeyObjects( 'Id', $arrobjTests );
		}
		
		$this->m_objPatient->setPathologyTests( $arrobjPathTests );

		$this->displayAddPatientReport();
	}
	
	function handleInsertPatientReport() {
		require_once( EOS_PATH . 'CPatients.class.php' );
		require_once( EOS_PATH . 'CPatientReportTemplates.class.php' );

		$arrstrData = $this->getRequestData( array( 'patient_report_template' ));

		$this->m_objPatientReportTemplate = new CPatientReportTemplate();
		$this->m_objPatientReportTemplate->applyRequestForm( $arrstrData );

		if( true == $this->m_objPatientReportTemplate->insert( $this->m_resPortalDatabase )) {			
			$this->m_objPatientReportTemplate->addSuccessMsgs( 'Patient Report saved successfully...' );
		}

		header( 'Location:' . $this->m_strBaseName . '?module=patients' );
		exit;
	}

	function handleInsertPatient() {
		
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		require_once( EOS_PATH . 'CDoctors.class.php' );
		require_once( EOS_PATH . 'CPatients.class.php' );
		require_once( EOS_PATH . 'CCustomerPathologyTest.class.php' );
		
		$objLastPatient	= CPatients::fetchLastPatient( $this->m_resPortalDatabase );

		$this->m_arrobjDoctors			= CDoctors::fetchDoctors( $this->m_resPortalDatabase );
		$this->m_objPatient				= new CPatient();
		$arrobjPathologyTests			= CPathologyTests::fetchPathologyTestsByIds( $this->getRequestData( array( 'path_tests' ) ), $this->m_resPortalDatabase );
		$arrobjPathologyTests 			= rekeyObjects('Id', $arrobjPathologyTests );

		$this->m_arrobjSonographyTests  = CPathologyTests::fetchTestsByTypeId( $intTestTypeId = 2, $this->m_resPortalDatabase );
		$this->m_arrobjXrayTests  		= CPathologyTests::fetchTestsByTypeId( $intTestTypeId = 3, $this->m_resPortalDatabase );
		$this->m_arrobjPathologyTests 	= CPathologyTests::fetchTestsByTypeId( $intTestTypeId = 1, $this->m_resPortalDatabase );
		
		$this->m_objPatient->applyRequestForm( $this->getRequestData( array( 'patients' )));
		
		$arrintPatientNo = CPatients::fetchMaxPatientSrNoByCurrentDate( date( 'Y-m-d' ), $this->m_resPortalDatabase );	

		if( 1 <= $arrintPatientNo['srno'] || 0 == $arrintPatientNo['srno'] ) {
			$this->m_objPatient->setSrNo( $arrintPatientNo['srno'] + 1 );
		} else {
			$this->m_objPatient->setSrNo( $arrintPatientNo['srno'] );
		}
			
		switch( NULL ) {
			default:				
				$boolIsValid = true;

				$boolIsValid &= $this->m_objPatient->validate( 'INSERT', $this->m_resPortalDatabase );
				
				$this->m_objPatient->setPathologyTests( $arrobjPathologyTests );

				if( false == $boolIsValid ) {
					break;
				}
				
				// Set balance amount
				$this->m_objPatient->setBalanceAmt( 0 );
				$this->m_objPatient->setBalanceStatusTypeId( 0 );
				
				if( $this->m_objPatient->getReceivedAmt() < $this->m_objPatient->getTotalBillAmt() ) {
					$this->m_objPatient->setBalanceAmt( $this->m_objPatient->getTotalBillAmt() - $this->m_objPatient->getReceivedAmt() );
					$this->m_objPatient->setBalanceStatusTypeId( 1 );
				}

				if( true == $this->m_objPatient->insert( $this->m_resPortalDatabase )) {

					if( true == is_array( $this->getRequestData( array( 'path_tests' ))) && 0 < sizeof( $this->getRequestData( array( 'path_tests' )))) {
						foreach( $this->getRequestData( array( 'path_tests' ) ) as $intTest ) {
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
								
				if( 1 == $this->getRequestData( array( 'is_save_payment' ) ) ) {
					header( 'Location:' . $this->m_strBaseName . '?module=patients&action=view_patient_payments&patient_id=' . $this->m_objPatient->getId() );
					exit;
				}
				
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
		$arrobjTests 		= $this->m_objPatient->fetchPathologyTests( $this->m_resPortalDatabase );

		if( true == is_array( $arrobjTests ) && 0 < sizeof( $arrobjTests ) ) {
			$arrobjPathTests 	= rekeyObjects( 'Id', $arrobjTests );
		}
		
		$this->m_objPatient->setPathologyTests( $arrobjPathTests );

		$this->displayEditPatient();
	}
	
	function handleUpadtePatient() {
		
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		require_once( EOS_PATH . 'CDoctors.class.php' );
		require_once( EOS_PATH . 'CPatients.class.php' );
		require_once( EOS_PATH . 'CCustomerPathologyTest.class.php' );
		
		//$this->m_arrobjPathologyTests 	= CPathologyTests::fetchPathologyTests( $this->m_resPortalDatabase );
		$this->m_arrobjDoctors	= CDoctors::fetchDoctors( $this->m_resPortalDatabase );
		$this->m_objPatient 	= CPatients::fetchPatientById( $this->getRequestData( array( 'patients', 'id' )), $this->m_resPortalDatabase );
		$page 					= $this->getRequestData( array( 'page' ));		
		$fltLastPaidAmt 		= $this->m_objPatient->getReceivedAmt();
		$fltBalanceAmt 			= $this->m_objPatient->getBalanceAmt();
		$fltLastBillAmt			= $this->m_objPatient->getTotalBillAmt();

		$this->m_objPatient->applyRequestForm( $this->getRequestData( array( 'patients' )));

		if( 0 < $this->m_objPatient->getReceivedAmt() && $fltBalanceAmt == $this->m_objPatient->getReceivedAmt() && $this->m_objPatient->getTotalBillAmt() == ( $this->m_objPatient->getReceivedAmt() + $fltLastPaidAmt ) ) {
			$this->m_objPatient->setReceivedAmt( $fltLastPaidAmt + $this->m_objPatient->getReceivedAmt() );
			//$this->m_objPatient->setBalanceAmt( 0 );
			$this->m_objPatient->setBalanceStatusTypeId( 2 );
				
		} else if( 0 == $this->m_objPatient->getReceivedAmt() ) {
			$this->m_objPatient->setReceivedAmt( $fltLastPaidAmt );
			$this->m_objPatient->setBalanceAmt( ( $this->m_objPatient->getTotalBillAmt() - $fltLastPaidAmt ) );
		}

		switch( NULL ) {
			default:				
				$boolIsValid = true;

				$boolIsValid &= $this->m_objPatient->validate( 'UPDATE', $this->m_resPortalDatabase );
				
				if( false == $boolIsValid ) {
					break;
				}
				
				if( date( 'Y-m-d' ) > $this->m_objPatient->getReceivedDate()   ) {
					
					$objRecentLastPatient = CPatients::fetchRecentLastPatientByDate( date( 'Y-m-d' ), $this->m_resPortalDatabase );
					
					if( true == ( $objRecentLastPatient instanceof CPatient ) ) {
						$this->m_objPatient->setSrNo( $objRecentLastPatient->getSrNo() + 1 );
						 
					} else {
						$this->m_objPatient->setSrNo( 1 );
					}
				}
				
				$this->m_objPatient->setUpdatedOn( date( 'Y-m-d' ) );

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
				
				if( 1 == $this->getRequestData( array( 'is_save_payment' ) ) ) {
					header( 'Location:' . $this->m_strBaseName . '?module=patients&action=view_patient_payments&patient_id=' . $this->m_objPatient->getId() );
					exit;
				}
				
				if( 'home' == $this->getRequestData( array( 'return' ) ) ) {
					header( 'Location:' . $this->m_strBaseName . '?module=home' );
					exit;
				}
				
				header( 'Location:' . $this->m_strBaseName . '?module=patients&action=view_patients&page='.$page);
		}
		
		$this->displayAddPatient();
	}
	
	function handleViewPatientPayments() {
			
		require_once( EOS_PATH . 'CPatients.class.php' );
		require_once( EOS_PATH . 'CUser.class.php');
		require_once( EOS_PATH . 'CDoctors.class.php' );
		require_once( EOS_PATH . 'CPatientPayments.class.php' );

		$this->m_objPatient = CPatients::fetchPatientById( $this->getRequestData( array( 'patient_id' )), $this->m_resPortalDatabase );
		$this->m_objDoctor  = CDoctors::fetchDoctorById( $this->m_objPatient->getDoctorId(), $this->m_resPortalDatabase );
		
		$this->m_objPatientPayments = CPatientPayments::fetchPatientPaymentsByPatientId( $this->m_objPatient->getId(), $this->m_resPortalDatabase );

		$this->displayViewPatientPayments();
	}
	
	function handleInsertPayment() {
		
	}
	
	function handleDeletePatient() {
		
		require_once( EOS_PATH . 'CPatients.class.php' );
		require_once( EOS_PATH . 'CCustomerPathologyTestes.class.php' );
		require_once( EOS_PATH . 'CPatientPayments.class.php' );
		
		$this->m_objPatient 			= CPatients::fetchPatientById( $this->getRequestData( array( 'patients', 'id' )), $this->m_resPortalDatabase );
				
		$arrobjCustomerPathologyTests 	= CCustomerPathologyTests::fetchPahologyTestsByCustomerId( $this->m_objPatient->getId(), $this->m_resPortalDatabase );
		foreach ( $arrobjCustomerPathologyTests as $objCustomerPathologyTest ) {
			$objCustomerPathologyTest->delete( $this->m_resPortalDatabase );
		}
		
		$arrobjPatientPayments = CPatientPayments::fetchPatientPaymentsByPatientId( $this->m_objPatient->getId(), $this->m_resPortalDatabase );
		
		foreach( $arrobjPatientPayments as $objPatientPayment ) {
			$objPatientPayment->delete( $this->m_resPortalDatabase );
		}
		
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
	
	function handleMakeFinalized() {
		require_once( EOS_PATH . 'CPatients.class.php' );
		
		$arrintPatientIds = $this->getRequestData( array( 'patients', 'id' ));

		$arrobjPatients = CPatients::fetchPatientsByIds( $arrintPatientIds, $this->m_resPortalDatabase );
		
		foreach( $arrobjPatients as $objPatient ) {
			$objPatient->setIsFinalized(1);
			
			$objPatient->update($this->m_resPortalDatabase);
		}

		header( 'Location:' . $this->m_strBaseName . '?module=patients&action=view_patients&page=' . $this->getRequestData( array( 'page' ) ) );
	}
	
	function handleUpdatePatientPayments() {
		require_once( EOS_PATH . 'CPatients.class.php' );
		require_once( EOS_PATH . 'CPatientPayments.class.php' );
		
		$intPatientId 			= $this->getRequestData( array( 'patients', 'id' ));
		$this->m_objPatient 	= CPatients::fetchPatientById( $intPatientId, $this->m_resPortalDatabase );		
		$objPatientPayment 		= new CPatientPayment();
		
		$objPatientPayment->setPatientId( $intPatientId );
		$objPatientPayment->setIsPreviousBalance( 0 );
		
		if( date( 'Y-m-d' ) != $this->m_objPatient->getReceivedDate() ) {
			$objPatientPayment->setIsPreviousBalance( 1 );
		}
		
		$objPatientPayment->setAmount( $this->getRequestData( array( 'patient_payments', 'amount' ) ) );
		$objPatientPayment->setCreatedOn( date( 'Y-m-d' ) );

		$objPatientPayment->insert( $this->m_resPortalDatabase );
		
		$fltUpdatedBalance 		= $this->m_objPatient->getBalanceAmt() - $objPatientPayment->getAmount();
		$fltUpdatedReceivedAmt 	= $this->m_objPatient->getReceivedAmt() + $objPatientPayment->getAmount();
		
		$this->m_objPatient->setBalanceAmt( $fltUpdatedBalance );
		$this->m_objPatient->setReceivedAmt( $fltUpdatedReceivedAmt );

		$this->m_objPatient->update( $this->m_resPortalDatabase );
		
		header( 'Location:' . $this->m_strBaseName . '?module=patients&action=view_patient_payments&patient_id=' . $intPatientId );
	}
	
	function handleCreateFormf() {
		require_once( EOS_PATH . 'CPatients.class.php' );
		require_once( EOS_PATH . 'CDoctors.class.php' );
		
		$this->m_objPatient = CPatients::fetchPatientById( $this->getRequestData( array( 'patient', 'id' )), $this->m_resPortalDatabase );
		$this->m_objDoctor 	= CDoctors::fetchDoctorById( $this->m_objPatient->getDoctorId(), $this->m_resPortalDatabase );
		
		$this->displayCreateFormF();
	}
	
	function handleUpdateFormf() {
		
		require_once( EOS_PATH . 'CPatients.class.php' );
		require_once( EOS_PATH . 'CPatientPayments.class.php' );
		
		$intPatientId 			= $this->getRequestData( array( 'patients', 'id' ));
		$this->m_objPatient 	= CPatients::fetchPatientById( $intPatientId, $this->m_resPortalDatabase );		
		
		$this->m_objPatient->applyRequestForm( $this->getRequestData( array( 'patients' )));
		$this->m_objPatient->update( $this->m_resPortalDatabase );
		
		header( 'Location:' . $this->m_strBaseName . '?module=patients&action=view_patient_payments&patient_id=' . $intPatientId );
	}
	
	function handleShowBill() {
	
		require_once( EOS_PATH . 'CPatients.class.php' );
		require_once( EOS_PATH . 'CUser.class.php');
		require_once( EOS_PATH . 'CDoctors.class.php' );
		require_once( EOS_PATH . 'CPatientPayments.class.php' );

		$this->m_objPatient = CPatients::fetchPatientById( $this->getRequestData( array( 'patients', 'id' )), $this->m_resPortalDatabase );
		$arrobjTests 		= $this->m_objPatient->fetchPathologyTests( $this->m_resPortalDatabase );

		if( true == is_array( $arrobjTests ) && 0 < sizeof( $arrobjTests ) ) {
			$arrobjPathTests 	= rekeyObjects( 'Id', $arrobjTests );
		}
		
		$this->m_objPatient->setPathologyTests( $arrobjPathTests );
				
		$strContents = file_get_contents( ADMIN_PORTAL_TEMPLATES . 'patients/show_bill.tpl' );
		
		$arrPaterns = array( '/bill-no/', '/date/', '/patient-name/', '/total/');
		$arrReplacements = array( $this->m_objPatient->getId()
								 ,$this->m_objPatient->getReceivedDate()
								 ,$this->m_objPatient->getFirstName() . ' ' . $this->m_objPatient->getFirstName()
								 ,$this->m_objPatient->getReceivedAmt()  );
		
		$strContents = preg_replace($arrPaterns, $arrReplacements, $strContents);		
	
		file_put_contents('d:\clinic_ghatge\bills\\' . $this->m_objPatient->getId() . '_bill.html', $strContents);
		
		$output = exec('wkhtmltopdf ' . ' d:\clinic_ghatge\bills\\' . $this->m_objPatient->getId() . '_bill.html' . ' d:\clinic_ghatge\bills\\' . $this->m_objPatient->getId() . '_bill.pdf');
		unlink('D:\clinic_ghatge\bills\\' . $this->m_objPatient->getId() . '_bill.html');		
		exit;                
	}
        
    function handlePrintBill(){
		$this->displayPrintBill();
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
		$objSmarty->assign_by_ref( 'search_filter' , $this->m_objSearchFilter );
		
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
		$objSmarty->assign_by_ref( 'customer_pathology_tests', $this->m_objPatient->getPathologyTests() );
				
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
		$objSmarty->assign( 'page', $this->getRequestData( array( 'page' ) ) );
		
		$content = $objSmarty->fetch( 'patients/add_patient.tpl' );
		
		$objSmarty->assign_by_ref( 'content' , $content );

		
		$objSmarty->display( 'common/layout.tpl' );
	}
	
	function displayAddPatientReport() {
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
		
		$objSmarty->assign_by_ref( 'patient', $this->m_objPatient );
		$objSmarty->assign_by_ref( 'doctor', $this->m_objDoctor );
		$objSmarty->assign_by_ref( 'patientReportTemplate', $this->m_objPatientReportTemplate );
		
		
		$objSmarty->assign( 'url', 'update_patient' );
		$objSmarty->assign( 'page', $this->getRequestData( array( 'page' ) ) );
		
		$content = $objSmarty->fetch( 'patients/add_patient_report.tpl' );
		
		$objSmarty->assign_by_ref( 'content' , $content );

		
		$objSmarty->display( 'common/layout.tpl' );
	}

	function displayViewPatientPayments() {
		
		require_once( SMARTY_LIB . 'CSmarty.class.php' );		

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
	
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
		
		$objSmarty->assign_by_ref( 'patient', $this->m_objPatient );
		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
		$objSmarty->assign_by_ref( 'doctor' , $this->m_objDoctor );
		$objSmarty->assign_by_ref( 'patient_payments' , $this->m_objPatientPayments );
		
		$objSmarty->assign( 'page', $this->getRequestData( array( 'page' ) ) );
		
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}
		
		$content = $objSmarty->fetch( 'patients/view_patient_payments.tpl' );
		
		$objSmarty->assign_by_ref( 'content', $content );
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
	
	function displayCreateFormF() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
		
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );

		$objSmarty->assign_by_ref( 'patient', $this->m_objPatient );
		$objSmarty->assign_by_ref( 'doctor', $this->m_objDoctor );
		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
		
		$content = $objSmarty->fetch( 'patients/create_formf.tpl' );
		
		$objSmarty->assign_by_ref( 'content', $content);
		$objSmarty->display( 'common/layout.tpl' );
	}
	
function displayViewShowBill() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );
                
       	$objSmarty->display( 'patients/show_bill.tpl' );

	}
        
        function displayPrintBill(){
            require_once( SMARTY_LIB . 'CSmarty.class.php' );

			$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
			$this->assignSmartyData( $objSmarty );
                
            $objSmarty->display( 'patients/show_bill.tpl' );
        }
}