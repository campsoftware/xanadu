<?php
// Validate Init
$ValidationMsgA = array();

// Validate ID
if ( \xan\isEmpty( $doParam[ $mmUsersT->NameTableParam ] ) ) {
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
$recsDetail->queryBindValuesA = array( $doParam[ $mmUsersT->NameTableParam ] );
$recsDetail->query();

// Error Check
if ( $recsDetail->errorB ) {
	$ValidationMsgA[] = $mmUsersT->NameSingular . ' Select Error' . $recsDetail->messageExtra . '; ' . $recsDetail->messageSQL;
} elseif ( $recsDetail->rowCount < 1 ) {
	$ValidationMsgA[] = $mmUsersT->NameSingular . ' Select None Found';
} elseif ( $recsDetail->rowCount > 0 ) {
	
	// Recs Loop
	$recsDetail->rowIndex = -1;
	//    foreach ( $recs->rowsD as $recsListRow ) {
	$recsDetail->rowIndex++;
	
	// Process
	$resp->jsSetHTML( '#UsersList' . $doParam[ $mmUsersT->NameTableParam ] . 'Label', $mmUsersT->getDisplayList( $recsDetail ) );
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