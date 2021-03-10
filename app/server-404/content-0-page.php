<?php
// Response
$resp = new xan\response;
$resp->reqPath = $aloe_request->path_get();
$resp->reqID = $aloe_request->path_components_get()[ 1 ];
$resp->moduleName = $mmServer404->NameModule;
$resp->headTitle = $mmServer404->NameModule;
$resp->headLogoutAuto = true;
$resp->navInclude = false;
$resp->contentHeader = $mmServer404->FontAwesome . STR_NBSP . $mmServer404->NameModule;

// Return Page
$aloe_response->content_set( require_once( PATH_PAGE_RESP ) );
?>