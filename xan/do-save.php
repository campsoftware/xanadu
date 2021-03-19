<?php
// Get Vars
$theAjaxAction = xan\valuePOST( "ajaxAction" );
$theAjaxLabel = xan\valuePOST( "ajaxLabel" );

// Meta
$theFormMetaRaw = xan\valuePOST( "ajaxMeta", '', false );
if ( FORM_OBFUSCATE ) {
	// Decrypt
	$theFormMetaPartsRaw = explode( '|', $theFormMetaRaw );
	$theTime = $theFormMetaPartsRaw[ 0 ];
	$theFormMeta = $theFormMetaPartsRaw[ 1 ];
	$theFormMeta = xan\decrypt( $theFormMeta, $theTime . FORM_OBFUSCATE_KEY );
	// Get Parts
	$theFormMetaParts = explode( '|', $theFormMeta );
	$theTableName = $theFormMetaParts[ 0 ];
	$theTableKeyName = $theFormMetaParts[ 1 ];
	$theTableKeyValue = $theFormMetaParts[ 2 ];
} else {
	// No Decryption
	$theFormMeta = $theFormMetaRaw;
	// Get Parts
	$theFormMetaParts = explode( '|', $theFormMeta );
	$theTime = $theFormMetaParts[ 0 ];
	$theTableName = $theFormMetaParts[ 1 ];
	$theTableKeyName = $theFormMetaParts[ 2 ];
	$theTableKeyValue = $theFormMetaParts[ 3 ];
}

// Debug
//$aloe_response->status_set( '500 Internal Service Error: ' . $theTime . ' / ' . $theFormMeta . ' / ' . $theTableName . ' / ' . $theTableKeyName . ' / ' . $theTableKeyValue );
//$aloe_response->content_set( 'Error' );
//return;


///////////////////////////////////////////////////////////
// Validate
$ValidationMsgA = array();

// Check Action
if ( $theAjaxAction !== "ajaxSave" ) {
	$ValidationMsgA[] = "Invalid Action";
}

// Check Table and Key Value
if ( $theTime === "" or $theTableName === "" or $theTableKeyValue === "" ) {
	$ValidationMsgA[] = "Invalid Action Data";
}

// Check Time
$timeValidUntil = strtotime( "now" ) - FORM_TIMEOUT_SECONDS;
$timeLeft = $theTime - $timeValidUntil;
if ( $timeLeft < 0 ) {
	$ValidationMsgA[] = "Form Expired: " . round( abs( $timeLeft ) / 60, 1 ) . 'min Ago';
}

// Respond Not Valid
if ( !empty( $ValidationMsgA ) ) {
	$aloe_response->status_set( '400 Bad Request: ' . implode( ", ", $ValidationMsgA ) );
	$aloe_response->content_set( 'Error' );
	return;
}

///////////////////////////////////////////////////////////
// Get Table Values
$recsTable = new xan\recs( $mm[ xan\mmNameForTable( $theTableName ) ] );
$recsTable->querySQL = 'SELECT * FROM ' . $theTableName . ' WHERE ' . $theTableKeyName . ' = ? ';
$recsTable->queryBindNamesA = array( $theTableKeyName );
$recsTable->queryBindValuesA = array( $theTableKeyValue );
$recsTable->query();
// Error Check
if ( $recsTable->errorB ) {
	$aloe_response->status_set( '500 Internal Service Error: ' . 'Select Before Error' );
	$aloe_response->content_set( 'Error' );
	return;
} elseif ( $recsTable->rowCount < 1 ) {
	$aloe_response->status_set( '500 Internal Service Error: ' . 'Select Before Not Found' );
	$aloe_response->content_set( 'Error' );
	return;
// } else {
// 	// Recs Loop
// 	$cardContent = '';
// 	$recsTable->rowIndex = -1;
// 	foreach ( $recsTable->rowsD as $recsTableRow ) {
// 		$recsTable->rowIndex++;
//		
// 	}
}

// Update Table Values
$TableSchemaRecsIndex = 0;
$sqlSetPairs = array();

