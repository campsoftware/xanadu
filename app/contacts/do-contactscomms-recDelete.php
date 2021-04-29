<?php
// Validate Init
$ValidationMsgA = array();

// Validate Contacts ID
if ( \xan\isEmpty( $doParam[ $mmContactsT->NameTableParam ] ) ) {
    $ValidationMsgA[] = $mmContactsT->NameSingular . " Contact ID is Blank";
}

// Validate ContactsComms ID
if ( \xan\isEmpty( $doParam[ $mmContactsCommsT->NameTableParam ] ) ) {
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
$recs->recordDelete( $doParam[ $mmContactsCommsT->NameTableParam ] );

// Error Check
if ( $recs->errorB ) {
    $ValidationMsgA[] = $mmContactsCommsT->NameSingular . ' Delete Error' . $recs->messageExtra . '; ' . $recs->messageSQL;
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
    $aloe_response->status_set( '500 Internal Service Error: ' . implode( ", ", $ValidationMsgA ) );
    $aloe_response->content_set( 'Error' );
    return;
}

// Reload
$resp->jsSetPageURL( $mmContactsT->URLFull . $doParam[ $mmContactsT->NameTableParam ] );

// Actions Return as JSON
$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
return;
?>
