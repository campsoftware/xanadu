<?php

// Timer Begin
$timer[ 'TotalTimeBegin' ] = \xan\microsecsNow();

// Response Init
$resp = new \xan\response;
$resp->reqPath = \xan\paramEncode( $aloe_request->path_get() );
$resp->reqPathComponents = \xan\paramEncode( $aloe_request->path_components_get() );
$resp->reqPost = \xan\paramEncode( $aloe_request->post );


///////////////////////////////////////////////////////////
// Semaphore Check
if ( false ) {
	$semaphoreKey = \xan\strAsciiSum( basename( __FILE__ ) );
	$semaphore = sem_get( $semaphoreKey, 1, 0666, 1 );
	if ( $semaphore === false ) {
		$resp->api[ 'Code' ] = 'Error';
		$resp->api[ 'Message' ] = 'SEMAPHORE NOT AVAILABLE';
		$aloe_response->status_set( '503 Service Unavailable' );
		$aloe_response->content_set( json_encode( $resp->api ) );
		return;
	} else {
		if ( sem_acquire( $semaphore, true ) === false ) {
			$resp->api[ 'Code' ] = 'Error';
			$resp->api[ 'Message' ] = 'SEMAPHORE IN USE';
			$aloe_response->status_set( '503 Service Unavailable' );
			$aloe_response->content_set( json_encode( $resp->api ) );
			return;
		}
	}// Released Below at the End
}


///////////////////////////////////////////////////////////
// Query for Queued APIRequests
$apirequestsRecs = new \xan\recs( $mmAPIRequestsT );
$apirequestsRecs->querySQL = 'SELECT * FROM APIRequests WHERE RequestIsProcessed = "No" or RequestIsSent = "No" ORDER BY RequestTS ASC';
$apirequestsRecs->queryBindNamesA = array();
$apirequestsRecs->queryBindValuesA = array();
$apirequestsRecs->query();

