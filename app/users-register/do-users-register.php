<?php
// Spinner Hide; Button Enable
$resp->jsHideOrShow( '#formButtonSpinner', 'Hide' );
$resp->jsSetHTMLProperty( '#formButton', 'disabled', false );

// Validate Init
$ValidationMsgA = array();

// Validate Login
if ( \xan\isEmpty( $doParam[ 'Login' ] ) ) {
	$ValidationMsgA[] = "Email is Blank";
}
if ( \xan\emailAddressIsValid( $doParam[ 'Login' ] ) ) {
	$ValidationMsgA[] = "Email Address is Not Valid";
}

// Validate Password
if ( \xan\isEmpty( $doParam[ 'Password' ] ) ) {
	$ValidationMsgA[] = "Password is Blank";
}

// Validate Password
if ( \xan\isEmpty( $doParam[ 'PasswordVerify' ] ) ) {
	$ValidationMsgA[] = "Password Verify is Blank";
}

// Password Match
if ( $doParam[ 'Password' ] !== $doParam[ 'PasswordVerify' ] ) {
	$ValidationMsgA[] = "Password does not match Password Verify";
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
		// OK to Continue, User Not Found
	} elseif ( $userSelect->rowCount > 0 ) {
		$ValidationMsgA[] = 'Login already exists';
	}
	
}

// Validate Check
if ( !empty( $ValidationMsgA ) ) {
	// Actions Return as JSON
	$resp->jsSetHTML( '#formMessage', implode( ', ', $ValidationMsgA ) );
	$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
	return;
}

// Create User
$UUIDUsers = \xan\strUUID();
$Registered = 'No';
$RegisterTS = \xan\dateTimeNowSQL();
$LoginKeyOneTime = \xan\strUUID();
$PasswordSeed = \xan\strUUID();
$PasswordHash = hash( 'sha256', $PasswordSeed . $doParam[ 'Password' ] );

// Does Login Exist?
$userSelect = new \xan\recs( $mmUsersT );
$userSelect->querySQL = 'SELECT * FROM Users WHERE EmailAddress = ?';
$userSelect->queryBindNamesA = array( 'EmailAddress' );
$userSelect->queryBindValuesA = array( $doParam[ 'Login' ] );
$userSelect->query();
// Error Check
if ( $userSelect->errorB ) {
	$ValidationMsgA[] = 'Login Check Error: ' . $userSelect->messageExtra . '; ' . $userSelect->messageSQL;
} elseif ( $userSelect->rowCount < 1 ) {
	
	// User Insert
	$userInsert = new \xan\recs( $mmUsersT );
	$sqlCols = array( 'UUIDUsers', 'UUIDTenants', 'EmailAddress', 'PasswordHashSeed', 'PasswordHashed', 'RegisterTS', 'Registered', 'LoginKeyOneTime' );
	$userInsert->querySQL = 'INSERT INTO Users ( ' . implode( ', ', $sqlCols ) . ' ) VALUES ( ' . \xan\dbQueryQuestions( count( $sqlCols ) ) . ' )';
	$userInsert->queryBindNamesA = $sqlCols;
	$userInsert->queryBindValuesA = array( $UUIDUsers, $GLOBALS[ UUIDTENANTS ], $doParam[ 'Login' ], $PasswordSeed, $PasswordHash, $RegisterTS, $Registered, $LoginKeyOneTime );
	$userInsert->query();
	// Error Check
	if ( $userInsert->errorB ) {
		$ValidationMsgA[] = 'Login Create Error: ' . $userInsert->messageExtra . '; ' . $userInsert->messageSQL;
	} elseif ( $userInsert->rowCount < 1 ) {
		$ValidationMsgA[] = 'Login Create Not Found';
	} elseif ( $userInsert->rowCount > 0 ) {
		// OK to Continue
	}
	
} elseif ( $userSelect->rowCount > 0 ) {
	
	// User Update
	$userUpdate = new \xan\recs( $mmUsersT );
	$userUpdate->querySQL = 'UPDATE Users SET PasswordHashSeed = ?, PasswordHashed = ?, RegisterTS = ?, Registered = ?, LoginKeyOneTime = ? WHERE EmailAddress = ?';
	$userUpdate->queryBindNamesA = array( 'PasswordHashSeed', 'PasswordHashed', 'RegisterTS', 'Registered', 'LoginKeyOneTime', 'EmailAddress' );
	$userUpdate->queryBindValuesA = array( $PasswordSeed, $PasswordHash, $RegisterTS, $Registered, $LoginKeyOneTime, $doParam[ 'Login' ] );
	$userUpdate->query();
	// Error Check
	if ( $userUpdate->errorB ) {
		$ValidationMsgA[] = 'Login Update Error: ' . $userUpdate->messageExtra . '; ' . $userUpdate->messageSQL;
	} elseif ( $userUpdate->rowCount < 1 ) {
		$ValidationMsgA[] = 'Login Update Not Found';
	} elseif ( $userUpdate->rowCount > 0 ) {
		// Expected
	}
	
}

// Validate Check
if ( !empty( $ValidationMsgA ) ) {
	// Actions Return as JSON
	$resp->jsSetHTML( '#formMessage', implode( ', ', $ValidationMsgA ) );
	$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
	return;
}

// User Select
$userSelect = new \xan\recs( $mmUsersT );
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

// Message Append
$ValidationMsgA[] = 'An email was sent to ' . $doParam[ 'Login' ] . ' to validate the registration';

// Actions Return as JSON
$resp->jsSetHTML( '#formMessage', implode( ', ', $ValidationMsgA ) );
$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
return;
?>