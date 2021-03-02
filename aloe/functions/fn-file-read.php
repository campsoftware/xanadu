<?php


	function file_read( $file_path ) {

		// Assume that we will not be able to read the file.
		$file = null;

		// If the file exists...		
		if ( file_exists( $file_path ) ) {
				
			// Read the file.
			$file = file_get_contents ( $file_path );
		
		}
		
		return $file;
		
	}

?>