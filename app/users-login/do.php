<?php
// Params Get
$doParam = json_decode( $_POST[ 'params' ], true );

// Validate Init
$ValidationMessage = array();

// Validate From Ajax
if ( xan\isAjax() === false ) {
	$ValidationMessage[] = "Do Validation 01";
}

// Invalid Response
if ( !empty( $ValidationMessage ) ) {
	$ValidationMessage[] = "In URL: " . $doParam[ 'URL' ] . '; Do: ' . $doParam[ 'Do' ];
	$aloe_response->status_set( '400 Bad Request: ' . implode( ', ', $ValidationMessage ) );
	$aloe_response->content_set( 'Error' );
	return;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Do ContentLoadAll
if ( $doParam[ 'Do' ] === 'ContentLoadAll' ) {
	// Response Init [ Matches Content ]
	$resp = new xan\response;
	$resp->reqPath = $aloe_request->path_get();
	$resp->moduleName = $mmUsersLogin->NameModule;
	$resp->headTitle = $mmUsersLogin->NameModule;
	$resp->headLogoutAuto = false;
	$resp->navInclude = true;
	$resp->contentHeader = $mmUsersLogin->FontAwesome . STR_NBSP . $mmUsersLogin->NameModule . STR_NBSP;
	
	// Content Area Load
	require_once( 'content-1-cards.php' );
	
	// Return
	$result[ 'Do_PageTitle' ] = $resp->headTitle;
	$result[ 'Do_HTMLSelectorName' ][ 0 ] = '#pageContentHeader';
	$result[ 'Do_HTMLSelectorData' ][ 0 ] = $resp->headTitle;
	$result[ 'Do_HTMLSelectorName' ][ 1 ] = '#pageContentBody';
	$result[ 'Do_HTMLSelectorData' ][ 1 ] = xan\respAToString( $resp->contentAreaA );
	$result[ 'Do_RunInit' ] = true;
	
	// Return JSON
	$aloe_response->content_set( json_encode( $result ) );
	return;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Do Init
if ( $doParam[ 'Do' ] === 'Init' ) {
	$result[ 'Do_RunInit' ] = true;
	$resultJSON = json_encode( $result );
	$aloe_response->content_set( $resultJSON );
	return;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Do Login
if ( $doParam[ 'Do' ] === 'Login' ) {
	
	// Set Login Cookie
	if ( \xan\isNotEmpty( $doParam[ 'Login' ] ) ) {
		setcookie( COOKIE_LOGIN, $doParam[ 'Login' ], time() + ( 86400 * APP_COOKIE_LOGIN_DAYS ), '/' );
	}
	
	// Validate Init
	$ValidationMessage = array();
	
	// Validate Login
	if ( xan\isEmpty( $doParam[ 'Login' ] ) ) {
		$ValidationMessage[] = "Login is Blank.";
	}
	
	// Validate Password
	if ( xan\isEmpty( $doParam[ 'Password' ] ) ) {
		$ValidationMessage[] = "Password is Blank.";
	}
	
	// Validate Check. Check Login and Password
	if ( empty( $ValidationMessage ) ) {
		
		// User Select
		$userSelect = new xan\recs( $mmUsersT );
		$userSelect->querySQL = 'SELECT * FROM Users WHERE EmailAddress = ?';
		$userSelect->queryBindNamesA = array( 'EmailAddress' );
		$userSelect->queryBindValuesA = array( $doParam[ 'Login' ] );
		$userSelect->query();
		// Error Check
		if ( $userSelect->errorB ) {
			$ValidationMessage[] = ' Login and/or Password Error: ' . $userSelect->messageExtra . '; ' . $userSelect->messageSQL . STR_BR;
		} elseif ( $userSelect->rowCount < 1 ) {
			$ValidationMessage[] = ' Login and/or Password: None Found.' . STR_BR;
		} elseif ( $userSelect->rowCount > 0 ) {
			
			// Validate User Active
			if ( $userSelect->rowsD[ 0 ][ 'Active' ] !== 'Yes' ) {
				$ValidationMessage[] = 'Login is not Active.';
			}
			
			// Validate User Registered
			if ( $userSelect->rowsD[ 0 ][ 'Registered' ] !== 'Yes' ) {
				$ValidationMessage[] = 'Login is not Registered.';
			}
			
			// Validate Password
			if ( \xan\isNotEmpty( $doParam[ 'Password' ] ) ) {
				$PasswordHash = hash( 'sha256', $userSelect->rowsD[ 0 ][ 'PasswordHashSeed' ] . $doParam[ 'Password' ] );
				if ( $PasswordHash !== $userSelect->rowsD[ 0 ][ 'PasswordHashed' ] ) {
					$ValidationMessage[] = 'Login and/or Password: None Found.';
				}
			}
		}
		
	}
	
	// Validate Check
	if ( !empty( $ValidationMessage ) ) {
		// Messages
		$i = -1;
		$result[ 'Do_HTMLSelectorName' ][ ++$i ] = '#formMessageLogin';
		$result[ 'Do_HTMLSelectorData' ][ $i ] = implode( ', ', $ValidationMessage );
		// Return JSON
		$aloe_response->content_set( json_encode( $result ) );
		return;
	}
	
	// Send 2FA and advance to Code Check
	
	// HideShow
	$i = -1;
	$result[ 'Do_HideShowSelectorName' ][ ++$i ] = '#loginForm';
	$result[ 'Do_HideShowSelectorVis' ][ $i ] = 'Hide';
	$result[ 'Do_HideShowSelectorName' ][ ++$i ] = '#formMessageCode';
	$result[ 'Do_HideShowSelectorVis' ][ $i ] = 'Show';
	
	// Values
	$i = -1;
	$result[ 'Do_ValSelectorName' ][ ++$i ] = '#Password';
	$result[ 'Do_ValSelectorData' ][ $i ] = '';
	
	// Focus
	$result[ 'Do_FocusSelectorName' ] = '#Code';
	
	// Send 2FA
	$mmUsersT->set2FA( $userSelect->rowsD[ 0 ][ UUIDUSERS ] );
	$sender = new \xan\sender();
	// Send SMS
	if ( \xan\isNotEmpty( $userSelect->rowsD[ 0 ][ 'PhoneTwoFactor' ] ) ) {
		$sender->sendSMS( $userSelect->rowsD[ 0 ][ 'PhoneTwoFactor' ], $mmUsersT->TwoFactorBody );
	}
	// Send Email
	if ( \xan\isNotEmpty( $userSelect->rowsD[ 0 ][ 'EmailTwoFactor' ] ) ) {
		$sender->sendEmail( true, APP_EMAIL_FROM, $userSelect->rowsD[ 0 ][ 'EmailAddress' ], $mmUsersT->TwoFactorSubject, '', $mmUsersT->TwoFactorBody );
	}
	
	// Return JSON
	$aloe_response->content_set( json_encode( $result ) );
	return;
	
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Do CodeVerify
if ( $doParam[ 'Do' ] === 'CodeVerify' ) {
	
	// Validate Init
	$ValidationMessage = array();
	
	// Validate Login
	if ( xan\isEmpty( $doParam[ 'Login' ] ) ) {
		$ValidationMessage[] = "Login is Blank.";
	}
	
	// Validate Code
	if ( xan\isEmpty( $doParam[ 'Code' ] ) ) {
		$ValidationMessage[] = "Code is Blank.";
	}
	
	// Validate User
	if ( empty( $ValidationMessage ) ) {
		// User Select
		$userSelect = new xan\recs( $mmUsersT );
		$userSelect->querySQL = 'SELECT * FROM Users WHERE EmailAddress = ?';
		$userSelect->queryBindNamesA = array( 'EmailAddress' );
		$userSelect->queryBindValuesA = array( $doParam[ 'Login' ] );
		$userSelect->query();
		// Error Check
		if ( $userSelect->errorB ) {
			$ValidationMessage[] = ' Login and/or Password Error: ' . $userSelect->messageExtra . '; ' . $userSelect->messageSQL . STR_BR;
		} elseif ( $userSelect->rowCount < 1 ) {
			$ValidationMessage[] = ' Login and/or Password: None Found.' . STR_BR;
		} elseif ( $userSelect->rowCount > 0 ) {
			
			// Validate User Active
			if ( $userSelect->rowsD[ 0 ][ 'Active' ] !== 'Yes' ) {
				$ValidationMessage[] = 'Login is not Active.';
			}
			
			// Validate User Registered
			if ( $userSelect->rowsD[ 0 ][ 'Registered' ] !== 'Yes' ) {
				$ValidationMessage[] = 'Login is not Registered.';
			}
			
			// Validate Code String
			if ( \xan\isNotEmpty( $doParam[ 'Code' ] ) ) {
				if ( $doParam[ 'Code' ] !== $userSelect->rowsD[ 0 ][ 'TwoFactorString' ] ) {
					$ValidationMessage[] = 'Code is not Valid.';
				}
			}
			
			// Validate Code Timestamp
			if ( \xan\isNotEmpty( $doParam[ 'Code' ] ) ) {
				$tsNow = \xan\dateTimeFromString( 'now', DATETIME_FORMAT_SQLDATETIME );
				if ( $tsNow > $userSelect->rowsD[ 0 ][ 'TwoFactorExpiresTS' ] ) {
					$ValidationMessage[] = 'Code is no longer Valid.';
				}
			}
			
		}
	}
	
	// Validate Response
	if ( !empty( $ValidationMessage ) ) {
		// Messages
		$i = -1;
		$result[ 'Do_HTMLSelectorName' ][ ++$i ] = '#codeMessage';
		$result[ 'Do_HTMLSelectorData' ][ $i ] = implode( ', ', $ValidationMessage );
		// Return JSON
		$aloe_response->content_set( json_encode( $result ) );
		return;
	}
	
	// Values Clear Code
	$i = -1;
	$result[ 'Do_ValSelectorName' ][ ++$i ] = '#Code';
	$result[ 'Do_ValSelectorData' ][ $i ] = '';
	
	// DB Clear Code
	$mmUsersT->set2FA( $userSelect->rowsD[ 0 ][ UUIDUSERS ], '' );
	
	//  Cookie RememberMe Set
	$RememberMeIsUpdated = false;
	if ( $doParam[ 'RememberMe' ] === '1' ) {
		$RememberMeID = xan\strUUID();
		$UUIDUsers = $userSelect->rowsD[ 0 ][ UUIDUSERS ];
		setcookie( COOKIE_REMEMBERME, $RememberMeID, time() + ( 86400 * APP_COOKIE_LOGIN_DAYS ), '/' );
		
		// User Update
		$userUpdate = new xan\recs( $mmUsersT );
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
	$result[ "Do_URLLoad" ] = $redirectPath;
	
	// Messages
	$i = -1;
	$result[ 'Do_HTMLSelectorName' ][ ++$i ] = '#codeMessage';
	$result[ 'Do_HTMLSelectorData' ][ $i ] = 'Loading...';
	
	// Return JSON
	$aloe_response->content_set( json_encode( $result ) );
	return;
}
?>