<?php

class moduleMetaLogAuditT extends \xan\moduleMeta {
    // Constructor
    public function __construct() {
        parent::__construct();
        $this->NameModule = 'LogAudit';
        $this->NameModuleLower = strtolower( $this->NameModule );
        $this->NameTable = 'LogAudit';
        $this->NameTableKey = 'UUIDLogAudit';
		$this->NameTableParam = \xan\strSubstitute( $this->NameTableKey, 'UU', '' );

        // QueryBuilder Operators: equal, not_equal, in, not_in, less, less_or_equal, greater, greater_or_equal, between, not_between, begins_with, not_begins_with, contains, not_contains, ends_with, not_ends_with, is_empty, is_not_empty, is_null, is_not_null
        //        $this->QuerySimpleDefault = array( 'NameCompany', 'NameFirst', 'NameLast' );
        //        $this->QueryBuilderDefault = '{ field: "Contacts.NameCompany", id: "querybuilder_Contacts_NameCompany", operator: "begins_with", value: "" }';
        //
        //        $this->QueryOrderByDefault = 'NameCompany ASC, NameLast ASC, NameFirst ASC';
        //        $this->QueryOrderByExtraBegin .= \xan\dbQueryOrderByItem( $this->NameTable, 'NameCompany ASC, NameLast ASC, NameFirst ASC', 'NameCompany DESC, NameLast DESC, NameFirst DESC', 'Company, Last, First' );
        //        $this->QueryOrderByExtraBegin .= '<hr />';

        $this->NamePlural = 'Log Audits';
        $this->NameSingular = 'Log Audit';

        $this->FontAwesome = \xan\fontIcon( 'fas fa-abacus' );
        $this->FontAwesomeList = FI_LIST;

        //        $this->URLRelative = '/' . 'contacts/';
        //        $this->URLFull = URL_BASE . 'contacts/';
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
            case 'Action':
                $colMeta->colLabelEN = 'Action';
                break;
            case 'TableName':
                $colMeta->colLabelEN = 'Table Name';
                break;
            case 'TableUUIDName':
                $colMeta->colLabelEN = 'Table Key Name';
                break;
            case 'TableUUID':
                $colMeta->colLabelEN = 'Table Key Value';
                break;
            case 'FieldValues':
                $colMeta->colLabelEN = 'Field Values';
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
            case 'UUIDLogAudit':
                $colMeta->colLabelEN = 'Log Audit ID';
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
$mmLogAuditT = new moduleMetaLogAuditT();
define( 'MM_LOGAUDIT_T', 'MM_LOGAUDIT_T' );
$mm[ MM_LOGAUDIT_T ] = &$mmLogAuditT;
?>