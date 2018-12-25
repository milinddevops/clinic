<?php

	require_once( '../../defines.php' );
	require_once( LIBRARIES . 'commonFunctions.php' );
	
	define( 'DB_USER', 'root' );
	define( 'DB_PASSWORD', '' );
	define( 'DB_HOST', 'localhost' );
	define( 'DB_NAME', 'ghatge' );

	$resPortalDatabase 	= createDatabase();
	$strMacKey 			= getMac();

	$strSql = 'INSERT INTO xyzz_view ( 
			owner_first_name,
			owner_last_name,
			activation_url,
			mac,
			activation_key,
			validate_till,
			created_on		
		) VALUES (
			"' . $_POST['license']['first_name'] . '",
			"' . $_POST['license']['last_name'] . '",
			"' . $_POST['license']['url'] . '",	
			"' . $strMacKey . '",
			"' . $_POST['license']['key'] . '",	
			"0",
			NOW()
		)';

	$ch = curl_init();
	$curlConfig = array(
	    CURLOPT_URL            => $_POST['license']['url'],
	    CURLOPT_RETURNTRANSFER => true,   // return web page
        CURLOPT_HEADER         => false,  // don't return headers
        CURLOPT_FOLLOWLOCATION => true,   // follow redirects
        CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
        CURLOPT_ENCODING       => "",     // handle compressed
        CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
        CURLOPT_TIMEOUT        => 120,    // time-out on response
	    CURLOPT_POSTFIELDS     => array(
	        'first_name' 	   	=> $_POST['license']['first_name'],
	        'last_name' 		=> $_POST['license']['last_name'],
	        'mac_key' 			=> $strMacKey,
	        'license_key'	 	=> $_POST['license']['key'],
	    )
	);
	curl_setopt_array($ch, $curlConfig);
	$result = curl_exec($ch);
	curl_close($ch);

	$res = runQuery( $strSql );
	print_r($res);
	
	function createDatabase() {
		require_once( APP_FRAMEWORK_CLASSES . '/base/CBaseDatabase.class.php' );
		
		 return CBaseDatabase::loadPortalDb();
	}