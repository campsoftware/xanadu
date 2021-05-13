<?php
// Card
$cardHeaderContent = \xan\fontIcon( 'fas fa-door-open' ) . STR_NBSP . 'Welcome Home!';
$card = new \xan\eleCard( CARD_WIDTH, '', false );

// Tags Special

// Table
$table = new \xan\eleTable( $tagsCellEmpty );
$tableRowIndex = -1;

// Table Rows

// Welcome Home
// $table->cellSet( 0, 0, $tagsCellLeftMiddle, 'Welcome Home!' );

// Get Location
$buttonTags = new \xan\tags( [ ELE_CLASS_BUTTON_RG_SECONDARY ], [], [ 'onclick="xanLocationGet( function ( coords ) { alert( coords[`ErrorCode`] + `, ` + coords[`ErrorDesc`] + `, ` + coords[`Latitude`] + `, ` + coords[`Longitude`] + `, ` + coords[`Altitude`] ); } );"' ] );
$buttonEle = new \xan\eleButton( 'Get Location!', 'ButtonGeoLocation', 'ButtonGeoLocation', $buttonTags );
$table->cellSet( ++$tableRowIndex, 0, $tagsCellLeftMiddle, $buttonEle->render() );

// Stripe Purchase Button
$resp->includeStripeB = true;
$stripeButtonProduct = \xan\buttonStripeProduct( 'Product $20', 'buttonProduct20', 'ProdCode', 'Product Name', 'Product Description', 1, 2000, 'https://xandev.xanweb.app/images/logo1024.png', $_SESSION[ 'urlCurrent' ] );
$stripeButtonSubscription = \xan\buttonStripeSubscription( 'Subscription $1/month', 'buttonSubscription1pm', 'SubCode', 'monthly', 1, $_SESSION[ 'urlCurrent' ] );
$table->cellSet( ++$tableRowIndex, 0, $tagsCellLeftMiddle, $stripeButtonProduct[ 'Button' ] . ' ' . $stripeButtonSubscription[ 'Button' ] );
$resp->scriptsOnLoadA[] = $stripeButtonProduct[ 'InitJavaScript' ];
$resp->scriptsOnLoadA[] = $stripeButtonSubscription[ 'InitJavaScript' ];

// Barcode
$tagsElePhoto = new \xan\tags( [ 'img-thumbnail p-2' ], [ 'height' => CARD_HEIGHT_QUARTER, 'width' => 'auto' ], [] );
$imgEle = new \xan\eleURLImage( URL_BASE . 'include/barcode/2018-10-03/barcode.php?f=png&s=qr&p=-14&d=http://campsoftware.com ', false, '', '', 'CampSoftware.com', $tagsElePhoto );
$table->cellSet( ++$tableRowIndex, 0, $tagsCellCenterMiddle, $imgEle->render() . STR_BR . 'CampSoftware.com' );

// Button API Random Amount
$buttonAPIRandomTags = new \xan\tags( [ ELE_CLASS_BUTTON_RG_SECONDARY ], [], [ "onclick=\"xanDo( { 'Do': 'apiRequestRandomAmount', 'Msg': 'API Request Random Amount', 'URL': '/home-do' } );\"" ] );
$buttonAPIRandomEle = new \xan\eleButton( 'API Random Amount', '', '', $buttonAPIRandomTags );
// Button API Process Queued
$buttonAPIQueuedTags = new \xan\tags( [ ELE_CLASS_BUTTON_RG_SECONDARY ], [], [ "onclick=\"xanDo( { 'Do': 'apiProcessQueued', 'Msg': 'API Process Queued', 'URL': '/home-do' } );\"" ] );
$buttonAPIQueuedEle = new \xan\eleButton( 'API Process Queued', '', '', $buttonTags );
$table->cellSet( ++$tableRowIndex, 0, $tagsCellLeftMiddle, $buttonAPIRandomEle->render() . ' ' . $buttonAPIQueuedEle->render() );

// Time
$timezoneIDNow = date_default_timezone_get();
date_default_timezone_set( APP_TIMEZONE_ID );
$timeLocal = \xan\timeNowSQL();
date_default_timezone_set( $timezoneIDNow );
$timeUTC = \xan\timeNowSQL();
$table->cellSet( ++$tableRowIndex, 0, $tagsCellLeftMiddle, $timeUTC . ' UTC; ' . $timeLocal . ' ' . APP_TIMEZONE_ID . ';' );

// Card Append
$resp->contentAreaA[] = $card->renderCardWithDiv( $cardHeaderContent, $table->render() );
?>