<?php

require_once( '../../defines.php' );
require_once( EOS_BASE . 'CBaseExpences.class.php' );

class CExpences extends CBaseExpences {
		
	public static function fetchExpenceById( $intId, $resDataBase ) {
		$strSql = 'SELECT * FROM expences WHERE id = ' . (int) $intId;
		
		return parent::fetchExpence( $strSql, $resDataBase );
	}
	
	public static function fetchExpencesByCurrentDate( $strDate, $resDataBase ) {
		$strSql = 'SELECT * FROM expences WHERE created_on = \'' . $strDate . '\'';
		
		return parent::fetchExpences( $strSql, $resDataBase );
	}
	
	public static function fetchAllExpences( $resDataBase ) {
		$strSql = 'SELECT * FROM expences';
		
		return parent::fetchExpences( $strSql, $resDataBase );
	}
	
	public static function fetchExpencesBySearchText( $strText, $resDataBase ) {
		$strSql = 'SELECT * FROM expences WHERE reason LIKE \'%' . $strText . '%\'';
		
		return parent::fetchExpences( $strSql, $resDataBase );
	}
	
	public static function fetchCurrentDayExpencesAmount( $strCurrentDate, $resDataBase ) {
		$strSql = 'SELECT SUM(amount)as amt FROM expences WHERE created_on = "' . $strCurrentDate . '"';
		
		return fetchData( $strSql, $resDataBase );
	}
}

?>