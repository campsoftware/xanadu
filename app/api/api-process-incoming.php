<?php
// Timer Begin
$timer[ 'TotalTimeBegin' ] = \xan\microsecsNow();

// Response Init
$resp = new \xan\response;
$resp->reqPath = \xan\paramEncode( $aloe_request->path_get() );
$resp->reqPathComponents = \xan\paramEncode( $aloe_request->path_components_get() );
$resp->reqPost = \xan\paramEncode( $aloe_request->post );

// Timer Begin
$timer[ 'RequestValidateTimeBegin' ] = \xan\microsecsNow();

// Validate Init
$ValidationMsgA = array();
$responseAuth = '';
$responseURL = '';

///////////////////////////////////////////////////////////
// Validate Auth
if ( !isset( $resp->reqPost[ 'Auth' ] ) or \xan\isEmpty( $resp->reqPost[ 'Auth' ] ) ) {
	$ValidationMsgA[] = "Not Authorized";
} else {
	switch ( $resp->reqPost[ 'Auth' ] ) {
		case 'api123':
			$responseAuth = $resp->reqPost[ 'Auth' ];
			$responseURL = URL_BASE . 'api';
			$resp->reqPost[ 'Auth' ] = APP_NAME;
			break;
		default:
			$ValidationMsgA[] = "Not Authorized";
	}
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	$resp->api[ 'Code' ] = 'Error';
	$resp->api[ 'Message' ] = implode( ', ', $ValidationMsgA );
	$aloe_response->status_set( '400 Bad Request' );
	$aloe_response->content_set( json_encode( $resp->api ) );
	return;
}

// Validate ActionID
if ( !isset( $resp->reqPost[ 'ActionID' ] ) or \xan\isEmpty( $resp->reqPost[ 'ActionID' ] ) ) {
	$ValidationMsgA[] = "ActionID Missing";
} else {
	// Validate ActionID
	if ( !preg_match( "/^[A-Za-z0-9-]+$/", $resp->reqPost[ 'ActionID' ] ) ) { // Only Letters, Number, Hyphen are Valid
		$ValidationMsgA[] = "ActionID Invalid Character";
	}
}

// Validate Action
if ( !isset( $resp->reqPost[ 'Action' ] ) or \xan\isEmpty( $resp->reqPost[ 'Action' ] ) ) {
	$ValidationMsgA[] = "Action Missing";
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	$resp->api[ 'Code' ] = 'Error';
	$resp->api[ 'Message' ] = implode( ', ', $ValidationMsgA );
	$aloe_response->status_set( '400 Bad Request' );
	$aloe_response->content_set( json_encode( $resp->api ) );
	return;
}

// Timer End
$timer[ 'RequestValidateTime' ] = \xan\microsecsDiff( $timer[ 'RequestValidateTimeBegin' ] );

// Timer Begin
$timer[ 'RequestProcessTimeBegin' ] = \xan\microsecsNow();

///////////////////////////////////////////////////////////
// Process Init
$processType = 'none';
$RequestIsProcessed = 'No';
$RequestIsSent = 'No';
$ResponseIsProcessed = 'Yes';

// Request Action Router
switch ( $resp->reqPost[ 'Action' ] ) {
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	case 'Response':
		$processType = 'queued';
		$RequestIsProcessed = 'Yes';
		$RequestIsSent = 'Yes';
		if ( $resp->reqPost[ 'Auth' ] = APP_NAME ) {
			$ResponseIsProcessed = 'Yes';
		} else {
			$ResponseIsProcessed = 'No';
		}
		break;
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	case 'RandomAmount':
		require_once( "randomAmount-check.php" );
		if ( $resp->reqPost[ 'Queued' ] !== 'Yes' ) {
			$processType = 'now';
			require_once( "randomAmount-process.php" );
		} else {
			$processType = 'queued';
		}
		break;
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	default:
		$resp->api[ 'Code' ] = 'Error';
		$resp->api[ 'Message' ] = 'Action Invalid';
		$aloe_response->status_set( '400 Bad Request' );
		$aloe_response->content_set( json_encode( $resp->api ) );
		return;
}

// Timer End
$timer[ 'RequestProcessTime' ] = \xan\microsecsDiff( $timer[ 'RequestProcessTimeBegin' ] );


