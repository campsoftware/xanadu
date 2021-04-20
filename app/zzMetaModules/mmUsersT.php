<?php

class moduleMetaUsersT extends \xan\moduleMeta {
	// Constructor
	public function __construct() {
		parent::__construct();
		$this->NameModule = 'Users';
		$this->NameModuleLower = strtolower( $this->NameModule );
		$this->NameTable = 'Users';
		$this->NameTableKey = 'UUIDUsers';
		
		// QueryBuilder Operators: equal, not_equal, in, not_in, less, less_or_equal, greater, greater_or_equal, between, not_between, begins_with, not_begins_with, contains, not_contains, ends_with, not_ends_with, is_empty, is_not_empty, is_null, is_not_null
		$this->QuerySimpleDefault = array( 'NameCompany', 'NameLast', 'NameFirst', 'EmailAddress', 'PhoneWork', 'PhoneMobile' );
		$this->QueryBuilderDefault = '{ field: "Users.NameFirst", id: "querybuilder_Users_NameFirst", operator: "begins_with", value: "" }';
		
		$this->QueryOrderByDefault = 'Active DESC, PrivAdmin DESC, NameLast ASC, NameFirst ASC';
		$this->QueryOrderByExtraBegin .= \xan\dbQueryOrderByItem( $this->NameTable, 'Active DESC, PrivAdmin DESC, NameLast ASC, NameFirst ASC', 'Active ASC, PrivAdmin ASC, NameLast ASC, NameFirst ASC', 'Admin, Active' );
		$this->QueryOrderByExtraBegin .= '<hr />';
		
		$this->NamePlural = 'Users';
		$this->NameSingular = 'User';
		
		$this->FontAwesome = '<i class=\'fas fa-id-badge\'></i>';
		$this->FontAwesomeList = FA_LIST;
		
		$this->URLRelative = '/' . 'settings-users/';
		$this->URLFull = URL_BASE . 'settings-users/';
		
		$this->URLDoRelative = '/' . 'settings-users-do/';
		$this->URLDoFull = URL_BASE . 'settings-users-do/';
		
		// Unique to Users
		$this->TwoFactorCode = '';
	}
	
	
	///////////////////////////////////////////////////////////
	// Functions Required by \xan\moduleMeta
	
	public function getDisplayName( \xan\recs $recs ) {
		// Name
		$code = trim( $recs->rowsD[ $recs->rowIndex ][ 'NameFull' ] );
		
		// Company
		$code .= ( \xan\isNotEmpty( $code ) && \xan\isNotEmpty( $recs->rowsD[ $recs->rowIndex ][ 'NameCompany' ] ) ? ', ' : '' );
		$code .= trim( $recs->rowsD[ $recs->rowIndex ][ 'NameCompany' ] );
		
		$code = trim( $code );
		return $code;
	}
	
	public function getDisplayList( \xan\recs $recs ) {
		// Name
		$code = $this->getDisplayName( $recs );
		
		// EmailAddress
		$code .= ( \xan\isNotEmpty( $code ) && \xan\isNotEmpty( $recs->rowsD[ $recs->rowIndex ][ 'EmailAddress' ] ) ? ', ' : '' );
		$code .= trim( $recs->rowsD[ $recs->rowIndex ][ 'EmailAddress' ] );
		
		// Break
		$code .= STR_BR;
		
		// Active
		$code .= ( \xan\isNotEmpty( $code ) && \xan\isNotEmpty( $recs->rowsD[ $recs->rowIndex ][ 'Active' ] ) ? '' : '' );
		$code .= 'Active: ' . trim( $recs->rowsD[ $recs->rowIndex ][ 'Active' ] );
		
		// Admin
		$code .= ( \xan\isNotEmpty( $code ) && \xan\isNotEmpty( $recs->rowsD[ $recs->rowIndex ][ 'PrivAdmin' ] ) ? ', ' : '' );
		$code .= 'Admin: ' . trim( $recs->rowsD[ $recs->rowIndex ][ 'PrivAdmin' ] );
		
		$code = trim( $code );
		return $code;
	}
	
