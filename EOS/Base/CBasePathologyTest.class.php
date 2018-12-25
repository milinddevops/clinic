<?php

class CBasePathologyTest {
	
	protected $m_intId;
	protected $m_intTestType;
	protected $m_strName;
	protected $m_fltLabRate;
	protected $m_fltDocRate;
	protected $m_fltTotal;
	
	/*******************************************************************
	 ************************* Set Functions **********************
	 *******************************************************************/
	
	public function setId( $value ) {
		$this->m_intId = $value;
	}
	
	public function setTestType( $value ) {
		$this->m_intTestType = $value;
	}
	
	public function setName( $value ) {
		$this->m_strName = $value;
	}
	
	public function setLabRate( $value ) {
		$this->m_fltLabRate = $value;
	}
	
	public function setDocRate( $value ) {
		$this->m_fltDocRate = $value;
	}
	
	public function setTotal( $value ) {
		$this->m_fltTotal = $value;
	}
	
	/*******************************************************************
	 ************************* Get Functions **********************
	 *******************************************************************/
	
	public function getId() {
		return $this->m_intId;
	}
	
	public function getTestType() {
		return $this->m_intTestType;
	}
	
	public function getName() {
		return $this->m_strName;
	}
	
	public function getLabRate() {
		return $this->m_fltLabRate;
	}
	
	public function getDocRate() {
		return $this->m_fltDocRate;
	}
	
	public function getTotal() {
		return $this->m_fltTotal;
	}

	/*******************************************************************
	 ************************* Other Functions **********************
	 *******************************************************************/

	public function setValues( $arrValues ) {		
		( $arrValues['name'] )?  $this->setName( $arrValues['name'] ):$this->setName( NULL );
		( $arrValues['test_type'] )?  $this->setTestType( $arrValues['test_type'] ):$this->setTestType( NULL );
		( $arrValues['lab_rate'] )?  $this->setLabRate( $arrValues['lab_rate'] ):$this->setLabRate( 0 );
		( $arrValues['total'] )?  $this->setTotal( $arrValues['total'] ):$this->setTotal( 0 );
		( false == is_null( $arrValues['doc_rate'] ) )?  $this->setDocRate( $arrValues['doc_rate'] ):$this->setDocRate( 0 );		
		( $arrValues['id'] )?  $this->setId( $arrValues['id'] ):$this->setId( NULL );		
	}
	
	
	public function applyRequestForm( $arrData ) {		
		if( true == is_array( $arrData ) && 0 < sizeof( $arrData )) {
			$this->setValues( $arrData );
		}		
	}
	
	public function insert( $resDatabase ) {
		$strSql = 'INSERT INTO pathology_tests ( 
			name,
			test_type,
			lab_rate,			
			doc_rate,
			total
		) VALUES (
			"' . $this->getName() . '",
			' . $this->getTestType() . ',			
			' . $this->getLabRate() . ',
			' . $this->getDocRate() . ',
			' . $this->getTotal() . '
		)';

		if( mysql_query( $strSql, $resDatabase )) {						
			return true;
		}
		return false;
	}
	
	public function update( $resDatabase ) {
		$strSql = 'UPDATE pathology_tests SET name = "' . $this->getName() . '",
				test_type = ' . $this->getTestType() . ',
				lab_rate = ' . $this->getLabRate() . ',
				doc_rate = ' . $this->getDocRate() . ',
				total = ' . $this->getTotal() . '
				WHERE id = ' . (int) $this->getId();

		if( mysql_query( $strSql, $resDatabase )) {			
			return true;
		}
		return false;
	}
	
	public function delete( $resDatabase ) {
		$strSql = 'DELETE FROM pathology_tests WHERE id = ' . (int) $this->getId();

		if( mysql_query( $strSql, $resDatabase )) {			
			return true;
		}
		
		return false;
	}
}
?>