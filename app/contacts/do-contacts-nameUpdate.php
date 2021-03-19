<?php
// Response Init
$resp = new \xan\response;

// Validate Init
$ValidationMsgA = array();

// Validate Contacts ID
if ( \xan\isEmpty( $doParam[ 'IDContacts' ] ) ) {
    $ValidationMsgA[] = "Contact ID is Blank";
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
    $aloe_response->status_set( '400 Bad Request: ' . implode( ", ", $ValidationMsgA ) );
    $aloe_response->content_set( 'Error' );
    return;
}

// Query
$recsDetail = new xan\recs( $mmContactsT );
$recsDetail->querySQL = 'SELECT * FROM ' . $mmContactsT->NameTable . ' WHERE ' . UUIDTENANTS . ' = ? AND ' . $mmContactsT->NameTableKey . ' = ?';
$recsDetail->queryBindNamesA = array( UUIDTENANTS, $mmContactsT->NameTableKey );
$recsDetail->queryBindValuesA = array( $_SESSION[ SESS_USER ][ UUIDTENANTS ], $doParam[ 'IDContacts' ] );
$recsDetail->query();

// Error Check
if ( $recsDetail->errorB ) {
	$ValidationMsgA[] = 'Name Update Error' . $recsDetail->messageExtra . '; ' . $recsDetail->messageSQL;
} elseif ( $recsDetail->rowCount < 1 ) {
	$ValidationMsgA[] = 'Name Update None Found';
} elseif ( $recsDetail->rowCount > 0 ) {

    // Recs Loop
    $recsDetail->rowIndex = -1;
    //    foreach ( $recs->rowsD as $recsListRow ) {
    $recsDetail->rowIndex++;
    
    // Actions
	$resp->jsSetHTML( '#ContactsList' . $doParam[ 'IDContacts' ] . 'Label', $mmContactsT->getDisplayList( $recsDetail ) );
	$resp->jsSetHTML( '#pageContentHeaderDetails', $mmContactsT->getDisplayName( $recsDetail ) );

    //    }

}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	$aloe_response->status_set( '500 Internal Service Error: ' . implode( ", ", $ValidationMsgA ) );
	$aloe_response->content_set( 'Error' );
	return;
}

// Actions Return as JSON
$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
return;
?>