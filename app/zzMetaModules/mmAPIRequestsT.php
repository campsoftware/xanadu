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
	// Abstract Functions Required by \xan\moduleMeta
	
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
		
		// Sizes
		$colMeta->widthForTable = ''; // No Default for Overrides Closer to Renderers
		
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
				$colMeta->widthForTable = '400px';
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
				$colMeta->widthForTable = '500px';
				break;
			case 'ResponseURL':
				$colMeta->colLabelEN = 'Response URL';
				$colMeta->widthForTable = '200px';
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
				$colMeta->widthForTable = '300px';
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
	
	
	///////////////////////////////////////////////////////////
	// Functions For This Module
	
}

// Init
$mmAPIRequestsT = new moduleMetaAPIRequestsT();
define( 'MM_APIREQUESTS_T', 'MM_APIREQUESTS_T' );
$mm[ MM_APIREQUESTS_T ] = &$mmAPIRequestsT;
?>