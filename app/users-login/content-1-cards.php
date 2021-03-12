<?php
// Get Path Parts
$registrationLogin = $path_components[ 1 ];
$registrationCode = $path_components[ 2 ];

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
			$redirectPath = $mmUsersT->doLogin( 'Registration', $userSelect );
			$aloe_response->status_set( '307 Temporary Redirect' );
			$aloe_response->header_set( 'Location', $redirectPath );
			$aloe_response->content_set( '' );
			return;
		}
	}
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// RememberMe Login
$CookieRememberMe = $_COOKIE[ COOKIE_REMEMBERME ] ?? '';
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
		$redirectPath = $mmUsersT->doLogin( 'RememberMe', $userSelect );
		$aloe_response->status_set( '307 Temporary Redirect' );
		$aloe_response->header_set( 'Location', $redirectPath );
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