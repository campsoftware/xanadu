<?php
// Card
$cardHeaderContent = \xan\iconFA( 'fas fa-hdd' ) . STR_NBSP . 'Disk and ' . \xan\iconFA( 'fas fa-microchip' ) . STR_NBSP . 'RAM';
$card = new \xan\eleCard( CARD_WIDTH, CARD_HEIGHT_MAX, false );

// Tags Special

// Table
$table = new \xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Table Rows
$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, 'Disk Usage' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, \xan\environ_disk_usage() );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, 'Disk Used' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, \xan\numBytesToString( disk_total_space( "/" ) - disk_free_space( "/" ) ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, 'Disk Free' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, \xan\numBytesToString( disk_free_space( "/" ) ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, 'Disk Total' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, \xan\numBytesToString( disk_total_space( "/" ) ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, ' ' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, ' ' );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, 'RAM Usage' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, round( \xan\environ_server_memory_used() / \xan\environ_server_memory_total() * 100, 0 ) . '%' );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, 'RAM Used' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, \xan\numBytesToString( \xan\environ_server_memory_used() ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, 'RAM Free' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, \xan\numBytesToString( \xan\environ_server_memory_total() - \xan\environ_server_memory_used() ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, 'RAM Total' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, \xan\numBytesToString( \xan\environ_server_memory_total() ) );

// Card Append
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $table->render() );
?>