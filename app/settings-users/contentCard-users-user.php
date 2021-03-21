<?php
// Card
$cardHeaderContent = $mmUsersT->FontAwesome . STR_NBSP . 'User';
$card = new xan\eleCard( CARD_WIDTH, '', false );

// Tags Special
$tagsEleInput_NameUpdate = new xan\tags( [ 'col', 'UsersNameUpdate' ], [], [] );

// Table
$table = new xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Table Rows
$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle,$mmUsersT->getColEleRender( 'NameCompany', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'NameCompany', ELE_AS_DEFINED, $tagsEleInput_NameUpdate, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'NameFirst', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'NameFirst', ELE_AS_DEFINED, $tagsEleInput_NameUpdate, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'NameLast', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'NameLast', ELE_AS_DEFINED, $tagsEleInput_NameUpdate, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'NameFull', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'NameFull', ELE_AS_DEFINED, $tagsEleInput_NameUpdate, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'EmailAddress', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'EmailAddress', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'PhoneWork', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'PhoneWork', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'PhoneMobile', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'PhoneMobile', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle,$mmUsersT->getColEleRender( 'PhoneTwoFactor', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'PhoneTwoFactor', ELE_AS_DEFINED, $tagsEleInput_NameUpdate, $recsDetail, $formTagDetail, $resp ) );


// Card Append
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $table->render() );
?>