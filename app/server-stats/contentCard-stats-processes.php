<?php
// Card
$cardHeaderContent = \xan\iconFA( 'fas fa-hard-hat' ) . STR_NBSP . 'Processes';
$card = new \xan\eleCard( CARD_WIDTH, CARD_HEIGHT_MAX, true );

// Tags Special

// Table
$table = new \xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Table Rows
$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, 'As Of' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, \xan\dateTimeNowSQL() );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, 'Connections' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, \xan\environ_http_connections() );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, 'Processes' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, \xan\environ_number_processes() );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, 'Processes' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, \xan\environ_server_uptime() );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, 'Uptime' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, \xan\environ_system_cores() );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, 'Cores' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, \xan\environ_system_load( \xan\environ_system_cores(), 1 ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, 'Load' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, \xan\dateTimeNowSQL() );

// Card Append
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $table->render() );
?>