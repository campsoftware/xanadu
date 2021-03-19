<?php
// Response Init
$resp = new \xan\response;

// Validate Init
$ValidationMsgA = array();

// Validate ContactsComms ID
if ( \xan\isEmpty( $doParam[ 'IDContactsComms' ] ) ) {
    $ValidationMsgA[] = "Comm ID is Blank";
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
    $aloe_response->status_set( '400 Bad Request: ' . implode( ', ', $ValidationMsgA ) );
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
    $ValidationMsgA[] = 'Comm Create Error' . $recs->messageExtra . '; ' . $recs->messageSQL;
} else {
    // Recs Loop
    $recs->rowIndex = -1;
    foreach ( $recs->rowsD as $recsRow ) {
        $recs->rowIndex++;
        
        // Get ID
        $UUIDNew = $recsRow[ $mmContactsCommsT->NameTableKey ];
    }
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
    $aloe_response->status_set( '500 Internal Service Error: ' . implode( ", ", $ValidationMsgA ) );
    $aloe_response->content_set( 'Error' );
    return;
}

// Go to the Record
$resp->jsSetPageURL( $mmContactsT->URLFull . $doParam[ 'IDContactsComms' ] );

// Set Focus
$resp->jsSetFocus( '#xf_' . $UUIDNew . '_Data' );

// Actions Return as JSON
$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
return;
?>
