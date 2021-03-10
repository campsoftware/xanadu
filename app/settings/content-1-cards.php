<?php
// Query
$recsDetail = new xan\recs( $mmSettingsT );
$recsDetail->querySQL = 'SELECT * FROM ' . $mmSettingsT->NameTable . ' WHERE ' . UUIDTENANTS . ' = ? AND Active = ?';
$recsDetail->queryBindNamesA = array( UUIDTENANTS, 'Active' );
$recsDetail->queryBindValuesA = array( $_SESSION[ SESS_USER ][ UUIDTENANTS ], 'Yes' );
$recsDetail->query();
$recsDetail->rowsMassageForGUI( false );

// Error Check
if ( $recsDetail->errorB ) {
	$resp->contentHeader .= ' Error: ' . $recsDetail->messageExtra . '; ' . $recsDetail->messageSQL;
} elseif ( $recsDetail->rowCount < 1 ) {
	$resp->contentHeader .= ' Error: None Found';
} elseif ( $recsDetail->rowCount > 0 ) {
	// Form Create
	$formTagDetail = new \xan\formTag( $recsDetail );
	$resp->contentEndA[] = $formTagDetail->render();
	
	// Tags Cell
	$tagsCellEmpty = new xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_MIDDLE ], [], [] );
	$tagsCellLeftMiddle = new xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_MIDDLE ], [], [] );
	$tagsCellLeftTop = new xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_TOP ], [], [] );
	$tagsCellRightMiddle = new xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_RIGHT, TABLE_ALIGN_MIDDLE ], [], [] );
	$tagsCellRightTop = new xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_RIGHT, TABLE_ALIGN_TOP ], [], [] );
	
	// Tags Ele
	$tagsEleLabel = new xan\tags( [ 'small' ], [], [] );
	$tagsEleInput = new xan\tags( [ 'col' ], [], [] );
	$tagsEleSelector = new xan\tags( [], [], [] );
	
	// Detail Cards Append
	require_once( 'content-card-settings-app.php' );
	require_once( 'content-card-settings-formats.php' );
	require_once( 'content-card-settings-smtp.php' );
	require_once( 'content-card-settings-twillo.php' );
	require_once( 'content-card-settings-stripe.php' );
	require_once( 'content-card-settings-otherapis.php' );
	
	// Scripts Extra
	// $resp->scriptsOnLoadA[] = '';
	// $resp->scriptsExtraA[] = xan\jsConsoleMsgAppend( 'Test: ' . 'Hey now!' );
}
?>