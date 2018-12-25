<?php

class CBaseUser {
	
	protected $m_intId;
	protected $m_strUsername;
	protected $m_strPassword;
	protected $m_strFirstName;
	protected $m_strLastName;
	protected $m_strAddress;
	protected $m_strPhoneNumner;
	protected $m_strGender;
	protected $m_strCreatedOn;
	
	/*******************************************************************
	 ************************* Set Functions **********************
	 *******************************************************************/
	
	public function setId( $value ) {
		$this->m_intId = $value;
	}
	
	public function setUsername( $value ) {
		$this->m_strUsername = $value; 
	}
	
	public function setPassword( $value ) {
		$this->m_strPassword = $value;
	}
	
	public function setFirstName( $value ) {
		$this->m_strFirstName = $value;
	}
	
	public function setLastName( $value ) {
		$this->m_strLastName = $value;
	}
	
	public function setAddress( $value ) {
		$this->m_strAddress = $value;
	}
	
	public function setPhoneNumber( $value ) {
		$this->m_strPhoneNumner = $value;
	}
	
	public function setGender( $value ) {
		$this->m_strGender = $value; 
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
	
	public function getUsername() {
		return $this->m_strUsername;
	}
	
	public function getPassword() {
		return $this->m_strPassword;
	}
	
	public function getFirstName() {
		return $this->m_strFirstName;
	}
	
	public function getLastname() {
		return $this->m_strLastName;
	}
	
	public function getAddress() {
		return $this->m_strAddress;
	}
	
	public function getPhonenumber() {
		return $this->m_strPhoneNumner;
	}
	
	public function getGender() {
		return $this->m_strGender;
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
				
		( $arrValues['username'] )?  $this->setUsername( $arrValues['username'] ):$this->setUsername( NULL );
		( $arrValues['password'] )?  $this->setPassword( $arrValues['password'] ):$this->setPassword( NULL );
		( $arrValues['first_name'] )?  $this->setFirstName( $arrValues['first_name'] ):$this->setFirstName( NULL );
		( $arrValues['last_name'] )?  $this->setLastName( $arrValues['last_name'] ):$this->setLastName( NULL );
		( $arrValues['address'] )?  $this->setAddress( $arrValues['address'] ):$this->setAddress( NULL );
		( $arrValues['phone_number'] )?  $this->setPhoneNumber( $arrValues['phone_number'] ):$this->setPhoneNumber( NULL );
		( $arrValues['gender'] )?  $this->setGender( $arrValues['gender'] ):$this->setGender( $value );
		( $arrValues['created_on'] )?  $this->setCreatedOn( $arrValues['created_on'] ):$this->setCreatedOn( NULL );
		( $arrValues['id'] )?  $this->setId( $arrValues['id'] ):$this->setId( NULL );	
	}
	
	
	public function applyRequestForm( $arrData ) {		
		if( true == is_array( $arrData ) && 0 < sizeof( $arrData )) {
			$this->setValues( $arrData );
		}		
	}
	
	
	
	public function insert( $resDatabase ) {
		$strSql = 'INSERT INTO users (
			username, 
			password,
			first_name,
			last_name,
			address,
			gender,
			phone,
			created_on
		) VALUES (
			"' . $this->getUsername() . '",
			"' . $this->getPassword() . '",
			"' . $this->getFirstName() . '",
			"' . $this->getLastname() . '",
			"' . $this->getAddress() . '",			
			"' . $this->getGender() . '",
			"' . $this->getPhoneNumber() . '",
			' . $this->getGender() . ',
			' . date( 'Y-m-d' ) . '
		)';

		if( mysql_query( $strSql, $resDatabase )) {
			$this->setId( mysql_insert_id( $resDatabase ) );
						
			return true;
		}
		return false;
	}
	
	public function update( $resDatabase ) {
		$strSql = 'UPDATE users SET username = "' . $this->getUsername() . '",
				password = "' . $this->getPassword() . '",
				first_name = "' . $this->getFirstName() . '",
				last_name = "' . $this->getLastname() . '",
				address = "' . $this->getAddress() . '",				
				phone_number = "' . $this->getPhonenumber() . '"
				WHERE id = ' . (int) $this->getId();
	
		mysql_query( $strSql, $resDatabase );
			
		return true;
	}
	
	public function delete( $resDatabase ) {
		$strSql = 'DELETE FROM users WHERE id = ' . (int) $this->getId();

		if( mysql_query( $strSql, $resDatabase )) {			
			return true;
		}
		
		return false;
	}
}

?>