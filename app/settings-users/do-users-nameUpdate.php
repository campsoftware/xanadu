<?php
// Validate Init
$ValidationMsgA = array();

// Validate Contacts ID
if ( \xan\isEmpty( $doParam[ 'IDUsers' ] ) ) {
	$ValidationMsgA[] = "User ID is Blank";
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	$aloe_response->status_set( '400 Bad Request: ' . implode( ", ", $ValidationMsgA ) );
	$aloe_response->content_set( 'Error' );
	return;
}

// Query
$recsDetail = new \xan\recs( $mmUsersT );
$recsDetail->querySQL = 'SELECT * FROM ' . $mmUsersT->NameTable . ' WHERE ' . $mmUsersT->NameTableKey . ' = ?';
$recsDetail->queryBindNamesA = array( $mmUsersT->NameTableKey );
$recsDetail->queryBindValuesA = array( $doParam[ 'IDUsers' ] );
$recsDetail->query();

// Error Check
if ( $recsDetail->errorB ) {
	$ValidationMsgA[] = 'User Select Error' . $recsDetail->messageExtra . '; ' . $recsDetail->messageSQL;
} elseif ( $recsDetail->rowCount < 1 ) {
	$ValidationMsgA[] = 'User Select None Found';
} elseif ( $recsDetail->rowCount > 0 ) {
	
	// Recs Loop
	$recsDetail->rowIndex = -1;
	//    foreach ( $recs->rowsD as $recsListRow ) {
	$recsDetail->rowIndex++;
	
	// Process
	$resp->jsSetHTML( '#UsersList' . $doParam[ 'IDUsers' ] . 'Label', $mmUsersT->getDisplayList( $recsDetail ) );
	$resp->jsSetHTML( '#pageContentHeaderDetails', ': ' . $mmUsersT->getDisplayName( $recsDetail ) );
	
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