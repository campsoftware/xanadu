<?php
// Card
$cardHeaderContent = \xan\fontIcon( 'fas fa-keyboard' ) . STR_NBSP . 'Auth';
$card = new \xan\eleCard( CARD_WIDTH, '', false );

// Tags Special

// Table
$table = new \xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Table Rows
$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'LoginKey', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'LoginKey', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'LoginKeyOneTime', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'LoginKeyOneTime', ELE_AS_DEFINED, $tagsEleInput_NameUpdate, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'TwoFactorString', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'TwoFactorString', ELE_AS_DEFINED, $tagsEleInput_NameUpdate, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'TwoFactorExpiresTS', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'TwoFactorExpiresTS', ELE_AS_DEFINED, $tagsEleInput_NameUpdate, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'PasswordHashSeed', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'PasswordHashSeed', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$table->cellSet( ++$tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'PasswordHashed', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'PasswordHashed', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

// Password Change Button
$buttonPWChangeTags = new \xan\tags( [ ELE_CLASS_BUTTON_SM_SECONDARY ], [], [ 'onclick="$(\'#UsersPasswordReplace_Modal\').modal(\'show\');"' ] );
$buttonPWChangeEle = new \xan\eleButton( \xan\fontIcon( FI_PASSWORD ) . STR_NBSP . 'Password Replace', '', '', $buttonPWChangeTags );
$cardHeaderContent .= '<div class="float-right">' . $buttonPWChangeEle->render() . '</div>';

// Card Append
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $table->render() );
?>