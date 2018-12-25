<?php

require_once( EOS_BASE . 'CBaseUserPermission.class.php' );

class CUserPermission extends CBaseUserPermission {
	
	protected $m_intId;
	protected $m_intUserId;
	protected $m_strKey;
	protected $m_strValue;
	protected $m_strCreatedOn;
	
	/*******************************************************************
	 ************************* Set Functions **********************
	 *******************************************************************/
	
	public function setId( $value ) {
		$this->m_intId = $value;
	}
	
	public function setUserId( $value ) {
		$this->m_intUserId = $value; 
	}
	
	public function setKey( $value ) {
		$this->m_strKey = $value;
	}
	
	public function setValue( $value ) {
		$this->m_strValue = $value;
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
	
	public function getUserId() {
		return $this->m_intUserId;
	}
	
	public function getKey() {
		return $this->m_strKey;
	}
	
	public function getValue() {
		return $this->m_strValue;
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
				
		( $arrValues['user_id'] )?  $this->setUserId( $arrValues['user_id'] ):$this->setUserId( NULL );
		( $arrValues['key'] )?  $this->setKey( $arrValues['key'] ):$this->setKey( NULL );
		( $arrValues['value'] )?  $this->setValue( $arrValues['value'] ):$this->setValue( NULL );
		( $arrValues['created_on'] )?  $this->setCreatedOn( $arrValues['created_on'] ):$this->setCreatedOn( NULL );
		( $arrValues['id'] )?  $this->setId( $arrValues['id'] ):$this->setId( NULL );	
	}
	
	
	public function applyRequestForm( $arrData ) {		
		if( true == is_array( $arrData ) && 0 < sizeof( $arrData )) {
			$this->setValues( $arrData );
		}		
	}
	
	/*public function insert() {
		$strSql = 'INSERT INTO user_permissions (
			user_id, 
			key,
			value,
			created_on
		) VALUES (
			' . $this->getUserId() . ',
			"' . $this->getKey() . '",
			"' . $this->getValue() . '",
			"' . date( 'Y-m-d' ) . '"
		)';
display($strSql);exit;
		if( mysql_query( $strSql, $resDatabase )) {
			$this->setId( mysql_insert_id( $resDatabase ) );			
			return true;
		}
		return false;
	}*/
	
	/*public function update() {
		$strSql = 'UPDATE users SET username = "' . $this->getUsername() . '",
				password = "' . $this->getPassword() . '",
				first_name = "' . $this->getFirstName() . '",
				last_name = ' . $this->getLastname() . ',
				address = ' . $this->getAddress() . ',
				gender = "' . $this->getGender() . '",
				phone = "' . $this->getPhonenumber() . '",
				WHERE id = ' . (int) $this->getId();
	
		if( mysql_query( $strSql, $resDatabase )) {			
			return true;
		}
		return false;
	}
	
	public function delete() {
		$strSql = 'DELETE FROM users WHERE id = ' . (int) $this->getId();

		if( mysql_query( $strSql, $resDatabase )) {			
			return true;
		}
		
		return false;
	}*/
}


?>