<?php 

	define( 'APP_FRAMEWORK_CLASSES', '../../Framework/Classes/' );
	define( 'APP_ADMIN_PORTAL', '../../Applications/admin/Applications/' );
	define( 'BASE_DB_CLASS', '/base/' );
	define( 'ADMIN_PORTAL_TEMPLATES', '../../Interfaces/Templates/Admin/' );
	define( 'INTERFACES', '../../Interfaces/Templates/' );
	define( 'SMARTY_LIB', '../../Libraries/smarty/libs/' );
	define( 'LIBRARIES', '../../Libraries/' );
	define( 'EOS_BASE', '../../EOS/Base/' );
	define( 'EOS_PATH', '../../EOS/' );
	define( 'BACKUP_PATH', '../../database_backups/');
	define( 'LICENSE_PATH', '../../');

	
	/* Module definations  */
	
	define( 'REQUEST_MODULE', $_REQUEST['module'] );
	define( 'REQUEST_DEFAULT', 'default' );
	define( 'REQUEST_ACTION', $_REQUEST['action'] );

?>
