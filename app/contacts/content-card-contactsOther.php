<?php
// Card
$cardHeaderContent = xan\iconFA( 'fas fa-trailer' ) . STR_NBSP . 'Other';
$card = new xan\eleCard( CARD_WIDTH, '', false );

// Tags Special

// Table
$table = new xan\eleTable( $tagsCellEmpty );

// Table Rows
$table->cellSet( 0, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'ContactedDate', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( 0, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'ContactedDate', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( 0, 2, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'ContactedDate', ELE_AS_SELECTOR, $tagsEleSelector, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( 1, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'TimeOpen', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( 1, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'TimeOpen', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( 1, 2, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'TimeOpen', ELE_AS_SELECTOR, $tagsEleSelector, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( 2, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'TimeClosed', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( 2, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'TimeClosed', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( 2, 2, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'TimeClosed', ELE_AS_SELECTOR, $tagsEleSelector, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( 3, 0, $tagsCellRightMiddle, STR_NBSP );

$table->cellSet( 4, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'FollowUpTS', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( 4, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'FollowUpTS', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( 4, 2, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'FollowUpTS', ELE_AS_SELECTOR, $tagsEleSelector, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( 5, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'FollowUpAction', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( 5, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'FollowUpAction', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( 6, 0, $tagsCellRightMiddle, STR_NBSP );

$table->cellSet( 7, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'NumberInteger', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( 7, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'NumberInteger', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( 8, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'NumberDecimal', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( 8, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'NumberDecimal', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( 9, 0, $tagsCellRightMiddle, $mmContactsT->getColEleRender( 'NumberCurrency', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( 9, 1, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'NumberCurrency', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

// Card Append to Source
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $table->render() );
?>