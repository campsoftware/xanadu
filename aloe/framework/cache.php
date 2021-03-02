<?php 

	// Note:
	// Be sure to give PHP write permission on the path.

	namespace aloe;

	class cache {
	
		var $path;		
		
		
		function __construct( $path ) {	
			$this->path_set( $path );
		}
		
		
		function path_set( $path ) {
			$this->path = $path;
		}	
		
		
		function path_get() {
			return $this->path;
		}		
		
		
		function set( $cache_name, $content ) {

			$cache_file_path = $this->path . '/' . $cache_name . '.json';
			
			// NOTE: Permissions on the cache folder should be set to 777.									
			@file_put_contents ( $cache_file_path, $content );			

		}
		
		
		function get( $cache_name ) {
		
			$cache = array();

			$cache_file_path = $this->path . '/' . $cache_name . '.json';	
					
			if ( file_exists ( $cache_file_path ) ) {
												
				$cache['content'] = @file_get_contents ( $cache_file_path );
										
				$cache['age-seconds'] = ( time () - filemtime ( $cache_file_path ) );
			
				$cache['size-mb'] = number_format( filesize ( $cache_file_path ) / 1024, 2);
			
			}
						
			return $cache;
			
		}		
			
	}
	
?>