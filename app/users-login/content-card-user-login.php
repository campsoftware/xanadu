<?php
// Card
$cardHeaderContent = 'Welcome to ' . APP_NAME . '!';
$card = new xan\eleCard( CARD_WIDTH, '', false );

// Tags Special
$tagsEleInput_Logo = new xan\tags( [ 'col', '' ], [ 'height' => ELE_HEIGHT_6X, 'width' => 'auto' ], [] );

// Table
$table = new xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Table Rows
$tableRowIndex++;
$logoEle = new \xan\eleURLImage( APP_ICON_URL_1024, false, '', 'Xanadu', 'Xanadu', $tagsEleInput_Logo );
$table->cellSet( $tableRowIndex, 0, $tagsCellCenterMiddle, $logoEle->render() );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, 'Email' );

$tableRowIndex++;
$loginEle = new \xan\eleText( $CookieLogin ?? '', 'Login', 'Login', $tagsEleInput );
$table->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, $loginEle->render() );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, 'Password' );

$tableRowIndex++;
$pwEle = new \xan\eleTextReveal( '', 'Password', 'Password', $tagsEleInput );
$table->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, $pwEle->render() );

$tableRowIndex++;
$rememberMe = "<input type='checkbox' name='RememberMe' id='RememberMe' value='1'>&nbsp;&nbsp;<label for='RememberMe'>Remember Me</label>";
$table->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, $rememberMe );

$tableRowIndex++;
$formNameEle = new \xan\eleTextHidden( 'Login', 'FormName', 'FormName', $tagsEleInput );
$buttonTags = new \xan\tags( [ ELE_CLASS_BUTTON_RG_PRIMARY ], [], [ 'onclick="document.getElementById(\'login\').submit();"' ] );
$buttonEle = new \xan\eleButton( $mmUsersLogin->FontAwesome . STR_NBSP . $mmUsersLogin->NameModule, '', '', $buttonTags );
$table->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, $formNameEle->render() . $buttonEle->render() );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, $xanMessage );

$contentBody = "<form method='post' id='login' action='/login' enctype='application/x-www-form-urlencoded'>" . $table->render() . "</form>";
$jsFocus = <<< JS
        <script>
            $( function () {
                // Set the Focus
                if ( $( "#Login" ).val() === "" ) {
                    $( "#Login" ).focus();
                } else {
                    $( "#Password" ).focus();
                }
            } );
        </script>
JS;

// Card Append to Source
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $contentBody . $jsFocus );
?>