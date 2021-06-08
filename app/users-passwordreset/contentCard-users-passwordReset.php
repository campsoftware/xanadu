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
$table->cellSet( ++$tableRowIndex, 0, $tagsCellCenterMiddle, $logoEle->render() );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellLeftMiddle, 'Email<div class="float-right small"><a href="' . $mmUsersLogin->URLRelative .  '">Login</a></div>' );

$loginEle = new \xan\eleText( $CookieLogin ?? '', 'Login', 'Login', $tagsEleInput );
$table->cellSet( ++$tableRowIndex, 0, $tagsCellLeftMiddle, $loginEle->render() );

// Button Click
$formButtonOnClick = /** @lang JavaScript */
	'$( "#formButtonSpinner" ).css( "display", "inline" ); $( "#formButton" ).prop( "disabled", true ); setTimeout( formButtonOnClick, 100 );';
$resp->scriptsExtraA[] = <<< JS
function formButtonOnClick(){
	xanDo( { "Do": "PasswordReset", "Msg": "Password Reset", "URL":"{$mmUsersPasswordReset->URLDoRelative}", "Login": $("#Login").val() } );
	$("#Password").val("");
	$("#PasswordVerify").val("");
}
JS;

// Button
$formButtonTags = new \xan\tags( [ ELE_CLASS_BUTTON_RG_DELETE ], [], [ "onclick='" . $formButtonOnClick . "'" ] );
$formButtonSpinner = '<span id="formButtonSpinner" style="display: none;">' . STR_NBSP . FI_SPINNER . '</span>';
$buttonEle = new \xan\eleButton( $mmUsersPasswordReset->FontIcon . STR_NBSP . $mmUsersPasswordReset->NameModule . $formButtonSpinner, 'formButton', '', $formButtonTags );
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
                $( "#Login" ).focus();
                
                // Add Return Key Event
				$( "#Login, #Password, #PasswordVerify" ).on( "keypress", function ( event ) {
					let keycode = event.which || event.keyCode || event.charCode;
					if ( keycode === 13 ) {
						$( "#passwordResetButton" ).click();
					}
				} );
			
            } );
        </script>
JS;

// Card Append
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $contentBody . $jsFocus );
?>