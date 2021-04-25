<?php
// Validate Init
$ValidationMsgA = array();

// Validate ContactsComms ID
// if ( \xan\isEmpty( $doParam[ 'IDContactsComms' ] ) ) {
//     $ValidationMsgA[] = "Contact ID is Blank";
// }

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	$aloe_response->status_set( '400 Bad Request: ' . implode( ", ", $ValidationMsgA ) );
	$aloe_response->content_set( 'Error' );
	return;
}

// Request Do
$ch = curl_init();
curl_setopt( $ch, CURLOPT_URL, URL_BASE . 'api-do-queued' );
// curl_setopt( $ch, CURLOPT_POST, true );
// curl_setopt( $ch, CURLOPT_POSTFIELDS, $paramsAPIString );
curl_setopt( $ch, CURLOPT_HEADER, true );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
$curlResult = curl_exec( $ch );
$curlHeaderSize = curl_getinfo( $ch, CURLINFO_HEADER_SIZE );
curl_close( $ch );

// Body Get
$bodyJSON = trim( substr( $curlResult, $curlHeaderSize ) );
$bodyD = json_decode( $bodyJSON, true );

// Show Alert
$resp->jsAlert( json_encode( $doParam ) . "\r\r" . json_encode( $apiParam ) . "\r\r" . $bodyJSON );

// Actions Return as JSON
$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
return;
?>