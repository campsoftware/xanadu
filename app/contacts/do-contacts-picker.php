<?php
// Validate Init
$ValidationMessage = array();

// Validate Contact ID for Foreign Keys
if ( xan\isEmpty( $doParam[ 'IDContacts' ] ) ) {
    $ValidationMessage[] = 'Contact ID is Invalid';
}

// Validate Search Term // Blank is OK to Find All
// if ( xan\isEmpty( $doParam[ 'SearchTerm' ] ) ) {
//     $ValidationMessage[] = 'Search Term is Blank';
// }

// Invalid Response
if ( !empty( $ValidationMessage ) ) {
    $aloe_response->status_set( '400 Bad Request: ' . implode( ', ', $ValidationMessage ) );
    $aloe_response->content_set( 'Error' );
    return;
}

// Init Card Parts
$idPrefix = 'ContactsPicker';  // Unique ID Prefix
$cardListHeader = $mmContactsT->FontAwesome . STR_NBSP . $mmContactsT->NamePlural;
$cardListContent .= '';
$cardTemp = new \xan\eleCard( '', '', '');

// Query Search Term Prep
$queryColumns = array( 'NameCompany', 'NameFirst', 'NameLast' );
$queryWhere = UUIDTENANTS . ' = ? ' . ( xan\isEmpty( $doParam[ 'SearchTerm' ] ) ? '' : 'AND ( ' . xan\dbSearchTermSQL( $queryColumns ) . ' )' );
$queryTermBindNames = ( xan\isEmpty( $doParam[ 'SearchTerm' ] ) ? array() : xan\dbSearchTermBindNames( $queryColumns ) );
$queryTermBindValues = ( xan\isEmpty( $doParam[ 'SearchTerm' ] ) ? array() : xan\dbSearchTermBindValues( $queryColumns, $doParam[ 'SearchTerm' ] ) );

// Query Actual
$recs = new xan\recs( $mmContactsT );
$recs->querySQL = 'SELECT * FROM ' . $mmContactsT->NameTable . ' WHERE ' . $queryWhere . ' ORDER BY NameCompany ASC, NameLast ASC ' . ' LIMIT 500 ';
$recs->queryBindNamesA = array_merge( array( UUIDTENANTS ), $queryTermBindNames );
$recs->queryBindValuesA = array_merge( array( $_SESSION[ 'recsUsersCURRENT' ][ UUIDTENANTS ] ), $queryTermBindValues );;
$recs->query();

// Error Check
if ( $recs->errorB ) {
    $cardListHeader .= 'Error:  ' . $recs[ DB_ERRORMESSAGE ];
} elseif ( $recs->rowCount < 1 ) {
    $cardListHeader .= ': None Found';
} else {
    $cardListHeader .= ': ' . $recs->rowCount . STR_NBSP . STR_NBSP . '<span class="text-muted small" >[Max 500]</span>';

    // Recs Loop
    $recs->rowIndex = -1;
    foreach ( $recs->rowsD as $recsListRow ) {
        $recs->rowIndex++;

        $onClick = '$(\'#' . $idPrefix . '_Modal\').modal(\'hide\'); alert( \'' . $recsListRow[ $mmContactsT->NameTableKey ] . '\');';
        $itemContent = $mmContactsT->getListItem( $idPrefix, $recs, $onClick );
        $itemID = $idPrefix . $recsListRow[ $mmContactsT->NameTableKey ];
        $cardListContent .= $cardTemp->renderListItemLink( $itemContent, $recs->rowIndex + 1, $itemID, false, $onClick );
        
    }
}

// Result
$result[ 'Do_HTMLSelectorName' ][ 0 ] = '#' . $idPrefix . '_ListItems';
$result[ 'Do_HTMLSelectorData' ][ 0 ] = $cardListHeader . '<div class="list-group list-group-flush">' . $cardListContent . '</div>';

// Set Focus Selector
//$_SESSION[ 'FocusSelector' ] = '#xf_' . $UUIDNew . '_Data';

// Return JSON
$resultJSON = json_encode( $result );
$aloe_response->content_set( $resultJSON );
return;
?>