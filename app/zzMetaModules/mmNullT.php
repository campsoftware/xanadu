<?php

class moduleMetaNullT extends \xan\moduleMeta {
    // Constructor
    public function __construct() {
        parent::__construct();
        $this->NameModule = '';
        $this->NameModuleLower = strtolower( $this->NameModule );
        $this->NameTable = '';
        $this->NameTableKey = '';
		$this->NameTableParam = \xan\strSubstitute( $this->NameTableKey, 'UU', '' );

        // QueryBuilder Operators: equal, not_equal, in, not_in, less, less_or_equal, greater, greater_or_equal, between, not_between, begins_with, not_begins_with, contains, not_contains, ends_with, not_ends_with, is_empty, is_not_empty, is_null, is_not_null
        //        $this->QuerySimpleDefault = array( 'NameCompany', 'NameFirst', 'NameLast' );
        //        $this->QueryBuilderDefault = '{ field: "Contacts.NameCompany", id: "querybuilder_Contacts_NameCompany", operator: "begins_with", value: "" }';
        //
        //        $this->QueryOrderByDefault = 'NameCompany ASC, NameLast ASC, NameFirst ASC';
        //        $this->QueryOrderByExtraBegin .= \xan\dbQueryOrderByItem( $this->NameTable, 'NameCompany ASC, NameLast ASC, NameFirst ASC', 'NameCompany DESC, NameLast DESC, NameFirst DESC', 'Company, Last, First' );
        //        $this->QueryOrderByExtraBegin .= '<hr />';

        $this->NamePlural = '';
        $this->NameSingular = '';

        $this->FontIcon = '';
        $this->FontIconList = '';

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
            case 'NULL':
                $colMeta->colLabelEN = 'NULL';
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
$mmNull_T = new moduleMetaNullT();
define( 'MM_NULL_T', 'MM_NULL_T' );
$mm[ MM_NULL_T ] = &$mmNull_T;
?>