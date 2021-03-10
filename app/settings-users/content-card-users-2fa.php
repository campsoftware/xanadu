<?php
// Card
$cardHeaderContent = xan\iconFA( 'fas fa-shield-check' ) . STR_NBSP . '2FA';
$card = new xan\eleCard( CARD_WIDTH, '', false );

// Tags Special
$tagsEleInput_NameUpdate = new xan\tags( [ 'col', 'UsersNameUpdate' ], [], [] );

// Table
$table = new xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Table Rows
$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle,$mmUsersT->getColEleRender( 'TwoFactorPhoneNumber', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'TwoFactorPhoneNumber', ELE_AS_DEFINED, $tagsEleInput_NameUpdate, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'TwoFactorEmailAddress', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'TwoFactorEmailAddress', ELE_AS_DEFINED, $tagsEleInput_NameUpdate, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'TwoFactorCodeString', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'TwoFactorCodeString', ELE_AS_DEFINED, $tagsEleInput_NameUpdate, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'TwoFactorCodeExpiresTS', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'TwoFactorCodeExpiresTS', ELE_AS_DEFINED, $tagsEleInput_NameUpdate, $recsDetail, $formTagDetail, $resp ) );

// Card Append to Source
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $table->render() );
?>