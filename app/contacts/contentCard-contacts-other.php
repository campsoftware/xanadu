<?php
// Card
$cardHeaderContent = \xan\fontIcon( 'fas fa-trailer' ) . STR_NBSP . 'Other';
$card = new \xan\eleCard( CARD_WIDTH, '', false );

// Tags Special

// Table
$table = new \xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Table Rows
$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'ContactedDate', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'ContactedDate', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 2, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'ContactedDate', ELE_AS_SELECTOR, $tagsEleSelector, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'TimeOpen', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'TimeOpen', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 2, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'TimeOpen', ELE_AS_SELECTOR, $tagsEleSelector, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'TimeClosed', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'TimeClosed', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 2, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'TimeClosed', ELE_AS_SELECTOR, $tagsEleSelector, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, STR_NBSP );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'FollowUpTS', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'FollowUpTS', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 2, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'FollowUpTS', ELE_AS_SELECTOR, $tagsEleSelector, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'FollowUpAction', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'FollowUpAction', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, STR_NBSP );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'NumberInteger', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'NumberInteger', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'NumberDecimal', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'NumberDecimal', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'NumberCurrency', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'NumberCurrency', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

// Card Append
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $table->render() );
?>