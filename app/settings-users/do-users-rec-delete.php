<?php
// Validate Init
$ValidationMessage = array();

// Validate Contact ID
if ( xan\isEmpty( $doParam[ 'IDUsers' ] ) ) {
	$ValidationMessage[] = "Users ID is Blank";
}

// Invalid Response
if ( !empty( $ValidationMessage ) ) {
	$aloe_response->status_set( '400 Bad Request: ' . implode( ', ', $ValidationMessage ) );
	$aloe_response->content_set( 'Error' );
	return;
}

// Delete
$recs = new \xan\recs( $mmUsersT );
$recs->recordDelete( $doParam[ 'IDUsers' ] );

// Error Check
if ( $recs->errorB ) {
	$aloe_response->status_set( '500 Internal Service Error: ' . $recs->messageExtra . '; ' . $recs->messageSQL );
	return;
}

// Result
$result[ 'Do_URLLoad' ] = $mmUsersT->URLFull;

// Return JSON
$resultJSON = json_encode( $result );
$aloe_response->content_set( $resultJSON );
return;
?>