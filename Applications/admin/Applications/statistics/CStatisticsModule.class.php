<?php
require_once( APP_ADMIN_PORTAL . 'CAdminApp.class.php' );

class CStatisticsModule extends CAdminApp {
		
	protected $m_arrobjDoctors;
	
	function __construct() {
		
	}

	/*******************************************************************
	 ************************* Framework Function **********************
	 *******************************************************************/
	
	function initialize() {
		parent::initialize();
		
		$this->m_strSelectedTab = 'ba';		
	}
	function execute() {
		parent::execute();
		
		switch ( $this->getRequestAction() ) {		
					
			case NULL:
			case 'create_statistics_report':
				$this->handleCreateStatisticsReport();
				break;
			case 'view_current_day_patients':
				$this->handleViewCurrentDayPatients();
				break;	
		}
	}

	/*******************************************************************
	 ************************* Handle Function **********************
	 *******************************************************************/
	
	
	function handleCreateStatisticsReport() {
		
		require_once( LIBRARIES . 'FusionCharts.php' );
		require_once( EOS_PATH  . 'CUser.class.php' );
		require_once( EOS_PATH  . 'CCustomerPathologyTestes.class.php' );
		require_once( EOS_PATH  . 'CDoctors.class.php' );

		$strReportType = '1';
		if( false == is_null( $this->getRequestData( array( 'clinic_statistics', 'report_type' ) ) ) && 0 < strlen( $this->getRequestData( array( 'clinic_statistics', 'report_type' ) ) ) ) {
			$strReportType = $this->getRequestData( array( 'clinic_statistics', 'report_type' ) );
		}
		
		if( false == is_null( $this->getRequestData( array( 'clinic_statistics', 'start_date' ) ) ) && 0 < strlen( $this->getRequestData( array( 'clinic_statistics', 'start_date' ) ) ) && false == is_null( $this->getRequestData( array( 'clinic_statistics', 'end_date' ) ) ) && 0 < strlen( $this->getRequestData( array( 'clinic_statistics', 'end_date' ) ) ) ) {
			
			$strFdate 	= $this->getRequestData( array( 'clinic_statistics', 'start_date' ) );
			$strLDate 	= $this->getRequestData( array( 'clinic_statistics', 'end_date' ) );
			
			$strFirstDate = date('Y-m-d', strtotime( $this->getRequestData( array( 'clinic_statistics', 'start_date' ) ) ) );
			$strLastDate  = date('Y-m-d', strtotime( $this->getRequestData( array( 'clinic_statistics', 'end_date' ) ) ) );
			
		} else {
			$strFirstDate 	= date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date(Y)));
			$strLastDate 	= date('Y-m-t', mktime(0, 0, 0, date('m'), 1, date(Y)));
		}	
		
		$this->m_arrobjDoctors = CDoctors::fetchDoctors( $this->m_resPortalDatabase );
		
		switch ( $strReportType ) {
			case '1':
				$strPathologyData 	= CCustomerPathologyTests::fetchCustomerCountsByDateRangeByTestTypeId( $strFirstDate, $strLastDate, 1, $this->m_resPortalDatabase );
				$strSonographyData 	= CCustomerPathologyTests::fetchCustomerCountsByDateRangeByTestTypeId( $strFirstDate, $strLastDate, 2, $this->m_resPortalDatabase );
				$strXRayData 		= CCustomerPathologyTests::fetchCustomerCountsByDateRangeByTestTypeId( $strFirstDate, $strLastDate, 3, $this->m_resPortalDatabase );
				
				//Initialize <graph> element
				$strXML = "<chart caption='Patient Counts by Dates' subcaption='For " . date( 'dS M Y', strtotime( $strFirstDate )) . " To " . date( 'dS M Y', strtotime( $strLastDate )) . " ' PYAxisName='' SYAxisName='' xAxisName='' palette='2' animation='1' showValues='0' formatNumberScale='0' numberPrefix='' labelDisplay='STAGGER' seriesNameInToolTip='0'>";
				
				//Initialize <categories> element - necessary to generate a multi-series chart
				$strCategories = '<categories><category label=\'\'/><category label=\'\'/><category label=\'\'/></categories>';
				
				//Initiate <dataset> elements
				$strDataSonography 	= '<dataset seriesname=\'Sonography\'><set value=\'' . $strSonographyData[0]['customers'] . '\'/></dataset>';
				$strDataPathology 	= '<dataset seriesname=\'Pathology\'><set value=\'' . $strPathologyData[0]['customers'] . '\'/></dataset>';
				$strDataXRay 		= '<dataset seriesname=\'X-Ray\'><set value=\'' . $strXRayData[0]['customers'] . '\'/></dataset>';
						
				//Assemble the entire XML now
				$strXML .= $strCategories . $strDataSonography . $strDataPathology . $strDataXRay . "</chart>";
		
				break;
			
			case '2':

				$arrStatisticsData 	= CCustomerPathologyTests::fetchCustomerCountsByDateRangeGroupByDoctor( '2015-02-01', $strLastDate, $this->m_resPortalDatabase );
				$arrobjDoctors 		= CDoctors::fetchDoctors( $this->m_resPortalDatabase );
				$arrobjDoctors		= rekeyObjects( 'Id', $arrobjDoctors );
				$arrStatisticsData 	= rekeyArray( 'doctor_id', $arrStatisticsData);

				//Initialize <graph> element
				$strXML = "<chart caption='Patient Counts by Doctors' subcaption='For " . date( 'dS M Y', strtotime( $strFirstDate )) . " To " . date( 'dS M Y', strtotime( $strLastDate )) . " ' palette='10' animation='1' formatNumberScale='0' numberPrefix='' pieSliceDepth='75' startingAngle='850'>";
				
				//Initiate <dataset> elements
				$strDataset = '';
				foreach ( $arrStatisticsData as $key => $statisticsData) {

					if( true == array_key_exists( $key, $arrobjDoctors ) ) {					

						if( -1 == $key ){							
							$strDataset .= '<set label=\''. $arrobjDoctors[$key]->getFirstName() . '\' value=\'' . $statisticsData['customers'] . '\' />';
						} else {							
							$strDataset .= '<set label=\''. $arrobjDoctors[$key]->getFirstName() . ' ' . $arrobjDoctors[$key]->getLastName() . '\' value=\'' . $statisticsData['customers'] . '\' />';
						}						
					}
									
				}

				//Assemble the entire XML now
				$strXML .=  $strDataset . "</chart>";				
				break;
				
			case '3':
				
				$strFirstDate 	= date('Y-m-d', mktime(0, 0, 0, date('m')-2, 1, date(Y)));
				$strLastDate 	= date('Y-m-t', mktime(0, 0, 0, date('m'), 1, date(Y)));
				
				$strStatisticsData 	= CCustomerPathologyTests::fetchCustomerCountsByRecentQuaterGroupByDoctor( $strFirstDate, $strLastDate, $this->m_resPortalDatabase );
		}
		
