<?php

require_once( '../../defines.php' );
require_once( EOS_BASE . 'CBaseDatabackups.class.php' );

class CDatabackups extends CBaseDatabackups {
		
	public static function fetchDatabackupById( $intUserId, $resDataBase ) {
		$strSql = 'SELECT * FROM databackups WHERE id = ' . (int) $intUserId;
		
		return parent::fetchDatabackup( $strSql, $resDataBase );
	}
	
	public static function fetchTableData( $strTableName, $strStartDate, $strEndDate, $resDataBase ) {
		$strSql = 'SELECT * FROM ' . $strTableName . 'WHERE ';
		
		$arrTableData = array();
		$resTableData = mysql_query( $strSql );
		while( $row = mysql_fetch_row( $resTableData ) )
		{
			$arrTableData[$row[0]][] = $row;
		}
		
		return $arrTableData;
	}
	
	public static function fetchAllDatabackups( $resDataBase ) {
		$strSql = 'SELECT * FROM databackups';
		
		return parent::fetchDatabackups( $strSql, $resDataBase );
	}
}

?>