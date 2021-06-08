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
	// $resp->reqID = $doParam[ $mmContactsT->NameTableParam ];
	$resp->moduleName = $mmServerStatsT->NameModule;
	$resp->headTitle = $mmServerStatsT->NamePlural;
	$resp->headLogoutAuto = false;
	$resp->navInclude = true;
	$resp->contentHeader = $mmServerStatsT->FontIcon . STR_NBSP . $mmServerStatsT->NamePlural . STR_NBSP;
	
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
?>