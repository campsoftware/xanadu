<?php
// Session management functions.

namespace aloe {
	
	use function xan\dateTimeFromString;
	
	function session_init( $timeout, $regenerate, $info ) {
		
		// Call session_init with a $regenerate value of FALSE
		// in cases where you do not want a new session ID
		// generated. For example, when AJAX calls are being made.
		
		// Change the PHP Session ID cookie name from PHPSESSID.
		session_name( 'aloeSID' );
		
		// Start a new session, or resume an existing session.
		@session_start();
		
		// Set Session Data
		$_SESSION[ SES_INFO ] = $info;
		if ( !isset( $_SESSION[ SES_BEGIN ] ) ) {
			$_SESSION[ SES_BEGIN ] = dateTimeFromString( 'now' , DATETIME_FORMAT_SQLDATETIME );
		}
		$_SESSION[ SES_CHANGE ] = dateTimeFromString( 'now' , DATETIME_FORMAT_SQLDATETIME );
		$_SESSION[ SES_EXPIRES ] = dateTimeFromString( '+' . $timeout . 'seconds' , DATETIME_FORMAT_SQLDATETIME );
		
		// Update the current session's id with a newly generated one,
		// and delete the old associated session file.
		if ( $regenerate === TRUE ) {
			@session_regenerate_id( TRUE );
		}
		
		// Force the PHP session cookie to expire after "SESSION_TIMEOUT" minutes of inactivity.
		//setcookie( session_name(), session_id(), time() + $timeout, '/', 'campsoftware.com', TRUE, TRUE );
		setcookie( session_name(), session_id(), time() + $timeout, '/' );
	}
	
	function session_terminate() {
		
		// Destroy the session.
		@session_start();
		@session_unset();
		@session_destroy();
		
		// Kill the cookie.
		@setcookie( session_name(), session_id(), time() - 3600, '/' );
		
	}
	
}
?>