<?php
// Session File Names
// $sessionNames = scandir( session_save_path() );
// $sessionNames = scandir( ini_get( 'session.save_path' ) );
// $sessionNames = scandir( '/var/lib/php/sessions/' );
$sessionFilePaths = glob( '/tmp/sess_*' );
// echo print_r( $sessionFilePaths, true );

// Card
$cardHeaderContent = xan\iconFA( 'fas fa-handshake' ) . STR_NBSP . 'Sessions';
$card = new xan\eleCard( CARD_WIDTH_3X, CARD_HEIGHT_MAX, true );

// Tags Special

// Table
$table = new xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Table Header
$tableRowIndex++;
$tableColIndex = -1;
$table->cellSet( $tableRowIndex, ++$tableColIndex, $tagsCellLeftTop, '#' );
$table->cellSet( $tableRowIndex, ++$tableColIndex, $tagsCellLeftTop, 'TENANT' );
$table->cellSet( $tableRowIndex, ++$tableColIndex, $tagsCellLeftTop, 'Login / User ID' );
$table->cellSet( $tableRowIndex, ++$tableColIndex, $tagsCellLeftTop, 'SES_PATH / SES_INFO' );
$table->cellSet( $tableRowIndex, ++$tableColIndex, $tagsCellRightTop, SES_BEGIN );
$table->cellSet( $tableRowIndex, ++$tableColIndex, $tagsCellRightTop, SES_CHANGE );

// Store Current Session
$currentSessionID = session_id();

// Session Meta
$sessionIndex = 0;
$sessionCountEmpty = 0;
$sessionCount = 0;
$sessionAsText = '';

$allSessions = [];
foreach ( $sessionFilePaths as $sessionName ) {
	$sessionName = str_replace( "/tmp/sess_", "", $sessionName );
	if ( strpos( $sessionName, "." ) === false ) { // This skips temp files that aren't sessions
		
		// Load $sessionName
		session_abort();
		session_id( $sessionName );
		session_start();
		
		if ( strpos( $_SESSION[ SES_BEGIN ], "20" ) === 0 ) { // Starts with 20 like 2021-02-18 19:03:49
			
			$sessionCount++;
			$sessionIndex++;
			
			// Table Rows
			$tableRowIndex++;
			$tableColIndex = -1;
			$table->cellSet( $tableRowIndex, ++$tableColIndex, $tagsCellLeftTop, $sessionIndex );
			$table->cellSet( $tableRowIndex, ++$tableColIndex, $tagsCellLeftTop, $_SESSION[ SESS_USER ][ UUIDTENANTS ] );
			$table->cellSet( $tableRowIndex, ++$tableColIndex, $tagsCellLeftTop, $_SESSION[ SESS_USER ][ 'EmailAddress' ] . STR_BR . $_SESSION[ SESS_USER ][ UUIDUSERS ] );
			$table->cellSet( $tableRowIndex, ++$tableColIndex, $tagsCellLeftTop, $_SESSION[ SES_PATH ] .STR_BR . $_SESSION[ SES_INFO ] );
			$table->cellSet( $tableRowIndex, ++$tableColIndex, $tagsCellRightTop, $_SESSION[ SES_BEGIN ] );
			$table->cellSet( $tableRowIndex, ++$tableColIndex, $tagsCellRightTop, $_SESSION[ SES_CHANGE ] );
			$sessionAsText .= $sessionIndex . ' - ' . print_r( $_SESSION, true ) . '<hr/>';
			
		} else {
			$sessionCountEmpty++;
		}
		
	}
}

// Session Current Restore
session_abort();
session_id( $currentSessionID );
session_start();

// Header
$cardHeaderContent .= '<div class="float-right">Count: ' . $sessionCount . ', Empty: ' . $sessionCountEmpty . '</div>';

// Card Append to Source
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $table->render() );
?>