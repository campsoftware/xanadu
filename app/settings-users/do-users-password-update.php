<?php
// Validate Init
$ValidationMessage = array();

// Validate Users ID
if ( xan\isEmpty( $doParam[ 'IDUsers' ] ) ) {
	$ValidationMessage[] = "User ID is Blank";
}

// Validate PasswordNew
if ( xan\isEmpty( $doParam[ 'PasswordNew' ] ) ) {
	$ValidationMessage[] = "New Password cannot be Blank";
}

// Invalid Response
if ( !empty( $ValidationMessage ) ) {
	$aloe_response->status_set( '400 Bad Request: ' . implode( ", ", $ValidationMessage ) );
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
	$result[ 'Do_ErrorMessage' ] = $recsDetail->messageExtra . ';' .  $recsDetail->messageSQL;
} elseif ( $recsDetail->rowCount < 1 ) {
	$result[ 'Do_ErrorMessage' ] = 'None Found';
} elseif ( $recsDetail->rowCount > 0 ) {
	
	// Recs Loop
	$recsDetail->rowIndex = -1;
	//    foreach ( $recs->rowsD as $recsListRow ) {
	$recsDetail->rowIndex++;
	
	// Process
	$result[ 'Do_ValSelectorName' ][ 0 ] = '#xf_' . $doParam[ 'IDUsers' ] . '_PasswordHashSeed';
	$result[ 'Do_ValSelectorData' ][ 0 ] = $PasswordHashSeed;
	$result[ 'Do_ValSelectorName' ][ 1 ] = '#xf_' . $doParam[ 'IDUsers' ] . '_PasswordHashed';
	$result[ 'Do_ValSelectorData' ][ 1 ] = $PasswordHashed;
	
	//    }
	
}

// Return JSON
$resultJSON = json_encode( $result );
$aloe_response->content_set( $resultJSON );
return;
?>
