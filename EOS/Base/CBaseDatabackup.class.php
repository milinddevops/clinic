<?php

class CBaseDatabackup {
	
	protected $m_intId;
	protected $m_strBackupFile;
	protected $m_strStartDate;
	protected $m_strEndDate;
	protected $m_strCreatedOn;
	
	/*******************************************************************
	 ************************* Set Functions **********************
	 *******************************************************************/
	
	public function setId( $value ) {
		$this->m_intId = $value;
	}
	
	public function setBackupFile( $value ) {
		$this->m_strBackupFile = $value;
	}
	
	public function setStartDate( $value ) {
		$this->m_strStartDate = $value;
	}
	
	public function setEndDate( $value ) {
		$this->m_strEndDate = $value;
	}
	
	public function setCreatedOn( $value ) {
		$this->m_strCreatedOn = $value;
	}

	/*******************************************************************
	 ************************* Get Functions **********************
	 *******************************************************************/
	
	public function getId() {
		return $this->m_intId;
	}
	
	public function getBackupFile() {
		return $this->m_strBackupFile;
	}
	
	public function getStartDate() {
		return $this->m_strStartDate;
	}
	
	public function getEndDate() {
		return $this->m_strEndDate;
	}
		
	public function getCreatedOn() {
		return $this->m_strCreatedOn;
	}

	/*******************************************************************
	 ************************* Other Functions **********************
	 *******************************************************************/

	public function setValues( $arrValues ) {		
		( $arrValues['start_date'] )?  $this->setStartDate( $arrValues['start_date'] ):$this->setStartDate( NULL );
		( $arrValues['end_date'] )?  $this->setEndDate( $arrValues['end_date'] ):$this->setEndDate( NULL );
		( $arrValues['backup_file'] )?  $this->setBackupFile( $arrValues['backup_file'] ):$this->setBAckupFile( NULL );
		( $arrValues['created_on'] )?  $this->setCreatedOn( $arrValues['created_on'] ):$this->setCreatedOn( NULL );
		( $arrValues['id'] )?  $this->setId( $arrValues['id'] ):$this->setId( NULL );		
	}
	
	
	public function applyRequestForm( $arrData ) {
		if( true == is_array( $arrData ) && 0 < sizeof( $arrData )) {
			$this->setValues( $arrData );
		}		
	}
	
	public function insert( $resDatabase ) {
		$strSql = 'INSERT INTO databackups ( 
			start_date,
			end_date,			
			backup_file,
			created_on
		) VALUES (
			"' . $this->getStartDate() . '",
			"' . $this->getEndDate() . '",			
			"' . $this->getBackupFile() . '",
			 CURDATE()
		)';

		if( mysql_query( $strSql, $resDatabase )) {
			$this->setId( mysql_insert_id( $resDatabase ) );						
			return true;
		}
		return false;
	}
	
	public function update( $resDatabase ) {
		$strSql = 'UPDATE databackups SET start_date = "' . $this->getStartDate() . '",
				end_date = "' . $this->getEndDate() . '",
				backup_file = "' . $this->getBackupFile() . '",
				WHERE id = ' . (int) $this->getId();

		if( mysql_query( $strSql, $resDatabase )) {			
			return true;
		}
		return false;
	}
	
	public function delete( $resDatabase ) {
		$strSql = 'DELETE FROM databackups WHERE id = ' . (int) $this->getId();

		if( mysql_query( $strSql, $resDatabase )) {			
			return true;
		}
		
		return false;
	}
}
?>