<?php

class CBaseReportTemplate {
	
	protected $m_intId;
	protected $m_strTemplateName;
	protected $m_strData;
	
	/*******************************************************************
	 ************************* Set Functions **********************
	 *******************************************************************/
	
	public function setId( $value ) {
		$this->m_intId = $value;
	}
	
	public function setSrNo( $value ) {
		$this->m_intSrNo = $value;
	}
	
	public function setTitle( $value ) {
		$this->m_strTitle = $value; 
	}
	
	
	
	/*******************************************************************
	 ************************* Get Functions **********************
	 *******************************************************************/
	
	public function getId() {
		return $this->m_intId;
	}
	
	public function getSrNo() {
		return $this->m_intSrNo;
	}
	
	public function getTitle() {
		return $this->m_strTitle;
	}
	
	
	
	/*******************************************************************
	 ************************* Fetch Functions **********************
	 *******************************************************************/	
	
	
	/*******************************************************************
	 ************************* Other Functions **********************
	 *******************************************************************/
	
	public function setValues( $arrValues ) {
		( $arrValues['id'] )?  $this->setId( $arrValues['id'] ):$this->setId( NULL );
		( $arrValues['template_name'] )?  $this->setTemplateName( $arrValues['template_name'] ):$this->setTemplateName( NULL );
		( $arrValues['data'] )?  $this->setData( $arrValues['data'] ):$this->setData( NULL );	
	}
	
	
	public function applyRequestForm( $arrData ) {		
		if( true == is_array( $arrData ) && 0 < sizeof( $arrData )) {
			$this->setValues( $arrData );
		}		
	}
	
	
	
	public function insert( $resDatabase ) {
		$strSql = 'INSERT INTO report_templates ( 
			template_name,
			data
		) VALUES (
			"' . $this->getTemplateName() . '",
			"' . $this->getData() . '"
		)';

		if( mysql_query( $strSql, $resDatabase )) {
			$this->setId( mysql_insert_id( $resDatabase ) );			
			return true;
		}
		return false;
	}
	
	public function update( $resDatabase ) {
		$strSql = 'UPDATE patients SET title = "' . $this->getTitle() . '",
				sr_no = ' . $this->getSrNo() . ',
				first_name = "' . $this->getFirstName() . '",
				last_name = "' . $this->getLastName() . '",
				doctor_id = ' . $this->getDoctorId() . ',
				patient_type_id = ' . $this->getPatientTypeId() . ',
				balance_status_type_id = ' . $this->getBalanceStatusTypeId() . ',
				age = ' . $this->getAge() . ',
				gender = "' . $this->getGender() . '",
				phone = "' . $this->getPhone() . '",
				due_on = "' . $this->getDueDate() . '",
				recieved_on = "' . $this->getReceivedDate() . '",
				updated_on = "' . date( 'Y-m-d' ) . '",
				total_bill_amt = ' . $this->getTotalBillAmt() . ',
				received_amt = ' . $this->getReceivedAmt() . ',
				balance_amt = ' . $this->getBalanceAmt() . ',
				ipd_amt = ' . $this->getIpdAmt() . ',				
				opd_amt = ' . $this->getOpdAmt() . ',
				is_finalized = ' . $this->getIsFinalized() . ',
				comment = "' . $this->getComment() . '"
				WHERE id = ' . (int) $this->getId();

		if( mysql_query( $strSql, $resDatabase )) {			
			return true;
		}
		return false;
	}
	
	public function delete( $resDatabase ) {
		$strSql = 'DELETE FROM patients WHERE id = ' . (int) $this->getId();

		if( mysql_query( $strSql, $resDatabase )) {			
			return true;
		}
		
		if( true == $this->deleteCustomerTests( $resDatabase )) {
			return false;
		}
		return false;
	}
	
	public function deleteCustomerTests( $resDatabase ) {
		$strSql = 'DELETE FROM customer_pathology_tests WHERE customer_id = ' . (int) $this->getId();

		if( mysql_query( $strSql, $resDatabase )) {			
			return true;
		}
		return false;
	}
}


?>