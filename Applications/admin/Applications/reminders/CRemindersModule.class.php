<?php
require_once( APP_ADMIN_PORTAL . 'CAdminApp.class.php' );

class CRemindersModule extends CAdminApp {
	
	protected $m_arrobjReminders;
	protected $m_objReminder;
	
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
		
		$this->m_strSelectedTab = 'reminders';		
	}
	
	function execute() {
		parent::execute();
		
		switch ( $this->getRequestAction() ) {		
					
			case NULL:
			case 'view_reminders':
				$this->handleViewReminders();
				break;
				
			case 'add_reminder':
				$this->handleAddReminder();
				break;
				
			case 'insert_reminder':
				$this->handleInsertReminder();
				break;
				
			case 'edit_reminder':
				$this->handleEditReminder();
				break;
				
			case 'update_reminder':
				$this->handleUpdateReminder();
				break;
				
			case 'search_reminders':
				$this->handleSearchReminders();
				break;
				
			case 'delete_reminder':
				$this->handleDeleteReminder();
				break;
		}
	}
	
	/*******************************************************************
	 ************************* Handle Function **********************
	 *******************************************************************/
		
	function handleViewReminders() {
		
		require_once( EOS_PATH . 'CReminders.class.php' );
		require_once( EOS_PATH . 'CUser.class.php' );
				
		$this->m_arrobjReminders = CReminders::fetchAllReminders( $this->m_resPortalDatabase );
		
		$this->displayViewReminders();	
	}
	
	function handleAddReminder() {
		require_once( EOS_PATH . 'CUser.class.php' );
		require_once( EOS_PATH . 'CReminder.class.php' );
		
		$this->m_objReminder = new CReminder(); 
		
		$this->displayAddReminder();
	}
	
	function handleInsertReminder() {
		require_once( EOS_PATH . 'CReminder.class.php' );		
		
		$this->m_objReminder	= new CReminder();
				
		$this->m_objReminder->applyRequestForm( $this->getRequestData( array( 'reminder' )));
		
		switch( NULL ) {
			default:				
				$boolIsValid = true;
				
				$boolIsValid &= $this->m_objReminder->validate( 'INSERT', $this->m_resPortalDatabase );
				
				if( false == $boolIsValid ) {
					break;
				}
				
				if( false == $this->m_objReminder->insert( $this->m_resPortalDatabase )) {					
					break;
				}
				
				header( 'Location:' . $this->m_strBaseName . '?module=reminders&action=view_reminders' );
		}
		
		$this->displayAddReminder();
	}
	
	function handleEditReminder() {
		require_once( EOS_PATH . 'CReminders.class.php' );
				
		$this->m_objReminder = CReminders::fetchReminderById( $this->getRequestData( array( 'reminder', 'id' ) ), $this->m_resPortalDatabase );
		
		$this->displayEditReminder();
	}
		
	function handleUpdateReminder() {
		require_once( EOS_PATH . 'CReminders.class.php' );		
		
		$this->m_objReminder = CReminders::fetchReminderById( $this->getRequestData( array( 'reminder', 'id' ) ), $this->m_resPortalDatabase );
				
		$this->m_objReminder->applyRequestForm( $this->getRequestData( array( 'reminder' ) ) );
		
		switch( NULL ) {
			default:				
				$boolIsValid = true;
				
				$boolIsValid &= $this->m_objReminder->validate( 'UPDATE', $this->m_resPortalDatabase );
				
				if( false == $boolIsValid ) {
					break;
				}
				
				if( false == $this->m_objReminder->update( $this->m_resPortalDatabase )) {					
					break;
				}
				
				header( 'Location:' . $this->m_strBaseName . '?module=reminders&action=view_reminders' );
		}
		
		$this->displayEditReminder();
	}
	
	function handleSearchReminders() {
		require_once( EOS_PATH . 'CReminders.class.php' );
		require_once( EOS_PATH . 'CUser.class.php' );
								
		$this->m_arrobjReminders = CReminders::fetchRemindersBySearchText( $this->getRequestData( array( 'reminder', 'search_text' ) ), $this->m_resPortalDatabase );
				
		$this->displayViewReminders();
	}
	
	function handleDeleteReminder() {
		require_once( EOS_PATH . 'CReminders.class.php' );
		
		$this->m_objReminder = CReminders::fetchReminderById( $this->getRequestData( array( 'reminder', 'id' ) ), $this->m_resPortalDatabase );
		$this->m_objReminder->delete( $this->m_resPortalDatabase );		
		
		header( 'Location:' . $this->m_strBaseName . '?module=reminders&action=view_reminders' );
		exit;
	}
	/*******************************************************************
	 ************************* Display Function **********************
	 *******************************************************************/
	
	function displayViewReminders() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
		
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
		
		$objSmarty->assign_by_ref( 'selected_tab' ,	 	$this->m_strSelectedTab );
		$objSmarty->assign_by_ref( 'reminders' ,	 	$this->m_arrobjReminders );
		
								
		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
					
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}
		
		$content = $objSmarty->fetch( 'reminders/view_reminders.tpl' );
		
		$objSmarty->assign_by_ref( 'content', $content );
				
		$objSmarty->display( 'common/layout.tpl' );
	}
	
	function displayAddReminder() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
	
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
		
		$objSmarty->assign_by_ref( 'selected_tab',	 	$this->m_strSelectedTab );
		$objSmarty->assign_by_ref( 'reminder',	 		$this->m_objReminder );
		

		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
				
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}

		$objSmarty->assign_by_ref( 'selected_user', $this->m_objUser );
		
		$content = $objSmarty->fetch( 'reminders/add_reminder.tpl' );
		
		$objSmarty->assign_by_ref( 'content', $content );
		$objSmarty->display( 'common/layout.tpl' );
	}
	
	function displayEditReminder() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
	
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
		
		$objSmarty->assign_by_ref( 'selected_tab',	 	$this->m_strSelectedTab );
		$objSmarty->assign_by_ref( 'reminder',	 		$this->m_objReminder );
		

		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
				
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}

		$objSmarty->assign_by_ref( 'selected_user', $this->m_objUser );
		
		$content = $objSmarty->fetch( 'reminders/add_reminder.tpl' );
		
		$objSmarty->assign_by_ref( 'content', $content );
		$objSmarty->display( 'common/layout.tpl' );
	}
}