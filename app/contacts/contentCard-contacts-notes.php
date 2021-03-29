<?php
// Card
$cardHeaderContent = \xan\iconFA( 'fas fa-file-alt' ) . STR_NBSP . 'Notes';
$card = new \xan\eleCard( CARD_WIDTH, '', false );

// Tags Special
$tagsEleInput_Notes = new \xan\tags( [ 'col', ], [ 'height' => ELE_HEIGHT_MAX ], [] );

// Table
$table = new \xan\eleTable( $tagsCellEmpty );

// Table Rows
$table->cellSet( 0, 0, $tagsCellLeftMiddle, $mmContactsT->getColEleRender( 'Notes', ELE_AS_DEFINED, $tagsEleInput_Notes, $recsDetail, $formTagDetail, $resp ) );

// Card Append
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $table->render() );
?>