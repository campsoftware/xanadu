<?php

namespace xan;

class printer {
	
	// Constructor
	public function __construct() {
	}
	
	public function htmlToFile( $docFormat, $template, $filename, $params, $header, $body, $footer ) {
		$secondsBegin = microtime( true );;
		$result = [];
		
		// Validate
		
		// Init
		$dirBase = PATH_ROOT_BRIEF;
		$dirTemplate = PATH_ROOT_TEMPLATES . $template . '/';
		
		// Delete Older Directories
		//    $dirRemoved = '';
		$dirPurgeBefore = dateTimeFromString( '-5 minutes', DATETIME_FORMAT_LOG );
		$dirFiles = scandir( $dirBase );
		foreach ( $dirFiles as $thisFile ) {
			$thisParts = explode( '.', $thisFile ); // 20200112_174826.825800_897090
			if ( isNotEmpty( $thisParts[ 0 ] ) && $thisParts[ 0 ] < $dirPurgeBefore ) {
				filesDeleteRecursive( $dirBase . $thisFile );
				//            $dirRemoved .= '<br/>Removed: ' . $thisParts[ 0 ] . '  ;  ';
				//        } else {
				//            $dirRemoved .= '<br/>Kept: ' . $thisParts[ 0 ] . '  ;  ';
			}
		}
		
		// Create Working Folder: 20200112_174826.825800_897090
		$folderWorking = dateTimeFromString( 'now', DATETIME_FORMAT_LOG ) . '.' . rand( 100000000, 999999999 ) . '/';
		$dirWorking = $dirBase . $folderWorking;
		$dirExists = dirCreate( $dirWorking );
		
		// Read Templates
		$headerTemplate = fileRead( $dirTemplate . 'header.php' );
		$bodyTemplate = fileRead( $dirTemplate . 'body.php' );
		$footerTemplate = fileRead( $dirTemplate . 'footer.php' );
		
		// Process Header
		foreach ( $header as $key => $value ) {
			$headerTemplate = str_replace( $key, $value, $headerTemplate );
		}
		// Process Body
		foreach ( $body as $key => $value ) {
			$bodyTemplate = str_replace( $key, $value, $bodyTemplate );
		}
		// Process Footer
		foreach ( $footer as $key => $value ) {
			$footerTemplate = str_replace( $key, $value, $footerTemplate );
		}
		
		///////////////////////////////////////////////////////////
		// Format HTML
		if ( $docFormat == 'html' ) {
			$filename .= '.html';
			$write1 = fileWrite( $dirWorking . $filename, $bodyTemplate );
		}
		
		///////////////////////////////////////////////////////////
		// Format PDF
		if ( $docFormat == 'pdf' ) {
			$filename .= '.pdf';
			
			// Save html Files
			$write1 = fileWrite( $dirWorking . 'header.html', $headerTemplate );
			$write2 = fileWrite( $dirWorking . 'body.html', $bodyTemplate );
			$write3 = fileWrite( $dirWorking . 'footer.html', $footerTemplate );
			
			//  Params Set
			$params .= ( isEmpty( $header ) ? '' : " --header-html '" . $dirWorking . "header.html'" );
			$params .= ( isEmpty( $footer ) ? '' : " --footer-html '" . $dirWorking . "footer.html'" );
			$params .= " '" . $dirWorking . "body.html'";
			$params .= " '" . $dirWorking . $filename . "'";
			
			// Command Run
			$command = 'wkhtmltopdf ' . $params . ' 2>&1';
			$commandResult = shell_exec( $command );
			$result[ 'command' ] = $command;
			$result[ 'commandresult' ] = $commandResult;
		}
		
		$url = URL_BRIEF . $folderWorking . $filename;
		$result[ 'url' ] = $url;
		
		$secondsTotal = microsecsDiff( $secondsBegin );;
		$result[ 'seconds' ] = $secondsTotal;
		return $result;
	}
	
}

?>