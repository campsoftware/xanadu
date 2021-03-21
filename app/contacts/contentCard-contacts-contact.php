<?php
// Card
$cardHeaderContent = $mmContactsT->FontAwesome . STR_NBSP . 'Contact';
$card = new xan\eleCard( CARD_WIDTH, '', false );

// Tags Special
$tagsEleInput_Photo = new xan\tags( [ 'col', 'img-thumbnail' ], [ 'height' => CARD_HEIGHT_QUARTER, 'width' => 'auto' ], [] );
$tagsEleInput_PhotoUploadButton = new xan\tags( [ 'col' ], [], [] );
$tagsEleInput_NameUpdate = new xan\tags( [ 'col', 'ContactsNameUpdate' ], [], [] );

// Table
$table = new xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Photo Upload JS
$jsA = [];
$jsA[] = /** @lang JavaScript */ '$( "#' . $mmContactsT->NameTable . 'List' . $recsDetail->rowsD[ $recsDetail->rowIndex ][ $mmContactsT->NameTableKey ] . 'Image" ).attr( "src", pURL ); // Set the List img URL';
$jsA[] = /** @lang JavaScript */ '$( "#xf_' . $recsDetail->rowsD[ $recsDetail->rowIndex ][ $mmContactsT->NameTableKey ] . '_PhotoFN" ).val( filename ).trigger( "change" ); // Set the Input and Trigger a Save';
$tagsEleInput_PhotoUploadButton->otherD[ 'fileUploadSuccess' ] = xan\arrayJSCodeToString( $jsA );
$tagsEleInput_PhotoUploadButton->otherD[ 'fileUploadProblem' ] = '';

// Photo Label and Upload Button
$PhotoFNCode = $mmContactsT->getColEleRender( 'PhotoFN', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp );
$PhotoFNCode .= $mmContactsT->getColEleRender( 'PhotoFN', ELE_AS_FILEUPLOADBUTTON, $tagsEleInput_PhotoUploadButton, $recsDetail, $formTagDetail, $resp );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightTop, $PhotoFNCode );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'PhotoFN', ELE_AS_DEFINED, $tagsEleInput_Photo, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'NameCompany', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'NameCompany', ELE_AS_DEFINED, $tagsEleInput_NameUpdate, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'NameTitle', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'NameTitle', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'NamePrefix', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'NamePrefix', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'NameFirst', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'NameFirst', ELE_AS_DEFINED, $tagsEleInput_NameUpdate, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'NameMiddle', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'NameMiddle', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'NameLast', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'NameLast', ELE_AS_DEFINED, $tagsEleInput_NameUpdate, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'NameSuffix', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'NameSuffix', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

// Card Append
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $table->render() );
?>