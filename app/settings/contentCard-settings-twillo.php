<?php
// Card
$cardHeaderContent = \xan\fontIcon( 'fas fa-sms' ) . STR_NBSP . 'Twillo';
$card = new \xan\eleCard( CARD_WIDTH, '', false );

// Tags Special

// Table
$table = new \xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Table Rows
$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $mmSettingsT->getColEleRender( 'TwilloPhoneNumber', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmSettingsT->getColEleRender( 'TwilloPhoneNumber', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $mmSettingsT->getColEleRender( 'TwilloAPIKey', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmSettingsT->getColEleRender( 'TwilloAPIKey', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $mmSettingsT->getColEleRender( 'TwilloAPISecret', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmSettingsT->getColEleRender( 'TwilloAPISecret', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

// Card Append
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $table->render() );
?>