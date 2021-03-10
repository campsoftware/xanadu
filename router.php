<?php
// Prep
$redirectToLogin = false;

// Get Path Parts
$path = $aloe_request->path_get();
$path_components = $aloe_request->path_components_get();

// Note:
// - aloe\session_init Regenerate = True for Pages; False for Ajax;

///////////////////////////////////////////////////////////
// xanDoSave
if ( ( $path_components[ 0 ] == 'xanDoSave' ) ) {
	aloe\session_init( APP_COOKIE_SESSION_SECONDS, false, $path );
	if ( !xan\userIsAuthenticated() ) {
		$redirectToLogin = true;
	} else {
		require_once( PATH_ROOT_XAN . 'do-save.php' );
		return;
	}
}

///////////////////////////////////////////////////////////
// Logout Page
if ( ( $path_components[ 0 ] == 'logout' ) ) {
	aloe\session_init( APP_COOKIE_SESSION_SECONDS, true, $path );
	$_SESSION[ SES_PATH ] = $path;
	$_SESSION[ SES_INFO ] = '';
	require_once( 'app/users-logout/logout.php' );
	return;
}

// Login Page
if ( ( $path_components[ 0 ] == 'login' ) ) {
	aloe\session_init( APP_COOKIE_SESSION_SECONDS, true, $path );
	$_SESSION[ SES_PATH ] = $path;
	$_SESSION[ SES_INFO ] = '';
	require_once( 'app/users-login/content-0-page.php' );
	return;
}

// Login Do
if ( ( $path_components[ 0 ] == 'login-do' ) ) {
	aloe\session_init( APP_COOKIE_SESSION_SECONDS, false, $path );
	$_SESSION[ SES_INFO ] = $path . '>' . print_r( $_POST, true );
	require_once( 'app/users-login/do.php' );
	return;
}

// Register Page
if ( ( $path_components[ 0 ] == 'register' ) ) {
	aloe\session_init( APP_COOKIE_SESSION_SECONDS, true, $path );
	$_SESSION[ SES_PATH ] = $path;
	$_SESSION[ SES_INFO ] = '';
	require_once( 'app/users-register/content-0-page.php' );
	return;
}

// Register Do
if ( ( $path_components[ 0 ] == 'register-do' ) ) {
	aloe\session_init( APP_COOKIE_SESSION_SECONDS, false, $path );
	$_SESSION[ SES_INFO ] = $path . '>' . print_r( $_POST, true );
	require_once( 'app/users-register/do.php' );
	return;
}


///////////////////////////////////////////////////////////
// Checkout Redirect
if ( ( $path_components[ 0 ] == 'checkoutThankYou' ) ) {
	aloe\session_init( APP_COOKIE_SESSION_SECONDS, true, $path );
	require_once( 'app/checkout/thankyou.php' );
	return;
}
if ( ( $path_components[ 0 ] == 'checkoutCancel' ) ) {
	aloe\session_init( APP_COOKIE_SESSION_SECONDS, true, $path );
	require_once( 'app/checkout/cancel.php' );
	return;
}


///////////////////////////////////////////////////////////
// Home

// Home Page
if ( ( $path_components[ 0 ] == 'home' ) || ( $aloe_request->path_get() == '' ) || ( $aloe_request->path_get() == '/' ) ) {
	aloe\session_init( APP_COOKIE_SESSION_SECONDS, true, $path );
	if ( !xan\userIsAuthenticated() ) {
		$redirectToLogin = true;
	} else {
		$_SESSION[ SES_PATH ] = $path;
		$_SESSION[ SES_INFO ] = '';
		require_once( 'app/home/content-0-page.php' );
		return;
	}
}


///////////////////////////////////////////////////////////
// Contacts

// Contacts Page
if ( ( $path_components[ 0 ] == 'contacts' ) ) {
	aloe\session_init( APP_COOKIE_SESSION_SECONDS, true, $path );
	if ( !xan\userIsAuthenticated() ) {
		$redirectToLogin = true;
	} else {
		$_SESSION[ SES_PATH ] = $path;
		$_SESSION[ SES_INFO ] = '';
		require_once( 'app/contacts/content-0-page.php' );
		return;
	}
}

// Contacts Do
if ( ( $path_components[ 0 ] == 'contacts-do' ) ) {
	aloe\session_init( APP_COOKIE_SESSION_SECONDS, false, $path );
	if ( !xan\userIsAuthenticated() ) {
		$redirectToLogin = true;
	} else {
		$_SESSION[ SES_INFO ] = $path . '>' . print_r( $_POST, true );
		require_once( 'app/contacts/do.php' );
		return;
	}
}


///////////////////////////////////////////////////////////
// Settings Area

// Settings PAge
if ( ( $path_components[ 0 ] == 'settings' ) ) {
	aloe\session_init( APP_COOKIE_SESSION_SECONDS, true, $path );
	if ( !xan\userIsAuthenticated() or !xan\userIsAdmin() ) {
		$redirectToLogin = true;
	} else {
		$_SESSION[ SES_PATH ] = $path;
		$_SESSION[ SES_INFO ] = '';
		require_once( 'app/settings/content-0-page.php' );
		return;
	}
}

// Settings Do
if ( ( $path_components[ 0 ] == 'settings-do' ) ) {
	aloe\session_init( APP_COOKIE_SESSION_SECONDS, false, $path );
	if ( !xan\userIsAuthenticated() ) {
		$redirectToLogin = true;
	} else {
		$_SESSION[ SES_INFO ] = $path . '>' . print_r( $_POST, true );
		require_once( 'app/settings/do.php' );
		return;
	}
}


// Stats Page
if ( ( $path_components[ 0 ] == 'server-stats' ) ) {
	aloe\session_init( APP_COOKIE_SESSION_SECONDS, false, $path );
	if ( !xan\userIsAuthenticated() or !xan\userIsAdmin() ) {
		$redirectToLogin = true;
	} else {
		$_SESSION[ SES_PATH ] = $path;
		$_SESSION[ SES_INFO ] = '';
		require_once( 'app/server-stats/content-0-page.php' );
		return;
	}
}

// Users Page
if ( ( $path_components[ 0 ] == 'settings-users' ) ) {
	aloe\session_init( APP_COOKIE_SESSION_SECONDS, true, $path );
	if ( !xan\userIsAuthenticated() or !xan\userIsAdmin() ) {
		$redirectToLogin = true;
	} else {
		$_SESSION[ SES_PATH ] = $path;
		$_SESSION[ SES_INFO ] = '';
		require_once( 'app/settings-users/content-0-page.php' );
		return;
	}
}

// Users Do
if ( ( $path_components[ 0 ] == 'settings-users-do' ) ) {
	aloe\session_init( APP_COOKIE_SESSION_SECONDS, false, $path );
	if ( !xan\userIsAuthenticated() ) {
		$redirectToLogin = true;
	} else {
		$_SESSION[ SES_INFO ] = $path . '>' . print_r( $_POST, true );
		require_once( 'app/settings-users/do.php' );
		return;
	}
}

///////////////////////////////////////////////////////////
// Otherwise Redirect to Login
if ( $redirectToLogin ) {
	$aloe_response->status_set( '307 Temporary Redirect' );
	$aloe_response->header_set( 'Location', '/login' );
	$aloe_response->content_set( '' );
	return;
}

///////////////////////////////////////////////////////////
// 404 - DO NOT LOAD THE SESSION
$_SESSION[ SES_PATH ] = '404: ' . $path;
require_once( 'app/server-404/content-0-page.php' );
?>