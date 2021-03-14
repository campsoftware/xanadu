<?php
// Validate Init
$ValidationMessage = array();

// Validate Contact ID
//if ( xan\isEmpty( $doParam[ 'IDContacts' ] ) ) {
//    $ValidationMessage[] = "Contact ID is Blank";
//}

// Invalid Response
if ( !empty( $ValidationMessage ) ) {
    $aloe_response->status_set( '400 Bad Request: ' . implode( ', ', $ValidationMessage ) );
    $aloe_response->content_set( 'Error' );
    return;
}

// Init
$UUIDNew = "";

// Insert
$recs = new \xan\recs( $mmContactsT );
$recs->recordInsert( array( 'NameCompany' => 'A New Contact' ) );

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

// Result
$result[ 'Do_URLLoad' ] = $mmContactsT->URLFull . $UUIDNew;

// Set Focus Selector on Page Reload
$_SESSION[ SESS_FOCUS_SELECTOR ] = '#xf_' . $UUIDNew . '_NameCompany';

// Return JSON
$resultJSON = json_encode( $result );
$aloe_response->content_set( $resultJSON );
return;
?>