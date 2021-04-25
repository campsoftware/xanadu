<?php
// Validate Init
$ValidationMsgA = array();

// Validate Tests
// if ( !isset( $resp->reqPost[ 'MemberID' ] ) or \xan\isEmpty( $resp->reqPost[ 'MemberID' ] ) ) {
// 	$ValidationMsgA[] = "Member ID is Blank";
// }

// Validate Response
if ( !empty( $ValidationMsgA ) ) {
	$processType = 'none';
	$resp->api[ 'Code' ] = 'Error';
	$resp->api[ 'Message' ] = implode( ', ', $ValidationMsgA );
	$aloe_response->status_set( '400 Bad Request' );
	$aloe_response->content_set( json_encode( $resp->api ) );
	return;
}
?>
