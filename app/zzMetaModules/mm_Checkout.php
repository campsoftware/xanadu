<?php

class metaCheckout {
    ///////////////////////////////////////////////////////////
    // Vars
    var $NameModule;
    var $NameModuleLower;
    var $NameTable;
    var $NameTableKey;

    var $QuerySimpleDefault;
    var $QueryBuilderDefault;

    var $QueryOrderByDefault;
    var $QueryOrderByExtraBegin;

    var $NamePlural;
    var $NameSingular;

    var $FontAwesome;
    var $FontAwesomeList;

    var $URLRelative;
    var $URLFull;

    var $page;


    ///////////////////////////////////////////////////////////
    // Constructor
    public function __construct() {
        $this->NameModule = 'Checkout';
        $this->NameModuleLower = strtolower( $this->NameModule );
        $this->NameTable = '';
        $this->NameTableKey = '';

        // QueryBuilder Operators: equal, not_equal, in, not_in, less, less_or_equal, greater, greater_or_equal, between, not_between, begins_with, not_begins_with, contains, not_contains, ends_with, not_ends_with, is_empty, is_not_empty, is_null, is_not_null
//        $this->QuerySimpleDefault = array( 'NameCompany', 'NameFirst', 'NameLast' );
//        $this->QueryBuilderDefault = '{ field: "Contacts.NameCompany", id: "querybuilder_Contacts_NameCompany", operator: "begins_with", value: "" }';

//        $this->QueryOrderByDefault = 'NameCompany ASC, NameLast ASC, NameFirst ASC';
//        $this->QueryOrderByExtraBegin .= xan\xanQueryOrderByItem( $this->NameTable, 'NameCompany ASC, NameLast ASC, NameFirst ASC', 'NameCompany DESC, NameLast DESC, NameFirst DESC', 'Company, Last Name' );
//        $this->QueryOrderByExtraBegin .= '<hr />';

        $this->NamePlural = 'Checkout';
        $this->NameSingular = 'Checkout';

        $this->FontAwesome = '<i class=\'fas fa-shopping-basket\'></i>';
        $this->FontAwesomeList = FA_LIST;

//        $this->URLRelative = '/' . 'contacts/';
//        $this->URLFull = URL_BASE . 'contacts/';

        // Page
        $this->pageInit();
    }

    ///////////////////////////////////////////////////////////
    // Init Page
    public function pageInit() {
        $this->page[ PAGE_MODULE_NAME ] = $this->NameModule;
        $this->page[ PAGE_HEAD_TITLE ] = $this->NameModule;
        $this->page[ PAGE_HEAD_EXTRA ] = '';
        $this->page[ PAGE_INCLUDE_NAV ] = false;
        $this->page[ PAGE_CONTENT_HEADER ] = $this->FontAwesome . STR_NBSP . $this->NameModule;
        $this->page[ PAGE_CONTENT_AREA ] = '';
        $this->page[ PAGE_CONTENT_END ] = '';
        $this->page[ PAGE_SCRIPTS_EXTRA ] = '';
        $this->page[ PAGE_SCRIPTS_ONLOAD ] = '';
    }

    ///////////////////////////////////////////////////////////
    // Functions
}


///////////////////////////////////////////////////////////
// Init
$mmCheckout = new metaCheckout();
define( 'MM_CHECKOUT', 'MM_CHECKOUT' );
$mm[ MM_CHECKOUT ] = &$mmCheckout;
?>