<?php
// Response
$resp = new xan\response;
$resp->reqPath = $aloe_request->path_get();
$resp->reqID = $aloe_request->path_components_get()[ 1 ];
$resp->moduleName = $mmCheckout->NameModule;
$resp->headTitle = $mmCheckout->NameModule;
$resp->navInclude = false;
$resp->contentHeader = $mmCheckout->FontAwesome . STR_NBSP . $mmCheckout->NameModule . STR_NBSP;

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

// Payment: Intent
if ( $stripeSession->mode == 'payment' ) {
    if ( $stripeError === false ) {
        try {
            $stripePaymentIntent = \Stripe\PaymentIntent::retrieve( $stripeSession->payment_intent );
        } catch ( Exception $e ) {
            $stripeError = true;
            $stripeErrorMessage = $e->getMessage();
        }
    }
}

// Subscription: Subscription and Invoice
if ( $stripeSession->mode == 'subscription' ) {
    if ( $stripeError === false ) {
        try {
            $stripeSubscription = \Stripe\Subscription::retrieve( $stripeSession->subscription );
        } catch ( Exception $e ) {
            $stripeError = true;
            $stripeErrorMessage = $e->getMessage();
        }
    }
    if ( $stripeError === false ) {
        try {
            $stripeInvoice = \Stripe\Invoice::retrieve( $stripeSubscription->latest_invoice );
        } catch ( Exception $e ) {
            $stripeError = true;
            $stripeErrorMessage = $e->getMessage();
        }
    }
    if ( $stripeError === false ) {
        try {
            $stripePaymentIntent = \Stripe\PaymentIntent::retrieve( $stripeInvoice->payment_intent );
        } catch ( Exception $e ) {
            $stripeError = true;
            $stripeErrorMessage = $e->getMessage();
        }
    }
    if ( $stripeError === false ) {
        try {
            $stripePaymentMethod = \Stripe\PaymentMethod::retrieve( $stripeSubscription->default_payment_method );
        } catch ( Exception $e ) {
            $stripeError = true;
            $stripeErrorMessage = $e->getMessage();
        }
    }
}

// Customer
if ( $stripeError === false ) {
    try {
        $stripeCustomer = \Stripe\Customer::retrieve( $stripeSession->customer );
    } catch ( Exception $e ) {
        $stripeError = true;
        $stripeErrorMessage = $e->getMessage();
    }
}

