<?php 

	// Note:
	// Be sure to give PHP write permission on the path.

	namespace aloe;

	class template {
	
		var $file_path;
		var $tokens;		
		
		
		function __construct( $file_path = '' ) {	
			$this->file_path_set( $file_path );
			$this->tokens = array();
		}
		
		
		function file_path_set( $file_path ) {
			$this->file_path = $file_path;
		}	
		
		
		function file_path_get() {
			return $this->file_path;
		}	
		
		
		function token_set( $name, $value ) {
			$this->tokens[$name] = $value;
		}	
		
		
		function token_get( $name ) {
			return $this->tokens[$name];
		}		
		
		
		function render() {
		
			$html = file_read( $this->file_path );
			
			foreach($this->tokens as $name => $value) {
				$html = str_replace( '[[' . $name . ']]', $value, $html );
			}
			
			// Substitute standard tokens.
			$html = str_replace( '[[date.year]]', date('Y'), $html );
			
			return $html;
		
		}		
			
	}
	
?>