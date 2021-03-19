<?php
// Priv Redirect
if ( $_SESSION[ SESS_USER ][ 'PrivAdmin' ] !== 'Yes' ) {
	$aloe_response->status_set( '307 Temporary Redirect' );
	$aloe_response->header_set( 'Location', '/home/' );
	$aloe_response->content_set( '' );
}

// Response
$resp = new \xan\response;
$resp->reqPath = $aloe_request->path_get();
$resp->reqID = $aloe_request->path_components_get()[ 1 ];
$resp->moduleName = $mmUsersT->NameModule;
$resp->headTitle = $mmUsersT->NameModule;
$resp->headLogoutAuto = true;
$resp->navInclude = true;
$resp->contentHeader = $mmUsersT->FontAwesome . STR_NBSP . $mmUsersT->NameModule;

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
	// Users Password Update - Modal
	$xanDoDo = 'UsersPasswordReplace';
	$modal = new \xan\eleModal( $xanDoDo );
	
	// Table
	$tagsCellEmpty = new xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_MIDDLE ], [], [] );
	$tagsCellRightMiddle = new xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_RIGHT, TABLE_ALIGN_MIDDLE ], [], [] );
	$tagsCellLeftMiddle = new xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_MIDDLE ], [], [] );
	$table = new xan\eleTable( $tagsCellEmpty );
	$tableRowIndex = -1;
	
	$tableRowIndex++;
	$tagsEleLabel = new xan\tags( [ 'small' ], [], [] );
	$tagsEleInput = new xan\tags( [ 'col' ], [], [] );
	$testLabel = new \xan\eleLabel( 'New Password', 'passwordUpdateLabel', '', $tagsEleLabel );
	$testInput = new \xan\eleTextReveal( '', 'passwordUpdateInput', '', $tagsEleInput );
	$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $testLabel->render() );
	$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $testInput->render() );
	// Modal Init
	$modalInitJS = <<< JS
        // On Modal Shown, put cursor in Search Term
        $( "#{$xanDoDo}_Modal" ).on( "shown.bs.modal", function () {
            $( "#passwordUpdateInput" ).trigger( "select" );
        } );
JS;
	// OnClick
	$modalButtonActionOnClick = /** @lang JavaScript */
		"xanDo( { 'Do': '{$xanDoDo}', 'Msg': 'Password Replace', 'URL': '{$mmUsersT->URLDoRelative}', 'IDUsers': '{$resp->reqID}', 'PasswordNew': $( '#passwordUpdateInput' ).val() } ); $( '#passwordUpdateInput' ).val( '' )";
	$resp->contentEndA[] = $modal->renderModalWButtons( 'Replace the Password for this User?', '', $table->render(), '', 'Cancel', 'Replace Password', [ 'onclick="' . $modalButtonActionOnClick . '"' ], $modalInitJS );
	
	
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

// Return Page
$aloe_response->content_set( require_once( PATH_PAGE_RESP ) );
?>