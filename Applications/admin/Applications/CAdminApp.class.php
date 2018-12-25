<?php
/* 
 * This class file contains the App layer variables & functions.
 */
require_once( '../../defines.php' );
require_once( '../../Framework/defines.php' );
require_once( LIBRARIES . 'commonFunctions.php' );

require_once( APP_FRAMEWORK_CLASSES . 'CFrameWorkApp.class.php' ); 

class CAdminApp extends CFrameWorkApp {
		
	protected $m_objUser;
	protected $m_arrobjDoctors;
	
	protected $m_arrobjUserPermissions;

	protected $m_arrobjPathologyTests;

			
	protected $m_strBaseName;
	protected $m_strSelectedTab;
		
	/*******************************************************************
	 ************************* Framework Function **********************
	 *******************************************************************/
	
	function create() {	

		parent::create();

		$this->m_strBaseName = 'http://' . $_SERVER['HTTP_HOST'];

		//$this->checkActivation();

		session_start();
		
		$this->createDatabase();
				
		$this->m_arrobjUserPermissions = array();
		
		$this->loadUserPermissions( $this->m_resPortalDatabase );
		
		//display($this->m_arrobjUserPermissions);

	}
	
	function initialize() {
		parent::initialize();
		
		if( false == $this->getSessionData( 'objUser' ) ) {
			$this->m_objUser = unserialize( $this->getSessionData( 'objUser' ) );			
			header( 'Location:' . $this->m_strBaseName . '/?module=authenticate&action=login' );			
			exit;
		}
	}
	
	function execute() {
		parent::execute();						
	}

	/*******************************************************************
	 ************************* Other Function **********************
	 *******************************************************************/
	
