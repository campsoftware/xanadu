<?php
// Validate Init
$ValidationMsgA = array();

// Validate ID
if ( \xan\isEmpty( $doParam[ $mmContactsT->NameTableParam ] ) ) {
    $ValidationMsgA[] = $mmContactsT->NameSingular . ' ID is Blank';
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
    $aloe_response->status_set( '400 Bad Request: ' . implode( ', ', $ValidationMsgA ) );
    $aloe_response->content_set( 'Error' );
    return;
}

// Init
$UUIDNew = "";

// Duplicate Record
$recs = new \xan\recs( $mmContactsT );
$recs->recordDuplicate( $doParam[ $mmContactsT->NameTableParam ] );

// Error Check
if ( $recs->errorB || $recs->rowCount < 1 ) {
	$ValidationMsgA[] = $mmContactsT->NameSingular . ' Duplicate Error' . $recs->messageExtra . '; ' . $recs->messageSQL;
} else {
	// Recs Loop
	$recs->rowIndex = -1;
	foreach ( $recs->rowsD as $recsRow ) {
		$recs->rowIndex++;
		
		// Get ID
		$UUIDNew = $recsRow[ $mmContactsT->NameTableKey ];
		
	}
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	$aloe_response->status_set( '500 Internal Service Error: ' . implode( ", ", $ValidationMsgA ) );
	$aloe_response->content_set( 'Error' );
	return;
}

// Duplicate Related ContactComms
$recs = new \xan\recs( $mmContactsCommsT );
$recs->recordDuplicateRelated( $mmContactsT->NameTableKey, $doParam[ $mmContactsT->NameTableParam ], $UUIDNew );

// Error Check
if ( $recs->errorB ) {
	$ValidationMsgA[] = $mmContactsCommsT->NameSingular . ' Duplicate Error' . $recs->messageExtra . '; ' . $recs->messageSQL;
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	$aloe_response->status_set( '500 Internal Service Error: ' . implode( ", ", $ValidationMsgA ) );
	$aloe_response->content_set( 'Error' );
	return;
}

// Go to the Record
$resp->jsSetPageURL( $mmContactsT->URLFull . $UUIDNew );

// Set Focus
$resp->jsSetFocus( '#xf_' . $UUIDNew . '_NameCompany' );

// Actions Return as JSON
$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
return;
?>
?>