<?php
// Response Init
$resp = new \xan\response;

// Validate Init
$ValidationMsgA = array();

// Validate Contact ID
if ( \xan\isEmpty( $doParam[ 'IDContacts' ] ) ) {
    $ValidationMsgA[] = "Contact ID is Blank";
}

// Validate Format
if ( \xan\isEmpty( $doParam[ 'Format' ] ) ) {
    $ValidationMsgA[] = "Format is Blank";
}

// Validate Template
if ( \xan\isEmpty( $doParam[ 'Template' ] ) ) {
    $ValidationMsgA[] = "Template is Blank";
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
    $aloe_response->status_set( '400 Bad Request: ' . implode( ", ", $ValidationMsgA ) );
    $aloe_response->content_set( 'Error' );
    return;
}

///////////////////////////////////////////////////////////
// Records Get

// Contacts
$recsContacts = new \xan\recs( $mmContactsT );
$recsContacts->querySQL = 'SELECT * FROM ' . $mmContactsT->NameTable . ' WHERE ' . UUIDTENANTS . ' = ? AND ' . $mmContactsT->NameTableKey . ' = ?';
$recsContacts->queryBindNamesA = array( UUIDTENANTS, $mmContactsT->NameTableKey );
$recsContacts->queryBindValuesA = array( $_SESSION[ SESS_USER ][ UUIDTENANTS ], $doParam[ 'IDContacts' ] );
$recsContacts->query();
$recsContacts->rowsMassageForGUI( true );

// Error Check
if ( $recsContacts->errorB ) {
	$ValidationMsgA[] = 'Contact Print Error' . $recsContacts->messageExtra . '; ' . $recsContacts->messageSQL;
} elseif ( $recsContacts->rowCount < 1 ) {
} else {
}

// ContactsComms
$recsContactsComms = new \xan\recs( $mmContactsCommsT );
$recsContactsComms->querySQL = 'SELECT * FROM ' . $mmContactsCommsT->NameTable . ' WHERE ' . UUIDTENANTS . ' = ? AND ' . $mmContactsT->NameTableKey . ' = ?';
$recsContactsComms->queryBindNamesA = array( UUIDTENANTS, $mmContactsT->NameTableKey );
$recsContactsComms->queryBindValuesA = array( $_SESSION[ SESS_USER ][ UUIDTENANTS ], $doParam[ 'IDContacts' ] );
$recsContactsComms->query();
$recsContactsComms->rowsMassageForGUI( true );

// Error Check
if ( $recsContactsComms->errorB ) {
	$ValidationMsgA[] = 'Contact Print Error' . $recsContactsComms->messageExtra . '; ' . $recsContactsComms->messageSQL;
} elseif ( $recsContactsComms->rowCount < 1 ) {
} else {
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	$aloe_response->status_set( '500 Internal Service Error: ' . implode( ", ", $ValidationMsgA ) );
	$aloe_response->content_set( 'Error' );
	return;
}

