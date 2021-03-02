<?php
// Validate Init
$ValidationMessage = array();

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

// Init
$UUIDNew = "";

// Insert
$recs = new \xan\recs( $mmContactsCommsT );
$recs->recordInsert( array( $mmContactsT->NameTableKey => $doParam[ 'IDContactsComms' ] ) );

// Error Check
if ( $recs->errorB || $recs->rowCount < 1 ) {
    $aloe_response->status_set( '500 Internal Service Error: ' . $recs->messageExtra . '; ' . $recs->messageSQL );
    return;
} else {
    // Recs Loop
    $recs->rowIndex = -1;
    foreach ( $recs->rowsD as $recsRow ) {
        $recs->rowIndex++;
        
        // Get ID
        $UUIDNew = $recsRow[ $mmContactsCommsT->NameTableKey ];
    }
}

// Result
$result[ 'Do_URLLoad' ] = $mmContactsT->URLFull . $doParam[ 'IDContactsComms' ];

// Set Focus Selector on Page Reload
$_SESSION[ 'FocusSelector' ] = '#xf_' . $UUIDNew . '_Data';

// Return Records as JSON
$resultJSON = json_encode( $result );
$aloe_response->content_set( $resultJSON );
return;
?>
