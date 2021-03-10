<?php
// User Save Path Last
$mmUsersT->setPathLast( $aloe_request->path_get() );

// Response
$resp = new xan\response;
$resp->reqPath = $aloe_request->path_get();
$resp->reqID = $aloe_request->path_components_get()[ 1 ];
$resp->moduleName = $mmHome->NameModule;
$resp->headTitle = $mmHome->NameModule;
$resp->headLogoutAuto = true;
$resp->navInclude = true;
$resp->contentHeader = $mmHome->FontAwesome . STR_NBSP . $mmHome->NameModule . STR_NBSP;

///////////////////////////////////////////////////////////
// Content Load Now
require_once( 'content-1-cards.php' );

// Return Page
$aloe_response->content_set( require_once( PATH_PAGE_RESP ) );
?>