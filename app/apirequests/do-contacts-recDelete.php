<?php
// Validate Init
$ValidationMsgA = array();

// Validate ID
if ( \xan\isEmpty( $doParam[ $mmAPIRequestsT->NameTableParam ] ) ) {
    $ValidationMsgA[] = $mmAPIRequestsT->NameSingular .  " ID is Blank";
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
    $aloe_response->status_set( '400 Bad Request: ' . implode( ', ', $ValidationMsgA ) );
    $aloe_response->content_set( 'Error' );
    return;
}

// Delete
$recs = new \xan\recs( $mmAPIRequestsT );
$recs->recordDelete( $doParam[ $mmAPIRequestsT->NameTableParam ] );

// Error Check
if ( $recs->errorB ) {
	$ValidationMsgA[] = $mmAPIRequestsT->NameSingular . ' Delete Error' . $recs->messageExtra . '; ' . $recs->messageSQL;
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	$aloe_response->status_set( '500 Internal Service Error: ' . implode( ", ", $ValidationMsgA ) );
	$aloe_response->content_set( 'Error' );
	return;
}

// Go to the List
$resp->jsSetPageURL( $mmAPIRequestsT->URLFull );

// Actions Return as JSON
$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
?>