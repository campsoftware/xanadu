<?php
// Validate Init
$ValidationMessage = array();

// Validate Contact ID
if ( xan\isEmpty( $doParam[ 'IDContacts' ] ) ) {
    $ValidationMessage[] = "Contact ID is Blank";
}

// Invalid Response
if ( !empty( $ValidationMessage ) ) {
    $aloe_response->status_set( '400 Bad Request: ' . implode( ', ', $ValidationMessage ) );
    $aloe_response->content_set( 'Error' );
    return;
}

// Init
$UUIDNew = "";

// Duplicate Record
$recs = new \xan\recs( $mmContactsT );
$recs->recordDuplicate( $doParam[ 'IDContacts' ] );

// Error Check
if ( $recs->errorB || $recs->rowCount < 1 ) {
	$aloe_response->status_set( '500 Internal Service Error: ' . $recs->messageExtra . '; ' . $recs->messageSQL );
	return;
} else {
	// Recs Loop
	$recs->rowIndex = -1;
	foreach ( $recs->rowsD as $recsRow ) {
		$recs->rowIndex++;
		
		// Get ID
		$UUIDNew = $recsRow[ $mmContactsT->NameTableKey ];
		
	}
}

// Duplicate Related ContactComms
$recs = new \xan\recs( $mmContactsCommsT );
$recs->recordDuplicateRelated( $mmContactsT->NameTableKey, $doParam[ 'IDContacts' ], $UUIDNew );

// Error Check
if ( $recs->errorB || $recs->rowCount < 1 ) {
	$aloe_response->status_set( '500 Internal Service Error: ' . $recs->messageExtra . '; ' . $recs->messageSQL );
	return;
}

// Result
$result[ 'Do_URLLoad' ] = $mmContactsT->URLFull . $UUIDNew;

// Set Focus Selector
$_SESSION[ 'FocusSelector' ] = '#xf_' . $UUIDNew . '_NameCompany';

// Return JSON
$resultJSON = json_encode( $result );
$aloe_response->content_set( $resultJSON );
return;
?>