<?php
// Response
$resp = new \xan\response;
$resp->reqPath = \xan\paramEncode( $aloe_request->path_get() );
$resp->reqPathComponents = \xan\paramEncode( $aloe_request->path_components_get() );
$resp->reqPost = \xan\paramEncode( $aloe_request->post );
$resp->reqID = $resp->reqPathComponents[ 1 ];
$resp->moduleName = $mmUsersLogin->NameModule;
$resp->headTitle = $mmUsersLogin->NamePlural;
$resp->headLogoutAuto = false;
$resp->navInclude = false;
$resp->contentHeader = $mmUsersLogin->FontAwesome . STR_NBSP . $mmUsersLogin->NamePlural . STR_NBSP;

///////////////////////////////////////////////////////////
// Content Load Now
require_once( 'content-cards.php' );
$resp->scriptsOnLoadA[] = <<< JS
        xanDo( { "Do": "Init", "Msg": "Init Elements", "URL": "{$mmUsersLogin->URLDoRelative}" } );
JS;

// Return Page
$aloe_response->content_set( require_once( PATH_PAGE_RESP ) );
?>