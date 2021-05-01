<?php

class moduleMetaAPIRequestsT extends \xan\moduleMeta {
	// Constructor
	public function __construct() {
		parent::__construct();
		$this->NameModule = 'APIRequests';
		$this->NameModuleLower = strtolower( $this->NameModule );
		$this->NameTable = 'APIRequests';
		$this->NameTableKey = 'UUIDAPIRequests';
		$this->NameTableParam = \xan\strSubstitute( $this->NameTableKey, 'UU', '' );
		
		// QueryBuilder Operators: equal, not_equal, in, not_in, less, less_or_equal, greater, greater_or_equal, between, not_between, begins_with, not_begins_with, contains, not_contains, ends_with, not_ends_with, is_empty, is_not_empty, is_null, is_not_null
		$this->QuerySimpleDefault = array( 'Auth', 'Action' );
		$this->QueryBuilderDefault = '{ field: "APIRequests.RequestTS", id: "querybuilder_APIRequests_RequestTS", operator: "greater_or_equal", value: "" }';
		
		$this->QueryOrderByDefault = 'RequestTS DESC';
		$this->QueryOrderByExtraBegin .= \xan\dbQueryOrderByItem( $this->NameTable, 'RequestTS DESC', 'RequestTS ASC', 'Request TS' );
		$this->QueryOrderByExtraBegin .= '<hr />';
		
		$this->NamePlural = 'API Requests';
		$this->NameSingular = 'API Request';
		
		$this->FontAwesome = '<i class=\'fas fa-user-robot\'></i>';
		$this->FontAwesomeList = FA_LIST;
		
		$this->URLRelative = '/' . 'apirequests/';
		$this->URLFull = URL_BASE . 'apirequests/';
		
		$this->URLDoRelative = '/' . 'apirequests-do/';
		$this->URLDoFull = URL_BASE . 'apirequests-do/';
	}
	
	
	///////////////////////////////////////////////////////////
	// Functions Required by \xan\moduleMeta
	
	public function getDisplayName( \xan\recs $recs ) {
		$code = trim( $recs->rowsD[ $recs->rowIndex ][ 'RequestTS' ] . " " . $recs->rowsD[ $recs->rowIndex ][ 'Auth' ] . " " . $recs->rowsD[ $recs->rowIndex ][ 'Action' ] . " " . $recs->rowsD[ $recs->rowIndex ][ 'ActionID' ] );
		
		$code = trim( $code );
		return $code;
	}
	
	public function getDisplayList( \xan\recs $recs ) {
		$code = $this->getDisplayName( $recs );
		
		$code = trim( $code );
		return $code;
	}
	
