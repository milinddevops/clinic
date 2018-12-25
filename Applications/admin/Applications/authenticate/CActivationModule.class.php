<?php

require_once( APP_ADMIN_PORTAL . 'CAdminApp.class.php' );
require_once( EOS_PATH . 'CUser.class.php' );

class CActivationModule extends CAdminApp {
	
	/*******************************************************************
	 ************************* Framework Functions **********************
	 *******************************************************************/
	
	function initialize() {		
		return true;
	}
	
	function create() {
		//parent::create();
	}
	function execute() {

		$this->handleActivation();
	}
	
	
	/*******************************************************************
	 ************************* Handle Functions **********************
	 *******************************************************************/
	
	function handleActivation() {

		$this->displayActivation();
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

		$this->displayActivation();
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
	
	function displayActivation() {
		
		require_once( SMARTY_LIB . 'CSmarty.class.php' );

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->loadExitTags();
		
		$objSmarty->assign_by_ref( 'exit_tags', $this->m_arrExitTags );
		
		$strBaseName = 'http://' . $_SERVER['HTTP_HOST'];
		
		$objSmarty->assign_by_ref( 'basename', $strBaseName );
		
		$content = $objSmarty->fetch( 'authenticate/activate.tpl' );
		
		$objSmarty->assign( 'content', $content );
				
		$objSmarty->display( 'common/home.tpl' );
	}
}