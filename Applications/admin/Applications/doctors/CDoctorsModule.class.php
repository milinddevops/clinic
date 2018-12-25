<?php
require_once( APP_ADMIN_PORTAL . 'CAdminApp.class.php' );

class CDoctorsModule extends CAdminApp {
		
	protected $m_objDoctor;
	protected $m_objDoctorPercentages;
		
	function __construct() {
		
	}

	/*******************************************************************
	 ************************* Framework Function **********************
	 *******************************************************************/
	function initialize() {
		parent::initialize();
		
		require_once( EOS_PATH . 'CUser.class.php');
		
		$this->m_strSelectedTab = 'doctors';
	}
	function execute() {
		parent::execute();
		
		switch ( $this->getRequestAction() ) {		
					
			case NULL:
			case 'view_doctors':
				$this->handleViewDoctors();
				break;
				
			case 'add_doctor':
				$this->handleAddDoctor();
				break;
				
			case 'insert_doctor':
				$this->handleInsertDoctor();
				break;

			case 'edit_doctor':
				$this->handleEditDoctor();
				break;
				
			case 'update_doctor':
				$this->handleUpdateDoctor();
				break;
				
			case 'delete_doctor':
				$this->handleDeleteDoctor();
				break;
			
			case 'search_doctors':
				$this->handleSearchDoctor();
				break;
		}
	}
	
	/*******************************************************************
	 ************************* Handle Function **********************
	 *******************************************************************/
	
	function handleViewDoctors() {
		require_once( EOS_PATH . 'CDoctors.class.php' );
		require_once( EOS_PATH . 'CUser.class.php');
		
		$this->m_arrobjDoctors			= CDoctors::fetchDoctors( $this->m_resPortalDatabase );
		
		$this->displayViewDoctors();
	}
	function handleAddDoctor() {
		require_once( EOS_PATH . 'CPathologyTests.class.php' );
		require_once( EOS_PATH . 'CDoctors.class.php' );
		require_once( EOS_PATH . 'CUser.class.php');
		
		$this->m_arrobjPathologyTests 	= CPathologyTests::fetchAllPathologyTests( $this->m_resPortalDatabase );
		$this->m_arrobjDoctors			= CDoctors::fetchDoctors( $this->m_resPortalDatabase );
		
		$this->displayAddDoctor();
	}
	
	function handleInsertDoctor() {
						
		require_once( EOS_PATH . 'CDoctor.class.php' );		
		require_once( EOS_PATH . 'CDoctorPercentages.class.php' );
		
		$this->m_objDoctor	= new CDoctor();
				
		$this->m_objDoctor->applyRequestForm( $this->getRequestData( array( 'doctors' )));
		//$this->m_objDoctorPercentage->applyRequestForm( $this->getRequestData( array( 'doctor_percentages' )));
		$arrRequestData = $this->getRequestData( array( 'doctor_percentages' ) );
		
		for( $i=1;$i<=3;$i++ ) {
			$objDoctorPercentage = new CDoctorPercentage();
			$objDoctorPercentage->setDoctorId( $this->m_objDoctor->getId() );
			$objDoctorPercentage->setTestTypeId( $i );
			$objDoctorPercentage->setPercentage( $arrRequestData[$i] );

			$this->m_objDoctorPercentages[] = $objDoctorPercentage;
		}

		switch( NULL ) {
			default:				
				$boolIsValid = true;
				
				$boolIsValid &= $this->m_objDoctor->validate( 'INSERT', $this->m_resPortalDatabase );
				
				if( false == $boolIsValid ) {
					break;
				}
				
				if( false == $this->m_objDoctor->insert( $this->m_resPortalDatabase )) {					
					break;
				}
				
				foreach( $this->m_objDoctorPercentages as $objDoctorPercentage ) {
					$objDoctorPercentage->setDoctorId( $this->m_objDoctor->getId() );	
											
					$objDoctorPercentage->insertOrUpdate( $this->m_resPortalDatabase );					
				}
				
				header( 'Location:' . $this->m_strBaseName . '?module=doctors&action=view_doctors' );
		}
		
		$this->displayAddDoctor();
	}
	
	function handleEditDoctor() {
		require_once( EOS_PATH . 'CDoctors.class.php' );
		require_once( EOS_PATH . 'CDoctorPercentages.class.php' );
				
		$this->m_objDoctor 				= CDoctors::fetchDoctorById( $this->getRequestData( array( 'doctors', 'id' ) ), $this->m_resPortalDatabase );
		$this->m_objDoctorPercentages 	= (array) CDoctorPercentages::fetchDoctorPercentagesByDoctorId( $this->getRequestData( array( 'doctors', 'id' ) ), $this->m_resPortalDatabase );
		$this->m_objDoctorPercentages 	= rekeyObjects( 'TestTypeId', $this->m_objDoctorPercentages );
				
		$this->displayEditDoctor();
	}
	
