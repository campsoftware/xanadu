<?php
///////////////////////////////////////////////////////////
// List
if ( true ) {
	// Card Init
	$cardHeaderContent = $mmAPIRequestsT->FontAwesomeList . STR_NBSP . $mmAPIRequestsT->NamePlural;
	$card = new \xan\eleCard( "100%", '50rem', true );
	
	// Query
	$recsList = new \xan\recs( $mmAPIRequestsT );
	$searchBarEle = new \xan\eleSearchBarListDB( $mmAPIRequestsT, $resp );
	$searchBarList = $searchBarEle->render();
	$recsList->querySQL = $searchBarList[ 'querySQL' ];
	$recsList->queryBindNamesA = $searchBarList[ 'queryBindNames' ];
	$recsList->queryBindValuesA = $searchBarList[ 'queryBindValues' ];
	$recsList->query();
	$recsList->rowsMassageForGUI( true, [ 'RequestTS', 'ResponseTS' ] );
	
	// Error Check
	if ( $recsList->errorB ) {
		$resp->contentHeader .= 'Error: ' . $recsList->messageExtra . '; ' . $recsList->messageSQL;
	} elseif ( $recsList->rowCount < 1 ) {
		$cardHeaderContent .= ': None Found';
	} else {
		$cardHeaderContent .= ': ' . $recsList->rowCount;
		$cardContent = '';
		
		if ( false ) {
		    // Mini Tables
			$recsList->rowIndex = -1;
			foreach ( $recsList->rowsD as $recsListRow ) {
				$recsList->rowIndex++;
				
				$idPrefix = $mmAPIRequestsT->NameModule . 'List';
				$onClick = 'window.location.href = \'' . $mmAPIRequestsT->URLFull . $recsList->rowsD[ $recsList->rowIndex ][ $mmAPIRequestsT->NameTableKey ] . '\';';
				$itemContent = $mmAPIRequestsT->getListItem( $idPrefix, $recsList, $onClick );
				$itemID = $idPrefix . $recsList->rowsD[ $recsList->rowIndex ][ $mmAPIRequestsT->NameTableKey ];
				$isSelected = ( $resp->reqID == $recsList->rowsD[ $recsList->rowIndex ][ $mmAPIRequestsT->NameTableKey ] ? true : false );
				$cardContent .= $card->renderListItemLink( $itemContent, $recsList->rowIndex + 1, $itemID, $isSelected, $onClick );
				
			}
		} else {
		    // Big Table
			$tagsCellEmpty = new \xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_MIDDLE ], [], [] );
			$table = new \xan\eleTable( $tagsCellEmpty );
			
			// Header
			$recsList->rowIndex = 0;
			$mmAPIRequestsT->getListItemRowHeader( '', $recsList, '', $table, '' );
			
			// Recs Loop
			$recsList->rowIndex = -1;
			foreach ( $recsList->rowsD as $recsListRow ) {
				$recsList->rowIndex++;
				
				$idPrefix = $mmAPIRequestsT->NameModule . 'List';
				$onClick = 'window.location.href = \'' . $mmAPIRequestsT->URLFull . $recsList->rowsD[ $recsList->rowIndex ][ $mmAPIRequestsT->NameTableKey ] . '\';';
				$mmAPIRequestsT->getListItemRow( $idPrefix, $recsList, $onClick, $table, $resp->reqID );
			}
			
			// Content
			$cardContent .= $table->render( 1 );
		}
		
	}
	
	// Header Button New Record
	$buttonNewTags = new \xan\tags( [ ELE_CLASS_BUTTON_SM_NEW, 'mb-2' ], [], [ 'onclick="$(\'#' . $mmAPIRequestsT->NameModule . 'RecNew_Modal\').modal(\'show\');"' ] );
	$buttonNewEle = new \xan\eleButton( FA_NEW, '', '', $buttonNewTags );
	$cardHeaderContent .= '<div class="float-right">' . $buttonNewEle->render() . '</div>';
	// Header Search Bar
	$cardHeaderContent .= STR_BR . $searchBarList[ 'searchbar' ];
	// Card Append
	$resp->contentAreaA[] = $card->renderCardWithList( $cardHeaderContent, $cardContent );
}

