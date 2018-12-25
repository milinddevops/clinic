<?php

require_once( '../../defines.php' );
require_once( EOS_BASE . 'CBaseReminders.class.php' );

class CReminders extends CBaseReminders {

	
	public static function fetchAllReminders( $resDataBase ) {
		$strSql = 'SELECT * FROM reminders';
		
		return parent::fetchReminders( $strSql, $resDataBase );
	}
	
	public static function fetchReminderById( $intId, $resDataBase ) {
		$strSql = 'SELECT * FROM reminders WHERE id = ' . (int) $intId;
		
		return parent::fetchReminder( $strSql, $resDataBase );
	}
	
	public static function fetchRemindersByCurrentDate( $strDate, $resDataBase ) {
		$strSql = ' SELECT *
					FROM 
						reminders
					WHERE 
						alert_on = EXTRACT(DAY FROM \''. $strDate .'\' )';
		
		return parent::fetchReminders( $strSql, $resDataBase );
	}
		
	public static function fetchRemindersBySearchText( $strText, $resDataBase ) {
		$strSql = 'SELECT * FROM reminders WHERE description LIKE \'%' . $strText . '%\'';
		
		return parent::fetchReminders( $strSql, $resDataBase );
	}
}

?>