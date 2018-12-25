<?php

class CBaseCustomerPathologyTest {
	
	protected $m_intId;
	protected $m_intCustomerId;
	protected $m_intPathologytestId;
	protected $m_strCreatedOn;

	
	/*******************************************************************
	 ************************* Set Functions **********************
	 *******************************************************************/
	
	public function setId( $value ) {
		$this->m_intId = $value;
	}
	
	public function setCustomerId( $value ) {
		$this->m_intCustomerId = $value; 
	}
	
	public function setPathologyTestId( $value ) {
		$this->m_intPathologytestId = $value;
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
	
	public function getCustomerId() {
		return $this->m_intCustomerId;
	}
	
	public function getPathologyTestId() {
		return $this->m_intPathologytestId;
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
		( $arrValues['customer_id'] )?  $this->setCustomerId( $arrValues['customer_id'] ):$this->setCustomerId( NULL );
		( $arrValues['pathologytest_id'] )?  $this->setPathologyTestId( $arrValues['pathologytest_id'] ):$this->setPathologyTestId( NULL );
		( $arrValues['create_on'] )?  $this->setCreatedOn( $arrValues['create_on'] ):$this->setCreatedOn( NULL );		
	}
	
	
	public function applyRequestForm( $arrData ) {		
		if( true == is_array( $arrData ) && 0 < sizeof( $arrData )) {
			$this->setValues( $arrData );
		}		
	}
	
	
	
	public function insert( $resDatabase ) {
		$strSql = 'INSERT INTO customer_pathology_tests ( 
			customer_id,
			pathologytest_id,
			created_on			
		) VALUES (
			' . $this->getCustomerId() . ',
			' . $this->getPathologyTestId() . ',
			"' . $this->getCreatedOn() . '"			
		)';

		if( mysql_query( $strSql, $resDatabase )) {			
			return true;
		}
		return false;
	}
	
	public function update() {
		
	}
	
	public function delete() {
		$strSql = 'DELETE FROM customer_pathology_tests WHERE id = ' . (int) $this->getId();

		if( mysql_query( $strSql, $resDatabase )) {			
			return true;
		}
		return false;
	}
}


?>