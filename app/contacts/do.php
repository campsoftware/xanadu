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
	$resp->reqID = $doParam[ 'IDContacts' ];
	$resp->moduleName = $mmContactsT->NameModule;
	$resp->headTitle = $mmContactsT->NameModule;
	$resp->navInclude = true;
	$resp->contentHeader = $mmContactsT->FontAwesome . STR_NBSP . $mmContactsT->NameModule . STR_NBSP;
	
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
if ( $doParam[ 'Do' ] === 'ContactsNameUpdate' ) {
	require_once( "do-contacts-name-update.php" );
	return;
}

if ( $doParam[ 'Do' ] === 'ContactsPicker' ) {
	require_once( "do-contacts-picker.php" );
	return;
}

if ( $doParam[ 'Do' ] === 'ContactsPrint' ) {
	require_once( "do-contacts-print.php" );
	return;
}

// Records Delete, Duplicate, Create
if ( $doParam[ 'Do' ] === 'ContactsRecDelete' ) {
	require_once( "do-contacts-rec-delete.php" );
	return;
}

if ( $doParam[ 'Do' ] === 'ContactsRecDuplicate' ) {
	require_once( "do-contacts-rec-duplicate.php" );
	return;
}

if ( $doParam[ 'Do' ] === 'ContactsRecNew' ) {
	require_once( "do-contacts-rec-new.php" );
	return;
}

// ContactsComms Delete, Duplicate, Create
if ( $doParam[ 'Do' ] === 'ContactsCommsRecDelete' ) {
	require_once( "do-contactscomms-rec-delete.php" );
	return;
}

if ( $doParam[ 'Do' ] === 'ContactsCommsRecNew' ) {
	require_once( "do-contactscomms-rec-new.php" );
	return;
}

if ( $doParam[ 'Do' ] === 'ContactsCommsURLGet' ) {
	require_once( "do-contactscomms-url-get.php" );
	return;
}
?>