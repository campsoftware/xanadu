<?php
// Response
$resp = new \xan\response;
$resp->reqPath = \xan\paramEncode( $aloe_request->path_get() );
$resp->reqPathComponents = \xan\paramEncode( $aloe_request->path_components_get() );
$resp->reqPost = \xan\paramEncode( $aloe_request->post );
$resp->reqID = $resp->reqPathComponents[ 1 ];
$resp->moduleName = $mmContactsT->NameModule;
$resp->headTitle = $mmContactsT->NamePlural;
$resp->headLogoutAuto = true;
$resp->navInclude = true;
$resp->contentHeader = $mmContactsT->FontAwesome . STR_NBSP . $mmContactsT->NamePlural . STR_NBSP;

// User Save Path Last
$mmUsersT->setPathLast( $resp->reqPath );

///////////////////////////////////////////////////////////
// Content Load Now or Later. Now is faster due to less 'round trips'. Later uses Ajax which is fast, but an extra 'round trip'.
if ( CONTENT_LOAD_NOW ) {
	require_once( 'content-cards.php' );
	$resp->scriptsOnLoadA[] = <<< JS
        xanDo( { "Do": "Init", "Msg": "Init Elements", "URL": "{$mmContactsT->URLDoRelative}" } );
JS;

} else {
	$resp->scriptsOnLoadA[] = <<< JS
        xanDo( { "Do": "ContentLoadAll", "Msg": "Load Content and Init Elements", "URL": "{$mmContactsT->URLDoRelative}", "IDContacts": "{$resp->reqID}" } );
JS;
}

///////////////////////////////////////////////////////////
// Xan Do

// INCLUDE AWAYS

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Contacts Rec New - Modal
$xanDoDo = 'ContactsRecNew';
$modal = new \xan\eleModal( $xanDoDo );
//language=javascript
$modalButtonActionOnClick = "xanDo( { 'Do': '{$xanDoDo}', 'Msg': 'Contact Create', 'URL': '{$mmContactsT->URLDoRelative}' } );";
$resp->contentEndA[] = $modal->renderModalWButtons( 'Create a New Contact?', '', '', '', 'Cancel', 'Create', [ 'onclick="' . $modalButtonActionOnClick . '"' ], '' );

// INCLUDE WHEN REQUESTING A RECORD ID
if ( \xan\isNotEmpty( $resp->reqID ) ) {
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// Contacts Name Update
	$resp->scriptsDoInitA[] = <<< JS
        $( ".ContactsNameUpdate" ).off( "change", ContactsNameUpdate ).on( "change", ContactsNameUpdate );
JS;
	$resp->scriptsExtraA[] = <<< JS
        function ContactsNameUpdate( event ) {
            setTimeout( function ( ele ) {
                let eleUUID = $( ele ).attr( 'id' ).split( '_' )[ 1 ];
                xanDo( { "Do": "ContactsNameUpdate", "Msg": "Name Update", "URL": "{$mmContactsT->URLDoRelative}", "IDContacts": eleUUID } );
            }, 1000, $( this ) );
        }
JS;
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// Contacts Rec Duplicate - Modal
	$xanDoDo = 'ContactsRecDuplicate';
	$modal = new \xan\eleModal( $xanDoDo );
	$modalButtonActionOnClick = /** @lang JavaScript */
		"xanDo( { 'Do': '{$xanDoDo}', 'Msg': 'Contact Duplicate', 'URL': '{$mmContactsT->URLDoRelative}', 'IDContacts': '{$resp->reqID}' } );";
	$resp->contentEndA[] = $modal->renderModalWButtons( 'Duplicate this Contact?', '', '', '', 'Cancel', 'Duplicate', [ 'onclick="' . $modalButtonActionOnClick . '"' ], '' );
	
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// Contacts Rec Delete - Modal
	$xanDoDo = 'ContactsRecDelete';
	$modal = new \xan\eleModal( $xanDoDo );
	$modal->buttonActionDanger = true;
	$modalButtonActionOnClick = /** @lang JavaScript */
		"xanDo( { 'Do': '{$xanDoDo}', 'Msg': 'Contact Delete', 'URL': '{$mmContactsT->URLDoRelative}', 'IDContacts': '{$resp->reqID}' } );";
	$resp->contentEndA[] = $modal->renderModalWButtons( 'Delete this Contact?', '', '', '', 'Cancel', 'Delete', [ 'onclick="' . $modalButtonActionOnClick . '"' ], '' );
	
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// ContactsComms Rec New - Modal
	$xanDoDo = 'ContactsCommsRecNew';
	$modal = new \xan\eleModal( $xanDoDo );
	$modalButtonActionOnClick = /** @lang JavaScript */
		"xanDo( { 'Do': '{$xanDoDo}', 'Msg': 'Comm Create', 'URL': '{$mmContactsT->URLDoRelative}', 'IDContactsComms': '{$resp->reqID}' } );";
	$resp->contentEndA[] = $modal->renderModalWButtons( 'Create a Comm?', '', '', '', 'Cancel', 'Create', [ 'onclick="' . $modalButtonActionOnClick . '"' ], '' );
	
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// ContactsComms Rec Delete - Modal
	$xanDoDo = 'ContactsCommsRecDelete';
	$modal = new \xan\eleModal( $xanDoDo );
	$modal->buttonActionDanger = true;
	$modalButtonActionOnClick = /** @lang JavaScript */
		"xanDo( { 'Do': '{$xanDoDo}', 'Msg': 'Comm Delete', 'URL': '{$mmContactsT->URLDoRelative}', 'IDContacts': '{$resp->reqID}', 'IDContactsComms': window.ContactsCommsRecDelete_UUID } );";
	$resp->contentEndA[] = $modal->renderModalWButtons( 'Delete this Comm?', '', '', '', 'Cancel', 'Delete', [ 'onclick="' . $modalButtonActionOnClick . '"' ], '' );
	
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// Contacts Picker - Modal
	$xanDoDo = 'ContactsPicker';
	$modal = new \xan\eleModal( $xanDoDo );
	$modal->buttonActionAutoDismiss = false;
	
	// Header Search
	$searchBarOnSearch = /** @lang JavaScript */
		"theSearchTerm = $( '#{$xanDoDo}_SearchTerm' ).val(); xanDo( { 'Do': '{$xanDoDo}', 'Msg': 'Contact Search', 'URL': '{$mmContactsT->URLDoRelative}', 'IDContacts': '{$resp->reqID}',  'SearchTerm': theSearchTerm } );";
	
	// Header Search Bar
	$searchBar = new \xan\eleSearchBarSimpleDB( $xanDoDo, '', $searchBarOnSearch );
	
	// Body
	$modelResults = '<div id="' . $xanDoDo . '_ListItems" class="mt-1"></div>';
	
	// Script
	$modalInitJS = <<< JS
        // On Modal Shown, put cursor in Search Term
        $( "#{$xanDoDo}_Modal" ).on( "shown.bs.modal", function () {
            $( "#{$xanDoDo}_SearchTerm" ).trigger( "select" );
        } );
JS;
	// Modal
	$resp->contentEndA[] = $modal->renderModalWButtons( $mmContactsT->FontAwesome . ' Select a Contact', $searchBar->render(), $modelResults, '', 'Cancel', '', [], $modalInitJS );
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
}

// Return Page
$aloe_response->content_set( require_once( PATH_PAGE_RESP ) );
?>