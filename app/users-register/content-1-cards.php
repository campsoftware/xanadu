<?php
// Get Path Parts
// $registrationLogin = $path_components[ 1 ];
// $registrationCode = $path_components[ 2 ];

// Get Posts
$PostLogin = xan\valuePOST( 'Login', '' );
$PostPassword = xan\valuePOST( 'Password', '' );
$PostPasswordVerify = xan\valuePOST( 'PasswordVerify', '' );
$PostFormName = xan\valuePOST( 'FormName', '' );

// Init
$xanMessage = '';

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Registration Validate
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
	if ( $PostPasswordVerify == '' ) {
		$xanMessage .= 'Password Verify is required.' . STR_BR;
		$Validated = false;
	}
	if ( $PostPassword !== $PostPasswordVerify ) {
		$xanMessage .= 'Password does not match Password Verify.' . STR_BR;
		$Validated = false;
	}
	if ( $Validated ) {
		
		// User Select
		$userSelect = new xan\recs( $mmUsersT );
		$userSelect->querySQL = 'SELECT * FROM Users WHERE EmailAddress = ? and Registered = ?';
		$userSelect->queryBindNamesA = array( 'EmailAddress', 'Registered' );
		$userSelect->queryBindValuesA = array( $PostLogin, 'Yes' );
		$userSelect->query();
		// Error Check
		if ( $userSelect->errorB ) {
			$xanMessage .= 'Select Error: ' . $userSelect->messageExtra . '; ' . $userSelect->messageSQL . STR_BR;
		} elseif ( $userSelect->rowCount < 1 ) {
			$xanMessage .= '';
		} elseif ( $userSelect->rowCount > 0 ) {
			$xanMessage .= 'Login already exists.' . STR_BR;
		}
		
	}
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Registration Process
if ( $Validated ) {
	// User Info
	$UUIDUsers = xan\strUUID();
	$Registered = 'No';
	$RegisterTS = xan\dateTimeNowSQL();
	$RegistrationCode = xan\strUUID();
	$PasswordSeed = xan\strUUID();
	$PasswordHash = hash( 'sha256', $PasswordSeed . $PostPassword );
	$SendEmail = true;
	
	// Does Login Exist?
	$userSelect = new xan\recs( $mmUsersT );
	$userSelect->querySQL = 'SELECT * FROM Users WHERE EmailAddress = ?';
	$userSelect->queryBindNamesA = array( 'EmailAddress' );
	$userSelect->queryBindValuesA = array( $PostLogin );
	$userSelect->query();
	// Error Check
	if ( $userSelect->errorB ) {
		$xanMessage .= 'Process Select Error: ' . $userSelect->messageExtra . '; ' . $userSelect->messageSQL . STR_BR;
		$SendEmail = false;
	} elseif ( $userSelect->rowCount < 1 ) {
		
		// User Insert
		$userSelect = new xan\recs( $mmUsersT );
		$sqlCols = array( 'UUIDUsers', 'UUIDTenants', 'EmailAddress', 'TwoFactorEmailAddress', 'PasswordHashSeed', 'PasswordHashed', 'RegisterTS', 'Registered', 'PasswordResetCode' );
		$userSelect->querySQL = 'INSERT INTO Users ( ' . implode( ', ', $sqlCols ) . ' ) VALUES ( ' . xan\dbQueryQuestions( count( $sqlCols ) ) . ' )';
		$userSelect->queryBindNamesA = $sqlCols;
		$userSelect->queryBindValuesA = array( $UUIDUsers, $GLOBALS[ UUIDTENANTS ], $PostLogin, $PostLogin, $PasswordSeed, $PasswordHash, $RegisterTS, $Registered, $RegistrationCode );
		$userSelect->query();
		// Error Check
		if ( $userSelect->errorB ) {
			$xanMessage .= 'Process Insert Error: ' . $userSelect->messageExtra . '; ' . $userSelect->messageSQL . STR_BR;
			$SendEmail = false;
		} elseif ( $userSelect->rowCount < 1 ) {
			$xanMessage .= 'Process Insert Not Found';
			$SendEmail = false;
		} elseif ( $userSelect->rowCount > 0 ) {
			// Expected
		}
		
	} elseif ( $userSelect->rowCount > 0 ) {
		
		// User Update
		$userSelect = new xan\recs( $mmUsersT );
		$userSelect->querySQL = 'UPDATE Users SET PasswordHashSeed = ?, PasswordHashed = ?, RegisterTS = ?, Registered = ?, PasswordResetCode = ? WHERE EmailAddress = ?';
		$userSelect->queryBindNamesA = array( 'PasswordHashSeed', 'PasswordHashed', 'RegisterTS', 'Registered', 'PasswordResetCode', 'EmailAddress' );
		$userSelect->queryBindValuesA = array( $PasswordSeed, $PasswordHash, $RegisterTS, $Registered, $RegistrationCode, $PostLogin );
		$userSelect->query();
		// Error Check
		if ( $userSelect->errorB ) {
			$xanMessage .= 'Process Update Error: ' . $userSelect->messageExtra . '; ' . $userSelect->messageSQL . STR_BR;
			$SendEmail = false;
		} elseif ( $userSelect->rowCount < 1 ) {
			$xanMessage .= 'Process Update Not Found';
			$SendEmail = false;
		} elseif ( $userSelect->rowCount > 0 ) {
			// Expected
		}
		
	}
	
	// Send Email
	if ( $SendEmail ) {
		$emailMessage = 'Click the following link to complete your ' . APP_NAME . ' Registration: ' . "\r\n" . URL_BASE . 'login/' . $PostLogin . '/' . $RegistrationCode;
		$sender = new \xan\sender();
		$sender->sendEmail( true, APP_EMAIL_FROM, $PostLogin, APP_NAME . " - Registration", nl2br( $emailMessage ), $emailMessage );
		$xanMessage .= 'An email was sent to ' . $PostLogin . ' to validate the registration.' . STR_BR;
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
require_once( 'content-card-user-register.php' );

// Scripts Extra
// $resp->scriptsOnLoadA[] = '';
// $resp->scriptsExtraA[] = xan\jsConsoleMsgAppend( 'Test: ' . 'Hey now!' );
// }

?>