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
$table->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, 'Password Verify' );

$tableRowIndex++;
$pwEle = new \xan\eleTextReveal( '', 'PasswordVerify', 'PasswordVerify', $tagsEleInput );
$table->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, $pwEle->render() );

$tableRowIndex++;
$formNameEle = new \xan\eleTextHidden( 'Register', 'FormName', 'FormName', $tagsEleInput );
$buttonTags = new \xan\tags( [ ELE_CLASS_BUTTON_RG_PRIMARY ], [], [ 'onclick="document.getElementById(\'register\').submit();"' ] );
$buttonEle = new \xan\eleButton( $mmUsersRegister->FontAwesome . STR_NBSP . $mmUsersRegister->NameModule, 'registerButton', '', $buttonTags );
$table->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, $formNameEle->render() . $buttonEle->render() );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, $xanMessage );

$contentBody = "<form method='post' id='register' action='/register' enctype='application/x-www-form-urlencoded'>" . $table->render() . "</form>";
$jsFocus = <<< JS
        <script>
            $( function () {
            
                // Set the Focus
                $( "#Login" ).focus();
                
                // Add Return Key Event
				$( "#Login, #Password, #PasswordVerify" ).on( "keypress", function ( event ) {
					let keycode = event.which || event.keyCode || event.charCode;
					if ( keycode === 13 ) {
						$( "#registerButton" ).click();
					}
				} );
			
            } );
        </script>
JS;

// Card Append to Source
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $contentBody . $jsFocus );
?>