///////////////////////////////////////////////////////////
// Detail
if ( \xan\isNotEmpty( $resp->reqID ) ) {
	// Query
	$recsDetail = new \xan\recs( $mmAPIRequestsT );
	$recsDetail->querySQL = 'SELECT * FROM ' . $mmAPIRequestsT->NameTable . ' WHERE ' . $mmAPIRequestsT->NameTableKey . ' = ?';
	$recsDetail->queryBindNamesA = array( $mmAPIRequestsT->NameTableKey );
	$recsDetail->queryBindValuesA = array( $resp->reqID );
	$recsDetail->query();
	$recsDetail->rowsMassageForGUI( false );
	
	// Error Check
	if ( $recsDetail->errorB ) {
		$resp->contentHeader .= ' Error: ' . $recsDetail->messageExtra . '; ' . $recsDetail->messageSQL;
	} elseif ( $recsDetail->rowCount < 1 ) {
		$resp->contentHeader .= ' Error: None Found';
	} elseif ( $recsDetail->rowCount > 0 ) {
		$cardHeaderContent .= ': ' . $recsDetail->rowCount;
		
		// Form Create
		$formTagDetail = new \xan\formTag( $recsDetail );
		$resp->contentEndA[] = $formTagDetail->render();
		// Title Update Page and Header
		$resp->headTitle .= ': ' . $mmAPIRequestsT->getDisplayName( $recsDetail ) . ' [' . APP_NAME . ']';
		$resp->contentHeader .= '<span id="pageContentHeaderDetails">' . ': ' . $mmAPIRequestsT->getDisplayName( $recsDetail ) . '</span>';
		
		// Tags Cell
		$tagsCellEmpty = new \xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_MIDDLE ], [], [] );
		$tagsCellLeftMiddle = new \xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_MIDDLE ], [], [] );
		$tagsCellLeftTop = new \xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_TOP ], [], [] );
		$tagsCellRightMiddle = new \xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_RIGHT, TABLE_ALIGN_MIDDLE ], [], [] );
		$tagsCellRightTop = new \xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_RIGHT, TABLE_ALIGN_TOP ], [], [] );
		
		// Tags Ele
		$tagsEleLabel = new \xan\tags( [ 'small' ], [], [] );
		$tagsEleInput = new \xan\tags( [ 'col' ], [], [] );
		$tagsEleSelector = new \xan\tags( [], [], [] );
		
		// Detail Cards Append
		require_once( 'contentCard-apirequests-request.php' );
		require_once( 'contentCard-apirequests-response.php' );
		
		// Actions Menu ; Disable items with 'disabled' class
		ob_start();
		?>
        <div class="float-right">
			<?php if ( \xan\isNotEmpty( $resp->reqID ) ) : ?>
				<?php
				// Button Contact Picker
				$buttonContactPickerTags = new \xan\tags( [ ELE_CLASS_BUTTON_SM_SECONDARY, 'mr-2' ], [], [ 'onclick="$(\'#ContactsPicker_Modal\').modal(\'show\');"' ] );
				$buttonContactPicker = new \xan\eleButton( FA_NEW . STR_NBSP . 'Contact Picker', '', '', $buttonContactPickerTags );
				echo $buttonContactPicker->render();
				
				// Button Actions
				$buttonActionsTags = new \xan\tags( [ ELE_CLASS_BUTTON_SM_SECONDARY, 'dropdown-toggle' ], [ 'z-index' => ZINDEX_TOP ], [ 'data-toggle="dropdown"', 'aria-haspopup="true"', 'aria-expanded="false"' ] );
				$buttonActionsPicker = new \xan\eleButton( FA_ACTION . STR_NBSP . 'Actions', 'actionsMenu', '', $buttonActionsTags );
				echo $buttonActionsPicker->render();
				
				// Button Actions Items
				?>
                <div class="dropdown-menu dropdown-menu-right border-1" role="menu" aria-labelledby="actionsMenu">
                    <a class="dropdown-item pl-2 pr-2" onclick='xanDo( { "Do":"ContactsPrint", "Msg":"PDF Print", "URL":"<?= $mmAPIRequestsT->URLDoRelative ?>", "IDContacts":"<?= $resp->reqID ?>", "Format":"pdf", "Template":"pdf-default", "NewWindow":1 } );'><?= FA_PRINT . STR_NBSP ?>Print to PDF</a>
                    <a class="dropdown-item pl-2 pr-2" onclick='xanDo( { "Do":"ContactsPrint", "Msg":"HTML Print", "URL":"<?= $mmAPIRequestsT->URLDoRelative ?>", "IDContacts":"<?= $resp->reqID ?>", "Format":"html", "Template":"pdf-default", "NewWindow":1 } );'><?= FA_PRINT . STR_NBSP ?>Print to HTML</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item pl-2 pr-2 bg-primary text-white" onclick="$('#ContactsRecDuplicate_Modal').modal('show');"><?= FA_DUPLICATE . STR_NBSP ?>Duplicate</a>
                    <a class="dropdown-item pl-2 pr-2 bg-danger text-white" onclick="$('#ContactsRecDelete_Modal').modal('show');"><?= FA_DELETE . STR_NBSP ?>Delete</a>
                </div>
			<?php endif; ?>
        </div>
		<?php
		$actionsMenu = ob_get_clean();
		$resp->contentHeader .= $actionsMenu;
		
		// ScrollTos
		$resp->scriptsOnLoadA[] = \xan\jsScrollTo( '#' . $mmAPIRequestsT->NameModule . 'List' . $resp->reqID );
		$resp->scriptsOnLoadA[] = \xan\jsScrollToTop();
		
		// Scripts Extra
		// $resp->scriptsOnLoadA[] = '';
		// $resp->scriptsExtraA[] = \xan\jsConsoleMsgAppend( 'Test: ' . 'Hey now!' );
	}
}
?>