<?php
// Response
$resp = new \xan\response;
$resp->reqPath = \xan\paramEncode( $aloe_request->path_get() );
$resp->reqPathComponents = \xan\paramEncode( $aloe_request->path_components_get() );
$resp->reqPost = \xan\paramEncode( $aloe_request->post );
// $resp->reqID = $resp->reqPathComponents[ 1 ];
$resp->moduleName = $mmServer404->NameModule;
$resp->headTitle = $mmServer404->NamePlural;
$resp->headLogoutAuto = true;
$resp->navInclude = false;
$resp->contentHeader = $mmServer404->FontAwesome . STR_NBSP . $mmServer404->NamePlural . STR_NBSP;

// Return Page
$aloe_response->content_set( require_once( PATH_PAGE_RESP ) );
?>