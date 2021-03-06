<?php
// Prep
$xanDoDo = 'UsersPasswordReplace';
$messageID = $xanDoDo . 'Message';
$modalID = $xanDoDo . '_Modal';
$buttonActionID = $xanDoDo . '_Modal_ButtonAction';
$buttonActionSpinnerID = $buttonActionID . 'Spinner';
$buttonActionOnClickFunctionName = $buttonActionID . 'OnClick';

// Spinner Hide; Button Enable
$resp->jsHideOrShow( '#' . $buttonActionSpinnerID, 'Hide' );
$resp->jsSetHTMLProperty( '#' . $buttonActionID, 'disabled', false );

// Validate Init
$ValidationMsgA = array();

// Validate ID
if ( \xan\isEmpty( $doParam[ $mmUsersT->NameTableParam ] ) ) {
	$ValidationMsgA[] = "User ID is Blank";
}

// Validate PasswordNewOne
if ( \xan\isEmpty( $doParam[ 'PasswordNewOne' ] ) ) {
	$ValidationMsgA[] = "New Password Cannot be Blank";
}

// Validate PasswordNewTwo
if ( \xan\isEmpty( $doParam[ 'PasswordNewTwo' ] ) ) {
	$ValidationMsgA[] = "New Password Verify Cannot be Blank";
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	// Actions Return as JSON
	$resp->jsSetHTML( '#' . $messageID, implode( ', ', $ValidationMsgA ) );
	$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
	return;
}

// PasswordNewOne Not Equal to PasswordNewTwo
if ( $doParam[ 'PasswordNewOne' ] !== $doParam[ 'PasswordNewTwo' ] ) {
	$ValidationMsgA[] = "New Passwords Do Not Match";
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	// Actions Return as JSON
	$resp->jsSetHTML( '#' . $messageID, implode( ', ', $ValidationMsgA ) );
	$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
	return;
}

// Password Calculate
$PasswordHashSeed = \xan\strUUID();
$PasswordHashed = hash( 'sha256', $PasswordHashSeed . $doParam[ 'PasswordNewOne' ] );

// Password Update
$recsDetail = new \xan\recs( $mmUsersT );
$recsDetail->recordUpdate( $doParam[ $mmUsersT->NameTableParam ], array( 'PasswordHashSeed' => $PasswordHashSeed, 'PasswordHashed' => $PasswordHashed ));
// Error Check
if ( $recsDetail->errorB ) {
	$ValidationMsgA[] = $mmUsersT->NameSingular . ' Update Error: ' . $recsDetail->messageExtra . ';' .  $recsDetail->messageSQL;
} elseif ( $recsDetail->rowCount < 1 ) {
	$ValidationMsgA[] = $mmUsersT->NameSingular . ' Update None Found';
} elseif ( $recsDetail->rowCount > 0 ) {
	// Success
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	// Actions Return as JSON
	$resp->jsSetHTML( '#' . $messageID, implode( ', ', $ValidationMsgA ) );
	$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
	return;
}

// Hide the Modal
if ( empty( $ValidationMsgA ) ){
	$resp->jsHideOrShowModal( '#' . $modalID, 'Hide' );
	// Update Inputs
	$resp->jsSetHTML( '#xf_' . $doParam[ $mmUsersT->NameTableParam ] . '_PasswordHashSeed', $PasswordHashSeed );
	$resp->jsSetHTML( '#xf_' . $doParam[ $mmUsersT->NameTableParam ] . '_PasswordHashed', $PasswordHashed );
}

// Actions Return as JSON
$resp->jsSetHTML( '#' . $messageID, implode( ', ', $ValidationMsgA ) );
$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
return;
?>
