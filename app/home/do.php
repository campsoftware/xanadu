<?php
// Response Init
$resp = new \xan\response;
$resp->reqPath = \xan\paramEncode( $aloe_request->path_get() );
$resp->reqPathComponents = \xan\paramEncode( $aloe_request->path_components_get() );
$resp->reqPost = \xan\paramEncode( $aloe_request->post );

// Params Get
$doParam = json_decode( $aloe_request->post[ 'params' ], true );
$doParam = \xan\paramEncode( $doParam );

// Validate Init
$ValidationMsgA = array();

// Validate From Ajax
if ( \xan\isAjax() === false ) {
	$ValidationMsgA[] = "Call Method Error";
}

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	$ValidationMsgA[] = "In URL: " . $doParam[ 'URL' ] . '; Do: ' . $doParam[ 'Do' ];
	$aloe_response->status_set( '400 Bad Request: ' . implode( ', ', $ValidationMsgA ) );
	$aloe_response->content_set( 'Error' );
	return;
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

if ( $doParam[ 'Do' ] === 'apiProcessQueued' ) {
	require_once( "do-api-process-queued.php" );
	return;
}

if ( $doParam[ 'Do' ] === 'apiRequestRandomAmount' ) {
	require_once( "do-api-request-randomAmount.php" );
	return;
}
?>