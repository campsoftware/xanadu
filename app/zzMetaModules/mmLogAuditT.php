<?php

class moduleMetaLogAuditT extends \xan\moduleMeta {
    // Constructor
    public function __construct() {
        parent::__construct();
        $this->NameModule = 'LogAudit';
        $this->NameModuleLower = strtolower( $this->NameModule );
        $this->NameTable = 'LogAudit';
        $this->NameTableKey = 'UUIDLogAudit';

        // QueryBuilder Operators: equal, not_equal, in, not_in, less, less_or_equal, greater, greater_or_equal, between, not_between, begins_with, not_begins_with, contains, not_contains, ends_with, not_ends_with, is_empty, is_not_empty, is_null, is_not_null
        //        $this->QuerySimpleDefault = array( 'NameCompany', 'NameFirst', 'NameLast' );
        //        $this->QueryBuilderDefault = '{ field: "Contacts.NameCompany", id: "querybuilder_Contacts_NameCompany", operator: "begins_with", value: "" }';
        //
        //        $this->QueryOrderByDefault = 'NameCompany ASC, NameLast ASC, NameFirst ASC';
        //        $this->QueryOrderByExtraBegin .= \xan\dbQueryOrderByItem( $this->NameTable, 'NameCompany ASC, NameLast ASC, NameFirst ASC', 'NameCompany DESC, NameLast DESC, NameFirst DESC', 'Company, Last, First' );
        //        $this->QueryOrderByExtraBegin .= '<hr />';

        $this->NamePlural = 'Log Audits';
        $this->NameSingular = 'Log Audit';

        $this->FontAwesome = '<i class=\'fas fa-abacus\'></i>';
        $this->FontAwesomeList = FA_LIST;

        //        $this->URLRelative = '/' . 'contacts/';
        //        $this->URLFull = URL_BASE . 'contacts/';
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
            case 'Action':
                $colEle->colLabelEN = 'Action';
                break;
            case 'TableName':
                $colEle->colLabelEN = 'Table Name';
                break;
            case 'TableUUIDName':
                $colEle->colLabelEN = 'Table Key Name';
                break;
            case 'TableUUID':
                $colEle->colLabelEN = 'Table Key Value';
                break;
            case 'FieldValues':
                $colEle->colLabelEN = 'Field Values';
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
            case 'UUIDLogAudit':
                $colEle->colLabelEN = 'Log Audit ID';
                $colEle->isKey = true;
                $colEle->isKeyPrimary = true;
                $colEle->isKeyForeign = false;
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

    public function getColEleRender( $colName, $typeAs, \xan\tags $tags, \xan\recs $recs, \xan\formTag $formTag, \xan\response &$resp ) {
        // Get Col Ele Meta
        $colEle = $this->getColMeta( $colName, $typeAs );
        $code = \xan\eleDBMetaRender( $colEle, $tags, $recs, $formTag, $resp );
        return $code;
    }


    ///////////////////////////////////////////////////////////
    // Functions For This Module

}

// Init
$mmLogAuditT = new moduleMetaLogAuditT();
define( 'MM_LOGAUDIT_T', 'MM_LOGAUDIT_T' );
$mm[ MM_LOGAUDIT_T ] = &$mmLogAuditT;
?>