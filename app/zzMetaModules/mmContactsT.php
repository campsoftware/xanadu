<?php

class moduleMetaContactsT extends \xan\moduleMeta {
	// Constructor
	public function __construct() {
		parent::__construct();
		$this->NameModule = 'Contacts';
		$this->NameModuleLower = strtolower( $this->NameModule );
		$this->NameTable = 'Contacts';
		$this->NameTableKey = 'UUIDContacts';
		$this->NameTableParam = \xan\strSubstitute( $this->NameTableKey, 'UU', '' );
		
		// QueryBuilder Operators: equal, not_equal, in, not_in, less, less_or_equal, greater, greater_or_equal, between, not_between, begins_with, not_begins_with, contains, not_contains, ends_with, not_ends_with, is_empty, is_not_empty, is_null, is_not_null
		$this->QuerySimpleDefault = array( 'NameCompany', 'NameFirst', 'NameLast' );
		$this->QueryBuilderDefault = '{ field: "Contacts.NameCompany", id: "querybuilder_Contacts_NameCompany", operator: "begins_with", value: "" }';
		
		$this->QueryOrderByDefault = 'NameCompany ASC, NameLast ASC, NameFirst ASC';
		$this->QueryOrderByExtraBegin .= \xan\dbQueryOrderByItem( $this->NameTable, 'NameCompany ASC, NameLast ASC, NameFirst ASC', 'NameCompany DESC, NameLast DESC, NameFirst DESC', 'Company, Last, First' );
		$this->QueryOrderByExtraBegin .= '<hr />';
		
		$this->NamePlural = 'Contacts';
		$this->NameSingular = 'Contact';
		
		$this->FontAwesome = \xan\fontIcon( 'fas fa-user' );
		$this->FontAwesomeList = FI_LIST;
		
		$this->URLRelative = '/' . 'contacts/';
		$this->URLFull = URL_BASE . 'contacts/';
		
		$this->URLDoRelative = '/' . 'contacts-do/';
		$this->URLDoFull = URL_BASE . 'contacts-do/';
	}
	
	
	///////////////////////////////////////////////////////////
	// Abstract Functions Required by \xan\moduleMeta
	
	public function getDisplayName( \xan\recs $recs ) {
		// Name
		$code = trim( $recs->rowsD[ $recs->rowIndex ][ 'NameFirst' ] . " " . $recs->rowsD[ $recs->rowIndex ][ 'NameLast' ] );
		
		// Company
		$code .= ( \xan\isNotEmpty( $code ) && \xan\isNotEmpty( $recs->rowsD[ $recs->rowIndex ][ 'NameCompany' ] ) ? ', ' : '' );
		$code .= trim( $recs->rowsD[ $recs->rowIndex ][ 'NameCompany' ] );
		
		$code = trim( $code );
		return $code;
	}
	
