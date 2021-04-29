<?php
// Validate Init
$ValidationMsgA = array();

// Validate Users ID
//if ( \xan\isEmpty( $doParam[ $mmUsersT->NameTableParam ] ) ) {
//    $ValidationMsgA[] = "Users ID is Blank";
//}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	$aloe_response->status_set( '400 Bad Request: ' . implode( ', ', $ValidationMsgA ) );
	$aloe_response->content_set( 'Error' );
	return;
}

// Init
$UUIDNew = "";

// Insert
$recs = new \xan\recs( $mmUsersT );
$recs->recordInsert( array( 'NameCompany' => 'A New User' ) );

// Error Check
if ( $recs->errorB || $recs->rowCount < 1 ) {
	$ValidationMsgA[] = mmUsersT->NameSingular . ' Create Error' . $recs->messageExtra . '; ' . $recs->messageSQL;
} else {
	// Recs Loop
	$recs->rowIndex = -1;
	foreach ( $recs->rowsD as $recsRow ) {
		$recs->rowIndex++;
		
		// Get ID
		$UUIDNew = $recsRow[ $mmUsersT->NameTableKey ];
		
	}
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	$aloe_response->status_set( '500 Internal Service Error: ' . implode( ", ", $ValidationMsgA ) );
	$aloe_response->content_set( 'Error' );
	return;
}

// Go to the Record
$resp->jsSetPageURL( $mmUsersT->URLFull . $UUIDNew );

// Set Focus
$resp->jsSetFocus( '#xf_' . $UUIDNew . '_NameCompany' );

// Actions Return as JSON
$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
return;
?>