<?php 

	namespace aloe;	

	class response {
	
		var $status;	
		var $headers;		
		var $content;
		
		function __construct() {	
		
			$this->status = '200 OK';
			$this->headers = array();
			$this->content = '';
			
			// Sets suggested security-related headers.
			// For guidance, see:
			// https://content-security-policy.com/
			// https://wiki.mozilla.org/Security/Guidelines/Web_Security			
			// $this->headers['Content-Security-Policy'] = 'default-src \'none\'; connect-src \'self\'; frame-ancestors \'none\'; img-src \'self\'; script-src \'self\'; style-src \'unsafe-inline\' \'self\';';
			// $this->headers['Referrer-Policy'] = 'no-referrer, strict-origin-when-cross-origin';
			// $this->headers['Strict-Transport-Security'] = 'max-age=63072000';
			// $this->headers['X-Content-Type-Options'] = 'nosniff';
			// $this->headers['X-Frame-Options'] = 'DENY';
			// $this->headers['X-XSS-Protection'] = '1; mode=block';
		
		}
		
		function status_set( $status ) {
			$this->status = $status;
		}
		
		function status_get() {
			return $this->status;
		}		
		
		function header_set( $key, $value ) {
			$this->headers[$key] = $value;
		}
		
		function header_get( $key ) {
			return $this->headers[$key];
		}	
		
		function content_set( $content ) {
			$this->content = $content;
		}
		
		function content_append( $content ) {
			$this->content .= $content;
		}		
		
		function content_get() {
			return $this->content;
		}	
		
		function return() {
			header( 'Status: ' . $this->status );
			foreach ( $this->headers as $key => $value ) { 
				header( $key . ': ' . $value );
			}
			echo $this->content;
		}			
		
	}
	
?>