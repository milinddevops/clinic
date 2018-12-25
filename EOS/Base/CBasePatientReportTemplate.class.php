<?php

class CBasePatientReportTemplate {
	
	protected $m_intId;
	protected $m_intPatientId;
	protected $m_intTemplateId;
	protected $m_strData;
	
	/*******************************************************************
	 ************************* Set Functions **********************
	 *******************************************************************/
	
	public function setId( $value ) {
		$this->m_intId = $value;
	}
	
	public function setPatientId( $value ) {
		$this->m_intPatientId = $value;
	}
	
	public function setTemplateId( $value ) {
		$this->m_intTemplateId = $value; 
	}

	public function setData( $value ) {
		$this->m_strData = $value; 
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
	
	public function getTemplateId() {
		return $this->m_intTemplateId;
	}

	public function getData() {
		return $this->m_strData;
	}
	
	
	
	/*******************************************************************
	 ************************* Fetch Functions **********************
	 *******************************************************************/	
	
	
	/*******************************************************************
	 ************************* Other Functions **********************
	 *******************************************************************/
	
	public function setValues( $arrValues ) {

		( $arrValues['id'] )?  $this->setId( $arrValues['id'] ):$this->setId( NULL );
		( $arrValues['patient_id'] )?  $this->setPatientId( $arrValues['patient_id'] ):$this->setPatientId( NULL );
		( $arrValues['template_id'] )?  $this->setTemplateId( $arrValues['template_id'] ):$this->setTemplateId( NULL );
		( $arrValues['data'] )?  $this->setData( $arrValues['data'] ):$this->setData( NULL );
	}
	
	
	public function applyRequestForm( $arrData ) {
		if( true == is_array( $arrData ) && 0 < sizeof( $arrData )) {
			$this->setValues( $arrData );
		}		
	}
	
	
	
	public function insert( $resDatabase ) {
		$strSql = 'INSERT INTO patient_report_templates ( 
			patient_id,
			template_id,
			data
		) VALUES (
			' . $this->getPatientId() . ',
			' . $this->getTemplateId() . ',
			\'' . $this->getData() . '\'
		);';

		if( true == mysql_query( $strSql, $resDatabase )) {
			$this->setId( mysql_insert_id( $resDatabase ) );			
			return true;
		}
		return false;
	}
	
	public function update( $resDatabase ) {
		$strSql = 'UPDATE patient_report_templates SET patient_id = ' . $this->getPatientId() . ',
				template_id = ' . $this->getTemplateId() . ',
				data = "' . $this->getData() . '",
				WHERE id = ' . (int) $this->getId();

		if( mysql_query( $strSql, $resDatabase )) {			
			return true;
		}
		return false;
	}
	
	public function delete( $resDatabase ) {
		$strSql = 'DELETE FROM patient_report_templates WHERE id = ' . (int) $this->getId();

		if( mysql_query( $strSql, $resDatabase )) {			
			return true;
		}
		
		if( true == $this->deleteCustomerTests( $resDatabase )) {
			return false;
		}
		return false;
	}
}


?>