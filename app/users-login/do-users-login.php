<?php
// Spinner Hide; Button Enable
$resp->jsHideOrShow( '#formButtonLoginSpinner', 'Hide' );
$resp->jsSetHTMLProperty( '#formButtonLogin', 'disabled', false );

// Set Login Cookie
if ( \xan\isNotEmpty( $doParam[ 'Login' ] ) ) {
	setcookie( COOKIE_LOGIN, $doParam[ 'Login' ], ['expires' => time() + ( 86400 * APP_COOKIE_LOGIN_DAYS ), 'path' => '/', 'httponly' => true, 'secure' => true ] );
}

// Validate Init
$ValidationMsgA = array();

// Validate Login
if ( \xan\isEmpty( $doParam[ 'Login' ] ) ) {
	$ValidationMsgA[] = "Email Address is Blank";
}
if ( \xan\emailAddressIsValid( $doParam[ 'Login' ] ) ) {
	$ValidationMsgA[] = "Email Address is Not Valid";
}

// Validate Password
if ( \xan\isEmpty( $doParam[ 'Password' ] ) ) {
	$ValidationMsgA[] = "Password is Blank";
}

// Validate Check. Check Login and Password
if ( empty( $ValidationMsgA ) ) {
	
	// User Select
	$userSelect = new \xan\recs( $mmUsersT );
	$userSelect->querySQL = 'SELECT * FROM Users WHERE EmailAddress = ?';
	$userSelect->queryBindNamesA = array( 'EmailAddress' );
	$userSelect->queryBindValuesA = array( $doParam[ 'Login' ] );
	$userSelect->query();
	// Error Check
	if ( $userSelect->errorB ) {
		$ValidationMsgA[] = 'Login and/or Password Error: ' . $userSelect->messageExtra . '; ' . $userSelect->messageSQL;
	} elseif ( $userSelect->rowCount < 1 ) {
		$ValidationMsgA[] = 'Login and/or Password None Found';
	} elseif ( $userSelect->rowCount > 0 ) {
		
		// Validate User Active
		if ( $userSelect->rowsD[ 0 ][ 'Active' ] !== 'Yes' ) {
			$ValidationMsgA[] = 'Login is Not Active';
		}
		
		// Validate User Registered
		if ( $userSelect->rowsD[ 0 ][ 'Registered' ] !== 'Yes' ) {
			$ValidationMsgA[] = 'Login is Not Registered';
		}
		
		// Validate Password
		if ( \xan\isNotEmpty( $doParam[ 'Password' ] ) ) {
			$PasswordHash = hash( 'sha256', $userSelect->rowsD[ 0 ][ 'PasswordHashSeed' ] . $doParam[ 'Password' ] );
			if ( $PasswordHash !== $userSelect->rowsD[ 0 ][ 'PasswordHashed' ] ) {
				$ValidationMsgA[] = 'Login and/or Password None Found';
			}
		}
	}
	
}

// Validate Check
if ( !empty( $ValidationMsgA ) ) {
	// Actions Return as JSON
	$resp->jsSetHTML( '#formMessageLogin', implode( ', ', $ValidationMsgA ) );
	$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
	return;
}


//  Cookie RememberMe Set
$RememberMeIsUpdated = false;
if ( $doParam[ 'RememberMe' ] === '1' ) {
	$RememberMeID = \xan\strUUID();
	$UUIDUsers = $userSelect->rowsD[ 0 ][ UUIDUSERS ];
	setcookie( COOKIE_REMEMBERME, $RememberMeID, ['expires' => time() + ( 86400 * APP_COOKIE_LOGIN_DAYS ), 'path' => '/', 'httponly' => true, 'secure' => true ] );
	
	// User Update
	$userUpdate = new \xan\recs( $mmUsersT );
	$userUpdate->querySQL = 'UPDATE Users SET LoginKey = ? WHERE UUIDUsers = ?';
	$userUpdate->queryBindNamesA = array( 'LoginKey', UUIDUSERS );
	$userUpdate->queryBindValuesA = array( $RememberMeID, $UUIDUsers );
	$userUpdate->query();
	// Error Check
	if ( $userUpdate->errorB ) {
		// $xanMessage .= ' Remember Me Update Error: ' . $userUpdate->messageExtra . '; ' . $userUpdate->messageSQL . STR_BR;
	} elseif ( $userUpdate->rowCount < 1 ) {
		// $xanMessage .= ' Remember Me Update: None Found' . STR_BR;
	} elseif ( $userSelect->rowCount > 0 ) {
		$RememberMeIsUpdated = true;
	}
}

if ( TWOFACTORAUTH_ENABLED ) {
	
	// Hide Login Table, Show Code Table, Set Focus
	$resp->jsHideOrShow( '#formTableLogin', 'Hide' );
	$resp->jsHideOrShow( '#formTableCode', 'Show' );
	$resp->jsSetFocus( '#Code');
	
	// 2FA Generate
	$mmUsersT->set2FACode( $userSelect->rowsD[ 0 ][ UUIDUSERS ] );
	
	// 2FA Send
	$senderCode = $mmUsersT->TwoFactorCode;
	$senderSubject = APP_NAME . ' Verification Code';
	$senderMessage = $senderCode . ' is your ' . APP_NAME . ' Code or click: ' . URL_BASE . 'login/tfa/' . $userSelect->rowsD[ 0 ][ UUIDUSERS ] . '/' . $senderCode;
	$sender = new \xan\sender();
	
	// Send SMS
	if ( \xan\isNotEmpty( $userSelect->rowsD[ 0 ][ 'PhoneTwoFactor' ] ) and $userSelect->rowsD[ 0 ][ 'TwoFactorViaPhone2FA' ] === 'Yes' ) {
		$sender->sendSMS( $userSelect->rowsD[ 0 ][ 'PhoneTwoFactor' ], $senderMessage );
	}
	// Send Email
	if ( \xan\isNotEmpty( $userSelect->rowsD[ 0 ][ 'EmailAddress' ] ) and $userSelect->rowsD[ 0 ][ 'TwoFactorViaEmail' ] === 'Yes' ) {
		$sender->sendEmail( true, APP_EMAIL_FROM, $userSelect->rowsD[ 0 ][ 'EmailAddress' ], $senderSubject, '', $senderMessage );
	}
	
	// Actions Return as JSON
	$resp->jsSetHTML( '#formMessageLogin', implode( ', ', $ValidationMsgA ) );
	$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
	return;
	
} else {
	
	// Redirect
	$redirectPath = $mmUsersT->doLogin( 'Form', $userSelect );
	$resp->jsSetPageURL( $redirectPath);
	
	// Actions Return as JSON
	$resp->jsSetHTML( '#formMessageLogin', implode( ', ', $ValidationMsgA ) );
	$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
	return;
}
?>