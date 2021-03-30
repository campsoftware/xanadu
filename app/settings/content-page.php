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
$resp->moduleName = $mmSettingsT->NameModule;
$resp->headTitle = $mmSettingsT->NameModule;
$resp->headLogoutAuto = true;
$resp->navInclude = true;
$resp->contentHeader = $mmSettingsT->FontAwesome . STR_NBSP . $mmSettingsT->NameModule;

///////////////////////////////////////////////////////////
// Content Load Now or Later. Now is faster due to less 'round trips'. Later uses Ajax which is fast, but an extra 'round trip'.
if ( CONTENT_LOAD_NOW ) {
	require_once( 'content-cards.php' );
	$resp->scriptsOnLoadA[] = <<< JS
        xanDo( { "Do": "Init", "Msg": "Init Elements", "URL": "{$mmSettingsT->URLDoRelative}" } );
JS;

} else {
	$resp->scriptsOnLoadA[] = <<< JS
        xanDo( { "Do": "ContentLoadAll", "Msg": "Load Content and Init Elements", "URL": "{$mmSettingsT->URLDoRelative}", "IDSettings": "{$resp->reqID}" } );
JS;
}

// Return Page
$aloe_response->content_set( require_once( PATH_PAGE_RESP ) );
?>