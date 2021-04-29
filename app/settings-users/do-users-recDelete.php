<?php
// Validate Init
$ValidationMsgA = array();

// Validate ID
if ( \xan\isEmpty( $doParam[ $mmUsersT->NameTableParam ] ) ) {
	$ValidationMsgA[] = "Users ID is Blank";
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	$aloe_response->status_set( '400 Bad Request: ' . implode( ', ', $ValidationMsgA ) );
	$aloe_response->content_set( 'Error' );
	return;
}

// Delete
$recs = new \xan\recs( $mmUsersT );
$recs->recordDelete( $doParam[ $mmUsersT->NameTableParam ] );

// Error Check
if ( $recs->errorB ) {
	$ValidationMsgA[] = $mmUsersT->NameSingular . ' Delete Error' . $recs->messageExtra . '; ' . $recs->messageSQL;
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	$aloe_response->status_set( '500 Internal Service Error: ' . implode( ", ", $ValidationMsgA ) );
	$aloe_response->content_set( 'Error' );
	return;
}

// Go to the List
$resp->jsSetPageURL( $mmUsersT->URLFull );

// Actions Return as JSON
$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
return;
?>