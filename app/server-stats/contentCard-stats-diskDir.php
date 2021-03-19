<?php
// Card
$cardHeaderContent = xan\iconFA( 'fas fa-folders' ) . STR_NBSP . 'Disk Path:' . STR_BR . PATH_ROOT_OS;
$card = new xan\eleCard( CARD_WIDTH, CARD_HEIGHT_MAX, true );

// Tags Special

// Table
$table = new xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Table Rows
$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, 'App Directories' );
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, 'Disk Used' );
$diskUsedAppArray = explode( chr( 10 ), xan\environ_disk_usage_app() );
foreach ( $diskUsedAppArray as $item ) {
	$itemArray = explode( chr( 9 ), $item );
	if ( \xan\isNotEmpty( $itemArray[ 0 ] ) ) {
		$tableRowIndex++;
		$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $itemArray[ 1 ] );
		$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, $itemArray[ 0 ] );
	}
}

// Card Append
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $table->render() );
?>