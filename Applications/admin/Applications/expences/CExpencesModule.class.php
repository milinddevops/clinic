<?php
require_once( APP_ADMIN_PORTAL . 'CAdminApp.class.php' );

class CExpencesModule extends CAdminApp {
	
	protected $m_arrobjExpences;
	protected $m_objExpence;
	
	function __construct() {
		
	}
	
	/*******************************************************************
	 ************************* Framework Function **********************
	 *******************************************************************/
	
	function create() {
		parent::create();
	}
	
	function initialize() {
		parent::initialize();
		
		$this->m_strSelectedTab = 'expences';		
	}
	
	function execute() {
		parent::execute();
		
		switch ( $this->getRequestAction() ) {		
					
			case NULL:
			case 'view_current_date_expences':
				$this->handleViewCurrentDateExpences();
				break;

			case 'view_expences':
				$this->handleViewExpences();
				break;
				
			case 'add_expence':
				$this->handleAddExpence();
				break;
				
			case 'insert_expence':
				$this->handleInsertExpence();
				break;

			case 'edit_expence':
				$this->handleEditExpence();
				break;
			
			case 'update_expence':
				$this->handleUpdateExpence();
				break;
				
			case 'search_expences':
				$this->handleSearchExpence();
				break;
				
			case 'delete_expence':
				$this->handleDeleteExpence();
				break;
		}
	}
	
	/*******************************************************************
	 ************************* Handle Function **********************
	 *******************************************************************/
		
	function handleViewCurrentDateExpences() {
		
		require_once( EOS_PATH . 'CExpences.class.php' );
		require_once( EOS_PATH . 'CUser.class.php' );
		
		$strDate = date( 'Y-m-d' );
		
		$this->m_arrobjExpences = CExpences::fetchExpencesByCurrentDate( $strDate, $this->m_resPortalDatabase );
		
		$this->displayViewCurrentDateExpences();	
	}
	
	function handleViewExpences() {
		
		require_once( EOS_PATH . 'CExpences.class.php' );
		require_once( EOS_PATH . 'CUser.class.php' );
				
		$this->m_arrobjExpences = CExpences::fetchAllExpences( $this->m_resPortalDatabase );
		
		$this->displayViewExpences();	
	}
	
	function handleAddExpence() {
		require_once( EOS_PATH . 'CUser.class.php' );
		require_once( EOS_PATH . 'CExpence.class.php' );
		
		$this->m_objExpence = new CExpence(); 
		
		$this->displayAddExpence();
	}
	
	function handleInsertExpence() {
		require_once( EOS_PATH . 'CExpence.class.php' );		
		
		$this->m_objExpence	= new CExpence();
				
		$this->m_objExpence->applyRequestForm( $this->getRequestData( array( 'expence' )));
		
		switch( NULL ) {
			default:				
				$boolIsValid = true;
				
				$boolIsValid &= $this->m_objExpence->validate( 'INSERT', $this->m_resPortalDatabase );
				
				if( false == $boolIsValid ) {
					break;
				}
				
				if( false == $this->m_objExpence->insert( $this->m_resPortalDatabase )) {					
					break;
				}
				
				header( 'Location:' . $this->m_strBaseName . '?module=expences&action=view_current_date_expences' );
		}
		
		$this->displayAddExpence();
	}
	
	function handleEditExpence() {
		require_once( EOS_PATH . 'CExpences.class.php' );
				
		$this->m_objExpence = CExpences::fetchExpenceById( $this->getRequestData( array( 'expence', 'id' ) ), $this->m_resPortalDatabase );
		
		$this->displayEditExpence();
	}
	
	function handleUpdateExpence() {
		require_once( EOS_PATH . 'CExpences.class.php' );		
		
		$this->m_objExpence = CExpences::fetchExpenceById( $this->getRequestData( array( 'expence', 'id' ) ), $this->m_resPortalDatabase );
				
		$this->m_objExpence->applyRequestForm( $this->getRequestData( array( 'expence' ) ) );
		
		switch( NULL ) {
			default:				
				$boolIsValid = true;
				
				$boolIsValid &= $this->m_objExpence->validate( 'UPDATE', $this->m_resPortalDatabase );
				
				if( false == $boolIsValid ) {
					break;
				}
				
				if( false == $this->m_objExpence->update( $this->m_resPortalDatabase )) {					
					break;
				}
				
				header( 'Location:' . $this->m_strBaseName . '?module=expences&action=view_expences' );
		}
		
		$this->displayEditExpence();
	}
		
	function handleSearchExpence() {
		require_once( EOS_PATH . 'CExpences.class.php' );
		require_once( EOS_PATH . 'CUser.class.php' );
								
		$this->m_arrobjExpences = CExpences::fetchExpencesBySearchText( $this->getRequestData( array( 'expence', 'search_text' ) ), $this->m_resPortalDatabase );
				
		$this->displayViewExpences();
	}
	
	function handleDeleteExpence() {
		require_once( EOS_PATH . 'CExpences.class.php' );
		
		$this->m_objExpence = CExpences::fetchExpenceById( $this->getRequestData( array( 'expence', 'id' ) ), $this->m_resPortalDatabase );
		$this->m_objExpence->delete( $this->m_resPortalDatabase );		
		
		header( 'Location:' . $this->m_strBaseName . '?module=expences&action=view_expences' );
		exit;
	}
	/*******************************************************************
	 ************************* Display Function **********************
	 *******************************************************************/
	
	function displayViewCurrentDateExpences() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );
		

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
		
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
		
		$objSmarty->assign_by_ref( 'selected_tab' ,	 	$this->m_strSelectedTab );
		$objSmarty->assign_by_ref( 'expences' ,	 		$this->m_arrobjExpences );
		
								
		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
					
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}
		
		$content = $objSmarty->fetch( 'expences/view_current_date_expences.tpl' );
		
		$objSmarty->assign_by_ref( 'content', $content );
				
		$objSmarty->display( 'common/layout.tpl' );
	}
	
	function displayViewExpences() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );
		

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
		
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
		
		$objSmarty->assign_by_ref( 'selected_tab' ,	 	$this->m_strSelectedTab );
		$objSmarty->assign_by_ref( 'expences' ,	 		$this->m_arrobjExpences );
		
								
		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
					
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}
		
		$content = $objSmarty->fetch( 'expences/view_expences.tpl' );
		
		$objSmarty->assign_by_ref( 'content', $content );
				
		$objSmarty->display( 'common/layout.tpl' );
	}
	
	function displayAddExpence() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
	
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
		
		$objSmarty->assign_by_ref( 'selected_tab',	 	$this->m_strSelectedTab );
		$objSmarty->assign_by_ref( 'expence',	 		$this->m_objExpence );
		

		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
				
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}

		$objSmarty->assign_by_ref( 'selected_user', $this->m_objUser );
		
		$content = $objSmarty->fetch( 'expences/add_expence.tpl' );
		
		$objSmarty->assign_by_ref( 'content', $content );
		$objSmarty->display( 'common/layout.tpl' );
	}
	
	function displayEditExpence() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
	
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
		
		$objSmarty->assign_by_ref( 'selected_tab',	 	$this->m_strSelectedTab );
		$objSmarty->assign_by_ref( 'expence',	 		$this->m_objExpence );
		

		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
				
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}

		$objSmarty->assign_by_ref( 'selected_user', $this->m_objUser );
		
		$content = $objSmarty->fetch( 'expences/add_expence.tpl' );
		
		$objSmarty->assign_by_ref( 'content', $content );
		$objSmarty->display( 'common/layout.tpl' );
	}
}