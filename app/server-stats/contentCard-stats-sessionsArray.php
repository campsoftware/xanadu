<?php
// Card
$cardHeaderContent = xan\iconFA( 'fas fa-handshake' ) . STR_NBSP . 'Sessions Array';
$card = new xan\eleCard( CARD_WIDTH_2X, CARD_HEIGHT_MAX, true );

// Tags Special

// Table
$table = new xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Table Rows
$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, '<pre style="white-space: pre-wrap;">' . $sessionAsText . '</pre>', '1', '2' );

// Card Append
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $table->render() );
?>