	public function getListItem( $idPrefix, \xan\recs $recs, $onClick ) {
		$idListItem = $idPrefix . $recs->rowsD[ $recs->rowIndex ][ $this->NameTableKey ];
		$idListItemImage = $idListItem . 'Image';
		$idListItemLabel = $idListItem . 'Label';
		
		// Table Init
		$tagsCellEmpty = new \xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_MIDDLE ], [], [] );
		$tagsCellRightMiddle = new \xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_TOP ], [], [] );
		$table = new \xan\eleTable( $tagsCellEmpty );
		
		// Table Cell
		$info = '<span id="' . $idListItemLabel . '" class="list-group-item-text">' . $this->getDisplayList( $recs ) . '</span>';
		$table->cellSet( $recs->rowIndex, 0, $tagsCellRightMiddle, $info );
		
		// Content
		$code = $table->render();
		return $code;
	}
	
	public function getListRow( $rowType, \xan\recs $recs, \xan\eleTable &$table, $dataIDPrefix, $dataIDSelected, $dataOnClick, $dataRowHeight, $dataColWidth ) {
		if ( $rowType === 'header' ) {
			// Init Indexes
			$colIndex = 0;
			
			// Cell Tag
			$tagsCell = new \xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_TOP ], [ 'position' => '-webkit-sticky', 'position' => '-moz-sticky', 'position' => '-ms-sticky', 'position' => '-o-sticky', 'position' => 'sticky', 'top' => 0 ], [] );
			
			// Cell Left
			$table->cellSet( $recs->rowIndex, $colIndex, $tagsCell, '' );
		}
		
		if ( $rowType === 'data' ) {
			// Init Indexes
			$colIndex = 0;
			$rowIndexTable = $recs->rowIndex + 1;
			
			// Cell Tag
			$isActive = ( $recs->rowsD[ $recs->rowIndex ][ $this->NameTableKey ] === $dataIDSelected ? 'active' : '' );
			$tagsCell = new \xan\tags( [ $isActive, 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_TOP ], [], [] );
			
			// Cell Left
			$idListItem = $dataIDPrefix . $recs->rowsD[ $recs->rowIndex ][ $this->NameTableKey ];
			$buttonMoreTags = new \xan\tags( [ ELE_CLASS_BUTTON_SM_SECONDARY, 'mb-2' ], [], [ 'id="' . $idListItem . '"', 'onclick="window.location.href = \'' . $this->URLFull . $recs->rowsD[ $recs->rowIndex ][ $this->NameTableKey ] . '\';"' ] );
			$buttonMoreEle = new \xan\eleButton( $rowIndexTable, '', '', $buttonMoreTags );
			$table->cellSet( $rowIndexTable, $colIndex, $tagsCell, '<div style="height: ' . $dataRowHeight . '; overflow-y: auto;">' . $buttonMoreEle->render() . '</div>' );
		}
		
		// For Each Header or Data Row Cell
		foreach ( $recs->rowsD[ $recs->rowIndex ] as $key => $value ) {
			$colIndex++;
			
			// Column Width Overrides
			switch ( $key ) {
				case 'RequestData':
					$width = '400px';
					break;
				case 'ResponseURL':
					$width = '200px';
					break;
				case 'ResponseData':
					$width = '500px';
					break;
				case 'Log':
					$width = '300px';
					break;
				default:
					$width = $dataColWidth;
			}
			
			if ( $rowType === 'header' ) {
				$headerLabelColMeta = $this->getColMeta( $key );
				$table->cellSet( $recs->rowIndex, $colIndex, $tagsCell, $headerLabelColMeta->colLabel );
			}
			
			if ( $rowType === 'data' ) {
				$table->cellSet( $rowIndexTable, $colIndex, $tagsCell, '<div style="height: ' . $dataRowHeight . '; width: ' . $width . '; overflow-y: auto;">' . $value . '</div>' );
			}
		}
		
	}
	
	public function getColLabel( $colName ) {
		// Get Col Ele Meta
		$colEle = $this->getColMeta( $colName, ELE_AS_LABEL );
		return $colEle->colLabel;
	}
	
	public function getColMeta( $colName, $typeAs = ELE_AS_DEFINED ) {
		// Init
		$colMeta = new \xan\colMeta();
		$colMeta->eleType = ELE_TYPE_TEXT_DB; // Default to Text Input
		$colMeta->eleTypeAs = $typeAs;
		$colMeta->eleFormatAs = '';
		$colMeta->colName = $colName;
		$colMeta->colLabelEN = $colMeta->colName;
		$colMeta->colLabel = $colMeta->colName;
		
		// Choices
		$colMeta->choicesAValues = [];
		$colMeta->choicesADisplay = [];
		$colMeta->choicesClearLabel = STR_CLEAR; // Add Clear
		$colMeta->choicesOtherLabel = STR_OTHER; // Add Other
		
		// Columns Specifics
		switch ( $colName ) {
			case 'Auth':
				$colMeta->colLabelEN = 'Request Auth';
				break;
			case 'Action':
				$colMeta->colLabelEN = 'Action Name';
				break;
			case 'ActionID':
				$colMeta->colLabelEN = 'Action ID';
				break;
			case 'RequestIsProcessed':
				$colMeta->colLabelEN = 'Req Processed';
				$colMeta->eleType = ELE_TYPE_SELECT_DB;
				$colMeta->choicesAValues = ARRAY_YESNO;
				$colMeta->choicesADisplay = ARRAY_YESNO;
				$colMeta->choicesOtherLabel = '';
				break;
			case 'RequestIsSent':
				$colMeta->colLabelEN = 'Req Sent';
				$colMeta->eleType = ELE_TYPE_SELECT_DB;
				$colMeta->choicesAValues = ARRAY_YESNO;
				$colMeta->choicesADisplay = ARRAY_YESNO;
				$colMeta->choicesOtherLabel = '';
				break;
			case 'RequestTS':
				$colMeta->colLabelEN = 'Request TS';
				$colMeta->eleType = ELE_TYPE_DATETIME_DB;
				break;
			case 'RequestData':
				$colMeta->colLabelEN = 'Request Data';
				$colMeta->eleType = ELE_TYPE_TEXTAREA_DB;
				break;
			case 'ResponseTS':
				$colMeta->colLabelEN = 'Response TS';
				$colMeta->eleType = ELE_TYPE_DATETIME_DB;
				break;
			case 'ResponseIsProcessed':
				$colMeta->colLabelEN = ' Resp Processed';
				$colMeta->eleType = ELE_TYPE_SELECT_DB;
				$colMeta->choicesAValues = ARRAY_YESNO;
				$colMeta->choicesADisplay = ARRAY_YESNO;
				$colMeta->choicesOtherLabel = '';
				break;
			case 'ResponseData':
				$colMeta->colLabelEN = 'Response Data';
				$colMeta->eleType = ELE_TYPE_TEXTAREA_DB;
				break;
			case 'ResponseURL':
				$colMeta->colLabelEN = 'Response URL';
				break;
			case 'ResponseAuth':
				$colMeta->colLabelEN = 'Response Auth';
				break;
			case 'ResponseCode':
				$colMeta->colLabelEN = 'Response Code';
				break;
			case 'ResponseMessage':
				$colMeta->colLabelEN = 'Response Message';
				break;
			case 'Log':
				$colMeta->colLabelEN = 'Log';
				break;
			
			// UUID
			case 'UUIDAPIRequests':
				$colMeta->colLabelEN = 'API Requests ID';
				$colMeta->isKey = true;
				$colMeta->isKeyPrimary = true;
				$colMeta->isKeyForeign = false;
				break;
		}
		
		// Set the Label
		$colMeta->colLabel = $colMeta->colLabelEN;
		
		// Return the Element
		return $colMeta;
	}
	
	public function getColEleRender( $colName, $typeAs, \xan\tags $tags, \xan\recs $recs, \xan\formTag $formTag, \xan\response &$resp ) {
		// Get Col Ele Meta
		$colMeta = $this->getColMeta( $colName, $typeAs );
		$code = \xan\eleDBMetaRender( $colMeta, $tags, $recs, $formTag, $resp );
		return $code;
	}
	
	
	///////////////////////////////////////////////////////////
	// Functions For This Module
	
}

// Init
$mmAPIRequestsT = new moduleMetaAPIRequestsT();
define( 'MM_APIREQUESTS_T', 'MM_APIREQUESTS_T' );
$mm[ MM_APIREQUESTS_T ] = &$mmAPIRequestsT;
?>