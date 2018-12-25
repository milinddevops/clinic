<?php

require_once( APP_ADMIN_PORTAL . 'CAdminApp.class.php' );

class CHomeModule extends CAdminApp {

	protected $m_arrobjPatients;
	protected $m_arrobjExpences;
	protected $m_fltTotalPreviousBalance;
		
	function __construct() {
		
	}

	/*******************************************************************
	 ************************* Framework Function **********************
	 *******************************************************************/
	
	function initialize() {
		parent::initialize();

		require_once( EOS_PATH 	. 'CDoctors.class.php' );
		require_once( LIBRARIES . 'searchFilters/CSearchFilter.class.php' );
		
		$this->m_arrobjDoctors 		= CDoctors::fetchDoctors( $this->m_resPortalDatabase );
		$this->m_arrobjDoctors 		= rekeyObjects( 'Id', $this->m_arrobjDoctors );
		
		if( true == $this->getSessionData( 'search_filter' ) ) {
			$this->m_objSearchFilter = unserialize( $this->getSessionData( 'search_filter' ) );
		} else {
			$this->m_objSearchFilter = new CSearchFilter();
		}
	}
	
	function execute() {
		parent::execute();
		
		$this->m_strSelectedTab = 'home';
		
		switch ( $this->getRequestAction() ) {		
					
			case NULL:
			case 'home':
				$this->handleHome();
				break;	

			case 'search_patients':
				$this->handleSearchPatients();
				break;
		}
	}
	
	/*******************************************************************
	 ************************* Handle Function **********************
	 *******************************************************************/
	
	function handleHome() {		
		
		require_once( EOS_PATH . 'CUser.class.php' );
		require_once( EOS_PATH . 'CPatients.class.php' );
		require_once( EOS_PATH . 'CExpences.class.php' );
		
		$strDate = date( 'Y-m-d' );
				
		$this->m_arrobjPatients 			= CPatients::fetchAllCurrentDatePatients( $strDate, $this->m_resPortalDatabase );
		$this->m_arrobjExpences				= CExpences::fetchExpencesByCurrentDate( $strDate, $this->m_resPortalDatabase );
		$this->m_fltTotalPreviousBalance 	= CPatients::fetchCurrentDateTotalReceivedPreviousBalanceAmount( $strDate, $this->m_resPortalDatabase );

		$this->m_objUser = $this->getSessionData( 'objUser' );
		
		$this->displayHome();
	}
	
	function handleSearchPatients() {
		
		require_once( EOS_PATH . 'CPatients.class.php' );
		
		$strDate = date( 'Y-m-d' );
		
		$intPageNo 		= 1;
		$intPageLimit 	= 10;
		
		if( false == is_null( $this->getRequestData( array( 'page' ) ) ) ) {
			$intPageNo = $this->getRequestData( array( 'page' ) );
		}
		$intOffset = ( $intPageNo - 1 ) * $intPageLimit;
		
		$this->m_objSearchFilter->setSearchText( $this->getRequestData( array( 'patients', 'search_text' ) ) );
		$this->m_arrobjPatients = CPatients::fetchCurrentDatePaginatedPatientsBySearchText( $this->m_objSearchFilter, $strDate, $intOffset, $intPageLimit, $this->m_resPortalDatabase );
		
		$this->m_objUser 		= $this->getSessionData( 'objUser' );
		
		$this->displayHome();
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
	
	function displayHome() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );
		require_once( EOS_PATH . 'CUser.class.php' );
		
		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
		
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
	
		$objSmarty->assign_by_ref( 'patients', $this->m_arrobjPatients );
		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
		$objSmarty->assign_by_ref( 'doctors' , $this->m_arrobjDoctors );
		$objSmarty->assign_by_ref( 'expences', $this->m_arrobjExpences );
		$objSmarty->assign_by_ref( 'page', $this->getRequestData( array( 'page' ) ) );
		$objSmarty->assign_by_ref( 'total_previous_balance', $this->m_fltTotalPreviousBalance );
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}
		
		$objSmarty->assign( 'search_text', $this->getRequestData( array( 'patients', 'search_text' ) ) ); 
		
		$content = $objSmarty->fetch( 'home/home.tpl' );
		$objSmarty->assign_by_ref( 'content', $content );
		$objSmarty->display( 'common/layout.tpl' );
	} 
}
?>