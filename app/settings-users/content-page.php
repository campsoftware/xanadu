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
$resp->reqID = $resp->reqPathComponents[ 1 ];
$resp->moduleName = $mmUsersT->NameModule;
$resp->headTitle = $mmUsersT->NamePlural;
$resp->headLogoutAuto = true;
$resp->navInclude = true;
$resp->contentHeader = $mmUsersT->FontAwesome . STR_NBSP . $mmUsersT->NamePlural . STR_NBSP;

///////////////////////////////////////////////////////////
// Content Load Now or Later. Now is faster due to less 'round trips'. Later uses Ajax which is fast, but an extra 'round trip'.
if ( CONTENT_LOAD_NOW ) {
	require_once( 'content-cards.php' );
	$resp->scriptsOnLoadA[] = <<< JS
        xanDo( { "Do": "Init", "Msg": "Init Elements", "URL": "{$mmUsersT->URLDoRelative}" } );
JS;

} else {
	$resp->scriptsOnLoadA[] = <<< JS
        xanDo( { "Do": "ContentLoadAll", "Msg": "Load Content and Init Elements", "URL": "{$mmUsersT->URLDoRelative}", "IDUsers": "{$resp->reqID}" } );
JS;
}

///////////////////////////////////////////////////////////
// Xan Do

// INCLUDE AWAYS

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Users Rec New - Modal
$xanDoDo = 'UsersRecNew';
$modal = new \xan\eleModal( $xanDoDo );
//language=javascript
$modalButtonActionOnClick = "xanDo( { 'Do': '{$xanDoDo}', 'Msg': 'User Create', 'URL': '{$mmUsersT->URLDoRelative}' } );";
$resp->contentEndA[] = $modal->renderModalWButtons( 'Create a User?', '', '', '', 'Cancel', 'Create', [ 'onclick="' . $modalButtonActionOnClick . '"' ], '' );

// INCLUDE WHEN REQUESTING A RECORD ID
if ( \xan\isNotEmpty( $resp->reqID ) ) {
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// Users Name Update
	$resp->scriptsDoInitA[] = <<< JS
        $( ".UsersNameUpdate" ).off( "change", UsersNameUpdate ).on( "change", UsersNameUpdate );
JS;
	$resp->scriptsExtraA[] = <<< JS
        function UsersNameUpdate( event ) {
            setTimeout( function ( ele ) {
                let eleUUID = $( ele ).attr( 'id' ).split( '_' )[ 1 ];
                xanDo( { "Do": "UsersNameUpdate", "Msg": "Name Update", "URL": "{$mmUsersT->URLDoRelative}", "IDUsers": eleUUID } );
            }, 1000, $( this ) );
        }
JS;
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// Users Password Replace - Modal
	require_once( 'contentModal-users-passwordReplace.php' );
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// Users Rec Duplicate - Modal
	$xanDoDo = 'UsersRecDuplicate';
	$modal = new \xan\eleModal( $xanDoDo );
	$modalButtonActionOnClick = /** @lang JavaScript */
		"xanDo( { 'Do': '{$xanDoDo}', 'Msg': 'User Duplicate', 'URL': '{$mmUsersT->URLDoRelative}', 'IDUsers': '{$resp->reqID}' } );";
	$resp->contentEndA[] = $modal->renderModalWButtons( 'Duplicate this User?', '', '', '', 'Cancel', 'Duplicate', [ 'onclick="' . $modalButtonActionOnClick . '"' ], '' );

	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// Users Rec Delete - Modal
	$xanDoDo = 'UsersRecDelete';
	$modal = new \xan\eleModal( $xanDoDo );
	$modal->buttonActionDanger = true;
	$modalButtonActionOnClick = /** @lang JavaScript */
		"xanDo( { 'Do': '{$xanDoDo}', 'Msg': 'User Delete', 'URL': '{$mmUsersT->URLDoRelative}', 'IDUsers': '{$resp->reqID}' } );";
	$resp->contentEndA[] = $modal->renderModalWButtons( 'Delete this User?', '', '', '', 'Cancel', 'Delete', [ 'onclick="' . $modalButtonActionOnClick . '"' ], '' );
	
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
}

///////////////////////////////////////////////////////////
// Meta
$resp->headMetaPageURL = $mmUsersT->URLFull;
if ( \xan\isEmpty( $resp->reqID ) ) {
	// List
	$resp->headMetaTitle = $mmUsersT->NamePlural;
	$resp->headMetaDesc = '';
}else{
	// Detail
	$resp->headMetaTitle = $mmUsersT->NamePlural;
	$resp->headMetaDesc = '';
}
$resp->metaSet();

///////////////////////////////////////////////////////////
// Return Page
$aloe_response->content_set( require_once( PATH_PAGE_RESP ) );
?>