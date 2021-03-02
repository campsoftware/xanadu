<?php	

	// Given a JSON object (or array), if the specified key
	// exists, its value is returned. Otherwise, the
	// default value is returned.

	function jsonLookup( $json, $key, $default = "" ) {
	
		if ( array_key_exists( $key, $json ) ) {
			return $json[$key];
		} else {
			return $default;
		}
		
	}

?>