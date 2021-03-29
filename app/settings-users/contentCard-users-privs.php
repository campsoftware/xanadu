<?php
// Card
$cardHeaderContent = \xan\iconFA( FA_PASSWORD ) . STR_NBSP . 'Privs';
$card = new \xan\eleCard( CARD_WIDTH, '', false );

// Tags Special
$tagsEleInput_PathLast = new \xan\tags( [ 'col', ], [ 'height' => ELE_HEIGHT_4X ], [] );

// Table
$table = new \xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Table Rows
$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'Registered', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'Registered', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'RegisterTS', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'RegisterTS', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 2, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'RegisterTS', ELE_AS_SELECTOR, $tagsEleSelector, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'Active', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'Active', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'PrivAdmin', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'PrivAdmin', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'PrivMember', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'PrivMember', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'PathLast', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'PathLast', ELE_AS_DEFINED, $tagsEleInput_PathLast, $recsDetail, $formTagDetail, $resp ) );

// Card Append
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $table->render() );
?>