// For each Table Column
foreach ( $GLOBALS[ 'schema' ][ $theTableName ] as $theTableSchema ) {
	
	$TableSchemaRecsIndex = $TableSchemaRecsIndex + 1;
	
	// Get Column Name and Posted Name
	$colName = $theTableSchema[ "COLUMN_NAME" ];
	$columnNamePost = xan\formObfuscate( $colName, $theTime );
	
	// Get Column Value from the Table and Post
	$colValueTable = $recsTable->rowsD[ 0 ][ $colName ];
	$colValuePost = xan\valuePOST( $columnNamePost, "[USE_DB_VALUE]" );
	
	// Use the Post Value if available
	if ( $colValuePost == "[USE_DB_VALUE]" ) {
		$colValue = $colValueTable;
	} else {
		$colValue = $colValuePost;
	}
	
	// Column Format from MM_Table_T
	$colFormat = '';
	if ( isset( $mm[ xan\mmNameForTable( $theTableName ) ] ) ) {
		$mm_table_t = $mm[ xan\mmNameForTable( $theTableName ) ];
		$colFormat = $mm_table_t->getColMeta( $colName );
	}
	
	// Massage Value based on Schema.
	$colValue = xan\dbValueMassageForSQL( $theTableName, $colName, $colValue, $colFormat );
	
	// Get ColumnName and Value Pairs for Columns to Update
	$sqlSetPairs[ $colName ] = $colValue;
	
}

// Debug
//$aloe_response->status_set( '500 Internal Service Error: ' . json_encode( $sqlSetPairs, JSON_PRETTY_PRINT ) );
//$aloe_response->content_set( 'Error' );
//return;

///////////////////////////////////////////////////////////
// Update Calc Columns
// if ( $theTableName === "Contacts" ) {
//     $recsTable->rowsD[ 0 ][ "NameFirstLast" ] = $recsTable->rowsD[ 0 ][ 0 ][ 'NameFirst' ] . ' ' . $recsTable->rowsD[ 0 ][ 0 ][ 'NameLast' ] ;
// }
///////////////////////////////////////////////////////////

// Update ModTS and ModName
$sqlSetPairs[ UUIDTENANTS ] = $_SESSION[ SESS_USER ][ UUIDTENANTS ] ?? "";
$sqlSetPairs[ 'ModTS' ] = xan\dateTimeNowSQL();
$sqlSetPairs[ 'Mod' . UUIDUSERS ] = $_SESSION[ SESS_USER ][ UUIDUSERS ] ?? "";
$sqlSetPairs[ 'ModName' ] = $_SESSION[ SESS_USER ][ 'EmailAddress' ] ?? "";

// Get the SQL SET Statement and Bind Values
$sqlSet = '';
$bindNameA = array();
$bindValuesA = array();
foreach ( $sqlSetPairs as $colName => $colValue ) {
	if ( $colValue !== $recsTable->rowsD[ 0 ][ $colName ] ) {
		
		// Column Format from MM_Table_T
		$colFormat = '';
		if ( isset( $mm[ xan\mmNameForTable( $theTableName ) ] ) ) {
			$mm_table_t = $mm[ xan\mmNameForTable( $theTableName ) ];
			$colFormat = $mm_table_t->getColMeta( $colName );
		}
		
		// Set Statement Add Comma, But Not For First
		if ( $sqlSet !== "" ) {
			$sqlSet = $sqlSet . ", ";
		}
		// Set Statement Add Assignement
		$sqlSet = $sqlSet . $colName . " = ?";
		
		// Bind Append Column Names and Values
		$bindNameA[] = $colName;
		$bindValuesA[] = xan\dbValueMassageForSQL( $theTableName, $colName, $colValue, $colFormat );
		
	}
}

// Bind Value Append for WHERE
$bindNameA[] = $theTableKeyName;
$bindValuesA[] = $theTableKeyValue;

