<?php
// Validate Init
$ValidationMessage = array();

// Validate Contacts ID
if ( xan\isEmpty( $doParam[ 'IDContacts' ] ) ) {
    $ValidationMessage[] = "Contact ID is Blank";
}

// Invalid Response
if ( !empty( $ValidationMessage ) ) {
    $aloe_response->status_set( '400 Bad Request: ' . implode( ", ", $ValidationMessage ) );
    $aloe_response->content_set( 'Error' );
    return;
}

// Query
$recsDetail = new xan\recs( $mmContactsT );
$recsDetail->querySQL = 'SELECT * FROM ' . $mmContactsT->NameTable . ' WHERE ' . UUIDTENANTS . ' = ? AND ' . $mmContactsT->NameTableKey . ' = ?';
$recsDetail->queryBindNamesA = array( UUIDTENANTS, $mmContactsT->NameTableKey );
$recsDetail->queryBindValuesA = array( $_SESSION[ 'recsUsersCURRENT' ][ UUIDTENANTS ], $doParam[ 'IDContacts' ] );
$recsDetail->query();

// Error Check
if ( $recsDetail->errorB ) {
    $result[ 'Do_ErrorMessage' ] = $recsDetail->messageExtra . '; ' . $recsDetail->messageSQL;
} elseif ( $recsDetail->rowCount < 1 ) {
    $result[ 'Do_ErrorMessage' ] = 'None Found';
} elseif ( $recsDetail->rowCount > 0 ) {

    // Recs Loop
    $recsDetail->rowIndex = -1;
    //    foreach ( $recs->rowsD as $recsListRow ) {
    $recsDetail->rowIndex++;
    
    // Process
    $result[ 'Do_HTMLSelectorName' ][ 0 ] = '#ContactsList' . $doParam[ 'IDContacts' ] . 'Label';
    $result[ 'Do_HTMLSelectorData' ][ 0 ] = $mmContactsT->getDisplayList( $recsDetail );
    $result[ 'Do_HTMLSelectorName' ][ 1 ] = '#pageContentHeaderDetails';
    $result[ 'Do_HTMLSelectorData' ][ 1 ] = ': ' . $mmContactsT->getDisplayName( $recsDetail );
    
    //    }

}

// Return JSON
$resultJSON = json_encode( $result );
$aloe_response->content_set( $resultJSON );
return;
?>