	function loadExitTags() {		
		$this->m_arrExitTags = array(
			'dashboard' 					=> $this->m_strBaseName . '/?module=dashboard',
			'home' 							=> $this->m_strBaseName . '/?module=home',
			'activate' 						=> $this->m_strBaseName . '/?module=authenticate&action=activate',			
			'login' 						=> $this->m_strBaseName . '/?module=authenticate&action=login',
			'login_attempt'					=> $this->m_strBaseName . '/?module=authenticate&action=login_attempt',
			'view_patients'					=> $this->m_strBaseName . '/?module=patients&action=view_patients',
			'review_patients'				=> $this->m_strBaseName . '/?module=patients&action=review_patients',
			'view_current_day_patients'		=> $this->m_strBaseName . '/?module=patients&action=view_current_day_patients',
			'search_patient'				=> $this->m_strBaseName . '?module=patients&action=search_patient',
			'add_patient' 					=> $this->m_strBaseName . '/?module=patients&action=add_patient',
			'add_op_patient' 				=> $this->m_strBaseName . '/?module=patients&action=add_op_patient',
			'add_patient_report'			=> $this->m_strBaseName . '/?module=patients&action=add_patient_report',
			'create_formf' 					=> $this->m_strBaseName . '/?module=patients&action=create_formf',
			'update_formf' 					=> $this->m_strBaseName . '/?module=patients&action=update_formf',
			'update_patient'				=> $this->m_strBaseName . '/?module=patients&action=update_patient',
			'delete_patient'				=> $this->m_strBaseName . '/?module=patients&action=delete_patient',
			'edit_patient' 					=> $this->m_strBaseName . '/?module=patients&action=edit_patient',
			'view_patient_payments'			=> $this->m_strBaseName . '/?module=patients&action=view_patient_payments',
			'update_patient_payments'		=> $this->m_strBaseName . '/?module=patients&action=update_patient_payments',
			'make_finalized'				=> $this->m_strBaseName . '/?module=patients&action=make_finalized',
			'insert_payment'				=> $this->m_strBaseName . '/?module=patients&action=insert_payment',
			'insert_patient' 				=> $this->m_strBaseName . '/?module=patients&action=insert_patient',
			'insert_patient_report_template'=> $this->m_strBaseName . '/?module=patients&action=insert_patient_report_template',
			'add_doctor'					=> $this->m_strBaseName . '/?module=doctors&action=add_doctor',
			'view_doctors'					=> $this->m_strBaseName . '/?module=doctors&action=view_doctors',
			'insert_doctor'					=> $this->m_strBaseName . '/?module=doctors&action=insert_doctor',
			'edit_doctor'					=> $this->m_strBaseName . '/?module=doctors&action=edit_doctor',		
			'update_doctor'					=> $this->m_strBaseName . '/?module=doctors&action=update_doctor',
			'delete_doctor'					=> $this->m_strBaseName . '/?module=doctors&action=delete_doctor',
			'search_doctors'				=> $this->m_strBaseName . '/?module=doctors&action=search_doctors',			
			'create_report'					=> $this->m_strBaseName . '/?module=reports&action=create_report',
			'view_report'					=> $this->m_strBaseName . '/?module=reports&action=view_report',
			'logout_user'					=> $this->m_strBaseName . '/?module=authenticate&action=logout_user',
			'update_billing_info'			=> $this->m_strBaseName . '/?module=patients&action=update_billing_info',
			'print_view'					=> $this->m_strBaseName . '/?module=reports&action=print_view',
			'print_cut_report'				=> $this->m_strBaseName . '/?module=reports&action=print_cut_report',		
			'create_patient_statistics' 	=> $this->m_strBaseName . '/?module=statistics&action=create_statistics_report',
			'view_pathology_tests'			=> $this->m_strBaseName . '/?module=pathologyTests&action=view_pathology_tests',
			'create_test'					=> $this->m_strBaseName . '/?module=pathologyTests&action=create_test',
			'insert_test'					=> $this->m_strBaseName . '/?module=pathologyTests&action=insert_test',
			'update_test'					=> $this->m_strBaseName . '/?module=pathologyTests&action=update_test',
			'delete_test'					=> $this->m_strBaseName . '/?module=pathologyTests&action=delete_test',
			'get_tests'						=> $this->m_strBaseName . '/?module=pathologyTests&action=get_tests',
			'get_test'						=> $this->m_strBaseName . '/?module=pathologyTests&action=get_test',
			'get_lab_amt'					=> $this->m_strBaseName . '/?module=pathologyTests&action=get_lab_amt',
			'get_ref_amt'					=> $this->m_strBaseName . '/?module=pathologyTests&action=get_ref_amt',
			'remove_test'       			=> $this->m_strBaseName . '/?module=pathologyTests&action=remove_test',
			'remove_lab_amt'       			=> $this->m_strBaseName . '/?module=pathologyTests&action=remove_lab_amt',
			'remove_ref_amt'       			=> $this->m_strBaseName . '/?module=pathologyTests&action=remove_ref_amt',
			'search_patients'				=> $this->m_strBaseName . '/?module=home&action=search_patients',
			'clinic_statistics'				=> $this->m_strBaseName . '/?module=statistics&action=create_statistics_report',
			'view_clinical_tests'			=> $this->m_strBaseName . '/?module=clinical_tests&action=view_clinical_tests',
			'search_tests'					=> $this->m_strBaseName . '/?module=clinical_tests&action=search_tests',
			'add_test'						=> $this->m_strBaseName . '/?module=clinical_tests&action=add_test',
			'insert_test'					=> $this->m_strBaseName . '/?module=clinical_tests&action=insert_test',
			'update_test'					=> $this->m_strBaseName . '/?module=clinical_tests&action=update_test',
			'delete_test'					=> $this->m_strBaseName . '/?module=clinical_tests&action=delete_test',		
			'edit_clinical_test' 			=> $this->m_strBaseName . '/?module=clinical_tests&action=edit_clinical_test',
			'view_employees'				=> $this->m_strBaseName . '/?module=employees&action=view_employees',
			'load_employee'					=> $this->m_strBaseName . '/?module=employees&action=load_employee',
			'update_employee'				=> $this->m_strBaseName . '/?module=employees&action=update_employee',
			'view_current_date_expences'	=> $this->m_strBaseName . '/?module=expences&action=view_current_date_expences',
			'view_expences'					=> $this->m_strBaseName . '/?module=expences&action=view_expences',
			'add_expence'					=> $this->m_strBaseName . '/?module=expences&action=add_expence',			
			'insert_expence'				=> $this->m_strBaseName . '/?module=expences&action=insert_expence',
			'edit_expence'					=> $this->m_strBaseName . '/?module=expences&action=edit_expence',
			'update_expence'				=> $this->m_strBaseName . '/?module=expences&action=update_expence',
			'search_expences'				=> $this->m_strBaseName . '/?module=expences&action=search_expences',
			'delete_expence'				=> $this->m_strBaseName . '/?module=expences&action=delete_expence',
			'view_reminders'				=> $this->m_strBaseName . '/?module=reminders&action=view_reminders',
			'add_reminder'					=> $this->m_strBaseName . '/?module=reminders&action=add_reminder',
			'insert_reminder'				=> $this->m_strBaseName . '/?module=reminders&action=insert_reminder',
			'edit_reminder'					=> $this->m_strBaseName . '/?module=reminders&action=edit_reminder',
			'update_reminder'				=> $this->m_strBaseName . '/?module=reminders&action=update_reminder',
			'delete_reminder'				=> $this->m_strBaseName . '/?module=reminders&action=delete_reminder',
		    'databackup'					=> $this->m_strBaseName . '/?module=databackup&action=view_databackup',
			'create_databackup'				=> $this->m_strBaseName . '/?module=databackup&action=create_databackup',
			'insert_databackup'				=> $this->m_strBaseName . '/?module=databackup&action=insert_databackup',
			'upload_databackup'				=> $this->m_strBaseName . '/?module=databackup&action=upload_databackup',
			'restore_databackup'			=> $this->m_strBaseName . '/?module=databackup&action=restore_databackup',
		);
	}
	
	function assignSmartyData( $objSmarty ) {
		 $objSmarty->assign_by_ref( 'selected_tab', 	$this->m_strSelectedTab );
		 $objSmarty->assign_by_ref( 'user_permissions', $this->m_arrobjUserPermissions );
		 $objSmarty->assign_by_ref( 'action', $this->getRequestAction() );
	}
	
	function loadUserPermissions( $resDatabase ) {
		require_once( EOS_PATH . 'CUsers.class.php' );
		require_once( EOS_PATH . 'CUserPermissions.class.php' );
		
		$this->m_objUser = unserialize( $this->getSessionData( 'objUser' ) );
		
		if( true == is_object( $this->m_objUser ) ) {
			$arrobjUserPermissions = (array) CUserPermissions::fetchUserPermissionsByUserId( $this->m_objUser->getId(), $resDatabase );
			foreach ( $arrobjUserPermissions as $objUserPermission ) {
				$this->m_arrobjUserPermissions[$objUserPermission->getKey()] = $objUserPermission;
			}
		}		
	}

	function checkActivation() {

		$boolIsActivated = true;
		$this->createDatabase();

		$strSql = 'SELECT * FROM xyzz_view';
		$arrData = fetchData( $strSql, $this->m_resPortalDatabase );
		
		if( false == file_exists( trim( '../../' . $arrData['activation_key'] . '.key' ) ) ) {	
			$boolIsActivated = false;
		}

		if( false == $boolIsActivated ) {
			header( 'Location:' . $this->m_strBaseName . '/?module=activation&action=activate' );			
			exit;

		}
	}
}

?>