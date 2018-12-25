<?php
require_once( APP_ADMIN_PORTAL . 'CAdminApp.class.php' );

class CReportsModule extends CAdminApp {
	
	protected $m_objDoctor;
		
	function __construct() {
		
	}
	
	/*******************************************************************
	 ************************* Framework Function **********************
	 *******************************************************************/
	function initialize() {
		parent::initialize();
		
		$this->m_strSelectedTab = 'reports';
	}
	function execute() {
		parent::execute();
		
		switch ( $this->getRequestAction() ) {		
					
			case NULL:
			case 'create_report':
				$this->handleCreateReport();
				break;
			case 'view_report':
				$this->handleViewReport();
				break;
			case 'print_view':
				$this->handlePrintView();
				break;
				
			case 'print_cut_report':
				$this->handlePrintCUTReport();
				break;

		}
	}
	
	/*******************************************************************
	 ************************* Handle Function **********************
	 *******************************************************************/
	function handleCreateReport() {
		require_once( EOS_PATH . 'CDoctors.class.php' );
		require_once( EOS_PATH . 'CUser.class.php');
		
		$this->m_arrobjDoctors			= CDoctors::fetchDoctors( $this->m_resPortalDatabase );
		$this->displayCreateReport();
	}
	
	function handleViewReport() {
		
		require_once( EOS_PATH . 'CDoctors.class.php' );
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		
		if( false == is_null( $this->getRequestData( array( 'reports', 'month' ) ) ) ) {
			$strMonthNumber = $this->getRequestData( array( 'reports', 'month' ) );
			$strYearNumber  = $this->getRequestData( array( 'reports', 'year' ) );
			
			$strFirstDate   = date( 'Y-m-d', strtotime( '01-' . $strMonthNumber . '-' . $strYearNumber ) );			
			$strLastDate 	= date('Y-m-t', mktime(0, 0, 0, date('m', strtotime( $strFirstDate )), 1, $strYearNumber));
						
			$_REQUEST['reports']['start_date'] = $strFirstDate;
			$_REQUEST['reports']['end_date'] = $strLastDate;
		
		}

		if( 'all' != $this->getRequestData( array( 'reports', 'doctor_id' )) ) {			
			$this->m_objDoctor =  CDoctors::fetchDoctorById( $this->getRequestData( array( 'reports', 'doctor_id' )), $this->m_resPortalDatabase );					
			$arrobjPatients = $this->m_objDoctor->fetchPatientsByStartAndEndDate( $this->getRequestData( array( 'reports', 'start_date' )), $this->getRequestData( array( 'reports', 'end_date' )), $this->m_resPortalDatabase );				
			$this->m_objDoctor->setPatients( $arrobjPatients );
			$this->m_arrobjDoctors[$this->m_objDoctor->getId()] = $this->m_objDoctor;
						
		} elseif ( 'all' == $this->getRequestData( array( 'reports', 'doctor_id' )) ) {

			$this->m_arrobjDoctors = CDoctors::fetchReferingDoctors( $this->m_resPortalDatabase );
			$this->m_arrobjDoctors = rekeyObjects( 'Id' , $this->m_arrobjDoctors );
			$arrobjDoctors = array();

			foreach ( $this->m_arrobjDoctors as $objDoctor ) {
				$arrobjPatients = $objDoctor->fetchPatientsByStartAndEndDate( $this->getRequestData( array( 'reports', 'start_date' )), $this->getRequestData( array( 'reports', 'end_date' )), $this->m_resPortalDatabase );				
				$objDoctor->setPatients( $arrobjPatients );
				$this->m_arrobjDoctors[$objDoctor->getId()] = $objDoctor;
			}

		}

		$this->displayViewReport();
	} 
	
