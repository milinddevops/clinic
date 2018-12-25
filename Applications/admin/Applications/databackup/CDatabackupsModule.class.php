<?php

require_once( APP_ADMIN_PORTAL . 'CAdminApp.class.php' );

class CDatabackupsModule extends CAdminApp {

	protected $m_objDatabackup;
	protected $m_arrobjDatabackups;
	
	/*******************************************************************
	 ************************* Framework Functions **********************
	 *******************************************************************/
	
	function initialize() {		
		parent::initialize();
		
		$this->m_strSelectedTab = 'backup';
	}
	
	function create() {
		parent::create();
	}
	function execute() {
		
		switch ( $this->getRequestAction() ) {	
	
			case NULL:
			case 'view_databackup':
				$this->handleViewDatabackups();
				break;
								
			case 'create_databackup':
				$this->handleCreateDatabackup();
				break;

			case 'insert_databackup':
				$this->handleInsertDatabackup();
				break;
				
			case 'restore_databackup':
				$this->handleRestoreDatabackups();
				break;
		}
	}
	
	
	/*******************************************************************
	 ************************* Handle Functions **********************
	 *******************************************************************/
	
	function handleViewDatabackups() {
		require_once( EOS_PATH . 'CDatabackups.class.php' );
		
		$this->m_arrobjDatabackups = CDatabackups::fetchAllDatabackups( $this->m_resPortalDatabase );
		
		$this->displayDatabackups();
	}
	
	function handleCreateDatabackup() {
		
		$this->displayCreateDatabackup();
	}

	function handleInsertDatabackup() {
		require_once( EOS_PATH . 'CDatabackup.class.php' );		
		require_once( EOS_PATH . 'CDatabackups.class.php' );
		
		$this->m_objDatabackup	= new CDatabackup();
				
		$this->m_objDatabackup->applyRequestForm( $this->getRequestData( array( 'databackup' )));
		$this->m_objDatabackup->setCreatedOn( date( 'Y-m-d' ) );
		$arrtables = fetchAllTables();
				
		//cycle through
		foreach($arrtables as $table ) {
			
			if( 'doctor_percentage' == $table || 'databackups' == $table ) {
				continue;
			}
			
			$strSql = 'SELECT * FROM ' . $table . ';';

			if( 'pathology_tests' != $table &&  'test_types' != $table &&  'users' != $table &&  'user_permissions' != $table &&  'doctors' != $table ) {
				$strSql = 'SELECT * FROM ' . $table . ' WHERE created_on >= \'' . $this->m_objDatabackup->getStartDate() . '\' AND created_on <= \'' . $this->m_objDatabackup->getEndDate() . '\';';
				$strDeleteQuery = 'DELETE FROM ' . $table . ' WHERE created_on >= \'' . $this->m_objDatabackup->getStartDate() . '\' AND created_on <= \'' . $this->m_objDatabackup->getEndDate() . '\';' . "\n";
			}
			
			if( 'patients' == $table ) {
				$strSql = 'SELECT * FROM patients WHERE recieved_on >= \'' . $this->m_objDatabackup->getStartDate() . '\' AND recieved_on <= \'' . $this->m_objDatabackup->getEndDate() . '\';';
				$strDeleteQuery = 'DELETE FROM ' . $table . ' WHERE recieved_on >= \'' . $this->m_objDatabackup->getStartDate() . '\' AND recieved_on <= \'' . $this->m_objDatabackup->getEndDate() . '\';' . "\n";
			}

			if( 0 == strlen( trim( $strSql ) ) ) {
				continue;
			}
			
			$result = mysql_query( $strSql, $this->m_resPortalDatabase );
			
			$num_fields = mysql_num_fields( $result );
			
			$arrCreteTableSql = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
			$strCreteTableSql = str_replace( 'CREATE TABLE', 'CREATE TABLE IF NOT EXISTS', $arrCreteTableSql[1] );
			
			$strContent.= "--CRTSRT \n" . $strCreteTableSql . "; \n--CRTEND\n --RPSRT\n ";

			for ($i = 0; $i < $num_fields; $i++) {
				while($row = mysql_fetch_row($result)){
					$strContent .= 'REPLACE INTO ' . $table .' VALUES(';
					for($j=0; $j<$num_fields; $j++)	{
						$row[$j] = addslashes($row[$j]);
						$row[$j] = str_replace("\n","\\n",$row[$j]);
						if (isset($row[$j])) { $strContent .= '"'.$row[$j].'"' ; } else { $strContent .= '""'; }
						if ($j<($num_fields-1)) { $strContent .= ','; }
					}
					$strContent .= ");\n";
				}
			}
			$strContent .= "--RPEND\n";

			//delete backedup data.
			//$result = runQuery( $strDeleteQuery, $this->m_resPortalDatabase );
		}

		//save file
		file_put_contents( BACKUP_PATH . 'data_backup_on_' . date( 'Ymd', strtotime( $this->m_objDatabackup->getCreatedOn() ) ) . '.sql', $strContent );

		$this->m_objDatabackup->setBackupFile( 'data_backup_on_' . date( 'Ymd', strtotime( $this->m_objDatabackup->getCreatedOn() ) ) . '.sql' );
		
		if( false == $this->m_objDatabackup->insert( $this->m_resPortalDatabase )) {					
			break;
		}
		
		header( 'Location:' . $this->m_strBaseName . '?module=databackup' );
		exit;
	}
	
