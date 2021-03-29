<?php
// Params Get
$doParam = json_decode( $aloe_request->post[ 'params' ], true );

// Validate Init
$ValidationMsgA = array();

// Validate From Ajax
if ( xan\isAjax() === false ) {
	$ValidationMsgA[] = "Call Method Error";
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	$ValidationMsgA[] = "In URL: " . $doParam[ 'URL' ] . '; Do: ' . $doParam[ 'Do' ];
	$aloe_response->status_set( '400 Bad Request: ' . implode( ', ', $ValidationMsgA ) );
	$aloe_response->content_set( 'Error' );
	return;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Do ContentLoadAll
if ( $doParam[ 'Do' ] === 'ContentLoadAll' ) {
	// Response Init
	$resp = new \xan\response;
	$resp->reqPath = $aloe_request->path_get();
	$resp->moduleName = $mmUsersLogin->NameModule;
	$resp->headTitle = $mmUsersLogin->NameModule;
	$resp->headLogoutAuto = false;
	$resp->navInclude = true;
	$resp->contentHeader = $mmUsersLogin->FontAwesome . STR_NBSP . $mmUsersLogin->NameModule . STR_NBSP;
	
	// Content Area Load
	require_once( 'content-cards.php' );
	
	// Response Actions Append
	$resp->jsSetPageTitle( $resp->headTitle );
	$resp->jsSetHTML( '#pageContentHeader', $resp->headTitle );
	$resp->jsSetHTML( '#pageContentBody', xan\respAToString( $resp->contentAreaA ) );
	$resp->jsRunInit();
	
	// Actions Return as JSON
	$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
	return;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Do Init
if ( $doParam[ 'Do' ] === 'Init' ) {
	// Response Init
	$resp = new \xan\response;
	
	// Response Actions Append
	$resp->jsRunInit();
	
	// Actions Return as JSON
	$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
	return;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Do Login
if ( $doParam[ 'Do' ] === 'Login' ) {
	require_once( "do-users-login.php" );
	return;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Do Code Verify
if ( $doParam[ 'Do' ] === 'CodeVerify' ) {
	require_once( "do-users-codeVerify.php" );
	return;
}
?>