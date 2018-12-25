<?php

require_once( APP_ADMIN_PORTAL . 'CAdminApp.class.php' );

class CDashboardModule extends CAdminApp {

	protected $m_arrobjReminders;
	protected $m_arrintCounts;
	protected $m_intCurrentDayPatientPayments;
	protected $m_intPreviousDayPatientPayments;
	protected $m_intExpencesAmount;
	
	protected $m_strXml;
	
	function __construct() {
		
	}

	/*******************************************************************
	 ************************* Framework Function **********************
	 *******************************************************************/
	
	function create() {
		parent::create();
		
		require_once( EOS_PATH . 'CUsers.class.php' );
		
		$this->m_arrobjUsers = CUsers::fetchAllUsers( $this->m_resPortalDatabase );
	}
	
	function initialize() {
		parent::initialize();
		
		require_once( EOS_PATH . 'CUser.class.php' );
		
		$this->m_strSelectedTab = 'dashboard';		
	}
	function execute() {
		parent::execute();
		
		switch ( $this->getRequestAction() ) {		
					
			case NULL:
			case 'view_dashboard':
				$this->handleViewDashboard();
				break;
		}
	}
	
	/*******************************************************************
	 ************************* Handle Function **********************
	 *******************************************************************/
	
	function handleViewDashboard() {
		require_once( EOS_PATH 	. 'CReminders.class.php' );
		require_once( EOS_PATH  . 'CCustomerPathologyTestes.class.php' );
		require_once( EOS_PATH . 'CPatientPayments.class.php' );
		require_once( EOS_PATH . 'CExpences.class.php' );
		
		$strDate = date( 'Y-m-d' );
		
		$this->m_arrobjReminders = CReminders::fetchRemindersByCurrentDate( $strDate, $this->m_resPortalDatabase );
		
		$this->m_arrintCounts['pathology'] 	= CCustomerPathologyTests::fetchCustomerCountsByDateRangeByTestTypeId( $strDate, $strDate, 1, $this->m_resPortalDatabase );
		$this->m_arrintCounts['usg'] 		= CCustomerPathologyTests::fetchCustomerCountsByDateRangeByTestTypeId( $strDate, $strDate, 2, $this->m_resPortalDatabase );
		$this->m_arrintCounts['xray'] 		= CCustomerPathologyTests::fetchCustomerCountsByDateRangeByTestTypeId( $strDate, $strDate, 3, $this->m_resPortalDatabase );

		$this->generatePieChart();
		
		$this->m_intCurrentDayPatientPayments 	= CPatientPayments::fetchTotalCurrentDayPatientPaymentsByCreatedOn( date( 'Y-m-d' ), $this->m_resPortalDatabase );
		$this->m_intPreviousDayPatientPayments 	= CPatientPayments::fetchTotalPreviousDayPatientPaymentsByCreatedOn( date( 'Y-m-d' ), $this->m_resPortalDatabase );	
		$this->m_intExpencesAmount 				= CExpences::fetchCurrentDayExpencesAmount( date( 'Y-m-d' ), $this->m_resPortalDatabase );
		
		$this->displayViewDashboard();
	}
	
	/*******************************************************************
	 ************************* Display Function **********************
	 *******************************************************************/
	function displayViewDashboard() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );
				
		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
		
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
		
		$objSmarty->assign_by_ref( 'reminders', $this->m_arrobjReminders );
		$objSmarty->assign_by_ref( 'xml', $this->m_strXml );
		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
		$objSmarty->assign_by_ref( 'counts', $this->m_arrintCounts );
		
		$objSmarty->assign_by_ref( 'current_day_patient_payments', $this->m_intCurrentDayPatientPayments );
		$objSmarty->assign_by_ref( 'previous_day_patient_payments', $this->m_intPreviousDayPatientPayments );
		$objSmarty->assign_by_ref( 'expences', $this->m_intExpencesAmount );
		

		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}
		
		$content = $objSmarty->fetch( 'dashboard/view_dashboard.tpl' );
		$objSmarty->assign_by_ref( 'content', $content );
		$objSmarty->display( 'common/layout.tpl' );
	}	
	
	/*******************************************************************
	 ************************* Other Function **********************
	 *******************************************************************/
	function generatePieChart() {
		require_once( EOS_PATH  . 'CCustomerPathologyTestes.class.php' );
		
		$strFirstDate 	= date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date(Y)));
		$strLastDate 	= date('Y-m-t', mktime(0, 0, 0, date('m'), 1, date(Y)));

		$strPathologyData 	= CCustomerPathologyTests::fetchCustomerCountsByDateRangeByTestTypeId( $strFirstDate, $strLastDate, 1, $this->m_resPortalDatabase );
		$strSonographyData 	= CCustomerPathologyTests::fetchCustomerCountsByDateRangeByTestTypeId( $strFirstDate, $strLastDate, 2, $this->m_resPortalDatabase );
		$strXRayData 		= CCustomerPathologyTests::fetchCustomerCountsByDateRangeByTestTypeId( $strFirstDate, $strLastDate, 3, $this->m_resPortalDatabase );

		//Initialize <graph> element
		//$this->m_strXml = "<chart caption='Patient Counts' subcaption='For " . date( 'dS M Y', strtotime( $strFirstDate )) . " To " . date( 'dS M Y', strtotime( $strLastDate )) . " ' palette='1' animation='1' formatNumberScale='0' numberPrefix='' pieSliceDepth='25' startingAngle='150' rotation='1'>";
		$this->m_strXml = "<chart caption='Patient Counts' subcaption='For " . date( 'dS M Y', strtotime( $strFirstDate )) . " To " . date( 'dS M Y', strtotime( $strLastDate )) . "' palette='2' animation='1' formatNumberScale='0' numberPrefix='' pieSliceDepth='30' startingAngle='125'>";
						
		//Initiate <dataset> elements
		$strDataSonography 	= '<set label=\'Sonography\' value=\'' . $strSonographyData[0]['customers'] . '\'/>';
		$strDataPathology 	= '<set label=\'Pathology\' value=\'' . $strPathologyData[0]['customers'] . '\'/>';
		$strDataXRay 		= '<set label=\'X-Ray\' value=\'' . $strXRayData[0]['customers'] . '\'/>';
				
		//Assemble the entire XML now
		$this->m_strXml .= $strDataSonography . $strDataPathology . $strDataXRay . '</chart>';
	}
	
	function loadExitTags() {
		parent::loadExitTags();		
	}
}