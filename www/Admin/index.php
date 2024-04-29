<?php

	require_once( '../../defines.php' );
	require_once( APP_FRAMEWORK_CLASSES . 'CFrameWork.class.php' );
	error_reporting(E_ERROR);

	
	$objApplication = CFrameWork::createApplication( APP_ADMIN_PORTAL );
	
	$objApplication->create();
	$objApplication->initialize();	
	$objApplication->execute();
	$objApplication->finalize();
	$objApplication->render();
	$objApplication->distroy();
	
?>