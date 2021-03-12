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
	$resp->moduleName = $mmUsersRegister->NameModule;
	$resp->headTitle = $mmUsersRegister->NameModule;
	$resp->headLogoutAuto = false;
	$resp->navInclude = true;
	$resp->contentHeader = $mmUsersRegister->FontAwesome . STR_NBSP . $mmUsersRegister->NameModule . STR_NBSP;
	
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

// Do Register
if ( $doParam[ 'Do' ] === 'Registration' ) {
	
	// Validate Init
	$ValidationMessage = array();
	
	// Validate Login
	if ( xan\isEmpty( $doParam[ 'Login' ] ) ) {
		$ValidationMessage[] = "Email is Blank.";
	}
	
	// Validate Password
	if ( xan\isEmpty( $doParam[ 'Password' ] ) ) {
		$ValidationMessage[] = "Password is Blank.";
	}
	
	// Validate Password
	if ( xan\isEmpty( $doParam[ 'PasswordVerify' ] ) ) {
		$ValidationMessage[] = "Password Verify is Blank.";
	}
	
	// Password Match
	if ( $doParam[ 'Password' ] !== $doParam[ 'PasswordVerify' ] ) {
		$ValidationMessage[] = "Password does not match Password Verify.";
	}
	
	// Validate Check. Does User Exist?
	if ( empty( $ValidationMessage ) ) {
		
		// User Select
		$userSelect = new xan\recs( $mmUsersT );
		$userSelect->querySQL = 'SELECT * FROM Users WHERE EmailAddress = ? and Registered = ?';
		$userSelect->queryBindNamesA = array( 'EmailAddress', 'Registered' );
		$userSelect->queryBindValuesA = array( $doParam[ 'Login' ], 'Yes' );
		$userSelect->query();
		// Error Check
		if ( $userSelect->errorB ) {
			$ValidationMessage[] = 'Select Error: ' . $userSelect->messageExtra . '; ' . $userSelect->messageSQL;
		} elseif ( $userSelect->rowCount < 1 ) {
			// OK to Continue, User Not Found
		} elseif ( $userSelect->rowCount > 0 ) {
			$ValidationMessage[] = 'Login already exists.';
		}
		
	}
	
	// Validate Check
	if ( !empty( $ValidationMessage ) ) {
		// Messages
		$i = -1;
		$result[ 'Do_HTMLSelectorName' ][ ++$i ] = '#formMessage';
		$result[ 'Do_HTMLSelectorData' ][ $i ] = implode( ', ', $ValidationMessage );
		// Return JSON
		$aloe_response->content_set( json_encode( $result ) );
		return;
	}
	
	// Create User
	$UUIDUsers = xan\strUUID();
	$Registered = 'No';
	$RegisterTS = xan\dateTimeNowSQL();
	$LoginKeyOneTime = xan\strUUID();
	$PasswordSeed = xan\strUUID();
	$PasswordHash = hash( 'sha256', $PasswordSeed . $doParam[ 'Password' ] );
	
	// Does Login Exist?
	$userSelect = new xan\recs( $mmUsersT );
	$userSelect->querySQL = 'SELECT * FROM Users WHERE EmailAddress = ?';
	$userSelect->queryBindNamesA = array( 'EmailAddress' );
	$userSelect->queryBindValuesA = array( $doParam[ 'Login' ] );
	$userSelect->query();
	// Error Check
	if ( $userSelect->errorB ) {
		$ValidationMessage[] = 'Process Select Error: ' . $userSelect->messageExtra . '; ' . $userSelect->messageSQL;
	} elseif ( $userSelect->rowCount < 1 ) {
		
		// User Insert
		$userInsert = new xan\recs( $mmUsersT );
		$sqlCols = array( 'UUIDUsers', 'UUIDTenants', 'EmailAddress', 'PasswordHashSeed', 'PasswordHashed', 'RegisterTS', 'Registered', 'LoginKeyOneTime' );
		$userInsert->querySQL = 'INSERT INTO Users ( ' . implode( ', ', $sqlCols ) . ' ) VALUES ( ' . xan\dbQueryQuestions( count( $sqlCols ) ) . ' )';
		$userInsert->queryBindNamesA = $sqlCols;
		$userInsert->queryBindValuesA = array( $UUIDUsers, $GLOBALS[ UUIDTENANTS ], $doParam[ 'Login' ], $PasswordSeed, $PasswordHash, $RegisterTS, $Registered, $LoginKeyOneTime );
		$userInsert->query();
		// Error Check
		if ( $userInsert->errorB ) {
			$ValidationMessage[] = 'Process Insert Error: ' . $userInsert->messageExtra . '; ' . $userInsert->messageSQL;
		} elseif ( $userInsert->rowCount < 1 ) {
			$ValidationMessage[] = 'Process Insert Not Found';
		} elseif ( $userInsert->rowCount > 0 ) {
			// OK to Continue
		}
		
	} elseif ( $userSelect->rowCount > 0 ) {
		
		// User Update
		$userUpdate = new xan\recs( $mmUsersT );
		$userUpdate->querySQL = 'UPDATE Users SET PasswordHashSeed = ?, PasswordHashed = ?, RegisterTS = ?, Registered = ?, LoginKeyOneTime = ? WHERE EmailAddress = ?';
		$userUpdate->queryBindNamesA = array( 'PasswordHashSeed', 'PasswordHashed', 'RegisterTS', 'Registered', 'LoginKeyOneTime', 'EmailAddress' );
		$userUpdate->queryBindValuesA = array( $PasswordSeed, $PasswordHash, $RegisterTS, $Registered, $LoginKeyOneTime, $doParam[ 'Login' ] );
		$userUpdate->query();
		// Error Check
		if ( $userUpdate->errorB ) {
			$ValidationMessage[] = 'Process Update Error: ' . $userUpdate->messageExtra . '; ' . $userUpdate->messageSQL;
		} elseif ( $userUpdate->rowCount < 1 ) {
			$ValidationMessage[] = 'Process Update Not Found';
		} elseif ( $userUpdate->rowCount > 0 ) {
			// Expected
		}
		
	}
	
	// Validate Check
	if ( !empty( $ValidationMessage ) ) {
		// Messages
		$i = -1;
		$result[ 'Do_HTMLSelectorName' ][ ++$i ] = '#formMessage';
		$result[ 'Do_HTMLSelectorData' ][ $i ] = implode( ', ', $ValidationMessage );
		
		// Return JSON
		$aloe_response->content_set( json_encode( $result ) );
		return;
	}
	
	// User Select
	$userSelect = new xan\recs( $mmUsersT );
	$userSelect->querySQL = 'SELECT * FROM Users WHERE EmailAddress = ?';
	$userSelect->queryBindNamesA = array( 'EmailAddress' );
	$userSelect->queryBindValuesA = array( $doParam[ 'Login' ] );
	$userSelect->query();
	
	// Send Email
	$emailMessage = 'Click the following link to complete your ' . APP_NAME . ' Registration: ' . "\r\n" . URL_BASE . 'login/otc/' . $userSelect->rowsD[ 0 ][ UUIDUSERS ] . '/' . $LoginKeyOneTime;
	$sender = new \xan\sender();
	if ( \xan\isNotEmpty( $doParam[ 'Login' ] ) ) {
		$sender->sendEmail( true, APP_EMAIL_FROM, $doParam[ 'Login' ], APP_NAME . " - Registration", $emailMessage, $emailMessage );
	}
	
	// Update Message
	$ValidationMessage[] = 'An email was sent to ' . $doParam[ 'Login' ] . ' to validate the registration.';
	
	// Messages
	$i = -1;
	$result[ 'Do_HTMLSelectorName' ][ ++$i ] = '#formMessage';
	$result[ 'Do_HTMLSelectorData' ][ $i ] = implode( ', ', $ValidationMessage );
	
	// Return JSON
	$aloe_response->content_set( json_encode( $result ) );
	return;
}


?>