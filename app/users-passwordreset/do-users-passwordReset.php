<?php
// Spinner Hide; Button Enable
$resp->jsHideOrShow( '#formButtonSpinner', 'Hide' );
$resp->jsSetHTMLProperty( '#formButton', 'disabled', false );

// Validate Init
$ValidationMsgA = array();
$messageIfMatchEmailSent = 'If a matching Login was found, an email was sent with a temporary password.';

// Validate Login
if ( \xan\isEmpty( $doParam[ 'Login' ] ) ) {
	$ValidationMsgA[] = "Email is Blank";
}
if ( \xan\emailAddressIsValid( $doParam[ 'Login' ] ) ) {
	$ValidationMsgA[] = "Email Address is Not valid";
}

// Validate Check. Does User Exist?
if ( empty( $ValidationMsgA ) ) {
	
	// User Select
	$userSelect = new \xan\recs( $mmUsersT );
	$userSelect->querySQL = 'SELECT * FROM Users WHERE EmailAddress = ?';
	$userSelect->queryBindNamesA = array( 'EmailAddress' );
	$userSelect->queryBindValuesA = array( $doParam[ 'Login' ] );
	$userSelect->query();
	// Error Check
	if ( $userSelect->errorB ) {
		$ValidationMsgA[] = 'Select Error: ' . $userSelect->messageExtra . '; ' . $userSelect->messageSQL;
	} elseif ( $userSelect->rowCount < 1 ) {
		$ValidationMsgA[] = $messageIfMatchEmailSent;
	} elseif ( $userSelect->rowCount > 0 ) {
		// OK to Continue, User Found
		if ( \xan\isEmpty( $userSelect->rowsD[ 0 ][ 'EmailAddress' ] ) ) {
			$ValidationMsgA[] = $messageIfMatchEmailSent;
		}
	}
	
}

// Validate Check
if ( !empty( $ValidationMsgA ) ) {
	// Actions Return as JSON
	$resp->jsSetHTML( '#formMessage', implode( ', ', $ValidationMsgA ) );
	$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
	return;
}

// New Passowrd
$PasswordReplace = \xan\strRight( strtoupper( \xan\strUUID() ), APP_PASSWORD_LENGTH_GENERATED );
$PasswordHashSeed = \xan\strUUID();
$PasswordHashed = hash( 'sha256', $PasswordHashSeed . $PasswordReplace );

// User Update
$userUpdate = new \xan\recs( $mmUsersT );
$userUpdate->recordUpdate( $userSelect->rowsD[ 0 ][ UUIDUSERS ], array( 'PasswordHashSeed' => $PasswordHashSeed, 'PasswordHashed' => $PasswordHashed ) );
// Error Check
if ( $userUpdate->errorB ) {
	$ValidationMsgA[] = mmUsersT->NameSingular . ' Update Error: ' . $userUpdate->messageExtra . ';' . $userUpdate->messageSQL;
} elseif ( $userUpdate->rowCount < 1 ) {
	$ValidationMsgA[] = mmUsersT->NameSingular . ' Update Not Found';
} elseif ( $userUpdate->rowCount > 0 ) {
	// OK to Continue, User Updated
}

// Validate Check
if ( !empty( $ValidationMsgA ) ) {
	// Actions Return as JSON
	$resp->jsSetHTML( '#formMessage', implode( ', ', $ValidationMsgA ) );
	$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
	return;
}

// Send Email
$emailMessage = 'Your temporary ' . APP_NAME . ' password is "' . $PasswordReplace . '". Please change your password when you login.';
$sender = new \xan\sender();
if ( \xan\isNotEmpty( $userSelect->rowsD[ 0 ][ 'EmailAddress' ] ) ) {
	$sender->sendEmail( true, APP_EMAIL_FROM, $userSelect->rowsD[ 0 ][ 'EmailAddress' ], APP_NAME . " - Password Reset", $emailMessage, $emailMessage );
}

// Message Append
$ValidationMsgA[] = $messageIfMatchEmailSent;

// Actions Return as JSON
$resp->jsSetHTML( '#formMessage', implode( ', ', $ValidationMsgA ) );
$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
return;
?>