<?php

require_once( '../../defines.php' );
require_once( EOS_BASE . 'CBaseUsers.class.php' );

class CUsers extends CBaseUsers {
	
	public static function fetchUserByUsernameByPasswordByTypeId( $strUsername, $strPassword, $resDataBase ) {
		$strSql = 'SELECT 
							u.* 
				   FROM 
				   		users u 
				   WHERE 
				   		username = \'' . (string) $strUsername . '\'
				   		AND password = \'' . (string) $strPassword . '\'';
		
		return CUsers::fetchUser( $strSql, $resDataBase );
	}
	
	public static function fetchUserById( $intUserId, $resDataBase ) {
		$strSql = 'SELECT * FROM users WHERE id = ' . (int) $intUserId;
		
		return parent::fetchUser( $strSql, $resDataBase );
	}

	public static function fetchUsersByTypeId( $intTypeId, $resDataBase ) {
		$strSql = 'SELECT * FROM users WHERE type = ' . (int) $intType;
		
		return parent::fetchUsers( $strSql, $resDataBase );
	}
	
	public static function fetchAllUsers( $resDatabase ) {
		$strSql = 'SELECT * FROM users';
		
		return parent::fetchUsers( $strSql, $resDatabase );
	}

	/*public static function fetchUser( $strSql, $resDataBase ) {		
		$resQuery = mysql_query( $strSql, $resDataBase );	
		$arrUser = mysql_fetch_assoc($resQuery);			
		
		return $arrUser;
	}*/
}

?>