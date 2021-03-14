<?php
// One Time Code Login
$loginMethod = $path_components[ 1 ];
$loginUUIDUser = $path_components[ 2 ];
$LoginKeyOneTime = $path_components[ 3 ];
if ( $loginMethod === 'otc' and xan\isNotEmpty( $loginUUIDUser ) and xan\isNotEmpty( $LoginKeyOneTime ) ) {
	// User Select
	$userSelect = new xan\recs( $mmUsersT );
	$userSelect->querySQL = 'SELECT * FROM Users WHERE UUIDUsers = ? AND LoginKeyOneTime = ?';
	$userSelect->queryBindNamesA = array( UUIDUSERS, 'LoginKeyOneTime' );
	$userSelect->queryBindValuesA = array( $loginUUIDUser, $LoginKeyOneTime );
	$userSelect->query();
	// Error Check
	if ( $userSelect->errorB ) {
		$xanMessage .= ' OTC Login Select Error: ' . $userSelect->messageExtra . '; ' . $userSelect->messageSQL . STR_BR;
	} elseif ( $userSelect->rowCount < 1 ) {
		$xanMessage .= ' OTC Login Select: None Found' . STR_BR;
	} elseif ( $userSelect->rowCount > 0 ) {
		
		// User Update
		$userUpdate = new xan\recs( $mmUsersT );
		$userUpdate->querySQL = 'UPDATE Users SET Registered = ?, LoginKeyOneTime = ? WHERE UUIDUsers = ?';
		$userUpdate->queryBindNamesA = array( 'Registered', 'LoginKeyOneTime', UUIDUSERS );
		$userUpdate->queryBindValuesA = array( 'Yes', '', $loginUUIDUser );
		$userUpdate->query();
		// Error Check
		if ( $userUpdate->errorB ) {
			$xanMessage .= ' OTC Login Update Error: ' . $userUpdate->messageExtra . '; ' . $userUpdate->messageSQL . STR_BR;
		} elseif ( $userUpdate->rowCount < 1 ) {
			$xanMessage .= ' OTC Login Update: None Found' . STR_BR;
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
if ( \xan\isNotEmpty( $CookieRememberMe ) ) {
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
require_once( 'content-card-userLogin.php' );

// Scripts Extra
// $resp->scriptsOnLoadA[] = '';
// $resp->scriptsExtraA[] = xan\jsConsoleMsgAppend( 'Test: ' . 'Hey now!' );
// }

?>