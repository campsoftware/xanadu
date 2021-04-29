<?php
// Validate Init
$ValidationMsgA = array();

// Validate User ID
if ( \xan\isEmpty( $doParam[ $mmUsersT->NameTableParam ] ) ) {
	$ValidationMsgA[] = "User ID is Blank";
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

// Users
$recsUsers = new \xan\recs( $mmUsersT );
$recsUsers->querySQL = 'SELECT * FROM ' . $mmUsersT->NameTable . ' WHERE ' . $mmUsersT->NameTableKey . ' = ?';
$recsUsers->queryBindNamesA = array( $mmUsersT->NameTableKey );
$recsUsers->queryBindValuesA = array( $doParam[ $mmUsersT->NameTableParam ] );
$recsUsers->query();
$recsUsers->rowsMassageForGUI( true );

// Error Check
if ( $recsUsers->errorB ) {
	$ValidationMsgA[] = mmUsersT->NameSingular . ' Print Error' . $recsUsers->messageExtra . '; ' . $recsUsers->messageSQL;
} elseif ( $recsUsers->rowCount < 1 ) {
} else {
}


// HTML Create
ob_start();
foreach ( $recsUsers->rowsD as $recsUsersRow ) : ?>

    <div class="floater">
        <h2>User</h2>
        <table class="tableBorderNone">
            <tr>
                <td class="cellLabelBorderNone cellRight">Company</td>
                <td class="cellBorder cellLeft"><?= $recsUsersRow[ 'NameCompany' ] ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">First</td>
                <td class="cellBorder cellLeft"><?= $recsUsersRow[ 'NameFirst' ] ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">Last</td>
                <td class="cellBorder cellLeft"><?= $recsUsersRow[ 'NameLast' ] ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">Full</td>
                <td class="cellBorder cellLeft"><?= $recsUsersRow[ 'NameFull' ] ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">Email</td>
                <td class="cellBorder cellLeft"><?= $recsUsersRow[ 'EmailAddress' ] ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">Work Phone</td>
                <td class="cellBorder cellLeft"><?= $recsUsersRow[ 'PhoneWork' ] ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">Mobile Phone</td>
                <td class="cellBorder cellLeft"><?= $recsUsersRow[ 'PhoneMobile' ] ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">2FA Phone</td>
                <td class="cellBorder cellLeft"><?= $recsUsersRow[ 'PhoneTwoFactor' ] ?></td>
            </tr>
        </table>
    </div>

    <div class="floater">
        <h2>Privs</h2>
        <table class="tableBorderNone">
            <tr>
                <td class="cellLabelBorderNone cellRight">Registered</td>
                <td class="cellBorder cellLeft"><?= $recsUsersRow[ 'Registered' ] ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">Registered TS</td>
                <td class="cellBorder cellLeft"><?= $recsUsersRow[ 'RegisteredTS' ] ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">Active</td>
                <td class="cellBorder cellLeft"><?= $recsUsersRow[ 'Active' ] ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">Is Admin</td>
                <td class="cellBorder cellLeft"><?= $recsUsersRow[ 'PrivAdmin' ] ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">Is Member</td>
                <td class="cellBorder cellLeft"><?= $recsUsersRow[ 'PrivMember' ] ?></td>
            </tr>
            <tr>
                <td class="cellLabelBorderNone cellRight">Last Path</td>
                <td class="cellBorder cellLeft"><?= $recsUsersRow[ 'PathLast' ] ?></td>
            </tr>
        </table>
    </div>

<?php endforeach ?>
<?php
$docBody[ '[[BODY]]' ] = ob_get_clean();
$docBody[ '[[FONT-SIZE]]' ] = '14px';

$docHeader[ '[[FONT-SIZE]]' ] = '12px';
$docHeader[ '[[LEFT]]' ] = '';
$docHeader[ '[[CENTER]]' ] = 'User';
$docHeader[ '[[RIGHT]]' ] = '';
$docHeader[ '[[LEFT2]]' ] = '';
$docHeader[ '[[CENTER2]]' ] = '';
$docHeader[ '[[RIGHT2]]' ] = '';

$docFooter[ '[[FONT-SIZE]]' ] = '12px';
$docFooter[ '[[LEFT]]' ] = '';
$docFooter[ '[[CENTER]]' ] = '';
$docFooter[ '[[RIGHT]]' ] = '';

$docTitle = 'User - ' . $mmUsersT->getDisplayName( $recsUsers );
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
$aloe_response->content_set( json_encode( $resp->jsActionsA ) );
return;
?>
