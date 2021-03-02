<?php
// Card
$cardHeaderContent = xan\iconFA( 'fas fa-keyboard' ) . STR_NBSP . 'Auth';
$card = new xan\eleCard( CARD_WIDTH, '', false );

// Tags Special

// Table
$table = new xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Table Rows
$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'Registered', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'Registered', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'RegisterTS', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'RegisterTS', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 2, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'RegisterTS', ELE_AS_SELECTOR, $tagsEleSelector, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'PasswordHashSeed', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'PasswordHashSeed', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'PasswordHashed', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'PasswordHashed', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'PasswordResetCode', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'PasswordResetCode', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

$tableRowIndex++;
$table->cellSet( $tableRowIndex, 0, $tagsCellRightMiddle, $mmUsersT->getColEleRender( 'LoginKey', ELE_AS_LABEL, $tagsEleLabel, $recsDetail, $formTagDetail, $resp ) );
$table->cellSet( $tableRowIndex, 1, $tagsCellLeftMiddle, $mmUsersT->getColEleRender( 'LoginKey', ELE_AS_DEFINED, $tagsEleInput, $recsDetail, $formTagDetail, $resp ) );

// Password Change Button
$buttonPWChangeTags = new \xan\tags( [ ELE_CLASS_BUTTON_SM_SECONDARY ], [], [ 'onclick="$(\'#UsersPasswordUpdate_Modal\').modal(\'show\');"' ] );
$buttonPWChangeEle = new \xan\eleButton( xan\iconFA( 'fas fa-key' ) . STR_NBSP . 'Password Update', '', '', $buttonPWChangeTags );
$cardHeaderContent .= '<div class="float-right">' . $buttonPWChangeEle->render() . '</div>';

// Card Append to Source
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $table->render() );
?>