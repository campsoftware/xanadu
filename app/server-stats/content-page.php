<?php
// User Save Path Last
$mmUsersT->setPathLast( $aloe_request->path_get() );

// Priv Redirect
if ( $_SESSION[ SESS_USER ][ 'PrivAdmin' ] !== 'Yes' ) {
	$aloe_response->status_set( '307 Temporary Redirect' );
	$aloe_response->header_set( 'Location', '/home/' );
	$aloe_response->content_set( '' );
}

// Response
$resp = new \xan\response;
$resp->reqPath = $aloe_request->path_get();
$resp->reqID = $aloe_request->path_components_get()[ 1 ];
$resp->moduleName = $mmServerStats->NameModule;
$resp->headTitle = $mmServerStats->NameModule;
$resp->headLogoutAuto = false;
$resp->navInclude = true;
$resp->contentHeader = $mmServerStats->FontAwesome . STR_NBSP . $mmServerStats->NameModule;

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

// Return Page
$aloe_response->content_set( require_once( PATH_PAGE_RESP ) );
?>