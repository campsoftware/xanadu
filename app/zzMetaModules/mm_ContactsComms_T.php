<?php

class moduleMetaContactsCommsT extends xan\moduleMeta {
	// Constructor
	public function __construct() {
		parent::__construct();
		$this->NameModule = 'ContactsComms';
		$this->NameModuleLower = strtolower( $this->NameModule );
		$this->NameTable = 'ContactsComms';
		$this->NameTableKey = 'UUIDContactsComms';
		
		// QueryBuilder Operators: equal, not_equal, in, not_in, less, less_or_equal, greater, greater_or_equal, between, not_between, begins_with, not_begins_with, contains, not_contains, ends_with, not_ends_with, is_empty, is_not_empty, is_null, is_not_null
		// $this->QuerySimpleDefault = array( 'NameCompany', 'NameFirst', 'NameLast' );
		// $this->QueryBuilderDefault = '{ field: "Contacts.NameCompany", id: "querybuilder_Contacts_NameCompany", operator: "begins_with", value: "" }';
		//
		// $this->QueryOrderByDefault = 'NameCompany ASC, NameLast ASC, NameFirst ASC';
		// $this->QueryOrderByExtraBegin .= xan\dbQueryOrderByItem( $this->NameTable, 'NameCompany ASC, NameLast ASC, NameFirst ASC', 'NameCompany DESC, NameLast DESC, NameFirst DESC', 'Company, Last, First' );
		// $this->QueryOrderByExtraBegin .= '<hr />';
		
		$this->NamePlural = 'Comms';
		$this->NameSingular = 'Comm';
		
		$this->FontAwesome = '<i class=\'fas fa-comment-dots\'></i>';
		$this->FontAwesomeList = FA_LIST;
		
		// $this->URLRelative = '/' . 'contacts/';
		// $this->URLFull = URL_BASE . 'contacts/';
		
		// $this->URLDoRelative = '/' . 'contacts-do/';
		// $this->URLDoFull = URL_BASE . 'contacts-do/';
	}
	
	
	///////////////////////////////////////////////////////////
	// Functions Required by xan\moduleMeta
	
	public function getDisplayList( xan\recs $recs ) {
		$code = $this->getDisplayName( $recs );
		$code = trim( $code );
		return $code;
	}
	
	public function getDisplayName( xan\recs $recs ) {
		$code = '';
		$code = trim( $code );
		return $code;
	}
	
	public function getListItem( $idPrefix, xan\recs $recs, $onClick ) {
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
		$colEle = new \xan\colMeta();
		$colEle->eleType = ELE_TYPE_TEXT_DB; // Default to Text Input
		$colEle->eleTypeAs = $typeAs;
		$colEle->colName = $colName;
		$colEle->colLabelEN = $colEle->colName;
		$colEle->colLabel = $colEle->colName;
		
		// Choices
		$colEle->choicesAValues = [];
		$colEle->choicesADisplay = [];
		$colEle->choicesClearLabel = STR_CLEAR; // Add Clear
		$colEle->choicesOtherLabel = STR_OTHER; // Add Other
		
		// Columns Specifics
		switch ( $colName ) {
			case 'Type':
				$colEle->colLabelEN = 'Type';
				$colEle->eleType = ELE_TYPE_SELECT_DB;
				$arrays = xan\choicesAFromSQLCols( $this->NameTable, "SELECT DISTINCT `Type` From ContactsComms WHERE LENGTH( `Type` ) > 0 ORDER BY `Type` ASC" );
				$colEle->choicesAValues = $arrays[ 0 ];
				$colEle->choicesADisplay = $arrays[ 0 ];
				break;
			case 'Label':
				$colEle->colLabelEN = 'Label';
				$colEle->eleType = ELE_TYPE_SELECT_DB;
				$arrays = xan\choicesAFromSQLCols( $this->NameTable, "SELECT DISTINCT `Label` From ContactsComms WHERE LENGTH( `Label` ) > 0 ORDER BY `Label` ASC" );
				$colEle->choicesAValues = $arrays[ 0 ];
				$colEle->choicesADisplay = $arrays[ 0 ];
				break;
			case 'Main':
				$colEle->colLabelEN = 'Main';
				$colEle->eleType = ELE_TYPE_SELECT_DB;
				$colEle->choicesAValues = ARRAY_YESNO;
				$colEle->choicesADisplay = ARRAY_YESNO;
				$colEle->choicesOtherLabel = '';
				break;
			case 'Data':
				$colEle->colLabelEN = 'Data';
				break;
			case 'AddressStreet':
				$colEle->colLabelEN = 'Street';
				break;
			case 'AddressCity':
				$colEle->colLabelEN = 'City';
				break;
			case 'AddressState':
				$colEle->colLabelEN = 'State';
				break;
			case 'AddressZip':
				$colEle->colLabelEN = 'Zip';
				break;
			case 'AddressCounty':
				$colEle->colLabelEN = 'County';
				break;
			case 'AddressCountry':
				$colEle->colLabelEN = 'Country';
				break;
			case 'AddressLatitude':
				$colEle->colLabelEN = 'Latitude';
				break;
			case 'AddressLongitude':
				$colEle->colLabelEN = 'Longitude';
				break;
			
			// Mod
			case 'ModTS':
				$colEle->colLabelEN = 'Mod TS';
				$colEle->isMod = true;
				break;
			case 'ModName':
				$colEle->colLabelEN = 'Mod Name';
				$colEle->isMod = true;
				break;
			case 'ModUUIDUsers':
				$colEle->colLabelEN = 'Mod Users ID';
				$colEle->isMod = true;
				$colEle->isKey = true;
				break;
			
			// UUID
			case 'UUIDContactsComms':
				$colEle->colLabelEN = 'Comms ID';
				$colEle->isKey = true;
				$colEle->isKeyPrimary = true;
				$colEle->isKeyForeign = false;
				break;
			case 'UUIDContacts':
				$colEle->colLabelEN = 'Contacts ID';
				$colEle->isKey = true;
				$colEle->isKeyPrimary = false;
				$colEle->isKeyForeign = true;
				break;
			case 'UUIDTenants':
				$colEle->colLabelEN = 'Tenants ID';
				$colEle->isKey = true;
				$colEle->isKeyPrimary = false;
				$colEle->isKeyForeign = true;
				break;
		}
		
		// Set the Label
		$colEle->colLabel = $colEle->colLabelEN;
		
		// Return the Element
		return $colEle;
	}
	