/*header('Content-type: text/xml');
echo $strXML;exit;*/
		
	
		$this->displayCreateStatisticsReport( $strXML, $strReportType, $strFirstDate, $strLastDate );
	}
	
	/*******************************************************************
	 ************************* Display Function **********************
	 *******************************************************************/
	
	function displayCreateStatisticsReport( $strXML, $strReportType, $strFirstDate, $strLastDate ) {
		
		require_once( SMARTY_LIB . 'CSmarty.class.php' );
		
		$objSmarty = new CSmarty( ADMIN_PORTAL_TEMPLATES );
		
		$this->assignSmartyData( $objSmarty );

		$this->loadExitTags();

		$objSmarty->assign_by_ref( 'doctors', $this->m_arrobjDoctors );
		
		$objSmarty->assign( 'exit_tags', $this->m_arrExitTags );
		$objSmarty->assign( 'strXML', $strXML );
		$objSmarty->assign( 'type', $strReportType );
		$objSmarty->assign( 'first_date', $strFirstDate );
		$objSmarty->assign( 'last_date', $strLastDate );
		
				
		$objSmarty->assign_by_ref( 'objUser', unserialize( $this->getSessionData( 'objUser' )));
		
		if( true == $this->getSessionData( 'objUser' )) {
			$objSmarty->assign( 'is_valid_session', 1 );
		}else {
			$objSmarty->assign( 'is_valid_session', 0 );
		}
		
		$content = $objSmarty->fetch( 'statistics/create_statistics_report.tpl' );
		
		$objSmarty->assign_by_ref( 'content', $content );
		$objSmarty->display( 'common/layout.tpl' );
	}
}