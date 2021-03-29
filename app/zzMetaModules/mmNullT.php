<?php

class moduleMetaNullT extends \xan\moduleMeta {
    // Constructor
    public function __construct() {
        parent::__construct();
        $this->NameModule = '';
        $this->NameModuleLower = strtolower( $this->NameModule );
        $this->NameTable = '';
        $this->NameTableKey = '';

        // QueryBuilder Operators: equal, not_equal, in, not_in, less, less_or_equal, greater, greater_or_equal, between, not_between, begins_with, not_begins_with, contains, not_contains, ends_with, not_ends_with, is_empty, is_not_empty, is_null, is_not_null
        //        $this->QuerySimpleDefault = array( 'NameCompany', 'NameFirst', 'NameLast' );
        //        $this->QueryBuilderDefault = '{ field: "Contacts.NameCompany", id: "querybuilder_Contacts_NameCompany", operator: "begins_with", value: "" }';
        //
        //        $this->QueryOrderByDefault = 'NameCompany ASC, NameLast ASC, NameFirst ASC';
        //        $this->QueryOrderByExtraBegin .= \xan\dbQueryOrderByItem( $this->NameTable, 'NameCompany ASC, NameLast ASC, NameFirst ASC', 'NameCompany DESC, NameLast DESC, NameFirst DESC', 'Company, Last, First' );
        //        $this->QueryOrderByExtraBegin .= '<hr />';

        $this->NamePlural = '';
        $this->NameSingular = '';

        $this->FontAwesome = '';
        $this->FontAwesomeList = '';

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
            case 'NULL':
                $colEle->colLabelEN = 'NULL';
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
$mmNull_T = new moduleMetaNullT();
define( 'MM_NULL_T', 'MM_NULL_T' );
$mm[ MM_NULL_T ] = &$mmNull_T;
?>