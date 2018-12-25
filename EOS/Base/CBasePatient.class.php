<?php

class CBasePatient {
	
	protected $m_intId;
	protected $m_intSrNo;
	protected $m_intDoctorId;
	protected $m_intPatientTypeId;
	protected $m_intBalanceStatusTypeId;
	protected $m_strTitle;
	protected $m_strFirstName;
	protected $m_strLastName;
	protected $m_strComment;
	protected $m_intAge;
	protected $m_strGender;
	protected $m_strPhone;
	protected $m_strRecivedDate;
	protected $m_strUpdatedOn;
	protected $m_strDueDate;
	protected $m_boolIsIpd;
	protected $m_boolIsFinalized;
	protected $m_fltTotalBillAmt;
	protected $m_fltReceivedAmt;
	protected $m_fltBalanceAmt;
	protected $m_fltIpdAmt;
	protected $m_fltOpdAmt;
	
	protected $m_intChildMaleCount;
	protected $m_intChildFemaleCount;
	protected $m_strHusbandName;
	protected $m_strHusbandAddress;
	protected $m_strLmpDate;
	protected $m_intLmpWeekCount;
	protected $m_strFamilyDisease;
	protected $m_strPreviousChildA;
	protected $m_strMaternalAgeB;
	protected $m_strWhoDiseaseC;
	protected $m_strOtherD;
	protected $m_strNonInvasive;
	protected $m_strInvasive;
	protected $m_strLabTestRecomended;
	protected $m_strPreNatalDiagnostic;
	protected $m_strSonoGraphy;
	protected $m_strSonoAbnormali;
	protected $m_strWasMtp;
	protected $m_strMtpDate;
	
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
	
	public function setFirstName( $value ) {
		$this->m_strFirstName = $value; 
	}
	
	public function setLastName( $value ) {
		$this->m_strLastName = $value;
	}
	
	public function setAge( $value ) {
		$this->m_intAge = $value;
	}
	
	public function setGender( $value ) {
		$this->m_strGender = $value;
	}
	
	public function setPhone( $value ) {
		$this->m_strPhone = $value;
	}
	
	public function setRecivedDate( $value ) {
		$this->m_strRecivedDate = $value;
	}
	
	public function setDueDate( $value ) {
		$this->m_strDueDate = $value;
	}
	
	public function setUpdatedOn( $value ) {
		$this->m_strUpdatedOn = $value;
	}
	
	public function setDoctorId( $value ) {
		$this->m_intDoctorId = $value;
	}
	
	public function setPatientTypeId( $value ) {
		$this->m_intPatientTypeId = $value;
	}
	
	public function setBalanceStatusTypeId( $value ) {
		$this->m_intBalanceStatusTypeId = $value;
	}
	
	
	public function setIsIpd( $value ) {
		$this->m_boolIsIpd = $value;
	}
	
	public function setIsFinalized( $value ) {
		$this->m_boolIsFinalized = $value;
	}
	
	
	public function setTotalBillAmt( $value ) {
		$this->m_fltTotalBillAmt = $value;
	}
	
	public function setReceivedAmt( $value ) {
		$this->m_fltReceivedAmt = $value;
	}
	
	public function setBalanceAmt( $value ) {
		$this->m_fltBalanceAmt = $value;
	}
	
	public function setIpdAmt( $value ) {
		$this->m_fltIpdAmt = $value;
	}
	
	public function setOpdAmt( $value ) {
		$this->m_fltOpdAmt = $value;
	}
	
	public function setComment( $value ) {
		$this->m_strComment = $value;
	}

	public function setChildMaleCount( $value ) {
		$this->m_intChildMaleCount = $value;
	}
		
	public function setChildFemaleCount( $value ) {
		$this->m_intChildFemaleCount = $value;
	}
	
	public function setHusbandName( $value ) {
		$this->m_strHusbandName = $value;
	}
	
	public function setHusbandAddress( $value ) {
		$this->m_strHusbandAddress = $value;
	}
	
	public function setLmpDate( $value ) {
		$this->m_strLmpDate = $value;
	}
	