// Update
$updateTable = new xan\recs( $mm[ xan\mmNameForTable( $theTableName ) ] );
$updateTable->querySQL = 'UPDATE ' . $theTableName . ' SET ' . $sqlSet . ' WHERE ' . $theTableKeyName . ' = ? ';
$updateTable->queryBindNamesA = $bindNameA;
$updateTable->queryBindValuesA = $bindValuesA;
$updateTable->query();
// Error Check
if ( $updateTable->errorB ) {
	$aloe_response->status_set( '500 Internal Service Error: ' . 'Update Values Error' );
	$aloe_response->content_set( 'Error' );
	return;
} elseif ( $updateTable->rowCount < 1 ) {
	$aloe_response->status_set( '500 Internal Service Error: ' . 'Update Not Found' );
	$aloe_response->content_set( 'Error' );
	return;
	// } else {
	// 	// Recs Loop
	// 	$cardContent = '';
	// 	$recsTable->rowIndex = -1;
	// 	foreach ( $recsTable->rowsD as $recsTableRow ) {
	// 		$recsTable->rowIndex++;
	//		
	// 	}
}

// Select Record
$recsTable = new xan\recs( $mm[ xan\mmNameForTable( $theTableName ) ] );
$recsTable->querySQL = 'SELECT * FROM ' . $theTableName . ' WHERE ' . $theTableKeyName . ' = ?';
$recsTable->queryBindNamesA = array( $theTableKeyName );
$recsTable->queryBindValuesA = array( $theTableKeyValue );
$recsTable->query();
// Error Check
if ( $recsTable->errorB ) {
	$aloe_response->status_set( '500 Internal Service Error: ' . 'Select After Error' );
	$aloe_response->content_set( 'Error' );
	return;
} elseif ( $recsTable->rowCount < 1 ) {
	$aloe_response->status_set( '500 Internal Service Error: ' . 'Select After Not Found' );
	$aloe_response->content_set( 'Error' );
	return;
	// } else {
	// 	// Recs Loop
	// 	$cardContent = '';
	// 	$recsTable->rowIndex = -1;
	// 	foreach ( $recsTable->rowsD as $recsTableRow ) {
	// 		$recsTable->rowIndex++;
	//		
	// 	}
}

// Massage Values
foreach ( $recsTable->rowsD as &$rowTable ) {
	foreach ( $rowTable as $colName => $colValue ) {
		
		// Column Format from MM_Table_T colName
		$colFormat = '';
		if ( isset( $mm[ xan\mmNameForTable( $theTableName ) ] ) ) {
			$colMeta = $mm[ xan\mmNameForTable( $theTableName ) ]->getColMeta( $colName );
			$colFormat = $colMeta->eleFormatAs;
		}
		
		// Massage
		$rowTable[ $colName ] = xan\dbValueMassageForGUI( $theTableName, $colName, $rowTable[ $colName ], $colFormat, false );
		$rowTable[ $colName ] = xan\paramDecode( $rowTable[ $colName ] );
		
	}
}

// Get Load Time End
$page[ PAGE_MESSAGE_LOADTIME ] = xan\microsecsDiff( $pageload_begin );
$recsTable->rowsD[ 0 ][ "AjaxLoadTime" ] = $page[ PAGE_MESSAGE_LOADTIME ];
$recsTable->rowsD[ 0 ][ "AjaxColumnLabel" ] = $theAjaxLabel;

// Records to JSON
$resultJSON = json_encode( $recsTable->rowsD );

// LogAudit
$logAudit = xan\logAuditToSQL( $_SESSION[ SESS_USER ][ UUIDTENANTS ] ?? "", $_SESSION[ SESS_USER ][ UUIDUSERS ] ?? "", $_SESSION[ SESS_USER ][ 'EmailAddress' ] ?? "", $theAjaxAction, $theTableName, $theTableKeyName, $theTableKeyValue, $resultJSON );
// Error Check
if ( $logAudit->errorB ) {
	$aloe_response->status_set( '500 Internal Service Error: ' . 'LogAudit Error; ' . $logAudit->messageExtra . '; ' . $logAudit->messageSQL );
	$aloe_response->content_set( 'Error' );
	return;
} elseif ( $logAudit->rowCount < 1 ) {
	$aloe_response->status_set( '500 Internal Service Error: ' . 'LogAudit Not Found; '. $logAudit->messageExtra . '; ' . $logAudit->messageSQL );
	$aloe_response->content_set( 'Error' );
	return;
}

// Return Records as JSON
$aloe_response->content_set( $resultJSON );
?>
