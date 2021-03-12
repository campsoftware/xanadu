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
if ( $doParam[ 'Do' ] === 'PasswordReset' ) {
	
	$messageIfMatching = 'If a matching Login was found, an email was sent with a One Time Login Link.';
	
	// Validate Init
	$ValidationMessage = array();
	
	// Validate Login
	if ( xan\isEmpty( $doParam[ 'Login' ] ) ) {
		$ValidationMessage[] = "Email is Blank.";
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
			$ValidationMessage[] = $messageIfMatching;
		} elseif ( $userSelect->rowCount > 0 ) {
			// OK to Continue, User Found
			if ( \xan\isEmpty( $userSelect->rowsD[ 0 ][ 'EmailAddress' ] ) ) {
				$ValidationMessage[] = $messageIfMatching;
			}
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
	
	// One Time Login Code
	$LoginKeyOneTime = xan\strUUID();
	// User Update
	$userUpdate = new xan\recs( $mmUsersT );
	$userUpdate->recordUpdate( $userSelect->rowsD[ 0 ][ UUIDUSERS ], array( 'LoginKeyOneTime' => $LoginKeyOneTime ) );
	// Error Check
	if ( $userUpdate->errorB ) {
		$result[ 'Do_ErrorMessage' ] = $userUpdate->messageExtra . ';' . $userUpdate->messageSQL;
	} elseif ( $userUpdate->rowCount < 1 ) {
		$result[ 'Do_ErrorMessage' ] = 'None Found';
	} elseif ( $userUpdate->rowCount > 0 ) {
		// OK to Continue, User Updated
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
	
	// Send Email
	$emailMessage = 'Click the following link to Login. Once logged in, please reest your ' . APP_NAME . ' password. One Time Login Link: ' . "\r\n" . URL_BASE . 'login/otc/' . $userSelect->rowsD[ 0 ][ UUIDUSERS ] . '/' . $LoginKeyOneTime;
	$sender = new \xan\sender();
	if ( \xan\isNotEmpty( $userSelect->rowsD[ 0 ][ 'EmailAddress' ] ) ) {
		$sender->sendEmail( true, APP_EMAIL_FROM, $userSelect->rowsD[ 0 ][ 'EmailAddress' ], APP_NAME . " - Registration", $emailMessage, $emailMessage );
	}
	
	// Update Message
	$ValidationMessage[] = $messageIfMatching;
	
	// Messages
	$i = -1;
	$result[ 'Do_HTMLSelectorName' ][ ++$i ] = '#formMessage';
	$result[ 'Do_HTMLSelectorData' ][ $i ] = implode( ', ', $ValidationMessage );
	
	// Return JSON
	$aloe_response->content_set( json_encode( $result ) );
	return;
}


?>