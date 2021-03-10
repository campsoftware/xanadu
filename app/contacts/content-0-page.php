<?php
// User Save Path Last
$mmUsersT->setPathLast( $aloe_request->path_get() );

// Response
$resp = new xan\response;
$resp->reqPath = $aloe_request->path_get();
$resp->reqID = $aloe_request->path_components_get()[ 1 ];
$resp->moduleName = $mmContactsT->NameModule;
$resp->headTitle = $mmContactsT->NameModule;
$resp->headLogoutAuto = true;
$resp->navInclude = true;
$resp->contentHeader = $mmContactsT->FontAwesome . STR_NBSP . $mmContactsT->NameModule;

///////////////////////////////////////////////////////////
// Content Load Now or Later. Now is faster due to less 'round trips'. Later uses Ajax which is fast, but an extra 'round trip'.
if ( CONTENT_LOAD_NOW ) {
	require_once( 'content-1-cards.php' );
	$resp->scriptsOnLoadA[] = <<< JS
        xanDo( { "Msg": "Initializing Elements", "URL": "{$mmContactsT->URLDoRelative}", "Do": "Init" } );
JS;

} else {
	$resp->scriptsOnLoadA[] = <<< JS
        xanDo( { "Msg": "Loading Content and Initializing Elements", "URL": "{$mmContactsT->URLDoRelative}", "Do": "ContentLoadAll", "IDContacts": "{$resp->reqID}" } );
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
$modalButtonActionOnClick = "xanDo( { 'Msg': 'Creating Contact', 'URL': '{$mmContactsT->URLDoRelative}', 'Do': '{$xanDoDo}' } );";
$resp->contentEndA[] = $modal->renderModalWButtons( 'Create a New Contact?', '', '', '', 'Cancel', 'Create', [ 'onclick="' . $modalButtonActionOnClick . '"' ], '' );

// INCLUDE WHEN REQUESTING A RECORD ID
if ( xan\isNotEmpty( $resp->reqID ) ) {
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// Contacts Name Update
	$resp->scriptsDoInitA[] = <<< JS
        $( ".ContactsNameUpdate" ).off( "change", ContactsNameUpdate ).on( "change", ContactsNameUpdate );
JS;
	$resp->scriptsExtraA[] = <<< JS
        function ContactsNameUpdate( event ) {
            setTimeout( function ( ele ) {
                let eleUUID = $( ele ).attr( 'id' ).split( '_' )[ 1 ];
                xanDo( { "Msg": "Updated Name", "URL": "{$mmContactsT->URLDoRelative}", "Do": "ContactsNameUpdate", "IDContacts": eleUUID } );
            }, 1000, $( this ) );
        }
JS;
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// Contacts Rec Duplicate - Modal
	$xanDoDo = 'ContactsRecDuplicate';
	$modal = new \xan\eleModal( $xanDoDo );
	$modalButtonActionOnClick = /** @lang JavaScript */
		"xanDo( { 'Msg': 'Duplicating Contact', 'URL': '{$mmContactsT->URLDoRelative}', 'Do': '{$xanDoDo}', 'IDContacts': '{$resp->reqID}' } );";
	$resp->contentEndA[] = $modal->renderModalWButtons( 'Duplicate this Contact?', '', '', '', 'Cancel', 'Duplicate', [ 'onclick="' . $modalButtonActionOnClick . '"' ], '' );
	
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// Contacts Rec Delete - Modal
	$xanDoDo = 'ContactsRecDelete';
	$modal = new \xan\eleModal( $xanDoDo );
	$modal->buttonDanger = true;
	$modalButtonActionOnClick = /** @lang JavaScript */
		"xanDo( { 'Msg': 'Deleting Contact', 'URL': '{$mmContactsT->URLDoRelative}', 'Do': '{$xanDoDo}', 'IDContacts': '{$resp->reqID}' } );";
	$resp->contentEndA[] = $modal->renderModalWButtons( 'Delete this Contact?', '', '', '', 'Cancel', 'Delete', [ 'onclick="' . $modalButtonActionOnClick . '"' ], '' );
	
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// ContactsComms Rec New - Modal
	$xanDoDo = 'ContactsCommsRecNew';
	$modal = new \xan\eleModal( $xanDoDo );
	$modalButtonActionOnClick = /** @lang JavaScript */
		"xanDo( { 'Msg': 'Creating Comm', 'URL': '{$mmContactsT->URLDoRelative}', 'Do': '{$xanDoDo}', 'IDContactsComms': '{$resp->reqID}' } );";
	$resp->contentEndA[] = $modal->renderModalWButtons( 'Create a Comm?', '', '', '', 'Cancel', 'Create', [ 'onclick="' . $modalButtonActionOnClick . '"' ], '' );
	
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// ContactsComms Rec Delete - Modal
	$xanDoDo = 'ContactsCommsRecDelete';
	$modal = new \xan\eleModal( $xanDoDo );
	$modal->buttonDanger = true;
	$modalButtonActionOnClick = /** @lang JavaScript */
		"xanDo( { 'Msg': 'Deleting Comm', 'URL': '{$mmContactsT->URLDoRelative}', 'Do': '{$xanDoDo}', 'IDContacts': '{$resp->reqID}', 'IDContactsComms': window.ContactsCommsRecDelete_UUID } );";
	$resp->contentEndA[] = $modal->renderModalWButtons( 'Delete this Comm?', '', '', '', 'Cancel', 'Delete', [ 'onclick="' . $modalButtonActionOnClick . '"' ], '' );
	
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
	// Contacts Picker - Modal
	$xanDoDo = 'ContactsPicker';
	$modal = new \xan\eleModal( $xanDoDo );
	// Header Search
	$searchBarOnSearch = /** @lang JavaScript */
		"theSearchTerm = $( '#{$xanDoDo}_SearchTerm' ).val(); xanDo( { 'Msg': 'Searching Contacts', 'URL': '{$mmContactsT->URLDoRelative}', 'Do': '{$xanDoDo}', 'IDContacts': '{$resp->reqID}',  'SearchTerm': theSearchTerm } );";
	// Header Cancel
	$searchBar = new \xan\eleSearchBarSimpleDB( $xanDoDo, '', $searchBarOnSearch );
	$modalButtonCancelTags = new \xan\tags( [ ELE_CLASS_BUTTON_RG_SECONDARY, 'float-right' ], [], [] );
	$modalButtonCancel = $modal->renderButton( 'Cancel', true, $modalButtonCancelTags );
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
	$modalCode = $modal->renderModal( $mmContactsT->FontAwesome . ' Select a Contact', $searchBar->render() . $modalButtonCancel, $modelResults, '', $modalInitJS );
	$resp->contentEndA[] = $modalCode;
	
	
	// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
}

// Return Page
$aloe_response->content_set( require_once( PATH_PAGE_RESP ) );
?>