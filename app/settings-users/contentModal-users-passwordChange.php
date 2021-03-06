<?php
// Modal
$xanDoDo = 'UsersPasswordChange';
$modal = new \xan\eleModal( $xanDoDo );
$modal->buttonActionDanger = true;
$modal->buttonActionAutoDismiss = false;

// Table
$tagsCellEmpty = new \xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_MIDDLE ], [], [] );
$tagsCellRightMiddle = new \xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_RIGHT, TABLE_ALIGN_MIDDLE ], [], [] );
$tagsCellLeftMiddle = new \xan\tags( [ 'border-0', 'pb-0', TEXT_ALIGN_LEFT, TABLE_ALIGN_MIDDLE ], [], [] );
$table = new \xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;
$tagsEleLabel = new \xan\tags( [ 'small' ], [], [] );
$tagsEleInput = new \xan\tags( [ 'col' ], [], [] );

// Old Password
$eleLabel = new \xan\eleLabel( 'Current Password', '', '', $tagsEleLabel );
$eleInput = new \xan\eleTextReveal( '', 'PasswordOld', '', $tagsEleInput );
$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $eleLabel->render() );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $eleInput->render() );

// New Password
$eleLabel = new \xan\eleLabel( 'New Password', '', '', $tagsEleLabel );
$eleInput = new \xan\eleTextReveal( '', 'PasswordNewOne', '', $tagsEleInput );
$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $eleLabel->render() );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $eleInput->render() );

// Rules
$table->cellSet( ++$tableRowIndex, 1, $tagsCellLeftMiddle, '<div class="small text-secondary">Min 10 Chars + Num + Lower + Upper + Special</div>' );


// New Password Verify
$eleLabel = new \xan\eleLabel( 'New Password Verify', '', '', $tagsEleLabel );
$eleInput = new \xan\eleTextReveal( '', 'PasswordNewTwo', '', $tagsEleInput );
$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $eleLabel->render() );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $eleInput->render() );

// Password Meter
$table->cellSet( ++$tableRowIndex, 1, $tagsCellLeftMiddle, '<div class="passwordRating"></div>' );
$resp->scriptsOnLoadA[] = <<< JS
	let userChangePasswordRatingInput = document.getElementById( "PasswordNewOne" );
	xanPasswordRating( userChangePasswordRatingInput );
JS;

// Message
$messageID = $xanDoDo . 'Message';
$table->cellSet( ++$tableRowIndex, 1, $tagsCellLeftMiddle, '<span id="' . $messageID . '"></span>' );

// Modal Init
$modalInitJS = <<< JS
$( "#{$xanDoDo}_Modal" ).on( "shown.bs.modal", function () {
	$( "#PasswordOld" ).trigger( "select" );
} );
JS;

// Button Action IDs
$messageID = $xanDoDo . 'Message';
$buttonActionID = $xanDoDo . '_Modal_ButtonAction';
$buttonActionSpinnerID = $buttonActionID . 'Spinner';
$buttonActionOnClickFunctionName = $buttonActionID . 'OnClick';

// Button Action On Click Call
$buttonActionOnClick = /** @lang JavaScript */
	'$( "#' . $buttonActionSpinnerID . '" ).css( "display", "inline" ); $( "#' . $buttonActionID . '" ).prop( "disabled", true ); setTimeout( ' . $buttonActionOnClickFunctionName . ', 100 );';

// Button Action On Click Function
$resp->scriptsExtraA[] = <<< JS
function {$buttonActionOnClickFunctionName}(){
    if ( $( ".passwordRating" ).html().includes( '&nbsp;Strong&nbsp;' ) === false ){
        $( "#{$messageID}" ).html( "Password is not Strong" );
        $( "#{$buttonActionSpinnerID}" ).css( "display", "none" );
        $( "#{$buttonActionID}" ).prop( "disabled", false );
        return;
    }
	xanDo( { "Do": "{$xanDoDo}", "Msg": "Password Change", "URL":"{$mmUsersT->URLDoRelative}", "IDUsers": "{$_SESSION[SESS_USER][UUIDUSERS]}", "PasswordOld": $( "#PasswordOld" ).val(), "PasswordNewOne": $( "#PasswordNewOne" ).val(), "PasswordNewTwo": $( "#PasswordNewTwo" ).val() } );
    $("#PasswordOld").val("");
    $("#PasswordNewOne").val("");
    $("#PasswordNewTwo").val("");
    $( ".passwordRating" ).html("")
}
JS;

// Modal Append
$buttonActionSpinnerSpan = '<span id="' . $buttonActionSpinnerID . '" style="display: none;">' . STR_NBSP . FI_SPINNER . '</span>';
$buttonActionLabel = FI_PASSWORD . STR_NBSP . 'Password Change' . STR_NBSP . $buttonActionSpinnerSpan;
$resp->contentEndA[] = $modal->renderModalWButtons( 'Change your Password?', '', $table->render(), '', 'Cancel', $buttonActionLabel, [ "onclick='" . $buttonActionOnClick . "'" ], $modalInitJS );
?>