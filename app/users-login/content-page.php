<?php
// Response
$resp = new \xan\response;
$resp->reqPath = $aloe_request->path_get();
$resp->reqID = $aloe_request->path_components_get()[ 1 ];
$resp->moduleName = $mmUsersLogin->NameModule;
$resp->headTitle = $mmUsersLogin->NameModule;
$resp->headLogoutAuto = false;
$resp->navInclude = false;
$resp->contentHeader = $mmUsersLogin->FontAwesome . STR_NBSP . $mmUsersLogin->NameModule;

///////////////////////////////////////////////////////////
// Content Load Now
require_once( 'content-cards.php' );
$resp->scriptsOnLoadA[] = <<< JS
        xanDo( { "Do": "Init", "Msg": "Init Elements", "URL": "{$mmUsersLogin->URLDoRelative}" } );
JS;

// Return Page
$aloe_response->content_set( require_once( PATH_PAGE_RESP ) );
?>