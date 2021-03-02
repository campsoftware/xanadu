<?php
// Validate Init
$ValidationMessage = array();

// Validate Contacts ID
if ( xan\isEmpty( $doParam[ 'IDContacts' ] ) ) {
    $ValidationMessage[] = $mmContactsT->NameSingular . " ID is Blank";
}

// Validate ContactsComms ID
if ( xan\isEmpty( $doParam[ 'IDContactsComms' ] ) ) {
    $ValidationMessage[] = $mmContactsCommsT->NameSingular . " ID is Blank";
}

// Invalid Response
if ( !empty( $ValidationMessage ) ) {
    $aloe_response->status_set( '400 Bad Request: ' . implode( ', ', $ValidationMessage ) );
    $aloe_response->content_set( 'Error' );
    return;
}

// Delete
$recs = new \xan\recs( $mmContactsCommsT );
$recs->recordDelete( $doParam[ 'IDContactsComms' ] );

// Error Check
if ( $recs->errorB ) {
    $aloe_response->status_set( '500 Internal Service Error: ' . $recs->messageExtra . '; ' . $recs->messageSQL );
    return;
}

// Result
$result[ 'Do_URLLoad' ] = $mmContactsT->URLFull . $doParam[ 'IDContacts' ];

// Return Records as JSON
$resultJSON = json_encode( $result );
$aloe_response->content_set( $resultJSON );
return;
?>
