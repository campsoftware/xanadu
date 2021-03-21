<?php
// Prep
$xanDoDo = 'UsersPasswordChange';
$messageID = $xanDoDo . 'Message';
$modalID = $xanDoDo . '_Modal';
$buttonActionID = $xanDoDo . '_Modal_ButtonAction';
$buttonActionSpinnerID = $buttonActionID . 'Spinner';
$buttonActionOnClickFunctionName = $buttonActionID . 'OnClick';

// Response Init
$resp = new \xan\response;

// Spinner Hide; Button Enable
$resp->jsHideOrShow( '#' . $buttonActionSpinnerID, 'Hide' );
$resp->jsSetHTMLProperty( '#' . $buttonActionID, 'disabled', false );

// Validate Init
$ValidationMsgA = array();

// Validate Users ID
if ( \xan\isEmpty( $doParam[ 'IDUsers' ] ) ) {
	$ValidationMsgA[] = "User ID is Blank";
}

// Validate PasswordOld
if ( \xan\isEmpty( $doParam[ 'PasswordOld' ] ) ) {
	$ValidationMsgA[] = "Current Password Cannot be Blank";
}

// Validate PasswordNewOne
if ( \xan\isEmpty( $doParam[ 'PasswordNewOne' ] ) ) {
	$ValidationMsgA[] = "New Password Cannot be Blank";
}

// Validate PasswordNewTwo
if ( \xan\isEmpty( $doParam[ 'PasswordNewTwo' ] ) ) {
	$ValidationMsgA[] = "New Password Verify Cannot be Blank";
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	// Actions Return as JSON
	$resp->jsSetHTML( '#' . $messageID, implode( ', ', $ValidationMsgA ) );
	$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
	return;
}

// PasswordNewOne Not Equal to PasswordNewTwo
if ( $doParam[ 'PasswordNewOne' ] !== $doParam[ 'PasswordNewTwo' ] ) {
	$ValidationMsgA[] = "New Passwords Do Not Match";
}

// Validate Check. Check Old Password.
if ( empty( $ValidationMsgA ) ) {
	
	// User Select
	$userSelect = new xan\recs( $mmUsersT );
	$userSelect->querySQL = 'SELECT * FROM Users WHERE UUIDUsers = ?';
	$userSelect->queryBindNamesA = array( UUIDUSERS );
	$userSelect->queryBindValuesA = array( $doParam[ 'IDUsers' ] );
	$userSelect->query();
	// Error Check
	if ( $userSelect->errorB ) {
		$ValidationMsgA[] = 'Login and/or Password Error: ' . $userSelect->messageExtra . '; ' . $userSelect->messageSQL;
	} elseif ( $userSelect->rowCount < 1 ) {
		$ValidationMsgA[] = 'Login and/or Password Not Found';
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
		if ( \xan\isNotEmpty( $doParam[ 'PasswordOld' ] ) ) {
			$PasswordHash = hash( 'sha256', $userSelect->rowsD[ 0 ][ 'PasswordHashSeed' ] . $doParam[ 'PasswordOld' ] );
			if ( $PasswordHash !== $userSelect->rowsD[ 0 ][ 'PasswordHashed' ] ) {
				$ValidationMsgA[] = 'Current Password is Not Valid';
			}
		}
		
		// PasswordOld Equals PasswordNewOne
		if ( $doParam[ 'PasswordOld' ] === $doParam[ 'PasswordNewOne' ] ) {
			$ValidationMsgA[] = "New Password Cannot be the Same as the Current Password";
		}
		
	}
	
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	// Actions Return as JSON
	$resp->jsSetHTML( '#' . $messageID, implode( ', ', $ValidationMsgA ) );
	$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
	return;
}

// Password Calculate
$PasswordHashSeed = xan\strUUID();
$PasswordHashed = hash( 'sha256', $PasswordHashSeed . $doParam[ 'PasswordNewOne' ] );

// Password Update
$recsDetail = new xan\recs( $mmUsersT );
$recsDetail->recordUpdate( $doParam[ 'IDUsers' ], array( 'PasswordHashSeed' => $PasswordHashSeed, 'PasswordHashed' => $PasswordHashed ));
// Error Check
if ( $recsDetail->errorB ) {
	$ValidationMsgA[] = 'Login Update Error: ' . $recsDetail->messageExtra . ';' .  $recsDetail->messageSQL;
} elseif ( $recsDetail->rowCount < 1 ) {
	$ValidationMsgA[] = 'Login Update None Found';
} elseif ( $recsDetail->rowCount > 0 ) {
	// Success
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	// Actions Return as JSON
	$resp->jsSetHTML( '#' . $messageID, implode( ', ', $ValidationMsgA ) );
	$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
	return;
}

// Hide the Modal
if ( empty( $ValidationMsgA ) ){
	$resp->jsHideOrShowModal( '#' . $modalID, 'Hide' );
}

// Actions Return as JSON
$resp->jsSetHTML( '#' . $messageID, implode( ', ', $ValidationMsgA ) );
$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
return;
?>
