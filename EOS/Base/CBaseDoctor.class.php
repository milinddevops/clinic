<?php

class CBaseDoctor {
	
	protected $m_intId;
	protected $m_strFirstName;
	protected $m_strLastName;
	protected $m_strPhone;
	protected $m_strAddress;
	protected $m_strEmail;
	protected $m_strCreatedOn;
	protected $m_boolIsRefFee;
	
	/*******************************************************************
	 ************************* Set Functions **********************
	 *******************************************************************/
	
	public function setId( $value ) {
		$this->m_intId = $value;
	}
	
	public function setFirstName( $value ) {
		$this->m_strFirstName = $value;
	}
	
	public function setLastName( $value ) {
		$this->m_strLastName = $value;
	}
	
	public function setPhone( $value ) {
		$this->m_strPhone = $value;
	}
	
	public function setAddress( $value ) {
		$this->m_strAddress = $value;
	}
	
	public function setEmail( $value ) {
		$this->m_strEmail = $value;
	}
	
	public function setCreatedOn( $value ) {
		$this->m_strCreatedOn = $value;
	}
	
	public function setIsRefFee( $value ) {
		$this->m_boolIsRefFee = $value;
	}
	
	/*******************************************************************
	 ************************* Get Functions **********************
	 *******************************************************************/
	
	public function getId() {
		return $this->m_intId;
	}
	
	public function getFirstName() {
		return $this->m_strFirstName;
	}
	
	public function getLastName() {
		return $this->m_strLastName;
	}
	
	public function getPhone() {
		return $this->m_strPhone;
	}
	
	public function getAddress() {
		return $this->m_strAddress;
	}
	
	public function getEmail() {
		return $this->m_strEmail;
	}
	
	public function getCreatedOn() {
		return $this->m_strCreatedOn;
	}

	public function getIsRefFee() {
		return $this->m_boolIsRefFee;
	}
	
	/*******************************************************************
	 ************************* Other Functions **********************
	 *******************************************************************/

	public function setValues( $arrValues ) {		
		( $arrValues['first_name'] )?  $this->setFirstName( $arrValues['first_name'] ):$this->setFirstName( NULL );
		( $arrValues['last_name'] )?  $this->setLastName( $arrValues['last_name'] ):$this->setLastName( NULL );
		( $arrValues['phone'] )?  $this->setPhone( $arrValues['phone'] ):$this->setPhone( NULL );
		( $arrValues['address'] )?  $this->setAddress( $arrValues['address'] ):$this->setAddress( NULL );
		( $arrValues['email'] )?  $this->setEmail( $arrValues['email'] ):$this->setEmail( NULL );		
		( $arrValues['created_on'] )?  $this->setCreatedOn( $arrValues['created_on'] ):$this->setCreatedOn( NULL );
		( $arrValues['is_ref_fee'] )?  $this->setIsRefFee( $arrValues['is_ref_fee'] ):$this->setIsRefFee( 0 );
		( $arrValues['id'] )?  $this->setId( $arrValues['id'] ):$this->setId( NULL );		
	}
	
	
	public function applyRequestForm( $arrData ) {		
		if( true == is_array( $arrData ) && 0 < sizeof( $arrData )) {
			$this->setValues( $arrData );
		}		
	}
	
	public function insert( $resDatabase ) {
		$strSql = 'INSERT INTO doctors ( 
			first_name,
			last_name,			
			phone,
			address,
			email,
			is_ref_fee,
			created_on
		) VALUES (
			"' . $this->getFirstName() . '",
			"' . $this->getLastName() . '",			
			"' . $this->getPhone() . '",
			"' . $this->getAddress() . '",
			"' . $this->getEmail() . '",
			"' . $this->getIsRefFee() . '",
			 CURDATE()
		)';

		if( mysql_query( $strSql, $resDatabase )) {
			$this->setId( mysql_insert_id( $resDatabase ) );						
			return true;
		}
		return false;
	}
	
	public function update( $resDatabase ) {
		$strSql = 'UPDATE doctors SET first_name = "' . $this->getFirstName() . '",
				last_name = "' . $this->getLastName() . '",
				phone = "' . $this->getPhone() . '",
				address = "' . $this->getAddress() . '",
				email = "' . $this->getEmail() . '",
				is_ref_fee = "' . $this->getIsRefFee() . '"
				WHERE id = ' . (int) $this->getId();

		if( mysql_query( $strSql, $resDatabase )) {			
			return true;
		}
		return false;
	}
	
	public function delete( $resDatabase ) {
		$strSql = 'DELETE FROM doctors WHERE id = ' . (int) $this->getId();

		if( mysql_query( $strSql, $resDatabase )) {			
			return true;
		}
		
		return false;
	}
}
?>