///////////////////////////////////////////////////////////
// Timer End
$timer[ 'TotalTime' ] = \xan\microsecsDiff( $timer[ 'TotalTimeBegin' ] );
$Log = 'Total Time: ' . $timer[ 'TotalTime' ] . "; ";
$Log .= 'Validate Time: ' . $timer[ 'RequestValidateTime' ] . "; ";
$Log .= 'Process Time: ' . $timer[ 'RequestProcessTime' ] . "; ";


///////////////////////////////////////////////////////////
// Request Save
if ( $processType === 'now' ) {
	$tsNowSQL = \xan\dateTimeNowSQL();
	$sqlCols = array( 'UUIDAPIRequests', 'Auth', 'Action', 'ActionID', 'ResponseURL', 'ResponseAuth', 'RequestIsProcessed', 'RequestIsSent', 'RequestTS', 'RequestData', 'ResponseIsProcessed', 'ResponseTS', 'ResponseData' );
	$sql = 'INSERT INTO APIRequests ( ' . implode( ', ', $sqlCols ) . ' ) VALUES ( ' . \xan\dbSQL_InsertValuesQuestions( count( $sqlCols ) ) . ' )';
	$bindValues = array( \xan\strUUID(), $resp->reqPost[ 'Auth' ], $resp->reqPost[ 'Action' ], $resp->reqPost[ 'ActionID' ], $responseURL, $responseAuth, 'Yes', 'Yes', $tsNowSQL, json_encode( $resp->reqPost ), $ResponseIsProcessed, $tsNowSQL, json_encode( $resp->api ) );
	$apirequestsInsert = \xan\recsQuerySimple( $sql, $sqlCols, $bindValues );// Error Check
	if ( $apirequestsInsert->errorB or $apirequestsInsert->rowCount < 1 ) {
		$resp->api[ 'Code' ] = 'Error';
		$resp->api[ 'Message' ] = 'Request Save Error';
		$aloe_response->status_set( '500 Internal Service Error' );
		$aloe_response->content_set( json_encode( $resp->api ) );
		return;
	} else {
		// Success
	}
	
	$aloe_response->content_set( json_encode( $resp->api ) );
	return;
}


///////////////////////////////////////////////////////////
// Request Queue
if ( $processType === 'queued' ) {
	$requestUUID = \xan\strUUID();
	$tsNowSQL = \xan\dateTimeNowSQL();
	$sqlCols = array( 'UUIDAPIRequests', 'Auth', 'Action', 'ActionID', 'ResponseURL', 'ResponseAuth', 'RequestIsProcessed', 'RequestIsSent', 'RequestTS', 'RequestData', 'ResponseIsProcessed', 'ResponseTS', 'ResponseData' );
	$sql = 'INSERT INTO APIRequests ( ' . implode( ', ', $sqlCols ) . ' ) VALUES ( ' . \xan\dbSQL_InsertValuesQuestions( count( $sqlCols ) ) . ' )';
	$bindValues = array( $requestUUID, $resp->reqPost[ 'Auth' ], $resp->reqPost[ 'Action' ], $resp->reqPost[ 'ActionID' ], $responseURL, $responseAuth, $RequestIsProcessed, $RequestIsSent, $tsNowSQL, json_encode( $resp->reqPost ), $ResponseIsProcessed, $tsNowSQL, json_encode( $resp->api ) );
	$apirequestsInsert = \xan\recsQuerySimple( $sql, $sqlCols, $bindValues );
	
	// Error Check
	if ( $apirequestsInsert->errorB or $apirequestsInsert->rowCount < 1 ) {
		$resp->api[ 'Code' ] = 'Error';
		$resp->api[ 'Message' ] = 'Request Save Error';
		$aloe_response->status_set( '500 Internal Service Error' );
		$aloe_response->content_set( json_encode( $resp->api ) );
	} else {
		$resp->api[ 'Code' ] = '0';
		$resp->api[ 'Message' ] = 'Accepted';
		$aloe_response->status_set( '202 Accepted' );
		$aloe_response->content_set( json_encode( $resp->api ) );
	}
	
	// Request Update Response
	$requestUpdate = \xan\recsQuerySimple( 'UPDATE APIRequests SET ResponseData = ? WHERE UUIDAPIRequests = ?', array( 'ResponseData', 'UUIDAPIRequests' ), array( json_encode( $resp->api ), $requestUUID ) );
	return;
}
?>