<?php
// Card
$cardHeaderContent = 'Welcome to ' . APP_NAME . '!';
$card = new xan\eleCard( CARD_WIDTH, '', false );

// Tags Special
$tagsEleInput_Logo = new xan\tags( [ 'col', '' ], [ 'height' => ELE_HEIGHT_6X, 'width' => 'auto' ], [] );

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Table
$loginTable = new xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Table Rows
$tableRowIndex++;
$logoEle = new \xan\eleURLImage( APP_ICON_URL_1024, false, '', 'Xanadu', 'Xanadu', $tagsEleInput_Logo );
$loginTable->cellSet( $tableRowIndex, 0, $tagsCellCenterMiddle, $logoEle->render() );

$tableRowIndex++;
$loginTable->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, 'Email<div class="float-right small"><a href="' . $mmUsersPasswordReset->URLRelative .  '">Password Reset</a></div>' );

$tableRowIndex++;
$loginEle = new \xan\eleText( $CookieLogin ?? '', 'Login', 'Login', $tagsEleInput );
$loginTable->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, $loginEle->render() );

$tableRowIndex++;
$loginTable->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, 'Password' );

$tableRowIndex++;
$pwEle = new \xan\eleTextReveal( '', 'Password', 'Password', $tagsEleInput );
$loginTable->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, $pwEle->render() );

$tableRowIndex++;
$rememberMe = "<input type='checkbox' name='RememberMe' id='RememberMe' value='1'>&nbsp;&nbsp;<label for='RememberMe'>Remember Me</label>";
$loginTable->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, $rememberMe );

$tableRowIndex++;
$buttonTags = new \xan\tags( [ ELE_CLASS_BUTTON_RG_PRIMARY ], [], [ 'onclick=\'xanDo( { "Msg": "Checking Login", "URL":"' . $mmUsersLogin->URLDoRelative . '", "Login": $("#Login").val(), "Password": $("#Password").val(), "RememberMe": $("#RememberMe").val(), "Do": "Login" } );\'' ] );
$buttonEle = new \xan\eleButton( $mmUsersLogin->FontAwesome . STR_NBSP . $mmUsersLogin->NameModule, 'loginButton', '', $buttonTags );
$loginTable->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, $buttonEle->render() );

$tableRowIndex++;
$loginTable->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, '<div id="formMessageLogin">' . $xanMessage . '</div>' );

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Table
$codeTable = new xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Table Rows
$tableRowIndex++;
$logoEle = new \xan\eleURLImage( APP_ICON_URL_1024, false, '', 'Xanadu', 'Xanadu', $tagsEleInput_Logo );
$codeTable->cellSet( $tableRowIndex, 0, $tagsCellCenterMiddle, $logoEle->render() );

$tableRowIndex++;
$codeTable->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, '<strong>Enter the Verification Code</strong>' );

$tableRowIndex++;
$codeTable->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, 'Code' );

$tableRowIndex++;
$tagsEleCode = new xan\tags( [ 'col' ], [], [ 'inputmode="numeric" pattern="[0-9]*" autocomplete="one-time-code"' ] );
$codeEle = new \xan\eleText( '', 'Code', 'Code', $tagsEleCode );
$codeTable->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, $codeEle->render() );

$tableRowIndex++;
$buttonTags = new \xan\tags( [ ELE_CLASS_BUTTON_RG_PRIMARY ], [], [ 'onclick=\'xanDo( { "Msg": "Verifying Code", "URL":"' . $mmUsersLogin->URLDoRelative . '", "Login": $("#Login").val(), "RememberMe": ($("#RememberMe").is(":checked")) ? "1" :"0", "Code": $("#Code").val(), "Do": "CodeVerify" } );\'' ] );
$buttonEle = new \xan\eleButton( $mmUsersLogin->FontAwesome . STR_NBSP . 'Verify Code', 'codeButton', '', $buttonTags );
$codeTable->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, $buttonEle->render() );

$tableRowIndex++;
$codeTable->cellSet( $tableRowIndex, 0, $tagsCellLeftMiddle, '<div id="codeMessage">' . $xanMessage . '</div>' );

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// Set the Body
$contentBody = '<div id="loginForm">' . $loginTable->render() . '</div>' . '<div id="formMessageCode" style="display: none;">' . $codeTable->render() . '</div>';

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
						$( "#loginButton" ).click();
					}
				} );
                
                // Code Add Return Key Event
				$( "#Code" ).on( "keypress", function ( event ) {
					let keycode = event.which || event.keyCode || event.charCode;
					if ( keycode === 13 ) {
						$( "#codeButton" ).click();
					}
				} );
            
            } );
        </script>
JS;

// Card Append to Source
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $contentBody . "\n" . $jsFocus );
?>