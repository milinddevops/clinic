<?php

class CBaseReminder {
	
	protected $m_intId;
	protected $m_strDescription;
	protected $m_strAlertOn;
	protected $m_strCreatedOn;
	
	/*******************************************************************
	 ************************* Set Functions **********************
	 *******************************************************************/
	
	public function setId( $value ) {
		$this->m_intId = $value;
	}
	
	public function setDescription( $value ) {
		$this->m_strDescription = $value; 
	}
	
	public function setAlertOn( $value ) {
		$this->m_strAlertOn = $value;
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
	
	public function getDescription() {
		return $this->m_strDescription;
	}
	
	public function getAlertOn() {
		return $this->m_strAlertOn;
	}
	
	public function getCreatedOn() {
		return $this->m_strCreatedOn;
	}
	
	/*******************************************************************
	 ************************* Fetch Functions **********************
	 *******************************************************************/	
	
	
	/*******************************************************************
	 ************************* Other Functions **********************
	 *******************************************************************/
	
	public function setValues( $arrValues ) {
				
		( $arrValues['description'] )?  $this->setDescription( $arrValues['description'] ):$this->setDescription( NULL );
		( $arrValues['alert_on'] )?  $this->setAlertOn( $arrValues['alert_on'] ):$this->setAlertOn( NULL );		
		( $arrValues['created_on'] )?  $this->setCreatedOn( $arrValues['created_on'] ):$this->setCreatedOn( NULL );
		( $arrValues['id'] )?  $this->setId( $arrValues['id'] ):$this->setId( NULL );	
	}
	
	public function applyRequestForm( $arrData ) {		
		if( true == is_array( $arrData ) && 0 < sizeof( $arrData )) {
			$this->setValues( $arrData );
		}		
	}
	
	public function insert( $resDatabase ) {
		$strSql = 'INSERT INTO reminders (
			description, 
			alert_on,
			created_on
		) VALUES (
			"' . $this->getDescription() . '",
			"' . $this->getAlertOn() . '",
			"' . date( 'Y-m-d' ) . '"
		)';

		if( mysql_query( $strSql, $resDatabase )) {
			$this->setId( mysql_insert_id( $resDatabase ) );
						
			return true;
		}
		return false;
	}
	
	public function update( $resDatabase ) {
		$strSql = 'UPDATE reminders SET description = "' . $this->getDescription() . '",
				alert_on = "' . $this->getAlertOn() . '"
				WHERE id = ' . (int) $this->getId();
	
		mysql_query( $strSql, $resDatabase );
			
		return true;
	}
	
	public function delete( $resDatabase ) {
		$strSql = 'DELETE FROM reminders WHERE id = ' . (int) $this->getId();

		if( mysql_query( $strSql, $resDatabase )) {			
			return true;
		}
		
		return false;
	}
}
?>