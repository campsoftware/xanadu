<?php
// Card
$cardHeaderContent = xan\iconFA( 'fas fa-hdd' ) . STR_NBSP . 'Disk and ' . xan\iconFA( 'fas fa-microchip' ) . STR_NBSP . 'RAM';
$card = new xan\eleCard( CARD_WIDTH, '', false );

// Tags Special

// Table
$table = new xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Table Rows
$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, 'Disk Usage' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, xan\environ_disk_usage() );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, 'Disk Used' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, xan\numBytesToString( disk_total_space( "/" ) - disk_free_space( "/" ) ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, 'Disk Free' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, xan\numBytesToString( disk_free_space( "/" ) ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, 'Disk Total' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, xan\numBytesToString( disk_total_space( "/" ) ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, ' ' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, ' ' );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, 'RAM Usage' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, round( xan\environ_server_memory_used() / xan\environ_server_memory_total() * 100, 0 ) . '%' );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, 'RAM Used' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, xan\numBytesToString( xan\environ_server_memory_used() ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, 'RAM Free' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, xan\numBytesToString( xan\environ_server_memory_total() - xan\environ_server_memory_used() ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, 'RAM Total' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, xan\numBytesToString( xan\environ_server_memory_total() ) );

// Card Append to Source
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $table->render() );
?>