	function handleUpdateDoctor() {
		require_once( EOS_PATH . 'CDoctors.class.php' );		
		require_once( EOS_PATH . 'CDoctorPercentages.class.php' );
		
		$this->m_objDoctor 				= CDoctors::fetchDoctorById( $this->getRequestData( array( 'doctors', 'id' ) ), $this->m_resPortalDatabase );
		$this->m_objDoctorPercentages 	= (array) CDoctorPercentages::fetchDoctorPercentagesByDoctorId( $this->getRequestData( array( 'doctors', 'id' ) ), $this->m_resPortalDatabase );
		$this->m_objDoctorPercentages 	= rekeyObjects( 'id', $this->m_objDoctorPercentages );

		$this->m_objDoctor->applyRequestForm( $this->getRequestData( array( 'doctors' ) ) );
		
		$arrRequestData = $this->getRequestData( array( 'doctor_percentages' ) );

		if( 0 == count( $this->m_objDoctorPercentages ) ) {
			
			for( $i=1;$i<=3;$i++ ) {
				$objDoctorPercentage = new CDoctorPercentage();
				$objDoctorPercentage->setDoctorId( $this->m_objDoctor->getId() );
				$objDoctorPercentage->setTestTypeId( $i );
				$objDoctorPercentage->setPercentage( $arrRequestData[$i] );

				$this->m_objDoctorPercentages[] = $objDoctorPercentage;
			}
			
		} else {		
			/*foreach( $this->m_objDoctorPercentages as $objDoctorPercentage ) {
				$arrValues = array( array( 'doctor_id' => $objDoctorPercentage->getDoctorId(), 'test_type_id' => $objDoctorPercentage->getTestTypeId(), 'percentage' => $arrRequestData[$objDoctorPercentage->getTestTypeId()], 'id' => $objDoctorPercentage->getId()),
									array( 'doctor_id' => $objDoctorPercentage->getDoctorId(), 'test_type_id' => $objDoctorPercentage->getTestTypeId(), 'percentage' => $arrRequestData[$objDoctorPercentage->getTestTypeId()], 'id' => $objDoctorPercentage->getId()), 
									array( 'doctor_id' => $objDoctorPercentage->getDoctorId(), 'test_type_id' => $objDoctorPercentage->getTestTypeId(), 'percentage' => $arrRequestData[$objDoctorPercentage->getTestTypeId()], 'id' => $objDoctorPercentage->getId()));
				display($arrValues);exit;
				$objDoctorPercentage->applyRequestForm( $arrValues );
			}*/			
			foreach( $this->m_objDoctorPercentages as $objDoctorPercentage ) {
				$arrValues = array( 'doctor_id' => $objDoctorPercentage->getDoctorId(), 'test_type_id' => $objDoctorPercentage->getTestTypeId(), 'percentage' => $arrRequestData[$objDoctorPercentage->getTestTypeId()], 'id' => $objDoctorPercentage->getId());
				
				$objDoctorPercentage->applyRequestForm( $arrValues );
			}
		}

		$this->m_objDoctor->applyRequestForm( $this->getRequestData( array( 'doctors' ) ) );
		
		switch( NULL ) {
			default:				
				$boolIsValid = true;
				
				$boolIsValid &= $this->m_objDoctor->validate( 'UPDATE', $this->m_resPortalDatabase );
				
				if( false == $boolIsValid ) {
					break;
				}
				
				if( false == $this->m_objDoctor->update( $this->m_resPortalDatabase )) {					
					break;
				}

				foreach( $this->m_objDoctorPercentages as $objDoctorPercentage ) {							
					$objDoctorPercentage->insertOrUpdate( $this->m_resPortalDatabase );					
				}
				
				header( 'Location:' . $this->m_strBaseName . '?module=doctors&action=view_doctors' );
		}
		
		$this->displayEditDoctor();
	}
	
	function handleDeleteDoctor() {
		require_once( EOS_PATH . 'CDoctors.class.php' );
		
		$this->m_objDoctor = CDoctors::fetchDoctorById( $this->getRequestData( array( 'doctors', 'id' ) ), $this->m_resPortalDatabase );
		$this->m_objDoctor->delete( $this->m_resPortalDatabase );		
		
		header( 'Location:' . $this->m_strBaseName . '?module=doctors&action=view_doctors' );
		exit;
		
	}
	
	function handleSearchDoctor() {
		require_once( EOS_PATH . 'CDoctors.class.php' );
		require_once( EOS_PATH . 'CUser.class.php');
						
		$this->m_arrobjDoctors 	= CDoctors::fetchDoctorsByText( $this->getRequestData( array( 'doctor', 'search_text' ) ), $this->m_resPortalDatabase );		
		$this->m_objUser 		= $this->getSessionData( 'objUser' );
				
		$this->displayViewDoctors();
	}
	
	/*******************************************************************
	 ************************* Display Function **********************
	 *******************************************************************/

	function displayViewDoctors() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );
		

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
	
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
				
		$objSmarty->assign_by_ref( 'doctors', $this->m_arrobjDoctors );
		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
		
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}
		
		$content = $objSmarty->fetch( 'doctors/view_doctors.tpl' );
		
		$objSmarty->assign_by_ref( 'content', $content );
		$objSmarty->display( 'common/layout.tpl' );
	}
	function displayAddDoctor() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
	
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
				
		$objSmarty->assign_by_ref( 'doctors', $this->m_arrobjDoctors );
		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
		
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}
		
		$content = $objSmarty->fetch( 'doctors/add_doctor.tpl' );
		
		$objSmarty->assign_by_ref( 'content', $content );
		$objSmarty->display( 'common/layout.tpl' );
	}
	
	function displayEditDoctor() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
	
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
				
		$objSmarty->assign_by_ref( 'doctor', 				$this->m_objDoctor );
		$objSmarty->assign_by_ref( 'objUser', 				unserialize( $this->getSessionData( 'objUser' )));
		$objSmarty->assign_by_ref( 'doctor_percentages', 	$this->m_objDoctorPercentages );		
		
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}
		
		$content = $objSmarty->fetch( 'doctors/edit_doctor.tpl' );
		
		$objSmarty->assign_by_ref( 'content', $content );
		$objSmarty->display( 'common/layout.tpl' );
	}
}