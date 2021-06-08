<?php
// Response Init
$resp = new \xan\response;
$resp->reqPath = \xan\paramEncode( $aloe_request->path_get() );
$resp->reqPathComponents = \xan\paramEncode( $aloe_request->path_components_get() );
$resp->reqPost = \xan\paramEncode( $aloe_request->post );

// Params Get
$doParam = json_decode( $aloe_request->post[ 'params' ], true );
$doParam = \xan\paramEncode( $doParam );

// Validate Init
$ValidationMsgA = array();

// Validate From Ajax
if ( \xan\isAjax() === false ) {
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
	$resp->reqID = $doParam[ $mmContactsT->NameTableParam ];
	$resp->moduleName = $mmContactsT->NameModule;
	$resp->headTitle = $mmContactsT->NamePlural;
	$resp->headLogoutAuto = false;
	$resp->navInclude = true;
	$resp->contentHeader = $mmContactsT->FontIcon . STR_NBSP . $mmContactsT->NamePlural . STR_NBSP;
	
	// Content Area Load
	require_once( 'content-cards.php' );
	
	// Response Actions Append
	$resp->jsSetPageTitle( $resp->headTitle );
	$resp->jsSetHTML( '#pageContentHeader', $resp->headTitle );
	$resp->jsSetHTML( '#pageContentBody', \xan\respAToString( $resp->contentAreaA ) );
	$resp->jsRunInit();
	
	// Actions Return as JSON
	$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
	return;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Do Init
if ( $doParam[ 'Do' ] === 'Init' ) {
	// Response Actions Append
	$resp->jsRunInit();
	
	// Actions Return as JSON
	$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
	return;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Do Contacts Name Update
if ( $doParam[ 'Do' ] === 'ContactsNameUpdate' ) {
	require_once( "do-contacts-nameUpdate.php" );
	return;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Do Contacts Picker
if ( $doParam[ 'Do' ] === 'ContactsPicker' ) {
	require_once( "do-contacts-picker.php" );
	return;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Do Contacts Print
if ( $doParam[ 'Do' ] === 'ContactsPrint' ) {
	require_once( "do-contacts-print.php" );
	return;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Records Delete, Duplicate, Create
if ( $doParam[ 'Do' ] === 'ContactsRecDelete' ) {
	require_once( "do-contacts-recDelete.php" );
	return;
}

if ( $doParam[ 'Do' ] === 'ContactsRecDuplicate' ) {
	require_once( "do-contacts-recDuplicate.php" );
	return;
}

if ( $doParam[ 'Do' ] === 'ContactsRecNew' ) {
	require_once( "do-contacts-recNew.php" );
	return;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// ContactsComms Delete, Duplicate, Create
if ( $doParam[ 'Do' ] === 'ContactsCommsRecDelete' ) {
	require_once( "do-contactscomms-recDelete.php" );
	return;
}

if ( $doParam[ 'Do' ] === 'ContactsCommsRecNew' ) {
	require_once( "do-contactscomms-recNew.php" );
	return;
}

if ( $doParam[ 'Do' ] === 'ContactsCommsURLGet' ) {
	require_once( "do-contactscomms-urlGet.php" );
	return;
}
?>