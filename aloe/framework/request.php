<?php

	namespace aloe;

	class request {
	
		var $get;
		var $path_components;
		var $path;
		var $payload = '';
		var $post;
		var $remote_address;
		var $uri_parts;
		
		function __construct() {
		
			// Explode the URI into an array, where element 0 is the path,
			// and element 1 is any URL params.
			$this->uri_parts = explode( '?', $_SERVER["REQUEST_URI"] );
		
			// Set the path.
			$this->path = $this->uri_parts[0];
			
			// If applicable, strip the trailing "/" from the request path.
			if ( substr( $this->path, strlen( $this->path ) - 1, 1 ) == '/' ) {
				$this->path = substr ( $this->path, 0, strlen( $this->path ) - 1);
			}
		
			// Explode the path into an array.
			$this->path_components = explode( '/', $this->path );
			array_shift( $this->path_components );

			// If the request was a POST...
			if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
				// Set the payload.
				$this->payload = file_get_contents('php://input');
			} else {
				$this->payload = '';
			}
			
			// Set the remote address.
			$this->remote_address = $_SERVER[ 'REMOTE_ADDR' ];
			
			// Set the GET and POST properties.
			$this->get = $_GET;
			$this->post = $_POST;
		
		}
		
		function device_type_get () {
		
			$user_agent = $this->header_get( 'USER_AGENT' );
	
			if (
					( stripos ( $user_agent, 'iPod' ) )
					or ( stripos ( $user_agent, 'iPhone' ) )
					or ( stripos ( $user_agent, 'iPad' ) )
					or ( stripos ( $user_agent, 'Android' ) )
					or ( stripos ( $user_agent, 'webOS' ) )
					or ( stripos ( $user_agent, 'mobile' ) )
				)
			{
				return 'mobile';
			} else {
				return 'desktop';
			}
	
		}
		
		function method_get() {
			return $_SERVER['REQUEST_METHOD'];
		}
		
		function uri_parts_get() {
			return $this->uri_parts;
		}
		
		function uri_part_get( $i ) {
			return $this->uri_parts[$i];
		}
		
		function path_get() {
			return $this->path;
		}
		
		function path_components_get() {
			return $this->path_components;
		}
		
		function payload_get() {
			return $this->payload;
		}
		
		function header_get( $name ) {
			// Note the special mapping of the header name to
			// what nginx passes to PHP.
			// Example:
			// Content-Type -> HTTP_CONTENT_TYPE
			$name = strtoupper( $name );
			$name = str_replace( '-', '_', $name );
			return $_SERVER['HTTP_' . $name];
		}
		
		function headers_get() {
			// Returns an array of headers.
			$headers = array();
			foreach ( $_SERVER as $key => $value ) {
				if ( substr( $key, 0, 5 ) == 'HTTP_' ) {
					$key = str_replace( 'HTTP_', '', $key );
					$headers[$key] = $value;
				}
			}
			return $headers;
		}
		
		function remote_address_get() {
			return $this->remote_address;
		}
		
	}
	
?>