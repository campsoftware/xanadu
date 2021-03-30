<?php
// Response
$resp = new \xan\response;
$resp->reqPath = \xan\paramEncode( $aloe_request->path_get() );
$resp->reqPathComponents = \xan\paramEncode( $aloe_request->path_components_get() );
$resp->reqPost = \xan\paramEncode( $aloe_request->post );
$resp->reqID = $resp->reqPathComponents[ 1 ];
$resp->moduleName = $mmHome->NameModule;
$resp->headTitle = $mmHome->NameModule;
$resp->headLogoutAuto = true;
$resp->navInclude = true;
$resp->contentHeader = $mmHome->FontAwesome . STR_NBSP . $mmHome->NameModule . STR_NBSP;

// User Save Path Last
$mmUsersT->setPathLast( $resp->reqPath );

///////////////////////////////////////////////////////////
// Content Load Now
require_once( 'content-cards.php' );

// Return Page
$aloe_response->content_set( require_once( PATH_PAGE_RESP ) );
?>