	public function setLmpWeekCount( $value ) {
		$this->m_intLmpWeekCount = $value;
	}
	
	public function setFamilyDisease( $value ) {
		$this->m_strFamilyDisease = $value;
	}
	
	public function setPreviousChildA( $value ) {
		$this->m_strPreviousChildA = $value;
	}
	
	public function setMaternalAgeB( $value ) {
		$this->m_strMaternalAgeB = $value;
	}
	
	public function setWhoDiseaseC( $value ) {
		$this->m_strWhoDiseaseC = $value;
	}
	
	public function setOtherD( $value ) {
		$this->m_strOtherD = $value;
	}
	
	public function setNonInvasive( $value ) {
		$this->m_strNonInvasive = $value;
	}
	
	public function setInvasive( $value ) {
		$this->m_strInvasive = $value;
	}
	
	public function setLabTestRecomended( $value ) {
		$this->m_strLabTestRecomended = $value;
	}
	
	public function setPreNatalDiagnostic( $value ) {
		$this->m_strPreNatalDiagnostic = $value;
	}
	
	public function setSonoGraphy( $value ) {
		$this->m_strSonoGraphy = $value;
	}
	
	public function setSonoAbnormali( $value ) {
		$this->m_strSonoAbnormali = $value;
	}
	
	public function setWasMtp( $value ) {
		$this->m_strWasMtp = $value;
	}
	
