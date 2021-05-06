<?php

class moduleMetaContactsCommsT extends \xan\moduleMeta {
	// Constructor
	public function __construct() {
		parent::__construct();
		$this->NameModule = 'ContactsComms';
		$this->NameModuleLower = strtolower( $this->NameModule );
		$this->NameTable = 'ContactsComms';
		$this->NameTableKey = 'UUIDContactsComms';
		$this->NameTableParam = \xan\strSubstitute( $this->NameTableKey, 'UU', '' );
		
		// QueryBuilder Operators: equal, not_equal, in, not_in, less, less_or_equal, greater, greater_or_equal, between, not_between, begins_with, not_begins_with, contains, not_contains, ends_with, not_ends_with, is_empty, is_not_empty, is_null, is_not_null
		// $this->QuerySimpleDefault = array( 'NameCompany', 'NameFirst', 'NameLast' );
		// $this->QueryBuilderDefault = '{ field: "Contacts.NameCompany", id: "querybuilder_Contacts_NameCompany", operator: "begins_with", value: "" }';
		//
		// $this->QueryOrderByDefault = 'NameCompany ASC, NameLast ASC, NameFirst ASC';
		// $this->QueryOrderByExtraBegin .= \xan\dbQueryOrderByItem( $this->NameTable, 'NameCompany ASC, NameLast ASC, NameFirst ASC', 'NameCompany DESC, NameLast DESC, NameFirst DESC', 'Company, Last, First' );
		// $this->QueryOrderByExtraBegin .= '<hr />';
		
		$this->NamePlural = 'Comms';
		$this->NameSingular = 'Comm';
		
		$this->FontAwesome = \xan\fontIcon( 'fas fa-comment-dots' );
		$this->FontAwesomeList = FI_LIST;
		
		// $this->URLRelative = '/' . 'contacts/';
		// $this->URLFull = URL_BASE . 'contacts/';
		
		// $this->URLDoRelative = '/' . 'contacts-do/';
		// $this->URLDoFull = URL_BASE . 'contacts-do/';
	}
	
	
	///////////////////////////////////////////////////////////
	// Abstract Functions Required by \xan\moduleMeta
	
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
	
	public function getColMeta( $colName, $typeAs = ELE_AS_DEFINED ) {
		// Init
		$colMeta = new \xan\colMeta();
		$colMeta->eleType = ELE_TYPE_TEXT_DB; // Default to Text Input
		$colMeta->eleTypeAs = $typeAs;
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
			case 'Type':
				$colMeta->colLabelEN = 'Type';
				$colMeta->eleType = ELE_TYPE_SELECT_DB;
				$arrays = \xan\choicesAFromSQLCols( $this->NameTable, "SELECT DISTINCT `Type` From ContactsComms WHERE LENGTH( `Type` ) > 0 ORDER BY `Type` ASC" );
				$colMeta->choicesAValues = $arrays[ 0 ];
				$colMeta->choicesADisplay = $arrays[ 0 ];
				break;
			case 'Label':
				$colMeta->colLabelEN = 'Label';
				$colMeta->eleType = ELE_TYPE_SELECT_DB;
				$arrays = \xan\choicesAFromSQLCols( $this->NameTable, "SELECT DISTINCT `Label` From ContactsComms WHERE LENGTH( `Label` ) > 0 ORDER BY `Label` ASC" );
				$colMeta->choicesAValues = $arrays[ 0 ];
				$colMeta->choicesADisplay = $arrays[ 0 ];
				break;
			case 'Main':
				$colMeta->colLabelEN = 'Main';
				$colMeta->eleType = ELE_TYPE_SELECT_DB;
				$colMeta->choicesAValues = ARRAY_YESNO;
				$colMeta->choicesADisplay = ARRAY_YESNO;
				$colMeta->choicesOtherLabel = '';
				break;
			case 'Data':
				$colMeta->colLabelEN = 'Data';
				break;
			case 'AddressStreet':
				$colMeta->colLabelEN = 'Street';
				break;
			case 'AddressCity':
				$colMeta->colLabelEN = 'City';
				break;
			case 'AddressState':
				$colMeta->colLabelEN = 'State';
				break;
			case 'AddressZip':
				$colMeta->colLabelEN = 'Zip';
				break;
			case 'AddressCounty':
				$colMeta->colLabelEN = 'County';
				break;
			case 'AddressCountry':
				$colMeta->colLabelEN = 'Country';
				break;
			case 'AddressLatitude':
				$colMeta->colLabelEN = 'Latitude';
				break;
			case 'AddressLongitude':
				$colMeta->colLabelEN = 'Longitude';
				break;
			
			// Mod
			case 'ModTS':
				$colMeta->colLabelEN = 'Mod TS';
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
			case 'UUIDContactsComms':
				$colMeta->colLabelEN = 'Comms ID';
				$colMeta->isKey = true;
				$colMeta->isKeyPrimary = true;
				$colMeta->isKeyForeign = false;
				break;
			case 'UUIDContacts':
				$colMeta->colLabelEN = 'Contacts ID';
				$colMeta->isKey = true;
				$colMeta->isKeyPrimary = false;
				$colMeta->isKeyForeign = true;
				break;
		}
		
