<?php

namespace xan;

// Session
define( 'SES_BEGIN', 'SES_BEGIN' );
define( 'SES_CHANGE', 'SES_CHANGE' );
define( 'SES_EXPIRES', 'SES_EXPIRES' );
define( 'SES_PATH', 'SES_PATH' );
define( 'SES_INFO', 'SES_INFO' );
define( 'SESS_USER', 'SESS_USER' );
define( 'SESS_FOCUS_SELECTOR', 'SESS_FOCUS_SELECTOR' );

// Cookies
define( 'COOKIE_REMEMBERME', 'COOKIE_REMEMBERME' );
define( 'COOKIE_LOGIN', 'COOKIE_LOGIN' );

// Element As
define( 'ELE_AS_DEFINED', 'ELE_AS_DEFINED' );
define( 'ELE_AS_LABEL', 'ELE_AS_LABEL' );
define( 'ELE_AS_SELECTOR', 'ELE_AS_SELECTOR' );
define( 'ELE_AS_FILEUPLOADBUTTON', 'ELE_AS_FILEUPLOADBUTTON' );

// Element Types
define( 'ELE_TYPE_BUTTON', 'ELE_TYPE_BUTTON' );
define( 'ELE_TYPE_LABEL', 'ELE_TYPE_LABEL' );
define( 'ELE_TYPE_TEXT_DB', 'ELE_TYPE_TEXT_DB' );
define( 'ELE_TYPE_TEXTHIDDEN_DB', 'ELE_TYPE_TEXTHIDDEN_DB' );
define( 'ELE_TYPE_TEXTPASSWORD_DB', 'ELE_TYPE_TEXTPASSWORD_DB' );
define( 'ELE_TYPE_TEXTREVEAL_DB', 'ELE_TYPE_TEXTREVEAL_DB' );
define( 'ELE_TYPE_TEXTTYPEAHEAD_DB', 'ELE_TYPE_TEXTTYPEAHEAD_DB' );
define( 'ELE_TYPE_TEXTAREA_DB', 'ELE_TYPE_TEXTAREA_DB' );
define( 'ELE_TYPE_DATE_DB', 'ELE_TYPE_DATE_DB' );
define( 'ELE_TYPE_DATETIME_DB', 'ELE_TYPE_DATETIME_DB' );
define( 'ELE_TYPE_TIME_DB', 'ELE_TYPE_TIME_DB' );
define( 'ELE_TYPE_DROPDOWN_DB', 'ELE_TYPE_DROPDOWN_DB' );
define( 'ELE_TYPE_SELECT_DB', 'ELE_TYPE_SELECT_DB' );
define( 'ELE_TYPE_FILE_BUCKET_IMAGE_DB', 'ELE_TYPE_FILE_BUCKET_IMAGE_DB' );

// Element Formats
define( 'ELE_FORMAT_CURRENCY', 'ELE_FORMAT_CURRENCY' );
// define( 'ELE_FORMAT_PERCENTAGE', 'ELE_FORMAT_PERCENTAGE' );
define( 'DATETIME_FORMAT_LOG', 'Ymd_His' );
define( 'DATETIME_FORMAT_SQLDATE', 'Y-m-d' );
define( 'DATETIME_FORMAT_SQLDATETIME', 'Y-m-d H:i:s' );

// Element Classes
define( 'ELE_CLASS', 'xanControl form-control' );
// Buttons Generic
define( 'ELE_CLASS_BUTTON_RG_PRIMARY', 'btn btn-primary border-0' );
define( 'ELE_CLASS_BUTTON_SM_PRIMARY', 'btn btn-primary border-0 btn-sm' );
define( 'ELE_CLASS_BUTTON_RG_SECONDARY', 'btn btn-secondary' );
define( 'ELE_CLASS_BUTTON_SM_SECONDARY', 'btn btn-secondary btn-sm' );
// Buttons Specific
define( 'ELE_CLASS_BUTTON_SM_SEARCHBAR', 'btn btn-secondary btn-sm' );
define( 'ELE_CLASS_BUTTON_RG_GO', 'btn btn-secondary' );
define( 'ELE_CLASS_BUTTON_SM_GO', 'btn btn-secondary btn-sm' );
define( 'ELE_CLASS_BUTTON_RG_NEW', 'btn btn-primary border-0' );
define( 'ELE_CLASS_BUTTON_SM_NEW', 'btn btn-primary border-0 btn-sm' );
define( 'ELE_CLASS_BUTTON_RG_DELETE', 'btn btn-danger border-0' );
define( 'ELE_CLASS_BUTTON_SM_DELETE', 'btn btn-danger border-0 btn-sm' );

// Align
define( 'TEXT_ALIGN_LEFT', 'text-left' );
define( 'TEXT_ALIGN_CENTER', 'text-center' );
define( 'TEXT_ALIGN_RIGHT', 'text-right' );
define( 'TABLE_ALIGN_TOP', 'align-top' );
define( 'TABLE_ALIGN_MIDDLE', 'align-middle' );
define( 'TABLE_ALIGN_BOTTOM', 'align-bottom' );
define( 'GRID_ALIGN_TOP', 'align-items-start' );
define( 'GRID_ALIGN_MIDDLE', 'align-items-center' );
define( 'GRID_ALIGN_BOTTOM', 'align-items-end' );

// Misc
define( 'STR_DIR_SEP', DIRECTORY_SEPARATOR );
define( 'STR_SEP', ' | ' );
define( 'STR_CRLF_ESCAPED', '\r\n' );
define( 'STR_CR_ASCII', chr(13) );
define( 'STR_LF_ASCII', chr(10) );
define( 'STR_CRLF_ASCII', chr(13) . chr(10) );
define( 'STR_NBSP', '&nbsp;' );
define( 'STR_BR', '<br />' );
define( 'STR_OTHER', 'Other...' );
define( 'STR_CLEAR', 'Clear' );
define( 'STR_UPLOAD', 'Upload' );
define( 'STR_SELECT_INDICATOR', '&#9662;' );

// Widths and Heights
//define( 'BUTTON_BORDER_RADIUS', '15px' );
define( 'CARD_WIDTH', '21rem' );
define( 'CARD_WIDTH_2X', '43rem' );
define( 'CARD_WIDTH_3X', '65rem' );
define( 'CARD_HEIGHT_MAX', '32rem' );
define( 'CARD_HEIGHT_HALF', '16rem' );
define( 'CARD_HEIGHT_QUARTER', '8rem' );
define( 'CARD_HEIGHT_THIRD', '10rem' );
define( 'ELE_HEIGHT_MAX', '27rem' );
define( 'ELE_HEIGHT_2X', '4rem' );
define( 'ELE_HEIGHT_3X', '5.5rem' );
define( 'ELE_HEIGHT_4X', '7rem' );
define( 'ELE_HEIGHT_5X', '8.5rem' );
define( 'ELE_HEIGHT_6X', '10rem' );
define( 'ELE_HEIGHT_7X', '11.5rem' );
define( 'ELE_HEIGHT_8X', '13rem' );
define( 'ELE_HEIGHT_9X', '14.5rem' );
define( 'ELE_HEIGHT_10X', '16rem' );
define( 'DROPDOWN_HEIGHT_MAX', '27rem' );
define( 'STACKTABLE_WIDTH', '20.2rem' );
define( 'STACKTABLE_TRIGGER', '39.8rem' );
define( 'PORTAL_ELE_HEIGHT', '1.8rem' );
define( 'PORTAL_BUTTON_WIDTH', '2rem' );
define( 'PORTAL_REC_GAP_BEGIN_HEIGHT', '1rem' );
define( 'PORTAL_REC_GAP_END_HEIGHT', '.7rem' );
define( 'PORTAL_LABEL_FONT_SIZE', '9px' );
define( 'ICON_SIZE_XANMESSAGE', '1.5em' );

// Depth
define( 'ZINDEX_BELOW', '-1' );
define( 'ZINDEX_NAVBAR', '500' );
define( 'ZINDEX_TOP', '1000' );

// FontAwesome
define( 'FA_LIST', "<i class='fas fa-th-list'></i>" );
define( 'FA_SEARCH', "<i class='fas fa-search'></i>" );
define( 'FA_SEARCHPLUS', "<i class='fas fa-search-plus'></i>" );
define( 'FA_SORT', "<i class='fas fa-sort'></i>" );
define( 'FA_SORT_ASC', "<i class='fas fa-arrow-alt-down'></i>" );
define( 'FA_SORT_DESC', "<i class='fas fa-arrow-alt-up'></i>" );
define( 'FA_CLEAR', "<i class='fas fa-times-circle'></i>" );
define( 'FA_UPLOAD', "<i class='fas fa-file-upload'></i>" ); // fa-file-upload, fa-cloud-upload
define( 'FA_PASSWORD', "<i class='fas fa-key'></i>" );
define( 'FA_STOPWATCH', "<i class='fas fa-stopwatch'></i>" );
define( 'FA_CLOUD', "<i class='fas fa-cloud'></i>" );
define( 'FA_SPINNER', "<i class='fas fa-spinner fa-spin'></i>" );

define( 'FA_NEW', "<i class='fas fa-plus'></i>" );
define( 'FA_DUPLICATE', "<i class='fas fa-clone'></i>" );
define( 'FA_DELETE', "<i class='fas fa-minus'></i>" );

define( 'FA_ACTION', "<i class='fas fa-running'></i>" );
define( 'FA_PRINT', "<i class='fas fa-print'></i>" );

define( 'FA_MENU', "<i class='fas fa-bars'></i>" );
define( 'FA_SELECT', "<i class='fas fa-caret-down'></i>" );

define( 'FA_PSOS_STOPWATCH', "<span class='mr-1' style='font-size: " . ICON_SIZE_XANMESSAGE . ";'><i class='fas fa-stopwatch'></i></span>" );
define( 'FA_PSOS_CLOUD', "<span class='mr-1' style='font-size: " . ICON_SIZE_XANMESSAGE . ";'><i class='fas fa-cloud'></i></span>" );
define( 'FA_PSOS_SAVE', "<span class='mr-1' style='font-size: " . ICON_SIZE_XANMESSAGE . ";'><i class='fas fa-save'></i></span>" );
define( 'FA_PSOS_ERROR', "<span class='mr-1' style='font-size: " . ICON_SIZE_XANMESSAGE . ";'><i class='fas fa-exclamation-triangle'></i></span>" );

