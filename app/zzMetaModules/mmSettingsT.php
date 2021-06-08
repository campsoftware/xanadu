<?php

class moduleMetaSettingsT extends \xan\moduleMeta {
	// Constructor
	public function __construct() {
		parent::__construct();
		$this->NameModule = 'Settings';
		$this->NameModuleLower = strtolower( $this->NameModule );
		$this->NameTable = 'Settings';
		$this->NameTableKey = 'UUIDSettings';
		$this->NameTableParam = \xan\strSubstitute( $this->NameTableKey, 'UU', '' );
		
		// QueryBuilder Operators: equal, not_equal, in, not_in, less, less_or_equal, greater, greater_or_equal, between, not_between, begins_with, not_begins_with, contains, not_contains, ends_with, not_ends_with, is_empty, is_not_empty, is_null, is_not_null
		// $this->QuerySimpleDefault = array( 'NameCompany', 'NameLast', 'NameFirst', 'EmailAddress', 'PhoneWork', 'PhoneMobile' );
		// $this->QueryBuilderDefault = '{ field: "Users.NameFirst", id: "querybuilder_Users_NameFirst", operator: "begins_with", value: "" }';
		//
		// $this->QueryOrderByDefault = 'Active DESC, PrivAdmin DESC, NameLast ASC, NameFirst ASC';
		// $this->QueryOrderByExtraBegin .= \xan\dbQueryOrderByItem( $this->NameTable, 'Active DESC, PrivAdmin DESC, NameLast ASC, NameFirst ASC', 'Active ASC, PrivAdmin ASC, NameLast ASC, NameFirst ASC', 'Admin, Active' );
		// $this->QueryOrderByExtraBegin .= '<hr />';
		
		$this->NamePlural = 'Settings';
		$this->NameSingular = 'Setting';
		
		$this->FontIcon = \xan\fontIcon( 'fas fa-cog' );
		$this->FontIconList = FI_LIST;
		
		$this->URLRelative = '/' . 'settings/';
		$this->URLFull = URL_BASE . 'settings/';
		
		$this->URLDoRelative = '/' . 'settings-do/';
		$this->URLDoFull = URL_BASE . 'settings-do/';
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
		$colMeta->eleFormatAs = '';
		$colMeta->eleAlign = 'left';
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
			case 'Active':
				$colMeta->colLabelEN = 'Active';
				$colMeta->eleType = ELE_TYPE_SELECT_DB;
				$colMeta->choicesAValues = ARRAY_YESNO;
				$colMeta->choicesADisplay = ARRAY_YESNO;
				$colMeta->choicesOtherLabel = '';
				break;
				
			// App
			case 'AppName':
				$colMeta->colLabelEN = 'App Name';
				break;
			case 'AppIconURL50':
				$colMeta->colLabelEN = 'App Icon URL 50x50';
				break;
			case 'AppIconURL1024':
				$colMeta->colLabelEN = 'App Icon URL 1024x1024';
				break;
			case 'AppIconURLLink':
				$colMeta->colLabelEN = 'App Icon URL Link';
				break;
			case 'AppEmailFrom':
				$colMeta->colLabelEN = 'App Email From';
				break;
				
			// Locale
			case 'AppLangCode':
				$colMeta->colLabelEN = 'App Language Code';
				break;
			case 'AppCountryCode':
				$colMeta->colLabelEN = 'App Country Code';
				break;
			case 'AppTimezoneID':
				$colMeta->colLabelEN = 'App TimeZone ID';
				break;
			case 'AppCurrency':
				$colMeta->colLabelEN = 'App Currency';
				break;
			
			// Contact 1
			case 'PhoneNumber':
				$colMeta->colLabelEN = 'Phone Number';
				break;
			case 'EmailAddress':
				$colMeta->colLabelEN = 'Email Address';
				break;
			case 'TwitterSite':
				$colMeta->colLabelEN = 'Twitter Site';
				break;
			case 'TwitterAuthor':
				$colMeta->colLabelEN = 'Twitter Author';
				break;
				
			// Contact 2
			case 'AddressStreet1':
				$colMeta->colLabelEN = 'Street 1';
				break;
			case 'AddressStreet2':
				$colMeta->colLabelEN = 'Street 2';
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
			case 'AddressLatitude':
				$colMeta->colLabelEN = 'Latitude';
				$colMeta->eleAlign = 'right';
				break;
			case 'AddressLongitude':
				$colMeta->colLabelEN = 'Longitude';
				$colMeta->eleAlign = 'right';
				break;
				
			// Features
			case 'LogoutAutoSeconds':
				$colMeta->colLabelEN = 'Auto Logout Seconds';
				$colMeta->eleAlign = 'right';
				break;
				
			// Formats
			case 'FormatDisplayDate':
				$colMeta->colLabelEN = 'Format Display Date';
				break;
			case 'FormatDisplayTS':
				$colMeta->colLabelEN = 'Format Display TS';
				break;
			case 'FormatDisplayTSSecs':
				$colMeta->colLabelEN = 'Format Display TS Secs';
				break;
			case 'FormatDisplayTime':
				$colMeta->colLabelEN = 'Format Display Time';
				break;
				
			// SMTP
			case 'SMTPHost':
				$colMeta->colLabelEN = 'SMTP Host';
				break;
			case 'SMTPPort':
				$colMeta->colLabelEN = 'SMTP Port';
				break;
			case 'SMTPUsername':
				$colMeta->colLabelEN = 'SMTP Username';
				$colMeta->eleType = ELE_TYPE_TEXTREVEAL_DB;
				break;
			case 'SMTPPassword':
				$colMeta->colLabelEN = 'SMTP Password';
				$colMeta->eleType = ELE_TYPE_TEXTREVEAL_DB;
				break;
			case 'SMTPUseAuth':
				$colMeta->colLabelEN = 'SMTP UseAuth';
				$colMeta->eleType = ELE_TYPE_SELECT_DB;
				$colMeta->choicesAValues = ARRAY_YESNO;
				$colMeta->choicesADisplay = ARRAY_YESNO;
				$colMeta->choicesOtherLabel = '';
				break;
			case 'SMTPAuthType':
				$colMeta->colLabelEN = 'SMTP AuthType';
				$colMeta->eleType = ELE_TYPE_SELECT_DB;
				$colMeta->choicesAValues = ARRAY_SMTP_AUTHTYPE;
				$colMeta->choicesADisplay = ARRAY_SMTP_AUTHTYPE;
				$colMeta->choicesOtherLabel = '';
				break;
			
			// Twillo
			case 'TwilloPhoneNumber':
				$colMeta->colLabelEN = 'Twillo Phone Number';
				break;
			case 'TwilloAPIKey':
				$colMeta->colLabelEN = 'Twillo API Key';
				$colMeta->eleType = ELE_TYPE_TEXTREVEAL_DB;
				break;
			case 'TwilloAPISecret':
				$colMeta->colLabelEN = 'Twillo API Secret';
				$colMeta->eleType = ELE_TYPE_TEXTREVEAL_DB;
				break;
				
			// Stripe
			case 'StripeKeyTestPublic':
				$colMeta->colLabelEN = 'Stripe Key Test Public';
				$colMeta->eleType = ELE_TYPE_TEXTREVEAL_DB;
				break;
			case 'StripeKeyTestSecret':
				$colMeta->colLabelEN = 'Stripe Key Test Secret';
				$colMeta->eleType = ELE_TYPE_TEXTREVEAL_DB;
				break;
			case 'StripeKeyLivePublic':
				$colMeta->colLabelEN = 'Stripe Key Live Public';
				$colMeta->eleType = ELE_TYPE_TEXTREVEAL_DB;
				break;
			case 'StripeKeyLiveSecret':
				$colMeta->colLabelEN = 'Stripe Key Live Secret';
				$colMeta->eleType = ELE_TYPE_TEXTREVEAL_DB;
				break;
			case 'StripeCurrencyCode':
				$colMeta->colLabelEN = 'Stripe Currency Code';
				break;
				
			// APIs Other
			case 'GoogleMapsKey':
				$colMeta->colLabelEN = 'Google Maps Key';
				$colMeta->eleType = ELE_TYPE_TEXTREVEAL_DB;
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
			case 'UUIDSettings':
				$colMeta->colLabelEN = 'Settings ID';
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
$mmSettingsT = new moduleMetaSettingsT();
define( 'MM_SETTINGS_T', 'MM_SETTINGS_T' );
$mm[ MM_SETTINGS_T ] = &$mmSettingsT;
?>