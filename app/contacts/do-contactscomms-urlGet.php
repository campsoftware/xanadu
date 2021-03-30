<?php
// Validate Init
$ValidationMsgA = array();

// Validate ContactsComms ID
if ( \xan\isEmpty( $doParam[ 'IDContactsComms' ] ) ) {
    $ValidationMsgA[] = "Contact ID is Blank";
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
    $aloe_response->status_set( '400 Bad Request: ' . implode( ", ", $ValidationMsgA ) );
    $aloe_response->content_set( 'Error' );
    return;
}

// Query
$recs = new \xan\recs( $mmContactsCommsT );
$recs->querySQL = 'SELECT * FROM ' . $mmContactsCommsT->NameTable . ' WHERE ' . UUIDTENANTS . ' = ? AND ' . $mmContactsCommsT->NameTableKey . ' = ?';
$recs->queryBindNamesA = array( UUIDTENANTS, $mmContactsCommsT->NameTableKey );
$recs->queryBindValuesA = array( $_SESSION[ SESS_USER ][ UUIDTENANTS ], $doParam[ 'IDContactsComms' ] );
$recs->query();

// Error Check
if ( $recs->errorB ) {
    $ValidationMsgA[] = 'Comms URL Error' . $recs->messageExtra . '; ' . $recs->messageSQL;
} elseif ( $recs->rowCount < 1 ) {
    $ValidationMsgA[] = 'Comms URL None Found';
} elseif ( $recs->rowCount > 0 ) {

    // Recs Loop
    $recs->rowIndex = -1;
    //    foreach ( $recs->rowsD as $recsListRow ) {
    $recs->rowIndex++;
    
    // Go to the URL
    $resp->jsSetPageURL( $mmContactsCommsT->getURL( $recs ) );
    
    //    }

}

// Validate Check
if ( !empty( $ValidationMsgA ) ) {
    // Actions Return as JSON
    $resp->jsSetHTML( '#xanMessage', implode( ', ', $ValidationMsgA ) );
    $aloe_response->content_set( json_encode( $resp->jsActionsA ) );
    return;
}

// Actions Return as JSON
$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
return;
?>
