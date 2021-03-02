<?php
// Log
$logEvent = xan\logEventToSQL( 'Logout', "", "", xan\paramEncode( $_SERVER[ 'PHP_SELF' ] ), $_SESSION[ 'recsUsersCURRENT' ][ 'EmailAddress' ] ?? '', $_SESSION[ 'recsUsersCURRENT' ][ UUIDUSERS ] ?? '' );
// Error Check
if ( $logEvent->errorB ) {
	$aloe_response->status_set( '500 Internal Service Error: ' . 'LogAudit Error; ' . $logEvent->messageExtra . '; ' . $logEvent->messageSQL );
	$aloe_response->content_set( 'Error' );
	return;
} elseif ( $logEvent->rowCount < 1 ) {
	$aloe_response->status_set( '500 Internal Service Error: ' . 'LogAudit Not Found; '. $logEvent->messageExtra . '; ' . $logEvent->messageSQL );
	$aloe_response->content_set( 'Error' );
	return;
}

// Cookies Remove
setcookie( 'RememberMe', "", time() - 3600, '/' );
setcookie( 'Login', "", time() - 3600, '/' );

// Session Remove
session_unset();
session_destroy();

// Redirect
$aloe_response->status_set( '307 Temporary Redirect' );
$aloe_response->header_set( 'Location', '/login/' );
$aloe_response->content_set( '' );
return;
?>