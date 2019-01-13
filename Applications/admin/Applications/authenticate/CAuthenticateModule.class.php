<?php

require_once( APP_ADMIN_PORTAL . 'CAdminApp.class.php' );
require_once( EOS_PATH . 'CUser.class.php' );

class CAuthenticateModule extends CAdminApp {
	
	/*******************************************************************
	 ************************* Framework Functions **********************
	 *******************************************************************/
	
	function initialize() {		
		return true;
	}
	
	function create() {
		parent::create();
	}
	function execute() {
		
		switch ( $this->getRequestAction() ) {	
	
			case NULL:
			case 'login':
				$this->handleLogin();
				break;	
			case 'login_attempt':
				$this->handleLoginAttempt();
				break;
			case 'logout_user':
				$this->handleLogoutUser();
				break;
		}
	}
	
	
	/*******************************************************************
	 ************************* Handle Functions **********************
	 *******************************************************************/
	
	function handleLogin() {				
//		$this->m_objUser = CUser::createUser();
		
		$this->displayLogin();
	}
	
	function handleLoginAttempt() {
		
		$this->m_objUser = CUser::createUser();
		
		$this->m_objUser->applyRequestForm( $this->getRequestData( array( 'user' )));
		
		$objTempUser = $this->m_objUser->login( $this->m_resPortalDatabase );


		if( false == is_null( $objTempUser ) && true == ( $objTempUser instanceof CUser )) {
			
			$this->setSessionData( 'user_id', $objTempUser->getId());
			$this->setSessionData( 'username', $objTempUser->getUsername());			
			$this->setSessionData( 'objUser', serialize( $objTempUser ));			

			$this->m_objUser = clone $objTempUser;

			if( false == is_null( $this->m_objUser )) {			
				header( 'Location:' . $this->m_strBaseName . '/?module=dashboard' );
			}
		}

		$this->displayLogin();
	}
	
	function handleLogoutUser() {		
		if( false == is_null( $this->getSessionData( 'user_id' ))) {			
			session_destroy();			
			header( 'Location:' . $this->m_strBaseName );
		}exit;
	}
	
	/*******************************************************************
	 ************************* Other Functions **********************
	 *******************************************************************/
	
	function loadExitTags() {
		parent::loadExitTags();		
	}
	
	/*******************************************************************
	 ************************* Display Functions **********************
	 *******************************************************************/
	
	function displayLogin() {
		
		require_once( SMARTY_LIB . 'CSmarty.class.php' );

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES_NEW );
		
		$this->loadExitTags();
		
		$objSmarty->assign_by_ref( 'exit_tags', $this->m_arrExitTags );
		
		$objSmarty->assign_by_ref( 'error_msgs', $this->m_objUser->m_strErrorMsgs );
		$objSmarty->assign_by_ref( 'user', $this->m_objUser );
		
		$content = $objSmarty->fetch( 'authenticate/login.tpl' );
		
		$objSmarty->assign( 'content', $content );
				
		$objSmarty->display( 'common/home.tpl' );
	}
}