	public function getListItem( $idPrefix, \xan\recs $recs, $onClick ) {
		$idListItem = $idPrefix . $recs->rowsD[ $recs->rowIndex ][ $this->NameTableKey ];
		$idListItemLabel = $idListItem . 'Label';
		
		// Table Init
		$tagsCellEmpty = new \xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_MIDDLE ], [], [] );
		$tagsCellRightMiddle = new \xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_TOP ], [], [] );
		$table = new \xan\eleTable( $tagsCellEmpty );
		
		// Info Cell
		$info = '<span id="' . $idListItemLabel . '" class="list-group-item-text">' . $this->getDisplayList( $recs ) . '</span>';
		$table->cellSet( $recs->rowIndex, 0, $tagsCellRightMiddle, $info );
		
		// Content
		$code = $table->render();
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
			case 'NameCompany':
				$colMeta->colLabelEN = 'Company';
				break;
			case 'NameFirst':
				$colMeta->colLabelEN = 'First Name';
				break;
			case 'NameLast':
				$colMeta->colLabelEN = 'Last Name';
				break;
			case 'NameFull':
				$colMeta->colLabelEN = 'Full Name';
				break;
			case 'EmailAddress':
				$colMeta->colLabelEN = 'Email';
				break;
			case 'PhoneWork':
				$colMeta->colLabelEN = 'Work Phone';
				break;
			case 'PhoneMobile':
				$colMeta->colLabelEN = 'Mobile Phone';
				break;
			case 'PhoneTwoFactor':
				$colMeta->colLabelEN = '2FA Phone';
				break;
			
			case 'LoginKey':
				$colMeta->colLabelEN = 'Login Key Cookie';
				$colMeta->eleType = ELE_TYPE_TEXTREVEAL_DB;
				break;
			case 'LoginKeyOneTime':
				$colMeta->colLabelEN = 'Login Key One Time';
				$colMeta->eleType = ELE_TYPE_TEXTREVEAL_DB;
				break;
			case 'TwoFactorString':
				$colMeta->colLabelEN = '2FA Code';
				$colMeta->eleType = ELE_TYPE_TEXTREVEAL_DB;
				break;
			case 'TwoFactorExpiresTS':
				$colMeta->colLabelEN = '2FA Expires';
				$colMeta->eleType = ELE_TYPE_DATETIME_DB;
				break;
			
			case 'Active':
				$colMeta->colLabelEN = 'Active';
				$colMeta->eleType = ELE_TYPE_SELECT_DB;
				$colMeta->choicesAValues = ARRAY_YESNO;
				$colMeta->choicesADisplay = ARRAY_YESNO;
				$colMeta->choicesOtherLabel = '';
				break;
			case 'PrivAdmin':
				$colMeta->colLabelEN = 'Is Admin';
				$colMeta->eleType = ELE_TYPE_SELECT_DB;
				$colMeta->choicesAValues = ARRAY_YESNO;
				$colMeta->choicesADisplay = ARRAY_YESNO;
				$colMeta->choicesOtherLabel = '';
				break;
			case 'PrivMember':
				$colMeta->colLabelEN = 'Is Member';
				$colMeta->eleType = ELE_TYPE_SELECT_DB;
				$colMeta->choicesAValues = ARRAY_YESNO;
				$colMeta->choicesADisplay = ARRAY_YESNO;
				$colMeta->choicesOtherLabel = '';
				break;
			
			case 'PathLast':
				$colMeta->colLabelEN = 'Last Path';
				$colMeta->eleType = ELE_TYPE_TEXTAREA_DB;
				break;
			
			
			case 'Registered':
				$colMeta->colLabelEN = 'Is Registered';
				$colMeta->eleType = ELE_TYPE_SELECT_DB;
				$colMeta->choicesAValues = ARRAY_YESNO;
				$colMeta->choicesADisplay = ARRAY_YESNO;
				$colMeta->choicesOtherLabel = '';
				break;
			case 'RegisterTS':
				$colMeta->colLabelEN = 'Registered TS';
				$colMeta->eleType = ELE_TYPE_DATETIME_DB;
				break;
			case 'PasswordHashSeed':
				$colMeta->colLabelEN = 'PW Hash Seed';
				$colMeta->eleType = ELE_TYPE_TEXTREVEAL_DB;
				break;
			case 'PasswordHashed':
				$colMeta->colLabelEN = 'PW Hashed';
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
			case 'UUIDUsers':
				$colMeta->colLabelEN = 'User ID';
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
	
	public function setPathLast( $pPath ) {
		// User Update
		$userUpdate = new \xan\recs( $this );
		$userUpdate->querySQL = 'UPDATE ' . $this->NameTable . ' SET PathLast = ? WHERE ' . UUIDUSERS . ' = ?';;
		$userUpdate->queryBindNamesA = array( 'PathLast', UUIDUSERS );
		$userUpdate->queryBindValuesA = array( $pPath, $_SESSION[ SESS_USER ][ UUIDUSERS ] );
		$userUpdate->query();
		
		// Error Check
		if ( $userUpdate->errorB ) {
			xan\logEventToSQL( 'Error', $userUpdate->messageExtra . STR_SEP . $userUpdate->messageSQL, $userUpdate->querySQL . STR_SEP . print_r( $userUpdate->queryBindNamesA ) . STR_SEP . print_r( $userUpdate->queryBindValuesA ), 'users->setPathLast', $_SESSION[ SESS_USER ][ 'EmailAddress' ], $_SESSION[ SESS_USER ][ UUIDUSERS ] );
		}
	}
	
	
	public function set2FACode( $pUUIDUser, $pCode = '2FA_GENERATE' ) {
		// Get Timestamps
		$tsFuture = \xan\dateTimeFromString( '+1 hour', DATETIME_FORMAT_SQLDATETIME );
		$tsPast = \xan\dateTimeFromString( '-1 year', DATETIME_FORMAT_SQLDATETIME );
		
		// Get Code and Timestamp
		if ( $pCode === '2FA_GENERATE' ) {
			$code = \xan\strCode2FA();
			$ts = $tsFuture;
		} else {
			$code = $pCode;
			$ts = ( $code === '' ? $tsPast : $tsFuture );
		}
		
		// Update User
		$userUpdate = new \xan\recs( $this );
		$userUpdate->recordUpdate( $pUUIDUser, array( 'TwoFactorString' => $code, 'TwoFactorExpiresTS' => $ts ) );
		
		// Create the Message
		$this->TwoFactorCode = $code;
	}
	
	
	public function doLogin( $loginMethod, \xan\recs $userSelect ) {
		// Set Session
		$_SESSION[ SESS_USER ] = $userSelect->rowsD[ 0 ];
		
		// Log
		$logEvent = \xan\logEventToSQL( 'Login', $loginMethod, '', $_SERVER[ 'PHP_SELF' ], $_SESSION[ SESS_USER ][ 'EmailAddress' ] ?? '', $_SESSION[ SESS_USER ][ UUIDUSERS ] ?? '' );
		// Error Check
		if ( $logEvent->errorB ) {
			return 'Error: ' . '500 Internal Service Error: ' . 'LogAudit Error; ' . $logEvent->messageExtra . '; ' . $logEvent->messageSQL;
		} elseif ( $logEvent->rowCount < 1 ) {
			return 'Error: ' . '500 Internal Service Error: ' . 'LogAudit Not Found; ' . $logEvent->messageExtra . '; ' . $logEvent->messageSQL;
		}
		
		// Redirect User
		$PathLast = $userSelect->rowsD[ 0 ][ 'PathLast' ];
		if ( \xan\isNotEmpty( $PathLast ) ) {
			return $PathLast;
		} else {
			return '/home';
		}
	}
	
}

// Init
$mmUsersT = new moduleMetaUsersT();
define( 'MM_USERS_T', 'MM_USERS_T' );
$mm[ MM_USERS_T ] = &$mmUsersT;
?>