<?php

class CBaseExpence {
	
	protected $m_intId;
	protected $m_strReason;
	protected $m_fltAmount;
	protected $m_strCreatedOn;
	
	/*******************************************************************
	 ************************* Set Functions **********************
	 *******************************************************************/
	
	public function setId( $value ) {
		$this->m_intId = $value;
	}
	
	public function setReason( $value ) {
		$this->m_strReason = $value; 
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
	
	public function getReason() {
		return $this->m_strReason;
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
				
		( $arrValues['reason'] )?  $this->setReason( $arrValues['reason'] ):$this->setReason( NULL );
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
		$strSql = 'INSERT INTO expences (
			reason, 
			amount,
			created_on
		) VALUES (
			"' . $this->getReason() . '",
			"' . $this->getAmount() . '",
			"' . date( 'Y-m-d' ) . '"
		)';

		if( mysql_query( $strSql, $resDatabase )) {
			$this->setId( mysql_insert_id( $resDatabase ) );
						
			return true;
		}
		return false;
	}
	
	public function update( $resDatabase ) {
		$strSql = 'UPDATE expences SET reason = "' . $this->getReason() . '",
				amount = "' . $this->getAmount() . '"
				WHERE id = ' . (int) $this->getId();
	
		mysql_query( $strSql, $resDatabase );
			
		return true;
	}
	
	public function delete( $resDatabase ) {
		$strSql = 'DELETE FROM expences WHERE id = ' . (int) $this->getId();

		if( mysql_query( $strSql, $resDatabase )) {			
			return true;
		}
		
		return false;
	}
}
?>