// Bucket File Types
define( 'FILE_TYPES_IMAGES', 'Images' );
define( 'FILE_TYPES_IMAGES_EXTENSIONS', array( 'jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'tif', 'tiff' ) );

///////////////////////////////////////////////////////////
// Dictionary Keys

// Page
define( 'PAGE_HEAD_TITLE', 'PageHeadTitle' );
define( 'PAGE_HEAD_EXTRA', 'PageHeadExtra' );
define( 'PAGE_INCLUDE_NAV', 'PageIncludeNavMenus' );
define( 'PAGE_MODULE_NAME', 'PageModuleName' );
define( 'PAGE_CONTENT_HEADER', 'PageContentHeader' );
define( 'PAGE_CONTENT_AREA', 'PageContentArea' );
define( 'PAGE_CONTENT_END', 'PageContentEnd' );
define( 'PAGE_SCRIPTS_DOINIT', 'PageScriptsDoInit' );
define( 'PAGE_SCRIPTS_DOAFTER', 'PageScriptsDoAfter' );
define( 'PAGE_SCRIPTS_EXTRA', 'PageScriptsExtra' );
define( 'PAGE_SCRIPTS_ONLOAD', 'PageScriptsOnLoad' );
define( 'PAGE_MESSAGE_LOADTIME', 'PageMessageLoadTime' );

// Records
define( 'DB_RECORDS', 'Records' );
define( 'DB_COUNT', 'Count' );
define( 'DB_ERROR', 'Error' );
define( 'DB_ERRORMESSAGE', 'ErrorMessage' );
define( 'DB_EXTRAMESSAGE', 'ExtraMessage' );

// Forms
define( 'FORM_OBFUSCATE', true );
define( 'FORM_PREFIX', 'xf_' );
define( 'FORM_META', 'Meta' );
define( 'FORM_TIMEOUT_SECONDS', APP_COOKIE_SESSION_SECONDS + 60 );  // Expire Shortly After Session Expires
define( 'FORM_TIME', 'Time' );
define( 'FORM_TABLENAME', 'TableName' );
define( 'FORM_KEYNAME', 'KeyName' );
define( 'FORM_KEYVALUE', 'KeyValue' );


class response {
	// Request
	public $reqPath = '';
	public $reqPathComponents = [];
	public $reqPost = [];
	public $reqID = '';

	// Module
	public $moduleName = '';

	// Content
	public $headTitle = '';
	public $headExtraA = [];
	public $headLogoutAuto = true;
	public $navInclude = false;
	public $contentHeader = '';
	public $contentAreaA = [];
	public $contentEndA = [];
	public $scriptsDoInitA = [];
	public $scriptsExtraA = [];
	public $scriptsOnLoadA = [];
	
	// Do Actions
	public $jsActionsA = [];

	// Constructor
	public function __construct() {
	}
	
	public function jsSetPageTitle( $value ){
        $index = count( $this->jsActionsA );
        $this->jsActionsA[ $index ][ 'xanDo_Action' ] = 'setPageTitle';
        $this->jsActionsA[ $index ][ 'xanDo_Value' ] = $value;
    }
    
    public function jsSetPageURL( $value ){
        $index = count( $this->jsActionsA );
        $this->jsActionsA[ $index ][ 'xanDo_Action' ] = 'setPageURL';
        $this->jsActionsA[ $index ][ 'xanDo_Value' ] = $value;
    }
	
    public function jsHideOrShow( $selector, $value ){
        $index = count( $this->jsActionsA );
        $this->jsActionsA[ $index ][ 'xanDo_Action' ] = 'hideOrShow';
        $this->jsActionsA[ $index ][ 'xanDo_Selector' ] = $selector;
        $this->jsActionsA[ $index ][ 'xanDo_Value' ] = strtolower($value);
    }
    
    public function jsHideOrShowModal( $selector, $value ){
        $index = count( $this->jsActionsA );
        $this->jsActionsA[ $index ][ 'xanDo_Action' ] = 'hideOrShowModal';
        $this->jsActionsA[ $index ][ 'xanDo_Selector' ] = $selector;
        $this->jsActionsA[ $index ][ 'xanDo_Value' ] = strtolower($value);
    }
    
    public function jsSetHTML( $selector, $value ){
        $index = count( $this->jsActionsA );
        $this->jsActionsA[ $index ][ 'xanDo_Action' ] = 'setHTML';
        $this->jsActionsA[ $index ][ 'xanDo_Selector' ] = $selector;
        $this->jsActionsA[ $index ][ 'xanDo_Value' ] = $value;
    }
    
    public function jsSetVal( $selector, $value ){
        $index = count( $this->jsActionsA );
        $this->jsActionsA[ $index ][ 'xanDo_Action' ] = 'setVal';
        $this->jsActionsA[ $index ][ 'xanDo_Selector' ] = $selector;
        $this->jsActionsA[ $index ][ 'xanDo_Value' ] = $value;
    }
    
    public function jsSetHTMLProperty( $selector, $property, $value ){
        $index = count( $this->jsActionsA );
        $this->jsActionsA[ $index ][ 'xanDo_Action' ] = 'setHTMLProperty';
        $this->jsActionsA[ $index ][ 'xanDo_Selector' ]  = $selector;
        $this->jsActionsA[ $index ][ 'xanDo_Property' ] = $property;
        $this->jsActionsA[ $index ][ 'xanDo_Value' ] = $value;
    }
    
    public function jsRunInit(){
        $index = count( $this->jsActionsA );
        $this->jsActionsA[ $index ][ 'xanDo_Action' ] = 'runInit';
    }
    
    public function jsSetFocus( $selector ){
        $index = count( $this->jsActionsA );
        $this->jsActionsA[ $index ][ 'xanDo_Action' ] = 'setFocus';
        $this->jsActionsA[ $index ][ 'xanDo_Selector' ]  = $selector;
    }
}


abstract class moduleMeta {
	// Vars
	public $NameModule;
	public $NamePlural;
	public $NameSingular;

	public $NameModuleLower;
	public $NameTable;
	public $NameTableKey;

	public $FontAwesome;
	public $FontAwesomeList;

	public $URLRelative;
	public $URLFull;
	
	public $URLDoRelative;
	public $URLDoFull;

	public $QuerySimpleDefault;
	public $QueryBuilderDefault;

	public $QueryOrderByDefault;
	public $QueryOrderByExtraBegin;

	// Constructor
	public function __construct() {
	}

	// Functions
	abstract public function getDisplayName( recs $recs );
	abstract public function getDisplayList( recs $recs );
	abstract public function getListItem( $idPrefix, recs $recs, $onClick );
	abstract public function getColLabel( $colName );
	abstract public function getColEleRender( $colName, $typeAs, tags $tags, recs $recs, formTag $formTag, response &$resp );
	abstract public function getColMeta( $colName, $typeAs = ELE_AS_DEFINED );
}

// recsQuerySimple
function recsQuerySimple( $sql, $bindNamesA, $bindValuesA ){
    // Can Be Used For Adhoc Queries
    global $mm; // Get Access To $mm
	$recs = new recs( $mm[ MM_NULL_T ] );
	$recs->querySQL = $sql;
	$recs->queryBindNamesA = $bindNamesA;
	$recs->queryBindValuesA = $bindValuesA;
	$recs->query();
	return $recs;
}

class recs {
	public $rowsD = [];
	public $rowCount = 0;
	public $rowIndex = 0;
	public $errorB = false;
	public $messageSQL = '';
	public $messageExtra = '';
	public $htmlFormTag = '';

	public moduleMeta $moduleMeta;
	public $querySQL = '';
	public $queryBindNamesA = [];
	public $queryBindValuesA = [];

	public function __construct( moduleMeta $meta ) {
		$this->moduleMeta = $meta;
	}
	
	public function serverConnect() {
        try {
            $servername = DBS_SERVERNAME;
            $serverport = DBS_SERVERPORT;
            $username = DBS_USERNAME;
            $password = DBS_PASSWORD;
            $dbname = DBS_DBNAME;
            $optDB = array(
                \PDO::MYSQL_ATTR_FOUND_ROWS => TRUE,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            );
            $newDB = new \PDO( "mysql:host=$servername;port=$serverport;dbname=$dbname", $username, $password, $optDB );
            return $newDB;
        } catch ( \PDOException $e ) {
            logEventToFile( 'Catch', 'DBConnect', $e->getMessage(), $_SERVER[ 'PHP_SELF' ], $_SESSION[ SESS_USER ][ 'EmailAddress' ] ?? 'No', $_SESSION[ SESS_USER ][ UUIDUSERS ] ?? 'No' );
            return 'Error: ' . $e->getMessage();
        }
    }

	public function query( ) {
	    // Init
	    $this->errorB = false;
        $this->rowsD = [];
        $this->rowCount = 0;
        $this->messageSQL = '';
        $this->messageExtra = '';
        try {
            // Connect
            if ( !isset( $GLOBALS[ 'db' ] ) ) {
                $GLOBALS[ 'db' ] = $this->serverConnect();
            }
           
            // Prepared Statement
            $ps = $GLOBALS[ 'db' ]->prepare( $this->querySQL );
            
            // Bind
            if ( !empty( $this->queryBindValuesA ) ) {
                $bindValuesArrayCount = count( $this->queryBindValuesA );
                for ( $bindIndex = 0; $bindIndex <= ( $bindValuesArrayCount - 1 ); $bindIndex++ ) {
                    
                    // $thisColName = $this->queryBindNamesA[ $bindIndex ];
                    $thisColValue = $this->queryBindValuesA[ $bindIndex ];
                    
                    // Bind as NULL if value is 'NULL'
                    if ( strval( $thisColValue ) === 'NULL' ) {
                        $ps->bindValue( $bindIndex + 1, NULL, \PDO::PARAM_NULL );
                    } else {
                        $ps->bindValue( $bindIndex + 1, $thisColValue, \PDO::PARAM_STR );
                    }
                    
                }
            }
            
            // Execute
            $ps->execute();
            
            // Check the Statement
            $sqlWords = explode( ' ', $this->querySQL );
            $sqlIsSelect = ( strtoupper( $sqlWords[ 0 ] ) === 'SELECT' ? true : false );
            // $sqlIsInsert = ( strtoupper( $sqlWords[ 0 ] ) === 'INSERT' ? true : false );
            // $sqlIsUpdate = ( strtoupper( $sqlWords[ 0 ] ) === 'UPDATE' ? true : false );
            
            // Process
            if ( $sqlIsSelect ) {
                // Process SELECT
                $this->errorB = false;
                $this->rowsD = $ps->fetchAll( \PDO::FETCH_ASSOC );
                $this->rowCount = count( $this->rowsD );
            } else {
                // Process NOT SELECT
                $this->errorB = false;
                $this->rowsD = [];
                $this->rowCount = $ps->rowCount();
            }
        } catch ( \PDOException $e ) {
            // Log Error
            logEventToFile( 'Catch', 'DBSelect: ' . $this->querySQL, $e->getMessage(), $_SERVER[ 'PHP_SELF' ], $_SESSION[ SESS_USER ][ 'EmailAddress' ] ?? 'No', $_SESSION[ SESS_USER ][ UUIDUSERS ] ?? 'No' );
            $this->errorB = true;
            $this->rowsD = [];
            $this->rowCount = 0;
            $this->messageSQL = $e->getMessage();
            return;
        }
        
        // Update Message
        if ( $this->rowCount < 1 ){
            $this->messageSQL = 'Found 0';
        } else {
            $this->messageSQL = 'Found ' . $this->rowCount;
        }
        
    }
	
	public function rowsMassageForGUI( $massageDatesB, $colNamesA = [] ) {
		// Error Check
		if ( $this->errorB ) {
			return;
		} elseif ( $this->rowCount < 1 ) {
			return;
		} else {
			// Recs Loop
			$this->rowIndex = -1;
			foreach ( $this->rowsD as $row ) {
				$this->rowIndex++;
				
				// All Columns
				if ( $colNamesA === [] ){
					foreach ( $row as $colName => $colValue ) {

						// Column Meta
						$colMeta = $this->moduleMeta->getColMeta($colName );
						
						// Massage
						$this->rowsD[ $this->rowIndex ][ $colName ] = dbValueMassageForGUI( $this->moduleMeta->NameTable,$colName,$colValue,$colMeta->eleFormatAs, $massageDatesB );
					
					} // foreach col
				}
				
				// Specified Columns
				if ( $colNamesA !== [] ){
				    foreach ( $colNamesA as $colName ) {
				        
                        // Column Meta
                        $colMeta = $this->moduleMeta->getColMeta($colName );
                       
                        // Massage
                        $colValue = $this->rowsD[ $this->rowIndex ][ $colName ];
                        $this->rowsD[ $this->rowIndex ][ $colName ] = dbValueMassageForGUI( $this->moduleMeta->NameTable,$colName,$colValue,$colMeta->eleFormatAs, $massageDatesB );
				        
				    } // foreach specified
				}
				
			} // foreach row
		}
	}

	public function recordInsert( $columnsValuesArray = array() ) {
		// Set Table Key
		$tableKeyValueNew = strUUID();
		$columnNames = $this->moduleMeta->NameTableKey;
		$columnValuesQuestions = '?';
		$columnArrayNames = array( $this->moduleMeta->NameTableKey );
		$columnArrayValues = array( $tableKeyValueNew );

		// Set Passed Columns
		foreach ( $columnsValuesArray as $colName => $colValue ) {
			$columnNames .= ', ' . $colName;
			$columnValuesQuestions .= ', ?';
			$columnArrayNames[] = $colName;
			$columnArrayValues[] = $colValue;
		}

		// Insert
		$this->querySQL = 'INSERT INTO ' . $this->moduleMeta->NameTable . ' ( ' . $columnNames . ' ) VALUES ( ' . $columnValuesQuestions . ' )';
		$this->queryBindNamesA = $columnArrayNames;
		$this->queryBindValuesA = $columnArrayValues;
		$this->query();
		if ($this->errorB ){
			$this->messageExtra = 'Insert Error';
			return;
		}
		if ( $this->rowCount < 1 ){
			$this->messageExtra = 'Insert Not Found';
			return;
		}

		// Select
		$this->querySQL = 'SELECT * FROM ' . $this->moduleMeta->NameTable . ' WHERE ' . $this->moduleMeta->NameTableKey . ' = ?';
		$this->queryBindNamesA = array( $this->moduleMeta->NameTableKey );
		$this->queryBindValuesA = array( $tableKeyValueNew );
		$this->query();
		if ($this->errorB ){
			$this->messageExtra = 'Select Error';
			return;
		}
		if ( $this->rowCount < 1 ){
			$this->messageExtra = 'Select Not Found';
			return;
		}
	}
	
	public function recordUpdate( $tableKeyValue, $colNameValuesD = array() ) {
        // Set Init
        $columnAssignments = '';
        $columnArrayNames = array();
        $columnArrayValues = array();
        
        // Append Passed Columns
        foreach ( $colNameValuesD as $colName => $colValue ) {
            $columnAssignments .= ( isEmpty( $columnAssignments ) ? '' : ', ' );
            $columnAssignments .= $colName . ' = ?';
            $columnArrayNames[] = $colName;
            $columnArrayValues[] = $colValue;
        }
        
        // Append Key
        $columnArrayNames[] = $this->moduleMeta->NameTableKey;
        $columnArrayValues[] = $tableKeyValue;
        
        // Update
        $this->querySQL = 'UPDATE ' . $this->moduleMeta->NameTable . ' SET ' . $columnAssignments . ' WHERE ' . $this->moduleMeta->NameTableKey . ' = ?';
		$this->queryBindNamesA = $columnArrayNames;
		$this->queryBindValuesA = $columnArrayValues;
		$this->query();
		if ($this->errorB ){
			$this->messageExtra = 'Update Error';
			return;
		}
		if ( $this->rowCount < 1 ){
			$this->messageExtra = 'Update Not Found';
			return;
		}
		
        // Select
        $this->querySQL = 'SELECT ' . $this->moduleMeta->NameTableKey . ' FROM ' . $this->moduleMeta->NameTable . ' WHERE ' . $this->moduleMeta->NameTableKey . ' = ?';
		$this->queryBindNamesA = array( $this->moduleMeta->NameTableKey );
		$this->queryBindValuesA = array( $tableKeyValue );
		$this->query();
		if ($this->errorB ){
			$this->messageExtra = 'Select Error';
			return;
		}
		if ( $this->rowCount < 1 ){
			$this->messageExtra = 'Select Not Found';
			return;
		}
    }

	public function recordDelete( $tableKeyValue ) {
		// Delete
		$this->querySQL = 'DELETE FROM ' . $this->moduleMeta->NameTable . ' WHERE ' . $this->moduleMeta->NameTableKey . ' = ?';
		$this->queryBindNamesA = array( $this->moduleMeta->NameTableKey );
		$this->queryBindValuesA = array( $tableKeyValue );
		$this->query();
		if ($this->errorB ){
			$this->messageExtra = 'Delete Error';
			return;
		}
		if ( $this->rowCount < 1 ){
			$this->messageExtra = 'Delete Not Found';
			return;
		}
	}

	public function recordDuplicate( $tableKeyValue ) {
		// New Key
		$tableKeyValueNew = strUUID();
		
		// Select Check
		$this->querySQL = 'SELECT ' . $this->moduleMeta->NameTableKey . ' FROM ' . $this->moduleMeta->NameTable . ' WHERE ' . $this->moduleMeta->NameTableKey . ' = ?';
		$this->queryBindNamesA = array( $this->moduleMeta->NameTableKey );
		$this->queryBindValuesA = array( $tableKeyValue );
		$this->query(  );
		if ($this->errorB ){
			$this->messageExtra = 'Select Check Error';
			return;
		}
		if ( $this->rowCount < 1 ){
			$this->messageExtra = 'Select Check Not Found';
			return;
		}
		
		// Duplicate to Temp Table
		$this->querySQL = 'CREATE TEMPORARY TABLE tmptableDup SELECT * FROM ' . $this->moduleMeta->NameTable . '  WHERE ' . $this->moduleMeta->NameTableKey . ' = ?';
		$this->queryBindNamesA = array( $this->moduleMeta->NameTableKey );
		$this->queryBindValuesA = array( $tableKeyValue );
		$this->query(  );
		if ($this->errorB ){
			$this->messageExtra = 'Create Temp Error';
			return;
		}
		if ( $this->rowCount < 1 ){
			$this->messageExtra = 'Create Temp Not Found';
			return;
		}

		// Update Key
		$this->querySQL = 'UPDATE tmptableDup SET ' . $this->moduleMeta->NameTableKey . ' = ?';
		$this->queryBindNamesA = array( $this->moduleMeta->NameTableKey );
		$this->queryBindValuesA = array( $tableKeyValueNew );
		$this->query(  );
		if ($this->errorB ){
			$this->messageExtra = 'Update Key Error';
			return;
		}
		if ( $this->rowCount < 1 ){
			$this->messageExtra = 'Update Key Not Found';
			return;
		}
	   
	   // Insert
		$this->querySQL = 'INSERT INTO ' . $this->moduleMeta->NameTable . ' SELECT * FROM tmptableDup';
		$this->queryBindNamesA = array( );
		$this->queryBindValuesA = array( );
		$this->query(  );
		if ($this->errorB ){
			$this->messageExtra = 'Insert Error';
			return;
		}
		if ( $this->rowCount < 1 ){
			$this->messageExtra = 'Insert Not Found';
			return;
		}
	 
		// Delete Temp Table
		$this->querySQL = 'DROP TEMPORARY TABLE If EXISTS tmptableDup';
		$this->queryBindNamesA = array( );
		$this->queryBindValuesA = array( );
		$this->query(  );
		if ($this->errorB ){
			$this->messageExtra = 'Drop Temp Error';
			return;
		}
	 
		// Select
		$this->querySQL = 'SELECT * FROM ' . $this->moduleMeta->NameTable . ' WHERE ' . $this->moduleMeta->NameTableKey . ' = ?';
		$this->queryBindNamesA = array( $this->moduleMeta->NameTableKey );
		$this->queryBindValuesA = array( $tableKeyValueNew );
		$this->query(  );
		if ($this->errorB ){
			$this->messageExtra = 'Select Duplicate Error';
			return;
		}
		if ( $this->rowCount < 1 ){
			$this->messageExtra = 'Select Duplicate Not Found';
			return;
		}

	}
	
	function recordDuplicateRelated( $foreignTableKeyName, $foreignTableKeyValueOld, $foreignTableKeyValueNew ) {
		// Select Check
		$this->querySQL = 'SELECT ' . $this->moduleMeta->NameTableKey . ' FROM ' . $this->moduleMeta->NameTable . ' WHERE ' . $foreignTableKeyName . ' = ?';
		$this->queryBindNamesA = array( $foreignTableKeyName );
		$this->queryBindValuesA = array( $foreignTableKeyValueOld );
		$this->query(  );
		if ($this->errorB ){
			$this->messageExtra = 'Select Check Error';
			return;
		}
		if ( $this->rowCount < 1 ){
			$this->messageExtra = 'Select Check Not Found';
			return;
		}
		
		// Duplicate to Temp Table
		$this->querySQL = 'CREATE TEMPORARY TABLE tmptableDup SELECT * FROM ' . $this->moduleMeta->NameTable . '  WHERE ' . $foreignTableKeyName . ' = ?';
		$this->queryBindNamesA = array( $foreignTableKeyName );
		$this->queryBindValuesA = array( $foreignTableKeyValueOld );
		$this->query(  );
		if ($this->errorB ){
			$this->messageExtra = 'Create Temp Error';
			return;
		}
		if ( $this->rowCount < 1 ){
			$this->messageExtra = 'Create Temp Not Found';
			return;
		}
		
		// Update Key
		$this->querySQL = 'UPDATE tmptableDup SET ' . $this->moduleMeta->NameTableKey . ' = UUID()';
		$this->queryBindNamesA = array( );
		$this->queryBindValuesA = array( );
		$this->query(  );
		if ($this->errorB ){
			$this->messageExtra = 'Update Key Error';
			return;
		}
		if ( $this->rowCount < 1 ){
			$this->messageExtra = 'Update Key Not Found';
			return;
		}
		
		// Update Key Foreign
		$this->querySQL = 'UPDATE tmptableDup SET ' . $foreignTableKeyName . ' = ?';
		$this->queryBindNamesA = array( $foreignTableKeyName );
		$this->queryBindValuesA = array( $foreignTableKeyValueNew );
		$this->query(  );
		if ($this->errorB ){
			$this->messageExtra = 'Update Foreign Key Error';
			return;
		}
		if ( $this->rowCount < 1 ){
			$this->messageExtra = 'Update Foreign Key Not Found';
			return;
		}
		
		// Insert
		$this->querySQL = 'INSERT INTO ' . $this->moduleMeta->NameTable . ' SELECT * FROM tmptableDup';
		$this->queryBindNamesA = array( );
		$this->queryBindValuesA = array( );
		$this->query(  );
		if ($this->errorB ){
			$this->messageExtra = 'Insert Error';
			return;
		}
		if ( $this->rowCount < 1 ){
			$this->messageExtra = 'Insert Not Found';
			return;
		}
		
		// Delete Temp Table
		$this->querySQL = 'DROP TEMPORARY TABLE If EXISTS tmptableDup';
		$this->queryBindNamesA = array( );
		$this->queryBindValuesA = array( );
		$this->query(  );
		if ($this->errorB ){
			$this->messageExtra = 'Drop Temp Error';
			return;
		}
		
		// Select
		$this->querySQL = 'SELECT * FROM ' . $this->moduleMeta->NameTable . ' WHERE ' . $foreignTableKeyName . ' = ?';
		$this->queryBindNamesA = array( $foreignTableKeyName );
		$this->queryBindValuesA = array( $foreignTableKeyValueNew );
		$this->query(  );
		if ($this->errorB ){
			$this->messageExtra = 'Select Duplicate Error';
			return;
		}
		if ( $this->rowCount < 1 ){
			$this->messageExtra = 'Select Duplicate Not Found';
			return;
		}

	}
	
	public function recsDumpSQL( $fileName ) {
	    // Example
        // $recs = new \xan\recs( $mmContactsT );
        // $recs->querySQL = 'SELECT * FROM ' . $mmContactsT->NameTable;
        // $recs->query();
        // $filename = 'Xan_' . $mmContactsT->NameTable . '_' . \xan\dateTimeFromString( 'now', DATETIME_FORMAT_LOG ) . '.sql';
        // $filename = 'Xan_Contacts_20210223_194453.sql';
        // $recs->dumpSQL( $filename );
        
        if ( !$this->errorB ) {
            $filePath = PATH_ROOT_LOGS . $fileName;
            foreach ( $this->rowsD as $row ) {
                $keys = [];
                $values = [];
                foreach ( $row as $key => $value ) {
                    $keys[] = '`' . $key . '`';
                    $values[] = ( $value === null ? 'NULL' : '"' . addslashes( $value ) . '"' );
                }
                $content = 'INSERT INTO `' . $this->moduleMeta->NameTable . '` ( ' . implode( ',', $keys ) . ' ) VALUES ( ' . implode( ',', $values ) . ' );' . "\n";
                $write = fileWrite( $filePath, $content, true );
            }
            $write = fileWrite( $filePath, "\n\n", true );
            
        }
    }
	
}


class formTag {
	// Vars
	public $formName = '';
	public $formTag = '';
	public $tableName = '';
	public $keyName = '';
	public $keyValue = '';
	public $time = '';

	// Constructor     $formTableName, $formKeyName, $row
	public function __construct( recs $recs ) {
		// Time
		$this->time = strtotime( "now" );

		// DB Info
		$this->tableName = $recs->moduleMeta->NameTable;
		$this->keyName = $recs->moduleMeta->NameTableKey;
		$this->keyValue = $recs->rowsD[ $recs->rowIndex ][ $this->keyName ];

		// Meta Get
		$result = $this->tableName . '|' . $this->keyName . '|' . $this->keyValue;
		$result = $this->time . '|' . formObfuscate( $result, $this->time );

		// Name
		$this->formName = FORM_PREFIX . $this->keyValue;

		// Tags Generate
		ob_start();
		?>
		<input value="<?= $result ?>" type="hidden" id="<?= $this->formName . '_' . FORM_PREFIX . FORM_META ?>">
		<?php
		$this->formTag = ob_get_clean();
	}

	public function render() {
		return $this->formTag;
	}
}


class tags {
	// Vars
	public $classA = [];
	public $styleD = [];
	public $extrasA = [];
	public $otherD = [];

	// Constructor
	public function __construct( $classA = [], $styleD = [], $extrasA = [] ) {
		$this->classA = $classA;
		$this->styleD = $styleD;
		$this->extrasA = $extrasA;
	}
}


class colMeta {
	// Vars
	public $eleType = '';
	public $eleTypeAs = '';
	public $eleFormatAs = '';

	public $colName = '';
	public $colLabelEN = '';
	public $colLabel = '';

	public $isMod = false;
	public $isKey = false;
	public $isKeyPrimary = false;
	public $isKeyForeign = false;

	public $choicesAValues = [];
	public $choicesADisplay = [];

	public $choicesClearLabel = '';
	public $choicesOtherLabel = '';

	public function __construct() {
	}
}


class element {
	// Attributes
	public colMeta $colMeta;
	public tags $tags;
	public recs $recs;
	public formTag $formTag;
	public response $resp;
	
	// Column Info
	public $colType = '';

	// Content
	public $content = '';
	public $contentA = [];

	// Values and Tags
	public $typeTag = '';
	public $idValue = '';
	public $idTag = '';
	public $nameValue = '';
	public $nameTag = '';
	public $valueValue = '';
	public $valueTag = '';
	public $labelValue = '';
	public $labelTag = '';
	public $formatValue = '';
	public $formatTag = '';
	public $keyValue = '';
	public $keyTag = '';
	public $classA = [];
	public $classValue = '';
	public $classTag = '';
	public $styleD = [];
	public $styleValue = '';
	public $styleTag = '';
	public $extrasA = [];
	public $extrasValue = '';
	public $extrasTag = '';

	// Constructor
	public function __construct() {
		// Tags Init
		$this->tags = new tags();
	}

	public function initEle(  ) {
		// ID
		$this->idTag = ( isEmpty($this->idValue ) ? '' : 'id="' . $this->idValue . '"' );
		// Name
		$this->nameTag = ( isEmpty($this->nameValue ) ? '' : 'name="' . $this->nameValue . '"' );
		// Class, Style, and Extras
		$this->classA[] = ELE_CLASS;
		$this->classA[] = 'p-1 mb-1';
		// Init Tags
		$this->initTags();
		$this->valueTag = ( isEmpty($this->valueValue ) ? '' : 'value="' . $this->valueValue . '"' );
	}
	
	public function initEleDB( $isAjaxSave = true ) {
		// ColType
		$this->colType = dbValueType( $this->formTag->tableName, $this->colMeta->colName );
		// Data Label
		$this->labelValue = $this->colMeta->colLabel;
		$this->labelTag = ( isEmpty($this->labelValue ) ? '' : 'data-label="' . $this->labelValue . '"' );
		// Data Format
		$this->formatValue = $this->colMeta->eleFormatAs;
		$this->formatTag = ( isEmpty($this->formatValue ) ? '' : 'data-format="' . $this->formatValue . '"' );
		// Data Key
		$this->keyValue = $this->colMeta->colLabel;
		$this->keyTag = ( isEmpty($this->keyValue ) ? '' : 'data-key="' . $this->formTag->keyValue . '"' );
		// ID
		$this->idValue = $this->formTag->formName . '_' . $this->colMeta->colName;
		$this->idTag = ( isEmpty($this->idValue ) ? '' : 'id="' . $this->idValue . '"' );
		// Name
		$this->nameValue = formObfuscate( $this->colMeta->colName, $this->formTag->time );
		$this->nameTag = ( isEmpty($this->nameValue ) ? '' : 'name="' . $this->nameValue . '"' );
		// Class, Style, and Extras
		$this->classA[] = ELE_CLASS;
		$this->classA[] = 'p-1 mb-1';
		if ( $isAjaxSave ) {
			$this->classA[] = 'xanDoSave';
		}
		if ( $this->colType == 'integer' or $this->colType == 'decimal' ) {
			$this->styleD[ 'text-align' ] = 'right';
		} else {
			$this->styleD[ 'text-align' ] = 'left';
		}
		// Init Tags
		$this->initTags();
		// Value
		$this->valueValue = $this->recs->rowsD[ $this->recs->rowIndex ][ $this->colMeta->colName ];
		$this->valueTag = 'value="' . $this->valueValue . '"';
	}

	public function initTags() {
		// Class
		$this->classA[] = classAToString( $this->tags->classA );
		$this->classValue = classAToString( $this->classA );
		$this->classTag = ( isEmpty($this->classValue ) ? '' : 'class="' . $this->classValue . '"' );;
		// Style
		$this->styleD = array_merge($this->styleD, $this->tags->styleD);
		$this->styleValue = styleDToString( $this->styleD );
		$this->styleTag = ( isEmpty($this->styleValue ) ? '' : 'style="' . $this->styleValue . '"' );;
		// Extras
		$this->extrasA[] = extrasAToString( $this->tags->extrasA );
		$this->extrasValue = extrasAToString( $this->extrasA );
		$this->extrasTag = $this->extrasValue;
	}
}


class eleCard extends element {
	// Vars
	public $overflowAuto = false;

	// Constructor
	public function __construct( $styleWidth, $styleHeightMax, $isOverflowAuto ) {
		parent::__construct();
		if ( !isEmpty( $styleWidth ) ) {
			$this->styleD[ 'width' ] = $styleWidth;
		}
		if ( !isEmpty( $styleHeightMax ) ) {
			$this->styleD[ 'max-height' ] = $styleHeightMax;
		}
		$this->overflowAuto = ( $isOverflowAuto ? 'overflow-auto' : '' );
	}

	// Functions
	public function renderCardWithDiv( $contentHeader, $contentBody ) {
		ob_start();
		?>
		<div class="card rounded float-left shadow ml-3 mb-3" style="<?= styleDToString( $this->styleD ) ?>">
			<div class="card-header font-weight-bold p-2"><?= $contentHeader ?></div>
			<div class="card-body p-2 <?= $this->overflowAuto ?>">
				<?= $contentBody ?>
			</div>
		</div>
		<?php
		// Return
		$code = ob_get_clean();
		return $code;
	}

	public function renderCardWithList( $contentHeader, $contentBody ) {
		ob_start();
		?>
		<div class="card rounded float-left shadow ml-3 mb-3" style="<?= styleDToString( $this->styleD ) ?>">
			<div class="card-header font-weight-bold p-2"><?= $contentHeader ?></div>
			<div class="list-group list-group-flush <?= $this->overflowAuto ?>">
				<?= $contentBody ?>
			</div>
		</div>
		<?php
		// Return
		$code = ob_get_clean();
		return $code;
	}

	 public function renderListItemLink( $content, $index, $id, $isSelected, $onClick ) {
		 $active = ( $isSelected ? 'active' : '' );
		 $content = str_replace( 'list-group-item-text', 'list-group-item-text ' . $active, $content );
		 ob_start();
	?>
	<span id="<?= $id ?>" class="list-group-item list-group-item-action <?= $active ?> border-secondary border-bottom p-1 pt-2 pb-2" onclick="<?= $onClick ?>">
		<?= $content ?>
		<div style="position: absolute; top: 2px; right: 2px; font-size: 9px;"><?= $index ?></div>
	</span>
	<?php
	return ob_get_clean();
	}

}


class eleTable extends element {
	// Vars
	public $cells = [];
	public tags $tagsCellsEmpty;

	// Constructor
	public function __construct( tags $tagsEmpty ) {
		parent::__construct();
		$this->tagsCellsEmpty = $tagsEmpty;
	}

	public function cellSet( $rowIndex, $colIndex, tags $tags, $content, $rowSpan = '', $colSpan = '' ) {
		$this->cells[ $rowIndex ][ $colIndex ][ 'Tags' ] = $tags;
		$this->cells[ $rowIndex ][ $colIndex ][ 'Content' ] = $content;
		$this->cells[ $rowIndex ][ $colIndex ][ 'ColSpan' ] = $colSpan;
		$this->cells[ $rowIndex ][ $colIndex ][ 'RowSpan' ] = $rowSpan;
	}

	public function cellSkip( $rowIndex, $colIndex ) {
		// Used for RowSpan or ColSpan
		$this->cells[ $rowIndex ][ $colIndex ][ 'SkipB' ] = true;
	}

	public function render() {
		$code = '<div class="p-0">';
		$code .= '<table class="table table-sm table-hover mb-0 p-0">';

		$rowIndex = 0;
		$colIndex = 0;

		// For each Cell
		foreach ( $this->cells as $rowKey => $rowValue ) {
			// Start a Row
			$code .= "<tr>"; // Currently not supporting table row tags. Set Cell instead.

			// Start a new Row
			while ( $rowIndex < $rowKey ) {
				$code .= "<tr></tr>"; // Currently not supporting table row tags. Set Cell instead.
				$rowIndex++;
			}

			// For each Column
			foreach ( $rowValue as $colKey => $colAttributes ) {

				// For each Cell Gap
				while ( $colIndex < $colKey ) {
					// Add Cell if not Skipped Cell
					if ( $this->cells[ $rowIndex ][ $colIndex ][ 'SkipB' ] != true ) {
						$classTag = 'class="' . classAToString( $this->tagsCellsEmpty->classA ) . '"';
						$styleTag = 'style="' . styleDToString( $this->tagsCellsEmpty->styleD ) . '"';
						$extrasTag = extrasAToString( $this->tagsCellsEmpty->extrasA );
						$code .= "<td $classTag $styleTag $extrasTag></td>";
					}
					$colIndex++;
				}

				// Add Cell if not Skipped Cell
				if ( $this->cells[ $rowIndex ][ $colIndex ][ 'SkipB' ] != true ) {
					$classTag = 'class="' . classAToString( $colAttributes[ 'Tags' ]->classA ) . '"';
					$styleTag = 'style="' . styleDToString( $colAttributes[ 'Tags' ]->styleD ) . '"';
					$extrasTag = extrasAToString( $colAttributes[ 'Tags' ]->extrasA );
					$colSpan = ( $colAttributes[ 'ColSpan' ] == '' ? '' : 'colspan="' . $colAttributes[ 'ColSpan' ] . '"' );
					$rowSpan = ( $colAttributes[ 'RowSpan' ] == '' ? '' : 'rowspan="' . $colAttributes[ 'RowSpan' ] . '"' );
					$code .= "<td $classTag $styleTag $extrasTag $colSpan $rowSpan>" . $colAttributes[ 'Content' ] . "</td>";
				}
				$colIndex++;

			}

			// End Row
			$code .= "</tr>";
			$rowIndex++;
			$colIndex = 0;
		}

		// End Table
		$code .= '</table>';
		$code .= '</div>';

		// Return
		return $code;
	}
}

// Grid
class eleGrid extends element {
	// Constructor
	public function __construct() {
		parent::__construct();
	}

	public function render( $content = '' ) {
		// Override
		$content = ( isEmpty( $content ) ? $this->content : $content );
		// Code
		ob_start();
		?>
		<div class="container"><?= $content ?></div>
		<?php
		return ob_get_clean();
	}
}

// GridRow
class eleGridRow extends element {
	// Vars

	// Constructor
	public function __construct( $alignVertical = GRID_ALIGN_TOP ) {
		parent::__construct();
		$this->alignVertical = $alignVertical;
	}

	public function render( $content = '' ) {
		// Override
		$content = ( isEmpty( $content ) ? $this->content : $content );
		// Code
		ob_start();
		?>
		<div class="row" style="position: relative;"><?= $content ?></div>
		<?php
		return ob_get_clean();
	}
}


class eleModal extends element {
	// Vars
	public $idPrefix = '';
	public $title = '';
	public $header = '';
	public $body = '';
	public $footer = '';
	public $jsInit = '';
	// Optional
	public $buttonCancelAutoDismiss = true;
	public $buttonActionAutoDismiss = true;
	public $buttonActionDanger = false;

	public function __construct( $idPrefix ) {
		parent::__construct();
		$this->idPrefix = $idPrefix;
	}

	public function renderModalWButtons( $title, $header, $body, $footer, $buttonCancelLabel, $buttonActionLabel, $buttonActionExtrasA, $modalInitJS ) {
		// Button Cancel
		$modalButtonCancelDismiss = ( $this->buttonCancelAutoDismiss ? 'data-dismiss="modal"' : '' );
		$modalButtonCancelTags = new tags( [ ELE_CLASS_BUTTON_RG_SECONDARY ], [], [ $modalButtonCancelDismiss ] );
		$modalButtonCancel = new eleButton($buttonCancelLabel,$this->idPrefix . '_Modal_ButtonCancel','',$modalButtonCancelTags);
		
		// Button Action
		$buttonActionExtrasA[] = ( $this->buttonActionAutoDismiss ? 'data-dismiss="modal"' : '' );
		$modalButtonActionClass = ( $this->buttonActionDanger ? ELE_CLASS_BUTTON_RG_DELETE : ELE_CLASS_BUTTON_RG_PRIMARY );
		$modalButtonActionTags = new tags( [ $modalButtonActionClass ], [], $buttonActionExtrasA );
		$modalButtonAction = new eleButton($buttonActionLabel,$this->idPrefix . '_Modal_ButtonAction','',$modalButtonActionTags);
		
		// Modal
		$code = $this->renderModal( $title, $header, $body, ( $buttonCancelLabel === '' ? '' : $modalButtonCancel->render() ) . ( $buttonActionLabel === '' ? '' : $modalButtonAction->render() ) . '<p>' . $footer . '</p>', $modalInitJS );
		return $code;
	}

	public function renderModal( $title, $header, $body, $footer, $initJS ) {
		$this->title = $title;
		$this->header = $header;
		$this->body = $body;
		$this->footer = $footer;
		$this->jsInit = $initJS;

		// Get parts.
		$title = ( isEmpty( $this->title ) ? '' : '<div class="modal-header"><h5 class="modal-title" id="' . $this->idPrefix . '_Modal_Label">' . $this->title . '</h5></div>' );
		$header = ( isEmpty( $this->header ) ? '' : '<div class="modal-header">' . $this->header . '</div>' );
		$body = ( isEmpty( $this->body ) ? '' : '<div class="modal-body">' . $this->body . '</div>' );
		$footer = ( isEmpty( $this->footer ) ? '' : '<div class="modal-footer">' . $this->footer . '</div>' );

		ob_start();
		?>
		<div class="modal fade" style="max-height: 95%;" id="<?= $this->idPrefix ?>_Modal" data-backdrop="true" data-keyboard="true" tabindex="-1" role="dialog" aria-labelledby="<?= $this->idPrefix ?>_Modal_Label" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable" role="document">
				<div class="modal-content">
					<?= $title . $header . $body . $footer ?>
				</div>
			</div>
		</div>
		<script>
			$( "#<?= $this->idPrefix ?>_Modal" ).on( "keypress", function ( event ) {
				let keycode = event.which || event.keyCode || event.charCode;
				if ( keycode === 13 ) {
					$( "#<?= $this->idPrefix ?>_Modal > .modal-dialog > .modal-content > .modal-footer > .btn-primary" ).click();
				}
			} );
			<?= strTagsRemoveScript( $this->jsInit ) ?>
		</script>
		<?php
		$code = ob_get_clean();
		return $code;
	}

}


class eleLabel extends element {
	public function __construct( $label, $id, $name, tags $tags ) {
		parent::__construct();
		$this->labelValue = $label;
		$this->idValue = $id;
		$this->nameValue = $name;
		$this->tags = $tags;
	}

	public function render( $isPortal = false, $absTop = '', $absRight = '', $sbsBottom = '', $absLeft = '' ) {
		// ID
		$this->idTag = ( isEmpty($this->idValue ) ? '' : 'id="' . $this->idValue . '"' );
		// Name
		$this->nameTag = ( isEmpty($this->nameValue ) ? '' : 'name="' . $this->nameValue . '"' );
		
		// Class, Style, and Extras
		$this->styleD[ 'line-height' ] = '1.12';
		
		// Absolute
		if ( isNotEmpty( $absTop ) || isNotEmpty( $absRight ) || isNotEmpty( $sbsBottom ) ||  isNotEmpty( $absLeft ) ){
			 $this->styleD[ 'position' ] = 'absolute';
			 if ( isNotEmpty( $absTop ) ){
				 $this->styleD[ 'top' ] = $absTop;
			 }
			 if ( isNotEmpty( $absRight ) ){
				 $this->styleD[ 'right' ] = $absRight;
			 }
			 if ( isNotEmpty( $sbsBottom ) ){
				 $this->styleD[ 'bottom' ] = $sbsBottom;
			 }
			 if ( isNotEmpty( $absLeft ) ){
				 $this->styleD[ 'left' ] = $absLeft;
			 }
		}
		
		// Font Size
		if ( $isPortal ){
			$this->styleD[ 'font-size' ] = PORTAL_LABEL_FONT_SIZE;
		}else{
			$this->classA[] = 'small';
		}
		// Init Tags
		$this->initTags();
		// Value
		$this->valueValue = $this->labelValue;
		// Return
		$code = "<div $this->idTag $this->nameTag $this->classTag $this->styleTag $this->extrasTag>$this->valueValue</div>";
		return $code;
	}
}


class eleButton extends element {
	public function __construct( $label, $id, $name, tags $tags ) {
		parent::__construct();
		$this->labelValue = $label;
		$this->idValue = $id;
		$this->nameValue = $name;
		$this->tags = $tags;
	}

	public function render() {
		// ID
		$this->idTag = ( isEmpty($this->idValue ) ? '' : 'id="' . $this->idValue . '"' );
		// Name
		$this->nameTag = ( isEmpty($this->nameValue ) ? '' : 'name="' . $this->nameValue . '"' );
		// Type
		$this->typeTag = 'type="button"';
		// Class, Style, and Extras
		$this->initTags();
		// Return
		$code = "<button $this->idTag $this->nameTag $this->typeTag $this->classTag $this->styleTag $this->extrasTag>$this->labelValue</button>";
		return $code;
	}
}


class eleURLImage extends element {
	// Vars
	public $urlValue = '';
	public $urlTag = '';
	public $isLazyLoad = false;
	public $altValue = '';
	public $altTag = '';

	// Notes:
	// Class: img-thumbnail = Adds a border around the Image

	public function __construct( $url, $isLazyLoad, $id, $name, $alt,tags $tags ) {
		parent::__construct();
		$this->urlValue = $url;
		$this->isLazyLoad = $isLazyLoad;
		$this->altValue = $alt;
		$this->idValue = $id;
		$this->nameValue = $name;
		$this->tags = $tags;
	}

	public function render() {
		// Alt
		$this->altTag = ( isEmpty($this->altValue ) ? '' : 'alt="' . $this->altValue . '"' );
		// URL
		if ( $this->isLazyLoad ) {
			$this->urlTag = ( isEmpty($this->urlValue ) ? '' : 'data-src="' . $this->urlValue . '"' );
			$this->classA[] = 'lazy';
		} else {
			$this->urlTag = ( isEmpty($this->urlValue ) ? '' : 'src="' . $this->urlValue . '"' );
		}
		// ID
		$this->idTag = ( isEmpty($this->idValue ) ? '' : 'id="' . $this->idValue . '"' );
		// Name
		$this->nameTag = ( isEmpty($this->nameValue ) ? '' : 'name="' . $this->nameValue . '"' );
		// Class, Style, and Extras
		$this->classA[] = 'img-fluid';
		$this->initTags();
		// Return
		$code = "<img $this->altTag $this->urlTag $this->idTag $this->nameTag $this->classTag $this->styleTag $this->extrasTag>";
		return $code;
	}
}


class eleText extends element {
	public function __construct( $value, $id, $name, tags $tags ) {
		parent::__construct();
		$this->valueValue = $value;
		$this->idValue = $id;
		$this->nameValue = $name;
		$this->tags = $tags;
	}

	public function render() {
		// Init
		$this->initEle();
		// Type
		$this->typeTag = 'type="text"';
		// Return
		$code = "<input $this->typeTag $this->idTag $this->nameTag $this->classTag $this->styleTag $this->extrasTag $this->valueTag>";
		return $code;
	}
}


class eleTextHidden extends element {
	public function __construct( $value, $id, $name, tags $tags ) {
		parent::__construct();
		$this->valueValue = $value;
		$this->idValue = $id;
		$this->nameValue = $name;
		$this->tags = $tags;
	}

	public function render() {
		// Init
		$this->initEle();
		// Type
		$this->typeTag = 'type="hidden"';
		// Return
		$code = "<input $this->typeTag $this->idTag $this->nameTag $this->classTag $this->styleTag $this->extrasTag $this->valueTag>";
		return $code;
	}
}


class eleTextReveal extends element {
	public function __construct( $value, $id, $name, tags $tags ) {
		parent::__construct();
		$this->valueValue = $value;
		$this->idValue = $id;
		$this->nameValue = $name;
		$this->tags = $tags;
	}

	public function render() {
		// Init
		$this->initEle();
		// Type
		$this->typeTag = 'type="password"';
		// Return
		$input = "<input $this->typeTag $this->idTag $this->nameTag $this->classTag $this->styleTag $this->extrasTag $this->valueTag>";
		ob_start();
		?>
		<div class="input-group" id="<?= $this->idValue . '_Group' ?>">
			<?= $input ?>
			<div class="input-group-append" id="<?= $this->idValue . '_Reveal' ?>">
				<button class="<?= ELE_CLASS_BUTTON_RG_SECONDARY ?> p-1 mb-1" id="<?= $this->idValue . '_Button' ?>" type="button" onclick="let x = document.getElementById('<?= $this->idValue ?>'); if (x.type === 'password') { x.type = 'text'; } else { x.type = 'password'; }"><?= iconFA( 'fas fa-eye' ) ?></button>
			</div>
		</div>
		<?php
		// Return
		$code = ob_get_clean();
		
		return $code;
	}
}


class eleTextDB extends element {
	public function __construct( colMeta $colMeta, tags $tags, recs $recs, formTag $formTag ) {
		parent::__construct();
		$this->colMeta = $colMeta;
		$this->tags = $tags;
		$this->recs = $recs;
		$this->formTag = $formTag;
	}

	public function render() {
		// Init
		$this->initEleDB();
		// Type
		$this->typeTag = 'type="text"';
		// Return
		$code = "<input $this->typeTag $this->idTag $this->nameTag $this->labelTag $this->formatTag $this->keyTag $this->classTag $this->styleTag $this->extrasTag $this->valueTag>";
		return $code;
	}
}


class eleTextAreaDB extends element {
	public function __construct( colMeta $colMeta, tags $tags, recs $recs, formTag $formTag ) {
		parent::__construct();
		$this->colMeta = $colMeta;
		$this->tags = $tags;
		$this->recs = $recs;
		$this->formTag = $formTag;
	}

	public function render() {
		// Init
		$this->initEleDB();
		// Overrides
		$this->valueValue = paramDecode( $this->valueValue );
		// Return
		$code = "<textarea $this->typeTag $this->idTag $this->nameTag $this->labelTag $this->classTag $this->styleTag $this->extrasTag>$this->valueValue</textarea>";
		return $code;
	}
}


class eleTextHiddenDB extends element {
	public function __construct( colMeta $colMeta, tags $tags, recs $recs, formTag $formTag ) {
		parent::__construct();
		$this->colMeta = $colMeta;
		$this->tags = $tags;
		$this->recs = $recs;
		$this->formTag = $formTag;
	}

	public function render() {
		// Init
		$this->initEleDB();
		// Type
		$this->typeTag = 'type="hidden"';
		// Return
		$code = "<input $this->typeTag $this->idTag $this->nameTag $this->labelTag $this->classTag $this->styleTag $this->extrasTag $this->valueTag>";
		return $code;
	}
}


class eleTextPasswordDB extends element {
	public function __construct( colMeta $colMeta, tags $tags, recs $recs, formTag $formTag ) {
		parent::__construct();
		$this->colMeta = $colMeta;
		$this->tags = $tags;
		$this->recs = $recs;
		$this->formTag = $formTag;
	}

	public function render() {
		// Init
		$this->initEleDB();
		// Type
		$this->typeTag = 'type="password"';
		// Return
		$code = "<input $this->typeTag $this->idTag $this->nameTag $this->labelTag $this->classTag $this->styleTag $this->extrasTag $this->valueTag>";
		return $code;
	}
}

class eleTextRevealDB extends element {
	public function __construct( colMeta $colMeta, tags $tags, recs $recs, formTag $formTag ) {
		parent::__construct();
		$this->colMeta = $colMeta;
		$this->tags = $tags;
		$this->recs = $recs;
		$this->formTag = $formTag;
	}

	public function render() {
		// Init
		$this->initEleDB();
		// Type
		$this->typeTag = 'type="password"';
		// Return
		$input = "<input $this->typeTag $this->idTag $this->nameTag $this->labelTag $this->formatTag $this->classTag $this->styleTag $this->extrasTag $this->valueTag>";
		ob_start();
		?>
		<div class="input-group">
			<?= $input ?>
			<div class="input-group-append">
				<button class="<?= ELE_CLASS_BUTTON_RG_SECONDARY ?> p-1 mb-1" type="button" onclick="let x = document.getElementById('<?= $this->idValue ?>'); if (x.type === 'password') { x.type = 'text'; } else { x.type = 'password'; }"><?= iconFA( 'fas fa-eye' ) ?></button>
			</div>
		</div>
		<?php
		// Return
		$code = ob_get_clean();
		return $code;
	}
}


class eleTextTypeaheadDB extends element {
	public $choicesAValues = [];  //  array( 'Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', ... 'Wyoming' );

	public function __construct( colMeta $colMeta, tags $tags, recs $recs, formTag $formTag ) {
		parent::__construct();
		$this->colMeta = $colMeta;
		$this->tags = $tags;
		$this->recs = $recs;
		$this->formTag = $formTag;
	}

	public function render() {


		// Init
		$this->initEleDB();
		// Type
		$this->typeTag = 'type="text"';
		// Return
		$code = "<input $this->typeTag $this->idTag $this->nameTag $this->labelTag $this->classTag $this->styleTag $this->extrasTag $this->valueTag>";
		return $code;
	}

	public function renderScriptDoInit() {
		// Javascript
		ob_start();
		?>
		<script>
			new autoComplete( {
				selector: '#<?= $this->idValue ?>',
				minChars: 1,
				delay: 150,
				offsetLeft: 0,
				offsetTop: 1,
				source: function ( term, suggest ) {
					term = term.toLowerCase();
					let choices = <?= arrayToJavascriptArrayString( $this->colMeta->choicesAValues ) ?>;
					let matches = [];
					for ( i = 0; i < choices.length; i++ ) {
						// Include Term if if found, with a leading space, in Choices.
						let thisChoice = ' ' + choices[ i ].toLowerCase();
						if ( thisChoice.includes( ' ' + term.toLowerCase() ) ) {
							matches.push( choices[ i ] );
						}
						// Include Term if found in Choices.
						// if ( ~choices[ i ].toLowerCase().indexOf( term ) ) matches.push( choices[ i ] );
					}
					suggest( matches );
				},
				onSelect: function ( e, term, item ) {
					$( '#<?= $this->idValue ?>' ).change();
				}
			} );
		</script>
		<?php
		// Return
		$code = strTagsRemoveScript( ob_get_clean() );
		return $code;
	}
}


class eleSelectDB extends element {
	// Vars
	public $choicesAValues = [];
	public $choicesADisplay = [];
	public $choicesOtherLabel = '';
	public $choicesClearLabel = '';

	public function __construct( colMeta $colMeta, tags $tags, recs $recs, formTag $formTag ) {
		parent::__construct();
		$this->colMeta = $colMeta;
		$this->tags = $tags;
		$this->recs = $recs;
		$this->formTag = $formTag;
		$this->choicesAValues = $choicesAValues;
		$this->choicesADisplay = $choicesADisplay;
		$this->choicesClearLabel = $choicesClearLabel;
		$this->choicesOtherLabel = $choicesOtherLabel;
	}

	public function render() {
		// Init
		$this->initEleDB();
		// Init Hidden
		$codeHidden = "<input type='hidden' $this->idTag $this->nameTag $this->labelTag $this->keyTag $this->classTag $this->styleTag $this->extrasTag $this->valueTag>";
		// Init Select
		$codeSelect = '';
		$idValue = $this->idValue . '_Select';
		$idTag = 'id="' . $idValue . '"';
		// Select Begin
		ob_start();
		?>
		<select <?= "$idTag $this->classTag $this->styleTag $this->extrasTag" ?> onfocus="ele = $( '#<?= $idValue ?>' ); ele.data( 'prev', ele.val() );" onchange="xanEleSelectOnChange( '<?= $this->idValue ?>', this.value );">
		<option value="" selected><?= STR_SELECT_INDICATOR ?></option>
		<?php
		$codeSelect .= ob_get_clean();
		// Remove xanDoSave
		$codeSelect = strSubstitute($codeSelect,'xanDoSave',''); // The Hidden Element will handle saving.
		// Choice Options
		if ( is_array( $this->colMeta->choicesAValues ) and is_array( $this->colMeta->choicesADisplay ) ) {
			for ( $i = 0; $i < count( $this->colMeta->choicesAValues ); $i++ ) {
				$codeSelect .= '<option value="' . $this->colMeta->choicesAValues[ $i ] . '"' . ( $this->valueValue === $this->colMeta->choicesAValues[ $i ] ? ' selected' : '' ) . '>' . $this->colMeta->choicesADisplay[ $i ] . '</option>';
			}
		}
		// Divider
		if ( isNotEmpty( $this->colMeta->choicesOtherLabel ) or isNotEmpty( $this->colMeta->choicesClearLabel ) ) {
			$codeSelect .= '<option disabled>─────────</option>';
		}
		// Other...
		if ( isNotEmpty( $this->colMeta->choicesOtherLabel ) ) {
			$codeSelect .= '<option value="Other">' . $this->colMeta->choicesOtherLabel . '</option>';
		}
		// Clear
		if ( isNotEmpty( $this->colMeta->choicesClearLabel ) ) {
		   $codeSelect .= '<option value="Clear">' . $this->colMeta->choicesClearLabel . '</option>';
		}
		// Select End
		$codeSelect .= '</select>';

		// Modal for 'Other...'
		$codeModal = '';
		if ( isNotEmpty( $this->colMeta->choicesOtherLabel ) ) {
			ob_start() ?>
			<script>
				$( "#<?= $this->idValue ?>_Modal" ).on( "shown.bs.modal", function () {
					$( "#<?= $this->idValue ?>_Modal_Input" ).val( $( "#<?= $this->idValue ?>" ).val() );
					$( "#<?= $this->idValue ?>_Modal_Input" ).trigger( "select" );
				} );
			</script>
			<?php
			$modalScript = ob_get_clean();
			// Modal
			$modal = new eleModal($this->idValue);
			$modalBody = $this->colMeta->colLabel . STR_NBSP . '<input class="' . ELE_CLASS . ' p-1 mb-1 col-8" id="' . $this->idValue . '_Modal_Input">';
			$codeModal = $modal->renderModalWButtons($this->choicesOtherLabel,'',$modalBody,'','Cancel','OK',[ 'onclick="xanEleSelectOtherAction( \'' . $this->idValue . '\' );"' ],$modalScript);
		}

		// Return
		return $codeHidden . $codeSelect . $codeModal;

	}
}


class eleDateDB extends element {
	public function __construct( colMeta $colMeta, tags $tags, recs $recs, formTag $formTag ) {
		parent::__construct();
		$this->colMeta = $colMeta;
		$this->tags = $tags;
		$this->recs = $recs;
		$this->formTag = $formTag;
	}

	public function render() {
		// Class, Style, Extras
		$this->classA[] = 'flatpickr_date';
		$this->classA[] = TEXT_ALIGN_RIGHT;
		$this->styleD[ 'color' ] = 'rgba(0, 0, 0, 0)';
		// Init
		$this->initEleDB();
		// Type
		$this->typeTag = 'type="text"';
		// Return
		$code = "<div id='" . $this->idValue . "-flatpickr-div'><input $this->typeTag $this->idTag $this->nameTag $this->labelTag $this->classTag $this->styleTag $this->extrasTag $this->valueTag></div>";
		return $code;
	}

	public function renderScriptsDoInit() {
		// Remove and Add Class Styles to Generated Input
		$classFlatpickerGenerated = strSubstitute( ' ' . $this->classValue . ' ', ' flatpickr_date ', ' ' );
		$classFlatpickerGenerated = strSubstitute( ' ' . $classFlatpickerGenerated . ' ', ' xanDoSave ', ' ' );
		$classFlatpickerGenerated = strSubstitute( ' ' . $classFlatpickerGenerated . ' ', ' col ', ' ' );
		$classFlatpickerGenerated = trim( $classFlatpickerGenerated ) . ' col-12';
		ob_start();
		?>
		<script>
			$( function () {
				$( "#<?= $this->idValue ?>-flatpickr-div > .flatpickr_date-generated" ).addClass( "<?= $classFlatpickerGenerated ?>" );
			} );
		</script>
		<?php
		// Return
		$code = strTagsRemoveScript( ob_get_clean() );
		return $code;
	}

	public function renderSelector() {
		// Init
		$this->styleD[ 'width' ] = '20px';
		$this->styleD[ 'font-size' ] = '16px';
		$this->initEleDB( false );
		// Selector
		$idValue = $this->idValue . '_Selector';
		$idTag = 'id="' . $idValue . '"';
		ob_start();
		?>
		<select <?= "$idTag $this->nameTag $this->classTag $this->styleTag $this->extrasTag" ?> onchange="xanEleFlatpickrSet( '#<?= $idValue ?>', '#<?= $this->idValue ?>', 'date', this.value );">
			<option value="" selected><?= STR_SELECT_INDICATOR ?></option>
			<?= eleSelectOptionsDates() ?>
		</select>
		<?php
		// Return
		$code = ob_get_clean();
		return $code;
	}
}


class eleDateTimeDB extends element {
	public function __construct( colMeta $colMeta, tags $tags, recs $recs, formTag $formTag ) {
		parent::__construct();
		$this->colMeta = $colMeta;
		$this->tags = $tags;
		$this->recs = $recs;
		$this->formTag = $formTag;
	}

	public function render() {
		// Class, Style, Extras
		$this->classA[] = 'flatpickr_datetime';
		$this->classA[] = TEXT_ALIGN_RIGHT;
		$this->styleD[ 'color' ] = 'rgba(0, 0, 0, 0)';
		// Init
		$this->initEleDB();
		// Type
		$this->typeTag = 'type="text"';
		// Return
		$code = "<div id='" . $this->idValue . "-flatpickr-div'><input $this->typeTag $this->idTag $this->nameTag $this->labelTag $this->classTag $this->styleTag $this->extrasTag $this->valueTag></div>";
		return $code;
	}

	public function renderScriptsDoInit() {
		// Remove and Add Class Styles to Generated Input
		$classFlatpickerGenerated = strSubstitute( ' ' . $this->classValue . ' ', ' flatpickr_datetime ', ' ' );
		$classFlatpickerGenerated = strSubstitute( ' ' . $classFlatpickerGenerated . ' ', ' xanDoSave ', ' ' );
		$classFlatpickerGenerated = strSubstitute( ' ' . $classFlatpickerGenerated . ' ', ' col ', ' ' );
		$classFlatpickerGenerated = trim( $classFlatpickerGenerated ) . ' col-12';
		ob_start();
		?>
		<script>
			$( function () {
				$( "#<?= $this->idValue ?>-flatpickr-div > .flatpickr_datetime-generated" ).addClass( "<?= $classFlatpickerGenerated ?>" );
			} );
		</script>
		<?php
		// Return
		$code = strTagsRemoveScript( ob_get_clean() );
		return $code;
	}

	public function renderSelector() {
		// Init
		$this->styleD[ 'width' ] = '20px';
		$this->styleD[ 'font-size' ] = '16px';
		$this->initEleDB( false );
		// Selector
		$idValue = $this->idValue . '_Selector';
		$idTag = 'id="' . $idValue . '"';
		ob_start();
		?>
		<select <?= "$idTag $this->nameTag $this->classTag $this->styleTag $this->extrasTag" ?> onchange="xanEleFlatpickrSet( '#<?= $idValue ?>', '#<?= $this->idValue ?>', 'datetime', this.value );">
			<option value="" selected><?= STR_SELECT_INDICATOR ?></option>
			<?= eleSelectOptionsDates() ?>
		</select>
		<?php
		// Return
		$code = ob_get_clean();
		return $code;
	}
}


class eleTimeDB extends element {
	public function __construct( colMeta $colMeta, tags $tags, recs $recs, formTag $formTag ) {
		parent::__construct();
		$this->colMeta = $colMeta;
		$this->tags = $tags;
		$this->recs = $recs;
		$this->formTag = $formTag;
	}

	public function render() {
		// Class, Style, Extras
		$this->classA[] = 'flatpickr_time';
		$this->classA[] = TEXT_ALIGN_RIGHT;
		$this->styleD[ 'color' ] = 'rgba(0, 0, 0, 0)';
		// Init
		$this->initEleDB();
		// Type
		$this->typeTag = 'type="text"';
		// Return
		$code = "<div id='" . $this->idValue . "-flatpickr-div'><input $this->typeTag $this->idTag $this->nameTag $this->labelTag $this->classTag $this->styleTag $this->extrasTag $this->valueTag></div>";
		return $code;
	}

	public function renderScriptsDoInit() {
		// Remove and Add Class Styles to the Flatpickr Generated Input
		$classGenerated = strSubstitute( ' ' . $this->classValue . ' ', ' flatpickr_time ', ' ' );
		$classGenerated = strSubstitute( ' ' . $classGenerated . ' ', ' xanDoSave ', ' ' );
		$classGenerated = strSubstitute( ' ' . $classGenerated . ' ', ' col ', ' ' );
		$classGenerated = trim( $classGenerated ) . ' col-12';
		ob_start();
		?>
		<script>
			$( function () {
				$( "#<?= $this->idValue ?>-flatpickr-div > .flatpickr_time-generated" ).addClass( "<?= $classGenerated ?>" );
			} );
		</script>
		<?php
		// Return
		$code = strTagsRemoveScript( ob_get_clean() );
		return $code;
	}

	public function renderSelector() {
		// Init
		$this->styleD[ 'width' ] = '20px';
		$this->styleD[ 'font-size' ] = '16px';
		$this->initEleDB( false );
		// Selector
		$idValue = $this->idValue . '_Selector';
		$idTag = 'id="' . $idValue . '"';
		ob_start();
		?>
		<select <?= "$idTag $this->nameTag $this->classTag $this->styleTag $this->extrasTag" ?> onchange="xanEleFlatpickrSet( '#<?= $idValue ?>', '#<?= $this->idValue ?>', 'time', this.value );">
			<option value="" selected><?= STR_SELECT_INDICATOR ?></option>
			<?= eleSelectOptionsTimes() ?>
		</select>
		<?php
		// Return
		$code = ob_get_clean();
		return $code;
	}
}


class eleFileBucketImageDB extends element {
	// Vars
	public $fileBucketKey = '';
	public $fileBucketURL = '';
	public $fileTypes = '';

	public function __construct( colMeta $colMeta, tags $tags, recs $recs, formTag $formTag ) {
		parent::__construct();
		$this->colMeta = $colMeta;
		$this->tags = $tags;
		$this->recs = $recs;
		$this->formTag = $formTag;
		// Init
		$this->initEleDB();
		// Bucket Key
		$this->fileBucketKey = fileBucketKey($this->formTag->tableName,$this->formTag->keyValue,$this->colMeta->colName );
		// Bucket URL
		$this->fileBucketURL = fileBucketURL($this->formTag->tableName,$this->formTag->keyValue,$this->colMeta->colName, $this->valueValue );
	}

	public function renderImage() {
		// Hidden
		$eleHidden = new eleTextHiddenDB( $this->colMeta, $this->tags, $this->recs, $this->formTag );
		$code = $eleHidden->render();
		// Img
		$eleImg = new eleURLImage($this->fileBucketURL,false,$this->idValue . '_Img',$this->nameValue . '_Img',$this->colMeta->colLabel,$this->tags );
		$code .= $eleImg->render();
		return $code;
	}

	public function renderFormUpload( $fileTypes, $jsSuccess, $jsProblem ) {
		// Init
		$this->fileTypes = $fileTypes;
		// Values
		$idForm = $this->idValue . "_Form";
		$idFormFile = $this->idValue . "_FormFile";
		$idImg = $this->idValue . "_Img";
		$jsfnNameSuccess = strFilterKeepAlphanumeric($this->idValue) . "_FormSuccess";
		$jsfnNameProblem = strFilterKeepAlphanumeric($this->idValue) . "_FormProblem";
		// Form
		ob_start();
		?>
		<form method="post" action="<?= URL_BUCKET_UPLOAD_PAGE ?>" enctype="multipart/form-data" id="<?= $idForm ?>">
			<input type="hidden" name="fileKey" value="<?= $this->fileBucketKey ?>">
			<input type="hidden" name="fileTypes" value="<?= $this->fileTypes ?>">
			<div class="form-file-area float-right bg-primary" style="width: 2rem; height: 2rem;">
			<div class="form-file-icon"><?= FA_UPLOAD ?></div>
			<input class="form-file-input" type="file" name="file" id="<?= $idFormFile ?>" onChange='xanFileUploadToBucket( "#<?= $idForm ?>", "<?= URL_BUCKET_UPLOAD_PAGE ?>", <?= $jsfnNameSuccess ?>, <?= $jsfnNameProblem ?> );'>
			</div>
		</form>
		<script>
		function <?= $jsfnNameSuccess ?>( pURL ) {
			let filename = pURL.substring( pURL.lastIndexOf( '/' ) + 1 );
			$( "#<?= $idFormFile ?>" ).val( null ); // Clear the Form File
			$( "#<?= $idImg ?>" ).attr( "src", pURL ); // Set the img URL
			<?= $jsSuccess ?>
			let iconID = Math.floor( ( Math.random() * 999999999 ) + 1 );
			xanMessageDisplay( "#xanMessage", "<?= FA_PSOS_SAVE ?>", iconID, '', true, false );
			let messageID = Math.floor( ( Math.random() * 999999999 ) + 1 );
			xanMessageDisplay( "#xanMessage", "<span class='text-success'>Uploaded</span>", messageID, iconID, true, true );
		}
		function <?= $jsfnNameProblem ?>( pMessage ) {
			<?= $jsProblem ?>
			xanMessageDisplay( "#xanMessage", "<?= FA_PSOS_ERROR ?>", "", "", false, false );
			xanMessageDisplay( "#xanMessage", "<span class='text-danger'>Upload Problem: " + pMessage + "</span>", "", "", false, true );
		}
		</script>
		<?php
		$code = ob_get_clean();
		// Return
		return $code;
	}
}


class eleSearchBarSimpleDB extends element {
	// Vars
	public $idPrefix = '';
	public $defaultValue = '';
	public $onSearch = '';

	public function __construct( $idPrefix, $defaultValue, $onSearch ) {
		parent::__construct();
		$this->idPrefix = $idPrefix;
		$this->defaultValue = $defaultValue;
		$this->onSearch = $onSearch;
	}

	public function render() {
		ob_start() ?>
		<div class="p-0">
			<div class="input-group">
				<input type="text" class="<?= ELE_CLASS ?>" name="SearchTerm" id="<?= $this->idPrefix ?>_SearchTerm" value="<?= $this->defaultValue ?>" placeholder="" aria-label="<?= $this->idPrefix ?> Search" aria-describedby="<?= $this->idPrefix ?>_SearchButtonDo">
				<div class="input-group-append">
					<button class="<?= ELE_CLASS_BUTTON_SM_SEARCHBAR ?>" type="button" id="<?= $this->idPrefix ?>_SearchButtonDo" onclick="<?= $this->onSearch ?>"><?= FA_SEARCH ?></button>
					<button class="<?= ELE_CLASS_BUTTON_SM_SEARCHBAR ?>" type="button" id="<?= $this->idPrefix ?>_SearchButtonClear" onclick="$( '#<?= $this->idPrefix ?>_SearchTerm' ).val(''); $( '#<?= $this->idPrefix ?>_SearchButtonDo' ).click();"><?= FA_CLEAR ?></button>
				</div>
			</div>
		</div>
		<script>
			$( '#<?= $this->idPrefix ?>_SearchTerm' ).bind( 'keypress', function ( e ) {
				if ( e.keyCode == 13 ) { // Click on return key
					$( '#<?= $this->idPrefix ?>_SearchButtonDo' ).click();
				}
			} );
		</script>
		<?php
		return ob_get_clean();
	}

}


class eleSearchBarListDB extends element {
	// Vars
	public moduleMeta $mm;
	public $postEncoded;
	public response $resp;
	public $idPrefix;

	public function __construct( moduleMeta $mm, $postEncoded, response &$resp ) {
		parent::__construct();
		$this->mm = $mm;
		$this->postEncoded = $postEncoded;
		$this->resp = $resp;
		$this->idPrefix = $mm->NameTable . '';
	}

	public function render(){
		// Search Session Vars Init
		$_SESSION[ $this->idPrefix . 'SearchTerm' ] = ( isset( $this->postEncoded[ $this->idPrefix . 'SearchTerm' ] ) ? $this->postEncoded[ $this->idPrefix . 'SearchTerm' ] : $_SESSION[ $this->idPrefix . 'SearchTerm' ] );
		$_SESSION[ $this->idPrefix . 'SearchQBStringWhere' ] = ( isset( $this->postEncoded[ $this->idPrefix . 'SearchQBStringWhere' ] ) ? $this->postEncoded[ $this->idPrefix . 'SearchQBStringWhere' ] : $_SESSION[ $this->idPrefix . 'SearchQBStringWhere' ] );
		$_SESSION[ $this->idPrefix . 'SearchQBBindWhere' ] = ( isset( $this->postEncoded[ $this->idPrefix . 'SearchQBBindWhere' ] ) ? $this->postEncoded[ $this->idPrefix . 'SearchQBBindWhere' ] : $_SESSION[ $this->idPrefix . 'SearchQBBindWhere' ] );
		$_SESSION[ $this->idPrefix . 'SearchQBBindParams' ] = ( isset( $this->postEncoded[ $this->idPrefix . 'SearchQBBindParams' ] ) ? $this->postEncoded[ $this->idPrefix . 'SearchQBBindParams' ] : $_SESSION[ $this->idPrefix . 'SearchQBBindParams' ] );
		$_SESSION[ $this->idPrefix . 'SearchQBRules' ] = ( isset( $this->postEncoded[ $this->idPrefix . 'SearchQBRules' ] ) ? $this->postEncoded[ $this->idPrefix . 'SearchQBRules' ] : $_SESSION[ $this->idPrefix . 'SearchQBRules' ] );
		$_SESSION[ $this->idPrefix . 'SearchSort' ] = ( isset( $this->postEncoded[ $this->idPrefix . 'SearchSort' ] ) ? $this->postEncoded[ $this->idPrefix . 'SearchSort' ] : $_SESSION[ $this->idPrefix . 'SearchSort' ] );

		// Order By Init
		if ( isEmpty( $_SESSION[ $this->idPrefix . 'SearchSort' ] ) ) {
			$_SESSION[ $this->idPrefix . 'SearchSort' ] = $this->mm->QueryOrderByDefault;
		}

		// QueryBuilder Init
		$nameQB = $this->idPrefix . 'QueryBuilder';  // Unique ID Prefix

		// QueryBuilder Form Placeholder
		ob_start();
		?>
			<div id="<?= $nameQB . '_Form' ?>"></div>
			<div class="btn-group">
				<button id="<?= $nameQB . '_Clear' ?>" class="btn btn-warning">Clear</button>
			</div>
		<?php
		$queryBuilderForm = ob_get_clean();

		// QueryBuilder Rules
		ob_start();
		?>
			<script>
				// Rules Init
				var <?= $nameQB . '_RulesInit' ?> = { condition: "AND", rules: [<?= $this->mm->QueryBuilderDefault ?>] };

				// Form Options
				$( "#<?= $nameQB . "_Form" ?>" ).queryBuilder( {
					filters: [
						<?php
						$qrItems = '';
						if ( $GLOBALS[ 'schema' ] !== null ) {
							foreach ( $GLOBALS[ 'schema' ][ $this->mm->NameTable ] as $key => $val ) {
								$colLabel = ( isEmpty( $val[ 'label_en' ] ) ? $val[ 'COLUMN_NAME' ] : $val[ 'label_en' ] );
								if ( strPatternCount( $val[ 'type' ], 'Key' ) === 0 && strPatternCount( $val[ 'type' ], 'Mod' ) === 0 ) {
									$qrItems .= dbQueryBuilderFindFilter( $this->mm->NameTable, $val[ 'COLUMN_NAME' ], $colLabel ) . ', ';
								}
							}
							// Remove the last comma
							$qrItems = substr( $qrItems, 0, strlen( $qrItems ) - 2 );
						}
						echo $qrItems;
						?>
					],
					rules: <?= $nameQB . '_RulesInit' ?>
				} );

				// Form Set from Session
				let <?= $nameQB . '_RulesSQL' ?> = "<?= $_SESSION[ $this->idPrefix . 'SearchQBStringWhere' ] ?>";
				if ( <?= $nameQB . '_RulesSQL' ?> !== "" ) {
					$( "#<?= $nameQB . "_Form" ?>" ).queryBuilder( 'setRulesFromSQL', <?= $nameQB . '_RulesSQL' ?> );
				}

				// Form Clear
				$( "#<?= $nameQB . '_Clear' ?>" ).on( "click", function () {
					$( "#<?= $nameQB . "_Form" ?>" ).queryBuilder( "reset" );
				} );

				// Form Submit
				function <?= $nameQB . "_Submit" ?>() {
					let resultValidate = $( "#<?= $nameQB . "_Form" ?>" ).queryBuilder( 'validate' );
					if ( resultValidate ) {
						let sqlPlain = $( "#<?= $nameQB . "_Form" ?>" ).queryBuilder( 'getSQL', false );
						let sqlQuestions = $( "#<?= $nameQB . "_Form" ?>" ).queryBuilder( 'getSQL', 'question_mark' );
						let sqlRules = $( "#<?= $nameQB . "_Form" ?>" ).queryBuilder( 'getRules', { allow_invalid: false } );
						$( "#<?= $this->idPrefix ?>SearchTerm" ).val( "[Search Builder]" );
						$( "#<?= $this->idPrefix ?>SearchQBStringWhere" ).val( sqlPlain.sql );
						$( "#<?= $this->idPrefix ?>SearchQBBindWhere" ).val( sqlQuestions.sql );
						$( "#<?= $this->idPrefix ?>SearchQBBindParams" ).val( JSON.stringify( sqlQuestions.params, null, 0 ) );
						$( "#<?= $this->idPrefix ?>SearchQBRules" ).val( JSON.stringify( sqlRules, null, 0 ) );
						$( '#<?= $this->idPrefix ?>SearchButtonDo' ).click();
						$( "#<?= $nameQB . '_Modal' ?>" ).modal( 'hide' );
					}
				}
			</script>
		<?php
		$queryBuilderRules = ob_get_clean();

		// QueryBuilder Modal
		$modal = new eleModal($nameQB);
		// $modalbutton1Tags = new tags( [ELE_CLASS_BUTTON_RG_SECONDARY], [], [] );
		// $modalbutton1 = $modal->renderButton('Cancel',true,$modalbutton1Tags);
		// $modalbutton2Tags = new tags( [ELE_CLASS_BUTTON_RG_PRIMARY], [], ['onclick="' . $nameQB . '_Submit();"'] );
		// $modalbutton2 = $modal->renderButton('Search',true,$modalbutton2Tags);
		// $this->resp->contentEndA[] = $modal->renderModal($this->mm->NamePlural . ' Search Builder','',$queryBuilderForm . $queryBuilderRules,$modalbutton1 . $modalbutton2,'');
		$this->resp->contentEndA[] = $modal->renderModalWButtons( $this->mm->NamePlural . ' Search Builder', '', $queryBuilderForm . $queryBuilderRules, '', 'Cancel', 'Search', [ 'onclick="' . $nameQB . '_Submit();"' ], '' );



		// Order By Dropdown Items
		$searchSortItems = $this->mm->QueryOrderByExtraBegin;
		if ( $GLOBALS[ 'schema' ] !== null ) {
			// Add for each Column EXCEPT for Key and Mod columns.
			foreach ( $GLOBALS[ 'schema' ][ $this->mm->NameTable ] as $key => $val ) {

				///////////////////////////////////////////////////////////
				$colEleMeta = $this->mm->getColMeta($val[ 'COLUMN_NAME' ],ELE_AS_DEFINED );
				$colLabel = ( isEmpty( $colEleMeta->colLabel ) ? $val[ 'COLUMN_NAME' ] : $colEleMeta->colLabel );
				if ( $colEleMeta->isKey === false ) {
					$searchSortItems .= dbQueryOrderByItem( $this->idPrefix, $val[ 'COLUMN_NAME' ] . ' ASC', $val[ 'COLUMN_NAME' ] . ' DESC', $colLabel );
				}
				///////////////////////////////////////////////////////////
				
			}
			ob_start() ?>
			<script>
				function <?= $this->idPrefix ?>_SearchSortAction( sortValue ) {
					$( '#<?= $this->idPrefix ?>SearchSort' ).val( sortValue );
					$( '#<?= $this->idPrefix ?>SearchButtonDo' ).click();
				}
			</script>
			<?php
			$searchSortItems .= ob_get_clean();
		}

		// List Query: Simple or Builder
		if ( $_SESSION[ $this->idPrefix . 'SearchTerm' ] !== '[Search Builder]' ) {
			// Search Simple
			$searchTermBlankAction = 'Show All';
			if ( $searchTermBlankAction === 'Show All' ) {
				$searchTermQuery = $_SESSION[ $this->idPrefix . 'SearchTerm' ];
			}
			if ( $searchTermBlankAction === 'Show None' ) {
				$searchTermQuery = ( isEmpty( $_SESSION[ $this->idPrefix . 'SearchTerm' ] ) ? '0Will1Not2Ever3Find4This5' : $_SESSION[ $this->idPrefix . 'SearchTerm' ] );
			}
			$searchWhere = ( isEmpty( $searchTermQuery ) ? '' : 'WHERE ( ' . dbSearchTermSQL( $this->mm->QuerySimpleDefault ) . ' )' );
			$searchTermBindNamesA = ( isEmpty( $searchTermQuery ) ? array() : dbSearchTermBindNamesA( $this->mm->QuerySimpleDefault ) );
			$searchTermBindValuesA = ( isEmpty( $searchTermQuery ) ? array() : dbSearchTermBindValuesA( $this->mm->QuerySimpleDefault, $searchTermQuery ) );
		} else {
			// Search Builder
			$searchWhere = 'WHERE ( ' . $_SESSION[ $this->idPrefix . 'SearchQBBindWhere' ] . ' )';
			$searchTermBindNamesA = array();
			$searchTermBindValuesA = json_decode( $_SESSION[ $this->idPrefix . 'SearchQBBindParams' ] );
		}

		// List Query SQL
		$queryWhere = $searchWhere;
		$queryOrderBy = ' ORDER BY ' . $_SESSION[ $this->idPrefix . 'SearchSort' ] . ' ';
		$result[ 'queryBindNames' ] = $searchTermBindNamesA;
		$result[ 'queryBindValues' ] = $searchTermBindValuesA;
		$result[ 'querySQL' ] = 'SELECT * FROM ' . $this->mm->NameTable . ' ' . $queryWhere . $queryOrderBy;
		
		// Button Search
		$buttonSearchSimpleTags = new tags( [ ELE_CLASS_BUTTON_SM_SEARCHBAR ], [], [ 'onclick="$( \'#' . $this->idPrefix . 'SearchForm' .'\' ).submit();"' ] );
		$buttonSearchSimpleEle = new eleButton( FA_SEARCH, $this->idPrefix . 'SearchButtonDo', '', $buttonSearchSimpleTags );

		// Button Search Advanced
		$buttonSearchAdvancedTags = new tags( [ ELE_CLASS_BUTTON_SM_SEARCHBAR ], [], [ 'onclick="$(\'#' . $this->idPrefix . 'QueryBuilder_Modal\').modal(\'show\');"' ] );
		$buttonSearchAdvancedEle = new eleButton( FA_SEARCHPLUS, $this->idPrefix . 'SearchButtonQueryBuilder', '', $buttonSearchAdvancedTags );

		// Button Sort
		$buttonSearchSortTags = new tags( [ ELE_CLASS_BUTTON_SM_SEARCHBAR ], [], [ 'data-toggle="dropdown"', 'aria-haspopup="true"', 'aria-expanded="false"', '' ] );
		$buttonSearchSortEle = new eleButton( FA_SORT, $this->idPrefix . 'SearchButtonSort', '', $buttonSearchSortTags );

		// Button Clear
		$buttonSearchClearTags = new tags( [ ELE_CLASS_BUTTON_SM_SEARCHBAR ], [], [ 'onclick="$( \'#' . $this->idPrefix . 'SearchTerm\' ).val(\'\'); $( \'#' . $this->idPrefix . 'SearchSort\' ).val(\'\'); $( \'#' . $this->idPrefix . 'SearchButtonDo\' ).click();"' ] );
		$buttonSearchClearEle = new eleButton( FA_CLEAR, $this->idPrefix . 'SearchButtonClear', '', $buttonSearchClearTags );

		// Search Bar!!!
		ob_start() ?>
			<div class="p-0">
				<form id="<?= $this->idPrefix ?>SearchForm" action="<?= $this->mm->URLRelative . $recIDRequested ?>" method="post">
					<div class="input-group">
						<input type="text" class="<?= ELE_CLASS ?>" name="<?= $this->idPrefix ?>SearchTerm" id="<?= $this->idPrefix ?>SearchTerm" value="<?= $_SESSION[ $this->idPrefix . 'SearchTerm' ] ?>" placeholder="" aria-label="<?= $this->idPrefix ?> Search" aria-describedby="<?= $this->idPrefix ?>SearchButtonDo">
						<div class="input-group-append">
							<?= $buttonSearchSimpleEle->render(); ?>
							<?= $buttonSearchAdvancedEle->render(); ?>
							<?= $buttonSearchSortEle->render(); ?>
							<div class="dropdown-menu dropdown-menu-right border-1" style="max-height: <?= DROPDOWN_HEIGHT_MAX ?>; overflow-y: auto; z-index: <?= ZINDEX_TOP ?>;" role="menu" aria-labelledby="<?= $this->idPrefix ?>SearchButtonSort">
								<?= $searchSortItems ?>
							</div>
							<?= $buttonSearchClearEle->render(); ?>
						</div>
					</div>
					<input type="hidden" name="<?= $this->idPrefix ?>SearchQBStringWhere" id="<?= $this->idPrefix ?>SearchQBStringWhere" value="<?= $_SESSION[ $this->idPrefix . 'SearchQBStringWhere' ] ?>">
					<input type="hidden" name="<?= $this->idPrefix ?>SearchQBBindWhere" id="<?= $this->idPrefix ?>SearchQBBindWhere" value="<?= $_SESSION[ $this->idPrefix . 'SearchQBBindWhere' ] ?>">
					<input type="hidden" name="<?= $this->idPrefix ?>SearchQBBindParams" id="<?= $this->idPrefix ?>SearchQBBindParams" value='<?= $_SESSION[ $this->idPrefix . 'SearchQBBindParams' ] ?>'>
					<input type="hidden" name="<?= $this->idPrefix ?>SearchQBRules" id="<?= $this->idPrefix ?>SearchQBRules" value='<?= $_SESSION[ $this->idPrefix . 'SearchQBRules' ] ?>'>
					<input type="hidden" name="<?= $this->idPrefix ?>SearchSort" id="<?= $this->idPrefix ?>SearchSort" value="<?= $_SESSION[ $this->idPrefix . 'SearchSort' ] ?>">
				</form>
			</div>
			<script>
				$( '#<?= $this->idPrefix ?>SearchTerm' ).bind( 'keypress', function ( e ) {
					if ( e.keyCode == 13 ) {
						$( '#<?= $this->idPrefix ?>SearchButtonDo' ).click();
					}
				} );
			</script>
		<?php
		$result[ 'searchbar' ] = ob_get_clean();

		// Return
		return $result;
	}
}


///////////////////////////////////////////////////////////
// Functions
///////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////
// Element from MetaTable Column
function eleDBMetaRender( colMeta $colMeta, tags $tags, recs $recs, formTag $formTag, response &$resp ) {
	// Element String
	$eleString = '';

	// Label in Lang Code
	switch ( APP_LANG_CODE ) {
		case 'en':
			$colMeta->colLabel = $colMeta->colLabelEN; // English
			break;
		default:
			$colMeta->colLabel = $colMeta->colLabelEN; // English Default
			break;
	}

	// Ele as Label
	if ( $colMeta->eleTypeAs == ELE_AS_LABEL ) {
		$ele = new eleLabel( $colMeta->colLabel, '', '', $tags );
		$eleString = $ele->render();
		return $eleString;
	}

	// Ele as Defined or Selector
	switch ( $colMeta->eleType ) {
		case ELE_TYPE_TEXT_DB:
			$ele = new eleTextDB( $colMeta, $tags, $recs, $formTag );
			$eleString = $ele->render();
			break;
		case ELE_TYPE_TEXTAREA_DB:
			$ele = new eleTextAreaDB( $colMeta, $tags, $recs, $formTag );
			$eleString = $ele->render();
			break;
		case ELE_TYPE_TEXTHIDDEN_DB:
			$ele = new eleTextHiddenDB( $colMeta, $tags, $recs, $formTag );
			$eleString = $ele->render();
			break;
		case ELE_TYPE_TEXTPASSWORD_DB:
			$ele = new eleTextPasswordDB( $colMeta, $tags, $recs, $formTag );
			$eleString = $ele->render();
			break;
		case ELE_TYPE_TEXTREVEAL_DB:
			$ele = new eleTextRevealDB( $colMeta, $tags, $recs, $formTag );
			$eleString = $ele->render();
			break;
		case ELE_TYPE_TEXTTYPEAHEAD_DB:
			$ele = new eleTextTypeaheadDB( $colMeta, $tags, $recs, $formTag );
			$eleString = $ele->render();
			$resp->scriptsDoInitA[] = $ele->renderScriptDoInit();
			break;
		case ELE_TYPE_SELECT_DB:
			$ele = new eleSelectDB( $colMeta, $tags, $recs, $formTag );
			$eleString = $ele->render();
			break;
		case ELE_TYPE_DATE_DB:
			$ele = new eleDateDB( $colMeta, $tags, $recs, $formTag );
			switch ( $colMeta->eleTypeAs ) {
				case ELE_AS_SELECTOR:
					$eleString = $ele->renderSelector();
					break;
				default:
					$eleString = $ele->render();
					$resp->scriptsDoInitA[] = $ele->renderScriptsDoInit();
			}
			break;
		case ELE_TYPE_DATETIME_DB:
			$ele = new eleDateTimeDB( $colMeta, $tags, $recs, $formTag );
			if ( $colMeta->eleTypeAs == ELE_AS_DEFINED ) {
				$eleString = $ele->render();
				$resp->scriptsDoInitA[] = $ele->renderScriptsDoInit();
			}
			if ( $colMeta->eleTypeAs == ELE_AS_SELECTOR ) {
				$eleString = $ele->renderSelector();
			}
			break;
		case ELE_TYPE_TIME_DB:
			$ele = new eleTimeDB( $colMeta, $tags, $recs, $formTag );
			if ( $colMeta->eleTypeAs == ELE_AS_DEFINED ) {
				$eleString = $ele->render();
				$resp->scriptsDoInitA[] = $ele->renderScriptsDoInit();
			}
			if ( $colMeta->eleTypeAs == ELE_AS_SELECTOR ) {
				$eleString = $ele->renderSelector();
			}
			break;
		case ELE_TYPE_FILE_BUCKET_IMAGE_DB:
			$ele = new eleFileBucketImageDB( $colMeta, $tags, $recs, $formTag );
			switch ( $colMeta->eleTypeAs ) {
				case ELE_AS_FILEUPLOADBUTTON:
					$eleString = $ele->renderFormUpload( FILE_TYPES_IMAGES, $tags->otherD['fileUploadSuccess'], $tags->otherD['fileUploadProblem'] );
					break;
				default:
					$eleString = $ele->renderImage();
			}
			break;
	}

	// Return
	return $eleString;
}


///////////////////////////////////////////////////////////
// Selectors

function eleSelectOptionsDates() {
	// See xan.js 'xanEleFlatpickrSet' function to add options.
	ob_start();
	?>
	<optgroup label="Now">
		<option value="Today">Today</option>
		<option value="Yesterday">Yesterday</option>
		<option value="Tomorrow">Tomorrow</option>
	</optgroup>
	<optgroup label="Year">
		<option value="Year Begin">Year Begin</option>
		<option value="Year End">Year End</option>
	</optgroup>
	<optgroup label="Quarter">
		<option value="Q1 Begin">Q1 Begin</option>
		<option value="Q1 End">Q1 End</option>
		<option value="Q2 Begin">Q2 Begin</option>
		<option value="Q2 End">Q2 End</option>
		<option value="Q3 Begin">Q3 Begin</option>
		<option value="Q3 End">Q3 End</option>
		<option value="Q4 Begin">Q4 Begin</option>
		<option value="Q4 End">Q4 End</option>
	</optgroup>
	<optgroup label="Month">
		<option value="Month Begin">Month Begin</option>
		<option value="Month End">Month End</option>
		<option value="Last Month Begin">Last Month Begin</option>
		<option value="Last Month End">Last Month End</option>
		<option value="Next Month Begin">Next Month Begin</option>
		<option value="Next Month End">Next Month End</option>
	</optgroup>
	<optgroup label="Week">
		<option value="Week Begin">Week Begin</option>
		<option value="Week End">Week End</option>
		<option value="Last Week Begin">Last Week Begin</option>
		<option value="Last Week End">Last Week End</option>
		<option value="Next Week Begin">Next Week Begin</option>
		<option value="Next Week End">Next Week End</option>
	</optgroup>
	<option disabled>─────────</option>
	<option value="Clear">Clear</option>
	<?php
	// Return
	$code = ob_get_clean();
	return $code;
}

function eleSelectOptionsTimes() {
	// See xan.js 'xanEleFlatpickrSet' function to add options.
	ob_start();
	?>
	<option value="Now">Now</option>
	<option disabled>───</option>
	<option value="7am">7am</option>
	<option value="8am">8am</option>
	<option value="9am">9am</option>
	<option value="10am">10am</option>
	<option value="11am">11am</option>
	<option value="12pm">12pm</option>
	<option disabled>───</option>
	<option value="1pm">1pm</option>
	<option value="2pm">2pm</option>
	<option value="3pm">3pm</option>
	<option value="4pm">4pm</option>
	<option value="5pm">5pm</option>
	<option value="6pm">6pm</option>
	<option value="7pm">7pm</option>
	<option disabled>───</option>
	<option value="8pm">8pm</option>
	<option value="9pm">9pm</option>
	<option value="10pm">10pm</option>
	<option value="11pm">11pm</option>
	<option value="12am">12am</option>
	<option disabled>───</option>
	<option value="1am">1am</option>
	<option value="2am">2am</option>
	<option value="3am">3am</option>
	<option value="4am">4am</option>
	<option value="5am">5am</option>
	<option value="6am">6am</option>
	<option disabled>───</option>
	<option value="Clear">Clear</option>
	<?php
	// Return
	$code = ob_get_clean();
	return $code;
}

///////////////////////////////////////////////////////////
// Ele Choices for Autocompelete / Dropdown
function choicesAFromSQLCols( $tableName, $sql, $sqlBindValuesA = [] ) {
	// Init
	$valueAndDisplayA = array();
	
	// Query
	global $mm; // Get Access To $mm
	$recs = new recs( $mm[ mmNameForTable( $tableName ) ] );
	$recs->querySQL = $sql;
	$recs->queryBindNamesA = array( );
	$recs->queryBindValuesA = $sqlBindValuesA;
	$recs->query();
	
	// Error Check
	if ( $recs->errorB ) {
		return $valueAndDisplayA;
	} else {
		// Recs Loop
		$recs->rowIndex = -1;
		foreach ( $recs->rowsD as $recsRow ) {
			$recs->rowIndex++;
			
            // Get Column Names for the Value and the Display
            $columnCount = count( array_keys( $recsRow ) );
            $colNameForValue = array_keys( $recsRow )[ 0 ];
            if ( $columnCount > 1 ) {
                $colNameForDisplay = array_keys( $recsRow )[ 1 ];
            }
            
            // Set Actual Value and Display Value
            $valueAndDisplayA[ 0 ][ $recs->rowIndex ] = dbValueMassageForGUI( $tableName, $colNameForValue, $recsRow[ $colNameForValue ],'', true );
            if ( $columnCount > 1 ) {
                $valueAndDisplayA[ 1 ][ $recs->rowIndex ] = dbValueMassageForGUI( $tableName, $colNameForDisplay, $recsRow[ $colNameForDisplay ],'', true );
            }
		}
		
		// Return
        return $valueAndDisplayA;
	}
}

///////////////////////////////////////////////////////////
// File Bucket
function fileBucketKey( $tableName, $keyValue, $colName ){
	 return $tableName . STR_DIR_SEP . $keyValue . STR_DIR_SEP . $colName;
}

function fileBucketURL( $tableName, $keyValue, $colName, $fileName ){
	if ( isEmpty($fileName )){
		return URL_IMAGES_PLACEHOLDER;
		} else {
		return URL_BUCKET . $tableName . STR_DIR_SEP . $keyValue . STR_DIR_SEP . $colName . STR_DIR_SEP . $fileName;
	}
}

///////////////////////////////////////////////////////////
// Attribute Arrays to String
function classAToString( $classArray ) {
	return arrayImplodeIndexed( $classArray, ' ' );
}

function styleDToString( $styleDict ) {
	return arrayImplodeDictAsCSSStyle( $styleDict );
}

function extrasAToString( $classArray ) {
	return arrayImplodeIndexed( $classArray, ' ' );
}

function respAToString( $array ) {
	return arrayImplodeIndexed( $array, "\n" );
}

function arrayToJavascriptArrayString( $ArrayA ) {
	return '[ "' . implode( '", "', $ArrayA ) . '" ]';
}

function arrayJSCodeToString( $classArray ) {
	return arrayImplodeIndexed( $classArray, STR_CRLF_ASCII );
}

///////////////////////////////////////////////////////////
// User Is
function userIsAuthenticated(){
	if ( isset( $_SESSION[ SESS_USER ][ UUIDUSERS ] ) ){
		return true;
	}else{
		return false;
	}
}

function userIsAdmin(){
	if ( $_SESSION[ SESS_USER ][ 'PrivAdmin' ] === 'Yes' ){
		return true;
	}else{
		return false;
	}
}

///////////////////////////////////////////////////////////
// Module Meta
function mmNameForTable( $tableName ){
	return 'MM_' . strtoupper( $tableName ) . '_T';
}

///////////////////////////////////////////////////////////
// LogEvent
function logEventToFile( $type, $desc1, $desc2, $pageName, $userLogin, $userID ) {
	$path = PATH_ROOT_LOGS . date( 'Ymd' ) . '_Event.txt';

	$dateNow = \DateTime::createFromFormat( 'U.u', microtime( true ) );
	$dateFormatted = $dateNow->format( 'Ymd-His.u' );

	file_put_contents( $path, $dateFormatted . '|' . ipOfBrowser() . '|' . $pageName . '|' . $type . '|' . $desc1 . '|' . $desc2 . '|' . $userLogin . '|' . $userID . PHP_EOL, FILE_APPEND );
}

function logEventToSQL( $type, $desc1, $desc2, $pageName, $userLogin, $userID ) {
	global $mm; // Get Access To $mm
	$insert = new recs( $mm[ MM_LOGEVENT_T ] );
	$insert->querySQL = 'INSERT INTO LogEvent ( UUIDLogEvent, EventTS, Login, UUIDUsers, PageName, Type, Desc1, Desc2 ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ? )';
	$insert->queryBindNamesA = array( 'UUIDLogEvent', 'EventTS', 'Login', UUIDUSERS, 'PageName', 'Type', 'Desc1', 'Desc2' );
	$insert->queryBindValuesA = array( strUUID(), dateTimeNowSQL(), $userLogin, $userID, $pageName, $type, $desc1, $desc2 );
	$insert->query();
	return $insert;
}

///////////////////////////////////////////////////////////
// LogAudit
function logAuditToFile( $UUIDUsers, $userLogin, $action, $tableName, $tableUUIDName, $tableUUID, $fieldValues ) {
	$path = PATH_ROOT_LOGS . date( 'Ymd' ) . '_Audit.txt';

	$dateNow = \DateTime::createFromFormat( 'U.u', microtime( true ) );
	$dateFormatted = $dateNow->format( 'Ymd-His.u' );

	file_put_contents( $path, $dateFormatted . '|' . ipOfBrowser() . '|' . $UUIDUsers . '|' . $userLogin . '|' . $action . '|' . $tableName . '|' . $tableUUIDName . '|' . $tableUUID . '|' . $fieldValues . PHP_EOL, FILE_APPEND );
}

function logAuditToSQL( $UUIDUsers, $userLogin, $action, $tableName, $tableUUIDName, $tableUUID, $fieldValues ) {
	global $mm; // Get Access To $mm
	$insert = new recs( $mm[ MM_LOGAUDIT_T ] );
	$insert->querySQL = 'INSERT INTO LogAudit ( UUIDLogAudit, ModTS, Mod' . UUIDUSERS . ', ModName, Action, TableName, TableUUIDName, TableUUID, FieldValues ) VALUES ( ?, ?, ?, ?, ?, ?, ? ,?, ? )';
	$insert->queryBindNamesA = array( 'UUIDLogAudit', 'ModTS', 'Mod' . UUIDUSERS, 'ModName', 'Action', 'TableName', 'TableUUIDName', 'TableUUID', 'FieldValues' );
	$insert->queryBindValuesA = array( strUUID(), dateTimeNowSQL(), $UUIDUsers, $userLogin, $action, $tableName, $tableUUIDName, $tableUUID, $fieldValues );
	$insert->query();
	return $insert;
}


///////////////////////////////////////////////////////////
// FontAwesome
function iconFA( $pKey, $quote = '"' ) {
	return '<i class=' . $quote . $pKey . $quote . '></i>';
}

///////////////////////////////////////////////////////////
// Nav Items
function navItemButtonModule( $module, $pageModuleName ) {
	$theText = $module->NamePlural;
	ob_start();
	?>
	<li class="nav-item">
		<a class="nav-item-link <?= ( $pageModuleName === $module->NameModule ? 'active' : '' ) ?>" href="<?= $module->URLFull ?>"><?= $module->FontAwesome . STR_NBSP . $theText ?></a>
	</li>
	<?php
	return ob_get_clean();
}

function navItemDropdownModule( $module ) {
	ob_start();
	?>
	<a class="dropdown-item" href="<?= $module->URLFull ?>"><?= $module->FontAwesome . STR_NBSP . $module->NamePlural ?></a>
	<?php
	return ob_get_clean();
}

function navItemDropdownCustom( $label, $onClickJS ) {
	ob_start();
	?>
	<a class="dropdown-item" onclick="<?= $onClickJS ?>"><?= $label ?></a>
	<?php
	return ob_get_clean();
}

function navDivider() {
	ob_start();
	?>
	<div class="dropdown-divider"></div>
	<?php
	return ob_get_clean();
}

///////////////////////////////////////////////////////////
// Database

function dbQueryQuestions( $pCount ) {
	return arrayImplodeIndexed( array_fill( 0, $pCount, '?' ), ', ' );
}

function dbDebugPDO( $recsVar ) {
	/*
	Calling Example
	$recs->execute();
	echo xanPDODebugStrParams( $recs );
	*/
	ob_start();
	$recsVar->debugDumpParams();
	$r = ob_get_contents();
	ob_end_clean();
	return $r;
}

function dbSearchTermSQL( $colNameArray ) {
	$sql = '';
	foreach ( $colNameArray as $value ) {
		$sql .= ( !isEmpty( $sql ) ? ' OR ' : '' );
		$sql .= $value . ' LIKE ? OR ' . $value . ' LIKE ?';
	}
	return $sql;
}

function dbSearchTermBindNamesA( $colNameArray ) {
	$bindNames = array();
	foreach ( $colNameArray as $value ) {
		$bindNames[] = $value . 'zLIKE01';
		$bindNames[] = $value . 'zLIKE02';
	}
	return $bindNames;
}

function dbSearchTermBindValuesA( $colNameArray, $sqlWhereTerm ) {
	$bindValues = array();
	foreach ( $colNameArray as $value ) {
		$bindValues[] = $sqlWhereTerm . '%';
		$bindValues[] = '% ' . $sqlWhereTerm . '%';
	}
	return $bindValues;
}

function dbQueryBuilderDataType( $tableName, $columnName ) {
	$qbType = '';
	$dataType = $GLOBALS[ 'schema' ][ $tableName ][ $columnName ][ 'DATA_TYPE' ];
	$dataType = strtolower( $dataType );
	
	// $qbType can be: string, integer, double, date, time, datetime and boolean
	switch ( $dataType ) {
		case 'varchar':
			$qbType = 'string';
			break;
		case 'text':
			$qbType = 'string';
			break;
		case 'bigint':
			$qbType = 'integer';
			break;
		case 'decimal':
			$qbType = 'double';
			break;
		case 'date':
			$qbType = 'date';
			break;
		case 'time':
			$qbType = 'time';
			break;
		case 'timestamp':
			$qbType = 'datetime';
			break;
		case 'boolean':
			$qbType = 'boolean';
			break;
		default:
			$qbType = 'string';
	}
	
	if ( $qbType === '' ) {
		$qbType = 'string';
	}
	return $qbType;
}

function dbQueryBuilderFindFilter( $tableName, $columnName, $columnLabel ) {
	$theFindFilter = '{ ';
	$theFindFilter .= 'optgroup: "' . $tableName . '", ';
	$theFindFilter .= 'field: "' . $tableName . '.' . $columnName . '", ';
	$theFindFilter .= 'id: "querybuilder_' . $tableName . '_' . $columnName . '", ';
	$theFindFilter .= 'label: "' . $columnLabel . '", ';
	$theFindFilter .= 'type: "' . dbQueryBuilderDataType( $tableName, $columnName ) . '" ';
	$theFindFilter .= '}';
	return $theFindFilter;
}

function dbQueryOrderByItem( $idPrefix, $orderByASC, $orderByDESC, $label ) {
	$item = '';
	ob_start() ?>
    <div class="dropdown-item text-right">
        <a onclick="<?= $idPrefix ?>_SearchSortAction( '<?= $orderByASC ?>' );"><?= $label . ' ' ?>
            <button class="<?= ELE_CLASS_BUTTON_SM_GO ?>" type="button"><?= FA_SORT_ASC ?></button>
        </a>
        <a onclick="<?= $idPrefix ?>_SearchSortAction( '<?= $orderByDESC ?>' );"> or
            <button class="<?= ELE_CLASS_BUTTON_SM_GO ?>" type="button"><?= FA_SORT_DESC ?></button>
        </a>
    </div>
	<?php
	$item .= ob_get_clean();
	return $item;
}

function dbRecsSchemaSet() {
	// Sets: $GLOBALS[ 'schema' ] ; Example to get a Column Label: $GLOBALS[ 'schema' ][ 'Contacts' ][ 'NameFirst' ][ 'label_en' ]
	$recs = recsQuerySimple( 'SELECT TABLE_NAME, COLUMN_NAME, DATA_TYPE, NUMERIC_PRECISION, NUMERIC_SCALE FROM information_schema.columns WHERE TABLE_SCHEMA = ? ORDER BY TABLE_NAME ASC, ORDINAL_POSITION ASC', array( 'TABLE_SCHEMA' ), array( DBS_DBNAME ) );
	
	// Error Check
	if ( $recs->errorB ) {
		$GLOBALS[ 'schema' ] = null;
	} elseif ( $recs->rowCount < 1 ) {
		$GLOBALS[ 'schema' ] = null;
	} else {
		// Recs Loop;
		$recs->rowIndex = -1;
		foreach ( $recs->rowsD as $recsRow ) {
			$recs->rowIndex++;
		 
			// Set Schema Note: TABLE_NAME and COLUMN_NAME are also in $val which is repetitive, but handy when looping.
            $GLOBALS[ 'schema' ][ $recsRow[ 'TABLE_NAME' ] ][ $recsRow[ 'COLUMN_NAME' ] ] = $recsRow;
            
            // Sets: $GLOBALS[ 'schema' ] ; Example to get a Column Label: $GLOBALS[ 'schema' ][ 'Contacts' ][ 'NameFirst' ][ 'label_en' ]
            // Add COLUMN_COMMENT Values FORMATTED IN JSON
            //                if ( $val[ 'COLUMN_COMMENT' ] !== '' ) {
            //                    $commentsArray = json_decode( $val[ 'COLUMN_COMMENT' ], true );
            //                    foreach ( $commentsArray as $commentKey => $commentValue ) {
            //                        $GLOBALS[ 'schema' ][ $val[ 'TABLE_NAME' ] ][ $val[ 'COLUMN_NAME' ] ][ $commentKey ] = $commentValue;
            //                    }
            //                }
            // Remove COLUMN_COMMENT to Save Memory
            //                unset( $GLOBALS[ 'schema' ][ $val[ 'TABLE_NAME' ] ][ $val[ 'COLUMN_NAME' ] ][ 'COLUMN_COMMENT' ] );
		}
	}

}

function dbValueType( $tableName, $columnName ) {
	$colType = $GLOBALS[ 'schema' ][ $tableName ][ $columnName ][ 'DATA_TYPE' ];
	$colTypeGeneral = '';
	if ( $colType === 'varchar' or $colType === 'text' ) {
		return 'text';
	}
	if ( $colType === 'int' or $colType === 'tinyint' or $colType === 'smallint' or $colType === 'mediumint' or $colType === 'bigint' ) {
		return 'integer';
	}
	if ( $colType === 'decimal' or $colType === 'double' or $colType === 'float' or $colType === 'real' ) {
		return 'decimal';
	}
	if ( $colType === 'date' ) {
		return 'date';
	}
	if ( $colType === 'time' ) {
		return 'time';
	}
	if ( $colType === 'timestamp' ) {
		return 'timestamp';
	}
	return $colTypeGeneral;
}

function dbValueMassageForSQL( $tableName, $colName, $colValue, $colFormat ) {
	// The Types: date, timestamp, and time do not need to be massaged...
	
	// Get Type
	$colType = dbValueType( $tableName, $colName );
	
	// Text
	if ( $colType === 'text' ) {
		$colValue = trim( $colValue );
	}
	// Integers
	if ( $colType === 'integer' ) {
		$colValue = filter_var( $colValue, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
		$colValue = round( $colValue, 0, PHP_ROUND_HALF_UP );
		$colValue = filter_var( $colValue, FILTER_SANITIZE_NUMBER_INT );
	}
	// Decimal
	if ( $colType === 'decimal' ) {
		$colDecimals = $GLOBALS[ 'schema' ][ $tableName ][ $colName ][ 'NUMERIC_SCALE' ];
		$colValue = filter_var( $colValue, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
		// switch ( $colFormat ) {
		// 	// Percentage
		// 	case ELE_FORMAT_PERCENTAGE:
		// 		$colValue = $colValue / 100;
		// 		$colValue = round( $colValue, $colDecimals + 2, PHP_ROUND_HALF_UP );
		// 		break;
		// 	// Decimal
		// 	default:
		$colValue = round( $colValue, $colDecimals, PHP_ROUND_HALF_UP );
		// }
		$colValue = filter_var( $colValue, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
	}
	// Date
	if ( $colType === 'date' ) {
		if ( isEmpty( $colValue ) or $colValue === '00000-00-00' ) {
			$colValue = 'NULL';
		}
	}
	// Timestamp
	if ( $colType === 'timestamp' ) {
		if ( isEmpty( $colValue ) or $colValue === '00000-00-00 00:00:00' ) {
			$colValue = 'NULL';
		}
	}
	// Time
	if ( $colType === 'time' ) {
		if ( isEmpty( $colValue ) or $colValue === '00:00:00' ) {
			$colValue = 'NULL';
		}
	}
	
	// Return
	$colValue = trim( $colValue );
	return $colValue;
}

function dbValueMassageForGUI( $tableName, $colName, $colValue, $colFormat, $massageDates ) {
	// Get Type and Value
	$colType = dbValueType( $tableName, $colName );
	$colValue = dbValueMassageForSQL( $tableName, $colName, $colValue, $colFormat );
	
	// Integers
	if ( $colType === 'integer' ) {
		$colValue = dbNumberDisplay( $colName, $tableName, $colValue );
	}
	
	// Decimal
	if ( $colType === 'decimal' ) {
		switch ( $colFormat ) {
			// Currency
			case ELE_FORMAT_CURRENCY:
				$colValue = dbNumberDisplayAsCurrency( $colName, $tableName, $colValue );
				break;
			// Percentage
			// case ELE_FORMAT_PERCENTAGE:
			// 	$colValue = dbNumberDisplayAsPercentage( $colName, $tableName, $colValue );
			// 	break;
			// Decimal
			default:
				$colValue = dbNumberDisplay( $colName, $tableName, $colValue );
		}
	}
	
	// Date
	if ( $colType === 'date' ) {
		// Clear
		if ( $colValue === 'NULL' or $colValue === '0000-00-00' ) {
			$colValue = '';
		}
		// For Display
		if ( $massageDates === true ) {
			$colValue = dateTimeFromString( $colValue, DATETIME_FORMAT_DISPLAY_DATE );
		}
	}
	
	// Timestamp
	if ( $colType === 'timestamp' ) {
		// Clear
		if ( $colValue === 'NULL' or $colValue === '0000-00-00 00:00:00' ) {
			$colValue = '';
		}
		// For Display
		if ( $massageDates === true ) {
			$colValue = dateTimeFromString( $colValue, DATETIME_FORMAT_DISPLAY_TIMESTAMP );
		}
	}
	
	// Time
	if ( $colType === 'time' ) {
		// Clear
		if ( $colValue === 'NULL' or $colValue === '00:00:00' ) {
			$colValue = '';
		}
		// For Display
		if ( $massageDates === true ) {
			$colValue = dateTimeFromString( $colValue, DATETIME_FORMAT_DISPLAY_TIME );
		}
	}
	
	// Return
	$colValue = trim( $colValue );
	return $colValue;
}

function dbNumberDisplay( $columnName, $tableName, $columnValue ) {
	$columnValue = numDisplay( $columnValue, $GLOBALS[ 'schema' ][ $tableName ][ $columnName ][ 'NUMERIC_SCALE' ] );
	$columnValue = trim( $columnValue );
	return $columnValue;
}

function dbNumberDisplayAsCurrency( $columnName, $tableName, $columnValue ) {
	$columnValue = APP_CURRENCY . numDisplay( $columnValue, $GLOBALS[ 'schema' ][ $tableName ][ $columnName ][ 'NUMERIC_SCALE' ] );
	$columnValue = str_replace( APP_CURRENCY . APP_CURRENCY, APP_CURRENCY, $columnValue );
	$columnValue = trim( $columnValue );
	return $columnValue;
}

function dbNumberDisplayAsPercentage( $columnName, $tableName, $columnValue ) {
	$columnValue = numDisplay( $columnValue, $GLOBALS[ 'schema' ][ $tableName ][ $columnName ][ 'NUMERIC_SCALE' ] );
	$columnValue = ( $columnValue * 100 ) . '%';
	$columnValue = trim( $columnValue );
	return $columnValue;
}

function emailAddressIsValid( $emailAddress ){
         return ( !preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $emailAddress) ) ? true : false;
}


////////////////////////////////////////////////////////////
// Other

// Stripe Use
use Stripe\Checkout\Session;
use Stripe\Stripe;

// Button Stripe Product
function buttonStripeProduct( $label, $id, $code, $name, $desc, $qty, $price, $imageURL, $cancelURL ) {
	// Calling Example
	if ( false ) {
		// Stripe Product
		$stripeButtonProduct = \xan\ButtonStripeProduct( 'Product $20', 'buttonProduct20', 'ProdCode', 'Product Name', 'Product Description', 1, 2000, 'https://xandev.xanweb.app/images/logo1024.png', $_SESSION[ 'urlCurrent' ] );
		if ( $stripeButtonProduct !== null ) {
			$page[ PAGE_CONTENT_AREA ] .= '<p class="ml-3">' . $stripeButtonProduct[ 'Button' ] . '</p>';
			$page[ PAGE_SCRIPTS_ONLOAD ] .= $stripeButtonProduct[ 'InitJavaScript' ];
		}
	}

	// Init
	require_once( 'include/stripe/7.48.0/init.php' );
	Stripe::setApiKey( STRIPE_KEY_SECRET );

	// Cancel URL
	if ( isEmpty( $cancelURL ) ) {
		$cancelURL = URL_BASE . 'checkoutCancel/{CHECKOUT_SESSION_ID}';
	}

	// Stripe Session
	$return[ 'Session' ] = Session::create( [
		'mode' => 'payment',
		'payment_method_types' => [ 'card' ],
		'billing_address_collection' => 'required',
		'metadata' => [ 'code' => $code ],
		'line_items' => [ [
			'quantity' => $qty,
			'price_data' => [
				'product_data' => [
					'name' => $name,
					'description' => $desc,
					'images' => [ $imageURL ],
				],
				'currency' => 'usd',
				'unit_amount' => $price,
			],
		] ],
		'success_url' => URL_BASE . 'checkoutThankYou/{CHECKOUT_SESSION_ID}',
		'cancel_url' => $cancelURL,
	] );

	// Stripe Button
	$buttonTags = new tags([ ELE_CLASS_BUTTON_RG_SECONDARY ], [], []);
	$buttonEle = new eleButton($label,$id,$id,$buttonTags);
	$return[ 'Button' ] = $buttonEle->render();

	// Stripe Init JS
	$return[ 'InitJavaScript' ] = 'xanStripeButtonInit( \'' . STRIPE_KEY_PUBLIC . '\', \'' . $return[ 'Session' ]->id . '\', \'' . $id . '\' );' . "\n";

	// Return
	return $return;
}

// Button Stripe Subscription
function buttonStripeSubscription( $label, $id, $code, $stripePriceID, $qty, $cancelURL ) {
	// Calling Example
	if ( false ) {
		// Stripe Subscription
		$stripeButtonSubscription = \xan\ButtonStripeSubscription( 'Subscription $1/month', 'buttonSubscription1', 'SubCode', 'monthly', 1, $_SESSION[ 'urlCurrent' ] );
		if ( $stripeButtonSubscription !== null ) {
			$page[ PAGE_CONTENT_AREA ] .= '<p class="ml-3">' . $stripeButtonSubscription[ 'Button' ] . '</p>';
			$page[ PAGE_SCRIPTS_ONLOAD ] .= $stripeButtonSubscription[ 'InitJavaScript' ];
		}
	}

	// Init
	require_once( 'include/stripe/7.48.0/init.php' );
	Stripe::setApiKey( STRIPE_KEY_SECRET );


	// Cancel URL
	if ( isEmpty( $cancelURL ) ) {
		$cancelURL = URL_BASE . 'checkoutCancel/{CHECKOUT_SESSION_ID}';
	}

	// Stripe Session
	// https://stripe.com/docs/payments/checkout/set-up-a-subscription
	$return[ 'Session' ] = Session::create( [
		'mode' => 'subscription',
		'payment_method_types' => [ 'card' ],
		'billing_address_collection' => 'required',
		'metadata' => [ 'code' => $code ],
		'line_items' => [ [
			'quantity' => $qty,
			'price' => $stripePriceID,
		] ],
		'success_url' => URL_BASE . 'checkoutThankYou/{CHECKOUT_SESSION_ID}',
		'cancel_url' => $cancelURL,
	] );

	// Stripe Button
	$buttonTags = new tags([ ELE_CLASS_BUTTON_RG_SECONDARY ], [], []);
	$buttonEle = new eleButton($label,$id,$id,$buttonTags);
	$return[ 'Button' ] = $buttonEle->render();

	// Stripe Init JS
	$return[ 'InitJavaScript' ] = 'xanStripeButtonInit( \'' . STRIPE_KEY_PUBLIC . '\', \'' . $return[ 'Session' ]->id . '\', \'' . $id . '\' );' . "\n";

	// Return
	return $return;
}

?>