	public function getColEleRender( $colName, $typeAs, xan\tags $tags, xan\recs $recs, xan\formTag $formTag, xan\response &$resp ) {
		// Get Col Ele Meta
		$colEle = $this->getColMeta( $colName, $typeAs );
		$code = xan\eleDBMetaRender( $colEle, $tags, $recs, $formTag, $resp );
		return $code;
	}
	
	
	///////////////////////////////////////////////////////////
	// Functions For This Module
	
	public function getURL( xan\recs $recs ) {
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
	
	public function getAddress( xan\recs $recs, $format ) {
		$return = '';
		$row = $recs->rowsD[ $recs->rowIndex ];
		
		if ( $format == 'PostalWithAll' ) {
			$return .= ( xan\isEmpty( $row[ 'AddressStreet' ] ) ? '' : $row[ 'AddressStreet' ] . STR_BR );
			$return .= ( xan\isEmpty( $row[ 'AddressCity' ] ) ? '' : $row[ 'AddressCity' ] . ', ' );
			$return .= ( xan\isEmpty( $row[ 'AddressState' ] ) ? '' : $row[ 'AddressState' ] . ' ' );
			$return .= ( xan\isEmpty( $row[ 'AddressZip' ] ) ? '' : $row[ 'AddressZip' ] . STR_BR );
			$return .= ( xan\isEmpty( $row[ 'AddressCounty' ] ) ? '' : $row[ 'AddressCounty' ] . ', ' );
			$return .= ( xan\isEmpty( $row[ 'AddressCountry' ] ) ? '' : $row[ 'AddressCountry' . STR_BR ] );
			$return .= ( xan\isEmpty( $row[ 'AddressLatitude' ] ) ? '' : $row[ 'AddressLatitude' . ', ' ] );
			$return .= ( xan\isEmpty( $row[ 'AddressLongitude' ] ) ? '' : $row[ 'AddressLongitude' ] );
		}
		if ( $format == 'PostalShort' ) {
			$return .= ( xan\isEmpty( $row[ 'AddressStreet' ] ) ? '' : $row[ 'AddressStreet' ] . STR_BR );
			$return .= ( xan\isEmpty( $row[ 'AddressCity' ] ) ? '' : $row[ 'AddressCity' ] . ', ' );
			$return .= ( xan\isEmpty( $row[ 'AddressState' ] ) ? '' : $row[ 'AddressState' ] . ' ' );
			$return .= ( xan\isEmpty( $row[ 'AddressZip' ] ) ? '' : $row[ 'AddressZip' ] );
		}
		if ( $format == 'LineWithAll' ) {
			$return .= $row[ 'AddressStreet' ];
			$return .= ( xan\isNotEmpty( $return ) && xan\isNotEmpty( $row[ 'AddressCity' ] ) ? ', ' : '' ) . $row[ 'AddressCity' ];
			$return .= ( xan\isNotEmpty( $return ) && xan\isNotEmpty( $row[ 'AddressState' ] ) ? ', ' : '' ) . $row[ 'AddressState' ];
			$return .= ( xan\isNotEmpty( $return ) && xan\isNotEmpty( $row[ 'AddressZip' ] ) ? '  ' : '' ) . $row[ 'AddressZip' ];
			$return .= ( xan\isNotEmpty( $return ) && xan\isNotEmpty( $row[ 'AddressCounty' ] ) ? ', ' : '' ) . $row[ 'AddressCounty' ];
			$return .= ( xan\isNotEmpty( $return ) && xan\isNotEmpty( $row[ 'AddressCountry' ] ) ? ', ' : '' ) . $row[ 'AddressCountry' ];
			$return .= ( xan\isNotEmpty( $return ) && xan\isNotEmpty( $row[ 'AddressLatitude' ] ) ? ', ' : '' ) . $row[ 'AddressLatitude' ];
			$return .= ( xan\isNotEmpty( $return ) && xan\isNotEmpty( $row[ 'AddressLongitude' ] ) ? ', ' : '' ) . $row[ 'AddressLongitude' ];
		}
		return $return;
	}
	
}

// Init
$mmContactsCommsT = new moduleMetaContactsCommsT();
define( 'MM_CONTACTSCOMMS_T', 'MM_CONTACTSCOMMS_T' );
$mm[ MM_CONTACTSCOMMS_T ] = &$mmContactsCommsT;
?>