<?php
// Response
$resp = new \xan\response;
$resp->reqPath = \xan\paramEncode( $aloe_request->path_get() );
$resp->reqPathComponents = \xan\paramEncode( $aloe_request->path_components_get() );
$resp->reqPost = \xan\paramEncode( $aloe_request->post );
$resp->reqID = $resp->reqPathComponents[ 1 ];
$resp->moduleName = $mmHome->NameModule;
$resp->headTitle = $mmHome->NamePlural;
$resp->headLogoutAuto = true;
$resp->navInclude = true;
$resp->contentHeader = $mmHome->FontIcon . STR_NBSP . $mmHome->NamePlural . STR_NBSP;

// User Save Path Last
$mmUsersT->setPathLast( $resp->reqPath );

///////////////////////////////////////////////////////////
// Content Load Now
require_once( 'content-cards.php' );

///////////////////////////////////////////////////////////
// Meta
$resp->headMetaPageURL = $mmHome->URLFull;
if ( \xan\isEmpty( $resp->reqID ) ) {
	// List
	$resp->headMetaTitle = $mmHome->NamePlural;
	$resp->headMetaDesc = '';
}else{
	// Detail
	$resp->headMetaTitle = $mmHome->NamePlural;
	$resp->headMetaDesc = '';
}
$resp->metaSet();

///////////////////////////////////////////////////////////
// Return Page
$aloe_response->content_set( require_once( PATH_PAGE_RESP ) );
?>