<?php
// Response
$resp = new \xan\response;
$resp->reqPath = \xan\paramEncode( $aloe_request->path_get() );
$resp->reqPathComponents = \xan\paramEncode( $aloe_request->path_components_get() );
$resp->reqPost = \xan\paramEncode( $aloe_request->post );
// $resp->reqID = $resp->reqPathComponents[ 1 ];
$resp->moduleName = $mmUsersRegister->NameModule;
$resp->headTitle = $mmUsersRegister->NamePlural;
$resp->headLogoutAuto = false;
$resp->navInclude = false;
$resp->contentHeader = $mmUsersRegister->FontIcon . STR_NBSP . $mmUsersRegister->NamePlural . STR_NBSP;

///////////////////////////////////////////////////////////
// Content Load Now
require_once( 'content-cards.php' );
$resp->scriptsOnLoadA[] = <<< JS
        xanDo( { "Do": "Init", "Msg": "Init Elements", "URL": "{$mmUsersRegister->URLDoRelative}" } );
JS;

// Return Page
$aloe_response->content_set( require_once( PATH_PAGE_RESP ) );
?>