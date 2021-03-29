<?php
// Card
$cardHeaderContent = \xan\iconFA( 'fas fa-mouse' ) . STR_NBSP . 'App';
$card = new \xan\eleCard( CARD_WIDTH, '', false );

// Tags Special

// Table
$table = new \xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Table Rows
$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmSettingsT->getColEleRender( 'AppName', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmSettingsT->getColEleRender( 'AppName', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmSettingsT->getColEleRender( 'AppIconURL50', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmSettingsT->getColEleRender( 'AppIconURL50', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmSettingsT->getColEleRender( 'AppIconURL1024', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmSettingsT->getColEleRender( 'AppIconURL1024', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmSettingsT->getColEleRender( 'AppIconURLLink', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmSettingsT->getColEleRender( 'AppIconURLLink', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmSettingsT->getColEleRender( 'AppEmailFrom', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmSettingsT->getColEleRender( 'AppEmailFrom', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmSettingsT->getColEleRender( 'LogoutAutoSeconds', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmSettingsT->getColEleRender( 'LogoutAutoSeconds', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );


// Card Append
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $table->render() );
?>