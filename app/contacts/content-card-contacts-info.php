<?php
// Card
$cardHeaderContent = xan\iconFA( 'fas fa-info-circle' ) . STR_NBSP . 'Info';
$card = new xan\eleCard( CARD_WIDTH, '', false );

// Tags Special

// Table
$table = new xan\eleTable( $tagsCellEmpty );

// Table Rows
$rowIndex = 0;

$table->cellSet( $rowIndex, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'Active', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $rowIndex, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'Active', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$rowIndex++;
$table->cellSet( $rowIndex, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'Status', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $rowIndex, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'Status', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$rowIndex++;
$table->cellSet( $rowIndex, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'Type', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $rowIndex, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'Type', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$rowIndex++;
$table->cellSet( $rowIndex, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'DaysToPay', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $rowIndex, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'DaysToPay', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$rowIndex++;
$table->cellSet( $rowIndex, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'State', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $rowIndex, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'State', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$rowIndex++;
$table->cellSet( $rowIndex, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'Source', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $rowIndex, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'Source', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

// Card Append to Source
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $table->render() );
?>