// Output
if ( $stripeError === false ) {
    // Normalize the Payment
    $result[ 'vendorName' ] = 'Stripe';
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

        $result[ 'items' ][ $itemIndex ][ 'subscriptionIntervalPeriod' ] = $item[ 'price' ][ 'recurring' ][ 'interval' ];
        $result[ 'items' ][ $itemIndex ][ 'subscriptionIntervalCount' ] = $item[ 'price' ][ 'recurring' ][ 'interval_count' ];
        $result[ 'items' ][ $itemIndex ][ 'subscriptionInterval' ] = $item[ 'price' ][ 'recurring' ][ 'interval' ];

        $result[ 'items' ][ $itemIndex ][ 'nickname' ] = $item[ 'price' ][ 'nickname' ];
        $result[ 'items' ][ $itemIndex ][ 'itemID' ] = $item[ 'id' ];
        $result[ 'items' ][ $itemIndex ][ 'productID' ] = $item[ 'price' ][ 'product' ];
        $result[ 'items' ][ $itemIndex ][ 'priceID' ] = $item[ 'price' ][ 'id' ];
        $itemIndex += 1;
    }

    $result[ 'paymentPaid' ] = $stripePaymentIntent->charges[ 'data' ][ 0 ][ 'paid' ];
    $result[ 'paymentAmountReceived' ] = $stripePaymentIntent->amount_received / 100;
    $result[ 'paymentAmountCurrency' ] = $stripePaymentIntent->currency;
    $result[ 'paymentOutcomeType' ] = $stripePaymentIntent->charges[ 'data' ][ 0 ][ 'outcome' ][ 'type' ];
    $result[ 'paymentOutcomeStatus' ] = $stripePaymentIntent->charges[ 'data' ][ 0 ][ 'outcome' ][ 'network_status' ];
    $result[ 'paymentOutcomeMessage' ] = $stripePaymentIntent->charges[ 'data' ][ 0 ][ 'outcome' ][ 'seller_message' ];
    $result[ 'paymentOutcomeRiskLevel' ] = $stripePaymentIntent->charges[ 'data' ][ 0 ][ 'outcome' ][ 'risk_level' ];
    $result[ 'paymentOutcomeRiskScore' ] = $stripePaymentIntent->charges[ 'data' ][ 0 ][ 'outcome' ][ 'risk_score' ];

    $result[ 'paymentName' ] = $stripePaymentIntent->charges[ 'data' ][ 0 ][ 'billing_details' ][ 'name' ];
    $result[ 'paymentEmail' ] = $stripePaymentIntent->charges[ 'data' ][ 0 ][ 'billing_details' ][ 'email' ];
    $result[ 'paymentPhone' ] = $stripePaymentIntent->charges[ 'data' ][ 0 ][ 'billing_details' ][ 'phone' ];
    $result[ 'paymentStreet1' ] = $stripePaymentIntent->charges[ 'data' ][ 0 ][ 'billing_details' ][ 'address' ][ 'line1' ];
    $result[ 'paymentStreet2' ] = $stripePaymentIntent->charges[ 'data' ][ 0 ][ 'billing_details' ][ 'address' ][ 'line2' ];
    $result[ 'paymentCity' ] = $stripePaymentIntent->charges[ 'data' ][ 0 ][ 'billing_details' ][ 'address' ][ 'city' ];
    $result[ 'paymentState' ] = $stripePaymentIntent->charges[ 'data' ][ 0 ][ 'billing_details' ][ 'address' ][ 'state' ];
    $result[ 'paymentZip' ] = $stripePaymentIntent->charges[ 'data' ][ 0 ][ 'billing_details' ][ 'address' ][ 'postal_code' ];
    $result[ 'paymentCountry' ] = $stripePaymentIntent->charges[ 'data' ][ 0 ][ 'billing_details' ][ 'address' ][ 'country' ];

    $result[ 'urlSuccess' ] = $stripeSession->success_url;
    $result[ 'urlCancel' ] = $stripeSession->cancel_url;
    $result[ 'showsAsOnStatement' ] = $stripePaymentIntent->charges[ 'data' ][ 0 ][ 'calculated_statement_descriptor' ];

    $result[ 'stripeSessionID' ] = $stripeSession->id;
    $result[ 'stripeLineItemsID' ] = $stripeLineItems->data[0]['id'];
    $result[ 'stripePaymentIntentID' ] = $stripePaymentIntent->id;
    $result[ 'stripeCustomerID' ] = $stripeCustomer->id;
    $result[ 'stripeSubscriptionID' ] = $stripeSubscription->id;
    $result[ 'stripeInvoiceID' ] = $stripeInvoice->id;

    $result[ 'stripeSession' ] = $stripeSession;
    $result[ 'stripeLineItems' ] = $stripeLineItems;
    $result[ 'stripePaymentIntent' ] = $stripePaymentIntent;
    $result[ 'stripeCustomer' ] = $stripeCustomer;
    $result[ 'stripeSubscription' ] = $stripeSubscription;
    $result[ 'stripeInvoice' ] = $stripeInvoice;
    
    $resp->contentAreaA[] = '<p class="ml-3">' . '<pre>Result: ' . json_encode( $result, JSON_PRETTY_PRINT ) . '</pre>' . '</p>';

} else {
    
    $resp->contentAreaA[] = '<p class="ml-3">' . 'Error: ' . $stripeErrorMessage . '</p>';
    
}

$aloe_response->content_set( require_once( PATH_PAGE_RESP ) );
?>
