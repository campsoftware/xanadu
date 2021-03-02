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

// Do ContentLoadAll
if ( $doParam[ 'Do' ] === 'ContentLoadAll' ) {
	// Response Init [ Matches Content ]
	$resp = new xan\response;
	$resp->reqPath = $aloe_request->path_get();
	$resp->reqID = $doParam[ 'IDUsers' ];
	$resp->moduleName = $mmUsersT->NameModule;
	$resp->headTitle = $mmUsersT->NameModule;
	$resp->navInclude = true;
	$resp->contentHeader = $mmUsersT->FontAwesome . STR_NBSP . $mmUsersT->NameModule . STR_NBSP;
	
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

// Do Init
if ( $doParam[ 'Do' ] === 'Init' ) {
	$result[ 'Do_RunInit' ] = true;
	$resultJSON = json_encode( $result );
	$aloe_response->content_set( $resultJSON );
	return;
}

// Do Things
if ( $doParam[ 'Do' ] === 'UsersNameUpdate' ) {
	require_once( "do-users-name-update.php" );
	return;
}

if ( $doParam[ 'Do' ] === 'UsersPasswordUpdate' ) {
	require_once( "do-users-password-update.php" );
	return;
}

if ( $doParam[ 'Do' ] === 'UsersPrint' ) {
	require_once( "do-users-print.php" );
	return;
}

// Records Delete, Duplicate, Create
if ( $doParam[ 'Do' ] === 'UsersRecDelete' ) {
	require_once( "do-users-rec-delete.php" );
	return;
}

if ( $doParam[ 'Do' ] === 'UsersRecDuplicate' ) {
	require_once( "do-users-rec-duplicate.php" );
	return;
}

if ( $doParam[ 'Do' ] === 'UsersRecNew' ) {
	require_once( "do-users-rec-new.php" );
	return;
}

?>