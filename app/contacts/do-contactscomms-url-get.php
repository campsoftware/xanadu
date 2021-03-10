<?php
// Validate Init
$ValidationMessage = array();

// Validate ContactsComms ID
if ( xan\isEmpty( $doParam[ 'IDContactsComms' ] ) ) {
    $ValidationMessage[] = "Contact ID is Blank";
}

// Invalid Response
if ( !empty( $ValidationMessage ) ) {
    $aloe_response->status_set( '400 Bad Request: ' . implode( ", ", $ValidationMessage ) );
    $aloe_response->content_set( 'Error' );
    return;
}

// Query
$recs = new xan\recs( $mmContactsCommsT );
$recs->querySQL = 'SELECT * FROM ' . $mmContactsCommsT->NameTable . ' WHERE ' . UUIDTENANTS . ' = ? AND ' . $mmContactsCommsT->NameTableKey . ' = ?';
$recs->queryBindNamesA = array( UUIDTENANTS, $mmContactsCommsT->NameTableKey );
$recs->queryBindValuesA = array( $_SESSION[ SESS_USER ][ UUIDTENANTS ], $doParam[ 'IDContactsComms' ] );
$recs->query();

// Error Check
if ( $recs->errorB ) {
    $result[ 'Do_ErrorMessage' ] = $recs->messageExtra . '; ' . $recs->messageSQL;
} elseif ( $recs->rowCount < 1 ) {
    $result[ 'Do_ErrorMessage' ] = 'None Found';
} elseif ( $recs->rowCount > 0 ) {

    // Recs Loop
    $recs->rowIndex = -1;
    //    foreach ( $recs->rowsD as $recsListRow ) {
    $recs->rowIndex++;

    // Return URL
    $result[ 'Do_URLLoad' ] = $mmContactsCommsT->getURL( $recs );
    
    //    }

}

// Return JSON
$resultJSON = json_encode( $result );
$aloe_response->content_set( $resultJSON );
return;
?>
