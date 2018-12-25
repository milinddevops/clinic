<?php
require_once( APP_ADMIN_PORTAL . 'CAdminApp.class.php' );

class CEmployeesModule extends CAdminApp {

	protected $m_objSelectedUser;
	protected $m_arrobjUsers;
	protected $m_arrObjUserPermissions;
	protected $m_arrobjRekyedUserPermissions;
	
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
		
		$this->m_strSelectedTab = 'employees';		
	}
	function execute() {
		parent::execute();
		
		switch ( $this->getRequestAction() ) {		
					
			case NULL:
			case 'view_employees':
				$this->handleViewEmployees();
				break;
				
			case 'load_employee':
				$this->handleLoadEmployee();
				break;
			
			case 'update_employee':
				$this->handleUpdateEmployee();
				break;
		}
	}
	
	
	/*******************************************************************
	 ************************* Handle Function **********************
	 *******************************************************************/
		
	function handleViewEmployees() {
		
		require_once( EOS_PATH . 'CUsers.class.php' );
		require_once( EOS_PATH . 'CUser.class.php' );
		require_once( EOS_PATH . 'CUserPermissions.class.php' );
		
		if( false == is_null( $this->getRequestData( array( 'user', 'id' ) ) ) ) {			
			$this->m_objSelectedUser = CUsers::fetchUserById( $this->getRequestData( array( 'user', 'id' ) ), $this->m_resPortalDatabase );
			
		} else {
			$this->m_objSelectedUser = CUsers::fetchUserById( $this->m_objUser->getId(), $this->m_resPortalDatabase );
		}
		
		
		$arrObjUserPermissions 	= CUserPermissions::fetchUserPermissionsByUserId( $this->m_objSelectedUser->getId(), $this->m_resPortalDatabase );
		
		if( true == is_array( $arrObjUserPermissions ) ) {

			foreach ( $arrObjUserPermissions as $objUserPermission ) {
				$arrObjUserPermissions[$objUserPermission->getKey()] = $objUserPermission;
			}
		}
		//display($this->m_arrobjRekyedUserPermissions);exit;
		$this->displayViewEmployees( $arrObjUserPermissions );	
	}
	
	function handleLoadEmployee() {
		require_once( EOS_PATH . 'CUsers.class.php' );
		require_once( EOS_PATH . 'CUserPermissions.class.php' );
		
		$this->m_objUser 				= CUsers::fetchUserById( $this->getRequestData( array( 'user', 'id' ) ), $this->m_resPortalDatabase );
		$this->m_arrObjUserPermissions 	= CUserPermissions::fetchUserPermissionsByUserId( $this->m_objUser->getId(), $this->m_resPortalDatabase );
		
		if( true == is_array( $this->m_arrObjUserPermissions ) ) {

			foreach ( $this->m_arrObjUserPermissions as $objUserPermission ) {
				$this->m_arrobjRekyedUserPermissions[$objUserPermission->getKey()] = $objUserPermission;
			}
		}
		
		$this->displayEmployee();
	}
	
	function handleUpdateEmployee() {
		require_once( EOS_PATH . 'CUsers.class.php' );
		require_once( EOS_PATH . 'CUserPermissions.class.php' );
		
		$this->m_objSelectedUser 	   = CUsers::fetchUserById( $this->getRequestData( array( 'users', 'id' ) ), $this->m_resPortalDatabase );
		$this->m_arrObjUserPermissions = CUserPermissions::fetchUserPermissionsByUserId( $this->m_objSelectedUser->getId(), $this->m_resPortalDatabase );
		
		$this->m_objSelectedUser->applyRequestForm( $this->getRequestData( array( 'users' ) ) );
		$arrUserPermissions =  $this->getRequestData( array( 'user_permissions' ) );

		switch( NULL ) {
			default:				
				$boolIsValid = true;
				
				$boolIsValid &= $this->m_objSelectedUser->validate( 'UPDATE', $this->m_resPortalDatabase );
				
				if( false == $boolIsValid ) {
					break;
				}
				
				if( true == is_array( $this->m_arrObjUserPermissions ) ) {
					foreach ( $this->m_arrObjUserPermissions as $objUserPermission ) {
						$objUserPermission->delete( $this->m_resPortalDatabase );
					}
				}				
				
				if( true == $this->m_objSelectedUser->update( $this->m_resPortalDatabase )) {
					
					foreach ( $arrUserPermissions as $key => $arrUserPermission ) {
						
						if( false == is_null( $arrUserPermission[$key] ) && 0 != $arrUserPermission[$key] ) {
							$objUserPermission = new CUserPermission();
						
							$objUserPermission->setUserId( $this->m_objSelectedUser->getId() );
							$objUserPermission->setKey( $key );
							$objUserPermission->setValue( $arrUserPermission[$key] );
							
							$objUserPermission->insert( $this->m_resPortalDatabase );
						}
					}					
				}
				
				//$this->m_objSelectedUser->addSuccessMsgs( 'Employee updated successfully...' );

				//$this->displayViewEmployees();
				header( 'Location:' . $this->m_strBaseName . '/?module=employees&action=view_employees&user[id]=' . $this->m_objSelectedUser->getId() );
		}
	}
	
	
	/*******************************************************************
	 ************************* Display Function **********************
	 *******************************************************************/
	
	function displayViewEmployees( $arrObjUserPermissions ) {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );
		

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
		
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
		
		$objSmarty->assign_by_ref( 'selected_tab' ,	 	$this->m_strSelectedTab );
		$objSmarty->assign_by_ref( 'selected_user', 	$this->m_objSelectedUser );
		$objSmarty->assign_by_ref( 'selected_user_permissions', 	$arrObjUserPermissions );
						
		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
					
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}
		
		$content = $objSmarty->fetch( 'employees/view_employees.tpl' );
		
		$objSmarty->assign_by_ref( 'content', $content );
		$objSmarty->assign_by_ref( 'users', $this->m_arrobjUsers );
		
		$objSmarty->display( 'common/layout.tpl' );
	}
	
	function displayEmployee() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );
		

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
	
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
		
		$objSmarty->assign_by_ref( 'selected_tab' ,	 $this->m_strSelectedTab );

		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
		$objSmarty->assign_by_ref( 'user_permissions', 	$this->m_arrobjRekyedUserPermissions );
			
		
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}

		$objSmarty->assign_by_ref( 'selected_user', $this->m_objUser );
		
		$objSmarty->display( 'employees/view_employee.tpl' );
	}
}