<?php
// Priv Redirect
if ( $_SESSION[ SESS_USER ][ 'PrivAdmin' ] !== 'Yes' ) {
	$aloe_response->status_set( '307 Temporary Redirect' );
	$aloe_response->header_set( 'Location', '/home/' );
	$aloe_response->content_set( '' );
}

// Response
$resp = new xan\response;
$resp->reqPath = $aloe_request->path_get();
$resp->reqID = $aloe_request->path_components_get()[ 1 ];
$resp->moduleName = $mmSettingsT->NameModule;
$resp->headTitle = $mmSettingsT->NameModule;
$resp->headLogoutAuto = true;
$resp->navInclude = true;
$resp->contentHeader = $mmSettingsT->FontAwesome . STR_NBSP . $mmSettingsT->NameModule;

///////////////////////////////////////////////////////////
// Content Load Now or Later. Now is faster due to less 'round trips'. Later uses Ajax which is fast, but an extra 'round trip'.
if ( CONTENT_LOAD_NOW ) {
	require_once( 'content-1-cards.php' );
	$resp->scriptsOnLoadA[] = <<< JS
        xanDo( { "Msg": "Initializing Elements", "URL": "{$mmSettingsT->URLDoRelative}", "Do": "Init" } );
JS;

} else {
	$resp->scriptsOnLoadA[] = <<< JS
        xanDo( { "Msg": "Loading Content and Initializing Elements", "URL": "{$mmSettingsT->URLDoRelative}", "Do": "ContentLoadAll", "IDSettings": "{$resp->reqID}" } );
JS;
}

// Return Page
$aloe_response->content_set( require_once( PATH_PAGE_RESP ) );
?>