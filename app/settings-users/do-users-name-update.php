<?php
// Validate Init
$ValidationMessage = array();

// Validate Contacts ID
if ( xan\isEmpty( $doParam[ 'IDUsers' ] ) ) {
	$ValidationMessage[] = "User ID is Blank";
}

// Invalid Response
if ( !empty( $ValidationMessage ) ) {
	$aloe_response->status_set( '400 Bad Request: ' . implode( ", ", $ValidationMessage ) );
	$aloe_response->content_set( 'Error' );
	return;
}

// Query
$recsDetail = new xan\recs( $mmUsersT );
$recsDetail->querySQL = 'SELECT * FROM ' . $mmUsersT->NameTable . ' WHERE ' . UUIDTENANTS . ' = ? AND ' . $mmUsersT->NameTableKey . ' = ?';
$recsDetail->queryBindNamesA = array( UUIDTENANTS, $mmUsersT->NameTableKey );
$recsDetail->queryBindValuesA = array( $_SESSION[ 'recsUsersCURRENT' ][ UUIDTENANTS ], $doParam[ 'IDUsers' ] );
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
	$result[ 'Do_HTMLSelectorName' ][ 0 ] = '#UsersList' . $doParam[ 'IDUsers' ] . 'Label';
	$result[ 'Do_HTMLSelectorData' ][ 0 ] = $mmUsersT->getDisplayList( $recsDetail );
	$result[ 'Do_HTMLSelectorName' ][ 1 ] = '#pageContentHeaderDetails';
	$result[ 'Do_HTMLSelectorData' ][ 1 ] = ': ' . $mmUsersT->getDisplayName( $recsDetail );
	
	//    }
	
}

// Return JSON
$resultJSON = json_encode( $result );
$aloe_response->content_set( $resultJSON );
return;
?>