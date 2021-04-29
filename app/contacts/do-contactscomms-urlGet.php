<?php
// Validate Init
$ValidationMsgA = array();

// Validate ID
if ( \xan\isEmpty( $doParam[ $mmContactsCommsT->NameTableParam ] ) ) {
    $ValidationMsgA[] = $mmContactsT->NameSingular . ' ID is Blank';
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
    $aloe_response->status_set( '400 Bad Request: ' . implode( ", ", $ValidationMsgA ) );
    $aloe_response->content_set( 'Error' );
    return;
}

// Query
$recs = new \xan\recs( $mmContactsCommsT );
$recs->querySQL = 'SELECT * FROM ' . $mmContactsCommsT->NameTable . ' WHERE ' . $mmContactsCommsT->NameTableKey . ' = ?';
$recs->queryBindNamesA = array( $mmContactsCommsT->NameTableKey );
$recs->queryBindValuesA = array( $doParam[ $mmContactsCommsT->NameTableParam ] );
$recs->query();

// Error Check
if ( $recs->errorB ) {
    $ValidationMsgA[] = $mmContactsCommsT->NameSingular . ' URL Error' . $recs->messageExtra . '; ' . $recs->messageSQL;
} elseif ( $recs->rowCount < 1 ) {
    $ValidationMsgA[] = $mmContactsCommsT->NameSingular . ' URL None Found';
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
