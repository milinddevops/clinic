<?php

require_once( EOS_PATH . 'CDatabackup.class.php' );

class CBaseDatabackups {
	
	public static function fetchDatabackups( $strSql, $resDataBase ) {
					
		$resQuery = mysql_query( $strSql, $resDataBase );
		
		while ( $resData = mysql_fetch_assoc( $resQuery )) {
			if( $resData ) {
				$objDatabackup = new CDatabackup();
			
				$objDatabackup->setValues( $resData );		
				
				$arrobjDatabackups[] = $objDatabackup;				
			}
		}
		
		return $arrobjDatabackups;
	}	
	
	public static function fetchDatabackup( $strSql, $resDataBase ) {		
		$resQuery = mysql_query( $strSql, $resDataBase );
		
		$resData = mysql_fetch_assoc( $resQuery );
		
		if( $resData ) {
			$objDatabackup = new CDatabackup();
		
			$objDatabackup->setValues( $resData );
		}else {
			$objDatabackup = NULL;
		}
				
		return $objDatabackup;
	}
}

?>