// Error Check
if ( $apirequestsRecs->errorB ) {
	$resp->api[ 'Code' ] = 'Error';
	$resp->api[ 'Message' ] = 'Request Select Error';
	$aloe_response->status_set( '500 Internal Service Error' );
	$aloe_response->content_set( json_encode( $resp->api ) );
	return;
} elseif ( $apirequestsRecs->rowCount < 1 ) {
	// None Found
} elseif ( $apirequestsRecs->rowCount > 0 ) {
	$apirequestsRecs->rowIndex = -1;
	
	// FM Int
	require( 'include/fmrest/2019-06-19/fmREST.php' );
	
	// For Each Request
	foreach ( $apirequestsRecs->rowsD as $apirequestsRecsRow ) {
		$apirequestsRecs->rowIndex++;
		
		// This Request Begin
		
		// Timer Begin
		$timer[ 'RequestTimeBegin' ] = \xan\microsecsNow();
		
		// Request Process
		if ( $apirequestsRecsRow[ 'Action' ] !== 'Response' and $apirequestsRecsRow[ 'RequestIsProcessed' ] === 'No' ) {
			
			// Timer Begin
			$timer[ 'RequestUpdateTimeBegin' ] = \xan\microsecsNow();
			
			// Get Prior ResponseData
			$priorResponseData = $apirequestsRecsRow[ 'ResponseData' ];
			
			
			///////////////////////////////////////////////////////////
			// Request Update to Run
			$apirequestsUpdate = new \xan\recs( $mmAPIRequestsT );
			$apirequestsUpdate->querySQL = 'UPDATE APIRequests SET RequestIsProcessed = ? WHERE UUIDAPIRequests = ?';
			$apirequestsUpdate->queryBindNamesA = array( 'RequestIsProcessed', 'UUIDAPIRequests' );
			$apirequestsUpdate->queryBindValuesA = array( 'Run', $apirequestsRecsRow[ 'UUIDAPIRequests' ] );
			$apirequestsUpdate->query();
			
			// Error Check
			if ( $apirequestsUpdate->errorB ) {
				$resp->api[ 'Code' ] = 'Error';
				$resp->api[ 'Message' ] = 'Request Update Error';
				$aloe_response->status_set( '500 Internal Service Error' );
				$aloe_response->content_set( json_encode( $resp->api ) );
				return;
			} elseif ( $apirequestsUpdate->rowCount < 1 ) {
				$resp->api[ 'Code' ] = 'Error';
				$resp->api[ 'Message' ] = 'Request Update Not Found';
				$aloe_response->status_set( '500 Internal Service Error' );
				$aloe_response->content_set( json_encode( $resp->api ) );
				return;
			} elseif ( $apirequestsUpdate->rowCount > 0 ) {
				$apirequestsRecsRow[ 'RequestIsProcessed' ] = 'Run';
			}
			
			// Timer End
			$timer[ 'RequestUpdateTime' ] = \xan\microsecsDiff( $timer[ 'RequestUpdateTimeBegin' ] );
			
			
			///////////////////////////////////////////////////////////
			// Request Process Now
			if ( true ) {
				
				// Timer Begin
				$timer[ 'RequestProcessTimeBegin' ] = \xan\microsecsNow();
				
				// Process
				if ( $apirequestsRecsRow[ 'Action' ] === 'RandomAmount' ) {
					require_once( "randomAmount-process.php" );
					$apirequestsRecsRow[ 'ResponseData' ] = json_encode( $resp->api );
				}
				
				// Error Check
				if ( $resp->api[ 'Code' ] === '0' ) {
					$apirequestsRecsRow[ 'ResponseTS' ] = \xan\dateTimeNowSQL();
					$apirequestsRecsRow[ 'RequestIsProcessed' ] = 'Yes';
				} else {
					$apirequestsRecsRow[ 'RequestIsProcessed' ] = 'No';
				}
				
				// Timer End
				$timer[ 'RequestProcessTime' ] = \xan\microsecsDiff( $timer[ 'RequestProcessTimeBegin' ] );
				
			}
			
		}
		
		
		///////////////////////////////////////////////////////////
		// Response Send
		if ( $apirequestsRecsRow[ 'Action' ] !== 'Response' and $apirequestsRecsRow[ 'RequestIsProcessed' ] === 'Yes' and $apirequestsRecsRow[ 'RequestIsSent' ] === 'No' ) {
			
			// Timer
			$timer[ 'ResponseSendTimeBegin' ] = \xan\microsecsNow();
			
			// Request Params
			$apiParam = json_decode( $apirequestsRecsRow[ 'ResponseData' ], true );
			$apiParam[ 'Auth' ] = $apirequestsRecsRow[ 'ResponseAuth' ];
			$apiParam[ 'Action' ] = 'Response';
			$apiParam[ 'ActionID' ] = $apirequestsRecsRow[ 'ActionID' ];
			$apiParamString = http_build_query( $apiParam ); //url-ify the data
			
			// Request Do
			$ch = curl_init();
			curl_setopt( $ch, CURLOPT_URL, $apirequestsRecsRow[ 'ResponseURL' ] );
			curl_setopt( $ch, CURLOPT_POST, true );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $apiParamString );
			curl_setopt( $ch, CURLOPT_HEADER, true );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			$curlResult = curl_exec( $ch );
			$curlHeaderSize = curl_getinfo( $ch, CURLINFO_HEADER_SIZE );
			$curlResponseCode = curl_getinfo( $ch, CURLINFO_RESPONSE_CODE );
			curl_close( $ch );
			
			// Body Get
			$bodyJSON = trim( substr( $curlResult, $curlHeaderSize ) );
			$bodyD = json_decode( $bodyJSON, true );
			
			// Check for Response Success
			if ( $curlResponseCode >= '200' && $curlResponseCode <= '299' ) {
				$apirequestsRecsRow[ 'RequestIsSent' ] = 'Yes';
				$apirequestsRecsRow[ 'ResponseData' ] = json_encode( $apiParam );
			}
			
			// Timer
			$timer[ 'ResponseSendTime' ] = \xan\microsecsDiff( $timer[ 'ResponseSendTimeBegin' ] );
			
		}
		
		
		///////////////////////////////////////////////////////////
		// Request Update
		
		// Timer End
		$timer[ 'RequestTime' ] = \xan\microsecsDiff( $timer[ 'RequestTimeBegin' ] );
		$apirequestsRecsRow[ 'Log' ] .= 'Total Time: ' . $timer[ 'RequestTime' ] . "; ";
		$apirequestsRecsRow[ 'Log' ] .= 'Update Time: ' . $timer[ 'RequestUpdateTime' ] . "; ";
		$apirequestsRecsRow[ 'Log' ] .= 'Process Time: ' . $timer[ 'RequestProcessTime' ] . "; ";
		$apirequestsRecsRow[ 'Log' ] .= 'Send Time: ' . $timer[ 'ResponseSendTime' ] . "; ";
		
		// Request Update
		$newResponseData = $priorResponseData . $apirequestsRecsRow[ 'ResponseData' ];
		$apirequestsUpdate = new \xan\recs( $mmAPIRequestsT );
		$apirequestsUpdate->querySQL = 'UPDATE APIRequests SET RequestIsProcessed = ?, RequestIsSent = ?, Log = ?, RequestIsProcessed = ?, ResponseTS = ?, ResponseData = ?, ResponseCode = ?, ResponseMessage = ? WHERE UUIDAPIRequests = ?';
		$apirequestsUpdate->queryBindNamesA = array( 'RequestIsProcessed', 'RequestIsSent', 'Log', 'RequestIsProcessed', 'ResponseTS', 'ResponseData', 'ResponseCode', 'ResponseMessage', 'UUIDAPIRequests' );
		$apirequestsUpdate->queryBindValuesA = array( $apirequestsRecsRow[ 'RequestIsProcessed' ], $apirequestsRecsRow[ 'RequestIsSent' ], $apirequestsRecsRow[ 'Log' ], $apirequestsRecsRow[ 'RequestIsProcessed' ], $apirequestsRecsRow[ 'ResponseTS' ], $newResponseData, $apirequestsRecsRow[ 'ResponseCode' ], $apirequestsRecsRow[ 'ResponseMessage' ], $apirequestsRecsRow[ 'UUIDAPIRequests' ] );
		$apirequestsUpdate->query();
		
		// Error Check
		if ( $apirequestsUpdate->errorB ) {
			$resp->api[ 'Code' ] = 'Error';
			$resp->api[ 'Message' ] = 'Request Update Error';
			$aloe_response->status_set( '500 Internal Service Error' );
			$aloe_response->content_set( json_encode( $resp->api ) );
			return;
		} elseif ( $apirequestsUpdate->rowCount < 1 ) {
			$resp->api[ 'Code' ] = 'Error';
			$resp->api[ 'Message' ] = 'Request Update Not Found';
			$aloe_response->status_set( '500 Internal Service Error' );
			$aloe_response->content_set( json_encode( $resp->api ) );
			return;
		} elseif ( $apirequestsUpdate->rowCount > 0 ) {
			// Success!
		}
		
		// This Request End
	}
	
}

// Timer End
$timer[ 'TotalTime' ] = \xan\microsecsDiff( $timer[ 'TotalTimeBegin' ] );

///////////////////////////////////////////////////////////
// Semaphore Release Exclusive Control
if ( false ) {
	$semaphoreReleased = sem_release( $semaphore );
}

$resp->api[ 'Code' ] = '0';
$resp->api[ 'Message' ] = 'OK';
$resp->api[ 'Time' ] = $timer[ 'TotalTime' ];
$aloe_response->content_set( json_encode( $resp->api ) );
return;
?>