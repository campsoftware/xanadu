<?php
// Priv Redirect
if ( $_SESSION[ SESS_USER ][ 'PrivAdmin' ] !== 'Yes' ) {
	$aloe_response->status_set( '307 Temporary Redirect' );
	$aloe_response->header_set( 'Location', '/home/' );
	$aloe_response->content_set( '' );
}

// Response
$resp = new \xan\response;
$resp->reqPath = \xan\paramEncode( $aloe_request->path_get() );
$resp->reqPathComponents = \xan\paramEncode( $aloe_request->path_components_get() );
$resp->reqPost = \xan\paramEncode( $aloe_request->post );
// $resp->reqID = $resp->reqPathComponents[ 1 ];
$resp->moduleName = $mmServerStats->NameModule;
$resp->headTitle = $mmServerStats->NamePlural;
$resp->headLogoutAuto = false;
$resp->navInclude = true;
$resp->contentHeader = $mmServerStats->FontIcon . STR_NBSP . $mmServerStats->NamePlural . STR_NBSP;

// User Save Path Last
$mmUsersT->setPathLast( $resp->reqPath );

///////////////////////////////////////////////////////////
// Content Load Now or Later. Now is faster due to less 'round trips'. Later uses Ajax which is fast, but an extra 'round trip'.
if ( CONTENT_LOAD_NOW ) {
	require_once( 'content-cards.php' );
// 	$resp->scriptsOnLoadA[] = <<< JS
//         xanDo( { "Do": "Init", "Msg": "Init Elements", "URL": "{$mmServerStats->URLDoRelative}" } );
// JS;
//
// } else {
// 	$resp->scriptsOnLoadA[] = <<< JS
//         xanDo( { "Do": "ContentLoadAll", "Msg": "Load Content and Init Elements", "URL": "{$mmServerStats->URLDoRelative}", "IDSettings": "{$resp->reqID}" } );
// JS;
}

///////////////////////////////////////////////////////////
// Meta
$resp->headMetaPageURL = $mmServerStats->URLFull;
if ( \xan\isEmpty( $resp->reqID ) ) {
	// List
	$resp->headMetaTitle = $mmServerStats->NamePlural;
	$resp->headMetaDesc = '';
}else{
	// Detail
	$resp->headMetaTitle = $mmServerStats->NamePlural;
	$resp->headMetaDesc = '';
}
$resp->metaSet();

///////////////////////////////////////////////////////////
// Return Page
$aloe_response->content_set( require_once( PATH_PAGE_RESP ) );
?>