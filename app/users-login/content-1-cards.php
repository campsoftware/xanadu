<?php
// Get Path Parts
$registrationLogin = $path_components[ 1 ];
$registrationCode = $path_components[ 2 ];

// Get Posts
$PostLogin = xan\valuePOST( 'Login', '' );
$PostPassword = xan\valuePOST( 'Password', '' );
$PostRememberMe = xan\valuePOST( 'RememberMe', '' );
$PostFormName = xan\valuePOST( 'FormName', '' );

// Get Cookies
$CookieRememberMe = $_COOKIE[ 'RememberMe' ] ?? '';
$CookieLogin = $_COOKIE[ 'Login' ] ?? $PostLogin;

// Init
$LoginMethod = '';
$xanMessage = '';


// Set Login Cookie
if ( $PostLogin != '' ) {
	setcookie( 'Login', $CookieLogin, time() + ( 86400 * APP_COOKIE_LOGIN_DAYS ), '/' );
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Registration Login
if ( xan\isNotEmpty( $registrationLogin ) and xan\isNotEmpty( $registrationCode ) ) {
	$PostLogin = $registrationLogin;
	
	// User Select
	$userSelect = new xan\recs( $mmUsersT );
	$userSelect->querySQL = 'SELECT * FROM Users WHERE EmailAddress = ? AND PasswordResetCode = ?';
	$userSelect->queryBindNamesA = array( 'EmailAddress', 'PasswordResetCode' );
	$userSelect->queryBindValuesA = array( $registrationLogin, $registrationCode );
	$userSelect->query();
	// Error Check
	if ( $userSelect->errorB ) {
		$xanMessage .= ' Registration Select Error: ' . $userSelect->messageExtra . '; ' . $userSelect->messageSQL . STR_BR;
	} elseif ( $userSelect->rowCount < 1 ) {
		$xanMessage .= ' Registration Select: None Found' . STR_BR;
	} elseif ( $userSelect->rowCount > 0 ) {
		
		// User Update
		$userUpdate = new xan\recs( $mmUsersT );
		$userUpdate->querySQL = 'UPDATE Users SET Registered = ?, PasswordResetCode = ? WHERE EmailAddress = ?';
		$userUpdate->queryBindNamesA = array( 'Registered', 'PasswordResetCode', 'EmailAddress' );
		$userUpdate->queryBindValuesA = array( 'Yes', '', $PostLogin );
		$userUpdate->query();
		// Error Check
		if ( $userUpdate->errorB ) {
			$xanMessage .= ' Registration Update Error: ' . $userUpdate->messageExtra . '; ' . $userUpdate->messageSQL . STR_BR;
		} elseif ( $userUpdate->rowCount < 1 ) {
			$xanMessage .= ' Registration Update: None Found' . STR_BR;
		} elseif ( $userUpdate->rowCount > 0 ) {
			
			$LoginMethod = 'Registration';
			
		}
		
	}
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Login via Remember Me
if ( $CookieRememberMe != '' ) {
	
	// User Select
	$userSelect = new xan\recs( $mmUsersT );
	$userSelect->querySQL = 'SELECT * FROM Users WHERE LoginKey = ?';
	$userSelect->queryBindNamesA = array( 'LoginKey' );
	$userSelect->queryBindValuesA = array( $CookieRememberMe );
	$userSelect->query();
	// Error Check
	if ( $userSelect->errorB ) {
		$xanMessage .= ' Remember Me Select Error: ' . $userSelect->messageExtra . '; ' . $userSelect->messageSQL . STR_BR;
	} elseif ( $userSelect->rowCount < 1 ) {
		$xanMessage .= ' Remember Me Select: None Found' . STR_BR;
	} elseif ( $userSelect->rowCount > 0 ) {
		
		$LoginMethod = 'RememberMe';
		
	}
	
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Login Form Validate
$Validated = false;
if ( !empty( $PostFormName ) ) {
	$Validated = true;
	if ( $PostLogin == '' ) {
		$xanMessage .= 'Login is required.' . STR_BR;
		$Validated = false;
	}
	if ( $PostPassword == '' ) {
		$xanMessage .= 'Password is required.' . STR_BR;
		$Validated = false;
	}
}

// Login via Form
if ( $Validated and $LoginMethod == '' ) {
	
	// User Select Password Hash Seed
	$userSelect = new xan\recs( $mmUsersT );
	$userSelect->querySQL = 'SELECT * FROM Users WHERE EmailAddress = ?';
	$userSelect->queryBindNamesA = array( 'EmailAddress' );
	$userSelect->queryBindValuesA = array( $PostLogin );
	$userSelect->query();
	// Error Check
	if ( $userSelect->errorB ) {
		$xanMessage .= ' Login and/or Password Error: ' . $userSelect->messageExtra . '; ' . $userSelect->messageSQL . STR_BR;
	} elseif ( $userSelect->rowCount < 1 ) {
		$xanMessage .= ' Login and/or Password: None Found.' . STR_BR;
	} elseif ( $userSelect->rowCount > 0 ) {
		
		$Validated = true;
		
		$PasswordHash = hash( 'sha256', $userSelect->rowsD[ 0 ][ 'PasswordHashSeed' ] . $PostPassword );
		if ( $Validated and $PasswordHash !== $userSelect->rowsD[ 0 ][ 'PasswordHashed' ] ) {
			$xanMessage .= 'Login and/or Password: None Found.' . STR_BR;
			$Validated = false;
		}
		if ( $Validated and $userSelect->rowsD[ 0 ][ 'Registered' ] !== 'Yes' ) {
			$xanMessage .= 'Login is not Registered.' . STR_BR;
			$Validated = false;
		}
		
		if ( $Validated ) {
			$LoginMethod = 'Form';
			
			//  Cookie RememberMe Set
			if ( $PostRememberMe == '1' ) {
				
				$RememberMeID = xan\strUUID();
				$UUIDUsers = $userSelect->rowsD[ 0 ][ UUIDUSERS ];
				setcookie( 'RememberMe', $RememberMeID, time() + ( 86400 * APP_COOKIE_LOGIN_DAYS ), '/' );
				
				// User Update
				$userUpdate = new xan\recs( $mmUsersT );
				$userUpdate->querySQL = 'UPDATE Users SET LoginKey = ? WHERE UUIDUsers = ?';
				$userUpdate->queryBindNamesA = array( 'LoginKey', UUIDUSERS );
				$userUpdate->queryBindValuesA = array( $RememberMeID, $UUIDUsers );
				$userUpdate->query();
				// Error Check
				if ( $userUpdate->errorB ) {
					$xanMessage .= ' Remember Me Update Error: ' . $userUpdate->messageExtra . '; ' . $userUpdate->messageSQL . STR_BR;
				} elseif ( $userUpdate->rowCount < 1 ) {
					$xanMessage .= ' Remember Me Update: None Found' . STR_BR;
				}
				
			}
		}
		
	}
	
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Handle Login
if ( $LoginMethod != '' ) {
	
	// Set Session
	$_SESSION[ 'recsUsersCURRENT' ] = $userSelect->rowsD[ 0 ];
	
	// Log
	$logEvent = xan\logEventToSQL( 'Login', $LoginMethod, '', xan\paramEncode( $_SERVER[ 'PHP_SELF' ] ), $_SESSION[ 'recsUsersCURRENT' ][ 'EmailAddress' ] ?? '', $_SESSION[ 'recsUsersCURRENT' ][ UUIDUSERS ] ?? '' );
	// Error Check
	if ( $logEvent->errorB ) {
		$aloe_response->status_set( '500 Internal Service Error: ' . 'LogAudit Error; ' . $logEvent->messageExtra . '; ' . $logEvent->messageSQL );
		$aloe_response->content_set( 'Error' );
		return;
	} elseif ( $logEvent->rowCount < 1 ) {
		$aloe_response->status_set( '500 Internal Service Error: ' . 'LogAudit Not Found; ' . $logEvent->messageExtra . '; ' . $logEvent->messageSQL );
		$aloe_response->content_set( 'Error' );
		return;
	}
	
	// Redirect User
	$PathLast = $userSelect->rowsD[ 0 ][ 'PathLast' ];
	if ( xan\isNotEmpty( $PathLast ) ) {
		$aloe_response->status_set( '307 Temporary Redirect' );
		$aloe_response->header_set( 'Location', $PathLast );
		$aloe_response->content_set( '' );
		return;
	} else {
		$aloe_response->status_set( '307 Temporary Redirect' );
		$aloe_response->header_set( 'Location', '/home' );
		$aloe_response->content_set( '' );
		return;
	}
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Form Display

// Tags Cell
$tagsCellEmpty = new xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_MIDDLE ], [], [] );
$tagsCellLeftMiddle = new xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_MIDDLE ], [], [] );
$tagsCellLeftTop = new xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_TOP ], [], [] );
$tagsCellRightMiddle = new xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_RIGHT, TABLE_ALIGN_MIDDLE ], [], [] );
$tagsCellRightTop = new xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_RIGHT, TABLE_ALIGN_TOP ], [], [] );
$tagsCellCenterMiddle = new xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_CENTER, TABLE_ALIGN_MIDDLE ], [], [] );

// Tags Ele
$tagsEleLabel = new xan\tags( [ 'small' ], [], [] );
$tagsEleInput = new xan\tags( [ 'col' ], [], [] );
$tagsEleSelector = new xan\tags( [], [], [] );

// Detail Cards Append
require_once( 'content-card-user-login.php' );

// Scripts Extra
// $resp->scriptsOnLoadA[] = '';
// $resp->scriptsExtraA[] = xan\jsConsoleMsgAppend( 'Test: ' . 'Hey now!' );
// }

?>