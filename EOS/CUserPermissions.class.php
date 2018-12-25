<?php
require_once( '../../defines.php' );
require_once( EOS_BASE . 'CBaseUserPermissions.class.php' );

class CUserPermissions extends CBaseUserPermissions {

	public static function fetchUserPermissionsByUserId( $intUserId, $resDataBase ) {
		$strSql = 'SELECT * FROM user_permissions WHERE user_id = ' . (int) $intUserId;

		return parent::fetchUserPermissions( $strSql, $resDataBase );
	}
}
?>