	function handlePrintView() {
		require_once( EOS_PATH . 'CDoctors.class.php' );
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		
		if( 0 != $this->getRequestData( array( 'reports', 'doctor_id' )) && 'all' != $this->getRequestData( array( 'reports', 'doctor_id' )) ) {
			$this->m_objDoctor =  CDoctors::fetchDoctorById( $this->getRequestData( array( 'reports', 'doctor_id' )), $this->m_resPortalDatabase );			
			$this->m_objDoctor->m_arrobjPatients = $this->m_objDoctor->fetchPatientsByStartAndEndDate( $this->getRequestData( array( 'reports', 'start_date' )), $this->getRequestData( array( 'reports', 'end_date' )), $this->m_resPortalDatabase );
			$this->m_arrobjDoctors[$this->m_objDoctor->getId()] = $this->m_objDoctor;
		} elseif ( 'all' == $this->getRequestData( array( 'reports', 'doctor_id' )) ) {
			$this->m_arrobjDoctors = CDoctors::fetchDoctors( $this->m_resPortalDatabase );
			$this->m_arrobjDoctors = rekeyObjects( 'Id' , $this->m_arrobjDoctors );
			$arrobjDoctors = array();
			foreach ( $this->m_arrobjDoctors as $objDoctor ) {				
				$arrobjPatients = $objDoctor->fetchPatientsByStartAndEndDate( $this->getRequestData( array( 'reports', 'start_date' )), $this->getRequestData( array( 'reports', 'end_date' )), $this->m_resPortalDatabase );				
				$objDoctor->setPatients( $arrobjPatients );
				$this->m_arrobjDoctors[$objDoctor->getId()] = $objDoctor;
			}
		}
		
		$this->displayPrintView();
	}
	
	function handlePrintCUTReport() {
		
		require_once( EOS_PATH . 'CDoctors.class.php' );
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		
		if( 'all' != $this->getRequestData( array( 'reports', 'doctor_id' )) ) {			
			$this->m_objDoctor =  CDoctors::fetchDoctorById( $this->getRequestData( array( 'reports', 'doctor_id' )), $this->m_resPortalDatabase );			
			$arrobjPatients = $this->m_objDoctor->fetchPatientsByStartAndEndDate( $this->getRequestData( array( 'reports', 'start_date' )), $this->getRequestData( array( 'reports', 'end_date' )), $this->m_resPortalDatabase );				
			$this->m_objDoctor->setPatients( $arrobjPatients );		
						
		} elseif ( 'all' == $this->getRequestData( array( 'reports', 'doctor_id' )) ) {
			$this->m_arrobjDoctors = CDoctors::fetchDoctors( $this->m_resPortalDatabase );
			$this->m_arrobjDoctors = rekeyObjects( 'Id' , $this->m_arrobjDoctors );
			$arrobjDoctors = array();
			foreach ( $this->m_arrobjDoctors as $objDoctor ) {				
				$arrobjPatients = $objDoctor->fetchPatientsByStartAndEndDate( $this->getRequestData( array( 'reports', 'start_date' )), $this->getRequestData( array( 'reports', 'end_date' )), $this->m_resPortalDatabase );				
				$objDoctor->setPatients( $arrobjPatients );
				$this->m_arrobjDoctors[$objDoctor->getId()] = $objDoctor;
			}
		}		
	}
	
	/*******************************************************************
	 ************************* Display Function **********************
	 *******************************************************************/
	
	function displayCreateReport() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );
		require_once( EOS_PATH . 'CUser.class.php');

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
		$objSmarty->assign_by_ref( 'doctors', $this->m_arrobjDoctors );
		
		$content = $objSmarty->fetch( 'reports/create_report.tpl' );
		
		$objSmarty->assign_by_ref( 'content' , $content );
		
		$objSmarty->display( 'common/layout.tpl' );		
	}
	
	function displayViewReport() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );
		require_once( EOS_PATH . 'CUser.class.php');

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
		$objSmarty->assign_by_ref( 'doctors', $this->m_arrobjDoctors );
		$objSmarty->assign_by_ref( 'doctor', $this->m_objDoctor );		
		$objSmarty->assign( 'start_date', $this->getRequestData( array( 'reports', 'start_date' )) );
		$objSmarty->assign( 'end_date', $this->getRequestData( array( 'reports', 'end_date' )) );
		$objSmarty->assign_by_ref( 'report_data', $this->getRequestData( array( 'reports' )));
		
		$content = $objSmarty->fetch( 'reports/view_report.tpl' );
		
		$objSmarty->assign_by_ref( 'content' , $content );
		
		$objSmarty->display( 'common/layout.tpl' );
	}
	
	function displayPrintView() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );
		require_once( EOS_PATH . 'CUser.class.php');

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
		$objSmarty->assign_by_ref( 'doctors', $this->m_arrobjDoctors );		
				
		$objSmarty->assign( 'start_date', $this->getRequestData( array( 'reports', 'start_date' )) );
		$objSmarty->assign( 'end_date', $this->getRequestData( array( 'reports', 'end_date' )) );
				
		$objSmarty->display( 'reports/print_view.tpl' );
	}
}