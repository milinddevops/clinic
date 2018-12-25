<?php

class CBaseDoctorPercentage {
	
	protected $m_intId;
	protected $m_intDoctorId;
	protected $m_intTestTypeId;
	protected $m_intPercentage;
	
	/*******************************************************************
	 ************************* Set Functions **********************
	 *******************************************************************/
	
	public function setId( $value ) {
		$this->m_intId = $value;
	}
	
	public function setDoctorId( $value ) {
		$this->m_intDoctorId = $value; 
	}
	
	public function setTestTypeId( $value ) {
		$this->m_intTestTypeId = $value;
	}
		
	public function setPercentage( $value ) {
		$this->m_intPercentage = $value;
	}
	
	/*******************************************************************
	 ************************* Get Functions **********************
	 *******************************************************************/
	
	public function getId() {
		return $this->m_intId;
	}
	
	public function getDoctorId() {
		return $this->m_intDoctorId;
	}
	
	public function getTestTypeId() {
		return $this->m_intTestTypeId;
	}
	
	public function getPercentage() {
		return $this->m_intPercentage;
	}
	
	/*******************************************************************
	 ************************* Fetch Functions **********************
	 *******************************************************************/	
	
	
	/*******************************************************************
	 ************************* Other Functions **********************
	 *******************************************************************/
	
	public function setValues( $arrValues ) {
				
		( $arrValues['doctor_id'] )?  $this->setDoctorId( $arrValues['doctor_id'] ):$this->setDoctorId( NULL );
		( $arrValues['test_type_id'] )?  $this->setTestTypeId( $arrValues['test_type_id'] ):$this->setTestTypeId( NULL );		
		( $arrValues['percentage'] )?  $this->setPercentage( $arrValues['percentage'] ):$this->setPercentage( NULL );
		( $arrValues['id'] )?  $this->setId( $arrValues['id'] ):$this->setId( NULL );	
	}
	
	public function applyRequestForm( $arrData ) {		
		if( true == is_array( $arrData ) && 0 < sizeof( $arrData )) {
			$this->setValues( $arrData );
		}		
	}
	
	public function insert( $resDatabase ) {
		$strSql = 'INSERT INTO doctor_percentage (
			doctor_id,
			test_type_id,
			percentage
		) VALUES (
			' . $this->getDoctorId() . ',
			' . $this->getTestTypeId() . ',
			' . $this->getPercentage() . '
		)';

		if( mysql_query( $strSql, $resDatabase )) {
			$this->setId( mysql_insert_id( $resDatabase ) );
						
			return true;
		}
		return false;
	}
	
	public function update( $resDatabase ) {
		
		$strSql = 'UPDATE doctor_percentage SET doctor_id = ' . $this->getDoctorId() . ',
				test_type_id = ' . $this->getTestTypeId() . ',
				percentage = ' . $this->getPercentage() . '
				WHERE id = ' . (int) $this->getId();

		mysql_query( $strSql, $resDatabase );
			
		return true;
	}
	
	public function delete( $resDatabase ) {
		$strSql = 'DELETE FROM doctor_percentage WHERE id = ' . (int) $this->getId();

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