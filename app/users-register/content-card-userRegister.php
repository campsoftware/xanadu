<?php
// Card
$cardHeaderContent = 'Welcome to ' . APP_NAME . '!';
$card = new xan\eleCard( CARD_WIDTH, '', false );

// Tags Special
$tagsEleInput_Logo = new xan\tags( [ 'col', '' ], [ 'height' => ELE_HEIGHT_6X, 'width' => 'auto' ], [] );

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Table
$table = new xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Table Rows
$tableRowIndex++;
$logoEle = new \xan\eleURLImage( APP_ICON_URL_1024, false, '', 'Xanadu', 'Xanadu', $tagsEleInput_Logo );
$table->cellSet( $tableRowIndex, 0, $tagsCellCenterMiddle, $logoEle->render() );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, 'Email<div class="float-right small"><a href="' . $mmUsersLogin->URLRelative .  '">Login</a></div>' );

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
$buttonTags = new \xan\tags( [ ELE_CLASS_BUTTON_RG_PRIMARY ], [], [ 'onclick=\'xanDo( { "Msg": "Checking Registration", "URL":"' . $mmUsersRegister->URLDoRelative . '", "Login": $("#Login").val(), "Password": $("#Password").val(), "PasswordVerify": $("#PasswordVerify").val(), "Do": "Registration" } );\'' ] );

$buttonEle = new \xan\eleButton( $mmUsersRegister->FontAwesome . STR_NBSP . $mmUsersRegister->NameModule, 'registerButton', '', $buttonTags );
$table->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, $buttonEle->render() );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, '<div id="formMessage">' . $xanMessage . '</div>' );

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Set the Body
$contentBody = '<div id="registerForm">' . $table->render() . "</div>";

// Init the Form
$jsFocus = <<< JS
        <script>
            $( function () {
            
                // Set the Focus
                if ( $( "#Login" ).val() === "" ) {
                    $( "#Login" ).focus();
                } else {
                    $( "#Password" ).focus();
                }
                
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