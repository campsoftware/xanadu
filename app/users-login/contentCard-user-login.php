<?php
// Card
$cardHeaderContent = 'Welcome to ' . APP_NAME . '!';
$card = new \xan\eleCard( CARD_WIDTH, '', false );

// Tags Special
$tagsEleInput_Logo = new \xan\tags( [ 'col', '' ], [ 'height' => ELE_HEIGHT_6X, 'width' => 'auto' ], [] );

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Table
$tableLogin = new \xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Table Rows
$tableRowIndex++;
$logoEle = new \xan\eleURLImage( APP_ICON_URL_1024, false, '', 'Xanadu', 'Xanadu', $tagsEleInput_Logo );
$tableLogin->cellSet( $tableRowIndex, 0, $tagsCellCenterMiddle, $logoEle->render() );

$tableRowIndex++;
$tableLogin->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, 'Email<div class="float-right small"><a href="' . $mmUsersPasswordReset->URLRelative . '">Password Reset</a></div>' );

$tableRowIndex++;
$loginEle = new \xan\eleText( $CookieLogin ?? '', 'Login', 'Login', $tagsEleInput );
$tableLogin->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, $loginEle->render() );

$tableRowIndex++;
$tableLogin->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, 'Password' );

$tableRowIndex++;
$pwEle = new \xan\eleTextReveal( '', 'Password', 'Password', $tagsEleInput );
$tableLogin->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, $pwEle->render() );

$tableRowIndex++;
$rememberMe = "<input type='checkbox' name='RememberMe' id='RememberMe' value='1'>&nbsp;&nbsp;<label for='RememberMe'>Remember Me</label>";
$tableLogin->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, $rememberMe );

// Button Click
$formButtonLoginOnClick = /** @lang JavaScript */
	'$( "#formButtonLoginSpinner" ).css( "display", "inline" ); $( "#formButtonLogin" ).prop( "disabled", true ); setTimeout( formButtonLoginOnClick, 100 );';
$resp->scriptsExtraA[] = <<< JS
function formButtonLoginOnClick(){
	xanDo( { "Do": "Login", "Msg": "Login", "URL":"{$mmUsersLogin->URLDoRelative}", "Login": $("#Login").val(), "Password": $("#Password").val() } );
	$("#Password").val("");
}
JS;

// Button
$tableRowIndex++;
$formButtonLoginTags = new \xan\tags( [ ELE_CLASS_BUTTON_RG_PRIMARY ], [], [ "onclick='" . $formButtonLoginOnClick . "'" ] );
$formButtonLoginSpinner = '<span id="formButtonLoginSpinner" style="display: none;">' . STR_NBSP . FA_SPINNER . '</span>';
$buttonEle = new \xan\eleButton( $mmUsersLogin->FontAwesome . STR_NBSP . $mmUsersLogin->NameModule . $formButtonLoginSpinner, 'formButtonLogin', '', $formButtonLoginTags );
$tableLogin->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, $buttonEle->render() );

// Message
$tableRowIndex++;
$tableLogin->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, '<div id="formMessageLogin"></div>' );

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Table
$tableCode = new \xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Table Rows
$tableRowIndex++;
$logoEle = new \xan\eleURLImage( APP_ICON_URL_1024, false, '', 'Xanadu', 'Xanadu', $tagsEleInput_Logo );
$tableCode->cellSet( $tableRowIndex, 0, $tagsCellCenterMiddle, $logoEle->render() );

$tableRowIndex++;
$tableCode->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, '<strong>We emailed or texted a code!</strong>' );

$tableRowIndex++;
$tableCode->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, 'Code' );

$tableRowIndex++;
$tagsEleCode = new \xan\tags( [ 'col' ], [], [ 'inputmode="numeric" pattern="[0-9]*" autocomplete="one-time-code"' ] );
$codeEle = new \xan\eleText( '', 'Code', 'Code', $tagsEleCode );
$tableCode->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, $codeEle->render() );

// Button Click
$formButtonCodeOnClick = /** @lang JavaScript */
	'$( "#formButtonCodeSpinner" ).css( "display", "inline" ); $( "#formButtonCode" ).prop( "disabled", true ); setTimeout( formButtonCodeOnClick, 100 );';
$resp->scriptsExtraA[] = <<< JS
function formButtonCodeOnClick(){
	xanDo( { "Do": "CodeVerify", "Msg": "Code Verify", "URL":"{$mmUsersLogin->URLDoRelative}", "Login": $("#Login").val(), "Code": $("#Code").val(), "RememberMe": ($("#RememberMe").is(":checked")) ? "1" :"0" } );
	$("#Code").val("");
}
JS;

// Button
$tableRowIndex++;
$formButtonCodeTags = new \xan\tags( [ ELE_CLASS_BUTTON_RG_PRIMARY ], [], [ "onclick='" . $formButtonCodeOnClick . "'" ] );
$formButtonCodeSpinner = '<span id="formButtonCodeSpinner" style="display: none;">' . STR_NBSP . FA_SPINNER . '</span>';
$buttonEle = new \xan\eleButton( $mmUsersLogin->FontAwesome . STR_NBSP . 'Enter Code to Login' . $formButtonCodeSpinner, 'formButtonCode', '', $formButtonCodeTags );
$tableCode->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, $buttonEle->render() );

// Message
$tableRowIndex++;
$tableCode->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, '<div id="formMessageCode"></div>' );

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Set the Body
$contentBody = '<span id="formTableLogin">' . $tableLogin->render() . '</span>' . '<span id="formTableCode" style="display: none;">' . $tableCode->render() . '</span>';

// Init the Form
$jsFocus = <<< JS
        <script>
            $( function () {
            
            	// Set the Login from the Cookie
            	$( "#Login" ).val( "{$_COOKIE[COOKIE_LOGIN]}" );
            	
                // Set the Focus
                if ( $( "#Login" ).val() === "" ) {
                    $( "#Login" ).focus();
                } else {
                    $( "#Password" ).focus();
                }
                
                // Login Add Return Key Event
				$( "#Login, #Password" ).on( "keypress", function ( event ) {
					let keycode = event.which || event.keyCode || event.charCode;
					if ( keycode === 13 ) {
						$( "#formButtonLogin" ).click();
					}
				} );
                
                // Code Add Return Key Event
				$( "#Code" ).on( "keypress", function ( event ) {
					let keycode = event.which || event.keyCode || event.charCode;
					if ( keycode === 13 ) {
						$( "#formButtonCode" ).click();
					}
				} );
            
            } );
        </script>
JS;

// Card Append
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $contentBody . "\n" . $jsFocus );
?>