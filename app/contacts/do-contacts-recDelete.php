<?php
// Response Init
$resp = new \xan\response;

// Validate Init
$ValidationMsgA = array();

// Validate Contact ID
if ( \xan\isEmpty( $doParam[ 'IDContacts' ] ) ) {
    $ValidationMsgA[] = "Contact ID is Blank";
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
    $aloe_response->status_set( '400 Bad Request: ' . implode( ', ', $ValidationMsgA ) );
    $aloe_response->content_set( 'Error' );
    return;
}

// Delete
$recs = new \xan\recs( $mmContactsT );
$recs->recordDelete( $doParam[ 'IDContacts' ] );

// Error Check
if ( $recs->errorB ) {
	$ValidationMsgA[] = 'Contact Delete Error' . $recs->messageExtra . '; ' . $recs->messageSQL;
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	$aloe_response->status_set( '500 Internal Service Error: ' . implode( ", ", $ValidationMsgA ) );
	$aloe_response->content_set( 'Error' );
	return;
}

// Go to the List
$resp->jsSetPageURL( $mmContactsT->URLFull );

// Actions Return as JSON
$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
?>