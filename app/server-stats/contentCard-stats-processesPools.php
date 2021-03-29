<?php
// Card
$cardHeaderContent = \xan\iconFA( 'fas fa-hard-hat' ) . STR_NBSP . 'Process Pools';
$card = new \xan\eleCard( CARD_WIDTH_2X, CARD_HEIGHT_MAX, true );

// Tags Special

// Table
$table = new \xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Table Rows
$tableRowIndex++;
$poolProcesses = shell_exec( "ps -ef | grep 'php-fpm: pool' | grep -v 'grep'" );
$table->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, '<pre style="white-space: pre-wrap;">' . $poolProcesses . '</pre>', '1', '2' );

// Card Append
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $table->render() );
?>