		// Set the Label
		$colMeta->colLabel = $colMeta->colLabelEN;
		
		// Return the Element
		return $colMeta;
	}
	
	
	///////////////////////////////////////////////////////////
	// Functions For This Module
	
	public function getURL( \xan\recs $recs ) {
		$url = '';
		$row = $recs->rowsD[ $recs->rowIndex ];
		
		if ( $row[ 'Type' ] == 'Address' ) {
			$params = $this->getAddress( $recs, 'LineWithAll' );
			$params = str_replace( ' ', '+', $params );
			$url = 'https://www.google.com/maps/place/' . $params;
		}
		if ( $row[ 'Type' ] == 'Email' ) {
			$url = 'mailto:' . $row[ 'Data' ];
		}
		if ( $row[ 'Type' ] == 'Phone' ) {
			$url = 'tel:' . $row[ 'Data' ];
		}
		if ( $row[ 'Type' ] == 'Web' ) {
			$url = $row[ 'Data' ];
			$url = ( strpos( $url, '://' ) === false ? 'https://' : '' ) . $url;
		}
		return $url;
	}
	
	public function getAddress( \xan\recs $recs, $format ) {
		$return = '';
		$row = $recs->rowsD[ $recs->rowIndex ];
		
		if ( $format == 'PostalWithAll' ) {
			$return .= ( \xan\isEmpty( $row[ 'AddressStreet' ] ) ? '' : $row[ 'AddressStreet' ] . STR_BR );
			$return .= ( \xan\isEmpty( $row[ 'AddressCity' ] ) ? '' : $row[ 'AddressCity' ] . ', ' );
			$return .= ( \xan\isEmpty( $row[ 'AddressState' ] ) ? '' : $row[ 'AddressState' ] . ' ' );
			$return .= ( \xan\isEmpty( $row[ 'AddressZip' ] ) ? '' : $row[ 'AddressZip' ] . STR_BR );
			$return .= ( \xan\isEmpty( $row[ 'AddressCounty' ] ) ? '' : $row[ 'AddressCounty' ] . ', ' );
			$return .= ( \xan\isEmpty( $row[ 'AddressCountry' ] ) ? '' : $row[ 'AddressCountry' . STR_BR ] );
			$return .= ( \xan\isEmpty( $row[ 'AddressLatitude' ] ) ? '' : $row[ 'AddressLatitude' . ', ' ] );
			$return .= ( \xan\isEmpty( $row[ 'AddressLongitude' ] ) ? '' : $row[ 'AddressLongitude' ] );
		}
		if ( $format == 'PostalShort' ) {
			$return .= ( \xan\isEmpty( $row[ 'AddressStreet' ] ) ? '' : $row[ 'AddressStreet' ] . STR_BR );
			$return .= ( \xan\isEmpty( $row[ 'AddressCity' ] ) ? '' : $row[ 'AddressCity' ] . ', ' );
			$return .= ( \xan\isEmpty( $row[ 'AddressState' ] ) ? '' : $row[ 'AddressState' ] . ' ' );
			$return .= ( \xan\isEmpty( $row[ 'AddressZip' ] ) ? '' : $row[ 'AddressZip' ] );
		}
		if ( $format == 'LineWithAll' ) {
			$return .= $row[ 'AddressStreet' ];
			$return .= ( \xan\isNotEmpty( $return ) && \xan\isNotEmpty( $row[ 'AddressCity' ] ) ? ', ' : '' ) . $row[ 'AddressCity' ];
			$return .= ( \xan\isNotEmpty( $return ) && \xan\isNotEmpty( $row[ 'AddressState' ] ) ? ', ' : '' ) . $row[ 'AddressState' ];
			$return .= ( \xan\isNotEmpty( $return ) && \xan\isNotEmpty( $row[ 'AddressZip' ] ) ? '  ' : '' ) . $row[ 'AddressZip' ];
			$return .= ( \xan\isNotEmpty( $return ) && \xan\isNotEmpty( $row[ 'AddressCounty' ] ) ? ', ' : '' ) . $row[ 'AddressCounty' ];
			$return .= ( \xan\isNotEmpty( $return ) && \xan\isNotEmpty( $row[ 'AddressCountry' ] ) ? ', ' : '' ) . $row[ 'AddressCountry' ];
			$return .= ( \xan\isNotEmpty( $return ) && \xan\isNotEmpty( $row[ 'AddressLatitude' ] ) ? ', ' : '' ) . $row[ 'AddressLatitude' ];
			$return .= ( \xan\isNotEmpty( $return ) && \xan\isNotEmpty( $row[ 'AddressLongitude' ] ) ? ', ' : '' ) . $row[ 'AddressLongitude' ];
		}
		return $return;
	}
	
}

// Init
$mmContactsCommsT = new moduleMetaContactsCommsT();
define( 'MM_CONTACTSCOMMS_T', 'MM_CONTACTSCOMMS_T' );
$mm[ MM_CONTACTSCOMMS_T ] = &$mmContactsCommsT;
?>