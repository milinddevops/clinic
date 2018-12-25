<?php

	class CFrameWorkApp {
		
		protected $m_strRequestAction;
		protected $m_strRequestModule;
				
		protected $m_requestData;
		protected $m_postData;
		protected $m_sessionData;
		protected $m_cookieData;
		
		protected $m_resPortalDatabase;
				
		/*******************************************************************
		 ************************* Set Function **************************** 
		 *******************************************************************/
		
		public function setRequestAction( $strActionName ) {
			$this->m_strRequestAction = $strActionName;
		}
		
		public function setRequestModule( $strRequestModule ) {
			$this->m_strRequestModule = $strRequestModule;
		}
		
		public function setSessionData( $key, $value ) {
			$_SESSION[$key] = $value;			
		}
		
		public function setRequestData( $key, $value ) {
			$_REQUEST[$key] = $value;
		}
		
		/*******************************************************************
		 ************************* Get Function **************************** 
		 *******************************************************************/
		
		public function getRequestAction() {
			return $this->m_strRequestAction;
		}
		
		public function getRequestModule() {
			return $this->m_strRequestModule;
		}
		
		public function getSessionData( $key ) {						
			if( isset( $_SESSION[$key] )) {
				return $_SESSION[$key];
			}else {
				return false;
			}
		}
		
		public function getNewSessionData( $arrData ) {
			if( 1 == sizeof( $arrData )) {
				return $_REQUEST[$arrData[0]];
			}elseif( 2 == sizeof( $arrData )) {
				return $_REQUEST[$arrData[0]][$arrData[1]];
			}
		}
		public function getRequestData( $arrData ) {
			if( 1 == sizeof( $arrData )) {
				return $_REQUEST[$arrData[0]];
				
			}elseif( 2 == sizeof( $arrData )) {
				return $_REQUEST[$arrData[0]][$arrData[1]];
			}
			
		}
		/*******************************************************************
		 ************************* Framework Function **********************
		 *******************************************************************/
		function create() {
			
			$this->setRequestAction( REQUEST_ACTION );
			$this->setRequestModule( REQUEST_MODULE );		
		}
		
		function execute() {
			return true;
		}
				
		function initialize() {
			return true;
		}
		
		function finalize() {
			return true;
		}
		
		function render() {
			return true;
		}
		
		function distroy() {
			return true;
		}
		
		/*******************************************************************
		 ************************* DB Function *****************************
		 *******************************************************************/
		
		public function createDatabase() {
			require_once( APP_FRAMEWORK_CLASSES . '/base/CBaseDatabase.class.php' );
			
			$this->m_resPortalDatabase = CBaseDatabase::loadPortalDb();
		}				
	}

?>