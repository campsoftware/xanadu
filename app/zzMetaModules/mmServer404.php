<?php

class moduleMetaServer404 extends \xan\moduleMeta {
	// Constructor
	public function __construct() {
		parent::__construct();
		$this->NameModule = '404 Resource Not Found';
		$this->NameModuleLower = strtolower( $this->NameModule );
		$this->NameTable = '';
		$this->NameTableKey = '';
		$this->NameTableParam = \xan\strSubstitute( $this->NameTableKey, 'UU', '' );
		
		// QueryBuilder Operators: equal, not_equal, in, not_in, less, less_or_equal, greater, greater_or_equal, between, not_between, begins_with, not_begins_with, contains, not_contains, ends_with, not_ends_with, is_empty, is_not_empty, is_null, is_not_null
		// $this->QuerySimpleDefault = array( 'NameCompany', 'NameFirst', 'NameLast' );
		// $this->QueryBuilderDefault = '{ field: "Contacts.NameCompany", id: "querybuilder_Contacts_NameCompany", operator: "begins_with", value: "" }';
		//
		// $this->QueryOrderByDefault = 'NameCompany ASC, NameLast ASC, NameFirst ASC';
		// $this->QueryOrderByExtraBegin .= \xan\dbQueryOrderByItem( $this->NameTable, 'NameCompany ASC, NameLast ASC, NameFirst ASC', 'NameCompany DESC, NameLast DESC, NameFirst DESC', 'Company, Last, First' );
		// $this->QueryOrderByExtraBegin .= '<hr />';
		
		$this->NamePlural = '404 Resource Not Found';
		$this->NameSingular = '404 Resource Not Found';
		
		$this->FontAwesome = '<i class=\'fas fa-exclamation-triangle\'></i>';
		$this->FontAwesomeList = FA_LIST;
		
		// $this->URLRelative = '/' . '404/';
		// $this->URLFull = URL_BASE . '404/';
		
		// $this->URLDoRelative = '/' . '404-do/';
		// $this->URLDoFull = URL_BASE . '404-do/';
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
			case 'NULL':
				$colEle->colLabelEN = 'NULL';
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
$mmServer404 = new moduleMetaServer404();
define( 'MM_SERVER_404', 'MM_SERVER_404' );
$mm[ MM_SERVER_404 ] = &$mmServer404;
?>