	function handleRestoreDatabackups() {
		require_once( EOS_PATH . 'CDatabackups.class.php' );
		
		$objDatabackup 	= CDatabackups::fetchDatabackupById( $this->getRequestData( array( 'databackups', 'id' ) ), $this->m_resPortalDatabase );
		$fileContent 	= file_get_contents( BACKUP_PATH . $objDatabackup->getBackupFile() );

		$matches = array();
		preg_match('/--CRTSRT((.)*)--CRTEND/', $url, $matches);
display($matches);exit;
/*		$arrTableStructures = explode( '@@', $fileContent );
		$arrReplaceQuery 	= explode( '@@@', $fileContent );
		display($arrReplaceQuery);exit;
		$strSql = '';
		$intctr = 1;
		foreach( $arrFileContent as $fileContent ) {
			if( 0 != strlen( trim( $fileContent ) ) ) {
				$intctr ++;
				display($fileContent);
				//$result = runQuery( $fileContent, $this->m_resPortalDatabase );				
			}
		}
exit;*/
		//Delete restored databackup entry
		//$objDatabackup->delete( $this->m_resPortalDatabase );
		//unlink( 'd:\clinic\data\\' . $objDatabackup->getBackupFile() );
		
		$this->handleViewDatabackups();
		
	}
	/*******************************************************************
	 ************************* Other Functions **********************
	 *******************************************************************/
	
	function loadExitTags() {
		parent::loadExitTags();		
	}
	
	/*******************************************************************
	 *********	**************** Display Functions **********************
	 *******************************************************************/
	
	function displayCreateDatabackup( $boolIsDataBackup = false ) {
		
		require_once( SMARTY_LIB . 'CSmarty.class.php' );

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
		
		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
		
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}
		
		$objSmarty->assign_by_ref( 'exit_tags', $this->m_arrExitTags );
		
		$objSmarty->assign_by_ref( 'error_msgs', $this->m_objUser->m_strErrorMsgs );
		
		$objSmarty->assign_by_ref( 'is_data_backup', $boolIsDataBackup );

		$content = $objSmarty->fetch( 'databackups/create_databackup.tpl' );
		
		$objSmarty->assign( 'content', $content );
				
		$objSmarty->display( 'common/layout.tpl' );
	}
	
	function displayDatabackups() {
		require_once( SMARTY_LIB . 'CSmarty.class.php' );

		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();
		
		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
		
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}
		
		$objSmarty->assign_by_ref( 'exit_tags', $this->m_arrExitTags );
		$objSmarty->assign_by_ref( 'error_msgs', $this->m_objUser->m_strErrorMsgs );
		$objSmarty->assign_by_ref( 'databackups', $this->m_arrobjDatabackups );
				
		$content = $objSmarty->fetch( 'databackups/view_databackups.tpl' );
		
		$objSmarty->assign( 'content', $content );
				
		$objSmarty->display( 'common/layout.tpl' );
	}
}