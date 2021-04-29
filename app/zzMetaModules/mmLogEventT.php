<?php

class moduleMetaLogEventT extends \xan\moduleMeta {
    // Constructor
    public function __construct() {
        parent::__construct();
        $this->NameModule = 'LogEvent';
        $this->NameModuleLower = strtolower( $this->NameModule );
        $this->NameTable = 'LogEvent';
        $this->NameTableKey = 'UUIDLogEvent';
		$this->NameTableParam = \xan\strSubstitute( $this->NameTableKey, 'UU', '' );

        // QueryBuilder Operators: equal, not_equal, in, not_in, less, less_or_equal, greater, greater_or_equal, between, not_between, begins_with, not_begins_with, contains, not_contains, ends_with, not_ends_with, is_empty, is_not_empty, is_null, is_not_null
        //        $this->QuerySimpleDefault = array( 'NameCompany', 'NameFirst', 'NameLast' );
        //        $this->QueryBuilderDefault = '{ field: "Contacts.NameCompany", id: "querybuilder_Contacts_NameCompany", operator: "begins_with", value: "" }';
        //
        //        $this->QueryOrderByDefault = 'NameCompany ASC, NameLast ASC, NameFirst ASC';
        //        $this->QueryOrderByExtraBegin .= \xan\dbQueryOrderByItem( $this->NameTable, 'NameCompany ASC, NameLast ASC, NameFirst ASC', 'NameCompany DESC, NameLast DESC, NameFirst DESC', 'Company, Last, First' );
        //        $this->QueryOrderByExtraBegin .= '<hr />';

        $this->NamePlural = 'Log Events';
        $this->NameSingular = 'Log Event';

        $this->FontAwesome = '<i class=\'fas fa-calendar-day\'></i>';
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
            case 'EventTS':
                $colEle->colLabelEN = 'Event Timestamp';
                break;
            case 'Login':
                $colEle->colLabelEN = 'Login';
                break;
            case 'PageName':
                $colEle->colLabelEN = 'Page Name';
                break;
            case 'Type':
                $colEle->colLabelEN = 'Type';
                break;
            case 'Desc1':
                $colEle->colLabelEN = 'Desc 1';
                break;
            case 'Desc2':
                $colEle->colLabelEN = 'Desc 2';
                break;

            // UUID
            case 'UUIDLogEvent':
                $colEle->colLabelEN = 'Log Event ID';
                $colEle->isKey = true;
                $colEle->isKeyPrimary = true;
                $colEle->isKeyForeign = false;
                break;
            case 'UUIDUsers':
                $colEle->colLabelEN = 'User ID';
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
$mmLogEventT = new moduleMetaLogEventT();
define( 'MM_LOGEVENT_T', 'MM_LOGEVENT_T' );
$mm[ MM_LOGEVENT_T ] = &$mmLogEventT;
?>