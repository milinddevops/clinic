<?php

require_once( '../../defines.php' );

class CFrameWork {
	
	public static function createApplication( $strAppPath = NULL ) {
		
		if( false == is_null( $strAppPath )) {			
			require_once( $strAppPath . 'assignApplications.php' );		
		}
		
		$strModuleFilePath = $arrModules[REQUEST_MODULE];
		
		if( true == is_null( $arrModules[REQUEST_MODULE] )) {
			$strModuleFilePath = $arrModules[REQUEST_DEFAULT];
		}
				
		require_once( $strAppPath . $strModuleFilePath );
		
		$strClassName = str_replace( '.class.php', '', substr( $strModuleFilePath, strrpos( $strModuleFilePath, '/' ) +1));
		$object = new $strClassName;
		
		return $object;
	}
}