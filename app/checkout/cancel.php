<?php
// Response
$resp = new \xan\response;
$resp->reqPath = \xan\paramEncode( $aloe_request->path_get() );
$resp->reqPathComponents = \xan\paramEncode( $aloe_request->path_components_get() );
$resp->reqPost = \xan\paramEncode( $aloe_request->post );
$resp->reqID = $resp->reqPathComponents[ 1 ];
$resp->moduleName = $mmCheckout->NameModule;
$resp->headTitle = $mmCheckout->NamePlural;
$resp->headLogoutAuto = false;
$resp->navInclude = false;
$resp->contentHeader = $mmCheckout->FontIcon . STR_NBSP . $mmCheckout->NamePlural . STR_NBSP;

// Stripe Init
require_once( 'include/stripe/7.48.0/init.php' );
\Stripe\Stripe::setApiKey( STRIPE_KEY_SECRET );
$stripeError = false;
$stripeErrorMessage = '';

// Session
try {
    $stripeSession = \Stripe\Checkout\Session::retrieve( $resp->reqID );
} catch ( Exception $e ) {
    $stripeError = true;
    $stripeErrorMessage = $e->getMessage();
}

// LineItems
if ( $stripeError === false ) {
    try {
        $stripeLineItems = \Stripe\Checkout\Session::allLineItems( $resp->reqID );
    } catch ( Exception $e ) {
        $stripeError = true;
        $stripeErrorMessage = $e->getMessage();
    }
}

// Output
if ( $stripeError === false ) {
    $result[ 'vendorName' ] = 'Stripe';
    $result[ 'vendorSessionID' ] = $stripeSession->id;
    $result[ 'mode' ] = $stripeSession->mode;
    $result[ 'modeIsLive' ] = $stripeSession->livemode;
    $result[ 'metadata' ] = $stripeSession->metadata;

    $result[ 'totalCurrency' ] = $stripeSession->currency; // usd
    $result[ 'totalAmount' ] = $stripeSession->amount_total / 100; // 2000 for 20.00
    //    $result[ 'totalDetails' ] = $stripeSession->total_details;
    $result[ 'totalDiscount' ] = $stripeSession->total_details[ 'amount_discount' ];
    $result[ 'totalTax' ] = $stripeSession->total_details[ 'amount_tax' ];

    $result[ 'itemCount' ] = count( $stripeLineItems->data );
    $itemIndex = 0;
    foreach ( $stripeLineItems->data as $item ) {
        $result[ 'items' ][ $itemIndex ][ 'amountCurrency' ] = $item[ 'currency' ];
        $result[ 'items' ][ $itemIndex ][ 'amountTotal' ] = $item[ 'amount_total' ] / 100;
        $result[ 'items' ][ $itemIndex ][ 'amountSubtotal' ] = $item[ 'amount_subtotal' ] / 100;
        $result[ 'items' ][ $itemIndex ][ 'amountUnit' ] = $item[ 'price' ][ 'unit_amount' ] / 100;
        $result[ 'items' ][ $itemIndex ][ 'per' ] = $item[ 'price' ][ 'billing_scheme' ];
        $result[ 'items' ][ $itemIndex ][ 'quantity' ] = $item[ 'quantity' ];
        $result[ 'items' ][ $itemIndex ][ 'description' ] = $item[ 'description' ];

        //        $result[ 'items' ][ $itemIndex ][ 'recurring' ] = $item[ 'price' ][ 'recurring' ];
        $result[ 'items' ][ $itemIndex ][ 'recurringIntervalPeriod' ] = $item[ 'price' ][ 'recurring' ][ 'interval' ];
        $result[ 'items' ][ $itemIndex ][ 'recurringIntervalCount' ] = $item[ 'price' ][ 'recurring' ][ 'interval_count' ];
        $result[ 'items' ][ $itemIndex ][ 'recurringInterval' ] = $item[ 'price' ][ 'recurring' ][ 'interval' ];

        $result[ 'items' ][ $itemIndex ][ 'nickname' ] = $item[ 'price' ][ 'nickname' ];
        $result[ 'items' ][ $itemIndex ][ 'itemID' ] = $item[ 'id' ];
        $result[ 'items' ][ $itemIndex ][ 'productID' ] = $item[ 'price' ][ 'product' ];
        $result[ 'items' ][ $itemIndex ][ 'priceID' ] = $item[ 'price' ][ 'id' ];
        $itemIndex += 1;
    }

    //    $page[ PAGE_CONTENT_AREA ] .= '<p class="ml-3">' . '<pre>Result: ' . json_encode( $result, JSON_PRETTY_PRINT ) . '</pre>' . '</p>';
    //    $page[ PAGE_CONTENT_AREA ] .= '<p class="ml-3">' . '<pre>Session: ' . json_encode( $stripeSession, JSON_PRETTY_PRINT ) . '</pre>' . '</p>';
    //    $page[ PAGE_CONTENT_AREA ] .= '<p class="ml-3">' . '<pre>LineItems: ' . json_encode( $stripeLineItems, JSON_PRETTY_PRINT ) . '</pre>' . '</p>';
} else {
    //    $page[ PAGE_CONTENT_AREA ] .= '<p class="ml-3">' . 'Error: ' . $stripeErrorMessage . '</p>';
}

// Spinner
ob_start();
?>
<div class="text-center p-5 m-5">
    <div class="spinner-border" style="width: 2rem; height: 2rem;" role="status">
        <span class="sr-only">Cancelling...</span>
    </div>
    <br/>Cancelling...
</div>
<?php
$resp->contentAreaA[] = ob_get_clean();

// Go Back to the Page with the Button
$resp->scriptsOnLoadA[] = 'history.go(-3); return false;' . "\n";

$aloe_response->content_set( require_once( PATH_PAGE_RESP ) );
?>
