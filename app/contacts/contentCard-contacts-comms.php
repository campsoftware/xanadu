<?php
// Query
$recsComms = new \xan\recs( $mmContactsCommsT );
$recsComms->querySQL = 'SELECT * FROM ' . $mmContactsCommsT->NameTable . ' WHERE ' . $mmContactsT->NameTableKey . ' = ?';
$recsComms->queryBindNamesA = array( $mmContactsCommsT->NameTableKey );
$recsComms->queryBindValuesA = array( $resp->reqID );
$recsComms->query();
$recsComms->rowsMassageForGUI( false );

// Card
$card = new \xan\eleCard( CARD_WIDTH, CARD_HEIGHT_MAX, true );

// Content Init
$cardHeaderContent = $mmContactsCommsT->FontAwesome . STR_NBSP . $mmContactsCommsT->NamePlural;
$cardBodyContent = '';

// XanDo
$xanDoNew = 'ContactsCommsRecNew';
$xanDoDelete = 'ContactsCommsRecDelete';

// Tags Special
$tagsCommon = 'p-0 mr-1';
$tagsNull = new \xan\tags();

// Grid
$grid = new \xan\eleGrid();

// Error Check
if ( $recsComms->errorB ) {
    $resp->contentHeader .= 'Error: ' . $recsComms->messageExtra . '; ' . $recsComms->messageSQL;
} elseif ( $recsComms->rowCount < 1 ) {
    $cardHeaderContent .= ': None Found';
} else {
    $cardHeaderContent .= ': ' . $recsComms->rowCount;

    // Recs Loop
    $recsComms->rowIndex = -1;
    foreach ( $recsComms->rowsD as $recsCommsRow ) {
		$recsComms->rowIndex++;
        
        // Form Create
        $formTagContactsComms = new \xan\formTag( $recsComms );
        $resp->contentEndA[] = $formTagContactsComms->render();

        // Row Gap with Labels
        $gridRow = new \xan\eleGridRow();
        // Type
        $tagsType = new \xan\tags( [ 'col', $tagsCommon ], [ 'height' => PORTAL_REC_GAP_BEGIN_HEIGHT ], [] );
        $labelEle = new \xan\eleLabel( $mmContactsCommsT->getColLabel( 'Type' ), '', '', $tagsType );
        $labelsRendered = $labelEle->render( true );
        // Label
        $tagsLabel = new \xan\tags( [ 'col', $tagsCommon ], [ 'height' => PORTAL_REC_GAP_BEGIN_HEIGHT ], [] );
        $labelEle = new \xan\eleLabel( $mmContactsCommsT->getColLabel( 'Label' ), '', '', $tagsLabel );
        $labelsRendered .= $labelEle->render( true );
        // Main
        $tagsMain = new \xan\tags( [ $tagsCommon ], [ 'width' => '3.5rem', 'height' => PORTAL_REC_GAP_BEGIN_HEIGHT ], [] );
        $labelEle = new \xan\eleLabel( $mmContactsCommsT->getColLabel( 'Main' ), '', '', $tagsMain );
        $labelsRendered .= $labelEle->render( true );
        // Spacer for Button
        $tagsSpacer = new \xan\tags( [ $tagsCommon ], [ 'width' => PORTAL_BUTTON_WIDTH, 'height' => PORTAL_REC_GAP_BEGIN_HEIGHT ], [] );
        $labelEle = new \xan\eleLabel( $mmContactsCommsT->getColLabel( '' ), '', '', $tagsSpacer );
        $labelsRendered .= $labelEle->render( true );

        // Index
        $indexDisplay = $recsComms->rowIndex + 1;
        $labelEle5 = new \xan\eleLabel( $indexDisplay, '', '', $tagsNull );
        $labelsRendered .= $labelEle5->render( true, '0px', '2px' );
        $grid->content .= $gridRow->render( $labelsRendered );

        // Row 1: Type, Label, Main, Delete
        $gridRow = new \xan\eleGridRow();
        // Type
        $tagsEleType = new \xan\tags( [ 'col', $tagsCommon, 'contactsComms_Type' ], [ 'height' => PORTAL_ELE_HEIGHT ], [] );
        $gridRow->content .= $mmContactsCommsT->getColEleRender( 'Type', ELE_AS_DEFINED, $tagsEleType, $recsComms, $formTagContactsComms, $resp );
        // Label
        $tagsEleLabel = new \xan\tags( [ 'col', $tagsCommon ], [ 'height' => PORTAL_ELE_HEIGHT ], [] );
        $gridRow->content .= $mmContactsCommsT->getColEleRender( 'Label', ELE_AS_DEFINED, $tagsEleLabel, $recsComms, $formTagContactsComms, $resp );
        // Main
        $tagsEleMain = new \xan\tags( [ $tagsCommon ], [ 'width' => '3.5rem', 'height' => PORTAL_ELE_HEIGHT ], [] );
        $gridRow->content .= $mmContactsCommsT->getColEleRender( 'Main', ELE_AS_DEFINED, $tagsEleMain, $recsComms, $formTagContactsComms, $resp );
        // Button Delete
        $buttonDeleteTags = new \xan\tags( [ 'p-0 mr-1 ', ELE_CLASS_BUTTON_SM_DELETE ], [ 'width' => PORTAL_BUTTON_WIDTH, 'height' => PORTAL_ELE_HEIGHT ], [ 'onclick="window.' . $xanDoDelete . '_UUID = \'' . $recsCommsRow[ $mmContactsCommsT->NameTableKey ] . '\'; $(\'#' . $xanDoDelete . '_Modal\').modal(\'show\');"' ] );
        $buttonDeleteEle = new \xan\eleButton( FA_DELETE, '', '', $buttonDeleteTags );
        // End
        $gridRow->content .= $buttonDeleteEle->render();
        $grid->content .= $gridRow->render();

        // Row 2
        $gridRow = new \xan\eleGridRow();
        // Data
        $tagsEleData = new \xan\tags( [ 'col', $tagsCommon ], [ 'display' => ( $recsCommsRow[ 'Type' ] !== 'Address' ? 'block' : 'none' ), 'height' => PORTAL_ELE_HEIGHT ], [] );
        $gridRow->content .= $mmContactsCommsT->getColEleRender( 'Data', ELE_AS_DEFINED, $tagsEleData, $recsComms, $formTagContactsComms, $resp );
        // Email Button
        $buttonGoTags = new \xan\tags( [ 'p-0 mr-1 ', ELE_CLASS_BUTTON_SM_GO ], [ 'display' => ( $recsCommsRow[ 'Type' ] === 'Email' ? 'block' : 'none' ), 'width' => PORTAL_BUTTON_WIDTH, 'height' => PORTAL_ELE_HEIGHT ], [ "onclick=\"xanDo( { 'Do': 'ContactsCommsURLGet', 'Msg': 'Email Compose', 'URL': '" . $mmContactsT->URLDoRelative . "', 'IDContactsComms': '" . $recsCommsRow[ $mmContactsCommsT->NameTableKey ] . "' } );\"" ] );
        $buttonID = 'xf_' . $recsCommsRow[ $mmContactsCommsT->NameTableKey ] . '_Button_EmailLink';
        $buttonGoEle = new \xan\eleButton( \xan\iconFA( 'fas fa-at' ), $buttonID, '', $buttonGoTags );
        $gridRow->content .= $buttonGoEle->render();
        // Phone Button
        $buttonGoTags = new \xan\tags( [ 'p-0 mr-1 ', ELE_CLASS_BUTTON_SM_GO ], [ 'display' => ( $recsCommsRow[ 'Type' ] === 'Phone' ? 'block' : 'none' ), 'width' => PORTAL_BUTTON_WIDTH, 'height' => PORTAL_ELE_HEIGHT ], [ "onclick=\"xanDo( { 'Do': 'ContactsCommsURLGet', 'Msg': 'Phone Dial', 'URL': '" . $mmContactsT->URLDoRelative . "', 'IDContactsComms': '" . $recsCommsRow[ $mmContactsCommsT->NameTableKey ] . "' } );\"" ] );
        $buttonID = 'xf_' . $recsCommsRow[ $mmContactsCommsT->NameTableKey ] . '_Button_PhoneLink';
        $buttonGoEle = new \xan\eleButton( \xan\iconFA( 'fas fa-phone' ), $buttonID, '', $buttonGoTags );
        $gridRow->content .= $buttonGoEle->render();
        // Web Button
        $buttonGoTags = new \xan\tags( [ 'p-0 mr-1 ', ELE_CLASS_BUTTON_SM_GO ], [ 'display' => ( $recsCommsRow[ 'Type' ] === 'Web' ? 'block' : 'none' ), 'width' => PORTAL_BUTTON_WIDTH, 'height' => PORTAL_ELE_HEIGHT ], [ "onclick=\"xanDo( { 'Do': 'ContactsCommsURLGet', 'Msg': 'Webpage Load', 'URL': '" . $mmContactsT->URLDoRelative . "', 'IDContactsComms': '" . $recsCommsRow[ $mmContactsCommsT->NameTableKey ] . "', 'NewWindow': 1 } );\"" ] );
        $buttonID = 'xf_' . $recsCommsRow[ $mmContactsCommsT->NameTableKey ] . '_Button_WebLink';
        $buttonGoEle = new \xan\eleButton( \xan\iconFA( 'fas fa-spider-web' ), $buttonID, '', $buttonGoTags );
        $gridRow->content .= $buttonGoEle->render();
        // Street
        $tagsEleStreet = new \xan\tags( [ 'col', $tagsCommon ], [ 'display' => ( $recsCommsRow[ 'Type' ] === 'Address' ? 'block' : 'none' ), 'height' => PORTAL_ELE_HEIGHT ], [] );
        $gridRow->content .= $mmContactsCommsT->getColEleRender( 'AddressStreet', ELE_AS_DEFINED, $tagsEleStreet, $recsComms, $formTagContactsComms, $resp );
        // Address Button
        $buttonGoTags = new \xan\tags( [ 'p-0 mr-1 ', ELE_CLASS_BUTTON_SM_GO ], [ 'display' => ( $recsCommsRow[ 'Type' ] === 'Address' ? 'block' : 'none' ), 'width' => PORTAL_BUTTON_WIDTH, 'height' => PORTAL_ELE_HEIGHT ], [ "onclick=\"xanDo( { 'Do': 'ContactsCommsURLGet', 'Msg': 'Map Load', 'URL': '" . $mmContactsT->URLDoRelative . "', 'IDContactsComms': '" . $recsCommsRow[ $mmContactsCommsT->NameTableKey ] . "', 'NewWindow': 1 } );\"" ] );
        $buttonID = 'xf_' . $recsCommsRow[ $mmContactsCommsT->NameTableKey ] . '_Button_AddressLink';
        $buttonGoEle = new \xan\eleButton( \xan\iconFA( 'fas fa-map-marker-alt' ), $buttonID, '', $buttonGoTags );
        // Row 2 End
        $gridRow->content .= $buttonGoEle->render();
        $grid->content .= $gridRow->render();

        // Row 3
        $gridRow = new \xan\eleGridRow();
        // City
        $tagsEleCity = new \xan\tags( [ 'col-6', $tagsCommon ], [ 'display' => ( $recsCommsRow[ 'Type' ] === 'Address' ? 'block' : 'none' ), 'height' => PORTAL_ELE_HEIGHT ], [] );
        $gridRow->content .= $mmContactsCommsT->getColEleRender( 'AddressCity', ELE_AS_DEFINED, $tagsEleCity, $recsComms, $formTagContactsComms, $resp );
        // State
        $tagsEleState = new \xan\tags( [ 'col-2', $tagsCommon ], [ 'display' => ( $recsCommsRow[ 'Type' ] === 'Address' ? 'block' : 'none' ), 'height' => PORTAL_ELE_HEIGHT ], [] );
        $gridRow->content .= $mmContactsCommsT->getColEleRender( 'AddressState', ELE_AS_DEFINED, $tagsEleState, $recsComms, $formTagContactsComms, $resp );
        // Zip
        $tagsEleZip = new \xan\tags( [ 'col', $tagsCommon ], [ 'display' => ( $recsCommsRow[ 'Type' ] === 'Address' ? 'block' : 'none' ), 'height' => PORTAL_ELE_HEIGHT ], [] );
        $gridRow->content .= $mmContactsCommsT->getColEleRender( 'AddressZip', ELE_AS_DEFINED, $tagsEleZip, $recsComms, $formTagContactsComms, $resp );
        $grid->content .= $gridRow->render();

        // Gap
        $gridRow = new \xan\eleGridRow();
        $tagsRecEndGap = new \xan\tags( [ 'p-0' ], [ 'height' => PORTAL_REC_GAP_END_HEIGHT ], [] );
        $gapLabel = new \xan\eleLabel( '', '', '', $tagsRecEndGap );
        $gridRow->content .= $gapLabel->render();
        $grid->content .= $gridRow->render();

    }

    // Type OnChange
    ob_start();
    ?>
    <script>
        $( ".contactsComms_Type.xanDoSave" ).change( function () {
            let key = $( this ).attr( "data-key" );
            let type = $( this ).val();
            // alert( theKey + "/" + theType );
            // Buttons
            $( "#xf_" + key + "_Button_EmailLink" ).css( "display", ( type === "Email" ) ? "block" : "none" );
            $( "#xf_" + key + "_Button_PhoneLink" ).css( "display", ( type === "Phone" ) ? "block" : "none" );
            $( "#xf_" + key + "_Button_WebLink" ).css( "display", ( type === "Web" ) ? "block" : "none" );
            $( "#xf_" + key + "_Button_AddressLink" ).css( "display", ( type === "Address" ) ? "block" : "none" );
            // Fields
            $( "#xf_" + key + "_Data" ).css( "display", ( type === "Address" ) ? "none" : "block" );
            $( "#xf_" + key + "_AddressStreet" ).css( "display", ( type === "Address" ) ? "block" : "none" );
            $( "#xf_" + key + "_AddressCity" ).css( "display", ( type === "Address" ) ? "block" : "none" );
            $( "#xf_" + key + "_AddressState" ).css( "display", ( type === "Address" ) ? "block" : "none" );
            $( "#xf_" + key + "_AddressZip" ).css( "display", ( type === "Address" ) ? "block" : "none" );
        } );
    </script>
    <?php
    $resp->scriptsOnLoadA[] = \xan\strTagsRemoveScript( ob_get_clean() );
}

// Header Button New Record
$buttonNewTags = new \xan\tags( [ ELE_CLASS_BUTTON_SM_NEW ], [], [ 'onclick="$(\'#' . $xanDoNew . '_Modal\').modal(\'show\');"' ] );
$buttonNewEle = new \xan\eleButton( FA_NEW, '', '', $buttonNewTags );
$cardHeaderContent .= '<div class="float-right">' . $buttonNewEle->render() . '</div>';

// Body Grid
$cardBodyContent .= $grid->render();

// Card Append
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $cardBodyContent );

?>