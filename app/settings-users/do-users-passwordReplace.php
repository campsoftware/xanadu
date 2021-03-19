<?php
// Response Init
$resp = new \xan\response;

// Spinner Hide; Button Enable
// $resp->jsHideOrShow( '#formButtonSpinner', 'Hide' );
// $resp->jsSetHTMLProperty( '#formButton', 'disabled', false );

// Validate Init
$ValidationMsgA = array();

// Validate Users ID
if ( \xan\isEmpty( $doParam[ 'IDUsers' ] ) ) {
	$ValidationMsgA[] = "User ID is Blank";
}

// Validate PasswordNew
if ( \xan\isEmpty( $doParam[ 'PasswordNew' ] ) ) {
	$ValidationMsgA[] = "New Password Cannot be Blank";
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	$aloe_response->status_set( '400 Bad Request: ' . implode( ", ", $ValidationMsgA ) );
	$aloe_response->content_set( 'Error' );
	return;
}

// Password Calculate
$PasswordHashSeed = xan\strUUID();
$PasswordHashed = hash( 'sha256', $PasswordHashSeed . $doParam[ 'PasswordNew' ] );


// Update
$recsDetail = new xan\recs( $mmUsersT );
$recsDetail->recordUpdate( $doParam[ 'IDUsers' ], array( 'PasswordHashSeed' => $PasswordHashSeed, 'PasswordHashed' => $PasswordHashed ));
// Error Check
if ( $recsDetail->errorB ) {
	$ValidationMsgA[] = 'Password Replace Error: ' . $recsDetail->messageExtra . ';' .  $recsDetail->messageSQL;
} elseif ( $recsDetail->rowCount < 1 ) {
	$ValidationMsgA[] = 'Password Replace None Found';
} elseif ( $recsDetail->rowCount > 0 ) {
	
	// Recs Loop
	$recsDetail->rowIndex = -1;
	//    foreach ( $recs->rowsD as $recsListRow ) {
	$recsDetail->rowIndex++;
	
	// Process
	$resp->jsSetHTML( '#xf_' . $doParam[ 'IDUsers' ] . '_PasswordHashSeed', $PasswordHashSeed );
	$resp->jsSetHTML( '#xf_' . $doParam[ 'IDUsers' ] . '_PasswordHashed', $PasswordHashed );
	
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
