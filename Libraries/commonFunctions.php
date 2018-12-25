<?php
function display( $var ) {
	echo '<pre>';
	print_r( $var );
	echo '</pre>';
}

function rekeyObjects( $fieldname, $arrObject ) {	
	$arrObj = array();
	$getFunction = "get" . $fieldname;

	foreach( $arrObject as $obj ) {		
		$arrObj[$obj->$getFunction()] = $obj;
	}

	return $arrObj;
}

function rekeyArray( $keyName, $arrData ) {	
	$arrRecords = array();

	foreach( $arrData as $arr ) {
		$arrRecords[$arr[$keyName]] = $arr;
	}

	return $arrRecords;
}

function fetchData( $strSql, $resDatabase ) {
	$resQuery = mysql_query( $strSql, $resDatabase );
	
	return mysql_fetch_array( $resQuery );
}

function runQuery( $strSql ) {
	return mysql_query( $strSql ) or die( 'ERROR: ' . mysql_error() );
}

function fetchAllTables(){
	$tables = array();
	$result = mysql_query('SHOW TABLES');
	$strTempTable = array();
	while($row = mysql_fetch_row($result)) {
		if( 'customer_pathology_tests' != $row[0] && 'patient_payments' != $row[0] && 'user_permissions' != $row[0] ) {
			$tables[] = $row[0];
		}
	}
	$tables[] = 'customer_pathology_tests';
	$tables[] = 'patient_payments';
	$tables[] = 'user_permissions';

	return $tables;
}

function getMac() {

	if( 'Linux' == PHP_OS ) {
		$mac = shell_exec('/sbin/ifconfig -a | grep -Po \'eth0(.)*HWaddr \K.*$\'');
		return $mac;

	} else {
		//Get the ipconfig details using system commond
		$strOutPut = system('ipconfig /all', $strReturn );
		display($strOutPut);exit;
		$findme = "Physical";
		//Search the "Physical" | Find the position of Physical text
		$pmac = strpos($strReturn, $findme);
		 
		// Get Physical Address
		$mac=substr($strReturn,($pmac+36),17);
		//Display Mac Address
	}

	
	return $mac;
}