<?php
// Validate Init
$ValidationMsgA = array();

// Validate ID for Foreign Keys
if ( \xan\isEmpty( $doParam[ $mmContactsT->NameTableParam ] ) ) {
	$ValidationMsgA[] = $mmContactsT->NameSingular . ' ID is Invalid';
}

// Validate Search Term // Blank is OK to Find All
// if ( \xan\isEmpty( $doParam[ 'SearchTerm' ] ) ) {
//     $ValidationMsgA[] = 'Search Term is Blank';
// }

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	$aloe_response->status_set( '400 Bad Request: ' . implode( ', ', $ValidationMsgA ) );
	$aloe_response->content_set( 'Error' );
	return;
}

// Init Card Parts
$idPrefix = 'ContactsPicker';  // Unique ID Prefix
$cardListHeader = $mmContactsT->FontAwesome . STR_NBSP . $mmContactsT->NamePlural;
$cardListContent .= '';
$cardTemp = new \xan\eleCard( '', '', '' );

// Query Search Term Prep
$queryColumns = array( 'NameCompany', 'NameFirst', 'NameLast' );
$queryWhere = ( \xan\isEmpty( $doParam[ 'SearchTerm' ] ) ? '' : '( ' . \xan\dbSearchTerm_SQL( $queryColumns ) . ' )' );
$queryTermBindNamesA = ( \xan\isEmpty( $doParam[ 'SearchTerm' ] ) ? array() : \xan\dbSearchTerm_BindNamesA( $queryColumns ) );
$queryTermBindValuesA = ( \xan\isEmpty( $doParam[ 'SearchTerm' ] ) ? array() : \xan\dbSearchTerm_BindValuesA( $queryColumns, $doParam[ 'SearchTerm' ] ) );

// Query Actual
$recs = new \xan\recs( $mmContactsT );
$recs->querySQL = 'SELECT * FROM ' . $mmContactsT->NameTable . ' WHERE ' . $queryWhere . ' ORDER BY NameCompany ASC, NameLast ASC ' . ' LIMIT 500 ';
$recs->queryBindNamesA = $queryTermBindNamesA;
$recs->queryBindValuesA = $queryTermBindValuesA;
$recs->query();

// Error Check
if ( $recs->errorB ) {
	$ValidationMsgA[] = 'Name Update Error' . $recs->messageExtra . '; ' . $recs->messageSQL;
} elseif ( $recs->rowCount < 1 ) {
	$cardListHeader .= ': None Found';
} else {
	$cardListHeader .= ': ' . $recs->rowCount . STR_NBSP . STR_NBSP . '<span class="text-muted small" >[Max 500]</span>';
	
	// Recs Loop
	$recs->rowIndex = -1;
	foreach ( $recs->rowsD as $recsListRow ) {
		$recs->rowIndex++;
		
		// IDs
		$idListItem = $idPrefix . $recs->rowsD[ $recs->rowIndex ][ $mmContactsT->NameTableKey ];
		$idListItemImage = $idListItem . 'Image';
		
		// Image Element
		$imgURL = \xan\fileBucketURL( $mmContactsT->NameTable, $recs->rowsD[ $recs->rowIndex ][ $mmContactsT->NameTableKey ], 'PhotoFN', $recs->rowsD[ $recs->rowIndex ][ 'PhotoFN' ] );
		$tagsEleImage = new \xan\tags( [ 'img-thumbnail' ], [ 'max-width' => '4rem', 'max-height' => '100%' ], [] );
		$imgEle = new \xan\eleURLImage( $imgURL, ( $recs->rowIndex > 20 ? true : false ), $idListItemImage, 'Photo', 'Photo', $tagsEleImage );
		$tagsCellImage = new \xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_TOP ], array( 'width' => '4.2rem' ), [] );
		
		// Get List Item
		$onClick = '$(\'#' . $idPrefix . '_Modal\').modal(\'hide\'); alert( \'' . $recsListRow[ $mmContactsT->NameTableKey ] . '\');';
		$cardListContent .= $mmContactsT->getListItemWImage( $recs, $idPrefix, '', $onClick, $tagsCellImage, $imgEle );
	}
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	$aloe_response->status_set( '500 Internal Service Error: ' . implode( ", ", $ValidationMsgA ) );
	$aloe_response->content_set( 'Error' );
	return;
}

// Process
$resp->jsSetHTML( '#' . $idPrefix . '_ListItems', $cardListHeader . '<div class="list-group list-group-flush">' . $cardListContent . '</div>' );

// Actions Return as JSON
$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
return;
?>
