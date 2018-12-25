<?php

class CSearchFilter {
	
	protected $m_strSearchText;
	protected $m_strOnDate;
	protected $m_strFromDate;
	protected $m_strToDate;
	
	/*******************************************************************
	 ************************* Set Function **********************
	 *******************************************************************/
	
	public function setSearchText( $strValue ) {
		$this->m_strSearchText = $strValue;
	}
	
	public function setOnDate( $strValue ) {
		$this->m_strOnDate = $strValue;
	}
	
	public function setFromDate( $strValue ) {
		$this->m_strFromDate = $strValue;
	}
	
	public function setToDate( $strValue ) {
		$this->m_strToDate = $strValue;
	}
	
	/*******************************************************************
	 ************************* Get Function **********************
	 *******************************************************************/
	
	public function getSearchText() {
		return $this->m_strSearchText;
	}
	
	public function getOnDate() {
		return $this->m_strOnDate;
	}
	
	public function getFromDate() {
		return $this->m_strFromDate;
	}
	
	public function getToDate() {
		return $this->m_strToDate;
	}
} 