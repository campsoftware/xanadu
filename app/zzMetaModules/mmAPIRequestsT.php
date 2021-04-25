<?php

class moduleMetaAPIRequestsT extends \xan\moduleMeta {
	// Constructor
	public function __construct() {
		parent::__construct();
		$this->NameModule = 'APIRequests';
		$this->NameModuleLower = strtolower( $this->NameModule );
		$this->NameTable = 'APIRequests';
		$this->NameTableKey = 'UUIDAPIRequests';
		
		// QueryBuilder Operators: equal, not_equal, in, not_in, less, less_or_equal, greater, greater_or_equal, between, not_between, begins_with, not_begins_with, contains, not_contains, ends_with, not_ends_with, is_empty, is_not_empty, is_null, is_not_null
		// $this->QuerySimpleDefault = array( 'NameCompany', 'NameLast', 'NameFirst', 'EmailAddress', 'PhoneWork', 'PhoneMobile' );
		// $this->QueryBuilderDefault = '{ field: "Users.NameFirst", id: "querybuilder_Users_NameFirst", operator: "begins_with", value: "" }';
		//
		// $this->QueryOrderByDefault = 'Active DESC, PrivAdmin DESC, NameLast ASC, NameFirst ASC';
		// $this->QueryOrderByExtraBegin .= \xan\dbQueryOrderByItem( $this->NameTable, 'Active DESC, PrivAdmin DESC, NameLast ASC, NameFirst ASC', 'Active ASC, PrivAdmin ASC, NameLast ASC, NameFirst ASC', 'Admin, Active' );
		// $this->QueryOrderByExtraBegin .= '<hr />';
		
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
	
	public function getDisplayList( \xan\recs $recs ) {
		$code = $this->getDisplayName( $recs );
		$code = trim( $code );
		return $code;
	}
	
	public function getDisplayName( \xan\recs $recs ) {
		$code = '';
		$code = trim( $code );
		return $code;
	}
	
	public function getListItem( $idPrefix, \xan\recs $recs, $onClick ) {
		$code = '';
		return $code;
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
			case 'Active':
				$colMeta->colLabelEN = 'Active';
				$colMeta->eleType = ELE_TYPE_SELECT_DB;
				$colMeta->choicesAValues = ARRAY_YESNO;
				$colMeta->choicesADisplay = ARRAY_YESNO;
				$colMeta->choicesOtherLabel = '';
				break;
			
			// App
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
				$colMeta->colLabelEN = 'Is Processed';
				$colMeta->eleType = ELE_TYPE_SELECT_DB;
				$colMeta->choicesAValues = ARRAY_YESNO;
				$colMeta->choicesADisplay = ARRAY_YESNO;
				$colMeta->choicesOtherLabel = '';
				break;
			case 'RequestIsSent':
				$colMeta->colLabelEN = 'Is Sent';
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
				break;
			case 'ResponseTS':
				$colMeta->colLabelEN = 'Response TS';
				$colMeta->eleType = ELE_TYPE_DATETIME_DB;
				break;
			case 'ResponseData':
				$colMeta->colLabelEN = 'Response Data';
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