	public function setMtpDate( $value ) {
		$this->m_strMtpDate = $value;
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
	
	public function getFirstName() {
		return $this->m_strFirstName;
	}
	
	public function getLastName() {
		return $this->m_strLastName;
	}
	
	public function getAge() {
		return $this->m_intAge;
	}
	
	public function getGender() {
		return $this->m_strGender;
	}
	
	public function getPhone() {
		return $this->m_strPhone;
	}
	
	public function getReceivedDate() {
		return $this->m_strRecivedDate;
	}
	
	public function getDueDate() {
		return $this->m_strDueDate;
	}
	
	public function getUpdatedOn() {
		return $this->m_strUpdatedOn;
	}
	
	public function getDoctorId() {
		return $this->m_intDoctorId;
	}
	
	public function getPatientTypeId() {
		return $this->m_intPatientTypeId;
	}
	
	public function getBalanceStatusTypeId() {
		return $this->m_intBalanceStatusTypeId;
	}
		
	public function getIsIpd() {
		return $this->m_boolIsIpd;
	}
	
	public function getIsFinalized() {
		return $this->m_boolIsFinalized;
	}
	
	public function getTotalBillAmt() {
		return $this->m_fltTotalBillAmt;
	}
	
	public function getReceivedAmt() {
		return $this->m_fltReceivedAmt;
	}
	
	public function getBalanceAmt() {
		return $this->m_fltBalanceAmt;
	}
	
	public function getIpdAmt() {
		return $this->m_fltIpdAmt;
	}
	
	public function getOpdAmt() {
		return $this->m_fltOpdAmt;
	}
	
	public function getComment() {
		return $this->m_strComment;
	}
		
	public function getChildFemaleCount() {
		return $this->m_intChildFemaleCount;
	}
	
	public function getChildMaleCount() {
		return $this->m_intChildMaleCount;
	}
	
	public function getHusbandName() {
		$this->m_strHusbandName;
	}
	
	public function getHusbandAddress() {
		return $this->m_strHusbandAddress;
	}
	
	public function getLmpDate() {
		return $this->m_strLmpDate;
	}
	
	public function getLmpWeekCount() {
		return $this->m_intLmpWeekCount;
	}
	
	public function getFamilyDisease() {
		return $this->m_strFamilyDisease;
	}
	
	public function getPreviousChildA() {
		return $this->m_strPreviousChildA;
	}
	
	public function getMaternalAgeB() {
		return $this->m_strMaternalAgeB;
	}
	
	public function getWhoDiseaseC() {
		return $this->m_strWhoDiseaseC;
	}
	
	public function getOtherD() {
		return $this->m_strOtherD;
	}
	
	public function getNonInvasive() {
		return $this->m_strNonInvasive;
	}
	
	public function getInvasive() {
		return $this->m_strInvasive;
	}
	
	public function getLabTestRecomended() {
		return $this->m_strLabTestRecomended;
	}
	
	public function getPreNatalDiagnostic() {
		return $this->m_strPreNatalDiagnostic;
	}
	
	public function getSonoGraphy() {
		return $this->m_strSonoGraphy;
	}
	
	public function getSonoAbnormali() {
		return $this->m_strSonoAbnormali;
	}
	
	public function getWasMtp() {
		return $this->m_strWasMtp;
	}
	
	public function getMtpDate() {
		return $this->m_strMtpDate;
	}
	
	/*******************************************************************
	 ************************* Fetch Functions **********************
	 *******************************************************************/	
	
	
	/*******************************************************************
	 ************************* Other Functions **********************
	 *******************************************************************/
	
	public function setValues( $arrValues ) {
		( $arrValues['title'] )?  $this->setTitle( $arrValues['title'] ):$this->setTitle( NULL );
		( $arrValues['sr_no'] )?  $this->setSrNo( $arrValues['sr_no'] ):$this->setSrNo( NULL );
		( $arrValues['first_name'] )?  $this->setFirstName( $arrValues['first_name'] ):$this->setFirstName( NULL );
		( $arrValues['last_name'] )?  $this->setLastName( $arrValues['last_name'] ):$this->setLastName( NULL );
		( $arrValues['doctor_id'] )?  $this->setDoctorId( $arrValues['doctor_id'] ):$this->setDoctorId( NULL );
		( $arrValues['patient_type_id'] )?  $this->setPatientTypeId( $arrValues['patient_type_id'] ):$this->setPatientTypeId( NULL );
		( $arrValues['balance_status_type_id'] )?  $this->setBalanceStatusTypeId( $arrValues['balance_status_type_id'] ):$this->setBalanceStatusTypeId( 0 );
		( $arrValues['is_ipd'] )?  $this->setIsIpd( $arrValues['is_ipd'] ):$this->setIsIpd( NULL );
		( $arrValues['age'] )?  $this->setAge( $arrValues['age'] ):$this->setAge( 0 );
		( $arrValues['id'] )?  $this->setId( $arrValues['id'] ):$this->setId( NULL );
		( strlen( $arrValues['gender'] ) )?  $this->setGender( $arrValues['gender'] ):$this->setGender( NULL );
		( $arrValues['phone'] )?  $this->setPhone( $arrValues['phone'] ):$this->setPhone( 0 );	
		( $arrValues['recieved_on'] )?  $this->setRecivedDate( $arrValues['recieved_on'] ):$this->setRecivedDate( NULL );
		( $arrValues['due_on'] )?  $this->setDueDate( $arrValues['due_on'] ):$this->setDueDate( NULL );
		( $arrValues['updated_on'] )?  $this->setUpdatedOn( $arrValues['updated_on'] ):$this->setUpdatedOn( NULL );
		( $arrValues['recieved_on'] )?  $this->setRecivedDate( $arrValues['recieved_on'] ):$this->setRecivedDate( NULL );
		( $arrValues['total_bill_amt'] )?  $this->setTotalBillAmt( $arrValues['total_bill_amt'] ):$this->setTotalBillAmt( 0 );
		( strlen( $arrValues['received_amt'] ))?  $this->setReceivedAmt( $arrValues['received_amt'] ):$this->setReceivedAmt( 0 );
		( strlen( $arrValues['balance_amt'] ))?  $this->setBalanceAmt( $arrValues['balance_amt'] ):'';
		( strlen($arrValues['ipd_amt'] ))?  $this->setIpdAmt( $arrValues['ipd_amt'] ):$this->setIpdAmt( 0 );
		( strlen($arrValues['is_finalized'] ))?  $this->setIsFinalized( $arrValues['is_finalized'] ):$this->setIsFinalized( 0 );
		( strlen($arrValues['opd_amt'] ))?  $this->setOpdAmt( $arrValues['opd_amt'] ):$this->setOpdAmt( 0 );
		( strlen($arrValues['comment'] ))?  $this->setComment( $arrValues['comment'] ):$this->setComment( NULL );
		
		( strlen($arrValues['comment'] ))?  $this->setComment( $arrValues['comment'] ):$this->setComment( NULL );
		( strlen($arrValues['comment'] ))?  $this->setComment( $arrValues['comment'] ):$this->setComment( NULL );
		( strlen($arrValues['comment'] ))?  $this->setComment( $arrValues['comment'] ):$this->setComment( NULL );
		( strlen($arrValues['comment'] ))?  $this->setComment( $arrValues['comment'] ):$this->setComment( NULL );
		( strlen($arrValues['comment'] ))?  $this->setComment( $arrValues['comment'] ):$this->setComment( NULL );
		( strlen($arrValues['comment'] ))?  $this->setComment( $arrValues['comment'] ):$this->setComment( NULL );
		( strlen($arrValues['comment'] ))?  $this->setComment( $arrValues['comment'] ):$this->setComment( NULL );
		( strlen($arrValues['comment'] ))?  $this->setComment( $arrValues['comment'] ):$this->setComment( NULL );
		( strlen($arrValues['comment'] ))?  $this->setComment( $arrValues['comment'] ):$this->setComment( NULL );
		( strlen($arrValues['comment'] ))?  $this->setComment( $arrValues['comment'] ):$this->setComment( NULL );
		( strlen($arrValues['comment'] ))?  $this->setComment( $arrValues['comment'] ):$this->setComment( NULL );
		( strlen($arrValues['comment'] ))?  $this->setComment( $arrValues['comment'] ):$this->setComment( NULL );
		( strlen($arrValues['comment'] ))?  $this->setComment( $arrValues['comment'] ):$this->setComment( NULL );
		( strlen($arrValues['comment'] ))?  $this->setComment( $arrValues['comment'] ):$this->setComment( NULL );
		( strlen($arrValues['comment'] ))?  $this->setComment( $arrValues['comment'] ):$this->setComment( NULL );
		( strlen($arrValues['comment'] ))?  $this->setComment( $arrValues['comment'] ):$this->setComment( NULL );
		( strlen($arrValues['comment'] ))?  $this->setComment( $arrValues['comment'] ):$this->setComment( NULL );
		( strlen($arrValues['comment'] ))?  $this->setComment( $arrValues['comment'] ):$this->setComment( NULL );
		( strlen($arrValues['comment'] ))?  $this->setComment( $arrValues['comment'] ):$this->setComment( NULL );
		
	}
	
	
	public function applyRequestForm( $arrData ) {		
		if( true == is_array( $arrData ) && 0 < sizeof( $arrData )) {
			$this->setValues( $arrData );
		}		
	}
	
	
	
	public function insert( $resDatabase ) {
		$strSql = 'INSERT INTO patients (
			title, 
			sr_no,
			first_name,
			last_name,
			doctor_id,
			patient_type_id,
			balance_status_type_id,
			age,
			gender,
			phone,
			recieved_on,
			due_on,
			updated_on,
			total_bill_amt,
			received_amt,
			balance_amt,
			ipd_amt,
			is_finalized,
			opd_amt,
			comment
		) VALUES (
			"' . $this->getTitle() . '",
			"' . $this->getSrNo() . '",
			"' . $this->getFirstName() . '",
			"' . $this->getLastName() . '",
			' . $this->getDoctorId() . ',
			' . $this->getPatientTypeId() . ',
			' . $this->getBalanceStatusTypeId() . ',
			' . $this->getAge() . ',
			"' . $this->getGender() . '",
			"' . $this->getPhone() . '",
			"' . $this->getReceivedDate() . '",
			"' . $this->getDueDate() . '",
			"' . $this->getUpdatedOn() . '",
			' . $this->getTotalBillAmt() . ',
			' . $this->getReceivedAmt() . ',
			' . $this->getBalanceAmt() . ',
			' . $this->getIpdAmt() . ',
			' . $this->getIsFinalized() . ',
			' . $this->getOpdAmt() . ',
			"' . $this->getComment() . '"
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