// HTML Create
ob_start();
foreach ( $recsContacts->rowsD as $recsContactsRow ) : ?>

    <div class="floater">
        <h2>Contact</h2>
        <table class="tableBorderNone">
            <tr>
                <td class="cellLabelBorderNone cellRight">Company</td>
                <td class="cellBorder cellLeft"><?= $recsContactsRow[ 'NameCompany' ] ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">First</td>
                <td class="cellBorder cellLeft"><?= $recsContactsRow[ 'NameFirst' ] ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">Last</td>
                <td class="cellBorder cellLeft"><?= $recsContactsRow[ 'NameLast' ] ?></td>
            </tr>
            <tr>
                <td class="cellBorderNone"><?= STR_NBSP ?></td>
                <td class="cellBorderNone"><?= STR_NBSP ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">Active</td>
                <td class="cellBorder cellLeft"><?= $recsContactsRow[ 'Active' ] ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">Type</td>
                <td class="cellBorder cellLeft"><?= $recsContactsRow[ 'Type' ] ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">Status</td>
                <td class="cellBorder cellLeft"><?= $recsContactsRow[ 'Status' ] ?></td>
            </tr>
        </table>
    </div>

    <div class="floater">
        <h2>Photo</h2>
        <table class="tableBorderNone">
            <tr>
                <td>
                    <img class="cellBorder" src='<?= \xan\fileBucketURL( $mmContactsT->NameTable, $recsContactsRow[ $mmContactsT->NameTableKey ], 'PhotoFN', $recsContactsRow[ 'PhotoFN' ] ) ?>' style="max-width: auto; max-height: 12rem;" alt="Photo">
                </td>
            </tr>
        </table>
    </div>

    <div class="floater">
        <h2>Info</h2>
        <table class="tableBorderNone">
            <tr>
                <td class="cellLabelBorderNone cellRight">Time Open</td>
                <td class="cellBorder cellRight"><?= $recsContactsRow[ 'TimeOpen' ] ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">Time Closed</td>
                <td class="cellBorder cellRight"><?= $recsContactsRow[ 'TimeClosed' ] ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">Contacted Date</td>
                <td class="cellBorder cellRight"><?= $recsContactsRow[ 'ContactedDate' ] ?></td>
            </tr>
            <tr>
                <td class="cellBorderNone"><?= STR_NBSP ?></td>
                <td class="cellBorderNone"><?= STR_NBSP ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">Follow Up At</td>
                <td class="cellBorder cellRight"><?= $recsContactsRow[ 'FollowUpTS' ] ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">Follow Up Action</td>
                <td class="cellBorder cellLeft"><?= $recsContactsRow[ 'FollowUpAction' ] ?></td>
            </tr>
            <tr>
                <td class="cellBorderNone"><?= STR_NBSP ?></td>
                <td class="cellBorderNone"><?= STR_NBSP ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">Number Integer</td>
                <td class="cellBorder cellRight"><?= $recsContactsRow[ 'NumberInteger' ] ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">Number Decimal</td>
                <td class="cellBorder cellRight"><?= $recsContactsRow[ 'NumberDecimal' ] ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">Number Currency</td>
                <td class="cellBorder cellRight"><?= $recsContactsRow[ 'NumberCurrency' ] ?></td>
            </tr>
        </table>
    </div>

    <div class="floater">
        <h2>Notes</h2>
        <table class="tableBorderNone">
            <tr>
                <td class="cellBorder"><?= $recsContactsRow[ 'Notes' ] ?></td>
            </tr>
        </table>
    </div>

    <div class="floater">
        <h2>Comms: <?= $recsContactsComms->rowCount ?></h2>
        <table class="tableBorderNone">
            <tr>
                <td class="cellHeaderBorderNone cellLeft">Type</td>
                <td class="cellHeaderBorderNone cellLeft">Label</td>
                <td class="cellHeaderBorderNone cellLeft">Main</td>
                <td class="cellHeaderBorderNone cellLeft">Info</td>
            </tr>
			<?php foreach ( $recsContactsComms->rowsD as $recsContactsCommsRow ) : ?>
                <tr>
                    <td class="cellBorder cellLeft"><?= $recsContactsCommsRow[ 'Type' ] ?></td>
                    <td class="cellBorder cellLeft"><?= $recsContactsCommsRow[ 'Label' ] ?></td>
                    <td class="cellBorder cellLeft"><?= $recsContactsCommsRow[ 'Main' ] ?></td>
                    <td class="cellBorder cellLeft">
						<?php if ( $recsContactsCommsRow[ 'Type' ] === 'Address' ) {
							echo $mmContactsCommsT->getAddress( $recsContactsComms, 'PostalWithAll' );
						} else {
							echo $recsContactsCommsRow[ 'Data' ];
						} ?>
                    </td>
                </tr>
			<?php endforeach ?>
        </table>
    </div>
<?php endforeach ?>
<?php
$docBody[ '[[BODY]]' ] = ob_get_clean();
$docBody[ '[[FONT-SIZE]]' ] = '14px';

$docHeader[ '[[FONT-SIZE]]' ] = '12px';
$docHeader[ '[[LEFT]]' ] = '';
$docHeader[ '[[CENTER]]' ] = 'Contact';
$docHeader[ '[[RIGHT]]' ] = '';
$docHeader[ '[[LEFT2]]' ] = '';
$docHeader[ '[[CENTER2]]' ] = '';
$docHeader[ '[[RIGHT2]]' ] = '';

$docFooter[ '[[FONT-SIZE]]' ] = '12px';
$docFooter[ '[[LEFT]]' ] = '';
$docFooter[ '[[CENTER]]' ] = '';
$docFooter[ '[[RIGHT]]' ] = '';

$docTitle = 'Contact - ' . $mmContactsT->getDisplayName( $recsContacts );
$docParams = '--quiet --page-size Letter --orientation Portrait --lowquality --enable-forms --header-line --footer-line --margin-top 25 --margin-bottom 25 --header-spacing 5 --footer-spacing 5';

// Doc Create
$printer = new \xan\printer();
$resultHTMLPDFer = $printer->htmlToFile( $doParam[ 'Format' ], $doParam[ 'Template' ], $docTitle, $docParams, $docHeader, $docBody, $docFooter );

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	$aloe_response->status_set( '500 Internal Service Error: ' . implode( ", ", $ValidationMsgA ) );
	$aloe_response->content_set( 'Error' );
	return;
}

// Redirect
$resp->jsSetPageURL( $resultHTMLPDFer[ 'url' ] );

// Actions Return as JSON
$resp->jsSetHTML( '#formMessage', implode( ', ', $ValidationMsgA ) );
$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
return;
?>
