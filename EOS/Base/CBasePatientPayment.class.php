<?php

class CBasePatientPayment {
	
	protected $m_intId;
	protected $m_intPatientId;
	protected $m_boolIsPreviousBalance;
	protected $m_fltAmount;
	protected $m_strCreatedOn;
	
	/*******************************************************************
	 ************************* Set Functions **********************
	 *******************************************************************/
	
	public function setId( $value ) {
		$this->m_intId = $value;
	}
	
	public function setPatientId( $value ) {
		$this->m_intPatientId = $value; 
	}
	
	public function setIsPreviousBalance( $value ) {
		$this->m_boolIsPreviousBalance = $value; 
	}
	
	public function setAmount( $value ) {
		$this->m_fltAmount = $value;
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
	
	public function getPatientId() {
		return $this->m_intPatientId;
	}
	
	public function getIsPreviousBalance() {
		return $this->m_boolIsPreviousBalance;
	}
	
	public function getAmount() {
		return $this->m_fltAmount;
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
				
		( $arrValues['patient_id'] )?  $this->setPatientId( $arrValues['patient_id'] ):$this->setPatientId( NULL );
		( $arrValues['is_previous_balance'] )?  $this->setIsPreviousBalance( $arrValues['is_previous_balance'] ):$this->setIsPreviousBalance( NULL );
		( $arrValues['amount'] )?  $this->setAmount( $arrValues['amount'] ):$this->setAmount( NULL );		
		( $arrValues['created_on'] )?  $this->setCreatedOn( $arrValues['created_on'] ):$this->setCreatedOn( NULL );
		( $arrValues['id'] )?  $this->setId( $arrValues['id'] ):$this->setId( NULL );	
	}
	
	public function applyRequestForm( $arrData ) {		
		if( true == is_array( $arrData ) && 0 < sizeof( $arrData )) {
			$this->setValues( $arrData );
		}		
	}
	
	public function insert( $resDatabase ) {
		$strSql = 'INSERT INTO patient_payments (
			patient_id,
			is_previous_balance,
			amount,
			created_on
		) VALUES (
			' . $this->getPatientId() . ',
			' . $this->getIsPreviousBalance() . ',
			' . $this->getAmount() . ',
			"' . $this->getCreatedOn() . '"
		)';

		if( mysql_query( $strSql, $resDatabase )) {
			$this->setId( mysql_insert_id( $resDatabase ) );
						
			return true;
		}
		return false;
	}
	
	public function update( $resDatabase ) {
		
		/*$strSql = 'UPDATE doctor_percentage SET doctor_id = ' . $this->getDoctorId() . ',
				test_type_id = ' . $this->getTestTypeId() . ',
				percentage = ' . $this->getPercentage() . '
				WHERE id = ' . (int) $this->getId();

		mysql_query( $strSql, $resDatabase );*/
			
		return true;
	}
	
	public function delete( $resDatabase ) {
		$strSql = 'DELETE FROM patient_payments WHERE id = ' . (int) $this->getId();

		if( mysql_query( $strSql, $resDatabase )) {			
			return true;
		}
		
		return false;
	}
	
	public function insertOrUpdate( $resDatabase ) {
		
		if( false == is_null( $this->getId() ) ) {
			$this->update( $resDatabase );
		} else {
			$this->insert($resDatabase);
		}
		
		return true;
	}
}
?>