<?php
// Card
$cardHeaderContent = 'Welcome to ' . APP_NAME . '!';
$card = new \xan\eleCard( CARD_WIDTH, '', false );

// Tags Special
$tagsEleInput_Logo = new \xan\tags( [ 'col', '' ], [ 'height' => ELE_HEIGHT_6X, 'width' => 'auto' ], [] );

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Table
$table = new \xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Table Rows
$logoEle = new \xan\eleURLImage( APP_ICON_URL_1024, false, '', 'Xanadu', 'Xanadu', $tagsEleInput_Logo );
$table->cellSet( ++$tableRowIndex, 0, $tagsCellCenterMiddle, $logoEle->render(), 1, 2 );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellLeftMiddle, 'Email<div class="float-right small"><a href="' . $mmUsersLogin->URLRelative . '">Login</a></div>', 1, 2 );

$loginEle = new \xan\eleText( $CookieLogin ?? '', 'Login', 'Login', $tagsEleInput );
$table->cellSet( ++$tableRowIndex, 0, $tagsCellLeftMiddle, $loginEle->render(), 1, 2 );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellLeftMiddle, 'Password', 1, 2 );

$pwEle = new \xan\eleTextReveal( '', 'Password', 'Password', $tagsEleInput );
$table->cellSet( ++$tableRowIndex, 0, $tagsCellLeftMiddle, $pwEle->render(), 1, 2 );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellLeftMiddle, 'Password Verify' );

// Password Meter
$table->cellSet( $tableRowIndex, 1, $tagsCellRightMiddle, '<div class="passwordRating"></div>' );
$resp->scriptsOnLoadA[] = <<< JS
	var registerPasswordRatingInput = document.getElementById( "Password" );
	xanPasswordRating( registerPasswordRatingInput );
JS;

$pwEle = new \xan\eleTextReveal( '', 'PasswordVerify', 'PasswordVerify', $tagsEleInput );
$table->cellSet( ++$tableRowIndex, 0, $tagsCellLeftMiddle, $pwEle->render(), 1, 2 );

// Button Click
$formButtonOnClick = /** @lang JavaScript */
	'$( "#formButtonSpinner" ).css( "display", "inline" ); $( "#formButton" ).prop( "disabled", true ); setTimeout( formButtonOnClick, 100 );';
$resp->scriptsExtraA[] = <<< JS
function formButtonOnClick(){
	xanDo( { "Do": "Register", "Msg": "Register", "URL":"{$mmUsersRegister->URLDoRelative}", "Login": $("#Login").val(), "Password": $("#Password").val(), "PasswordVerify": $("#PasswordVerify").val() } );
	$("#Password").val("");
	$("#PasswordVerify").val("");
}
JS;

// Button
$formButtonTags = new \xan\tags( [ ELE_CLASS_BUTTON_RG_PRIMARY ], [], [ "onclick='" . $formButtonOnClick . "'" ] );
$formButtonSpinner = '<span id="formButtonSpinner" style="display: none;">' . STR_NBSP . FI_SPINNER . '</span>';
$buttonEle = new \xan\eleButton( $mmUsersRegister->FontIcon . STR_NBSP . $mmUsersRegister->NameModule . $formButtonSpinner, 'formButton', '', $formButtonTags );
$table->cellSet( ++$tableRowIndex, 0, $tagsCellLeftMiddle, $buttonEle->render() );

// Message
$table->cellSet( ++$tableRowIndex, 0, $tagsCellLeftMiddle, '<span id="formMessage"></span>' );

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Set the Body
$contentBody = '<div id="formTable">' . $table->render() . "</div>";

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
						$( "#formButton" ).click();
					}
				} );
			
            } );
        </script>
JS;

// Card Append
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $contentBody . $jsFocus );
?>