	public function getDisplayList( \xan\recs $recs ) {
		// Name
		$code = $this->getDisplayName( $recs );
		// More
		$code .= ( \xan\isEmpty( $recs->rowsD[ $recs->rowIndex ][ 'Status' ] ) ? '' : ', ' . $recs->rowsD[ $recs->rowIndex ][ 'Status' ] );
		$code .= ( \xan\isEmpty( $recs->rowsD[ $recs->rowIndex ][ 'Type' ] ) ? '' : ', ' . $recs->rowsD[ $recs->rowIndex ][ 'Type' ] );
		
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
			case 'NameCompany':
				$colMeta->colLabelEN = 'Company';
				break;
			case 'NameTitle':
				$colMeta->colLabelEN = 'Title';
				break;
			case 'NamePrefix':
				$colMeta->colLabelEN = 'Prefix';
				$colMeta->eleType = ELE_TYPE_SELECT_DB;
				$arrays = \xan\choicesAFromSQLCols( $this->NameTable, "SELECT DISTINCT `NamePrefix` From Contacts WHERE LENGTH( `NamePrefix` ) > 0 ORDER BY `NamePrefix` ASC" );
				$colMeta->choicesAValues = $arrays[ 0 ];
				$colMeta->choicesADisplay = $arrays[ 0 ];
				break;
			case 'NameFirst':
				$colMeta->colLabelEN = 'First Name';
				break;
			case 'NameMiddle':
				$colMeta->colLabelEN = 'Middle Name';
				break;
			case 'NameLast':
				$colMeta->colLabelEN = 'Last Name';
				break;
			case 'NameSuffix':
				$colMeta->colLabelEN = 'Suffix';
				$colMeta->eleType = ELE_TYPE_SELECT_DB;
				$arrays = \xan\choicesAFromSQLCols( $this->NameTable, "SELECT DISTINCT `NameSuffix` From Contacts WHERE LENGTH( `NameSuffix` ) > 0 ORDER BY `NameSuffix` ASC" );
				$colMeta->choicesAValues = $arrays[ 0 ];
				$colMeta->choicesADisplay = $arrays[ 0 ];
				break;
			
			case 'PhotoFN':
				$colMeta->colLabelEN = 'Photo';
				$colMeta->eleType = ELE_TYPE_FILE_BUCKET_IMAGE_DB;
				break;
			
			case 'Active':
				$colMeta->colLabelEN = 'Active';
				$colMeta->eleType = ELE_TYPE_SELECT_DB;
				$colMeta->choicesAValues = ARRAY_YESNO;
				$colMeta->choicesADisplay = ARRAY_YESNO;
				$colMeta->choicesOtherLabel = '';
				break;
			case 'Status':
				$colMeta->colLabelEN = 'Status';
				$colMeta->eleType = ELE_TYPE_SELECT_DB;
				$arrays = \xan\choicesAFromSQLCols( $this->NameTable, "SELECT DISTINCT `Status` From Contacts WHERE LENGTH( `Status` ) > 0 ORDER BY `Status` ASC" );
				$colMeta->choicesAValues = $arrays[ 0 ];
				$colMeta->choicesADisplay = $arrays[ 0 ];
				break;
			case 'Type':
				$colMeta->colLabelEN = 'Type';
				$colMeta->eleType = ELE_TYPE_SELECT_DB;
				$arrays = \xan\choicesAFromSQLCols( $this->NameTable, "SELECT DISTINCT `Type` From Contacts WHERE LENGTH( `Type` ) > 0 ORDER BY `Type` ASC" );
				$colMeta->choicesAValues = $arrays[ 0 ];
				$colMeta->choicesADisplay = $arrays[ 0 ];
				break;
			case 'DaysToPay':
				$colMeta->colLabelEN = 'Days To Pay';
				$colMeta->eleType = ELE_TYPE_SELECT_DB;
				$colMeta->choicesAValues = ARRAY_DAYSTOPAY;
				$colMeta->choicesADisplay = ARRAY_DAYSTOPAY;
				$colMeta->choicesOtherLabel = '';
				break;
			case 'State':
				$colMeta->colLabelEN = 'Home State';
				$colMeta->eleType = ELE_TYPE_TEXTTYPEAHEAD_DB;
				$colMeta->choicesAValues = ARRAY_STATES_ABBREV;
				break;
			case 'Source':
				$colMeta->colLabelEN = 'Source';
				$colMeta->eleType = ELE_TYPE_SELECT_DB;
				$arrays = \xan\choicesAFromSQLCols( $this->NameTable, "SELECT DISTINCT `Source` From Contacts WHERE LENGTH( `Source` ) > 0 ORDER BY `Source` ASC" );
				$colMeta->choicesAValues = $arrays[ 0 ];
				$colMeta->choicesADisplay = $arrays[ 0 ];
				break;
			
			case 'Notes':
				$colMeta->colLabelEN = 'Notes';
				$colMeta->eleType = ELE_TYPE_TEXTAREA_DB;
				break;
			case 'ContactedDate':
				$colMeta->colLabelEN = 'Contacted Date';
				$colMeta->eleType = ELE_TYPE_DATE_DB;
				break;
			case 'TimeOpen':
				$colMeta->colLabelEN = 'Time Open';
				$colMeta->eleType = ELE_TYPE_TIME_DB;
				break;
			case 'TimeClosed':
				$colMeta->colLabelEN = 'Time Closed';
				$colMeta->eleType = ELE_TYPE_TIME_DB;
				break;
			case 'FollowUpTS':
				$colMeta->colLabelEN = 'Follow Up At';
				$colMeta->eleType = ELE_TYPE_DATETIME_DB;
				break;
			case 'FollowUpAction':
				$colMeta->colLabelEN = 'Follow Up Action';
				break;
			case 'NumberInteger':
				$colMeta->colLabelEN = 'Number Integer';
				break;
			case 'NumberDecimal':
				$colMeta->colLabelEN = 'Number Decimal';
				break;
			case 'NumberCurrency':
				$colMeta->colLabelEN = 'Number Currency';
				$colMeta->eleFormatAs = ELE_FORMAT_CURRENCY;
				break;
			
			// Mod
			case 'ModTS':
				$colMeta->colLabelEN = 'Mod TS';
				$colMeta->eleType = ELE_TYPE_DATETIME_DB;
				$colMeta->isMod = true;
				break;
			case 'ModName':
				$colMeta->colLabelEN = 'Mod Name';
				$colMeta->isMod = true;
				break;
			case 'ModUUIDUsers':
				$colMeta->colLabelEN = 'Mod Users ID';
				$colMeta->isMod = true;
				$colMeta->isKey = true;
				break;
			
			// UUID
			case 'UUIDContacts':
				$colMeta->colLabelEN = 'Contacts ID';
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
$mmContactsT = new moduleMetaContactsT();
define( 'MM_CONTACTS_T', 'MM_CONTACTS_T' );
$mm[ MM_CONTACTS_T ] = &$mmContactsT;
?>