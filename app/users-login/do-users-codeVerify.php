<?php
// Response Init
$resp = new \xan\response;

// Spinner Hide; Button Enable
$resp->jsHideOrShow( '#formButtonCodeSpinner', 'Hide' );
$resp->jsSetHTMLProperty( '#formButtonCode', 'disabled', false );

// Validate Init
$ValidationMsgA = array();

// Validate Login
if ( \xan\isEmpty( $doParam[ 'Login' ] ) ) {
	$ValidationMsgA[] = "Login is Blank";
}

// Validate Code
if ( \xan\isEmpty( $doParam[ 'Code' ] ) ) {
	$ValidationMsgA[] = "Code is Blank";
}

// Validate User
if ( empty( $ValidationMsgA ) ) {
	// User Select
	$userSelect = new \xan\recs( $mmUsersT );
	$userSelect->querySQL = 'SELECT * FROM Users WHERE EmailAddress = ?';
	$userSelect->queryBindNamesA = array( 'EmailAddress' );
	$userSelect->queryBindValuesA = array( $doParam[ 'Login' ] );
	$userSelect->query();
	// Error Check
	if ( $userSelect->errorB ) {
		$ValidationMsgA[] = ' Login and/or Password Error: ' . $userSelect->messageExtra . '; ' . $userSelect->messageSQL;
	} elseif ( $userSelect->rowCount < 1 ) {
		$ValidationMsgA[] = ' Login and/or Password: None Found';
	} elseif ( $userSelect->rowCount > 0 ) {
		
		// Validate User Active
		if ( $userSelect->rowsD[ 0 ][ 'Active' ] !== 'Yes' ) {
			$ValidationMsgA[] = 'Login is Not Active';
		}
		
		// Validate User Registered
		if ( $userSelect->rowsD[ 0 ][ 'Registered' ] !== 'Yes' ) {
			$ValidationMsgA[] = 'Login is Not Registered';
		}
		
		// Validate Code String
		if ( \xan\isNotEmpty( $doParam[ 'Code' ] ) ) {
			if ( $doParam[ 'Code' ] !== $userSelect->rowsD[ 0 ][ 'TwoFactorString' ] ) {
				$ValidationMsgA[] = 'Code is Not Valid';
			}
		}
		
		// Validate Code Timestamp
		if ( \xan\isNotEmpty( $doParam[ 'Code' ] ) ) {
			$tsNow = \xan\dateTimeFromString( 'now', DATETIME_FORMAT_SQLDATETIME );
			if ( $tsNow > $userSelect->rowsD[ 0 ][ 'TwoFactorExpiresTS' ] ) {
				$ValidationMsgA[] = 'Code is No Longer Valid';
			}
		}
		
	}
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	// Actions Return as JSON
	$resp->jsSetHTML( '#formMessageCode', implode( ', ', $ValidationMsgA ) );
	$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
	return;
}

// DB Clear Code
$mmUsersT->set2FACode( $userSelect->rowsD[ 0 ][ UUIDUSERS ], '' );

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

// Redirect
$redirectPath = $mmUsersT->doLogin( 'Form', $userSelect );
$resp->jsSetPageURL( $redirectPath);

// Actions Return as JSON
$resp->jsSetHTML( '#formMessageCode', implode( ', ', $ValidationMsgA ) );
$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
return;
?>