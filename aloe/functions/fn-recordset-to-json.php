<?php

	function recordset_to_json ( $records, $start_record = 0, $decode_json = false ) {

		// Given a recordset, this function returns a JSON-like
		// array, where the column names are camelcase.
		// Use $start_record to specify the record to start with.
		// Set $decode_json to TRUE to automatically decode the values
		// of columns that appear to contain JSON text. (These
		// are column that have "JSON" in the column name.)

		
		// This will be the resulting array.
		$records_clean = array();
		
		// Loop over each record...
		for ($i = $start_record; $i < count( $records ); $i++) {
		
			// Get the next record.
			$record = $records[$i];
			
			// Create a new array for this record.
			$record_clean = array();
			
			// Loop over the columns and create JSON-style name / value pairs.
			foreach($record as $columnName => $columnValue) {
			
				// Adjust the column name.
				$columnName = str_replace ( '_', '', $columnName );
				$columnName = lcfirst ( $columnName );
				
				// If we're decoding JSON values...
				if ( $decode_json ) {
				
					// If the column appears to contain JSON...
					if ( substr_count( $columnName, 'JSON' ) > 0 ) {
						$columnValue = json_decode( $columnValue );
					}
				
				}
				
				// Add the column / value to the new array.
				$record_clean[$columnName] = $columnValue;
				
			}
			
			// Add the clean record to the array.
			$records_clean[] = $record_clean;

		}
		
		return $records_clean;
		
	}

?>