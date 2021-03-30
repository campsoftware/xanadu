<?php
// Validate Init
$ValidationMsgA = array();

// Validate Contacts ID
if ( \xan\isEmpty( $doParam[ 'IDContacts' ] ) ) {
    $ValidationMsgA[] = $mmContactsT->NameSingular . " Contact ID is Blank";
}

// Validate ContactsComms ID
if ( \xan\isEmpty( $doParam[ 'IDContactsComms' ] ) ) {
    $ValidationMsgA[] = $mmContactsCommsT->NameSingular . "Comm ID is Blank";
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
    $aloe_response->status_set( '400 Bad Request: ' . implode( ', ', $ValidationMsgA ) );
    $aloe_response->content_set( 'Error' );
    return;
}

// Delete
$recs = new \xan\recs( $mmContactsCommsT );
$recs->recordDelete( $doParam[ 'IDContactsComms' ] );

// Error Check
if ( $recs->errorB ) {
    $ValidationMsgA[] = 'Comm Delete Error' . $recs->messageExtra . '; ' . $recs->messageSQL;
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
    $aloe_response->status_set( '500 Internal Service Error: ' . implode( ", ", $ValidationMsgA ) );
    $aloe_response->content_set( 'Error' );
    return;
}

// Reload
$resp->jsSetPageURL( $mmContactsT->URLFull . $doParam[ 'IDContacts' ] );

// Actions Return as JSON
$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
return;
?>
