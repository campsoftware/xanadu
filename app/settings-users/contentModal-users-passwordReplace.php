<?php
// Modal
$xanDoDo = 'UsersPasswordReplace';
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

// New Password
$eleLabel = new \xan\eleLabel( 'New Password', '', '', $tagsEleLabel );
$eleInput = new \xan\eleTextReveal( '', 'PasswordNewOne', '', $tagsEleInput );
$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $eleLabel->render() );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $eleInput->render() );

// New Password Verify
$eleLabel = new \xan\eleLabel( 'New Password Verify', '', '', $tagsEleLabel );
$eleInput = new \xan\eleTextReveal( '', 'PasswordNewTwo', '', $tagsEleInput );
$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $eleLabel->render() );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $eleInput->render() );

// Modal Init
$modalInitJS = <<< JS
$( "#{$xanDoDo}_Modal" ).on( "shown.bs.modal", function () {
	$( "#PasswordNewOne" ).trigger( "select" );
} );
JS;

// Button Action IDs
$messageID = $xanDoDo . 'Message';
$buttonActionID = $xanDoDo . '_Modal_ButtonAction';
$buttonActionOnClickFunctionName = $buttonActionID . 'OnClick';
$buttonActionSpinnerID = $buttonActionID . 'Spinner';

// Button Action On Click Call
$buttonActionOnClick = /** @lang JavaScript */
	'$( "#' . $buttonActionSpinnerID . '" ).css( "display", "inline" ); $( "#' . $buttonActionID . '" ).prop( "disabled", true ); setTimeout( ' . $buttonActionOnClickFunctionName . ', 100 );';

// Button Action On Click Function
$resp->scriptsExtraA[] = <<< JS
function {$buttonActionOnClickFunctionName}(){
	xanDo( { "Do": "{$xanDoDo}", "Msg": "Password Replace", "URL":"{$mmUsersT->URLDoRelative}", "IDUsers": "{$resp->reqID}", "PasswordNewOne": $( "#PasswordNewOne" ).val(), "PasswordNewTwo": $( "#PasswordNewTwo" ).val() } );
    $("#PasswordNewOne").val("");
    $("#PasswordNewTwo").val("");
}
JS;

// Modal Append
$buttonActionSpinnerSpan = '<span id="' . $buttonActionSpinnerID . '" style="display: none;">' . STR_NBSP . FA_SPINNER . '</span>';
$buttonActionLabel = FA_PASSWORD . STR_NBSP . 'Password Replace' . STR_NBSP . $buttonActionSpinnerSpan;
$buttonActionMessage = '<span id="' . $messageID . '"></span>';
$resp->contentEndA[] = $modal->renderModalWButtons( 'Replace the Password for this User?', '', $table->render(), $buttonActionMessage, 'Cancel', $buttonActionLabel, [ "onclick='" . $buttonActionOnClick . "'" ], $modalInitJS );
?>